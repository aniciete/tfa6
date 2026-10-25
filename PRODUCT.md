# Product

<!-- impeccable:product-schema 1 -->

## Platform

web

## Users

Retail cashiers, counter clerks, and store managers in an active store or market stall environment. Users operate at high speed under sustained transaction volume, frequently switching between barcode scanning, typing short search queries, selecting categories, adjusting line quantities, and tendering payments.

## Product Purpose

POS Eloquent is a Point of Sale (POS) system engineered to manage product catalogs, inventory categorization, real-time live search, transactional cart state, and printable docket generation. Success means zero-lag catalog lookup, immediate visual feedback on cart operations, accurate financial tabulation, and dependable transaction recording backed by Eloquent ORM.

## Positioning

Unlike generic web catalogs or demo e-commerce sites, POS Eloquent is built specifically as a rapid-action register interface. It pairs server-rendered Laravel 11 reliability with client-side instant responsiveness, self-hosted typography, and structured database migrations that run cleanly across both local MySQL and constrained shared-hosting environments (InfinityFree).

## Operating Context

- **Environment**: Active checkout counters, touchscreens, standard desktop monitors (1024px to 1920px), and mobile tablet registers.
- **Hardware**: Physical keyboards (with tab/enter navigation), barcode scanners emitting return strokes, and receipt/thermal printers.
- **Workflow**:
  1. Cashier identifies product via live query or category pill.
  2. Cashier adds item to cart or increments quantity.
  3. System recalculates subtotals, tax, and grand total using tabular numerals.
  4. Cashier reviews order, tenders payment, and generates printable docket.

## Capabilities and Constraints

- **Backend**: Laravel 11 with PHP 8.2+.
- **Database**: MySQL / MariaDB using Laravel migrations, seeders, and Eloquent models (`Product`, `Category`).
- **Catalog Capabilities**: Full CRUD on products and categories; instant live search across product names, SKUs, and descriptions; category filtering.
- **Cart & Checkout**: Session-persisted cart state with item addition, removal, quantity increment/decrement, and checkout ledger.
- **Receipt Printing**: Dedicated print stylesheet (`@media print`) rendering a clean, monospace merchant docket.
- **Hosting Constraints**: Compatible with InfinityFree / shared PHP hosting (Apache `.htaccess` rewrite rules, MySQL connection fallbacks).

## Brand Commitments

- **Identity**: "Bright-Market Design System" — modern artisan ledger aesthetic inspired by premium specialty grocers and typographic ledgers.
- **Palette**: Deep Basil (`#173c2a`), Warm Cream (`#faf6ee`), Ledger Sand (`#f0e9dc`), and Tomato Red (`#c94c38`).
- **Voice**: Functional, tactile, professional, and clear. Zero promotional filler.

## Evidence on Hand

- Complete Laravel 11 application source at [`/Users/charleslawrenceaniciete/Developer/tfa6`](file:///Users/charleslawrenceaniciete/Developer/tfa6).
- 100% passing PHPUnit feature and unit test suite covering all routes, cart mechanics, and Eloquent models.
- Production deployment live on InfinityFree: [`tfa6.freedev.app`](http://tfa6.freedev.app).

## Product Principles

1. **Every Millisecond Counts**: Cashier search and cart interactions must render instantly without layout shift.
2. **Numbers Never Lie**: All monetary figures, quantities, and totals must be right-aligned with fixed tabular spacing.
3. **High Density with Breathing Room**: Maximize visible catalog items and cart lines per viewport without visual overcrowding.
4. **Resilient Under Failure**: Graceful empty states, clear error notices, and reliable fallback handling when database connection stalls.

## Accessibility & Inclusion

- Keyboard navigability with prominent `:focus-visible` rings.
- Minimum tap/click target sizes of 44×44px for buttons and touch controls.
- Contrast ratios meeting WCAG AA standards (minimum 4.5:1 for body copy and interactive labels).
- Screen-reader accessible landmarks (`<header role="banner">`, `<main id="main-content">`, `<nav aria-label="Main Navigation">`, `<aside aria-label="Order Summary">`).
