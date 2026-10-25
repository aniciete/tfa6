@extends('layouts.app')

@section('content')
<div class="home-layout">
    <section class="overview-section">
        <h1 class="page-title">Point-of-Sale Eloquent</h1>
        <p class="page-lead">
            A modular web application demonstrating Model-View-Controller architecture, Eloquent ORM persistence, database migrations, and seeders in Laravel 11.
        </p>

        <div class="actions-grid">
            <article class="action-card">
                <h2 class="card-heading">Customer Accounts</h2>
                <p class="card-text">
                    Browse active client profiles and accounts retrieved dynamically from the database using the <code>Customer</code> Eloquent model.
                </p>
                <div class="card-action">
                    <a href="{{ route('customers.index') }}" class="button button-primary">View Customers</a>
                </div>
            </article>

            <article class="action-card">
                <h2 class="card-heading">User Accounts</h2>
                <p class="card-text">
                    Audit system operators, cashier staff, and administrative personnel managed through the <code>User</code> Eloquent model.
                </p>
                <div class="card-action">
                    <a href="{{ route('users.index') }}" class="button button-primary">View Users</a>
                </div>
            </article>
        </div>
    </section>

    <section class="overview-section" aria-labelledby="details-heading">
        <h2 id="details-heading" class="section-title">Application Overview</h2>
        <div class="details-card">
            <ul class="details-list">
                <li>
                    <strong>Framework:</strong>
                    <span>Laravel 11 running on PHP 8.2+</span>
                </li>
                <li>
                    <strong>Database &amp; ORM:</strong>
                    <span>Relational database via Eloquent models (<code>Customer</code> &amp; <code>User</code>)</span>
                </li>
                <li>
                    <strong>Database Migrations:</strong>
                    <span>Structured schema migrations for <code>customers</code> and <code>users</code></span>
                </li>
                <li>
                    <strong>Sample Data:</strong>
                    <span>Automated database seeders populating initial records</span>
                </li>
            </ul>
        </div>
    </section>
</div>
@endsection
