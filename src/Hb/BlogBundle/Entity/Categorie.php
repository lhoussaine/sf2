<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Hb\BlogBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Categorie
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Hb\BlogBundle\Entity\CategorieRepository")
 */
class Categorie {
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var integer
     *
     * @ORM\ManyToOne(targetEntity="Categorie", inversedBy="enfants")
     */
    private $parent;

    /**
     *
     * @var type
     * @ORM\OneToMany(targetEntity="Categorie", mappedBy="parent")
     */
    private $enfants;

    /**
     * @var string
     *
     * @ORM\Column(name="titre", type="string", length=255)
     */
    private $titre;
    /**
     * @var string
     *
     * @ORM\Column(name="description", type="string", length=255)
     */
    private $description;
     /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_creation", type="datetime")
     */
    private $dateCreation;

    /**
     * @var boolean
     *
     * @ORM\Column(name="actif", type="boolean", options={"default":1})
     */
    private $actif;

    /**
     * @ORM\ManyToMany(targetEntity="Hb\BlogBundle\Entity\Article", mappedBy="categories")
     */
    private $articles;
    
    public function __construct()
    {
        $this->enfants = new \Doctrine\Common\Collections\ArrayCollection();
        $this->articles = new \Doctrine\Common\Collections\ArrayCollection();
        $this->date_creation = new \Datetime(); // Par défaut, la date de l'article est la date d'aujourd'hui
        $this->actif=true;
    }
    

    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set titre
     *
     * @param string $titre
     * @return Categorie
     */
    public function setTitre($titre)
    {
        $this->titre = $titre;

        return $this;
    }

    /**
     * Get titre
     *
     * @return string 
     */
    public function getTitre()
    {
        return $this->titre;
    }

    /**
     * Set description
     *
     * @param string $description
     * @return Categorie
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string 
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set dateCreation
     *
     * @param \DateTime $dateCreation
     * @return Categorie
     */
    public function setDateCreation($dateCreation)
    {
        $this->dateCreation = $dateCreation;
        return $this;
    }

    /**
     * Get dateCreation
     *
     * @return \DateTime 
     */
    public function getDateCreation()
    {
        return $this->dateCreation;
    }

    /**
     * Set actif
     *
     * @param boolean $actif
     * @return Categorie
     */
    public function setActif($actif)
    {
        $this->actif = $actif;

        return $this;
    }

    /**
     * Get actif
     *
     * @return boolean 
     */
    public function getActif()
    {
        return $this->actif;
    }

    /**
     * Set parent
     *
     * @param \Hb\BlogBundle\Entity\Categorie $parent
     * @return Categorie
     */
    public function setParent(\Hb\BlogBundle\Entity\Categorie $parent = null)
    {
        $this->parent = $parent;
        return $this;
    }

    /**
     * Get parent
     *
     * @return \Hb\BlogBundle\Entity\Categorie 
     */
    public function getParent()
    {
        return $this->parent;
    }

    /**
     * Add enfants
     *
     * @param \Hb\BlogBundle\Entity\Categorie $enfants
     * @return Categorie
     */
    public function addEnfant(\Hb\BlogBundle\Entity\Categorie $enfants)
    {
        $this->enfants[] = $enfants;
        return $this;
    }

    /**
     * Remove enfants
     *
     * @param \Hb\BlogBundle\Entity\Categorie $enfants
     */
    public function removeEnfant(\Hb\BlogBundle\Entity\Categorie $enfants)
    {
        $this->enfants->removeElement($enfants);
    }

    /**
     * Get enfants
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getEnfants()
    {
        return $this->enfants;
    }

    /**
     * Add articles
     *
     * @param \Hb\BlogBundle\Entity\Article $articles
     * @return Categorie
     */
    public function addArticle(\Hb\BlogBundle\Entity\Article $articles)
    {
        $this->articles[] = $articles;
        return $this;
    }

    /**
     * Remove articles
     *
     * @param \Hb\BlogBundle\Entity\Article $articles
     */
    public function removeArticle(\Hb\BlogBundle\Entity\Article $articles)
    {
        $this->articles->removeElement($articles);
    }

    /**
     * Get articles
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getArticles()
    {
        return $this->articles;
    }
}
