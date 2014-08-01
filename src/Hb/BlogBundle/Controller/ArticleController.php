<?php

namespace Hb\BlogBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Hb\BlogBundle\Entity\Article;
use Hb\BlogBundle\Form\ArticleType;
use Hb\BlogBundle\Form\ArticleEditType;

/**
 * Description of ArticleController
 *
 * @author hb
 * 
 * @Route("/blog/article")
 */
class ArticleController extends Controller {

    /**
     * @Route("/", name="BlogBundle_ArticleList")
     * @Template()
     */
    public function indexAction() {
        $em = $this->getDoctrine()->getManager()->getRepository('HbBlogBundle:Article');
        $articles = $em->findAll();
        return array('articles' => $articles);
    }

    /**
     * @Route("/add", name="BlogBundle_ArticleAdd")
     * @Template()
     */
    public function addAction() {
        $article = new Article();

        $form = $this->createForm(new ArticleType(), $article);

        $request = $this->get('request');

        if ($request->getMethod() == 'POST') {
            $form->bind($request);
            if ($form->isValid()) {
                $em = $this->getDoctrine()->getManager();
                $em->persist($article);
                $em->flush();
                return $this->redirect($this->generateUrl('BlogBundle_ArticleList'));
            }
        }

        return array('form' => $form->createView());
    }

    /**
     * @Route("/voir/{id}", name="BlogBundle_ArticleListId")
     * @Template()
     */
    public function voirAction(Article $article) {
        return array('article' => $article);
    }

    /**
     * @Route("/update/{id}", name="BlogBundle_ArticleUpdate")
     * @Template()
     */
    public function updateAction(Article $article) {
        $form = $this->createForm(new ArticleEditType(), $article);

        $request = $this->get('request');

        if ($request->getMethod() == 'POST') {
            $form->bind($request);
            if ($form->isValid()) {
                $em = $this->getDoctrine()->getManager();
                $em->persist($article);
                $em->flush();
                return $this->redirect($this->generateUrl('BlogBundle_ArticleListId', array(
                                    'id' => $article->getId()
                )));
            }
        }
        return array('form' => $form->createView(),
            'article' => $article);
    }

    /**
     * @Route("/delete/{id}", name="BlogBundle_ArticleDelete")
     * @Template()
     */
    public function deleteAction(Article $article) {
        $form = $this->createFormBuilder()->getForm();
        $request = $this->getRequest();
        if ($request->getMethod() == 'POST') {
            $form->bind($request);
            if ($form->isValid()) {
                $em = $this->getDoctrine()->getManager();
                $em->remove($article);
                $em->flush();
                return $this->redirect($this->generateUrl('BlogBundle_ArticleList'));
            }
        }
        return array('form' => $form->createView(),
            'article' => $article);
    }

}
