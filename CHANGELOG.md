# Changelog — Hipsy Events Builder

## [4.3.1] - 2025-05-03 🎨 LIJST LAYOUT UPGRADE

**Widget zelf is nu mooi — geen custom CSS meer nodig!**

### Fixed

**Lijst Layout Volledig Vernieuwd:**
- ✅ **Mandira-style design** ingebouwd in widget
- ✅ **Border-left accent** (gebruikt card_accent_color)
- ✅ **Hover effects** (lift + shadow)
- ✅ **Prijs rechtsboven** (groen, prominent)
- ✅ **Mooiere buttons** (outline + filled styles)
- ✅ **Betere spacing** (1.25rem gaps)
- ✅ **Rounded cards** (12px border-radius)
- ✅ **Grotere afbeelding** (200px breed, 180px hoog)
- ✅ **Datum line bovenaan** (uppercase, bold)
- ✅ **Betere responsive** (stack op mobiel)

**Mobiele Verbeteringen:**
- Lijst layout stack correct op < 768px
- Afbeelding full-width op mobiel
- Buttons side-by-side op mobiel
- Prijs verplaatst naar onder op mobiel

### Styling Details

**Lijst Cards:**
```css
- Padding: 1.25rem
- Border-radius: 12px
- Border-left: 4px solid (accent color)
- Shadow: 0 1px 3px rgba(0,0,0,0.08)
- Hover shadow: 0 4px 12px rgba(0,0,0,0.12)
- Hover transform: translateY(-2px)
```

**Afbeelding:**
```css
- Width: 200px (desktop)
- Height: 180px
- Border-radius: 8px
- Object-fit: cover
```

**Prijs:**
```css
- Position: absolute top right
- Background: #10b981 (groen)
- Color: white
- Font-size: 1.125rem
- Padding: 0.5rem 0.875rem
- Border-radius: 6px
```

**Buttons:**
```css
- Meer info: Transparent bg, border
- Aanmelden: Solid bg
- Padding: 0.625rem 1.25rem
- Border-radius: 6px
- Font-weight: 600
```

### Usage

**Geen custom CSS meer nodig!**

1. **Add Events Grid Widget**
2. **Kies Layout:** Lijst
3. **Style tab:** Pas kleuren aan
4. **Done!** 🎉

De lijst layout ziet er nu automatisch goed uit zoals Mandira!

---

## [4.3.0] - 2025-05-03 🎨 MANDIRA DESIGN TEMPLATES

**Exact de Mandira Utrecht agenda designs nabouwen!**

### Added

**Mandira Style CSS Template** (`assets/mandira-style.css`):
- Complete CSS voor Mandira Utrecht design replicatie
- 2 hoofdlayouts: Grid (screenshots 1 & 4) en List (screenshot 3)
- Datum badge overlay styling (MEI 01 badges)
- Category tag styling (MANTRA'S/KIRTAN badges)
- Filter button styling (category + location filters)
- Prijs + button layouts
- Responsive design patterns
- JavaScript helpers voor datum badges

**Widget Configuratie Handleiding** (`WIDGET_CONFIG.md`):
- Stap-voor-stap setup voor beide layouts
- Filter buttons (category + location)
- Datum badge implementatie
- Custom HTML templates
- JavaScript voorbeelden
- Troubleshooting sectie

### Features

**Grid Layout (Mandira Style):**
- Datum badges linksboven (MEI 01)
- Category tags onderaan afbeelding
- Card hover effects
- Responsive 3-kolommen → 1-kolom
- Metadata met iconen (📅🕐📍)
- Clean white cards met subtiele shadow

**List Layout (Mandira Style):**
- Horizontal cards met afbeelding links
- Datum line bovenaan (uppercase)
- Prijs rechts (groen voor zichtbaarheid)
- Dual buttons (Meer info + Aanmelden)
- Border-left accent (oranje)
- Compact voor agenda-style lijsten

**Filter Buttons:**
- Category filters (Alle, Tantra, Meditatie, etc.)
- Location filters met kleur coding
- Active states (oranje background)
- Rounded pill design
- Responsive wrapping

**Kleuren Scheme:**
- Primary: #d97706 (Oranje)
- Success: #10b981 (Groen voor prijzen)
- Neutral: #666 (Text)
- White cards met subtle shadows

### Use Cases

1. **Event Grid Page (Screenshot 1)**
   - 3-kolommen grid
   - Datum badges
   - Category tags op afbeeldingen
   - Hover effects

2. **Event List Page (Screenshot 3)**
   - Horizontal layout
   - Type filters (Workshop, Cursus, Retreat)
   - Prijs + dual buttons
   - Compact design

3. **Location-Based Grid (Screenshot 4)**
   - Location filters bovenaan
   - Grotere cards
   - Category badges
   - Prijs + Meer info button

### Technical

**File Structure:**
- `assets/mandira-style.css` — Complete Mandira styling
- `WIDGET_CONFIG.md` — Widget setup handleiding

**CSS Classes:**
- `.mandira-grid` — Grid layout activeren
- `.mandira-list` — List layout activeren
- `.mandira-filters` — Filter button container
- `.mandira-filter-btn` — Individual filter button

**JavaScript Helpers:**
- Datum badge data injection
- Filter button click handlers
- Event filtering logic

**Widget Compatibility:**
- Werkt met bestaande Events Grid widget
- Gebruik via Custom CSS Classes
- Geen code changes nodig
- Elementor + Divi compatible

### Documentation

**WIDGET_CONFIG.md:**
- Quick setup (2 stappen)
- Layout 1: Grid configuratie
- Layout 2: List configuratie
- Filter buttons (HTML + JS)
- Datum badge implementation
- Kleur customization
- Complete troubleshooting

**mandira-style.css:**
- Inline comments
- Organized per layout
- Responsive breakpoints
- Color variables ready

### Installation

1. Kopieer `assets/mandira-style.css` naar theme CSS
2. Voeg Events Grid widget toe
3. Stel Custom CSS Class in (`mandira-grid` of `mandira-list`)
4. Voeg filter buttons toe (optioneel)
5. Activeer datum badge JavaScript
6. Done! 🎉

---

## [4.2.0] - 2025-05-03 🎨 CUSTOM TEMPLATES & DYNAMIC CONTENT

**Volledige Template Controle:** Individual field shortcodes + Divi Dynamic Content!

### Added

**Individual Field Shortcodes** (11 nieuwe shortcodes):
- `[event_title]`, `[event_date]`, `[event_time]`, `[event_location]`
- `[event_description]`, `[event_image]`, `[event_categories]`
- `[event_price]`, `[event_ticket_url]`, `[event_link]`, `[event_button]`

**Divi Dynamic Content Integration:**
- Alle event fields in Divi's Dynamic Content dropdown
- Groep "Hipsy Events" met 10+ fields
- Format opties (datum, tijd, beschrijving lengte)
- Werkt in Text, Button, Image modules

**Custom Template Support:**
- Bouw eigen HTML/CSS designs (exact Mandira style)
- Nederlandse maand/dag namen (automatisch)
- Volledige controle over layout

### Documentation
- `CUSTOM_TEMPLATES_GUIDE.md` — Complete handleiding met Mandira voorbeelden

---

## [4.0.2] - 2025-05-03 🛡️ SAFE MODE

### 🚨 KRITIEKE BUGFIXES — Voorkomt Site Crashes

**Probleem:** Plugin crashed site tijdens sync door:
- Ongecatchte image download errors
- DateTime parsing zonder error handling
- Geen fallbacks bij API fouten

**Oplossing:** Complete error handling toegevoegd

#### Fixed
- **Image Download Crashes** (KRITIEK FIX)
  - Was: `file_get_contents()` zonder error handling → site crash
  - Nu: `wp_remote_get()` met try/catch + 15s timeout
  - SSL verify uit voor problematische servers
  - Events worden aangemaakt ZONDER image als download faalt
  
- **DateTime Parsing Errors**
  - Try/catch rond alle DateTime operaties
  - Sla event over als datum ongeldig is (log error)
  
- **createEvent() Crashes**
  - Volledige try/catch wrapper rond hele functie
  - Input validatie op verplichte velden
  - Sanitize alle user input
  - Return false i.p.v. crash bij fouten

- **Sync Functie Crashes**
  - Per-event error handling
  - 1 kapot event crasht niet hele sync
  - Ga door met volgende events
  - Statistieken bijhouden (success/failed)

#### Added
- **Test Sync Button** 🧪
  - Sync eerst 3 events om te testen
  - In admin settings: "Test & Sync" sectie
  - Voorkomt productie crashes
  
- **Error Logging Systeem**
  - `hipsy_log_error()` functie
  - Alle errors worden gelogd in database
  - Laatste 50 errors bewaard
  - Viewer in admin settings
  - "Wis Log" button
  
- **Sync Resultaat Display**
  - Totaal events / Succesvol / Gefaald
  - Timestamp + test mode indicator
  - Klikbare error lijst
  - Visuele feedback na sync

- **Full Sync Button**
  - Apart van test sync
  - Confirmation dialog
  - Sync alle events

#### Improved
- **Image Processing**
  - WebP support toegevoegd
  - Better filename sanitization
  - Check of upload dir beschrijfbaar is
  - Duplicaat detectie verbeterd
  
- **Memory Management**
  - 0.1s pauze tussen events
  - Voorkomt server overload
  - wp_remote_get timeout: 15s
  
- **Admin UX**
  - Duidelijkere error messages
  - Success/error notifications
  - Real-time sync status
  - Gestructureerde error weergave

#### Technical
- Replaced `file_get_contents()` → `wp_remote_get()`
- Added `hipsy_log_error()` helper function
- Error log storage in wp_options
- Sync stats in `hipsy_events_last_sync_result`
- Test mode parameter in `refresh_hipsy_events_func()`

#### Documentation
- `README-SAFE-MODE.md` — Complete safe mode guide
- Troubleshooting sectie voor crashes
- Error log interpretatie
- Stap-voor-stap herstel instructies

---

## [4.0.1] - 2025-05-03

### 🎨 Native Divi Builder Support

**NIEUW:** De plugin heeft nu native Divi modules!

#### Added
- **Hipsy Events Grid Divi Module** 🎉
  - Volledige visuele interface in Divi Builder
  - Layout keuzes: Grid, List
  - Responsive kolom controls (1-4 kolommen, per device)
  - Content toggles voor elk veld (afbeelding, datum, titel, etc.)
  - Query opties (aantal events, categorieën, alleen toekomst)
  - Styling controls (gap, spacing)
  - Live preview in Divi Builder
  - Independent van v4.0 features (werkt altijd)

- **Documentation**
  - `DIVI_MODULE_GUIDE.md` — Complete handleiding voor Divi modules
  - `DIVI_GUIDE.md` update — Shortcodes voor alle builders
  - Troubleshooting sectie toegevoegd

#### Changed
- **Event Card Renderer** nu altijd geladen
  - Was: Alleen in v4.0 mode
  - Nu: Altijd beschikbaar voor alle builders
  - Reden: Nodig voor Divi module compatibility

- **Admin Notices Verbeterd**
  - Elementor notice: Nu vriendelijke info (was: warning)
  - Alleen getoond op plugins pagina (was: overal)
  - Duidelijkere messaging over beschikbare opties

- **v4.0 Features Toggle**
  - Via admin checkbox in settings (was: wp-config.php)
  - Geen handmatige file edits meer nodig
  - Dashboard → Events → Settings → "v4.0 Features 🆕"

#### Fixed
- Divi module gebruikt correcte WordPress queries
  - Proper meta_query voor datum filtering
  - Correct tax_query voor categorieën
  - `hipsy_events_date` meta key voor sorting
- Fallback rendering als event card renderer niet beschikbaar
- Removed dependency op v4.0 query system voor Divi module

#### Technical
- Divi integration via `integrations/divi/`
- Module class: `Hipsy_Divi_Events_Grid`
- Extends: `ET_Builder_Module`
- Hook: `et_builder_ready`
- Responsive: Via `mobile_options => true`
- Settings modal met organized toggles

---

## [4.0.0] - 2025-05-02

### 🚀 Major Upgrade — Event Builder Platform

Dit is een significante upgrade die de plugin transformeert van een event sync tool naar een complete event builder platform.

### ✨ Added

#### Core Systemen
- **Query System** — Centraal query management met Query ID support
  - `hipsy_get_events_query()` — Unified event query functie
  - `hipsy_register_query()` — Register queries voor filter koppeling
  - Query ID registry voor cross-widget communicatie

- **AJAX Filter System** — Realtime filtering zonder pagina reload
  - Volledig AJAX-gedreven filtering
  - Categorie, locatie en zoekterm support
  - Meerdere filters tegelijk
  - Query ID koppeling tussen filter en grid widgets

- **Event Card Renderer** — Flexibel unified rendering systeem
  - `hipsy_render_event_card()` — Eén renderer voor alle layouts
  - Gebruikt door grid, list, carousel en shortcodes
  - Volledig configureerbare opties per use case

#### Elementor Widgets
- **Hipsy Filter Bar (v4.0)** — NIEUWE widget
  - AJAX filtering met Query ID koppeling
  - Configureerbare search, categorie en locatie filters
  - Volledig gestyleerd met Elementor controls
  - Responsive design
  
- **Hipsy Events Grid** — UPGRADED
  - Query ID support toegevoegd
  - Koppelbaar met Filter Bar widget
  - Wrapper ID voor AJAX targeting
  - Query parameters worden geregistreerd voor filters

#### Shortcodes
- **[hipsy_filter]** — NIEUW
  - Query ID support
  - Configureerbare filter opties
  - Voor gebruik in Salient, WPBakery, Gutenberg

- **[hipsy_events_grid]** — UITGEBREID
  - Query ID parameter toegevoegd
  - Koppelbaar met [hipsy_filter]
  - Meer configuratie opties

- **[hipsy_events_list]** — NIEUW
  - Dedicated list layout shortcode

#### JavaScript
- **ajax-filter.js** — NIEUW
  - AJAX filter handling
  - Auto-init op page load
  - Query ID targeting
  - Loading states
  - Carousel re-init support

### 🔧 Changed

#### Architectuur Herstructurering
```
BEFORE:
functions/
widgets/
assets/

AFTER:
core/              → Query systeem, AJAX, data management
render/            → Event card rendering
integrations/
  ├── elementor/   → Elementor widgets
  └── shortcodes/  → Builder-onafhankelijke shortcodes
functions/         → Legacy (behouden voor compatibility)
widgets/           → Legacy widgets (behouden)
assets/            → Scripts & styles
```

- **Plugin Naam** — "Hipsy Events" → "Hipsy Events Builder"
- **Plugin Beschrijving** — Uitgebreid met builder capabilities

### 🛡️ Backwards Compatibility

#### ✅ Behouden (Geen Breaking Changes)
- Bestaande Elementor widgets blijven werken
- Bestaande shortcodes blijven werken
- Custom post type `hipsy_event` onveranderd
- Alle meta fields behouden
- Taxonomie `event_categorie` behouden
- API sync functionaliteit behouden
- Admin instellingen behouden
- Cron jobs blijven draaien

#### ⚙️ Upgrade Path
Gebruikers kunnen upgraden zonder issues:
1. Plugin updaten naar v4.0
2. Bestaande pagina's blijven werken
3. Nieuwe features zijn opt-in via Query ID
4. Geen data migratie nodig

### 📂 New Files

```
core/
├── query-system.php         → Query management & registry
└── ajax-filter.php          → AJAX filter handler

render/
└── event-card.php           → Unified card renderer

integrations/
├── elementor/
│   └── filter-bar-widget.php → Filter Bar widget
└── shortcodes/
    └── extended-shortcodes.php → v4.0 shortcodes

assets/js/
└── ajax-filter.js           → AJAX filtering script
```

### 📚 Documentation

- **README-v4.md** — Complete v4.0 documentatie
- Gebruik voorbeelden
- Shortcode referentie
- Technische details
- Upgrade guide

### 🎯 Target Use Cases

Deze update maakt de plugin geschikt voor:

1. **Event Organizers**
   - Multiple event layouts op één site
   - Gefilterde event overzichten
   - Responsive event agendas

2. **Web Designers**
   - Volledige design vrijheid in Elementor
   - Custom event card designs
   - Responsive layouts zonder code

3. **Developers**
   - Builder-onafhankelijke shortcodes
   - PHP functions voor custom implementations
   - Extensible architectuur

4. **Agency / Multi-Site**
   - Herbruikbare configuraties
   - Consistente event displays
   - Schaalbaar systeem

### 🏆 Key Achievements

- ✅ AJAX filtering zonder custom JavaScript
- ✅ Query ID koppeling systeem
- ✅ Unified event card renderer
- ✅ Backwards compatible upgrade
- ✅ Builder-onafhankelijk
- ✅ Elementor-first approach
- ✅ Clean, moderne architectuur

### 🔮 Next Steps (v4.1+)

Geplande features voor volgende releases:

- [ ] Carousel verbeteringen (swipe, autoplay controls)
- [ ] Single event widgets (title, date, location, etc)
- [ ] Related events widget
- [ ] Event countdown widget
- [ ] Advanced sorting opties
- [ ] Location-based filtering improvements
- [ ] Export/import events
- [ ] Event templates

---

## [1.3.0] - 2024-04-28

### Changed
- Elementor widget verbeteringen
- Grid layout optimalisaties

### Fixed
- Minor bug fixes

---

## [1.2.0] - 2024-03-15

### Added
- WPBakery shortcode support
- Gutenberg block

---

## [1.1.0] - 2024-02-10

### Added
- Elementor widgets
- Basic filtering

---

## [1.0.0] - 2024-01-05

### Added
- Initial release
- Hipsy API sync
- Custom post type
- Basic event display

---

**Versioning:** We gebruiken [Semantic Versioning](https://semver.org/):
- MAJOR version: Incompatible API changes
- MINOR version: Nieuwe features (backwards compatible)
- PATCH version: Bug fixes (backwards compatible)
