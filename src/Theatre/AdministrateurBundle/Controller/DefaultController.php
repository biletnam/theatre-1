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
		return $this->redirectToRoute('theatre_homepageAdmin');
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
		return $this->redirectToRoute('theatre_homepageAdmin');
		}

        return $this->render('@TheatreAdministrateur/Default/edit.html.twig', array('form' => $form->createView(),));
    }

    // Page de suppression des évenements
    public function deleteAction($id)
    {
        $entityManager = $this->getDoctrine()->getManager();
        
    	$repository_Event = $this->getDoctrine()->getRepository(Evenement::class);
        $event = $repository_Event->findBy(array('id'=>$id));

      //  $repository = $this->getDoctrine()->getRepository(UtilisateurEvenement::class);
        //$ue = $repository->findBy(array('eventId'=>$id));

        //dump($ue[]);die();
    	if (!$event) {
        	throw $this->createNotFoundException('No event found for id '.$ue
        	);
	    }else{
            $event = $repository_Event->findBy(array('id' => $id));
          //
     // dump($event);die();
          //  $entityManager->remove($ue[0]);
            //$entityManager->flush();
           // dump($event[0]->getId());die();
           $entityManager->remove($event[0]);
           // $repository_Event->remove( $event[0]);
            $entityManager->flush();
            $this->addFlash(
                'success',
                'Succès : Evnènement supprimé'
            );
            return $this->redirectToRoute('theatre_homepageAdmin');
        }
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
        $util = $ue[0]->getUserId();
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
            return $this->redirectToRoute('theatre_homepageUser',array('id'=>$util));
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

        $userId = $_GET['userId'];
        $userId = (int)$userId;
        $eventId = $_GET['eventId'];
        $eventId = (int)$eventId;

        $entityManager = $this->getDoctrine()->getManager();

        $repository =  $this->getDoctrine()->getRepository(Utilisateur::class);
        $utilisateur = $repository->findBy(array('id' => $userId));

        $repository =  $this->getDoctrine()->getRepository(Evenement::class);
        $evenement = $repository->findBy(array('id' => $eventId));
        $repository =  $this->getDoctrine()->getRepository(UtilisateurEvenement::class);

        // Si l'utilisateur n'est pas déjà inscrit à cet event
        $find = $repository->findBy(array('userId' => $userId, 'eventId' => $eventId));

        if (!$find) {

            $ue = new UtilisateurEvenement();
            $ue->setUserId($userId)->setEventId($eventId)->setUtilisateur($utilisateur[0])->setEvenement($evenement[0]);
    
            $entityManager->persist($ue);
            $entityManager->flush();

            $this->addFlash(
                'info',
                "Vous vous êtes inscrit à un évènement"
            );
        } else {
            $this->addFlash(
                'info',
                "Vous participez déjà à cet évènement"
            );
        }

        return $this->redirectToRoute('theatre_homepageUser', array('id' => $userId));
    }
    public function deleteUserAction($id)

    {
     //   $util = $ue[0]->getUserId();
      //  dump($util);
      $session = $this->get('security.token_storage')->getToken()->getUser()->getUsername();
      $repository =  $this->getDoctrine()->getRepository(UtilisateurEvenement::class);
      $utilisateurevent = $repository->findBy(array('id' => $id));
        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->remove($utilisateurevent[0]);
        $entityManager->flush();
        return $this->redirectToRoute('theatre_homepageUser',array('id'=>$session));
    }
}
