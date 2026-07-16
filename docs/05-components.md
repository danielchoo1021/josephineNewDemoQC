# Le_Almmora Component Library

Version: 1.0

---

# Objective

This document defines all reusable UI components for the Le_Almmora website.

Every page should reuse these components instead of creating new styles.

Goals:

- Consistent UI
- Easy maintenance
- Reusable Blade Components
- Responsive
- Animation ready

---

# Global Rules

Border Radius

- Small : 8px
- Medium : 16px
- Large : 24px
- Pill : 999px

Spacing

- XS : 8px
- SM : 16px
- MD : 24px
- LG : 48px
- XL : 80px
- XXL : 120px

Shadow

Soft

```
0 15px 40px rgba(0,0,0,.08)
```

Hover

```
0 20px 60px rgba(0,0,0,.15)
```

Transition

```
300ms ease
```

---

# Navbar

Component Name

Navbar

Features

- Sticky
- Transparent on Hero
- White background after scrolling
- Glass effect
- Mobile responsive
- Dropdown support

Desktop

Logo Left

Navigation Center

CTA Button Right

Mobile

Logo

Hamburger

Fullscreen Menu

Hover

- Underline animation
- Gold color

---

# Hero Section

Includes

- Background Video
- Background Image Fallback
- Gradient Overlay
- Main Heading
- Subtitle
- CTA Buttons
- Scroll Indicator

Animation

Heading

Fade Up

Subtitle

Fade Up

Buttons

Fade Up

Background

Slow Zoom

---

# Primary Button

Style

Background

Gold Gradient

Text

White

Radius

999px

Padding

16px 32px

Hover

- Lift
- Glow
- Scale 1.03

Active

Scale 0.98

---

# Secondary Button

Background

Transparent

Border

White

Hover

White Background

Dark Text

---

# Ghost Button

Transparent

No Border

Underline on Hover

---

# Cards

All cards share

- Rounded corners
- Shadow
- Hover animation
- Overflow hidden

Types

Destination Card

Service Card

Feature Card

Gallery Card

Review Card

Blog Card

Hover

- Lift
- Shadow Increase
- Image Zoom

---

# Glass Card

Background

rgba(255,255,255,.12)

Blur

20px

Border

1px rgba(255,255,255,.2)

Radius

24px

---

# Booking Card

Contains

Destination

Check In

Check Out

Guests

Button

Desktop

Floating

Mobile

Full Width

---

# Section Title

Includes

Small Label

Main Heading

Description

Alignment

Center

or

Left

Spacing

48px Bottom

---

# Image Component

Radius

24px

Loading

Lazy

Hover

Zoom

Optional

Parallax

---

# Gallery Grid

Desktop

3-4 Columns

Tablet

2 Columns

Mobile

1 Column

Gap

24px

Hover

Zoom

Overlay

---

# Feature Item

Contains

Icon

Title

Description

Animation

Fade Up

---

# Statistics

Number

Large Font

Description

Small Font

Animation

Counter

---

# Testimonial Card

Avatar

Name

Country

Rating

Review

Hover

Lift

Shadow

---

# FAQ Accordion

Collapsed

Title Only

Expanded

Answer Visible

Animation

Height Transition

Icon

Rotate

---

# Forms

Input

Rounded

Glass Style

Focus

Gold Border

Validation

Red Border

Success

Green Border

---

# Footer

Contains

Logo

Quick Links

Destination Links

Social Icons

Newsletter

Copyright

Layout

Desktop

4 Columns

Mobile

Single Column

---

# Icons

Style

Outline

Size

20px

24px

32px

Color

Dark

White

Gold

Hover

Gold

---

# Animation Standards

Buttons

300ms

Cards

400ms

Sections

600ms

Images

Scale 1.05

Fade Up Distance

40px

---

# Responsive Rules

Desktop

1440px+

Laptop

1200px

Tablet

768px

Mobile

480px

Navbar becomes Hamburger below 992px.

Cards become single column on mobile.

Images always use object-fit: cover.

Buttons become full width on mobile when necessary.

---

# Accessibility

Minimum contrast ratio

WCAG AA

All buttons require hover and focus states.

All images require alt text.

Keyboard navigation supported.

---

# Blade Component Structure

Suggested Components

resources/views/components/

navbar.blade.php

hero.blade.php

button.blade.php

card.blade.php

glass-card.blade.php

booking-card.blade.php

section-title.blade.php

gallery.blade.php

testimonial.blade.php

faq.blade.php

footer.blade.php

---

# Development Rules

Do not hardcode colors.

Use Design Tokens.

Reuse components whenever possible.

Avoid duplicated CSS.

Every component should support responsive layouts.

Animations must be lightweight.

Performance first.

Consistency first.