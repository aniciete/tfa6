<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ $title ?? 'POS Eloquent' }}</title>
    <link rel="icon" type="image/svg+xml" href="{{ preg_replace('~^https?:~', '', asset('favicon.svg')) }}">
    <link rel="alternate icon" href="{{ preg_replace('~^https?:~', '', asset('favicon.ico')) }}">
    <link rel="stylesheet" href="{{ preg_replace('~^https?:~', '', asset('assets/css/style.css')) }}">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="market-body page-{{ $activePage ?? 'home' }}">
    <a href="#main-content" class="skip-link">Skip to main content</a>

    <header class="site-header" role="banner">
        <div class="container header-container">
            <div class="brand-group">
                <a href="{{ route('home') }}" class="brand-link" aria-label="POS Eloquent Home">
                    <span class="brand-mark" aria-hidden="true">
                        <svg width="28" height="28" viewBox="0 0 28 28" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <rect x="2" y="2" width="24" height="24" rx="3" fill="#173c2a"/>
                            <rect x="4" y="4" width="20" height="20" rx="2" stroke="#fff8e8" stroke-width="1.2" stroke-dasharray="2 1.5"/>
                            <path d="M9 8H15C17.2091 8 19 9.79086 19 12C19 14.2091 17.2091 16 15 16H12V20H9V8Z" fill="#fff8e8"/>
                            <circle cx="19.5" cy="19.5" r="2.5" fill="#c94c38"/>
                        </svg>
                    </span>
                    <span class="brand-text">
                        <span class="brand-badge">POS</span>
                        <span class="brand-title">Eloquent</span>
                    </span>
                </a>
                <span class="brand-docket" aria-hidden="true">TFA-06 &bull; Laravel Eloquent</span>
            </div>

            <nav class="site-nav" aria-label="Main Navigation">
                <ul class="nav-list" role="list">
                    <li class="nav-item">
                        <a href="{{ route('home') }}" class="nav-link {{ ($activePage ?? '') === 'home' ? 'active' : '' }}" {!! ($activePage ?? '') === 'home' ? 'aria-current="page"' : '' !!}>
                            <span class="nav-num">01</span>
                            <span class="nav-label">Home</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('about') }}" class="nav-link {{ ($activePage ?? '') === 'about' ? 'active' : '' }}" {!! ($activePage ?? '') === 'about' ? 'aria-current="page"' : '' !!}>
                            <span class="nav-num">02</span>
                            <span class="nav-label">About</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('customers.index') }}" class="nav-link {{ ($activePage ?? '') === 'customers' ? 'active' : '' }}" {!! ($activePage ?? '') === 'customers' ? 'aria-current="page"' : '' !!}>
                            <span class="nav-num">03</span>
                            <span class="nav-label">Customer Accounts</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('users.index') }}" class="nav-link {{ ($activePage ?? '') === 'users' ? 'active' : '' }}" {!! ($activePage ?? '') === 'users' ? 'aria-current="page"' : '' !!}>
                            <span class="nav-num">04</span>
                            <span class="nav-label">User Accounts</span>
                        </a>
                    </li>
                </ul>
            </nav>
        </div>
    </header>

    <main id="main-content" class="main-content" role="main" tabindex="-1">
        <div class="container content-container">
            @yield('content')
        </div>
    </main>

    <footer class="site-footer" role="contentinfo">
        <div class="receipt-tear" aria-hidden="true"></div>
        <div class="container footer-container">
            <div class="receipt-meta" aria-hidden="true">
                <span class="receipt-tag">[DOCKET: LARAVEL-POS-TFA6]</span>
                <span class="receipt-divider">&mdash;&mdash;&mdash;&mdash;&mdash;&mdash;&mdash;&mdash;</span>
                <span class="receipt-tag">[STORE: 001 // LOCAL DEV]</span>
            </div>
            <p class="footer-course">IT0049 Web System Technologies &bull; Technical Formative Assessment 6</p>
            <p class="footer-subtext">Laravel POS Eloquent &bull; Database Backed Models & Migrations</p>
        </div>
    </footer>
</body>
</html>
