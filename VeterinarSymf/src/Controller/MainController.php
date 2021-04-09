<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use App\Entity\LucrariEfectuate;
use App\Form\LucrariAdminType;
use Symfony\Component\HttpFoundation\Request;
use App\Repository\LucrariEfectuateRepository;

class MainController extends AbstractController
{
    #[Route('/', name: 'main')]
    public function index(LucrariEfectuateRepository $LucrariRepository): Response
    {
   		$works = $LucrariRepository->findBy([], ['id' => 'DESC']);
        return $this->render('main/index.html.twig', [
            'controller_name' => 'MainController',
            'works' => $works,
        ]);
    }
}
