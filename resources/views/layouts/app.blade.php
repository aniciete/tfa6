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
</head>
<body class="page-{{ $activePage ?? 'home' }}">
    <a href="#main-content" class="skip-link">Skip to main content</a>

    <header class="site-header" role="banner">
        <div class="container header-container">
            <div class="brand-group">
                <a href="{{ route('home') }}" class="brand-link" aria-label="POS Eloquent Home">
                    <span class="brand-title">POS Eloquent</span>
                </a>
            </div>

            <nav class="site-nav" aria-label="Main Navigation">
                <ul class="nav-list" role="list">
                    <li class="nav-item">
                        <a href="{{ route('home') }}" class="nav-link {{ ($activePage ?? '') === 'home' ? 'active' : '' }}" {!! ($activePage ?? '') === 'home' ? 'aria-current="page"' : '' !!}>Home</a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('customers.index') }}" class="nav-link {{ ($activePage ?? '') === 'customers' ? 'active' : '' }}" {!! ($activePage ?? '') === 'customers' ? 'aria-current="page"' : '' !!}>Customers</a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('users.index') }}" class="nav-link {{ ($activePage ?? '') === 'users' ? 'active' : '' }}" {!! ($activePage ?? '') === 'users' ? 'aria-current="page"' : '' !!}>Users</a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('about') }}" class="nav-link {{ ($activePage ?? '') === 'about' ? 'active' : '' }}" {!! ($activePage ?? '') === 'about' ? 'aria-current="page"' : '' !!}>About</a>
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
        <div class="container footer-container">
            <p class="footer-text">IT0049 Web System Technologies &bull; Technical Formative Assessment 6</p>
            <p class="footer-subtext">Laravel POS Eloquent &bull; Database Backed Models &amp; Migrations</p>
        </div>
    </footer>
</body>
</html>
