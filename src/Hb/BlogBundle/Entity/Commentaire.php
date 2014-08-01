<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Hb\BlogBundle\Entity;
use Doctrine\ORM\Mapping as ORM;

/**
 * Hb\BlogBundle\Entity\Commentaire
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Hb\BlogBundle\Entity\CommentaireRepository")
 */
class Commentaire {
    
    /**
   * @var integer $id
   *
   * @ORM\Column(name="id", type="integer")
   * @ORM\Id
   * @ORM\GeneratedValue(strategy="AUTO")
   */
    private $id;
    
    /**
    * @ORM\ManyToOne(targetEntity="Hb\BlogBundle\Entity\Utilisateur", inversedBy="commentaires")
    */
    private $auteur;
    
    /**
    * @ORM\ManyToOne(targetEntity="Hb\BlogBundle\Entity\Article", inversedBy="commentaires")
    */
    private $article;
    
     /**
    * @ORM\ManyToOne(targetEntity="Hb\BlogBundle\Entity\Commentaire", cascade={"persist"})
    */
    private $parent;
     /**
   * @var text $contenu
   *
   * @ORM\Column(name="contenu", type="text")
   */
    private $contenu;
      /**
   * @var \DateTime
   *
   * @ORM\Column(name="date_creation", type="datetime")
   */
    private $dateCreation;
    
   public function __construct(Article $article)
    {
        $this->setArticle($article);
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
     * Set contenu
     *
     * @param string $contenu
     * @return Commentaire
     */
    public function setContenu($contenu)
    {
        $this->contenu = $contenu;

        return $this;
    }

    /**
     * Get contenu
     *
     * @return string 
     */
    public function getContenu()
    {
        return $this->contenu;
    }
    
    /**
     * Add auteur
     *
     * @param \Hb\BlogBundle\Entity\Utilisateur $auteur
     * @return Commentaire
     */
    public function addAuteur(\Hb\BlogBundle\Entity\Utilisateur $auteur)
    {
        $this->auteur[] = $auteur;

        return $this;
    }

    /**
     * Remove auteur
     *
     * @param \Hb\BlogBundle\Entity\Utilisateur $auteur
     */
    public function removeAuteur(\Hb\BlogBundle\Entity\Utilisateur $auteur)
    {
        $this->auteur->removeElement($auteur);
    }

    /**
     * Get auteur
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getAuteur()
    {
        return $this->auteur;
    }

    /**
     * Set article
     *
     * @param \Hb\BlogBundle\Entity\Article $article
     * @return Commentaire
     */
    public function setArticle(\Hb\BlogBundle\Entity\Article $article = null)
    {
        $this->article = $article;

        return $this;
    }

    /**
     * Get article
     *
     * @return \Hb\BlogBundle\Entity\Article 
     */
    public function getArticle()
    {
        return $this->article;
    }

    /**
     * Set parent
     *
     * @param \Hb\BlogBundle\Entity\Commentaire $parent
     * @return Commentaire
     */
    public function setParent(\Hb\BlogBundle\Entity\Commentaire $parent = null)
    {
        $this->parent = $parent;

        return $this;
    }

    /**
     * Get parent
     *
     * @return \Hb\BlogBundle\Entity\Commentaire 
     */
    public function getParent()
    {
        return $this->parent;
    }

    /**
     * Set auteur
     *
     * @param \Hb\BlogBundle\Entity\Utilisateur $auteur
     * @return Commentaire
     */
    public function setAuteur(\Hb\BlogBundle\Entity\Utilisateur $auteur = null)
    {
        $this->auteur = $auteur;

        return $this;
    }

    /**
     * Set dateCreation
     *
     * @param \DateTime $dateCreation
     * @return Commentaire
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
}
