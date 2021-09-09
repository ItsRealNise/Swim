<?php

namespace YaN;

use pocketmine\plugin\PluginBase;
use pocketmine\Player;

class Swim extends PluginBase {

	/** @var Session[] */
	private $sessions = [];
	/** @var Swim */
	private static $instance;

	public function onEnable(){
	    self::$instance = $this;
		$this->getLogger()->info("Enable swim");
		$this->getServer()->getPluginManager()->registerEvents(new PacketHandler($this), $this);
	}

	public static function getInstance(): Swim{
		return self::$instance;
	}

	public function getSessionById(int $id){
		if(isset($this->sessions[$id])){
			return $this->sessions[$id];
		}else{
			return null;
		}
	}
}
