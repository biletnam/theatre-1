<?php

namespace Theatre\AdministrateurBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use AppBundle\Entity\Evenement;
use AppBundle\Entity\Utilisateur;
use AppBundle\Entity\UtilisateurEvenement;
use AppBundle\Form\EvenementType;
use AppBundle\Form\UtilisateurEvenementType;
use \Datetime;

class DefaultController extends Controller
{
    
    // Page d'accueil pour chaque utilisateur
    public function indexAction()
    {
        // récupération du token de session Symfony
        $session = $this->get('security.token_storage')->getToken()->getUser()->getUsername();
        
        // récupéreation d'un userId nécéssaire pour les pages liées à l'utilisateur.
    	$repository = $this->getDoctrine()->getRepository(Utilisateur::class);
        $utilisateur = $repository->findBy(array('userId'=> $session));

        return $this->render('@TheatreAdministrateur/Default/index.html.twig',array('utilisateur'=>$utilisateur[0]));
    }
    
    // Page de création des évenements
    public function createEventAction(Request $request)

    {
    	$entityManager = $this->getDoctrine()->getManager();
    	$event = new Evenement;
    	$form = $this->createForm(EvenementType::class, $event);
    	dump($form);
    	$form->handleRequest($request);
		if ($form->isSubmitted() && $form->isValid()) {
			$event = $form->getData();
			$event = $form->getData();
            $entityManager->persist($event);
            $entityManager->flush();

			$this->addFlash(
			'success',
			'Succès : evenement créé'
		);
		return $this->redirectToRoute('theatre_administrateur_homepage');
		}

        return $this->render('@TheatreAdministrateur/Default/createEvent.html.twig', array('form' => $form->createView() ));
    }

    // Page d'édition des évenements
    public function editAction($id,Request $request)
    {
    	$repository = $this->getDoctrine()->getRepository(Evenement::class);
    	$entityManager = $this->getDoctrine()->getManager();
    	
    	$event = $repository->find($id);
    	$form = $this->createForm(EvenementType::class, $event);
    	dump($form);
    	  if (!$event) {
            throw $this->createNotFoundException('No event found for id '.$id
            );
        }
        $form = $this->createForm(EvenementType::class, $event);

    	$form->handleRequest($request);
		if ($form->isSubmitted() && $form->isValid()) {
			$event = $form->getData();
			$entityManager->persist($event);
            $entityManager->flush();

			$this->addFlash(
			'success',
			'Succès : evenement créé'
		);
		return $this->redirectToRoute('theatre_administrateur_homepage');
		}

        return $this->render('@TheatreAdministrateur/Default/edit.html.twig', array('form' => $form->createView(),));
    }

    // Page de suppression des évenements
    public function deleteAction($id)
    {
    	$entityManager = $this->getDoctrine()->getManager();
    	$repository = $this->getDoctrine()->getRepository(UtilisateurEvenement::class);
    	$ue = $repository->find($id);
    	if (!$ue) {
        	throw $this->createNotFoundException('No event found for id '.$ue
        	);
	    }
    	$entityManager->remove($ue);
		$entityManager->flush();
		$this->addFlash(
	        'success',
	        'Succès : Evnènement supprimé'
        );
        return $this->render('@TheatreAdministrateur/Default/delete.html.twig');
    }

    public function indexAdminAction()
    {
        $repository = $this->getDoctrine()->getRepository(Evenement::class);
        $events = $repository->findAll();
        return $this->render('@TheatreAdministrateur/Default/indexAdmin.html.twig',array('events'=>$events));
    }

    public function indexUserAction($id)
    {
        $entityManager = $this->getDoctrine()->getManager();
        $repository = $this->getDoctrine()->getRepository(UtilisateurEvenement::class);
        $ues = $repository->findBy(array('userId'=>$id));
        if (!empty($ues))
        {
            return $this->render('@TheatreAdministrateur/Default/indexUser.html.twig',array('ues'=>$ues));
        }
        else {return $this->redirectToRoute('theatre_administrateur_homepage');}
    }
    
    public function editUserAction($id,Request $request)
    {
        $repository = $this->getDoctrine()->getRepository(UtilisateurEvenement::class);
        $entityManager = $this->getDoctrine()->getManager();
        $ue = $repository->findBy(array('id'=>$id));
        $form = $this->createForm(UtilisateurEvenementType::class, $ue[0]);

        if (!$ue) {
            throw $this->createNotFoundException('No ue found for id '.$id
            );
        }

        $form = $this->createForm(UtilisateurEvenementType::class, $ue[0]);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $ue = $form->getData();
            $entityManager->persist($ue);
            $entityManager->flush();

            $this->addFlash(
            'success',
            'Succès : evenement créé'
        );
            return $this->redirectToRoute('theatre_homepageUser',array('id'=>$id));
        }

        return $this->render('@TheatreAdministrateur/Default/editUser.html.twig', array('form' => $form->createView(),));
    }

    /* 
    public function indexUserAction()
    {
        $repository = $this->getDoctrine()->getRepository(Evenement::class);
        $repository2 = $this->getDoctrine()->getRepository(Utilisateur::class);

        $events = $repository->findAll();
        $users = $repository2->findAll();
        return $this->render('@TheatreAdministrateur/Default/indexUser.html.twig',array('events'=>$events,'users'=>$users));
    } 
    */

    public function listeventAction()
    {
        //dump($this->get('security.token_storage')->getToken());
        // récupération du token de session Symfony
        $session = $this->get('security.token_storage')->getToken()->getUser()->getUsername();

        // récupération d'un userId nécéssaire pour les pages liées à l'utilisateur.
        $repository = $this->getDoctrine()->getRepository(Utilisateur::class);
        $utilisateur = $repository->findBy(array('userId'=> $session));
        //dump($utilisateur[0]);
        $events = new Evenement;
        $entityManager = $this->getDoctrine()->getManager();
        $repository = $this->getDoctrine()->getRepository(Evenement::class);
        $events = $repository->findAll();

        return $this->render('@TheatreAdministrateur/Default/listEvent.html.twig', array('listEvent' => $events, 'utilisateur'=> $utilisateur[0]));
    }

    // Attribuer un evenement à un utilisateur
    public function participateEventAction() {

        $entityManager = $this->getDoctrine()->getManager();
    	$repository = $this->getDoctrine()->getRepository(UtilisateurEvenement::class);

        return $this->render('@TheatreAdministrateur/Default/index.html.twig');
    }
}
