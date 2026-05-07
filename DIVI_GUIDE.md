# Hipsy Events Builder — Divi & Andere Builders

De plugin werkt met **ALLE** WordPress page builders via shortcodes!

---

## ✅ Compatibiliteit

- ✅ **Divi** (Elegant Themes)
- ✅ **Salient** (ThemeNectar)
- ✅ **WPBakery** (Visual Composer)
- ✅ **Beaver Builder**
- ✅ **Oxygen Builder**
- ✅ **Gutenberg** (WordPress block editor)
- ✅ **Bricks Builder**
- ✅ **Elementor** (via widgets + shortcodes)

**Methode:** Shortcodes in Code/Text blokken

---

## 📋 Beschikbare Shortcodes

### 1. Events Grid
Toont events in een grid layout:

```php
[hipsy_events_grid columns="3" aantal="6"]
```

**Parameters:**
- `columns` — Kolommen (1-4, default: 3)
- `aantal` — Max events (default: 6)
- `alleen_toekomst` — yes/no (default: yes)
- `categorie` — Filter op categorie slug
- `show_image` — yes/no
- `show_date` — yes/no
- `show_time` — yes/no
- `show_title` — yes/no
- `show_location` — yes/no
- `show_description` — yes/no
- `show_price` — yes/no
- `show_button` — yes/no
- `max_words` — Max woorden beschrijving (default: 20)
- `button_text` — Custom button tekst

**Voorbeelden:**
```php
[hipsy_events_grid columns="3" aantal="9"]

[hipsy_events_grid columns="2" categorie="workshops"]

[hipsy_events_grid columns="4" show_description="no" max_words="15"]
```

### 2. Events List
Toont events in lijst layout:

```php
[hipsy_events_list aantal="10"]
```

### 3. Filter Bar (v4.0) 🆕
AJAX filter (alleen als v4.0 ingeschakeld):

```php
[hipsy_filter query_id="agenda"]
[hipsy_events_grid query_id="agenda" columns="3"]
```

---

## 🎨 Gebruik in Divi

### Methode 1: Code Module

1. **Voeg Code Module toe**
   - Sleep "Code" module op je pagina
   - Of: + → Search "Code"

2. **Plak Shortcode**
   ```php
   [hipsy_events_grid columns="3" aantal="6"]
   ```

3. **Save & Preview**

### Methode 2: Text Module

1. **Voeg Text Module toe**
2. **Switch naar Text tab** (niet Visual)
3. **Plak shortcode**
4. **Save**

---

## 🎨 Gebruik in Salient

### Via Code Block

1. **Add Element** → **Code Block**
2. **Plak shortcode:**
   ```php
   [hipsy_events_grid columns="3"]
   ```
3. **Publish**

### Via Text Block

1. **Add Element** → **Text Block**
2. **Switch naar Text mode** (</> icon)
3. **Plak shortcode**
4. **Publish**

---

## 🎨 Gebruik in WPBakery

1. **Add Element**
2. **Zoek:** "Raw HTML" of "Raw JavaScript"
3. **Plak shortcode:**
   ```php
   [hipsy_events_grid columns="3" aantal="6"]
   ```
4. **Save**

---

## 🎨 Gebruik in Beaver Builder

1. **Add Module** → **HTML**
2. **Plak shortcode:**
   ```php
   [hipsy_events_grid columns="3"]
   ```
3. **Done → Publish**

---

## 🎨 Gebruik in Gutenberg

1. **Add Block** → **Shortcode**
2. **Plak shortcode:**
   ```php
   [hipsy_events_grid columns="3" aantal="6"]
   ```
3. **Publish**

---

## 🎯 Complete Voorbeeld Pagina's

### Simpele Event Agenda
```php
<h2>Aankomende Events</h2>
[hipsy_events_grid columns="3" aantal="9"]
```

### Gefilterde Events Per Categorie
```php
<h2>Workshops</h2>
[hipsy_events_grid columns="2" categorie="workshops" aantal="6"]

<h2>Retreats</h2>
[hipsy_events_grid columns="2" categorie="retreats" aantal="6"]
```

### Lijst Layout
```php
<h2>Alle Aankomende Events</h2>
[hipsy_events_list aantal="20"]
```

### Met Filtering (v4.0) 🆕
```php
<h2>Event Agenda</h2>
[hipsy_filter query_id="homepage"]
[hipsy_events_grid query_id="homepage" columns="3" aantal="12"]
```

---

## 🎨 Styling Aanpassen

De shortcodes gebruiken CSS classes die je kunt stylen:

### CSS Classes
```css
.hew-card          /* Hele event card */
.hew-card-img      /* Afbeelding */
.hew-card-body     /* Tekst content */
.hew-datum         /* Datum */
.hew-tijd          /* Tijd */
.hew-titel         /* Titel */
.hew-locatie       /* Locatie */
.hew-desc          /* Beschrijving */
.hew-prijs         /* Prijs */
.hew-ticket-btn    /* Ticket button */
```

### Voorbeeld Custom CSS

**In Divi:**
1. Divi → Theme Options → Custom CSS
2. Plak:

```css
/* Event cards kleuren aanpassen */
.hew-card {
    background: #f9fafb;
    border: 2px solid #e5e7eb;
    border-radius: 12px;
}

.hew-titel a {
    color: #7c3aed;
}

.hew-ticket-btn {
    background: #059669;
    color: white;
    padding: 12px 24px;
    border-radius: 8px;
}

.hew-ticket-btn:hover {
    background: #047857;
}
```

**In Salient:**
1. Salient → General Settings → Custom CSS
2. Plak dezelfde CSS

---

## 📱 Responsive

Shortcodes zijn automatisch responsive:

- **Desktop:** Aantal kolommen zoals ingesteld
- **Tablet:** Automatisch 2 kolommen
- **Mobiel:** Automatisch 1 kolom

---

## 🔧 v4.0 Features Inschakelen

Voor AJAX filtering en geavanceerde features:

1. **Ga naar:** Dashboard → Events → Settings
2. **Scroll naar beneden** tot "v4.0 Features"
3. **Check de box** "Enable v4.0 Features"
4. **Save Settings**
5. **Deactiveer en heractiveer** de plugin

**Result:** AJAX filtering werkt nu!

**Gebruik:**
```php
[hipsy_filter query_id="agenda" show_search="yes" show_categories="yes"]
[hipsy_events_grid query_id="agenda" columns="3"]
```

---

## ❓ FAQ

### Werkt dit ook zonder Elementor?

**Ja!** Shortcodes werken op ELKE WordPress site, met of zonder Elementor.

### Kan ik meerdere grids op 1 pagina zetten?

**Ja!** Gebruik verschillende parameters:

```php
[hipsy_events_grid columns="3" categorie="workshops"]
[hipsy_events_grid columns="2" categorie="retreats"]
```

### Kan ik de styling aanpassen?

**Ja!** Via Custom CSS in je theme/builder.

### Werkt filtering ook met Divi?

**Ja!** Als v4.0 ingeschakeld is:

```php
[hipsy_filter query_id="events"]
[hipsy_events_grid query_id="events"]
```

---

## 📞 Support

Voor vragen over shortcode gebruik:
**hello@youngsoulbusiness.com**

---

**Je hoeft GEEN nieuwe plugin — deze werkt al met Divi!** 🎉
