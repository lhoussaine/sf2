<?php

namespace Hb\BlogBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Hb\BlogBundle\Entity\Commentaire;
use Hb\BlogBundle\Form\CommentaireType;
use Hb\BlogBundle\Form\CommentaireEditType;
use Hb\BlogBundle\Entity\Article;

/**
 * Description of CommentaireController
 *
 * @author hb
 * 
 * @Route("/blog/commentaire")
 */
class CommentaireController extends Controller {

    /**
     * @Route("/add/{id}", name="BlogBundle_CommentaireAdd")
     * @Template()
     */
    public function addAction(Article $article) {
        $commentaire = new Commentaire($article);

        $form = $this->createForm(new CommentaireType(), $commentaire);

        $request = $this->get('request');

        if ($request->getMethod() == 'POST') {
            $form->bind($request);
            if ($form->isValid()) {
                $em = $this->getDoctrine()->getManager();
                $em->persist($commentaire);
                $em->flush();
                return $this->redirect($this->generateUrl('BlogBundleArticleListId', array('id' => $article->getId())));
            }
        }

        return array('form' => $form->createView());
    }

    /**
     * @Route("/update/{id}", name="BlogBundle_CommentaireUpdate")
     * @Template()
     */
    public function updateAction(Commentaire $commentaire) {
        $form = $this->createForm(new CommentaireEditType(), $commentaire);

        $request = $this->get('request');

        if ($request->getMethod() == 'POST') {
            $form->bind($request);
            if ($form->isValid()) {
                $em = $this->getDoctrine()->getManager();
                $em->persist($commentaire);
                $em->flush();
                //$this->get('session')->getFlashBag()->add('info', 'Article bien modifié');
                return $this->redirect($this->generateUrl('BlogBundleArticleListId', array(
                                    'id' => $commentaire->getArticle()->getId()
                )));
            }
        }
        return array('form' => $form->createView(),
            'commentaire' => $commentaire);
    }

    /**
     * @Route("/delete/{id}", name="BlogBundle_CommentaireDelete")
     * @Template()
     */
    public function deleteAction(Commentaire $commentaire) {
        $form = $this->createFormBuilder()->getForm();
        $request = $this->getRequest();
        if ($request->getMethod() == 'POST') {
            $form->bind($request);
            if ($form->isValid()) {
                $em = $this->getDoctrine()->getManager();
                $article = $commentaire->getArticle();
                $em->remove($commentaire);
                $em->flush();
                //$this->get('session')->getFlashBag()->add('info', 'Article bien supprimé');
                return $this->redirect($this->generateUrl('BlogBundleArticleListId', array(
                                    'id' => $article->getId()
                )));
            }
        }
        return array('form' => $form->createView(),
            'commentaire' => $commentaire);
    }

}
