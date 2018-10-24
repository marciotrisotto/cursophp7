<?php

namespace CodeEmailMKT\Application\Action\Customer;

use CodeEmailMKT\Domain\Entity\Customer;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Zend\Diactoros\Response\HtmlResponse;
use Zend\Diactoros\Response\RedirectResponse;
use Zend\Expressive\Template;
use Zend\Expressive\Router\RouterInterface;
use CodeEmailMKT\Domain\Persistence\CustomerRepositoryInterface;

class CustomerUpdatePageAction
{
 	
    private $template;
	//private $manager;
	private $repository;
	private $router;
 	
    public function __construct(
		CustomerRepositoryInterface $repository,
		Template\TemplateRendererInterface $template = null,
		RouterInterface $router
	  )
    {
		
        $this->template = $template;
        //$this->manager = $manager;
        $this->repository = $repository;
        $this->router = $router;
		
    }
 	
    public function __invoke(ServerRequestInterface $request, ResponseInterface $response, callable $next = null)
    {

   	   $id = $request->getAttribute('id');
	   $entity = $this->repository->find($id);

 	   $flash = $request->getAttribute('flash');	 	   
	   
	   if($request->getMethod() == "POST") {
 
	      $data = $request->getParsedBody();
		  $entity->setName($data['name'])
  		  		 ->setEmail($data['email']);
		  $this->repository->update($entity);
		  $flash->setMessage('success','Contato atualizado com sucesso!');
		  $uri = $this->router->generateUri('customer.list');
		  return new RedirectResponse($uri);
		  
	   }
       return new HtmlResponse($this->template->render("app::customer/update",[
	    'customer' => $entity
	   ]));
	   
    }
}