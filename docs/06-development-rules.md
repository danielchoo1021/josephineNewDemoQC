# Le_Almmora Development Rules

Version: 1.0

---

# Objective

This document defines the coding standards and development rules for the Le_Almmora homepage.

Every implementation must follow these rules.

Priority

Design

↓

Performance

↓

Maintainability

↓

Scalability

---

# Technology Stack

Backend

Laravel

Frontend

Blade

SCSS

Vanilla JavaScript

Webpack Mix

Do NOT introduce unnecessary frameworks.

---

# Folder Structure

resources/

views/

partial/

frontend/

homepage/

hero.blade.php

about.blade.php

features.blade.php

destinations.blade.php

gallery.blade.php

experience.blade.php

testimonials.blade.php

faq.blade.php

cta.blade.php

footer.blade.php

---

# SCSS Structure

resources/sass/

le-almmora-home.scss

base/

variables

typography

utilities

layout/

components/

pages/

animations/

responsive/

Each SCSS file should have a single responsibility.

---

# JavaScript Structure

resources/js/

le-almmora-home.js

Modules

Navbar

Hero

Parallax

Gallery

Counter

Scroll Reveal

Intersection Observer

Each module should be independent.

---

# Blade Rules

One section = One Blade file.

Avoid duplicated HTML.

Use @include whenever possible.

Never place the entire homepage inside one Blade.

---

# CSS Rules

No inline CSS.

No !important.

Use Design Tokens.

Keep selector nesting shallow.

Prefer Flexbox.

Use Grid where appropriate.

Avoid fixed heights unless required.

---

# JavaScript Rules

Use Vanilla JavaScript.

Avoid jQuery.

Use requestAnimationFrame for animations.

Use IntersectionObserver for scroll detection.

Debounce resize events.

Throttle scroll events.

---

# Naming Convention

Prefix all custom classes.

Example

la-navbar

la-button

la-card

la-gallery

Avoid generic names.

---

# Images

Use WebP whenever possible.

Enable lazy loading.

Always define width and height.

Use object-fit.

Compress before deployment.

---

# Icons

Prefer SVG.

Avoid bitmap icons.

Icons should inherit CSS colors.

---

# Responsive Breakpoints

Desktop

1440+

Laptop

1200

Tablet

992

Mobile

768

Small Mobile

480

---

# Animation Rules

Prefer CSS animations.

GPU accelerated.

Avoid layout shift.

Animation duration

200ms

300ms

500ms

Maximum

800ms

---

# Accessibility

Semantic HTML.

Alt text required.

Visible keyboard focus.

Proper heading hierarchy.

Buttons must remain keyboard accessible.

---

# Performance

Target Lighthouse

90+

Minimize DOM nodes.

Avoid unnecessary wrappers.

Lazy load images.

Minify CSS.

Minify JS.

Avoid render blocking.

---

# Code Quality

Readable.

Reusable.

Maintainable.

Comment complex logic.

Remove unused code.

Avoid duplicated code.

---

# Git Workflow

Feature branch only.

Small commits.

Meaningful commit messages.

Review before merge.

---

# Testing

Desktop

Tablet

Mobile

Chrome

Edge

Safari

Firefox

Test every section after implementation.

---

# Final Rule

Do not sacrifice performance for visual effects.

Maintain a premium luxury experience while keeping the website lightweight.