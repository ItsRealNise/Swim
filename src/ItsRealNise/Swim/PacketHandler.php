<?php
declare(strict_types = 1);

namespace ItsRealNise\Swim;

use pocketmine\event\{
	Listener, server\DataPacketReceiveEvent, server\DataPacketSendEvent
};
use pocketmine\network\mcpe\protocol\{
	PlayerActionPacket, StartGamePacket
};
use pocketmine\Player as PMPlayer;
use ItsRealNise\Swim\Swim;

class PacketHandler implements Listener {

	/** @var Swim $plugin */
	private $plugin;

	public function __construct(Swim $plugin){
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
				$session = $this->plugin->getSessionById($p->getId());
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
