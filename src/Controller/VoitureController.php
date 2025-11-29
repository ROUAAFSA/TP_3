<?php

namespace App\Controller;

use App\Entity\Modele;
use App\Entity\Voiture;
use App\Form\VoitureForm;
use App\Repository\VoitureRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class VoitureController extends AbstractController
{
    #[Route('/voitures', name: 'app_voiture')]
    public function listeVoiture(VoitureRepository $vr): Response
    {
        $voitures = $vr->findAll();
        return $this->render('voiture/listVoiture.html.twig', ['listeVoitures' => $voitures,]);
    }
    #[Route('/addVoiture', name: 'add_voiture')]
    public function addVoiture(Request $request,EntityManagerInterface $em){
        $voiture = new Voiture();
        $form = $this->createForm(voitureForm::class,$voiture);
        $form->handleRequest($request);
        if($form->isSubmitted()){
            $em->persist($voiture);
            $em->flush();
            return $this->redirectToRoute('app_voiture');
        }
        return $this->render('voiture/addVoiture.html.twig', ['formV' => $form->createView()]);
    }

    #[Route('/voiture/{id}', name: 'voitureDelete')]
    public function delete(EntityManagerInterface $em,$id,VoitureRepository $vr): Response
    {
        $voiture = $vr->find($id);
        $em->remove($voiture);
        $em->flush();

        return $this->redirectToRoute('app_voiture');
    }
    #[Route('/updateVoiture/{id}', name: 'voitureUpdate')]
    public function updateVoiture(Request $request, EntityManagerInterface $em,$id,VoitureRepository $vr): Response
    {
        $voiture = $vr->find($id);
        $editForm = $this->createForm(voitureForm::class,$voiture);
        $editForm->handleRequest($request);
        if($editForm->isSubmitted() and $editForm->isValid()){
            $em->persist($voiture);
            $em->flush();
            return $this->redirectToRoute('app_voiture');
        }
        return $this->render('voiture/updateVoiture.html.twig', ['editFormVoiture' => $editForm->createView()]);
    }

    #[Route('/voitures-par-modele', name: 'voiture_par_modele')]
    public function voitureParModele(Request $request, VoitureRepository $vr,EntityManagerInterface $em): Response
    {
        $modeleId = $request->query->get('modele');
        $voitures = [];

        if ($modeleId) {
            $voitures = $vr->findByModele((int)$modeleId);
        }

        $modeles = $em->getRepository(Modele::class)->findAll();

        return $this->render('voiture/voitureParModel.html.twig', [
            'voitures' => $voitures,
            'modeles' => $modeles,
            'selectedModele' => $modeleId
        ]);
    }

}
