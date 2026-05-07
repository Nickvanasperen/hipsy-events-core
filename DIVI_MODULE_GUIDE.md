# Hipsy Events — Divi Module Handleiding

De plugin heeft nu **native Divi modules** 🎉

---

## ✅ Wat is Er Nu Nieuw?

Je hebt nu **2 manieren** om events te tonen in Divi:

1. **Divi Module** (NIEUW!) — Visuele builder interface
2. **Shortcodes** — Via Code/Text modules

---

## 🎯 Divi Module Gebruiken

### Stap 1: Open Divi Builder

1. Open je pagina in Divi
2. Klik **Use Divi Builder**

### Stap 2: Module Toevoegen

1. Klik op **+ Add New Module**
2. **Zoek:** "Hipsy Events Grid"
3. Klik om toe te voegen

### Stap 3: Configureren

De module heeft 3 tabbladen met opties:

#### Tab 1: Layout

- **Layout:** Grid of List
- **Kolommen:** 1-4 kolommen (responsive!)
- **Tussenruimte:** Ruimte tussen cards (px)

#### Tab 2: Query & Filtering

- **Aantal Events:** Hoeveel events tonen (1-50)
- **Alleen Aankomende Events:** Ja/Nee toggle
- **Categorie Filter:** Filter op specifieke categorie

#### Tab 3: Velden Tonen/Verbergen

Toggle elk veld aan/uit:
- ✅ Toon Afbeelding
- ✅ Toon Datum
- ✅ Toon Tijd
- ✅ Toon Titel
- ✅ Toon Locatie
- ✅ Toon Beschrijving
- ✅ Toon Prijs
- ✅ Toon Button

**Extra opties:**
- **Max Woorden Beschrijving:** Inkorten (0-100 woorden)
- **Button Tekst:** Custom button tekst

### Stap 4: Save & Publish

Klaar! Events worden nu getoond met je instellingen.

---

## 🎨 Responsive Controls

De **Kolommen** setting heeft responsive opties:

1. Klik op het **📱 telefoon icoontje** naast "Kolommen"
2. Stel in voor:
   - 🖥️ **Desktop:** Bijvoorbeeld 3 kolommen
   - 📱 **Tablet:** Bijvoorbeeld 2 kolommen
   - 📱 **Mobiel:** Bijvoorbeeld 1 kolom

---

## 💡 Voorbeelden

### Voorbeeld 1: Simpele Grid
```
Layout: Grid
Kolommen: 3 (desktop) / 2 (tablet) / 1 (mobiel)
Aantal Events: 9
Alleen Aankomende: Ja
```

### Voorbeeld 2: Lijst Met Categorieën
```
Layout: List
Kolommen: 1
Aantal Events: 20
Categorie Filter: Workshops
```

### Voorbeeld 3: Compact Grid
```
Layout: Grid
Kolommen: 4
Toon Beschrijving: Nee
Toon Prijs: Nee
Max Woorden: 0
```

---

## 🔧 Styling Aanpassen

### Via Divi's Design Tab

Elke Divi module heeft automatisch **Design** en **Advanced** tabs:

**Design Tab:**
- Spacing (padding/margin)
- Border & Shadow
- Filters & Animation

**Advanced Tab:**
- Custom CSS
- Visibility
- Transitions

### Custom CSS Classes

De module genereert deze CSS classes:

```css
.hipsy-divi-grid         /* Wrapper */
.hipsy-divi-layout-grid  /* Grid layout */
.hipsy-divi-layout-list  /* List layout */
.hew-card                /* Event card */
.hew-card-img            /* Afbeelding */
.hew-titel               /* Titel */
.hew-datum               /* Datum */
.hew-locatie             /* Locatie */
.hew-ticket-btn          /* Button */
```

**Voorbeeld Custom CSS:**
```css
/* Purple gradient achtergrond voor cards */
.hew-card {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    color: white;
    border-radius: 16px;
}

/* Groene button */
.hew-ticket-btn {
    background: #10b981;
    border-radius: 8px;
}

.hew-ticket-btn:hover {
    background: #059669;
}
```

---

## 🆚 Divi Module vs Shortcode

| Feature | Divi Module | Shortcode |
|---------|-------------|-----------|
| Visuele interface | ✅ Ja | ❌ Nee |
| Live preview | ✅ Ja | ❌ Nee |
| Responsive controls | ✅ Ja | ⚠️ Beperkt |
| Design opties | ✅ Volledig | ⚠️ Via CSS |
| Makkelijk aanpassen | ✅ Ja | ❌ Code kennis nodig |

**Advies:** Gebruik **Divi Module** voor beste ervaring!

---

## ❓ Troubleshooting

### Module Verschijnt Niet in Divi

**Oplossing:**
1. Check of Divi **actief** is
2. Deactiveer plugin
3. Heractiveer plugin
4. Refresh Divi Builder

### Events Worden Niet Getoond

**Check:**
1. Zijn er events gesynchroniseerd? (Dashboard → Events)
2. Staat **Alleen Aankomende Events** op Ja? (verander naar Nee voor test)
3. Is er een categorie filter actief?

### Styling Werkt Niet

**Check:**
1. Gebruik je **Custom CSS** in de Design tab?
2. Zijn de CSS classes correct?
3. Probeer `!important` toe te voegen:
   ```css
   .hew-card {
       background: purple !important;
   }
   ```

---

## 🎯 Volgende Stappen

### Meer Divi Modules Komend

Binnenkort worden toegevoegd:
- **Hipsy Filter Bar** (AJAX filtering in Divi)
- **Hipsy Event Details** (voor single event pages)
- **Hipsy Carousel** (swiper/slider layout)

---

## 📞 Support

Voor vragen over Divi modules:
**hello@youngsoulbusiness.com**

---

## 🚀 Conclusie

**Je hebt nu 3 manieren om events te tonen:**

1. ✅ **Elementor** — Elementor widgets
2. ✅ **Divi** — Native Divi modules (NIEUW!)
3. ✅ **Andere builders** — Shortcodes

**1 plugin, alle builders!** 🎉
