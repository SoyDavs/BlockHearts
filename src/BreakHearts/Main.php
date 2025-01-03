<?php
namespace BreakHearts;

use pocketmine\plugin\PluginBase;
use pocketmine\event\Listener;
use pocketmine\event\block\BlockBreakEvent;
use pocketmine\player\Player;
use pocketmine\utils\Config;
use pocketmine\entity\effect\VanillaEffects;
use pocketmine\entity\effect\EffectInstance;
use pocketmine\item\VanillaItems;

class Main extends PluginBase implements Listener {

    private Config $config;

    public function onEnable(): void {
        $this->saveDefaultConfig();
        $this->config = $this->getConfig();

        if (!$this->config->get("enabled", true)) {
            $this->getLogger()->warning("The BreakHearts plugin is disabled in the config.yml.");
            return;
        }

        $this->getServer()->getPluginManager()->registerEvents($this, $this);
    }

    public function onBlockBreak(BlockBreakEvent $event): void {
        if (!$this->config->get("enabled", true)) {
            return;
        }

        $player = $event->getPlayer();
        $block = $event->getBlock();
        $heartType = $this->getHeartType($block->getName());

        if ($heartType !== null) {
            $this->addHeart($player);
            $this->applyAbility($player, $heartType);

            $message = str_replace("{heart}", $heartType, $this->config->get("heart-gained-message", "You gained a {heart} heart!"));
            $player->sendMessage($message);
        }
    }

    private function getHeartType(string $blockName): ?string {
        $hearts = $this->config->get("blocks", []);
        return $hearts[$blockName] ?? null;
    }

    private function addHeart(Player $player): void {
        $currentHealth = $player->getMaxHealth();
        $player->setMaxHealth($currentHealth + 2);
    }

    private function applyAbility(Player $player, string $heartType): void {
    $effectsConfig = $this->config->get("effects", []);

    if (!isset($effectsConfig[$heartType])) {
        return;
    }

    $effects = $effectsConfig[$heartType];

    // Obtener todos los efectos disponibles
    $availableEffects = VanillaEffects::getAll();

    foreach ($effects as $effectName => $settings) {
        // Verifica si el efecto está disponible
        if (isset($availableEffects[$effectName])) {
            $effect = $availableEffects[$effectName];
            $duration = $settings["duration"] ?? 600;
            $amplifier = $settings["amplifier"] ?? 1;
            $instance = new EffectInstance($effect, $duration, $amplifier, false);
            $player->getEffects()->add($instance);
        }
    }

    if ($heartType === "Diamond") {
        $player->getInventory()->addItem(VanillaItems::DIAMOND()->setCount(3));
    }
}

}
?>
