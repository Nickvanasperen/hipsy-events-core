# v4.4.0 — Flatsome Support Toegevoegd

**Release Date:** 2025-05-03

## Added

✨ **FLATSOME (UX BUILDER) SUPPORT**
- Nieuwe Flatsome/UX Builder integratie
- Events Grid element in UX Builder
- Exact dezelfde functionaliteit als Elementor & Divi
- Grid, Lijst, Carrousel layouts werkend
- Alle content toggles (datum/tijd/locatie/etc.)
- Filter opties (aantal, sortering)
- Flatsome button styling (`.button`, `.primary`)

## Technical

**File Added:**
- `integrations/flatsome/flatsome-loader.php`

**Main Plugin File Updated:**
- Versie: 4.4.0
- Flatsome loader toegevoegd (regel 82-85)

**Compatibility:**
- ✅ Elementor (unchanged)
- ✅ Divi (unchanged)
- ✅ Flatsome (NEW!)
- ✅ Shortcodes (unchanged)

**Structure:**
- GEEN wijzigingen in bestaande structuur
- Flatsome toegevoegd in `integrations/flatsome/`
- Volgt exact hetzelfde patroon als Divi
- Volledig backward compatible

## Fixed

- Alle bestaande features blijven werken
- Events blijven zichtbaar
- Admin menu blijft zichtbaar
- Geen breaking changes

## Usage

**In Flatsome UX Builder:**
1. Open UX Builder
2. Add Element → Hipsy Events → Events Grid
3. Configureer layout, kolommen, filters
4. Done!

**Shortcode (werkt overal):**
```
[hipsy_events_grid layout="lijst" kolommen="3" aantal="12"]
```

---

**v4.4.0 = Veilige update met Flatsome support!** ✅
