<?php

namespace App\Controller;

use App\Entity\Gundam;
use App\Repository\GundamRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class HomeController extends AbstractController
{
    /**
     * @Route("/home", name="app_home")
     */
    public function index(): Response
    {
        return $this->render('home/index.html.twig', [
            'controller_name' => 'HomeController',
        ]);
    }

    /**
     * @Route("/home/all", name="app_home_all")
     */
    public function all(ManagerRegistry $doctrine): Response
    {
        $gundams = $doctrine
                ->getRepository(Gundam::class)
                ->findAll();

        return $this->render('home/all.html.twig', [
            'gundams' => $gundams,
        ]);
    }
}
