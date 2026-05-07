# Hipsy Events Builder v4.0 🚀

**Professional Event Builder voor WordPress**  
Builder-onafhankelijk | Elementor-first | AJAX Filtering | Responsive Layouts

---

## 🎯 Wat is nieuw in v4.0

### ✨ Nieuwe Features

#### 1. **AJAX Filter Systeem**
- Realtime filtering zonder pagina reload
- Query ID koppeling tussen Filter en Grid
- Categorie, locatie en zoekterm filtering
- Meerdere filters tegelijk gebruiken

#### 2. **Query ID Systeem**
Koppel filters aan specifieke grids:

```
Filter Bar → Query ID: "agenda"
Events Grid → Query ID: "agenda"
```

#### 3. **Nieuwe Elementor Widgets**
- **Hipsy Filter Bar (v4.0)** — AJAX filter widget
- **Hipsy Events Grid (upgraded)** — Nu met Query ID support

#### 4. **Flexibel Event Card Systeem**
Eén unified card renderer gebruikt door:
- Grid layout
- List layout  
- Carousel layout
- Shortcodes

#### 5. **Herstructureerde Architectuur**
```
core/          → Query systeem, AJAX handlers
render/        → Event card rendering
integrations/  → Elementor widgets, shortcodes
```

---

## 🔧 Gebruik

### Filter + Grid Koppelen

**Stap 1: Filter Bar Widget**
1. Sleep "Hipsy · Filter Bar (v4.0)" op je pagina
2. Stel Query ID in: `agenda`
3. Configureer filters (search, categorie, locatie)

**Stap 2: Events Grid Widget**  
1. Sleep "Hipsy · Events Grid" op je pagina
2. Stel dezelfde Query ID in: `agenda`
3. Configureer layout en styling

**Result:** Filter en Grid zijn nu gekoppeld via AJAX! 🎉

---

## 📋 Shortcodes (Voor Salient/WPBakery/etc)

Shortcodes werken nu ook met het nieuwe systeem:

```php
// Filter Bar
[hipsy_filter query_id="agenda"]

// Events Grid
[hipsy_events_grid query_id="agenda" layout="grid" columns="3"]

// Events List
[hipsy_events_list query_id="agenda"]
```

**Parameters:**
- `query_id` — Koppel aan filter (optioneel)
- `layout` — grid, list, carousel
- `columns` — 1-4 (alleen grid/carousel)
- `aantal` — Max events (default: 6)
- `categorie` — Filter op categorie slug
- `alleen_toekomst` — yes/no (default: yes)

---

## 🎨 Responsive Controls

De Events Grid heeft volledig responsive controls:

- **Kolommen:** Desktop/Tablet/Mobiel
- **Kaartoriëntatie:** Verticaal/Horizontaal per device
- **Image width:** Aanpasbaar per device
- **Padding & Spacing:** Responsive

**Voorbeeld gebruik:**
- Desktop: 3 kolommen, verticale cards
- Tablet: 2 kolommen, verticale cards  
- Mobiel: 1 kolom, horizontale cards

---

## 🔄 Sync & Data

### Hipsy API Sync
Events worden automatisch gesynchroniseerd van Hipsy.nl:

- **WP-Cron:** Elk uur automatische sync
- **Handmatig:** Via admin dashboard  
- **Custom Post Type:** `hipsy_event`
- **Taxonomie:** `event_categorie`

### Meta Fields
Elk event bevat:
- `start_datum` — Event start  
- `eind_datum` — Event eind
- `start_tijd` / `eind_tijd`
- `locatie` — Event locatie
- `prijs_vanaf` — Minimale prijs
- `ticket_url` — Hipsy ticket link
- `afbeelding_url` — Event afbeelding

---

## 🛠️ Technische Details

### Query Systeem
```php
// Registreer query voor filter gebruik
hipsy_register_query( 'agenda', [
    'posts_per_page' => 6,
    'alleen_toekomst' => 'yes',
] );

// Haal events op
$query = hipsy_get_events_query( [
    'posts_per_page' => 12,
    'alleen_toekomst' => 'yes',
    'filter_categorie' => 'workshops',
] );
```

### Event Card Renderer
```php
hipsy_render_event_card( $event_id, [
    'layout' => 'grid',
    'show_image' => true,
    'show_date' => true,
    'max_words' => 20,
    'button_text' => 'Bestel tickets',
] );
```

---

## 📦 Bestandsstructuur

```
hipsy-events-builder/
├── core/
│   ├── query-system.php      → Query ID & event queries
│   └── ajax-filter.php        → AJAX filter handler
├── render/
│   └── event-card.php         → Unified card renderer
├── integrations/
│   └── elementor/
│       └── filter-bar-widget.php
├── widgets/
│   ├── hipsy-events-grid.php  → Main grid widget
│   └── hipsy-zoek-filter.php  → Legacy filter (v3.x)
├── functions/                 → Legacy functions
├── assets/
│   └── js/
│       └── ajax-filter.js     → AJAX filtering script
└── hipsy-events.php           → Main plugin file
```

---

## ⚙️ Requirements

- **WordPress:** 5.8+
- **PHP:** 7.4+
- **Elementor:** 3.0+ (optioneel, voor widgets)
- **Hipsy Account:** Voor API sync

---

## 🔄 Upgraden van v1.x/v3.x

### ✅ Backwards Compatible

Alle bestaande pagina's blijven werken:
- Bestaande Elementor widgets: ✅ Werken
- Bestaande shortcodes: ✅ Werken  
- Custom post type: ✅ Behouden
- Meta fields: ✅ Behouden
- API instellingen: ✅ Behouden

### 🆕 Nieuwe Features Toevoegen

1. **Voeg Filter Bar toe:**  
   - Kies een Query ID
   - Plaats boven je bestaande grid

2. **Update Grid Widget:**
   - Voeg dezelfde Query ID toe
   - Klaar! AJAX filtering werkt

---

## 🎯 Roadmap

### Fase 1 (v4.0) ✅
- AJAX filter systeem
- Query ID koppeling
- Event card renderer
- Architectuur herstructurering

### Fase 2 (v4.1) 📋
- Carousel improvements
- Single event widgets
- Related events widget

### Fase 3 (v4.2) 📋
- Location-based filtering
- Advanced sorting
- Export/import events

---

## 💬 Support

Voor vragen en support:
- **Email:** hello@youngsoulbusiness.com
- **Website:** youngsoulbusiness.com

---

## 📄 Licentie

Proprietary — Young Soul Business / NlwebMarketing
© 2024-2025 Nick van Asperen

---

**Gebouwd met ❤️ voor de bewuste community**
