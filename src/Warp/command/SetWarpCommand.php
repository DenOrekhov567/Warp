<?php

declare(strict_types=1);

namespace Warp\command;

use pocketmine\command\Command;

use pocketmine\command\CommandSender;
use pocketmine\player\Player;

use Warp\manager\WarpManager;

class SetWarpCommand extends Command
{

	public function __construct($name) {
		parent::__construct($name);
	}

	public function execute(CommandSender $sender, $alias, array $args): bool {
		if(!$sender instanceof Player) {
			//Использование: /setwarp <name|x|y|z|worldName:string> 
			//Пример: /setwarp warp123|120|60|1000|spawn
			if(isset($args[0])) {
				$argList = explode("|", $args[0]);
				if(count($argList) === 7) {
					if(WarpManager::getWarp($argList[0]) === null) {
						$warpData = [
							"name" => $argList[0],
							"x" => (float)$argList[1],
							"y" => (float)$argList[2],
							"z" => (float)$argList[3],
							"worldName" => $argList[4],
							"yaw" => (float)$argList[5],
							"pitch" => (float)$argList[6]
						];
						WarpManager::setWarp($warpData);

						$sender->sendMessage("Варп ".$argList[0]." был создан!");
					} else {
						$sender->sendMessage("Варп ".$argList[0]." существует!");
					}

				} else {
					$sender->sendMessage("Использовать: /setwarp <name|x|y|z|worldName:string> ");
				}

			}

		}
		return true;
	}

}