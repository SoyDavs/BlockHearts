
# BreakHearts Plugin

**BreakHearts** is a PocketMine-MP plugin that enhances the experience of breaking certain blocks, granting players hearts and applying special abilities. When players break designated blocks, they gain health and unique effects based on the type of block broken.

## Features
- Players gain extra health when breaking specific blocks.
- Special effects are applied depending on the type of block broken.
- Configurable blocks and effects through a YAML configuration file.
- The ability to reward players with bonus items such as diamonds.

## Installation
1. Download the plugin and place it in your `plugins/` folder.
2. Restart the server to load the plugin.

## Configuration
The plugin uses a configuration file `config.yml` to define which blocks grant hearts and the corresponding effects. Below is the structure and an example configuration.

### Example `config.yml`:
```yaml
enabled: true
heart-gained-message: "You gained a {heart} heart!"
blocks:
  "Diamond Ore": "Diamond"
  "Gold Ore": "Gold"
  "Iron Ore": "Iron"
  "Coal Ore": "Coal"
effects:
  Diamond:
    LEVITATION:
      duration: 600
      amplifier: 2
  Gold:
    REGENERATION:
      duration: 600
      amplifier: 2
  Iron:
    RESISTANCE:
      duration: 600
      amplifier: 2
    STRENGTH:
      duration: 600
      amplifier: 1
  Coal:
    NIGHT_VISION:
      duration: 1200
      amplifier: 1
    SPEED:
      duration: 600
      amplifier: 2
```

### Configuration Breakdown:
- `enabled`: Whether the plugin is enabled (default: true).
- `heart-gained-message`: Message sent to the player when they gain a heart. The `{heart}` placeholder is replaced with the block type.
- `blocks`: A mapping of block names to heart types. When a block is broken, the corresponding heart type is granted.
- `effects`: A list of effects that will be applied based on the heart type. Effects are specified by name, with `duration` and `amplifier` options.

## How It Works
1. The plugin listens for `BlockBreakEvent`.
2. When a player breaks a block listed in the configuration, the plugin grants the player a heart and applies the relevant effects.
3. Special items (e.g., diamonds) are also given if defined.

## Supported Blocks and Effects
The plugin allows customization of which blocks grant which hearts and the associated effects. Below are the default effects tied to each heart type:

- **Diamond Heart**: Grants **Levitation** for 600 ticks with an amplifier of 2.
- **Gold Heart**: Grants **Regeneration** for 600 ticks with an amplifier of 2.
- **Iron Heart**: Grants **Resistance** for 600 ticks with an amplifier of 2, and **Strength** for 600 ticks with an amplifier of 1.
- **Coal Heart**: Grants **Night Vision** for 1200 ticks with an amplifier of 1, and **Speed** for 600 ticks with an amplifier of 2.

## Commands
- Currently, there are no commands for this plugin. All functionality is based on block breaking.

## Permissions
- No permissions are required for basic functionality.

## Troubleshooting
- **Plugin not working**: Ensure that the plugin is enabled in `config.yml` and that the blocks listed in `blocks:` are correct.
- **Effects not applying**: Double-check that the effects are properly defined in `config.yml` under `effects:`, and ensure that the player is breaking the correct type of block.

## License
This plugin is licensed under [MIT License](https://opensource.org/licenses/MIT).
