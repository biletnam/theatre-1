<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use AppBundle\Entity\Utilisateur;

class DefaultController extends Controller
{

    const TOKENSLACK = "numerotokenslack";
    const TEAMSLACK = "num team";

    /**
     * @Route("/", name="homepage")
     */
    public function slackAction()
    {

        $tokenAuthentique = bin2hex(openssl_random_pseudo_bytes(32));
        echo "http://localhost/theatre/web/app_dev.php/theatre?token=".$tokenAuthentique;
        
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
        return new Response();

        // replace this example code with whatever you need
       /* return $this->render('default/index.html.twig', [
            'base_dir' => realpath($this->getParameter('kernel.project_dir')).DIRECTORY_SEPARATOR,
        ]);*/
    }
}
