<?php

namespace CodeEmailMKT\Application\Action\Customer;

//use Doctrine\ORM\EntityManager;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Zend\Diactoros\Response\HtmlResponse;
use Zend\Expressive\Template;
use CodeEmailMKT\Domain\Persistence\CustomerRepositoryInterface;

class CustomerListPageAction
{

    private $template;
	//private $manager;
	
	/**
	* @var CustomerRepositoryInterface
	*/
	private $repository;
	

    public function __construct(
			CustomerRepositoryInterface $repository,
			Template\TemplateRendererInterface $template
	 )
    {
	
        $this->template = $template;
        //$this->manager = $manager;
        $this->repository = $repository;
				
    }
 
    public function __invoke(ServerRequestInterface $request, ResponseInterface $response, callable $next = null)
    {
	
 	   $customers = $this->repository->findAll();
	   //$customer = $this->repository->find(1);
	   //$customer->setName('Marcinho');
	   //$this->entityManager->detach($customer);
	   //$this->repository->update($customer);
	   
	   $flash = $request->getAttribute('flash');
	   //echo $request->getAttribute('flash')->getMessage('success');
	   
       return new HtmlResponse($this->template->render("app::customer/list",[
	   'customers' => $customers,
	   'message' => $flash->getMessage('success')
	   ]));
	   
    }
}