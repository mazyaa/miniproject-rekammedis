<?php

namespace App\Http\Controllers;

use App\Services\DashboardService;

class DashboardController extends Controller
{
    public function __construct(
        private readonly DashboardService $dashboardService
    ) {}

    /**
     * Tampilkan halaman dashboard dengan statistik dan ringkasan data.
     */
    public function index()
    {
        $data = $this->dashboardService->getDashboardData();

        return view('admin.dashboard', $data);
    }
}
