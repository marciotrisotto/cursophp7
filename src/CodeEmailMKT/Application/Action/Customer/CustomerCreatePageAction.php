<?php

namespace CodeEmailMKT\Application\Action\Customer;

use CodeEmailMKT\Domain\Entity\Customer;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Zend\Diactoros\Response\HtmlResponse;
use Zend\Diactoros\Response\RedirectResponse;
use Zend\Expressive\Template;
use Zend\Expressive\Router\RouterInterface;
use CodeEmailMKT\Application\Form\CustomerForm;
use CodeEmailMKT\Domain\Persistence\CustomerRepositoryInterface;
use Zend\View\HelperPluginManager;
use CodeEmailMKT\Infrastructure\View\HelperPluginManagerFactory;

class CustomerCreatePageAction
{
 	
    private $template;
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

           $form = new CustomerForm();
	   
	   if($request->getMethod() == "POST") {
		  $flash = $request->getAttribute('flash');
	      $data = $request->getParsedBody();
		  $entity = new Customer();
		  $entity->setName($data['name'])
  		  		 ->setEmail($data['email']);
		  $this->repository->create($entity);
		  $flash->setMessage('success','Contato cadastrado com sucesso!');
		  $uri = $this->router->generateUri('customer.list');
		  return new RedirectResponse($uri);
	   }
       return new HtmlResponse($this->template->render("app::customer/create",[
	   'form' => $form
	   ]));
	   
    }
}