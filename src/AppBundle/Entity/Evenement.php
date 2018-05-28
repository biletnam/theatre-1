<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use AppBundle\Entity\UtilisateurEvenement;
/**
 * Evenement
 *
 * @ORM\Table(name="evenement")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\EvenementRepository")
 */
class Evenement
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
     * @ORM\Column(name="nom", type="string", length=255)
     */
    private $nom;

    /**
     * @var string
     *
     * @ORM\Column(name="lieu", type="string", length=255)
     */
    private $lieu;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date", type="datetime")
     */
    private $date;
    /**
    * @ORM\OneToMany(targetEntity="UtilisateurEvenement", mappedBy="evenement", cascade={"persist"})
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
     * Set nom
     *
     * @param string $nom
     *
     * @return Evenement
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
     * Set lieu
     *
     * @param string $lieu
     *
     * @return Evenement
     */
    public function setLieu($lieu)
    {
        $this->lieu = $lieu;

        return $this;
    }

    /**
     * Get lieu
     *
     * @return string
     */
    public function getLieu()
    {
        return $this->lieu;
    }

    /**
     * Set date
     *
     * @param \DateTime $date
     *
     * @return Evenement
     */
    public function setDate($date)
    {
        $this->date = $date;

        return $this;
    }

    /**
     * Get date
     *
     * @return \DateTime
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * Set heureDeb
     *
     * @param \DateTime $heureDeb
     *
     * @return Evenement
     */
    public function setHeureDeb($heureDeb)
    {
        $this->heureDeb = $heureDeb;

        return $this;
    }

    /**
     * Get heureDeb
     *
     * @return \DateTime
     */
    public function getHeureDeb()
    {
        return $this->heureDeb;
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
     * @return Evenement
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
}
