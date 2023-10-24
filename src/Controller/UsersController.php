<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class UsersController extends AbstractController
{
    #[Route('/', name: 'app_users')]
    public function index(): Response
    {
        return //new Response("hello!");
	$this->render('users/index.html.twig', [
			//'base.html.twig',[//
            'controller_name' => 'UsersController',
        ]);
    }
}
