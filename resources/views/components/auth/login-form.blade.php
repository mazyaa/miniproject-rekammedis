@props([
    'title' => 'Selamat Datang,',
    'titleHighlight' => 'Dokter',
    'subtitle' => 'Masukkan kredensial Anda untuk mengakses dashboard',
    'buttonText' => 'Masuk ke Dashboard →',
    'footerNote' => 'Akses hanya untuk tenaga medis & administrator terdaftar.<br>Diproteksi dengan enkripsi end-to-end.'
])

<div class="forms-wrap">
    {{-- Logo --}}
    <x-auth.logo />

    <form method="POST" action="{{ route('login') }}">
        @csrf

        @if (session('status'))
            <div class="session-status">{{ session('status') }}</div>
        @endif

        <div class="heading">
            <h2>{{ $title }} <em>{{ $titleHighlight }}</em></h2>
            <p>{{ $subtitle }}</p>
        </div>

        {{-- Email Input --}}
        <x-auth.input-field
            id="email"
            name="email"
            type="email"
            label="Alamat Email"
            placeholder="admin@medicare.com"
            :value="old('email')"
            icon="email"
            :required="true"
            :autofocus="true"
            autocomplete="username"
            :errors="$errors->get('email')"
        />

        {{-- Password Input --}}
        <x-auth.input-field
            id="password"
            name="password"
            type="password"
            label="Password"
            placeholder="••••••••"
            icon="password"
            :required="true"
            autocomplete="current-password"
            :errors="$errors->get('password')"
        />

        <input type="submit" value="{{ $buttonText }}" class="sign-btn" />

        <p class="bottom-note">
            {!! $footerNote !!}
        </p>
    </form>
</div>
