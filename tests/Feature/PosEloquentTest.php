<?php

namespace Tests\Feature;

use App\Models\Customer;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PosEloquentTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Seed the database before each test to simulate runtime state.
     */
    protected function setUp(): void
    {
        parent::setUp();
        $this->seed();
    }

    /**
     * Test the landing page responds with HTTP 200 and renders hero landmarks and navigation.
     */
    public function test_home_page_returns_ok_and_displays_elements(): void
    {
        $response = $this->get('/');

        $response->assertOk();
        $response->assertSee('Point-of-Sale Eloquent');
        $response->assertSee('Customer Accounts');
        $response->assertSee('User Accounts');
        $response->assertSee('About');
        $response->assertSee('aria-current="page"', false);

        // Extended assertions for Bright-Market layout and landmarks
        $response->assertSee('Skip to main content');
        $response->assertSee('href="#main-content"', false);
        $response->assertSee('role="banner"', false);
        $response->assertSee('role="main"', false);
        $response->assertSee('role="contentinfo"', false);
        $response->assertSee('01');
        $response->assertSee('Eloquent Models');
        $response->assertSee('assets/css/style.css');
        $response->assertSee('favicon.svg');
    }

    /**
     * Test the about page responds with HTTP 200 and presents the Eloquent MVC flow and storage memo.
     */
    public function test_about_page_returns_ok_and_displays_eloquent_architecture(): void
    {
        $response = $this->get('/about');

        $response->assertOk();
        $response->assertSee('About This Application');
        $response->assertSee('Request Execution Flow');
        $response->assertSee('Data Architecture: From Arrays to Eloquent');
        $response->assertSee('Eloquent ORM');
        $response->assertSee('aria-current="page"', false);

        // Extended assertions for landmarks and connected 4-step flow
        $response->assertSee('Skip to main content');
        $response->assertSee('02');
        $response->assertSee('1. Incoming URL');
        $response->assertSee('2. Route Matching');
        $response->assertSee('3. Eloquent Model Query');
        $response->assertSee('4. View Presentation');
        $response->assertSee('ARCHITECTURAL MEMORANDUM');
        $response->assertSee('App\Models\Customer');
        $response->assertSee('App\Models\User');
    }

    /**
     * Test the customer accounts page responds with HTTP 200 and renders records retrieved via Eloquent.
     */
    public function test_customers_page_returns_ok_and_displays_eloquent_records(): void
    {
        $response = $this->get('/customers');

        $response->assertOk();
        $response->assertSee('Customer Accounts');
        $response->assertSee('Total Records');
        $response->assertSee('Eloquent ORM');
        $response->assertSee('Elena Rostova');
        $response->assertSee('elena.rostova@example.com');
        $response->assertSee('+1 (555) 234-5678');
        $response->assertSee('Marcus Vance');
        $response->assertSee('Aria Thorne');
        $response->assertSee('Julian Mercer');
        $response->assertSee('Sophia Lin');
        $response->assertSee('<table class="data-table">', false);
        $response->assertSee('scope="col"', false);

        // Extended assertions for responsive data-labels and record count
        $response->assertSee('Skip to main content');
        $response->assertSee('aria-current="page"', false);
        $response->assertSee('data-label="Full Name"', false);
        $response->assertSee('data-label="Email Address"', false);
        $response->assertSee('data-label="Phone Number"', false);
        $response->assertSee('data-label="#"', false);
        $response->assertSee('stat-giant');
    }

    /**
     * Test the user accounts page responds with HTTP 200 and renders staff records retrieved via Eloquent.
     */
    public function test_users_page_returns_ok_and_displays_eloquent_records(): void
    {
        $response = $this->get('/users');

        $response->assertOk();
        $response->assertSee('User Accounts');
        $response->assertSee('Total Users');
        $response->assertSee('Eloquent ORM');
        $response->assertSee('admin.reyes');
        $response->assertSee('Carlos Reyes');
        $response->assertSee('Store Administrator');
        $response->assertSee('mgr.castro');
        $response->assertSee('Beatriz Castro');
        $response->assertSee('cashier.valdez');
        $response->assertSee('cashier.santos');
        $response->assertSee('inv.navarro');
        $response->assertSee('<table class="data-table">', false);
        $response->assertSee('scope="col"', false);

        // Extended assertions for responsive data-labels and role badges
        $response->assertSee('Skip to main content');
        $response->assertSee('aria-current="page"', false);
        $response->assertSee('data-label="Username"', false);
        $response->assertSee('data-label="Full Name"', false);
        $response->assertSee('data-label="System Role"', false);
        $response->assertSee('role-badge');
        $response->assertSee('stat-giant');
    }

    /**
     * Test that database seeders populate at least 5 sample records in both tables.
     */
    public function test_seeders_populate_minimum_five_records_per_table(): void
    {
        $customerCount = Customer::count();
        $userCount = User::count();

        $this->assertGreaterThanOrEqual(5, $customerCount, 'The customers table must contain at least 5 seeded records.');
        $this->assertGreaterThanOrEqual(5, $userCount, 'The users table must contain at least 5 seeded records.');
    }

    /**
     * Test Eloquent model CRUD and attribute casting behavior.
     */
    public function test_eloquent_models_function_properly(): void
    {
        $newCustomer = Customer::create([
            'full_name' => 'Test Customer',
            'email'     => 'test.customer@example.com',
            'phone'     => '+1 (555) 000-1111',
        ]);
        $this->assertDatabaseHas('customers', [
            'email' => 'test.customer@example.com',
        ]);
        $this->assertInstanceOf(\Illuminate\Support\Carbon::class, $newCustomer->created_at);

        $newUser = User::create([
            'username'  => 'test.user',
            'full_name' => 'Test Operator',
            'role'      => 'Auditor',
        ]);
        $this->assertDatabaseHas('users', [
            'username' => 'test.user',
        ]);
        $this->assertInstanceOf(\Illuminate\Support\Carbon::class, $newUser->created_at);
    }

    /**
     * Test that static assets, stylesheets, and fonts exist on the filesystem.
     */
    public function test_local_assets_and_fonts_exist(): void
    {
        $publicPath = public_path() . '/';
        $this->assertFileExists($publicPath . 'assets/css/style.css');
        $this->assertFileExists($publicPath . 'favicon.svg');
        $this->assertFileExists($publicPath . 'assets/fonts/bricolage-grotesque-latin.woff2');
        $this->assertFileExists($publicPath . 'assets/fonts/ibm-plex-mono-400.woff2');
        $this->assertFileExists($publicPath . 'assets/fonts/ibm-plex-mono-500.woff2');
        $this->assertFileExists($publicPath . 'assets/fonts/ibm-plex-mono-600.woff2');
    }

    /**
     * Test that an unmapped route returns HTTP 404.
     */
    public function test_undefined_route_returns_404(): void
    {
        $response = $this->get('/non-existent-pos-route-404');
        $response->assertStatus(404);
    }
}
