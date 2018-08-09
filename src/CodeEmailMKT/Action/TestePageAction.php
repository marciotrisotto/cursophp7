<?php

namespace CodeEmailMKT\Action;

use CodeEmailMKT\Entity\Category;
use CodeEmailMKT\Entity\Clientes;
use CodeEmailMKT\Entity\Enderecos;
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

class TestePageAction
{
 
    private $template;
	private $manager;

    public function __construct(EntityManager $manager,Template\TemplateRendererInterface $template = null)
    {
	
        $this->template = $template;
        $this->manager = $manager;
				
    }
 
    public function __invoke(ServerRequestInterface $request, ResponseInterface $response, callable $next = null)
    {
	
	   //categoria teste curso
	   $category = new Category();
	   $category->setName('Categoria criada!');
		
	   $this->manager->persist($category);
	   $this->manager->flush();
		
 	   $categorias = $this->manager->getRepository(Category::class)->findAll();
	   
	   //cliente
	   $clientes = new Clientes();
	   $clientes->setNome('Márcio Luciano Trisotto');
	   $clientes->setEmail('marcio.trisotto@gmail.com');
	   $clientes->setCpf('04095949935');
	   $this->manager->persist($clientes);
	   $this->manager->flush();
	   	   
 	   $result_clientes = $this->manager->getRepository(Clientes::class)->findAll();	   
	   
	   //endereço
	   $enderecos = new Enderecos();
	   $enderecos->setCliente($clientes->getId());
	   $enderecos->setCep('89216300');
	   $enderecos->setLogradouro('Rua Lindóia, 105');
	   $enderecos->setCidade('Joinville');
	   $enderecos->setEstado('SC');
	   $this->manager->persist($enderecos);
	   $this->manager->flush();	   
	   
 	   $result_enderecos = $this->manager->getRepository(Enderecos::class)->findAll();	   	   
	   
       return new HtmlResponse($this->template->render("app::teste",[
	   'data' => 'dados passados para o template',
	   'categorias' => $categorias,
	   'result_clientes' => $result_clientes,
	   'result_enderecos' => $result_enderecos,	   	   
	   'MinhaClasse' => new \CodeEmailMKT\MinhaClasse()
	   ]));
    }
}