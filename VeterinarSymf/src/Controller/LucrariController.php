<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\LucrariEfectuate;
use App\Form\LucrariAdminType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Component\HttpFoundation\Request;
use App\Repository\LucrariEfectuateRepository;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\String\Slugger\SluggerInterface;

class LucrariController extends AbstractController
{
    #[Route('/lucrari', name: 'lucrari')]
    #[IsGranted("IS_AUTHENTICATED_FULLY")]
    public function index(Request $request, LucrariEfectuateRepository $LucrariRepository, SluggerInterface $slugger): Response
    {
    	$work = new LucrariEfectuate();
   		$form = $this->createForm(LucrariAdminType::class, $work);
		$form->handleRequest($request);

		if($form->isSubmitted() && $form->isValid())
		{
			/** @var UploadedFile $imageFile */
            $imageFile = $form->get('imagine')->getData();

            if ($imageFile) {
                $originalFilename = pathinfo($imageFile->getClientOriginalName(), PATHINFO_FILENAME);
                $safeFilename = $slugger->slug($originalFilename);
                $newFilename = $safeFilename.'-'.uniqid().'.jpg';

                try {
                    $imageFile->move(
                        $this->getParameter('images_directory'),
                        $newFilename
                    );
                } catch (FileException $e) {
                }

                $work->setImagine($newFilename);
            }

   			$entityManager = $this->getDoctrine()->getManager();
   			$entityManager->persist($work);
   			$entityManager->flush();
   			unset($work);
 			unset($form);
    		$work = new LucrariEfectuate();
   			$form = $this->createForm(LucrariAdminType::class, $work);
   		}

   		$works = $LucrariRepository->findBy([], ['id' => 'DESC']);
        return $this->render('lucrari/index.html.twig', [
            //'controller_name' => 'LucrariController',
            'LucrariAdminForm' => $form->createView(),
            'works' => $works,
        ]);
    }

        #[Route('/lucrari/delete/{id}', name: 'delete_lucrari')]
    public function delete($id, Request $request, LucrariEfectuateRepository $LucrariRepository): Response
    {
    	$em = $this->getDoctrine()->getManager();
        $entity = $LucrariRepository->find($id);
        $em->remove($entity);
        $em->flush();
		return $this->redirectToRoute("lucrari");
    }

    #[Route('/lucrari/update/{id}', name: 'update_lucrari')]
    public function update($id, Request $request, LucrariEfectuateRepository $LucrariRepository, SluggerInterface $slugger): Response
    {
    	$work = new LucrariEfectuate();
    	$em = $this->getDoctrine()->getManager();
        $entity = $LucrariRepository->find($id);

        $work->setNume($entity->getNume());
        $work->setImagine( $this->getParameter('images_directory') . $entity->getImagine());
        $work->setTip($entity->getTip());
   		$form = $this->createForm(LucrariAdminType::class, $work);

		$form->handleRequest($request);

		if($form->isSubmitted() && $form->isValid())
		{
			$entity->setNume($work->getNume());
			$entity->setTip($work->getTip());

			/** @var UploadedFile $imageFile */
            $imageFile = $form->get('imagine')->getData();

            if ($imageFile) {
                $originalFilename = pathinfo($imageFile->getClientOriginalName(), PATHINFO_FILENAME);
                $safeFilename = $slugger->slug($originalFilename);
                $newFilename = $safeFilename.'-'.uniqid().'.jpg';

                try {
                    $imageFile->move(
                        $this->getParameter('images_directory'),
                        $newFilename
                    );
                } catch (FileException $e) {
                }

                $entity->setImagine($newFilename);
            }

   			$em->flush();
   			return $this->redirectToRoute("lucrari");
   		}

   		$works = $LucrariRepository->findBy([], ['id' => 'DESC']);
        return $this->render('lucrari/index.html.twig', [
            //'controller_name' => 'LucrariController',
            'LucrariAdminForm' => $form->createView(),
            'works' => $works,
        ]);
    }
}
