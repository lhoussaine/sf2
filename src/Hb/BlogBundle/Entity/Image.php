<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Hb\BlogBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Hb\BlogBundle\Entity\Image
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Hb\BlogBundle\Entity\ImageRepository")
 */
class Image
{
  /**
   * @var integer $id
   *
   * @ORM\Column(name="id", type="integer")
   * @ORM\Id
   * @ORM\GeneratedValue(strategy="AUTO")
   */
  private $id;

  /**
   * @var string $url
   *
   * @ORM\Column(name="url", type="string", length=255)
   */
  private $url;

  /**
   * @var string $titre
   *
   * @ORM\Column(name="titre", type="string", length=255)
   */
  private $titre;
  
  /**
   * @var string $description
   *
   * @ORM\Column(name="description", type="string", length=255)
   */
  private $description;

  // Les getters et setters

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
     * Set url
     *
     * @param string $url
     * @return url
     */
    public function setUrl($url)
    {
        $this->url = $url;

        return $this;
    }

    /**
     * Get url
     *
     * @return string 
     */
    public function getUrl()
    {
        return $this->url;
    }

    /**
     * Set titre
     *
     * @param string $titre
     * @return titre
     */
    public function setTitre($titre)
    {
        $this->titre = $titre;

        return $this;
    }

    /**
     * Get alt
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
     * @return description
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get alt
     *
     * @return string 
     */
    public function getDescription()
    {
        return $this->description;
    }
}
