@extends('layouts.app')

@section('content')
<div class="directory-container">
    <header class="directory-header">
        <h1 class="page-title">User Accounts</h1>
        <p class="page-lead">
            Operational personnel, cashiers, and administrators retrieved through the <code>User</code> Eloquent ORM model. Total Users: {{ count($users) }}.
        </p>
    </header>

    <div class="table-container" tabindex="0" role="region" aria-label="Staff user accounts directory">
        <table class="data-table">
            <thead>
                <tr>
                    <th scope="col" class="th-num">#</th>
                    <th scope="col">Username</th>
                    <th scope="col">Full Name</th>
                    <th scope="col">System Role</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($users as $index => $user)
                    @php
                        $username = $user->username ?? $user['username'];
                        $fullName = $user->full_name ?? $user['full_name'];
                        $role = $user->role ?? $user['role'] ?? 'Staff Member';
                        $roleKey = strtolower(explode(' ', $role)[0]);
                    @endphp
                    <tr>
                        <td class="td-num" data-label="#">{{ sprintf('%02d', $index + 1) }}</td>
                        <td class="cell-mono tabular-num" data-label="Username">{{ $username }}</td>
                        <td class="cell-primary" data-label="Full Name">{{ $fullName }}</td>
                        <td class="cell-role" data-label="System Role">
                            <span class="role-badge role-{{ $roleKey }}">{{ $role }}</span>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
