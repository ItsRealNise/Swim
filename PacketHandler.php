<?php
declare(strict_types = 1);

namespace YaN;

use pocketmine\event\{
	Listener, server\DataPacketReceiveEvent, server\DataPacketSendEvent
};
use pocketmine\network\mcpe\protocol\{
	PlayerActionPacket, StartGamePacket
};
use pocketmine\Player as PMPlayer;
use pocketmine\plugin\Plugin;

class PacketHandler implements Listener {

	/** @var Plugin */
	public $plugin;

	public function __construct(Plugin $plugin){
		$this->plugin = $plugin;
	}

	/**
	 * @param DataPacketReceiveEvent $ev
	 *
	 * @priority LOWEST
	 */
	public function onPacketReceive(DataPacketReceiveEvent $ev){
		$pk = $ev->getPacket();
		$p = $ev->getPlayer();

		switch(true){
			case ($pk instanceof PlayerActionPacket):
				$session = Swim::getInstance()->getSessionById($p->getId());
					switch($pk->action){
						case PlayerActionPacket::ACTION_START_SWIMMING:
							$p->setGenericFlag(PMPlayer::DATA_FLAG_SWIMMING, true);
							break;
						case PlayerActionPacket::ACTION_STOP_SWIMMING:
							$p->setGenericFlag(PMPlayer::DATA_FLAG_SWIMMING, false);
							break;
					}
				}
		}
	}
