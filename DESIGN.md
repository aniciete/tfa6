---
name: POS Eloquent
description: Artisan Market & Retail Docket Design System for High-Speed POS Cashiers
colors:
  primary: "#173c2a"
  primary-hover: "#0f281c"
  accent: "#c94c38"
  accent-hover: "#b33e2c"
  neutral-bg: "#fff8e8"
  surface: "#fffdf7"
  surface-subtle: "#f5eedc"
  border: "#e6dcbe"
  text: "#173c2a"
  text-muted: "#425849"
  text-inverse: "#fff8e8"
  sage: "#3f5947"
  sage-surface: "#e2ede4"
typography:
  display:
    fontFamily: "Bricolage Grotesque, -apple-system, sans-serif"
    fontSize: "clamp(1.75rem, 4vw, 2.5rem)"
    fontWeight: 700
    lineHeight: 1.15
    letterSpacing: "-0.02em"
  body:
    fontFamily: "Bricolage Grotesque, -apple-system, sans-serif"
    fontSize: "1rem"
    fontWeight: 400
    lineHeight: 1.5
    letterSpacing: "normal"
  mono:
    fontFamily: "IBM Plex Mono, ui-monospace, monospace"
    fontSize: "0.9375rem"
    fontWeight: 500
    lineHeight: 1.4
    letterSpacing: "-0.01em"
rounded:
  sm: "2px"
  md: "4px"
  lg: "8px"
spacing:
  xs: "4px"
  sm: "8px"
  md: "16px"
  lg: "24px"
  xl: "32px"
components:
  button-primary:
    backgroundColor: "{colors.primary}"
    textColor: "{colors.text-inverse}"
    rounded: "{rounded.md}"
    padding: "10px 20px"
  button-primary-hover:
    backgroundColor: "{colors.primary-hover}"
  button-accent:
    backgroundColor: "{colors.accent}"
    textColor: "{colors.text-inverse}"
    rounded: "{rounded.md}"
    padding: "10px 20px"
  button-accent-hover:
    backgroundColor: "{colors.accent-hover}"
  badge-category:
    backgroundColor: "{colors.sage-surface}"
    textColor: "{colors.sage}"
    rounded: "{rounded.sm}"
    padding: "4px 8px"
---

## Overview

POS Eloquent employs the **Bright-Market Design System**: a tactile, high-contrast, artisan market docket aesthetic. The interface is optimized strictly for **Surface Mode: Operate**, prioritizing rapid catalog scanability, instant item discovery, and error-free transactional calculations.

**The Ledger Rule.** Treat the entire viewport as a physical shopkeeper's ledger: warm cream paper stock background (`#fff8e8`), deep basil ink (`#173c2a`), and purposeful tomato stamp accents (`#c94c38`). Digital abstractions like glassmorphism, heavy drop-shadows, and purple gradients are banned.

## Colors

- **Primary (`#173c2a`, Deep Basil)**: Used for primary brand markers, navigation bars, primary submit actions, and strong boundary borders. Represents stability and authority.
- **Accent (`#c94c38`, Tomato Red)**: Used sparingly for high-consequence interactive triggers (Checkout, Add to Cart, active focus rings, and transaction alerts).
- **Neutral Background (`#fff8e8`, Warm Cream)**: Page background providing warm, paper-like illumination that reduces eye fatigue under continuous cashier usage.
- **Surface (`#fffdf7`) & Subtle (`#f5eedc`)**: Container surfaces providing clear visual separation without heavy drop-shadows.
- **Border (`#e6dcbe`, Ledger Cream)**: 1px divider lines delineating table rows, filter tabs, and cart boundaries.
- **Text Primary (`#173c2a`) & Text Muted (`#425849`)**: High-contrast typographic hierarchy ensuring 100% WCAG AA compliance.

## Typography

Typography pairs self-hosted variable **Bricolage Grotesque** with monospace **IBM Plex Mono**:

- **Bricolage Grotesque** is used for page headers, catalog item titles, and navigation labels. Tight letter-spacing (`-0.02em`) gives headlines a crisp, vintage-printed editorial weight.
- **IBM Plex Mono** is mandatory for all numbers, prices, SKUs, inventory counts, dockets, and receipt line items.

**The Tabular Rule.** Every monetary amount (e.g. `₱1,250.00`), calculation subtotal, or quantity incrementor must be set with `font-variant-numeric: tabular-nums` and right-aligned. Proportional numbers in ledger columns are forbidden.

## Layout

- **Grid System**: 12-column responsive layout with a fixed max-width container (`1280px`).
- **POS Split View**: On desktop displays (`>= 1024px`), the viewport divides into a flexible 8-column product catalog and a dedicated 4-column sticky cart/order ledger.
- **Touch-Friendly Density**: Minimum click/tap hit target is `44px` height across all search inputs, category filter pills, quantity steppers, and action buttons.

## Elevation & Depth

- **Zero Artificial Elevation**: No multi-layered blurry drop-shadows (`box-shadow: 0 20px 25px rgba(...)`).
- **Tactile Ink Stamping**: Subtle paper depth is achieved using crisp 1px borders (`border: 1px solid var(--border-subtle)`) and hard 1-2px offset stamps (`box-shadow: 0 1px 2px rgba(23, 60, 42, 0.08)`).
- **Physical Press Feedback**: Active buttons depress by `1px` (`transform: translateY(1px)`) on click/tap to convey tangible physical feedback.

## Shapes

- **Corner Radii**: Restrained radii (`2px` on badges, `4px` on input fields and buttons, `8px` on main ledger containers).
- **Focus Rings**: Universal `:focus-visible` ring using `2px solid #c94c38` with `2px` offset, ensuring total keyboard navigability without interfering with mouse clicks.

## Components

### Product Cards
- Contained in 1px `#e6dcbe` border with `#fffdf7` background.
- Clear separation between product imagery, category badge, and title.
- Monospace price highlighted in bold basil or tomato accent.
- Single-tap "Add to Cart" button spanning full card width or positioned as a prominent tactile action.

### Order Docket / Cart Ledger
- Rendered with a serrated or clean paper border motif (`border-top: 2px dashed #cadbc7`).
- Line items list item name, quantity stepper (`-`, count, `+`), unit price, and extended subtotal.
- Prominent total calculation block with tax breakdown.

### Filter Pills & Search
- Real-time search input with clear prefix icon, instant clear (`×`) button, and zero layout shift.
- Category pills styled with muted sage surfaces (`#e2ede4`), shifting to deep basil (`#173c2a`) with cream text when active.

## Do's and Don'ts

### Do's
- **Do** format all prices with exact currency symbols, two decimal places, and tabular monospace font.
- **Do** preserve the warm cream background and deep basil palette on every page.
- **Do** provide immediate visual feedback upon adding an item to the cart (brief highlight or count update).
- **Do** ensure the receipt print stylesheet (`@media print`) formats perfectly on standard 80mm roll paper and Letter/A4 sheets.

### Don'ts
- **Don't** use generic purple, indigo, or cyan gradients.
- **Don't** nest cards within cards; use clean border dividers or subtle background shifts instead.
- **Don't** use low-contrast light gray placeholder text on white.
- **Don't** use unstyled browser alert dialogs; render inline notifications or structured alert boxes.
