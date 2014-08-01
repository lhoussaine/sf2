<?php

namespace Hb\BlogBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Article
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Hb\BlogBundle\Entity\ArticleRepository")
 */
class Article
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="titre", type="string", length=255)
     */
    private $titre;

    /**
     * @ORM\OneToMany(targetEntity="Hb\BlogBundle\Entity\Commentaire", mappedBy="article", cascade={"remove"})
     * @ORM\OrderBy({"dateCreation" = "desc"})
     */
    private $commentaires;
    

    /**
    * @ORM\OneToOne(targetEntity="Hb\BlogBundle\Entity\Image", cascade={"persist", "remove"})
    */
    private $image;
    
    /**
    * @ORM\ManyToMany(targetEntity="Hb\BlogBundle\Entity\Categorie", cascade={"persist"})
    */
    private $categories;
    
    /**
    * @ORM\ManyToOne(targetEntity="Hb\BlogBundle\Entity\Utilisateur",inversedBy="articles", cascade={"persist"})
    */
    private $auteur;
    
    /**
     * @var string
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

    /**
     * @var boolean
     *
     * @ORM\Column(name="actif", type="boolean", options={"default":1})
     */
    private $actif;

    public function __construct()
    {
        $this->commentaires = new \Doctrine\Common\Collections\ArrayCollection();
        $this->categories = new \Doctrine\Common\Collections\ArrayCollection();
        $this->date_Creation = new \Datetime();
        $this->actif = true;
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
     * @return Article
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
     * Set dateCreation
     *
     * @param \DateTime $dateCreation
     * @return Article
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
     * @return Article
     */
    public function setActif($actif)
    {
        $this->actif = $actif;

        return $this;
    }

    /**
     * Get image
     *
     * @return Image 
     */
    public function getImage()
    {
        return $this->image;
    }
    
    /**
     * Set image
     *
     * @param Image $image
     * @return Image
     */
    public function setImage(Image $image)
    {
        $this->image = $image;
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
     * Set contenu
     *
     * @param string $contenu
     * @return Article
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
     * Add categorie
     *
     * @param \Hb\BlogBundle\Entity\Categorie $categorie
     * @return Article
     */
    public function addCategorie(\Hb\BlogBundle\Entity\Categorie $categorie)
    {
        $this->categorie[] = $categorie;
        return $this;
    }

    /**
     * Remove categorie
     *
     * @param \Hb\BlogBundle\Entity\Categorie $categorie
     */
    public function removeCategorie(\Hb\BlogBundle\Entity\Categorie $categorie)
    {
        $this->categorie->removeElement($categorie);
    }

    /**
     * Get categorie
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getCategorie()
    {
        return $this->categories;
    }

    /**
     * Set auteur
     *
     * @param \Hb\BlogBundle\Entity\Utilisateur $auteur
     * @return Article
     */
    public function setAuteur(\Hb\BlogBundle\Entity\Utilisateur $auteur = null)
    {
        $this->auteur = $auteur;

        return $this;
    }

    /**
     * Get auteur
     *
     * @return \Hb\BlogBundle\Entity\Utilisateur 
     */
    public function getAuteur()
    {
        return $this->auteur;
    }
    
    /**
     * Add commentaires
     *
     * @param \Hb\BlogBundle\Entity\Commentaire $commentaires
     * @return Article
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

    /**
     * Add categories
     *
     * @param \Hb\BlogBundle\Entity\Categorie $categories
     * @return Article
     */
    public function addCategory(\Hb\BlogBundle\Entity\Categorie $categories)
    {
        $this->categories[] = $categories;

        return $this;
    }

    /**
     * Remove categories
     *
     * @param \Hb\BlogBundle\Entity\Categorie $categories
     */
    public function removeCategory(\Hb\BlogBundle\Entity\Categorie $categories)
    {
        $this->categories->removeElement($categories);
    }

    /**
     * Get categories
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getCategories()
    {
        return $this->categories;
    }
}
