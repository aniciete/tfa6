@extends('layouts.app')

@section('content')
<div class="about-container">
    <header class="about-header">
        <h1 class="page-title">About This Application</h1>
        <p class="page-lead">
            Technical Formative Assessment 6 demonstrates the architectural transition from static arrays to Laravel's Eloquent ORM, database migrations, model seeders, and relational query abstraction.
        </p>
    </header>

    <section class="content-section" aria-labelledby="flow-heading">
        <h2 id="flow-heading" class="section-title">Request Execution Flow</h2>
        <p class="section-lead">
            In Laravel, incoming browser requests follow an explicit Model-View-Controller path using Eloquent ORM:
        </p>

        <ol class="flow-list">
            <li class="flow-item">
                <div class="flow-marker">1</div>
                <div class="flow-content">
                    <h3 class="flow-step-title">Incoming URL</h3>
                    <p class="flow-step-text">The browser issues an HTTP GET request to an application endpoint such as <code>/customers</code> or <code>/users</code>.</p>
                </div>
            </li>

            <li class="flow-item">
                <div class="flow-marker">2</div>
                <div class="flow-content">
                    <h3 class="flow-step-title">Route Matching</h3>
                    <p class="flow-step-text">The router in <code>routes/web.php</code> intercepts the request and matches the URI to its registered controller action.</p>
                </div>
            </li>

            <li class="flow-item">
                <div class="flow-marker">3</div>
                <div class="flow-content">
                    <h3 class="flow-step-title">Eloquent Model Query</h3>
                    <p class="flow-step-text">The controller executes queries through the corresponding Eloquent model (e.g. <code>Customer::all()</code>), retrieving active record instances.</p>
                </div>
            </li>

            <li class="flow-item">
                <div class="flow-marker">4</div>
                <div class="flow-content">
                    <h3 class="flow-step-title">View Presentation</h3>
                    <p class="flow-step-text">The controller passes data collections into Blade templates, compiling semantic HTML for the browser response.</p>
                </div>
            </li>
        </ol>
    </section>

    <section class="content-section" aria-labelledby="comparison-heading">
        <h2 id="comparison-heading" class="section-title">Data Architecture: From Arrays to Eloquent</h2>
        <p class="section-lead">
            Comparison between in-memory arrays (TFA5) and relational persistence via <code>App\Models\User</code> and <code>App\Models\Customer</code>:
        </p>

        <div class="comparison-grid">
            <div class="code-column">
                <h3 class="code-title">Phase 01: In-Memory Arrays (TFA5)</h3>
                <pre class="code-block"><code>// CustomerController.php (TFA5)
public function index()
{
    $customers = [
        ['id' => 1, 'full_name' => 'Maria Santos', 'email' => 'maria@example.com'],
        ['id' => 2, 'full_name' => 'Juan Dela Cruz', 'email' => 'juan@example.com'],
    ];

    return view('customers.index', compact('customers'));
}</code></pre>
            </div>

            <div class="code-column">
                <h3 class="code-title">Phase 02: Relational Eloquent ORM (TFA6)</h3>
                <pre class="code-block"><code>// CustomerController.php (TFA6)
use App\Models\Customer;

public function index()
{
    // Queries relational 'customers' table via PDO
    $customers = Customer::all();

    return view('customers.index', compact('customers'));
}</code></pre>
            </div>
        </div>
    </section>
</div>
@endsection
