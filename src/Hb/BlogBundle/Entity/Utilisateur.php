<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Hb\BlogBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Hb\BlogBundle\Entity\Image;

/**
 * Utilisateur
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Hb\BlogBundle\Entity\UtilisateurRepository")
 */
class Utilisateur {
   /**
   * @var integer $id
   *
   * @ORM\Column(name="id", type="integer")
   * @ORM\Id
   * @ORM\GeneratedValue(strategy="AUTO")
   */
    private $id;
    
       /**
   * @var string $login
   *
   * @ORM\Column(name="login", type="string", length=255)
   */
    private $login;
    
       /**
   * @var string $pwd
   *
   * @ORM\Column(name="pwd", type="string", length=255)
   */
    private $pwd;
    
       /**
   * @var string $pseudo
   *
   * @ORM\Column(name="pseudo", type="string", length=255)
   */
    private $pseudo;
    /**
   * @var datetime $dateInsc
   *
   * @ORM\Column(name="date_creation", type="datetime")
   */
    private $date_creation; 
    /**
     * @var boolean
     *
     * @ORM\Column(name="actif", type="boolean", options={"default":1})
     */
    
    private $actif;
    
   /**
   * @var string $email
   *
   * @ORM\Column(name="email", type="string", length=255)
   */
    private $email;
       /**
   * @var string $tel
   *
   * @ORM\Column(name="tel", type="string", length=255)
   */
    private $tel;
       /**
   * @var string $url_site
   *
   * @ORM\Column(name="url_site", type="string", length=255)
   */
    private $url_site;

    /**
     * @ORM\OneToMany(targetEntity="Hb\BlogBundle\Entity\Article", mappedBy="utilisateur", cascade={"remove"})
     * @ORM\OrderBy({"dateCreation" = "desc"})
     */
    private $articles;

    /**
     * @ORM\OneToMany(targetEntity="Hb\BlogBundle\Entity\Commentaire", mappedBy="utilisateur", cascade={"remove"})
     * @ORM\OrderBy({"dateCreation" = "desc"})
     */
    private $commentaires;

    /**
     * @ORM\OneToOne(targetEntity="Hb\BlogBundle\Entity\Image", cascade={"persist", "remove"})
     */
    private $image;
    
     public function __construct()
    {
        $this->articles = new \Doctrine\Common\Collections\ArrayCollection();
        $this->commentaires = new \Doctrine\Common\Collections\ArrayCollection();
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
     * Set login
     *
     * @param string $login
     * @return Utilisateur
     */
    public function setLogin($login)
    {
        $this->login = $login;

        return $this;
    }

    /**
     * Get login
     *
     * @return string 
     */
    public function getLogin()
    {
        return $this->login;
    }

    /**
     * Set pwd
     *
     * @param string $pwd
     * @return Utilisateur
     */
    public function setPwd($pwd)
    {
        $this->pwd = $pwd;

        return $this;
    }

    /**
     * Get pwd
     *
     * @return string 
     */
    public function getPwd()
    {
        return $this->pwd;
    }

    /**
     * Set pseudo
     *
     * @param string $pseudo
     * @return Utilisateur
     */
    public function setPseudo($pseudo)
    {
        $this->pseudo = $pseudo;
        return $this;
    }

    /**
     * Get pseudo
     *
     * @return string 
     */
    public function getPseudo()
    {
        return $this->pseudo;
    }

    /**
     * Set date_creation
     *
     * @param \DateTime $dateCreation
     * @return Utilisateur
     */
    public function setDateCreation($dateCreation)
    {
        $this->date_creation = $dateCreation;

        return $this;
    }

    /**
     * Get date_creation
     *
     * @return \DateTime 
     */
    public function getDateCreation()
    {
        return $this->date_creation;
    }

    /**
     * Set actif
     *
     * @param boolean $actif
     * @return Utilisateur
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
     * Set email
     *
     * @param string $email
     * @return Utilisateur
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get email
     *
     * @return string 
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set tel
     *
     * @param string $tel
     * @return Utilisateur
     */
    public function setTel($tel)
    {
        $this->tel = $tel;

        return $this;
    }

    /**
     * Get tel
     *
     * @return string 
     */
    public function getTel()
    {
        return $this->tel;
    }

    /**
     * Set url_site
     *
     * @param string $urlSite
     * @return Utilisateur
     */
    public function setUrlSite($urlSite)
    {
        $this->url_site = $urlSite;

        return $this;
    }

    /**
     * Get url_site
     *
     * @return string 
     */
    public function getUrlSite()
    {
        return $this->url_site;
    }

    /**
     * Set image
     *
     * @param \Hb\BlogBundle\Entity\Image $image
     * @return Utilisateur
     */
    public function setImage(\Hb\BlogBundle\Entity\Image $image = null)
    {
        $this->image = $image;
        return $this;
    }

    /**
     * Get image
     *
     * @return \Hb\BlogBundle\Entity\Image 
     */
    public function getImage()
    {
        return $this->image;
    }

    /**
     * Add articles
     *
     * @param \Hb\BlogBundle\Entity\Article $articles
     * @return Utilisateur
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

    /**
     * Add commentaires
     *
     * @param \Hb\BlogBundle\Entity\Commentaire $commentaires
     * @return Utilisateur
     */
    public function addCommentaire(\Hb\BlogBundle\Entity\Commentaire $commentaires)
    {
        $this->commentaires[] = $commentaires;

        return $this;
    }

    /**
     * Remove commentaires
     *
     * @param \Hb\BlogBundle\Entity\Commentaire $commentaires
     */
    public function removeCommentaire(\Hb\BlogBundle\Entity\Commentaire $commentaires)
    {
        $this->commentaires->removeElement($commentaires);
    }

    /**
     * Get commentaires
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getCommentaires()
    {
        return $this->commentaires;
    }
}
