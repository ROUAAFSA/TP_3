<?php

namespace App\Controller;

use App\Repository\ModeleRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;


#[Route('/modeles')]
final class ModeleController extends AbstractController
{
    #[Route('/add', name: 'modele_add')]
    public function add(ModeleRepository $repo):Response
    {
        $modele = $repo->addModele( 'AUDI', 'German');

        return new Response('Modele ajoute avec ID:', $modele->getId());
    }

    #[Route('/list', name: 'modele_list')]
    public function list(ModeleRepository $repo):Response
    {
        $modeles = $repo->findAllModeles();

        $output = "<h2>liste modeles</h2><ul>";
        foreach ($modeles as $m) {
            $output .= "<li>ID: {$m->getId()} | Libelle: {$m->getLibelle()} | Pays: {$m->getPays()}</li>";
        }
        $output .= "</ul>";
        return new Response($output);
    }

    #[Route('/update/{id}', name: 'modele_update')]
    public function update(ModeleRepository $repo, int $id):Response
    {
        $rows = $repo->updateModele($id, 'Megane', 'France');

        return new Response("Modele mis a jour: {$rows} ligne(s),");
    }
    #[Route('/delete/{id}', name: 'modele_delete')]
    public function delete(ModeleRepository $repo, int $id):Response
    {
        $rows = $repo->deleteModele($id);
        return new Response("Modele supprime: {$rows} ligne(s),");
    }
}
