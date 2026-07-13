# Le_Almmora — Project Blueprint

## 1. Project Identity

**Project Name:** Le_Almmora

**Project Type:** Premium brand and service website

**Website Direction:**
A modern, luxurious and highly visual website inspired by Maldives resorts, tropical destinations and premium lifestyle experiences.

The website may use selected layout characteristics commonly found in modern e-commerce websites, such as strong visual sections, cards, galleries and service highlights. However, it must not feel like a conventional online store.

Le_Almmora should feel like a premium digital brand experience rather than a product catalogue.

---

## 2. Project Vision

Le_Almmora aims to create an elegant digital experience that communicates luxury, comfort, exclusivity and trust.

The website should immediately give visitors the feeling of:

* A premium island destination
* Calm ocean surroundings
* Personalized luxury service
* Modern hospitality
* Exclusive experiences
* Professional and trustworthy service

The experience should feel visually rich but remain clean, modern and easy to navigate.

---

## 3. Primary Website Goals

The primary goals of the website are:

1. Introduce the Le_Almmora brand clearly.
2. Communicate the company’s premium positioning.
3. Present the available services, experiences or offerings.
4. Build customer confidence and trust.
5. Encourage visitors to make an enquiry.
6. Encourage visitors to contact the company through WhatsApp or an enquiry form.
7. Create a memorable and premium digital experience.
8. Support future expansion into additional pages, services and content.

---

## 4. Target Audience

The website is designed for customers who value:

* Premium experiences
* Luxury travel
* Private and exclusive services
* Beautiful destinations
* Comfort and convenience
* High-quality customer service
* Personalized arrangements
* Modern and trustworthy brands

Possible customer segments include:

* Couples
* Honeymoon travellers
* Families
* Premium leisure travellers
* Corporate customers
* International visitors
* Customers looking for exclusive travel experiences
* Customers planning special occasions

---

## 5. Brand Personality

Le_Almmora should communicate the following personality:

* Luxurious
* Calm
* Elegant
* Modern
* Exclusive
* Warm
* Trustworthy
* Refined
* Professional
* Aspirational

The brand must not feel:

* Cheap
* Crowded
* Aggressive
* Overly commercial
* Similar to a marketplace
* Similar to a discount travel website
* Outdated
* Generic
* Visually noisy

---

## 6. Visual Direction

The visual direction is inspired by:

* Maldives resorts
* Clear blue ocean water
* Bright tropical skies
* Warm sunlight
* Golden sunset tones
* White resort architecture
* Private villas
* Premium hospitality
* Soft natural textures
* Contemporary SaaS website presentation

The website should combine:

* Luxury hospitality visuals
* Modern SaaS-style layouts
* Spacious section design
* Large typography
* Smooth transitions
* Elegant cards
* Subtle glass effects
* High-quality photography
* Refined motion design

---

## 7. Colour Direction

The visual colour direction should mainly use:

### Ocean Blue

Used for the main brand identity, links, interactive elements and selected backgrounds.

Suggested direction:

* Clear sky blue
* Turquoise blue
* Deep ocean blue
* Soft aqua tones

### Warm Gold

Used selectively for premium highlights, icons, borders and important visual details.

Gold should not be overused.

### White and Off-White

Used for clean backgrounds, spacing and premium visual balance.

### Deep Navy

Used for headings, footer areas and stronger visual contrast.

### Sand and Cream

Used as optional supporting colours to create warmth and a luxury resort atmosphere.

All final colour values will be defined in the Design System document.

---

## 8. Design Principles

Every page and component should follow these principles:

### 8.1 Premium Simplicity

The interface should feel luxurious through spacing, typography, photography and details—not through excessive decoration.

### 8.2 Visual Storytelling

The website should use images, layout and animation to tell the Le_Almmora story.

### 8.3 Clear User Journey

Visitors should always understand:

* What Le_Almmora offers
* Why it is special
* What they should explore next
* How they can make an enquiry

### 8.4 Consistency

Colours, fonts, buttons, cards, spacing and animations must remain consistent across the website.

### 8.5 Mobile-First Responsiveness

Every section must work properly on:

* Desktop
* Laptop
* Tablet
* Mobile phone

### 8.6 Performance Awareness

Animations and large images must be optimized so the website remains smooth and reasonably fast.

### 8.7 Accessibility

Text must remain readable, buttons must be clear and interactive elements must be usable with keyboard and touch input.

---

## 9. Homepage Purpose

The homepage should function as the main introduction to Le_Almmora.

It should not immediately feel like an online shop.

Instead, it should guide the visitor through a premium brand story:

1. Introduce the brand.
2. Present the main experience.
3. Explain the value proposition.
4. Showcase key services or destinations.
5. Build trust.
6. Present social proof.
7. Encourage enquiry or contact.

The homepage should feel immersive, modern and emotionally engaging.

---

## 10. Proposed Homepage Journey

The initial homepage may include:

1. Navigation Header
2. Hero Section
3. Brand Introduction
4. Featured Experiences
5. Why Choose Le_Almmora
6. Destination or Service Showcase
7. Premium Experience Section
8. Visual Gallery
9. Customer Testimonials
10. Trust or Achievement Section
11. Frequently Asked Questions
12. Final Enquiry Call-to-Action
13. Footer

The exact content and component structure will be defined in `03-homepage.md`.

---

## 11. Interaction and Animation Direction

Animations should improve the premium experience without becoming distracting.

Preferred animation types:

* Soft fade-in
* Fade-up reveal
* Image scale reveal
* Text mask reveal
* Subtle parallax
* Slow floating elements
* Smooth card hover
* Button micro-interactions
* Section transitions
* Smooth scrolling
* Elegant navigation transitions

Animations should not:

* Make the website difficult to use
* Delay important content unnecessarily
* Feel like a gaming website
* Use excessive bouncing
* Use random effects
* Reduce mobile performance

Detailed motion rules will be defined in `04-animation.md`.

---

## 12. Technical Environment

The current project is based on an existing local Laravel system.

Expected technologies may include:

* PHP
* Laravel
* Blade Templates
* HTML5
* CSS or SCSS
* JavaScript
* Laravel Mix
* Existing Bootstrap or frontend libraries
* Existing project assets

Before introducing new libraries, the existing project structure and dependencies must be inspected.

Do not automatically replace the current frontend framework.

Do not automatically migrate the project to Tailwind CSS, React, Vue or another framework unless explicitly approved.

The redesign should first work safely within the existing application.

---

## 13. Development Rules

All development work must follow these rules:

1. Never develop directly on the `main` branch.
2. Homepage redesign work must remain on `feature/homepage-redesign`.
3. Do not merge into `main` without review.
4. Do not delete existing functionality without approval.
5. Do not modify backend business logic unless necessary.
6. Do not modify database structure during the design phase.
7. Reuse existing Laravel routes and controller logic where practical.
8. Back up or preserve existing templates before replacing them.
9. Avoid unnecessary dependencies.
10. Maintain responsive behaviour.
11. Keep the code readable and organized.
12. Explain major structural changes before implementing them.
13. Commit meaningful milestones separately.
14. Never commit `.env`, uploaded customer files, logs or database backups.

---

## 14. AI Development Rules

Claude Code or any other coding agent must:

1. Read the documentation inside the `/docs` directory first.
2. Inspect the existing project before editing files.
3. Identify the current frontend framework and asset structure.
4. Confirm the existing homepage route and Blade template.
5. Work only on the active feature branch.
6. Never merge into `main`.
7. Avoid changing unrelated files.
8. Preserve existing backend functionality.
9. Use reusable components where practical.
10. Follow the approved Design System.
11. Follow the approved Homepage Specification.
12. Follow the approved Animation Guidelines.
13. Provide a summary of files changed.
14. Run available checks before completing a task.
15. Clearly report any uncertainty or risk.

---

## 15. Initial Project Scope

The first development scope is:

### Phase 1 — Discovery

* Inspect the existing Laravel project
* Identify the current homepage
* Identify relevant routes and controllers
* Identify current CSS, SCSS and JavaScript systems
* Identify reusable assets and components
* Identify technical risks

### Phase 2 — Foundation

* Create the Design System
* Define reusable components
* Define homepage structure
* Define animation rules
* Define responsive behaviour

### Phase 3 — Homepage Development

* Build the new homepage
* Integrate approved visual assets
* Add responsive layouts
* Add interactions
* Add animations
* Preserve existing functionality

### Phase 4 — Quality Control

* Review desktop layout
* Review tablet layout
* Review mobile layout
* Check broken links
* Check JavaScript errors
* Check console errors
* Check image performance
* Check accessibility basics
* Check existing Laravel functions

---

## 16. Out of Scope for the Initial Phase

The following are not automatically included in the first homepage redesign phase:

* Backend system redevelopment
* Database restructuring
* Member system redevelopment
* Payment gateway changes
* Checkout redevelopment
* Admin panel redevelopment
* Full e-commerce redevelopment
* Mobile application development
* API redevelopment
* Server deployment
* Production database migration

These items require separate approval and separate feature branches.

---

## 17. Definition of Success

The initial homepage redesign is successful when:

* Visitors can immediately understand Le_Almmora.
* The homepage feels premium and modern.
* The design reflects the Maldives-inspired direction.
* The website does not feel like a generic e-commerce template.
* The website works properly on desktop and mobile.
* Existing important Laravel functions remain operational.
* Enquiry actions are clear.
* Animations feel smooth and professional.
* The code is maintainable.
* The homepage can be safely reviewed before merging into `main`.

---

## 18. Current Git Structure

Stable branch:

```text
main
```

Active development branch:

```text
feature/homepage-redesign
```

All current homepage design and development work must remain on:

```text
feature/homepage-redesign
```

---

## 19. Documentation Roadmap

The project documentation will include:

```text
docs/
├── 01-project.md
├── 02-design-system.md
├── 03-homepage.md
├── 04-animation.md
└── 05-components.md
```

Purpose of each document:

* `01-project.md` — Project identity, goals and development rules
* `02-design-system.md` — Colours, typography, spacing and UI styling
* `03-homepage.md` — Homepage sections, content and responsive behaviour
* `04-animation.md` — Motion system and interaction guidelines
* `05-components.md` — Reusable buttons, cards, navigation and sections

---

## 20. Final Direction

Le_Almmora must be built as a premium digital experience.

Every design and development decision should support:

* Luxury
* Trust
* Calmness
* Exclusivity
* Modern presentation
* Clear enquiry conversion
* Long-term maintainability
