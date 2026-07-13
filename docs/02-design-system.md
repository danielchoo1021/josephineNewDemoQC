# Le_Almmora — Design System

## 1. Purpose

This document defines the visual and interface rules for the Le_Almmora homepage redesign.

All homepage sections, components, animations and responsive layouts must follow this system.

The redesign must work within the existing Laravel 9 application, Bootstrap 4 structure and legacy frontend environment.

The design system must not introduce visual changes to unrelated pages.

---

## 2. Design Direction

Le_Almmora should combine:

* Luxury hospitality
* Maldives-inspired scenery
* Modern SaaS-style presentation
* Clean editorial layouts
* Premium resort atmosphere
* Spacious composition
* Smooth and refined interactions

The result should feel:

* Calm
* Premium
* Exclusive
* Modern
* Refined
* Trustworthy
* Aspirational

The result must not feel like:

* A discount marketplace
* A generic Bootstrap template
* A crowded e-commerce catalogue
* A gaming website
* A traditional corporate website
* A low-cost travel agency

---

## 3. Technical Design Constraints

The homepage redesign must respect the following technical constraints:

1. Bootstrap 4 remains the base layout framework.
2. Do not replace Bootstrap with Tailwind, React or another framework.
3. Do not modify `HomeController@index`.
4. Do not modify the homepage route.
5. Do not move homepage business logic into the Blade template.
6. Do not modify the database structure.
7. Do not place new homepage CSS inside `layouts/app.blade.php`.
8. Do not place new homepage JavaScript inside `layouts/app.blade.php`.
9. Load homepage-only CSS through the existing `@yield('css')` hook.
10. Load homepage-only JavaScript through the existing `@yield('js')` hook.
11. Scope all new homepage styles under a dedicated root class.
12. Preserve the existing bilingual content logic.
13. Reuse existing controller variables where practical.
14. Do not remove existing functionality without explicit approval.

Recommended homepage root wrapper:

```html
<main class="le-almmora-home">
    ...
</main>
```

All new styles should be scoped beneath:

```css
.le-almmora-home
```

Example:

```css
.le-almmora-home .la-hero {
    ...
}
```

Avoid broad global selectors such as:

```css
h1 {}
.container {}
.btn {}
.row {}
body {}
```

unless they are scoped under `.le-almmora-home`.

---

## 4. Brand Colour System

### 4.1 Primary Ocean Blue

**Primary Blue**

```text
#2F9FC6
```

Usage:

* Primary buttons
* Important links
* Section accents
* Icons
* Active navigation states
* Selected interface elements

**Ocean Deep**

```text
#0B3B4A
```

Usage:

* Main headings
* Dark backgrounds
* Footer sections
* High-contrast text
* Premium visual sections

**Aqua Light**

```text
#DDF5F8
```

Usage:

* Soft backgrounds
* Card highlights
* Decorative elements
* Section transitions

**Sky Mist**

```text
#F1FAFC
```

Usage:

* Main page background
* Alternating section backgrounds
* Calm visual spacing

---

### 4.2 Premium Gold

**Warm Gold**

```text
#D6AD55
```

Usage:

* Premium highlights
* Small icons
* Dividers
* Eyebrow text
* Selected borders
* Special labels

**Soft Gold**

```text
#F1DCA5
```

Usage:

* Background accents
* Subtle gradients
* Decorative shapes

Gold must be used selectively.

Do not use gold for large blocks of body text.

Do not apply gold to every button or every section.

---

### 4.3 Neutral Colours

**Pure White**

```text
#FFFFFF
```

**Warm White**

```text
#FCFAF6
```

**Sand**

```text
#F3EBDD
```

**Slate Text**

```text
#55636A
```

**Muted Text**

```text
#7C8A90
```

**Border Light**

```text
#DCE8EA
```

**Dark Text**

```text
#132F38
```

---

## 5. Colour Usage Ratio

Recommended visual balance:

```text
55% White / Warm White
25% Ocean / Aqua tones
15% Deep Navy / Dark Text
5% Gold accents
```

Gold must remain an accent colour.

Ocean blue should remain the strongest visual identity colour.

---

## 6. Gradient System

Gradients should remain subtle and premium.

### Ocean Gradient

```css
background: linear-gradient(
    135deg,
    #0B3B4A 0%,
    #176D86 55%,
    #2F9FC6 100%
);
```

### Aqua Mist Gradient

```css
background: linear-gradient(
    180deg,
    #FFFFFF 0%,
    #F1FAFC 100%
);
```

### Gold Glow

```css
background: radial-gradient(
    circle,
    rgba(214, 173, 85, 0.22) 0%,
    rgba(214, 173, 85, 0) 70%
);
```

Avoid:

* Neon gradients
* Highly saturated rainbow gradients
* Aggressive blue-purple SaaS gradients
* Excessive gradient text

---

## 7. Typography System

The project currently contains an existing frontend theme and global typography rules.

New fonts must not be introduced until existing font loading has been reviewed.

For the first homepage implementation, use a safe font stack:

### Display and Heading Font

```css
font-family:
    "Playfair Display",
    Georgia,
    "Times New Roman",
    serif;
```

Use for:

* Main hero headline
* Important luxury statements
* Selected section titles

### Interface and Body Font

```css
font-family:
    "Inter",
    "Helvetica Neue",
    Arial,
    sans-serif;
```

Use for:

* Paragraphs
* Buttons
* Navigation
* Labels
* Forms
* Cards
* Supporting headings

If these fonts are not already available, they may be loaded only inside the homepage-specific stylesheet or through the homepage CSS section after approval.

---

## 8. Typography Scale

### Hero Display

Desktop:

```text
64px–80px
Line height: 1.05–1.12
Font weight: 500–600
```

Tablet:

```text
48px–60px
```

Mobile:

```text
38px–46px
```

### Main Section Heading

Desktop:

```text
42px–52px
Line height: 1.15
```

Mobile:

```text
30px–36px
```

### Subsection Heading

Desktop:

```text
26px–32px
```

Mobile:

```text
22px–26px
```

### Body Large

```text
18px–20px
Line height: 1.7
```

### Body Standard

```text
16px
Line height: 1.65
```

### Small Text

```text
13px–14px
Line height: 1.5
```

### Eyebrow Label

```text
12px–14px
Uppercase
Letter spacing: 0.12em–0.18em
Font weight: 600
```

---

## 9. Typography Rules

1. Use short headings.
2. Avoid long centred paragraphs.
3. Maintain strong contrast.
4. Limit text width for readability.
5. Use serif typography selectively.
6. Use sans-serif typography for functional UI.
7. Do not use more than two font families.
8. Do not use excessive bold text.
9. Avoid all-uppercase headings except small eyebrow labels.
10. Important headings should have generous surrounding whitespace.

Recommended paragraph width:

```css
max-width: 640px;
```

Recommended hero text width:

```css
max-width: 760px;
```

---

## 10. Spacing System

Use an 8-pixel spacing system.

```text
4px
8px
12px
16px
24px
32px
40px
48px
64px
80px
96px
120px
```

### Section Spacing

Desktop:

```text
96px–140px top and bottom
```

Tablet:

```text
72px–96px
```

Mobile:

```text
56px–72px
```

### Card Padding

Desktop:

```text
28px–40px
```

Mobile:

```text
22px–28px
```

Avoid cramped sections.

Avoid arbitrary spacing values unless required for precise responsive behaviour.

---

## 11. Container System

Use the existing Bootstrap container system where possible.

Recommended main content width:

```css
max-width: 1280px;
```

Large visual sections may use:

```css
max-width: 1440px;
```

Text-heavy content should generally remain narrower:

```css
max-width: 720px;
```

Full-width sections are allowed for:

* Hero imagery
* Gallery sections
* Dark experience sections
* Large call-to-action areas

---

## 12. Border Radius System

Use consistent rounded corners.

### Small Radius

```text
10px
```

Usage:

* Tags
* Small buttons
* Form fields

### Standard Radius

```text
18px
```

Usage:

* Content cards
* Image cards
* Service cards

### Large Radius

```text
28px
```

Usage:

* Feature panels
* Hero image frames
* Large CTA sections

### Pill Radius

```text
999px
```

Usage:

* Small labels
* Compact action buttons
* Category pills

Avoid mixing many unrelated radius values.

---

## 13. Shadow System

Shadows must remain soft and natural.

### Card Shadow

```css
box-shadow:
    0 18px 50px rgba(11, 59, 74, 0.10);
```

### Hover Shadow

```css
box-shadow:
    0 24px 70px rgba(11, 59, 74, 0.16);
```

### Image Overlay Shadow

```css
box-shadow:
    0 30px 90px rgba(0, 0, 0, 0.18);
```

Avoid:

* Harsh black shadows
* Multiple heavy shadows
* Strong glow effects
* Neon box shadows

---

## 14. Button System

All buttons must have:

* Clear text
* Visible hover state
* Visible focus state
* Minimum touch-friendly height
* Consistent spacing
* Smooth transition

Recommended minimum height:

```text
48px
```

### Primary Button

Visual direction:

* Ocean blue background
* White text
* Soft shadow
* Slight lift on hover

Example class:

```text
.la-btn la-btn-primary
```

### Secondary Button

Visual direction:

* Transparent or white background
* Ocean dark text
* Light border
* Subtle background on hover

Example class:

```text
.la-btn la-btn-secondary
```

### Gold Accent Button

Use only for one important premium action per section.

Visual direction:

* Warm gold background
* Deep ocean text
* Minimal shadow

Example class:

```text
.la-btn la-btn-gold
```

### Text Link

Visual direction:

* No filled background
* Underline or arrow movement on hover
* Used for lower-priority actions

---

## 15. Button Behaviour

Default transition:

```css
transition:
    transform 0.3s ease,
    box-shadow 0.3s ease,
    background-color 0.3s ease,
    color 0.3s ease;
```

Hover behaviour:

```text
Translate upward by 2px
Increase shadow slightly
Move arrow icon by 3px–5px
```

Do not use:

* Large bouncing effects
* Fast flashing
* Excessive scaling
* Continuous button animation

---

## 16. Card System

Cards should feel editorial and premium rather than like marketplace product boxes.

### Experience Card

Contains:

* Large image
* Small category label
* Short title
* Short supporting copy
* Optional text link

### Feature Card

Contains:

* Small icon
* Short heading
* One short paragraph

### Testimonial Card

Contains:

* Short quotation
* Customer name
* Customer type or location
* Optional rating or avatar

### Image Story Card

Contains:

* Full image background
* Gradient overlay
* Text near the bottom
* Subtle hover zoom

Card rules:

1. Avoid too much text.
2. Use high-quality imagery.
3. Keep image ratios consistent.
4. Avoid marketplace price layouts unless required.
5. Use restrained borders.
6. Keep hover states smooth.
7. Do not place strong shadows on every card.

---

## 17. Image System

Images are a primary part of the Le_Almmora experience.

Preferred subjects:

* Clear ocean water
* Private villas
* Tropical skies
* Refined interiors
* Warm sunlight
* Couples or families enjoying premium experiences
* Calm landscapes
* Elegant hospitality details

Image treatment:

* High-resolution
* Natural colour balance
* Clean composition
* Soft warm highlights
* Minimal text embedded inside images

Recommended aspect ratios:

```text
Hero: 16:9 or 21:9
Feature landscape: 4:3
Portrait experience: 4:5
Gallery square: 1:1
Wide editorial: 3:2
```

Use:

```css
object-fit: cover;
```

Do not stretch images.

Use responsive image sizes where practical.

---

## 18. Image Overlay System

For text over images:

```css
background: linear-gradient(
    180deg,
    rgba(11, 59, 74, 0.02) 20%,
    rgba(11, 59, 74, 0.72) 100%
);
```

Text must remain readable on every image.

Avoid overly darkening all images.

---

## 19. Glass Effect

Glass effects may be used selectively for:

* Hero floating panels
* Small information cards
* Navigation overlays
* Premium labels

Recommended style:

```css
background: rgba(255, 255, 255, 0.72);
backdrop-filter: blur(16px);
-webkit-backdrop-filter: blur(16px);
border: 1px solid rgba(255, 255, 255, 0.40);
```

Do not apply glass effects to every card.

Provide a solid fallback background for browsers without backdrop-filter support.

---

## 20. Icon System

Use one consistent icon library already available in the project.

Before introducing icons:

1. Inspect the existing Font Awesome or theme icon set.
2. Reuse the existing library where suitable.
3. Do not introduce multiple new icon libraries.

Preferred icon style:

* Thin or regular weight
* Simple outline
* Rounded geometry
* Minimal detail

Icon sizes:

```text
Small: 16px
Standard: 20px–24px
Feature: 32px–40px
```

---

## 21. Section Background System

Alternate section backgrounds to create rhythm.

Recommended sequence:

```text
White
Sky Mist
White
Ocean Deep
Warm White
White
Aqua Mist
```

Do not alternate backgrounds mechanically after every section.

Use dark sections only for high-impact storytelling or CTA areas.

---

## 22. Navigation Direction

The existing shared header partial should remain functional.

For the homepage only, visual enhancements may include:

* Transparent header over hero
* White navigation text over dark hero
* Solid white background after scroll
* Subtle shadow after scroll
* Smooth logo and text colour transition

Any homepage-specific navigation behaviour must:

1. Be scoped to the homepage.
2. Preserve mobile navigation.
3. Preserve logged-in and logged-out states.
4. Preserve existing links.
5. Preserve bilingual behaviour.
6. Not affect other pages.

Do not rewrite the global header until its current conditional logic is fully mapped.

---

## 23. Form System

Forms should use:

* Clear labels
* Large input height
* Strong focus state
* Readable error messages
* Rounded but not overly pill-shaped fields

Recommended input height:

```text
50px–56px
```

Recommended textarea minimum height:

```text
140px
```

Focus colour:

```text
#2F9FC6
```

Avoid placeholder-only forms without visible context.

---

## 24. Responsive Breakpoints

Follow Bootstrap 4 breakpoints:

```text
xs: below 576px
sm: 576px and above
md: 768px and above
lg: 992px and above
xl: 1200px and above
```

Optional custom wide-screen breakpoint:

```text
1440px and above
```

All components must be designed for mobile, not merely compressed from desktop.

---

## 25. Mobile Design Rules

On mobile:

1. Reduce decorative elements.
2. Remove non-essential floating panels.
3. Reduce excessive image height.
4. Keep important buttons visible.
5. Stack cards vertically.
6. Maintain comfortable side padding.
7. Avoid horizontal scrolling.
8. Avoid tiny text.
9. Use shorter animation distances.
10. Disable expensive parallax effects where necessary.

Recommended mobile side padding:

```text
20px
```

---

## 26. Accessibility Rules

1. Maintain sufficient text contrast.
2. Do not communicate meaning only through colour.
3. All buttons and links must be keyboard accessible.
4. Use visible focus states.
5. Add meaningful alternative text to content images.
6. Decorative images should use empty alternative text.
7. Respect reduced-motion preferences.
8. Keep clickable elements large enough for touch.
9. Use correct heading order.
10. Avoid autoplay audio.

---

## 27. Reduced Motion

Homepage animation CSS and JavaScript must respect:

```css
@media (prefers-reduced-motion: reduce) {
    /* Disable or minimize animations */
}
```

Users requesting reduced motion should not receive:

* Parallax
* Large transforms
* Continuous floating effects
* Long reveal sequences

---

## 28. CSS Architecture

Recommended homepage CSS file:

```text
resources/sass/le-almmora-home.scss
```

Recommended compiled file:

```text
public/css/le-almmora-home.css
```

Suggested internal organization:

```scss
.le-almmora-home {
    // Base
    // Typography
    // Buttons
    // Cards
    // Hero
    // Brand introduction
    // Experiences
    // Features
    // Gallery
    // Testimonials
    // FAQ
    // CTA
    // Responsive rules
}
```

Do not modify the legacy 271KB theme stylesheet directly.

Do not place new homepage styles into the 4,292-line shared layout file.

---

## 29. JavaScript Architecture

Recommended homepage JavaScript file:

```text
resources/js/le-almmora-home.js
```

Recommended compiled file:

```text
public/js/le-almmora-home.js
```

Homepage JavaScript should handle only:

* Homepage reveal animations
* Homepage navigation behaviour
* Homepage sliders
* Homepage interactive cards
* FAQ interactions if required
* Reduced-motion behaviour

Do not duplicate Bootstrap or jQuery.

Do not load another version of jQuery.

Do not introduce a new animation library without approval.

Use existing libraries first.

---

## 30. Blade Component Architecture

Recommended homepage partial directory:

```text
resources/views/partial/frontend/homepage/
```

Suggested partials:

```text
hero.blade.php
brand-introduction.blade.php
experiences.blade.php
why-choose-us.blade.php
destination-showcase.blade.php
gallery.blade.php
testimonials.blade.php
faq.blade.php
final-cta.blade.php
```

The main homepage Blade file should become a clear composition layer.

Example:

```php
@extends('layouts.app')

@section('css')
    ...
@endsection

@section('content')
    <main class="le-almmora-home">
        @include('partial.frontend.homepage.hero')
        @include('partial.frontend.homepage.brand-introduction')
        @include('partial.frontend.homepage.experiences')
    </main>
@endsection

@section('js')
    ...
@endsection
```

The actual section names may be adjusted after reviewing `03-homepage.md`.

---

## 31. Naming Convention

Use the `la-` prefix for new homepage classes.

Examples:

```text
la-hero
la-section
la-section-heading
la-btn
la-btn-primary
la-experience-card
la-gallery-grid
la-testimonial-card
la-final-cta
```

Avoid generic new classes such as:

```text
card
button
title
box
content
wrapper
```

unless scoped and clearly intentional.

---

## 32. Implementation Priority

When design decisions conflict, use this priority:

1. Preserve existing functionality.
2. Maintain readability and usability.
3. Maintain responsive behaviour.
4. Maintain design consistency.
5. Maintain performance.
6. Add visual effects and animation.

Animation and decoration must never take priority over functionality.

---

## 33. Design Approval Rule

Before coding the full homepage, Claude Code must first provide:

1. Proposed Blade partial structure.
2. Proposed mapping of existing controller variables to sections.
3. Proposed CSS and JavaScript files.
4. Proposed homepage section order.
5. List of existing assets to reuse.
6. List of missing content or assets.
7. Any possible conflicts with existing Bootstrap or layout styles.

No full homepage implementation should begin until the homepage specification is completed.
