<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Entity\Utilisateur;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function slackAction()
    {

        $tokenAuthentique = bin2hex(openssl_random_pseudo_bytes(32));
        echo "http://localhost/projetTheatre/Theatre/web/app_dev.php/AdministrateurBundle/theatre?token=".$tokenAuthentique;
        
        //On charge le repository Doctrine
        $entityManager = $this->getDoctrine()->getManager();
        $repository = $this->getDoctrine()->getRepository(Utilisateur::class);
        $authentification = $repository->findByUsername("faro");
        
        if($authentification){
            $authentification[0]->setToken($tokenAuthentique);
            $entityManager->persist($authentification[0]);
            $entityManager->flush();
            
        }else{
            $utilisateur  = new Utilisateur();
            $utilisateur->setUsername("froby");
            $utilisateur->setToken($tokenAuthentique);
            //$token->setTstamp(new \DateTime("Y-m-d"));

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($utilisateur);
            $entityManager->flush();
        }
        return null;
    }
}
