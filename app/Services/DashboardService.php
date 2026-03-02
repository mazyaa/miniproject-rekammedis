<?php

namespace App\Services;

use App\Models\Pasien;
use App\Models\RekamMedis;
use App\Models\User;
use Carbon\Carbon;

class DashboardService
{
    /**
     * Ambil semua data yang dibutuhkan dashboard.
     *
     * @return array
     */
    public function getDashboardData(): array
    {
        return [
            ...$this->getSummaryStats(),
            ...$this->getChartData(),
            'activities'       => $this->getRecentActivities(),
            'pasienTrend'      => $this->calculateTrend(Pasien::class),
            'konsultasiTrend'  => $this->calculateTrend(RekamMedis::class),
        ];
    }

    /**
     * Hitung total pasien, petugas, dan konsultasi.
     */
    private function getSummaryStats(): array
    {
        return [
            'totalPasien'     => Pasien::count(),
            'totalPetugas'    => User::count(),
            'totalKonsultasi' => RekamMedis::count(),
        ];
    }

    /**
     * Data chart pasien 6 bulan terakhir.
     */
    private function getChartData(): array
    {
        $chartLabels = [];
        $chartData   = [];

        for ($i = 5; $i >= 0; $i--) {
            $date          = Carbon::now()->subMonths($i);
            $chartLabels[] = $date->translatedFormat('M');
            $chartData[]   = Pasien::whereYear('created_at', $date->year)
                ->whereMonth('created_at', $date->month)
                ->count();
        }

        return compact('chartLabels', 'chartData');
    }

    /**
     * 5 aktivitas terbaru (konsultasi + pendaftaran pasien).
     */
    private function getRecentActivities(): array
    {
        $recentKonsultasi = RekamMedis::with(['pasien', 'petugas'])
            ->orderByDesc('created_at')
            ->take(5)
            ->get()
            ->map(fn ($record) => [
                'icon'    => 'bi-clipboard2-pulse',
                'variant' => 'success',
                'text'    => '<strong>' . ($record->pasien->nama_pasien ?? 'Pasien') . '</strong> melakukan konsultasi',
                'time'    => $record->created_at->diffForHumans(),
            ]);

        $recentPasien = Pasien::orderByDesc('created_at')
            ->take(3)
            ->get()
            ->map(fn ($patient) => [
                'icon'    => 'bi-person-plus',
                'variant' => 'primary',
                'text'    => '<strong>' . $patient->nama_pasien . '</strong> telah terdaftar',
                'time'    => $patient->created_at->diffForHumans(),
            ]);

        return $recentKonsultasi
            ->merge($recentPasien)
            ->sortByDesc('time')
            ->take(5)
            ->values()
            ->toArray();
    }

    /**
     * Hitung persentase trend bulan ini vs bulan lalu untuk model tertentu.
     */
    private function calculateTrend(string $model): int
    {
        $now       = Carbon::now();
        $lastMonth = $now->copy()->subMonth();

        $lastMonthCount = $model::whereMonth('created_at', $lastMonth->month)
            ->whereYear('created_at', $lastMonth->year)
            ->count();

        $thisMonthCount = $model::whereMonth('created_at', $now->month)
            ->whereYear('created_at', $now->year)
            ->count();

        if ($lastMonthCount > 0) {
            return (int) round((($thisMonthCount - $lastMonthCount) / $lastMonthCount) * 100);
        }

        return $thisMonthCount > 0 ? 100 : 0;
    }
}
