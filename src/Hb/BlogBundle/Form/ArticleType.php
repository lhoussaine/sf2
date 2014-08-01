<?php

namespace Hb\BlogBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class ArticleType extends AbstractType
{
        /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('titre')
            ->add('contenu')
            ->add('date_Creation')
            ->add('actif')
            ->add('image', 'entity', array(
                'class'=> 'HbBlogBundle:Image',
                'property'=>'titre',
                ))
            ->add('categorie', 'entity', array(
                'class'=> 'HbBlogBundle:Categorie',
                'property'=>'titre',
                'multiple'=>true,
                ))
            ->add('auteur', 'entity', array(
                'class'=> 'HbBlogBundle:Utilisateur',
                'property'=>'login',
                ));
        
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Hb\BlogBundle\Entity\Article'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'hb_blogbundle_article';
    }
}
