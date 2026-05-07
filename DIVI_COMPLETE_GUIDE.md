# Hipsy Divi Modules — Complete Gids

Je hebt nu **9 Divi modules** om custom event templates te bouwen! 🎉

---

## 📋 Beschikbare Modules

### 1. 📄 Event Titel
Toon de event titel met link

**Opties:**
- HTML Tag (H1-H6, P, Div)
- Link naar event (Ja/Nee)

**Gebruik:**
```
Typ in Divi Builder: "Event Titel"
Sleep op pagina
```

---

### 2. 📅 Event Datum
Toon de event datum met custom formatting

**Opties:**
- Datum Format (03-05-2025, 03 Mei 2025, Zaterdag 3 Mei 2025, etc.)
- Custom Format (PHP date format)
- Toon Icoon (📅)

**Nederlandse maanden:** Automatisch vertaald!

---

### 3. 🕐 Event Tijd
Toon start/eindtijd

**Opties:**
- Tijd Format (14:30, 14.30, 2:30 PM)
- Toon Eindtijd (Ja/Nee)
- Scheiding ( - )
- Toon Icoon (🕐)

---

### 4. 📍 Event Locatie
Toon locatie met optionele Google Maps

**Opties:**
- Toon Icoon (📍)
- Toon Google Maps (Ja/Nee)
- Map Hoogte (100-600px)
- Link naar Google Maps (Ja/Nee)

---

### 5. 📝 Event Beschrijving
Toon event beschrijving (kort of volledig)

**Opties:**
- Lengte (Volledig / Excerpt / Beperkt aantal woorden)
- Max Woorden (10-200)
- Toon "Lees meer" (Ja/Nee)
- "Lees meer" Tekst

---

### 6. 🖼️ Event Afbeelding
Toon featured image

**Opties:**
- Afbeelding Grootte (Thumbnail / Medium / Large / Full)
- Link naar Event (Ja/Nee)
- Lightbox (Ja/Nee)
- Border Radius (0-50px)

---

### 7. 🎟️ Event Ticket Knop
CTA button naar ticketshop

**Opties:**
- Button Tekst
- Button Stijl (Primary / Secondary / Outline / Custom)
- Button Grootte (Klein / Medium / Groot)
- Volledige Breedte (Ja/Nee)
- Icoon (🎟️ / → / 🛒)
- Open in Nieuw Tabblad (Ja/Nee)

---

### 8. 🎫 Event Tickets Info
Toon ticket informatie & prijzen

**Opties:**
- Toon "Tickets" Titel (Ja/Nee)
- Titel Tekst
- Toon Prijzen (Ja/Nee)
- Toon Beschikbaarheid (Ja/Nee)
- Layout (Lijst / Tabel / Cards)

---

### 9. 📊 Events Grid
Toon meerdere events in grid/list

**Opties:**
- Layout (Grid / List)
- Kolommen (1-4, responsive)
- Aantal Events (1-50)
- Categorie Filter
- Content toggles (alle velden aan/uit)

---

## 🎨 CUSTOM EVENT TEMPLATE BOUWEN

### Voorbeeld 1: Single Event Page Template

```
┌─────────────────────────────┐
│  Event Afbeelding           │  (Full width, border radius 12px)
├─────────────────────────────┤
│  Event Titel (H1)           │  (Link: Nee)
├─────────────────────────────┤
│  Event Datum  📅  Event Tijd│  (2 kolommen)
├─────────────────────────────┤
│  Event Locatie 📍           │  (Met Google Maps)
├─────────────────────────────┤
│  Event Beschrijving         │  (Volledig)
├─────────────────────────────┤
│  Event Tickets Info         │  (Tabel layout)
├─────────────────────────────┤
│  Event Ticket Knop          │  (Full width, Primary style)
└─────────────────────────────┘
```

### Voorbeeld 2: Event Card in Loop

```
┌──────────────┐
│  Afbeelding  │  (Medium, link: ja)
├──────────────┤
│  Titel (H3)  │  (Link: ja)
├──────────────┤
│  Datum Tijd  │  (Iconen: ja)
├──────────────┤
│  Beschrijving│  (50 woorden, "Lees meer")
├──────────────┤
│  Ticket Knop │  (Medium, Outline)
└──────────────┘
```

### Voorbeeld 3: Event Archive Page

```
┌─────────────────────────────┐
│  Events Grid                │  (3 kolommen)
│  ┌────┐ ┌────┐ ┌────┐      │
│  │    │ │    │ │    │      │  (Grid layout)
│  └────┘ └────┘ └────┘      │
│  ┌────┐ ┌────┐ ┌────┐      │
│  │    │ │    │ │    │      │
│  └────┘ └────┘ └────┘      │
└─────────────────────────────┘
```

---

## 🔧 ZO GEBRUIK JE DE MODULES

### Stap 1: Divi Template Aanmaken

1. **Divi → Theme Builder**
2. **Add New Template**
3. Kies **Custom Body** voor "Events" post type
4. **Build Custom Body**

### Stap 2: Modules Toevoegen

1. **+ Add New Module**
2. **Zoek:** "Event" (je ziet alle 9 modules!)
3. **Sleep** modules op je pagina
4. **Configure** elke module

### Stap 3: Styling

Elke module heeft:
- **Content** tab → Opties
- **Design** tab → Styling (spacing, colors, fonts)
- **Advanced** tab → Custom CSS, visibility

### Stap 4: Save & Apply

1. **Save** template
2. **Publish**
3. **Ga naar een event** om te zien

---

## 💡 TIPS & TRICKS

### Responsive Columns

Voor **Events Grid** module:
1. Klik **📱 icon** naast "Kolommen"
2. Stel in:
   - 🖥️ Desktop: 3 kolommen
   - 📱 Tablet: 2 kolommen
   - 📱 Mobiel: 1 kolom

### Custom Button Kleuren

**Event Ticket Knop** → Advanced tab:
```css
/* Custom CSS */
background: #10b981 !important;
color: white !important;
```

### Datum in Nederlands

**Event Datum** module vertaalt automatisch:
- January → Januari
- Monday → Maandag
- etc.

### Locatie Zonder Google Maps API

Google Maps embed werkt **zonder API key**, maar:
- Beperkte features
- "For development purposes only" watermark

Voor productie: [Google Maps API key aanmaken](https://console.cloud.google.com/)

---

## 🎨 VOORBEELDEN

### Minimalist Card
```
Afbeelding: Full width
Titel: H2, geen link
Datum + Tijd: Kleine icons
Beschrijving: 30 woorden
Button: Outline, medium
```

### Full Event Page
```
Afbeelding: Large, border radius 16px
Titel: H1
Datum, Tijd, Locatie: Alle met icons
Beschrijving: Volledig
Tickets Info: Tabel layout
Button: Primary, full width
```

### Compact List Item
```
Titel: H3, link
Datum: Zonder icon, format "d M"
Button: Klein, secondary
```

---

## ❓ FAQ

### Werken modules alleen op event post type?

**Ja!** Modules halen data van current event post.

### Kan ik multiple events tonen?

**Events Grid** module toont meerdere events.  
Andere modules = single event fields.

### Kan ik styling aanpassen?

**Ja!** Via:
1. Divi's Design tab
2. Custom CSS (Advanced tab)
3. Global CSS in theme

### Werkt dit met Divi Library?

**Ja!** Maak layouts in Divi Library en hergebruik ze.

### Kan ik conditionals gebruiken?

**Ja!** Divi's Display Conditions werken normaal.

---

## 🚀 NEXT LEVEL

### Global Event Card Layout

1. Maak layout in **Divi Library**
2. Gebruik in meerdere templates
3. 1x aanpassen = overal updated

### Dynamic Content

Alle modules tonen **live data** van het event.  
Perfect voor:
- Archive pages
- Single event pages
- Related events
- Event widgets

### Custom Post Layouts

Combineer met Divi's andere modules:
- Text modules
- Dividers
- Spacers
- Custom CSS

---

## 📞 Support

Vragen over Divi modules?  
**hello@youngsoulbusiness.com**

---

## ✅ Checklist

- [ ] Divi geactiveerd
- [ ] Plugin geactiveerd
- [ ] Events gesynchroniseerd
- [ ] Template aangemaakt in Theme Builder
- [ ] Modules toegevoegd
- [ ] Styling aangepast
- [ ] Template gepubliceerd
- [ ] Event bekeken op frontend

**Klaar om je eigen event designs te maken!** 🎨
