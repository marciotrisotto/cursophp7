<?php

namespace CodeEmailMKT\Application\Action;

use CodeEmailMKT\Domain\Entity\Customer;
use CodeEmailMKT\Domain\Entity\Category;
use CodeEmailMKT\Domain\Entity\Clientes;
use CodeEmailMKT\Domain\Entity\Enderecos;
use Doctrine\ORM\EntityManager;	
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Zend\Diactoros\Response\HtmlResponse;
use Zend\Diactoros\Response\JsonResponse;
use Zend\Expressive\Router;
use Zend\Expressive\Template;
use Zend\Expressive\Plates\PlatesRenderer;
use Zend\Expressive\Twig\TwigRenderer;
use Zend\Expressive\ZendView\ZendViewRenderer;
use CodeEmailMKT\Domain\Persistence\CustomerRepositoryInterface;


class TestePageAction
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
	
	   //categoria teste curso
	   $customer = new Customer();
   	   $customer->setName("Márcio")
	   ->setEmail("marcio.trisotto@gmail.com");

	   $this->repository->create($customer);
	   
 	   //$categorias = $this->manager->getRepository(Category::class)->findAll();
	   
	   //cliente
	   //$clientes = new Clientes();
	   //$clientes->setNome('Márcio Luciano Trisotto');
	   //$clientes->setEmail('marcio.trisotto@gmail.com');
	   //$clientes->setCpf('04095949935');
	   //$this->manager->persist($clientes);
	   //$this->manager->flush();
	   	   
 	   //$result_clientes = $this->manager->getRepository(Clientes::class)->findAll();	   
	   
	   //endereço
	   //$enderecos = new Enderecos();
	   //$enderecos->setCliente($clientes->getId());
	   //$enderecos->setCep('89216300');
	   //$enderecos->setLogradouro('Rua Lindóia, 105');
	   //$enderecos->setCidade('Joinville');
	   //$enderecos->setEstado('SC');
	   //$this->manager->persist($enderecos);
	   //$this->manager->flush();	   
	   
 	   //$result_enderecos = $this->manager->getRepository(Enderecos::class)->findAll();	   	   
	   
       return new HtmlResponse($this->template->render("app::teste",[
	   'data' => 'dados passados para o template',
	   'categorias' => [],
	   'result_clientes' => [],
	   'result_enderecos' => [],	   	   
	   'MinhaClasse' => new \CodeEmailMKT\MinhaClasse()
	   ]));
    }
}