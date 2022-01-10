<?php

namespace ProyectoWeb\app\controllers;

use Psr\Container\ContainerInterface;

use ProyectoWeb\entity\Product;

use ProyectoWeb\exceptions\QueryException;

use ProyectoWeb\exceptions\NotFoundException;

use ProyectoWeb\database\Connection;

use ProyectoWeb\repository\ProductRepository;

use ProyectoWeb\core\App;

use ProyectoWeb\core\Cart;

class ThankController

{
    protected $container;

    // constructor receives container instance
    public function __construct(ContainerInterface $container) {
        $this->container = $container;
    }

    public function thankyou($request,$response , $args){

        $title = "Gracias por su compra";
        $withCategories = false;
        $this->container['cart']->empty();

        return $this->container->renderer->render($response, "thankyou.view.php" , compact('title', 'withCategories'));
    }

    public function checkout($request, $response, $args){

        if(!isset($_SESSION['username'])){
            return $response->withRedirect($this->container->router->pathFor('login') . "?returnToUrl=" . $this->container->router->pathFor('cart-checkout'),303);
        }
    }
}