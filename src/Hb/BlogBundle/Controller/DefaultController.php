<?php

namespace Hb\BlogBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Hb\BlogBundle\Entity\Article;
use Hb\BlogBundle\Form\ArticleType;
use Hb\BlogBundle\Form\ImageType;

class DefaultController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('HbBlogBundle:Default:index.html.twig', array('name' => $name));
    }
    
    /**
     * @Route("/voir/{id}")
     * @Template()
     */
    public function voirAction($id)
    {
        $repository=  $this->getDoctrine()->getManager()->getRepository('HbBlogBundle:Article');
        $article=$repository->find($id);
        return array('article' =>$article);
    }
    /**
     * @Route("/ajouter")
     * @Template()
     */
    public function ajouterAction()
    {
        $article= new Article();
        $form=  $this->createForm(new ArticleType(),$article);
        $request= $this->get('request');
        if($request->getMethod()== 'POST'){
            $form->bind($request);
            if($form->isValid()){
                $em= $this->getDoctrine()->getManager();
                $em->persist($article);
                $em->flush();
            }
        }
        return array('form'=> $form->createView());
    }
}
