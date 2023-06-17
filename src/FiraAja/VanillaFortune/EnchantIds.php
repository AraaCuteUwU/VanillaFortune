<?php

namespace FiraAja\VanillaFortune;

use pocketmine\item\enchantment\Enchantment;
use pocketmine\item\enchantment\ItemFlags;
use pocketmine\item\enchantment\Rarity;
use pocketmine\lang\KnownTranslationFactory;
use pocketmine\utils\RegistryTrait;

/**
 * @method static Enchantment FORTUNE()
 */
class EnchantIds {
    use RegistryTrait;

    /**
     * @return void
     */
    protected static function setup(): void {
        self::_registryRegister("FORTUNE", new Enchantment(KnownTranslationFactory::enchantment_lootBonusDigger(), Rarity::RARE, ItemFlags::DIG, ItemFlags::NONE, 3));
    }
}