<?php

namespace CodeEmailMKT\Domain\Service;

use Aura\Session\Session;

interface FlashMessageInterface{

	public function setNamespace($name = __NAMESPACE__);
	public function setMessage($key,$value);
	public function getMessage($key);	
	
}