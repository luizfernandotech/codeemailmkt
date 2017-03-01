<?php

namespace CodeEmailMKT\Action;

use CodeEmailMKT\Entity\Address;
use CodeEmailMKT\Entity\Category;
use CodeEmailMKT\Entity\Client;
use Doctrine\ORM\EntityManager;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Zend\Diactoros\Response\HtmlResponse;
use Zend\Diactoros\Response\JsonResponse;
use Zend\Expressive\Plates\PlatesRenderer;
use Zend\Expressive\Router;
use Zend\Expressive\Template;
use Zend\Expressive\Twig\TwigRenderer;
use Zend\Expressive\ZendView\ZendViewRenderer;

class TestePageAction
{
    private $template;
    /**
     * @var EntityManager
     */
    private $manager;

    public function __construct(EntityManager $manager, Template\TemplateRendererInterface $template = null)
    {
        $this->template = $template;
        $this->manager = $manager;
    }

    public function __invoke(ServerRequestInterface $request, ResponseInterface $response, callable $next = null)
    {

        // Categories
        /*
        $category = new Category();
        $category->setName('Minha Categoria '. uniqid());

        $this->manager->persist($category);
        $this->manager->flush();

        $categories = $this->manager->getRepository(Category::class)->findAll();
        */

        // Client
        $client = new Client();
        $client->setName('Fulano da Silva ' . uniqid());
        $client->setCpf('009.009.009-62');
        $client->setEmail('fulano@cliente.com');

        // Address
        $address = new Address();
        $address->setCep('88095-200');
        $address->setLogradouro('Rua Teste de Endereco ' . uniqid());
        $address->setCidade('Florianópolis');
        $address->setEstado('SC');
        $address->setClient($client);

        $address2 = new Address();
        $address2->setCep('99099-200');
        $address2->setLogradouro('Rua Outro Endereco ' . uniqid());
        $address2->setCidade('Florianópolis');
        $address2->setEstado('SC');
        $address2->setClient($client);

        // persist client / address
        $this->manager->persist($client);
        $this->manager->persist($address);
        $this->manager->persist($address2);
        $this->manager->flush();

        // find all clients
        $clients = $this->manager->getRepository(Client::class)->findAll();

        $data = [
            'data' => 'Minha primeira aplicação',
            'minhaClasse' => new \CodeEmailMKT\MinhaClasse(),
            'clients' => $clients
        ];

        return new HtmlResponse($this->template->render('app::teste-page', $data));
    }
}
