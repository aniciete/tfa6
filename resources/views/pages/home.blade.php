@extends('layouts.app')

@section('content')
<div class="home-grid">
    <!-- Asymmetric Top Section: Oversized Headline + Facts Panel -->
    <section class="home-hero" aria-labelledby="hero-title">
        <div class="hero-mast">
            <div class="tag-row">
                <span class="market-tag">Laravel 13 Eloquent Architecture</span>
                <span class="status-indicator" aria-label="System status operational">
                    <span class="status-pip" aria-hidden="true"></span>
                    <span class="status-label">Operational</span>
                </span>
            </div>
            <h1 id="hero-title" class="page-title hero-title">Point-of-Sale Eloquent</h1>
            <p class="hero-lead">
                A modular four-page web application demonstrating Model-View-Controller fundamentals, Eloquent ORM persistence, migrations, and database seeders in Laravel.
            </p>
        </div>
    </section>

    <aside class="facts-panel" aria-label="System facts and specifications">
        <div class="panel-header">
            <span class="panel-kicker">SYSTEM LEDGER</span>
            <span class="panel-badge">TFA-06</span>
        </div>
        <ul class="facts-list" role="list">
            <li class="fact-item">
                <span class="fact-num">04</span>
                <div class="fact-details">
                    <strong class="fact-label">Configured Routes</strong>
                    <span class="fact-desc">Home, About, Customers, Users</span>
                </div>
            </li>
            <li class="fact-item">
                <span class="fact-num">02</span>
                <div class="fact-details">
                    <strong class="fact-label">Eloquent Models</strong>
                    <span class="fact-desc">Customer and User models</span>
                </div>
            </li>
            <li class="fact-item">
                <span class="fact-num">02</span>
                <div class="fact-details">
                    <strong class="fact-label">Migrated Tables</strong>
                    <span class="fact-desc">customers and users schema</span>
                </div>
            </li>
        </ul>
    </aside>

    <!-- Two Prominent Directory Modules -->
    <section class="directory-modules" aria-label="Application Directories">
        <article class="directory-card card-customers">
            <div class="card-meta">
                <span class="module-number">DIR // 01</span>
                <span class="record-pill">Eloquent ORM</span>
            </div>
            <div class="card-header">
                <div class="card-symbol" aria-hidden="true">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/>
                        <circle cx="9" cy="7" r="4"/>
                        <path d="M23 21v-2a4 4 0 0 0-3-3.87"/>
                        <path d="M16 3.13a4 4 0 0 1 0 7.75"/>
                    </svg>
                </div>
                <h2 class="card-title">Customer Accounts</h2>
            </div>
            <p class="card-description">
                View customer accounts retrieved through the <code>App\Models\Customer</code> Eloquent model and backed by the migrated <code>customers</code> table.
            </p>
            <div class="card-footer">
                <a href="{{ route('customers.index') }}" class="button button-primary">
                    <span>Open Customers</span>
                    <span class="btn-arrow" aria-hidden="true">&rarr;</span>
                </a>
            </div>
        </article>

        <article class="directory-card card-users">
            <div class="card-meta">
                <span class="module-number">DIR // 02</span>
                <span class="record-pill">Eloquent ORM</span>
            </div>
            <div class="card-header">
                <div class="card-symbol" aria-hidden="true">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <rect x="3" y="4" width="18" height="16" rx="2"/>
                        <circle cx="9" cy="10" r="2"/>
                        <path d="M15 8h2"/>
                        <path d="M15 12h2"/>
                        <path d="M7 16h10"/>
                    </svg>
                </div>
                <h2 class="card-title">User Accounts</h2>
            </div>
            <p class="card-description">
                Browse staff accounts and operational roles retrieved through the <code>App\Models\User</code> Eloquent model and backed by the migrated <code>users</code> table.
            </p>
            <div class="card-footer">
                <a href="{{ route('users.index') }}" class="button button-primary">
                    <span>Open Users</span>
                    <span class="btn-arrow" aria-hidden="true">&rarr;</span>
                </a>
            </div>
        </article>
    </section>

    <!-- Horizontal Architecture Feature -->
    <section class="architecture-feature" aria-labelledby="arch-title">
        <div class="feature-left">
            <span class="market-tag tag-sage">SYSTEM BLUEPRINT</span>
            <h2 id="arch-title" class="card-title feature-heading">Architecture &amp; Flow</h2>
            <p class="card-description">
                Examine how HTTP requests map through Laravel routing, execute controller methods, query Eloquent ORM models, and populate Blade view templates.
            </p>
        </div>
        <div class="feature-pipeline" aria-label="Request lifecycle pipeline">
            <div class="pipe-node">
                <span class="pipe-index">01</span>
                <span class="pipe-name">URL Request</span>
            </div>
            <span class="pipe-connector" aria-hidden="true">&rarr;</span>
            <div class="pipe-node">
                <span class="pipe-index">02</span>
                <span class="pipe-name">Router</span>
            </div>
            <span class="pipe-connector" aria-hidden="true">&rarr;</span>
            <div class="pipe-node">
                <span class="pipe-index">03</span>
                <span class="pipe-name">Controller</span>
            </div>
            <span class="pipe-connector" aria-hidden="true">&rarr;</span>
            <div class="pipe-node">
                <span class="pipe-index">04</span>
                <span class="pipe-name">Eloquent ORM</span>
            </div>
            <span class="pipe-connector" aria-hidden="true">&rarr;</span>
            <div class="pipe-node">
                <span class="pipe-index">05</span>
                <span class="pipe-name">Rendered View</span>
            </div>
        </div>
        <div class="feature-actions">
            <a href="{{ route('about') }}" class="button button-secondary">Learn About Eloquent MVC</a>
        </div>
    </section>
</div>
@endsection
