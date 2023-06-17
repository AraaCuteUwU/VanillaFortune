<?php

namespace FiraAja\VanillaFortune;

use pocketmine\block\BlockTypeIds;
use pocketmine\data\bedrock\EnchantmentIdMap;
use pocketmine\data\bedrock\EnchantmentIds;
use pocketmine\event\block\BlockBreakEvent;
use pocketmine\event\Listener;

class EventListener implements Listener {

    /**
     * @param BlockBreakEvent $event
     * @return void
     */
    public function onBreak(BlockBreakEvent $event): void
    {
        $block = $event->getBlock();
        $drops = $event->getDrops();
        if ($event->isCancelled()) return;

        $fortuneLevel = $event->getItem()->getEnchantmentLevel(EnchantmentIdMap::getInstance()->fromId(EnchantmentIds::FORTUNE));
        if ($fortuneLevel >= 1 && count($drops) === 1) {
            $drop = $drops[$key = array_key_first($drops)];
            $fortune = $drop->getCount();

            switch ($block->getIdInfo()->getBlockTypeId()) {
                case BlockTypeIds::COPPER_ORE:
                case BlockTypeIds::DIAMOND_ORE:
                case BlockTypeIds::EMERALD_ORE:
                case BlockTypeIds::REDSTONE_ORE:
                case BlockTypeIds::NETHER_QUARTZ_ORE:
                case BlockTypeIds::IRON_ORE:
                case BlockTypeIds::GOLD_ORE:
                case BlockTypeIds::GLOWSTONE:
                case BlockTypeIds::COAL_ORE:
                case BlockTypeIds::DEEPSLATE_COPPER_ORE:
                case BlockTypeIds::DEEPSLATE_COAL_ORE:
                case BlockTypeIds::DEEPSLATE_IRON_ORE:
                case BlockTypeIds::DEEPSLATE_GOLD_ORE:
                case BlockTypeIds::DEEPSLATE_DIAMOND_ORE:
                case BlockTypeIds::DEEPSLATE_EMERALD_ORE:
                    $fortune += mt_rand(0, $fortuneLevel);
                    break;
                case BlockTypeIds::LAPIS_LAZULI_ORE:
                    $fortune = mt_rand(4, 9 * ($fortuneLevel));
                    break;
            }
            if ($fortune !== $drop->getCount()) {
                $drop->setCount($fortune);
                $drops[$key] = $drop;
                $event->setDrops($drops);
            }
        }
    }
}