<?php

declare(strict_types=1);

namespace Warp\command;

use pocketmine\command\Command;

use pocketmine\command\CommandSender;
use pocketmine\player\Player;

use Warp\manager\WarpManager;

class RemoveWarpCommand extends Command
{

	public function __construct($name) {
		parent::__construct($name);
	}

	public function execute(CommandSender $sender, $alias, array $args): bool {
		if(!$sender instanceof Player) {
			if(isset($args[0])) {
				if(WarpManager::getWarp($args[0]) !== null) {
					WarpManager::removeWarp($args[0]);

					$sender->sendMessage("Варп ".$args[0]." был удален!");
				} else {
					$sender->sendMessage("Варпа ".$args[0]." не существует!");
				}
				
			} else {
				$sender->sendMessage("Использовать: /removewarp <name:string>");
			}

		}
		return true;
	}

}