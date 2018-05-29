<?php

// src/AppBundle/Security/ApiKeyUserProvider.php
namespace AppBundle\Security;

use Symfony\Component\Security\Core\User\UserProviderInterface;
use Symfony\Component\Security\Core\User\User;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\Exception\UnsupportedUserException;
use AppBundle\Entity\Utilisateur;
use Doctrine\ORM\EntityManagerInterface;

class ApiKeyUserProvider implements UserProviderInterface
{
    protected $em;
    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }

    public function getUsernameForApiKey($apiKey)
    {
        // Look up the username based on the token in the database, via
        // an API call, or do something entirely different
        
        
        
        $repository = $this->em->getRepository(Utilisateur::class);
        $username = $repository->findByToken($apiKey);
        //dump($username);

        
        return $username[0]->getUserId();
    }

    public function loadUserByUsername($username)
    {
        return new User(
            $username,
            null,
            // the roles for the user - you may choose to determine
            // these dynamically somehow based on the user
            array('ROLE_ADMIN')
        );
    }

    public function refreshUser(UserInterface $user)
    {
        
        
        

        
        // this is used for storing authentication in the session
        // but in this example, the token is sent in each request,
        // so authentication can be stateless. Throwing this exception
        // is proper to make things stateless

        return $user;
    }

    public function supportsClass($class)
    {
        return User::class === $class;
    }
}