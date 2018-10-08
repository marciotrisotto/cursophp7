<?php

namespace CodeEmailMKT\Application\Action\Customer;

use CodeEmailMKT\Domain\Entity\Customer;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Zend\Diactoros\Response\HtmlResponse;
use Zend\Diactoros\Response\RedirectResponse;
use Zend\Expressive\Template;
use CodeEmailMKT\Domain\Persistence\CustomerRepositoryInterface;

class CustomerCreatePageAction
{
 	
    private $template;
	//private $manager;
	private $repository;
 	
    public function __construct(CustomerRepositoryInterface $repository,Template\TemplateRendererInterface $template = null)
    {
		
        $this->template = $template;
        //$this->manager = $manager;
        $this->repository = $repository;
		
    }
 	
    public function __invoke(ServerRequestInterface $request, ResponseInterface $response, callable $next = null)
    {

	   $flash = $request->getAttribute('flash');
	   if($request->getMethod() == "POST") {
	      $data = $request->getParsedBody();
		  $entity = new Customer();
		  $entity->setName($data['name']);
  		  		 ->setEmail($data['email']);
		  $this->repository->create($entity);
		  $flash->setMessage('success','Contato cadastrado com sucesso!');
		  
		  return new RedirectResponse('admin/customer');
		  
	   }
       return new HtmlResponse($this->template->render("app::customer/create",[
	   // 'array' => $var
	   ]));
	   
    }
}