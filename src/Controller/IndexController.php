<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class IndexController extends AbstractController
{
    /**
     * Handle homepage
     * 
     * @Route("/{name}", name="homepage")
     *
     * @return void
     */
    public function index($name = "")
    {
        return $this->render("home.html.twig", [
            "name" => $name,
            "age" => 32,
            "children" => [
                ["name" => "miantsa", "age" => 4],
                ["name" => "miangola", "age" => 2],
            ]
        ]);
    }

    /**
     * Handle homepage
     * 
     * @Route("/sayhello/{name}", name="sayhello")
     *
     * @return void
     */
    public function sayHello($name = "")
    {
        return new Response("Hello $name");
    }
}
