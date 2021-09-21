<?php

namespace YaN\Swim;

use pocketmine\plugin\PluginBase;
use pocketmine\Player;

class Swim extends PluginBase {

	/** @var Session[] */
	private $sessions = [];
	
	private static Swim $instance;

	public function onEnable(){
	    self::$instance = $this;
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
