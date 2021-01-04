<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Voiture;
use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use App\Form\VoitureType;
use Symfony\Component\HttpFoundation\Request;

class VoitureController extends AbstractController
{
  /**
     * @Route("/admin", name="admin")
     */
  public function admin()
    {
        $voitures = $this->getDoctrine()->getRepository(Voiture::class)->findAll();

        $users = $this->getDoctrine()->getRepository(User::class)->findAll();

                return $this->render('admin/index.html.twig', [
                 'voitures' => $voitures,
                 'users' => $users
        ]);

    }

    /**
     * @Route("/voiture", name="voiture")
     */
    public function index(): Response
    {
      $voitures = $this->getDoctrine()->getRepository(voiture::class)->findAll();
        return $this->render('voiture/index.html.twig', [
            'voitures' =>   $voitures,
        ]);
    }

    /**
     * @Route("/voiture/{mat}", name="voiturebymat")
     */
    public function afficher(string $mat): Response
    {
      $voitures = $this->getDoctrine()->getRepository(voiture::class)->findBy($arrayName = array('matricule' => $mat ));
        return $this->render('voiture/index.html.twig', [
            'voitures' =>   $voitures,
        ]);
    }
    /**
     * @Route("/modifierVoiture/{mat}", name="editvoiturebaymat")
     */
    public function modifier(string $mat, Request $request): Response
    {
      $entityManger = $this->getDoctrine()->getManager() ;
      $voitures = $this->getDoctrine()->getRepository(voiture::class)->findBy($arrayName = array('matricule' => $mat ));
      if(!$voitures)
      {
        throw $this->createNotFoundExeption(
          'pas de voiture avec la matricule'.$mat
        );

      }
      $voiture=$voitures[0];
      $form = $this->createForm(VoitureType::class, $voiture);
      $form->handleRequest($request);

      if ($form->isSubmitted())
      {
        $voiture->setDisponibilite(1);
        $entityManger = $this->getDoctrine()->getManager();
        $entityManger->persist($voiture);
        $entityManger->flush();

           return $this->redirectToRoute('voiture');
      }
      return $this->render('voiture/modifier.html.twig',[
        'form'=>$form->createView()
      ]);
      //$voitures[0]->setMarque('polo');
    //  $entityManger->flush();
    }
    /**
     * @Route("/supprimerVoiture/{mat}", name="supprimevoiturebaymat")
     */
    public function supprimer(string $mat): Response
    {
      $entityManger = $this->getDoctrine()->getManager() ;
      $voitures = $this->getDoctrine()->getRepository(voiture::class)->findBy($arrayName = array('matricule' => $mat ));
      if(!$voitures)
      {
        throw $this->createNotFoundExeption(
          'pas de voiture avec la matricule'.$mat
        );

      }
      $entityManger->remove($voitures[0]);
      $entityManger->flush();
        return $this->redirectToRoute('voiture');
    }

    /**
     * @Route("/createvoiture", name="create_voiture")
     */
     public function createVoiture(Request $request):Response
     {
       $voiture = new voiture();
       $form = $this->createForm(VoitureType::class,$voiture);

       $form->handleRequest($request);
       if ($form->isSubmitted())
       {
         $voiture->setDisponibilite(1);
         $entityManger = $this->getDoctrine()->getManager();
         $entityManger->persist($voiture);
         $entityManger->flush();

            return $this->redirectToRoute('voiture');
       }
       return $this->render('voiture/ajouter.html.twig',[
         'form'=>$form->createView()
       ]);}


       /**
        * @Route("/louer/{mat}", name="louerbaymat")
        */
       public function louer(string $mat, Request $request): Response
       {
         $entityManger = $this->getDoctrine()->getManager() ;
         $voitures = $this->getDoctrine()->getRepository(Voiture::class)->findBy($arrayName = array('matricule' => $mat ));
         if(!$voitures)
         {
           throw $this->createNotFoundExeption(
             'pas de voiture avec la matricule'.$mat
           );

         }
$voitures[0]->setDisponibilite(0);
$entityManger->flush();
return $this->redirectToRoute('voiture');
}

/**
 * @Route("/rendre/{mat}", name="rendrebaymat")
 */
public function rendre(string $mat, Request $request): Response
{
  $entityManger = $this->getDoctrine()->getManager() ;
  $voitures = $this->getDoctrine()->getRepository(Voiture::class)->findBy($arrayName = array('matricule' => $mat ));
  if(!$voitures)
  {
    throw $this->createNotFoundExeption(
      'pas de voiture avec la matricule'.$mat
    );

  }
$voitures[0]->setDisponibilite(1);
$entityManger->flush();
return $this->redirectToRoute('voiture');
}







  // $entityManger = $this->getDoctrine()->getManager() ;
  //  $voiture=new Voiture();
  //  $voiture ->setMatricule('200Tu15000');
  //  $voiture ->setMarque('BMW');
  //  $voiture ->setDescription('Voiture luxe');
  //  $voiture ->setCouleur('noir');
  //  $voiture ->setCarburant('gazoll');
  //  $date = new \DateTime('2019-06-05 12:15:30');
  //  $voiture->setDatemiseencirculation($date);
  //  $voiture->setDisponibilite(1);
  //  $voiture->setNbrplace(5);
  //  $entityManger->persist($voiture);
  //  $entityManger->flush();
  //  return new Response('nouvelle voiture ajouter avec matricule numero '.$voiture->getMatricule());


     }