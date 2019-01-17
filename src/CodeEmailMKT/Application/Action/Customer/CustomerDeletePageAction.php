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
use CodeEmailMKT\Application\Form\HttpMethodElement;
use Zend\View\HelperPluginManager;
use CodeEmailMKT\Infrastructure\View\HelperPluginManagerFactory;

class CustomerDeletePageAction {
 	
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
        $this->repository = $repository;
        $this->router = $router;
        $this->form = $form;
		
    }
 	
    public function __invoke(ServerRequestInterface $request, ResponseInterface $response, callable $next = null)
    {
	   
   	   $id = $request->getAttribute('id');
           
	   $entity = $this->repository->find($id);
           
           $this->form->add(new HttpMethodElement('DELETE'));
           $this->form->bind($entity);           
           
	   if($request->getMethod() == "DELETE") {
	 	  $flash = $request->getAttribute('flash');
		  $this->repository->remove($entity);
		  $flash->setMessage('success','Contato removido com sucesso!');
		  $uri = $this->router->generateUri('customer.list');
		  return new RedirectResponse($uri);
	   }
           
           
       return new HtmlResponse($this->template->render("app::customer/delete",[
	    'form' => $this->form
	   ]));
	   
    }
    
}