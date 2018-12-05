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
    private $form;
 	
    public function __construct(
		CustomerRepositoryInterface $repository,
		Template\TemplateRendererInterface $template = null,
		RouterInterface $router,
                CustomerForm $form
	  )
	  
    {
		
        $this->template = $template;
        //$this->manager = $manager;
        $this->repository = $repository;
        $this->router = $router;	
        $this->form = $form;
		
    }
 	
    public function __invoke(ServerRequestInterface $request, ResponseInterface $response, callable $next = null)
    {
       
	   if($request->getMethod() == "POST") {
	      $flash = $request->getAttribute('flash');
	      $dataRaw = $request->getParsedBody();
              $this->form->setData($dataRaw);
              
              if($this->form->isValid()){
                $entity = $this->form->getData();
                $this->repository->create($entity);
                $flash->setMessage('success','Contato cadastrado com sucesso!');
                $uri = $this->router->generateUri('customer.list');
                return new RedirectResponse($uri);                  
              }
              
	   }
        return new HtmlResponse($this->template->render("app::customer/create",[
	   'form' => $this->form
	]));
	   
    }
}