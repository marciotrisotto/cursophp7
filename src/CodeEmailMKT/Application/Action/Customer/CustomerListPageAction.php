<?php

namespace CodeEmailMKT\Application\Action\Customer;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Zend\Diactoros\Response\HtmlResponse;
use Zend\Expressive\Template;
use CodeEmailMKT\Domain\Persistence\CustomerRepositoryInterface;

class CustomerListPageAction
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
	
 	   $customers = $this->repository->findAll();
	   //echo $request->getAttribute('flash')->getMessage('success');
	   
       return new HtmlResponse($this->template->render("app::customer/list",[
	   'customers' => $customers
	   ]));
	   
    }
}