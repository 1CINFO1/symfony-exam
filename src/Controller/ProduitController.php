<?php

namespace App\Controller;

use App\Entity\Produit;
use App\Repository\ProduitRepository;
use App\Repository\CategorieRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/produit', name: 'app_produit_')]
class ProduitController extends AbstractController
{
    #[Route('', name: 'index')]
    public function index(): Response
    {
        return $this->render('produit/index.html.twig', [
            'controller_name' => 'ProduitController',
        ]);
    }

    #[Route('/list', name: 'list')]
    public function list(ProduitRepository $produitRepository): Response
    {
        $produits = $produitRepository->findAll();

        return $this->render('produit/list.html.twig', [
            'produits' => $produits,
        ]);
    }

    #[Route('/add', name: 'add')]
    public function add(Request $request, EntityManagerInterface $em, CategorieRepository $categorieRepository): Response
    {

        if ($request->isMethod('POST')) {
            $produit = new Produit();
            $produit->setTitre($request->request->get('titre'));
            $produit->setNbProduit($request->request->get('nb_Produit'));
            $produit->setDateFa(new \DateTime($request->request->get('date_fa')));

            $categorie = $categorieRepository->find($request->request->get('categorie_id'));
            if ($categorie) {
                $produit->setCategorie($categorie);
                $em->persist($produit);
                $em->flush();
                $this->addFlash('success', 'Produit ajouté avec succès');
                return $this->redirectToRoute('app_produit_list');
            }
        }

        return $this->render('produit/add.html.twig', [
            'categories' => $categorieRepository->findAll(),
        ]);
    }
    #[Route('/like/{id}', name: 'like', methods: ['POST'])]
    public function like(int $id, EntityManagerInterface $em, ProduitRepository $produitRepository): Response
    {
        $produit = $produitRepository->find($id);

        if (!$produit) {
            throw $this->createNotFoundException('Produit non trouvé');
        }

        $produit->setnbLikes($produit->getnbLikes() + 1);
        $em->flush();

        $this->addFlash('success', 'Like ajouté avec succès');

        return $this->redirectToRoute('app_produit_list');
    }
}
