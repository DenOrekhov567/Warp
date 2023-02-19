<?php

declare(strict_types=1);

namespace Warp;

use pocketmine\plugin\PluginBase;

use pocketmine\Server;

use Warp\command\SetWarpCommand;
use Warp\command\WarpCommand;
use Warp\command\RemoveWarpCommand;
use Warp\manager\WarpManager;

class Loader extends PluginBase
{

	public function onEnable(): void {
		$this->registerCommand();
		
		WarpManager::initTable();
		WarpManager::initData();
	}

	private function registerCommand(): void {
		Server::getInstance()->getCommandMap()->register("setwarp", new SetWarpCommand("setwarp"));
		Server::getInstance()->getCommandMap()->register("removewarp", new RemoveWarpCommand("removewarp"));
		Server::getInstance()->getCommandMap()->register("warp", new WarpCommand("warp"));
	}

	public function onDisable(): void {
		WarpManager::saveData();
	}

}