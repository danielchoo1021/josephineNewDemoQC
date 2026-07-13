# Le_Almmora — Homepage Specification

## 1. Purpose

This document converts the approved Le_Almmora homepage prototype direction into an implementation-ready specification.

The homepage must preserve the existing Laravel backend, controller data and shared website functions while presenting a new premium Maldives-inspired experience.

The redesign must follow:

* `docs/01-project.md`
* `docs/02-design-system.md`
* Existing Laravel 9 and Bootstrap 4 architecture
* Existing bilingual content patterns
* Existing homepage controller contract

---

## 2. Homepage Experience Direction

The homepage should feel like a premium brand journey rather than a conventional e-commerce catalogue.

Primary visual qualities:

* Maldives-inspired scenery
* Sky blue ocean atmosphere
* Warm golden highlights
* Large editorial typography
* Spacious modern sections
* Premium SaaS-style interaction
* Refined image cards
* Smooth scrolling experience
* Elegant but restrained animation

The page must not look like:

* Shopee
* Lazada
* A crowded marketplace
* A generic Bootstrap template
* A discount travel portal
* A standard product listing page

---

## 3. Homepage Root Structure

The live homepage remains:

```text
resources/views/frontend/home.blade.php
```

The main page should use:

```php
<main class="le-almmora-home">
    ...
</main>
```

Recommended partial directory:

```text
resources/views/partial/frontend/homepage/
```

Recommended partial files:

```text
hero.blade.php
brand-introduction.blade.php
featured-experiences.blade.php
signature-journey.blade.php
why-choose-us.blade.php
visual-gallery.blade.php
stories.blade.php
testimonials.blade.php
faq.blade.php
final-cta.blade.php
```

The main homepage Blade file should act mainly as a composition layer.

---

# 4. Homepage Section Order

The proposed homepage order is:

```text
01. Header / Navigation
02. Hero Section
03. Brand Introduction
04. Featured Experiences
05. Signature Journey
06. Why Choose Le_Almmora
07. Visual Gallery
08. Stories and Inspiration
09. Testimonials / Trust
10. FAQ
11. Final CTA
12. Footer
```

---

# 5. Section 01 — Header / Navigation

## Purpose

Provide clear navigation while supporting the immersive hero experience.

## Existing Structure

Reuse:

```text
resources/views/partial/frontend/header.blade.php
```

Do not rewrite or replace the shared header during the first implementation.

## Homepage Visual Behaviour

At the top of the homepage:

* Header may appear transparent over the hero
* Navigation text should remain readable
* Logo must remain visible
* Existing links must remain functional
* Mobile navigation must remain unchanged functionally

After scrolling:

* Header may transition to white or semi-transparent white
* Navigation text may transition to dark ocean colour
* A soft shadow may appear
* Transition must be smooth and homepage-only

## Important Rules

Do not break:

* Logged-in state
* Logged-out state
* Existing menu links
* Language switching
* Cart or account indicators
* Mobile menu

---

# 6. Section 02 — Hero

## Purpose

Immediately establish the Le_Almmora brand as premium, calm, modern and Maldives-inspired.

## Layout

Desktop:

```text
Full viewport or near-full viewport hero
Large visual background
Text aligned left or lower-left
Optional floating premium card
Primary and secondary CTA
```

Mobile:

```text
Tall image hero
Shorter headline
Buttons stacked or wrapped
Reduced decorative content
```

## Height

Desktop:

```text
Minimum 760px
Preferred: 88vh–100vh
```

Mobile:

```text
Minimum 680px
```

## Visual Content

Preferred background:

* Maldives-style ocean scenery
* Bright tropical sky
* Premium resort architecture
* Warm sunlight
* Clear blue and turquoise colour balance

The image should use:

```css
object-fit: cover;
```

A subtle dark or ocean-blue overlay must maintain text readability.

## Content Direction

Eyebrow:

```text
A WORLD BEYOND ORDINARY
```

Main headline direction:

```text
Where Luxury Meets the Horizon
```

Supporting copy direction:

```text
Discover a refined escape shaped by turquoise waters, thoughtful experiences and timeless comfort.
```

Primary CTA:

```text
Explore the Experience
```

Secondary CTA:

```text
Enquire Now
```

Exact copy may later be replaced by database-managed content.

## Data Mapping

Preferred priority:

1. Existing `SettingBanner`
2. Existing homepage banner fields
3. Existing static visual asset only as a temporary fallback

Do not hardcode permanent content if existing database fields can support it.

## Animation

Initial load:

* Background image slowly scales from approximately 1.04 to 1
* Eyebrow fades upward
* Headline reveals by line or mask
* Supporting text fades upward
* CTA buttons fade upward
* Floating panel enters last

Animation must be restrained.

---

# 7. Section 03 — Brand Introduction

## Purpose

Explain what Le_Almmora represents before presenting services or products.

## Layout

Desktop:

```text
Left side:
Small label
Large editorial heading
Supporting copy
Text CTA

Right side:
Large rounded image
Optional smaller overlapping image or detail card
```

Mobile:

```text
Text first
Image second
No excessive overlap
```

## Content Direction

Eyebrow:

```text
THE LE_ALMMORA EXPERIENCE
```

Heading direction:

```text
Designed for Moments That Stay With You
```

Copy direction:

```text
Le_Almmora brings together beautiful destinations, refined hospitality and personalized experiences created around the way you want to travel.
```

## Data Mapping

Possible sources:

* `SettingHomePage`
* Existing company introduction fields
* Existing about or overview settings

## Visual Style

* Warm white background
* Large image radius
* Gold detail line
* Spacious layout
* Optional glass information card

## Animation

* Text fades upward
* Main image reveals through clipping or scale
* Decorative image may move slightly with scroll
* Disable parallax on smaller mobile devices

---

# 8. Section 04 — Featured Experiences

## Purpose

Show the main offerings in a premium editorial format.

This section should borrow the visual organization of modern e-commerce cards without looking like a marketplace.

## Layout

Desktop:

```text
Section heading
Short introduction
Three featured cards
One card may be visually larger
```

Alternative:

```text
One large experience card
Two smaller stacked cards
```

Mobile:

```text
Single-column cards
Horizontal carousel allowed only if usability remains clear
```

## Card Content

Each card may include:

* Image
* Small label
* Experience name
* One short description
* CTA such as “Discover More”
* Optional price only if existing business requirements need it

Do not make price the strongest visual element.

## Data Mapping

Possible sources:

* Existing featured categories
* Existing featured products
* `Category`
* `Product`
* `SettingHomePage`
* `Promotion`

The existing controller variables must be inspected before final mapping.

## Visual Style

* Large image area
* Rounded editorial card
* Gradient overlay
* White text over image or dark text beneath image
* Soft hover zoom
* Small gold label

## Animation

* Cards reveal in sequence
* Images scale slightly on hover
* Arrow moves slightly on hover
* No aggressive card lift

---

# 9. Section 05 — Signature Journey

## Purpose

Create a strong immersive storytelling section that differentiates Le_Almmora from a normal e-commerce site.

## Layout

Preferred desktop concept:

```text
Dark ocean background
Large image or video on one side
Editorial text on the other
Three short journey steps or highlights
```

Possible steps:

```text
01 — Discover
02 — Personalize
03 — Experience
```

## Content Direction

Heading:

```text
Your Journey, Thoughtfully Curated
```

Copy:

```text
From the first idea to the final detail, every part of the experience is designed around comfort, confidence and meaningful moments.
```

## Data Mapping

Possible sources:

* `SettingHomeVideo`
* Existing homepage video fields
* Existing content slots
* Existing service explanation fields

## Video Rules

If video is used:

* Must be muted by default
* Must not autoplay with sound
* Must have poster image
* Must not block page loading
* Must have mobile fallback
* Must respect reduced-motion preference where practical

## Animation

* Section background reveals smoothly
* Text fades upward
* Journey steps appear sequentially
* Video or image may use subtle scroll movement

---

# 10. Section 06 — Why Choose Le_Almmora

## Purpose

Build trust and explain the brand value proposition.

## Layout

Desktop:

```text
Section heading
Four feature cards or columns
```

Mobile:

```text
Two-column or single-column layout
```

## Suggested Value Points

### Personalized Experience

Every journey is shaped around individual preferences.

### Premium Selection

Experiences and services are presented with quality and comfort in mind.

### Trusted Support

Clear communication and assistance throughout the customer journey.

### Thoughtful Details

Small details are considered to create a more complete experience.

## Data Mapping

Initially this section may use approved static brand content if no suitable database fields exist.

Static text must remain easy to edit inside one dedicated partial.

## Visual Style

* Soft aqua or white background
* Thin outline icons
* Minimal card borders
* Small gold accents
* No heavy shadows

## Animation

* Feature cards fade upward
* Icons may draw or scale slightly
* Avoid continuous icon animation

---

# 11. Section 07 — Visual Gallery

## Purpose

Deliver emotional impact through imagery and reinforce the premium atmosphere.

## Layout

Recommended desktop masonry-style editorial grid:

```text
One tall image
Two medium images
One wide image
```

Mobile:

```text
Simple stacked or two-column grid
```

## Image Subjects

* Ocean
* Resort
* Interior
* Dining
* Sunset
* Private experience
* Lifestyle details

## Data Mapping

Possible sources:

* Existing banner images
* Existing gallery assets
* Existing `SettingHomePage` image slots
* Existing promotional images
* Existing project images

Do not use customer-uploaded private images.

## Interaction

* Optional lightbox only if existing library already supports it
* Hover zoom
* Optional image caption
* No complicated drag interaction during first implementation

## Animation

* Images reveal as they enter viewport
* Slight stagger
* Reduced motion must disable large transitions

---

# 12. Section 08 — Stories and Inspiration

## Purpose

Use existing blog or editorial content to create a richer brand experience and improve discoverability.

## Layout

Desktop:

```text
Section heading
Three story cards
```

Mobile:

```text
Single column or swipe carousel
```

## Data Mapping

Use:

* Existing `Blog`
* Existing homepage blog data
* Existing controller-provided blog variables

## Card Content

* Featured image
* Category or date
* Title
* Short excerpt
* Read more link

## Visual Style

This should look editorial, not like a generic news listing.

Use:

* Large images
* Short titles
* Strong spacing
* Minimal metadata
* Refined hover state

---

# 13. Section 09 — Testimonials / Trust

## Purpose

Build credibility before the final conversion action.

## Content Options

Use available content in this priority:

1. Existing testimonial data
2. Existing achievements or awards
3. Existing customer feedback
4. Approved static trust messages
5. Existing business statistics

## Layout Option A

```text
Large testimonial quote
Small supporting testimonials
Customer or partner details
```

## Layout Option B

```text
Trust statistics
Awards or recognition
Partner logos
Short testimonial
```

## Existing Assets

Inspect:

```text
public/our_award/
```

Only use these assets if they are confirmed relevant to Le_Almmora.

## Visual Style

* Warm white or sand background
* Large quotation mark
* Gold accents
* Calm typography
* Avoid fake review marketplace styling

## Important Rule

Do not invent customer names, testimonials, statistics or awards.

---

# 14. Section 10 — FAQ

## Purpose

Resolve common questions before visitors make an enquiry.

## Layout

Desktop:

```text
Short heading and introduction on left
Accordion on right
```

Mobile:

```text
Heading above accordion
```

## Data Mapping

Possible sources:

* Existing FAQ database content
* Existing `Faq`
* Existing homepage FAQ settings

## Example Topics

* How do I make an enquiry?
* Can experiences be personalized?
* How early should I make arrangements?
* Do you support special occasions?
* How will the team contact me?

These are content directions only and should not replace real business answers without approval.

## Technical Direction

Use existing Bootstrap collapse or accordion behaviour.

Do not install another accordion library.

---

# 15. Section 11 — Final CTA

## Purpose

Provide one clear action after the visitor has understood the brand.

## Layout

Preferred:

```text
Large rounded ocean-image panel
Dark overlay
Centred or left-aligned text
One primary CTA
One optional secondary CTA
```

## Content Direction

Eyebrow:

```text
BEGIN YOUR JOURNEY
```

Heading:

```text
Let Us Create Something Unforgettable
```

Supporting copy:

```text
Tell us what you are imagining, and our team will help shape the next step.
```

Primary CTA:

```text
Make an Enquiry
```

Secondary CTA:

```text
Contact via WhatsApp
```

## CTA Behaviour

Use the existing enquiry, contact or WhatsApp route where available.

Do not create broken placeholder links.

## Data Mapping

Possible sources:

* Existing contact settings
* Existing WhatsApp number
* Existing company settings
* Existing enquiry routes

---

# 16. Section 12 — Footer

Reuse:

```text
resources/views/partial/frontend/footer.blade.php
```

Do not redesign the shared footer during the first homepage implementation unless approved.

Homepage spacing before the footer may be adjusted inside the homepage scope.

---

# 17. Existing Data Contract

The homepage currently receives many variables from:

```text
HomeController@index
```

Claude Code must identify the exact variable names before editing the homepage.

The redesign must not silently remove or break:

* Banners
* Featured categories
* Featured products
* Flash sales
* Promotions
* Vouchers
* Homepage settings
* Video sections
* Blogs
* Quizzes
* Buyer-level pricing logic
* Logged-in customer behaviour
* Language behaviour

Not every existing content type must remain equally prominent, but each removed visible section must be documented and approved.

---

# 18. Recommended Data-to-Section Mapping

Initial proposed mapping:

```text
SettingBanner
→ Hero

SettingSecondBanner
→ Signature Journey or visual feature section

SettingHomePage
→ Brand Introduction, Featured Experiences and supporting content

SettingHomeVideo
→ Signature Journey video

Category
→ Experience categories

Product
→ Featured packages or experiences

Promotion
→ Optional premium offer strip or featured experience

Blog
→ Stories and Inspiration

Quiz
→ Optional engagement section, not part of initial premium homepage unless visually suitable

FAQ
→ FAQ section
```

Claude must verify actual variable names and structures before implementation.

---

# 19. Homepage CSS

Recommended source:

```text
resources/sass/le-almmora-home.scss
```

Recommended compiled output:

```text
public/css/le-almmora-home.css
```

It must be loaded only on the homepage through:

```php
@section('css')
```

All selectors must be scoped under:

```css
.le-almmora-home
```

Do not edit:

```text
public/frontend/assets/css/style.css
```

Do not insert new homepage CSS into:

```text
resources/views/layouts/app.blade.php
```

---

# 20. Homepage JavaScript

Recommended source:

```text
resources/js/le-almmora-home.js
```

Recommended compiled output:

```text
public/js/le-almmora-home.js
```

It must be loaded only on the homepage through:

```php
@section('js')
```

Initial JavaScript responsibilities:

* Reveal-on-scroll
* Header homepage scroll state
* Gallery interactions if needed
* Existing carousel initialization if needed
* FAQ behaviour if not already handled
* Reduced-motion support

Do not install GSAP during the first implementation.

Use existing libraries or lightweight vanilla JavaScript first.

A separate animation enhancement phase may introduce GSAP later after approval.

---

# 21. Responsive Requirements

## Desktop

* Strong editorial composition
* Large visual sections
* Spacious margins
* Controlled image overlap
* Smooth but restrained animation

## Tablet

* Reduce overlaps
* Maintain readable heading sizes
* Use two-column layouts only where comfortable
* Keep CTA buttons clear

## Mobile

* Stack sections vertically
* Reduce decorative shapes
* Disable expensive parallax
* Use shorter animations
* Keep at least 20px side padding
* Avoid text over visually busy images
* Ensure no horizontal overflow
* Ensure buttons remain touch-friendly

---

# 22. Performance Requirements

1. Do not load all legacy theme images.
2. Use only assets required by the homepage.
3. Compress large new images.
4. Avoid autoplaying multiple videos.
5. Lazy-load below-the-fold images.
6. Use poster images for videos.
7. Avoid large JavaScript dependencies.
8. Reuse existing libraries.
9. Keep homepage-only CSS isolated.
10. Review mobile performance manually.

---

# 23. Accessibility Requirements

1. Correct heading order.
2. Meaningful alt text.
3. Visible keyboard focus.
4. Sufficient colour contrast.
5. Touch-friendly buttons.
6. Reduced-motion support.
7. Readable text over images.
8. No autoplay audio.
9. Clear link labels.
10. Accessible FAQ controls.

---

# 24. First Implementation Scope

The first implementation should include:

```text
Hero
Brand Introduction
Featured Experiences
Signature Journey
Why Choose Le_Almmora
Visual Gallery
Stories and Inspiration
FAQ
Final CTA
```

Testimonials or trust content may be included when real content is confirmed.

Do not invent business content to fill missing sections.

---

# 25. Implementation Sequence

Claude Code must implement the homepage in this order:

## Step 1 — Mapping

* Identify all variables passed to `frontend.home`
* Map each current visible section
* Identify what must be preserved
* Identify unused or duplicate legacy sections

## Step 2 — Structure

* Propose Blade partial files
* Create no code until mapping is reported
* Confirm homepage section order

## Step 3 — Foundation

* Add homepage-specific SCSS
* Add homepage-specific JavaScript
* Update Mix configuration only if necessary
* Do not modify shared layout styles

## Step 4 — Section Development

Implement and review one group at a time:

```text
Hero + Brand Introduction
Featured Experiences + Signature Journey
Why Choose Us + Gallery
Stories + FAQ + Final CTA
```

## Step 5 — QA

* Desktop review
* Tablet review
* Mobile review
* Logged-in review
* Logged-out review
* Language review
* Console review
* Existing action review

---

# 26. Approval Checkpoint

Before writing homepage code, Claude Code must return:

1. Exact controller variable names.
2. Current homepage section inventory.
3. Proposed mapping from old sections to new sections.
4. Proposed Blade partial structure.
5. Proposed files to create.
6. Proposed files to edit.
7. Existing content that may no longer appear.
8. Existing functions at risk.
9. Missing images or content.
10. Confirmation that no shared layout or backend logic will be modified.

Only after this checkpoint is reviewed should homepage coding begin.
