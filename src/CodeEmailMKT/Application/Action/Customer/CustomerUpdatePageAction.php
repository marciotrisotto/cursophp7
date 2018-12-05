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
 	   	
           $form = new CustomerForm();
           $form->add(new HttpMethodElement('PUT'));
           $form->bind($entity);
           
	   if($request->getMethod() == "PUT") {
              $flash = $request->getAttribute('flash');
	      $dataRaw = $request->getParsedBody();
              $form->setData($dataRaw);
              
              if($form->isValid()){
                  $entity = $form->getData();
                  $this->repository->update($entity);
		  $flash->setMessage('success','Contato atualizado com sucesso!');
		  $uri = $this->router->generateUri('customer.list');
		  return new RedirectResponse($uri);
              }
              
	   }       
           
           return new HtmlResponse($this->template->render("app::customer/update",[
	    'form' => $form
	   ]));
	   
    }
}