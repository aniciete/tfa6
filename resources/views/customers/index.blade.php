@extends('layouts.app')

@section('content')
<div class="directory-container">
    <header class="directory-header">
        <h1 class="page-title">Customer Accounts</h1>
        <p class="page-lead">
            Registered retail and commercial client profiles retrieved through the <code>Customer</code> Eloquent ORM model. Total Records: {{ count($customers) }}.
        </p>
    </header>

    <div class="table-container" tabindex="0" role="region" aria-label="Customer accounts directory">
        <table class="data-table">
            <thead>
                <tr>
                    <th scope="col" class="th-num">#</th>
                    <th scope="col">Full Name</th>
                    <th scope="col">Email Address</th>
                    <th scope="col">Phone Number</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($customers as $index => $customer)
                    <tr>
                        <td class="td-num" data-label="#">{{ sprintf('%02d', $index + 1) }}</td>
                        <td class="cell-primary" data-label="Full Name">{{ $customer->full_name ?? $customer['full_name'] }}</td>
                        <td class="cell-email" data-label="Email Address">
                            <a href="mailto:{{ $customer->email ?? $customer['email'] }}" class="table-link">{{ $customer->email ?? $customer['email'] }}</a>
                        </td>
                        <td class="cell-mono tabular-num" data-label="Phone Number">{{ $customer->phone ?? $customer['phone'] }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
