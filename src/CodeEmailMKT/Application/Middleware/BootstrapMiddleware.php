<?php

namespace CodeEmailMKT\Application\Middleware;

use CodeEmailMKT\Domain\Service\BootstrapInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use CodeEmailMKT\Domain\Service\FlashMessageInterface;

class BootstrapMiddleware
{
 
    private $bootstrap;
	
    private $flash;	

    public function __construct(BootstrapInterface $bootstrap, FlashMessageInterface $flash)
    {
        $this->bootstrap = $bootstrap;
        $this->flash = $flash;		
    }
 
    public function __invoke(ServerRequestInterface $request, ResponseInterface $response, callable $next = null)
    {
	
		$this->bootstrap->create();
		$request = $request->withAttribute('flash',$this->flash);
		$request = $this->spoofingMethod($request);
		return $next($request,$response);
		
    }
	
	protected function spoofingMethod(ServerRequestInterface $request){
		$data = $request->getParsedBody();
		$method = isset($data['_method'])? strtoupper($data['_method']): '';
		if(in_array($method,['PUT','DELETE'])){
			$request = $request->withMethod($method);
		}
		return $request;
	}
}
