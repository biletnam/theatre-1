<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use AppBundle\Entity\Utilisateur;
use AppBundle\Entity\Evenement ;
/**
 * UtilisateurEvenement
 *
 * @ORM\Table(name="utilisateur_evenement")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\UtilisateurEvenementRepository")
 */
class UtilisateurEvenement
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
     * @ORM\Column(name="disponibilite", type="string", length=255, nullable=TRUE)
     */
    private $disponibilite;
    /**
    * @var string
    *
    * @ORM\Column(name="commentaire", type="string", length=255, nullable=TRUE)
    */
    private $commentaire;
    /**
     * @var string
     *
     * @ORM\Column(name="souhait", type="string", length=255, nullable=TRUE)
     */
    private $souhait;
     /**
     * @var \DateTime
     *
     * @ORM\Column(name="horaireDispo", type="datetime", nullable=TRUE)
     */
    private $horaireDispo;

    /**
     * @var string
     *
     * @ORM\Column(name="vehicule", type="string", length=255, nullable=TRUE)
     */
    private $vehicule;
    

    /**
     * @var int
     *
     * @ORM\Column(name="placeHebergement", type="integer", length=5, nullable=TRUE)
     */
    private $placeHebergement;
    /**
     * @var int
     *
     * @ORM\Column(name="userId", type="integer", length=5)
     */
    private $userId;
    /**
     * @var int
     *
     * @ORM\Column(name="eventId", type="integer", length=5)
     */
    private $eventId;

    /**
     * @ORM\ManyToOne(targetEntity="Utilisateur", inversedBy="utilisateurevenements", cascade={"persist"})
     * @ORM\JoinColumn(name="userId", referencedColumnName="id")
     */
    private $utilisateur;
    /**
     * @ORM\ManyToOne(targetEntity="Evenement", inversedBy="utilisateurevenements", cascade={"persist"})
     * @ORM\JoinColumn(name="eventId", referencedColumnName="id")
     */
    private $evenement;

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
     * Set disponibilite
     *
     * @param string $disponibilite
     *
     * @return UtilisateurEvenement
     */
    public function setDisponibilite($disponibilite)
    {
        $this->disponibilite = $disponibilite;

        return $this;
    }

    /**
     * Get disponibilite
     *
     * @return string
     */
    public function getDisponibilite()
    {
        return $this->disponibilite;
    }

    /**
     * Set souhait
     *
     * @param string $souhait
     *
     * @return UtilisateurEvenement
     */
    public function setSouhait($souhait)
    {
        $this->souhait = $souhait;

        return $this;
    }

    /**
     * Get souhait
     *
     * @return string
     */
    public function getSouhait()
    {
        return $this->souhait;
    }

    /**
     * Set userId
     *
     * @param integer $userId
     *
     * @return UtilisateurEvenement
     */
    public function setUserId($userId)
    {
        $this->userId = $userId;

        return $this;
    }

    /**
     * Get userId
     *
     * @return integer
     */
    public function getUserId()
    {
        return $this->userId;
    }

    /**
     * Set eventId
     *
     * @param integer $eventId
     *
     * @return UtilisateurEvenement
     */
    public function setEventId($eventId)
    {
        $this->eventId = $eventId;

        return $this;
    }

    /**
     * Get eventId
     *
     * @return integer
     */
    public function getEventId()
    {
        return $this->eventId;
    }

    /**
     * Set utilisateur
     *
     * @param \AppBundle\Entity\Utilisateur $utilisateur
     *
     * @return UtilisateurEvenement
     */
    public function setUtilisateur(\AppBundle\Entity\Utilisateur $utilisateur = null)
    {
        $this->utilisateur = $utilisateur;

        return $this;
    }

    /**
     * Get utilisateur
     *
     * @return \AppBundle\Entity\Utilisateur
     */
    public function getUtilisateur()
    {
        return $this->utilisateur;
    }

    /**
     * Set evenements
     *
     * @param \AppBundle\Entity\Evenement $evenement
     *
     * @return UtilisateurEvenement
     */
    public function setEvenement(\AppBundle\Entity\Evenement $evenement = null)
    {
        $this->evenement = $evenement;

        return $this;
    }

    /**
     * Get evenement
     *
     * @return \AppBundle\Entity\Evenement
     */
    public function getEvenement()
    {
        return $this->evenement;
    }

    /**
     * Set commentaire
     *
     * @param string $commentaire
     *
     * @return UtilisateurEvenement
     */
    public function setCommentaire($commentaire)
    {
        $this->commentaire = $commentaire;

        return $this;
    }

    /**
     * Get commentaire
     *
     * @return string
     */
    public function getCommentaire()
    {
        return $this->commentaire;
    }

    /**
     * Set horaireDispo
     *
     * @param string $horaireDispo
     *
     * @return UtilisateurEvenement
     */
    public function setHoraireDispo($horaireDispo)
    {
        $this->horaireDispo = $horaireDispo;

        return $this;
    }

    /**
     * Get horaireDispo
     *
     * @return string
     */
    public function getHoraireDispo()
    {
        return $this->horaireDispo;
    }

    /**
     * Set vehicule
     *
     * @param string $vehicule
     *
     * @return UtilisateurEvenement
     */
    public function setVehicule($vehicule)
    {
        $this->vehicule = $vehicule;

        return $this;
    }

    /**
     * Get vehicule
     *
     * @return string
     */
    public function getVehicule()
    {
        return $this->vehicule;
    }

    /**
     * Set placeHebergement
     *
     * @param string $placeHebergement
     *
     * @return UtilisateurEvenement
     */
    public function setPlaceHebergement($placeHebergement)
    {
        $this->placeHebergement = $placeHebergement;

        return $this;
    }

    /**
     * Get placeHebergement
     *
     * @return string
     */
    public function getPlaceHebergement()
    {
        return $this->placeHebergement;
    }
}
