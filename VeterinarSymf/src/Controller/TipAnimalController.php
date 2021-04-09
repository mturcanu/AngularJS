<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\TipAnimal;
use App\Form\TipAdminType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Component\HttpFoundation\Request;
use App\Repository\TipAnimalRepository;

class TipAnimalController extends AbstractController
{
    #[Route('/tip/animal', name: 'tip_animal')]
    #[IsGranted("IS_AUTHENTICATED_FULLY")]
    public function index(Request $request, TipAnimalRepository $tipAnimalRepository): Response
    {
  		$type = new TipAnimal();
   		$form = $this->createForm(TipAdminType::class, $type);
		$form->handleRequest($request);

		if($form->isSubmitted() && $form->isValid())
		{
   			$entityManager = $this->getDoctrine()->getManager();
   			$entityManager->persist($type);
   			$entityManager->flush();
   			unset($type);
 			unset($form);
  			$type = new TipAnimal();
   			$form = $this->createForm(TipAdminType::class, $type);
   		}

   		$types = $tipAnimalRepository->findBy([], ['id' => 'DESC']);
        return $this->render('tip_animal/index.html.twig', [
            //'controller_name' => 'TipAnimalController',
            'TipAnimalForm' => $form->createView(),
            'types' => $types,
        ]);
    }

    #[Route('/tip/animal/delete/{id}', name: 'delete_tip_animal')]
    public function delete($id, Request $request, TipAnimalRepository $tipAnimalRepository): Response
    {
    	$em = $this->getDoctrine()->getManager();
        $entity = $tipAnimalRepository->find($id);
        $em->remove($entity);
        $em->flush();
   		$types = $tipAnimalRepository->findBy([], ['id' => 'DESC']);
		return $this->redirectToRoute("tip_animal");
    }

    #[Route('/tip/animal/update/{id}', name: 'update_tip_animal')]
    public function update($id, Request $request, TipAnimalRepository $tipAnimalRepository): Response
    {
    	$type = new TipAnimal();
    	$em = $this->getDoctrine()->getManager();
        $entity = $em->getRepository(TipAnimal::class)->find($id);

        $type->setNume($entity->getNume());
   		$form = $this->createForm(TipAdminType::class, $type);

		$form->handleRequest($request);

		if($form->isSubmitted() && $form->isValid())
		{
			$entity->setNume($type->getNume());
   			$em->flush();
   			return $this->redirectToRoute("tip_animal");
   		}

   		$types = $tipAnimalRepository->findBy([], ['id' => 'DESC']);
		return $this->render('tip_animal/index.html.twig', [
            //'controller_name' => 'TipAnimalController',
            'TipAnimalForm' => $form->createView(),
            'types' => $types,
        ]);
    }

}
