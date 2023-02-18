<?php

declare(strict_types=1);

namespace Warp\command;

use pocketmine\command\Command;

use pocketmine\command\CommandSender;
use pocketmine\player\Player;
use pocketmine\Server;
use pocketmine\entity\Location;

use forms\{
    CustomForm,
    CustomFormResponse,
    element\Label,
    element\Dropdown
};
use Warp\manager\WarpManager;

class WarpCommand extends Command
{
    private array $warps = [];
    public function __construct($name) {
		parent::__construct($name);
	}

	public function execute(CommandSender $sender, $alias, array $args): bool {
        if($sender instanceof Player) {
            foreach(WarpManager::getWarps() as $warp) {
                $this->warps[] = $warp->getName();
            }
            $this->warps === [] ? $this->warps[] = "Данных не найдено" : null;

            $sender->sendForm(new CustomForm("Система варпов", [
                new Label("Команда: телепортироваться на варп"),
                new Dropdown("Выбери варп", $this->warps)
            ], function(Player $sender, CustomFormResponse $response): void {
                $dropdown = $response->getDropdown();

                if($dropdown->getSelectedOption() != "Данных не найдено") {
                    $warp = WarpManager::getWarp($dropdown->getSelectedOption());

                    $sender->teleport(
                        new Location(
                            (float)$warp->getData()->x, 
                            (float)$warp->getData()->y,
                            (float)$warp->getData()->z, 
                            Server::getInstance()->getWorldManager()->getWorldByName($warp->getData()->worldName),
                            0,
                            0
                        )
                    
                    );
				    $sender->sendToastNotification("Система варпов", "Вы были перемещены на варп ".$dropdown->getSelectedOption()."!");
                }
        
            }));

        }
        return true;
    }

}