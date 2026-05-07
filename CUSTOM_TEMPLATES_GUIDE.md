# Custom Event Templates Bouwen — Handleiding

Nu kun je **exact de Mandira Utrecht designs nabouwen** met volledige controle over HTML & CSS! 🎨

---

## 🎯 WAT HEB JE NU?

### **3 Manieren Om Data Te Gebruiken:**

1. ✅ **Shortcodes** — In HTML/Text blokken
2. ✅ **Divi Dynamic Content** — In Divi dropdown menu (screenshot!)
3. ✅ **Elementor Dynamic Tags** — In Elementor dropdown menu

**= Volledige vrijheid om de Mandira designs na te bouwen!**

---

## 📍 WAAR VIND JE DE FIELDS?

### In Divi (jouw screenshot!)

**Locatie:** Dynamic Content dropdown menu

1. **Open een Text Module / Button / etc.**
2. **Klik in content veld** waar je tekst wilt
3. **Klik het ⚡ icoontje** (Dynamic Content)
4. **Scroll naar "Aangepast veld" sectie**
5. **Zie:** 
   - hipsy_events_titel
   - hipsy_events_datum
   - hipsy_events_tijd
   - hipsy_events_location
   - hipsy_events_beschrijving
   - hipsy_events_categorieen
   - hipsy_events_prijs
   - hipsy_events_link
   - hipsy_events_permalink
   - hipsy_events_afbeelding

**Ze staan tussen "Bericht" en "Archief" in het menu!**

### In Elementor

**Locatie:** Dynamic Tags dropdown

1. **Open een Heading / Text / Button widget**
2. **Klik op content veld**
3. **Klik het 🔗 icoontje** (Dynamic Tags)
4. **Kies groep: "Hipsy Events"**
5. **Zie:**
   - Event Titel
   - Event Datum (met format optie)
   - Event Tijd (met eindtijd toggle)
   - Event Locatie
   - Event Beschrijving (met max woorden)
   - Event Categorieën
   - Event Prijs
   - Event Ticket URL (voor buttons!)
   - Event Afbeelding URL

---

## 📋 BESCHIKBARE FIELDS

### Shortcodes (overal te gebruiken)

```html
[event_title link="yes" tag="h2"]
[event_date format="d M Y"]
[event_time format="H:i" end="yes" separator=" - "]
[event_location link="yes"]
[event_description length="100" readmore="yes"]
[event_image size="large" link="yes"]
[event_categories separator=", " link="yes"]
[event_price prefix="Vanaf €" free_text="Gratis"]
[event_ticket_url]
[event_link]
[event_button text="Aanmelden →" class="btn-aanmelden"]
```

### Divi Dynamic Content (in Divi modules)

Ga naar **Text module → Content → Insert Dynamic Content → Hipsy Events**

Beschikbaar:
- Event Titel
- Event Datum (met format optie)
- Event Tijd (met format + eindtijd optie)
- Event Locatie
- Event Beschrijving (met max woorden)
- Event Categorieën
- Event Prijs
- Event Ticket URL (voor buttons)
- Event Link
- Event Afbeelding URL

---

## 🏗️ MANDIRA DESIGN NABOUWEN

### Design 1: Event Card (Grid Layout)

**HTML in Code Module:**
```html
<div class="mandira-event-card">
  <!-- Afbeelding -->
  <div class="event-image">
    [event_image size="large" link="yes"]
  </div>
  
  <!-- Datum Badge -->
  <div class="date-badge">
    <span class="month">MEI</span>
    <span class="day">[event_date format="d"]</span>
  </div>
  
  <!-- Tags -->
  <div class="event-tags">
    [event_categories]
  </div>
  
  <!-- Content -->
  <div class="event-content">
    <h3 class="event-title">
      <a href="[event_link]">[event_title]</a>
    </h3>
    
    <div class="event-meta">
      <div class="meta-item">
        <span class="icon">📅</span>
        <span class="text">[event_date format="l j F Y"]</span>
      </div>
      <div class="meta-item">
        <span class="icon">🕐</span>
        <span class="text">[event_time format="H:i" end="yes"]</span>
      </div>
      <div class="meta-item">
        <span class="icon">📍</span>
        <span class="text">[event_location]</span>
      </div>
    </div>
    
    <div class="event-description">
      [event_description length="50" readmore="no"]
    </div>
  </div>
</div>
```

**CSS (in Divi → Theme Options → Custom CSS):**
```css
.mandira-event-card {
  position: relative;
  background: #fff;
  border-radius: 12px;
  overflow: hidden;
  box-shadow: 0 2px 8px rgba(0,0,0,0.1);
  transition: transform 0.3s ease;
}

.mandira-event-card:hover {
  transform: translateY(-5px);
  box-shadow: 0 4px 16px rgba(0,0,0,0.15);
}

.event-image {
  position: relative;
  overflow: hidden;
  height: 250px;
}

.event-image img {
  width: 100%;
  height: 100%;
  object-fit: cover;
}

.date-badge {
  position: absolute;
  top: 15px;
  left: 15px;
  background: #fff;
  padding: 10px 15px;
  border-radius: 8px;
  text-align: center;
  box-shadow: 0 2px 8px rgba(0,0,0,0.2);
}

.date-badge .month {
  display: block;
  font-size: 12px;
  font-weight: 600;
  color: #666;
  text-transform: uppercase;
}

.date-badge .day {
  display: block;
  font-size: 24px;
  font-weight: 700;
  color: #333;
  line-height: 1;
}

.event-tags {
  position: absolute;
  bottom: 15px;
  left: 15px;
  display: flex;
  gap: 8px;
  flex-wrap: wrap;
}

.event-tags span {
  background: rgba(124, 58, 237, 0.9);
  color: #fff;
  padding: 6px 12px;
  border-radius: 20px;
  font-size: 12px;
  font-weight: 600;
  text-transform: uppercase;
}

.event-content {
  padding: 20px;
}

.event-title {
  margin: 0 0 15px 0;
  font-size: 20px;
  line-height: 1.3;
}

.event-title a {
  color: #333;
  text-decoration: none;
  transition: color 0.3s ease;
}

.event-title a:hover {
  color: #7c3aed;
}

.event-meta {
  margin-bottom: 15px;
}

.meta-item {
  display: flex;
  align-items: center;
  gap: 8px;
  margin-bottom: 8px;
  font-size: 14px;
  color: #666;
}

.meta-item .icon {
  font-size: 16px;
}

.event-description {
  color: #666;
  font-size: 14px;
  line-height: 1.6;
}
```

---

### Design 2: List Layout (met Button)

**HTML:**
```html
<div class="mandira-event-list">
  <div class="event-image">
    [event_image size="medium"]
  </div>
  
  <div class="event-info">
    <div class="event-header">
      <div class="event-date">
        ZATERDAG 16 MEI 2026 <span class="time">🕐 10:30 - 17:30</span>
      </div>
      <h3>[event_title]</h3>
    </div>
    
    <div class="event-location">
      📍 [event_location link="yes"]
    </div>
    
    <div class="event-description">
      [event_description length="75"]
    </div>
    
    <div class="event-footer">
      <div class="event-price">[event_price]</div>
      [event_button text="Meer info →" class="btn-meer-info"]
    </div>
  </div>
</div>
```

**CSS:**
```css
.mandira-event-list {
  display: flex;
  gap: 25px;
  background: #f9fafb;
  border-radius: 12px;
  padding: 20px;
  margin-bottom: 20px;
  border-left: 4px solid #7c3aed;
}

.mandira-event-list .event-image {
  flex: 0 0 230px;
  border-radius: 8px;
  overflow: hidden;
}

.mandira-event-list .event-image img {
  width: 100%;
  height: 180px;
  object-fit: cover;
}

.event-info {
  flex: 1;
}

.event-header {
  margin-bottom: 15px;
}

.event-date {
  font-size: 12px;
  font-weight: 600;
  color: #7c3aed;
  text-transform: uppercase;
  margin-bottom: 8px;
}

.event-date .time {
  color: #666;
  margin-left: 10px;
}

.event-info h3 {
  margin: 0;
  font-size: 22px;
  color: #333;
}

.event-location {
  margin-bottom: 12px;
  color: #666;
  font-size: 14px;
}

.event-location a {
  color: #7c3aed;
  text-decoration: none;
}

.event-footer {
  display: flex;
  justify-content: space-between;
  align-items: center;
  margin-top: 15px;
}

.event-price {
  font-size: 18px;
  font-weight: 700;
  color: #10b981;
}

.btn-meer-info {
  display: inline-block;
  padding: 10px 20px;
  background: #7c3aed;
  color: #fff;
  text-decoration: none;
  border-radius: 6px;
  font-weight: 600;
  transition: background 0.3s ease;
}

.btn-meer-info:hover {
  background: #6d28d9;
}
```

---

### Design 3: Locatie Filters (zoals Mandira)

**HTML met Dynamic Categories:**
```html
<div class="location-filters">
  <button class="filter-btn active" data-location="alle">
    Alle locaties
  </button>
  <button class="filter-btn" data-location="utrecht">
    🟢 Utrecht
  </button>
  <button class="filter-btn" data-location="rotterdam">
    🔴 Rotterdam
  </button>
  <button class="filter-btn" data-location="nijmegen">
    🟣 Nijmegen
  </button>
</div>
```

**CSS:**
```css
.location-filters {
  display: flex;
  gap: 10px;
  flex-wrap: wrap;
  margin-bottom: 30px;
}

.filter-btn {
  padding: 10px 20px;
  background: #fff;
  border: 2px solid #e5e7eb;
  border-radius: 25px;
  font-weight: 600;
  cursor: pointer;
  transition: all 0.3s ease;
}

.filter-btn:hover {
  border-color: #7c3aed;
  color: #7c3aed;
}

.filter-btn.active {
  background: #10b981;
  color: #fff;
  border-color: #10b981;
}
```

---

## 🎨 IN DIVI THEME BUILDER

### Single Event Template

1. **Divi → Theme Builder → Add New Template**
2. **Custom Body for "Events"**
3. **Build Custom Body**

**Structuur:**
```
Row 1: Event Header
├─ Column 1 (60%): Event Image
└─ Column 2 (40%): 
   ├─ Text Module: [event_date] + [event_time]
   ├─ Title Module: Use Dynamic Content → Event Titel
   ├─ Text Module: [event_location]
   └─ Button: URL = Dynamic Content → Event Ticket URL

Row 2: Event Content
├─ Text Module: [event_description]
└─ Event Tickets Module (Divi module)

Row 3: Related Events
└─ Events Grid Module (3 kolommen)
```

### Archive Template

1. **Divi → Theme Builder → Add New Template**
2. **Archive for "Events"**

**Gebruik:**
- Code Module met custom HTML (zoals boven)
- OF Events Grid Divi module

---

## 💡 PRO TIPS

### Tip 1: Responsive Date Badge

```css
@media (max-width: 768px) {
  .date-badge {
    position: static;
    display: inline-block;
    margin-bottom: 15px;
  }
}
```

### Tip 2: Hover Effects
```css
.event-image img {
  transition: transform 0.3s ease;
}

.mandira-event-card:hover .event-image img {
  transform: scale(1.05);
}
```

### Tip 3: Category Colors
```css
.event-tags span[data-category="tantra"] {
  background: #d946ef;
}

.event-tags span[data-category="meditatie"] {
  background: #10b981;
}
```

---

## ⚡ QUICK START

### Stap 1: Maak Custom CSS File

**Divi → Theme Options → Custom CSS**

Plak alle CSS van boven erin.

### Stap 2: Maak Event Archive

1. **Nieuwe pagina aanmaken**
2. **Use Divi Builder**
3. **Add Code Module**
4. **Plak HTML** (Design 1 of 2)
5. **Publish**

### Stap 3: Test!

Ga naar je pagina en zie je custom design! 🎉

---

## 📚 ALLE SHORTCODE OPTIES

### [event_date]
```
[event_date format="d M Y"]
[event_date format="l j F Y"]  (Zaterdag 3 Mei 2025)
[event_date format="D j M"]    (Za 3 Mei)
```

### [event_time]
```
[event_time format="H:i"]
[event_time format="H:i" end="yes" separator=" - "]
[event_time format="g:i A"]  (2:30 PM)
```

### [event_description]
```
[event_description length="50"]
[event_description length="100" readmore="yes"]
[event_description]  (volledig)
```

### [event_image]
```
[event_image size="thumbnail"]
[event_image size="medium" link="yes"]
[event_image size="large"]
```

### [event_button]
```
[event_button text="Bestel tickets"]
[event_button text="Aanmelden →" class="custom-btn"]
[event_button text="Meer info" target="_self"]
```

---

## ✅ CHECKLIST

- [ ] Plugin geactiveerd & events gesynchroniseerd
- [ ] Custom CSS toegevoegd aan Divi
- [ ] HTML template gebouwd (Code Module)
- [ ] Shortcodes toegevoegd
- [ ] Styling getest
- [ ] Responsive getest
- [ ] Live!

**Nu kun je exact de Mandira designs nabouwen!** 🎨

---

## 🆘 TROUBLESHOOTING

### Shortcodes tonen als tekst

**Probleem:** `[event_title]` verschijnt letterlijk  
**Oplossing:** Gebruik **Code Module** (niet Text Module)

### Dynamic Content werkt niet in Divi

**Probleem:** "Hipsy Events" verschijnt niet in dropdown  
**Oplossing:** 
1. Zorg dat je op een Events post type bent
2. Refresh Divi Builder
3. Check of plugin actief is

### Styling werkt niet

**Probleem:** CSS heeft geen effect  
**Oplossing:** Voeg `!important` toe of verhoog specificity

---

## 📞 Support

Vragen?  
**hello@youngsoulbusiness.com**

**Je hebt nu volledige controle!** 🚀
