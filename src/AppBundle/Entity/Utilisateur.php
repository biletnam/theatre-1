<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use AppBundle\Entity\UtilisateurEvenement;

/**
 * Utilisateur
 *
 * @ORM\Table(name="utilisateur")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\UtilisateurRepository")
 */
class Utilisateur
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="user_id", type="string")
     */
    private $userId;

    /**
     * @var string
     *
     * @ORM\Column(name="team_domain", type="string", length=255)
     */
    private $teamDomain;

    /**
     * @var string
     *
     * @ORM\Column(name="nom", type="string", length=255, nullable=true)
     */
    private $nom;

    /**
     * @var string
     *
     * @ORM\Column(name="prenom", type="string", length=255, nullable=true)
     */
    private $prenom;

    /**
     * @var string
     *
     * @ORM\Column(name="user_name", type="string", length=255)
     */
    private $username;

    /**
     * @var string
     *
     * @ORM\Column(name="token", type="string", length=255)
     */
    private $token;

    /**
     * @var boolean
     *
     * @ORM\Column(name="admin", type="boolean", options={"default" : false})
     */
    private $admin;

    /**
    * @ORM\OneToMany(targetEntity="UtilisateurEvenement", mappedBy="utilisateur", cascade={"persist"}, orphanRemoval=true)
    */
    private $utilisateurevenements;
    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set userId
     *
     * @param integer $userId
     *
     * @return Utilisateur
     */
    public function setUserId($userId)
    {
        $this->userId = $userId;

        return $this;
    }

    /**
     * Get userId
     *
     * @return int
     */
    public function getUserId()
    {
        return $this->userId;
    }

    /**
     * Set teamDomain
     *
     * @param string $teamDomain
     *
     * @return Utilisateur
     */
    public function setTeamDomain($teamDomain)
    {
        $this->teamDomain = $teamDomain;

        return $this;
    }

    /**
     * Get teamDomain
     *
     * @return string
     */
    public function getTeamDomain()
    {
        return $this->teamDomain;
    }

    /**
     * Set nom
     *
     * @param string $nom
     *
     * @return Utilisateur
     */
    public function setNom($nom)
    {
        $this->nom = $nom;

        return $this;
    }

    /**
     * Get nom
     *
     * @return string
     */
    public function getNom()
    {
        return $this->nom;
    }

    /**
     * Set prenom
     *
     * @param string $prenom
     *
     * @return Utilisateur
     */
    public function setPrenom($prenom)
    {
        $this->prenom = $prenom;

        return $this;
    }

    /**
     * Get prenom
     *
     * @return string
     */
    public function getPrenom()
    {
        return $this->prenom;
    }

    /**
     * Set username
     *
     * @param string $username
     *
     * @return Utilisateur
     */
    public function setUserName($userName)
    {
        $this->username = $userName;

        return $this;
    }

    /**
     * Get username
     *
     * @return string
     */
    public function getUserName()
    {
        return $this->username;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->utilisateurevenements = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add utilisateurevenement
     *
     * @param \AppBundle\Entity\UtilisateurEvenement $utilisateurevenement
     *
     * @return Utilisateur
     */
    public function addUtilisateurevenement(\AppBundle\Entity\UtilisateurEvenement $utilisateurevenement)
    {
        $this->utilisateurevenements[] = $utilisateurevenement;

        return $this;
    }

    /**
     * Remove utilisateurevenement
     *
     * @param \AppBundle\Entity\UtilisateurEvenement $utilisateurevenement
     */
    public function removeUtilisateurevenement(\AppBundle\Entity\UtilisateurEvenement $utilisateurevenement)
    {
        $this->utilisateurevenements->removeElement($utilisateurevenement);
    }

    /**
     * Get utilisateurevenements
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getUtilisateurevenements()
    {
        return $this->utilisateurevenements;
    }

    /**
     * Set token
     *
     * @param string $token
     *
     * @return Utilisateur
     */
    public function setToken($token)
    {
        $this->token = $token;

        return $this;
    }

    /**
     * Get token
     *
     * @return string
     */
    public function getToken()
    {
        return $this->token;
    }

    /**
     * Set admin
     *
     * @param boolean $admin
     *
     * @return Utilisateur
     */
    public function setAdmin($admin)
    {
        $this->admin = $admin;

        return $this;
    }

    /**
     * Get admin
     *
     * @return boolean
     */
    public function getAdmin()
    {
        return $this->admin;
    }
}
