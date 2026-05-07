# ACTIVATIE INSTRUCTIES

## 🚨 BELANGRIJK: Safe Mode

De plugin is nu in **Safe Mode** — dit betekent dat alleen de basis functionaliteit actief is.
Alle v4.0 features (AJAX filtering, nieuwe widgets, etc.) zijn UITGESCHAKELD.

### ✅ Stap 1: Activeer de Plugin

De plugin zou nu ZONDER ERRORS moeten activeren.

1. Upload `hipsy-events-builder-v4.0.0.zip`
2. Installeer via WordPress Admin
3. Activeer de plugin

**Result:** Plugin is actief met de legacy/v3.x functionaliteit.

---

## 🚀 Stap 2: v4.0 Features Inschakelen (Optioneel)

Als de plugin succesvol is geactiveerd en je wilt de nieuwe v4.0 features gebruiken:

### Activeer v4.0 Mode

Voeg deze regel toe aan `wp-config.php`:

```php
define('HIPSY_V4_ENABLED', true);
```

**Plaats dit BOVEN de regel:**
```php
/* That's all, stop editing! Happy publishing. */
```

### v4.0 Features die worden ingeschakeld:

✅ AJAX Filter Systeem  
✅ Query ID Koppeling  
✅ Nieuwe Elementor Filter Bar Widget  
✅ Uitgebreide Shortcodes met filtering  
✅ Event Card Renderer  

---

## ⚠️ Troubleshooting

### Plugin activeert niet

**Oplossing:** Laat v4.0 uitgeschakeld (NIET in wp-config.php zetten).
De plugin werkt perfect in legacy mode.

### v4.0 Features werken niet

**Check:**
1. Is `define('HIPSY_V4_ENABLED', true);` toegevoegd aan wp-config.php?
2. Staat het BOVEN de "stop editing" regel?
3. Geen syntax errors in wp-config.php?

**Test:**
- Deactiveer en heractiveer de plugin
- Clear cache
- Check WordPress debug log

### Errors na v4.0 inschakelen

**Fix:**
1. Verwijder `define('HIPSY_V4_ENABLED', true);` uit wp-config.php
2. Plugin werkt weer in legacy mode
3. Meld error aan: hello@youngsoulbusiness.com

---

## 📋 Wat Werkt in Welke Mode?

### Legacy Mode (Standaard)
✅ Hipsy API Sync  
✅ Custom Post Type "Events"  
✅ Bestaande Elementor Widgets  
✅ Bestaande Shortcodes  
✅ Grid/List/Carousel layouts  
✅ Gutenberg blocks  

### v4.0 Mode (Met HIPSY_V4_ENABLED)
✅ Alles van Legacy Mode  
✅ AJAX Filtering (nieuw!)  
✅ Filter Bar Widget (nieuw!)  
✅ Query ID Koppeling (nieuw!)  
✅ [hipsy_filter] shortcode (nieuw!)  
✅ [hipsy_events_grid] met query_id (nieuw!)  

---

## 💡 Aanbeveling

**Voor Productie Sites:**
Start in Legacy Mode, test alles, schakel dan v4.0 in.

**Voor Test Sites:**
Schakel direct v4.0 in om de nieuwe features te testen.

---

## 📞 Support

hello@youngsoulbusiness.com

---

**De plugin is gebouwd voor maximale backwards compatibility.**
Als v4.0 problemen geeft, draai gewoon in legacy mode! 🚀
