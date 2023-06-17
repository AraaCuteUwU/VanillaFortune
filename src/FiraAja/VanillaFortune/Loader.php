<?php

namespace FiraAja\VanillaFortune;

use pocketmine\data\bedrock\EnchantmentIdMap;
use pocketmine\data\bedrock\EnchantmentIds;
use pocketmine\item\enchantment\StringToEnchantmentParser;
use pocketmine\plugin\PluginBase;

class Loader extends PluginBase {

    protected function onEnable(): void{
        $enchantIdMap = EnchantmentIdMap::getInstance();
        $enchantParser = StringToEnchantmentParser::getInstance();
        $enchantIdMap->register(EnchantmentIds::FORTUNE, EnchantIds::FORTUNE());
        $enchantParser->register("fortune", fn() => EnchantIds::FORTUNE());

        $this->getServer()->getPluginManager()->registerEvents(new EventListener(), $this);
    }
}