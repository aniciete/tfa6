@extends('layouts.app')

@section('content')
<div class="about-container">
    <header class="section-header">
        <div class="tag-row">
            <span class="market-tag">System Overview &bull; Architecture</span>
            <span class="status-indicator">
                <span class="status-pip" aria-hidden="true"></span>
                <span class="status-label">Documented Flow</span>
            </span>
        </div>
        <h1 class="page-title">About This Application</h1>
        <p class="section-lead">
            Technical Formative Assessment 6 focuses on the transition from static arrays to Laravel's Eloquent ORM, database migrations, model seeders, and relational query abstraction.
        </p>
    </header>

    <div class="about-layout">
        <!-- Connected 4-Step Flow -->
        <section class="flow-section" aria-labelledby="flow-heading">
            <div class="flow-mast">
                <h2 id="flow-heading" class="section-heading">Request Execution Flow</h2>
                <p class="section-sublead">
                    In Laravel, each user action follows an explicit Model-View-Controller path backed by Eloquent ORM:
                </p>
            </div>

            <ol class="staggered-flow-rail" role="list">
                <li class="flow-node step-odd">
                    <div class="node-track" aria-hidden="true">
                        <span class="oversized-num">01</span>
                        <div class="track-line"></div>
                    </div>
                    <div class="node-card">
                        <div class="node-kicker">STAGE 01 &bull; INGRESS</div>
                        <strong class="flow-step-title">1. Incoming URL</strong>
                        <p class="flow-step-text">The browser issues an HTTP GET request to a path such as <code>/customers</code> or <code>/users</code>.</p>
                    </div>
                </li>

                <li class="flow-node step-even">
                    <div class="node-track" aria-hidden="true">
                        <span class="oversized-num">02</span>
                        <div class="track-line"></div>
                    </div>
                    <div class="node-card">
                        <div class="node-kicker">STAGE 02 &bull; DISPATCH</div>
                        <strong class="flow-step-title">2. Route Matching</strong>
                        <p class="flow-step-text">The router in <code>routes/web.php</code> resolves the URL to a specific controller and action method.</p>
                    </div>
                </li>

                <li class="flow-node step-odd">
                    <div class="node-track" aria-hidden="true">
                        <span class="oversized-num">03</span>
                        <div class="track-line"></div>
                    </div>
                    <div class="node-card">
                        <div class="node-kicker">STAGE 03 &bull; PROCESS &amp; ORM</div>
                        <strong class="flow-step-title">3. Eloquent Model Query</strong>
                        <p class="flow-step-text">The controller method invokes Eloquent ORM models (<code>Customer::all()</code>, <code>User::all()</code>) to retrieve database records and passes them to the Blade view renderer.</p>
                    </div>
                </li>

                <li class="flow-node step-even">
                    <div class="node-track" aria-hidden="true">
                        <span class="oversized-num">04</span>
                        <div class="track-terminal"></div>
                    </div>
                    <div class="node-card">
                        <div class="node-kicker">STAGE 04 &bull; RESPONSE</div>
                        <strong class="flow-step-title">4. View Presentation</strong>
                        <p class="flow-step-text">The Blade view iterates through Eloquent collections with <code>@@foreach</code>, applies HTML escaping, and returns the finished response to the client.</p>
                    </div>
                </li>
            </ol>
        </section>

        <!-- Contrasting Implementation Note -->
        <aside class="storage-dispatch-memo" aria-labelledby="memo-heading">
            <div class="memo-mast">
                <div class="memo-top-row">
                    <span class="memo-stamp">ARCHITECTURAL MEMORANDUM</span>
                    <span class="memo-ref">REF // TFA6-ELOQUENT</span>
                </div>
                <h2 id="memo-heading" class="memo-title">Data Architecture: From Arrays to Eloquent</h2>
            </div>
            <div class="memo-content">
                <p class="memo-lead">
                    In TFA6, temporary static arrays have been replaced with full database persistence. Laravel migrations define strict DDL schemas for the <code>customers</code> and <code>users</code> tables, database seeders populate realistic sample records, and Eloquent models wrap table records into expressive PHP objects.
                </p>
                <div class="memo-meta-ledger">
                    <div class="ledger-row">
                        <span class="ledger-term">Storage Mechanism:</span>
                        <span class="ledger-value">Relational Database via Eloquent ORM</span>
                    </div>
                    <div class="ledger-row">
                        <span class="ledger-term">Schema Definition:</span>
                        <span class="ledger-value">Laravel Migrations (customers &amp; users)</span>
                    </div>
                    <div class="ledger-row">
                        <span class="ledger-term">Data Seeding:</span>
                        <span class="ledger-value">CustomerSeeder &amp; UserSeeder</span>
                    </div>
                    <div class="ledger-row">
                        <span class="ledger-term">Active Models:</span>
                        <span class="ledger-value">App\Models\Customer &amp; App\Models\User</span>
                    </div>
                </div>
            </div>
        </aside>
    </div>
</div>
@endsection
