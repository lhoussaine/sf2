<?php

namespace Hb\BlogBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Hb\BlogBundle\Entity\Utilisateur;
use Hb\BlogBundle\Entity\Article;
use Hb\BlogBundle\Form\UtilisateurType;
use Hb\BlogBundle\Form\UtilisateurEditType;

/**
 * Description of UtilisateurController
 *
 * @author hb
 * 
 * @Route("/blog/gestion")
 */
class UtilisateurController extends Controller {

    /**
     * @Route("/", name="BlogBundle_UtilisateurList")
     * @Template()
     */
    public function indexAction() {
        $em = $this->getDoctrine()->getManager()->getRepository('HbBlogBundle:Utilisateur');
        $utilisateurs = $em->findAll();
        return array('utilisateurs' => $utilisateurs);
    }

    /**
     * @Route("/add", name="BlogBundle_UtilisateurAdd")
     * @Template()
     */
    public function addAction() {
        $utilisateur = new Utilisateur();

        $form = $this->createForm(new UtilisateurType(), $utilisateur);

        $request = $this->get('request');

        if ($request->getMethod() == 'POST') {
            $form->bind($request);
            if ($form->isValid()) {
                $em = $this->getDoctrine()->getManager();
                $em->persist($utilisateur);
                $em->flush();
                return $this->redirect($this->generateUrl('BlogBundle_UtilisateurList'));
            }
        }

        return array('form' => $form->createView());
    }

    /**
     * @Route("/profil/{id}", name="BlogBundle_UtilisateurListId")
     * @Template()
     */
    public function profilAction(Utilisateur $utilisateur) {
        $em = $this->getDoctrine()->getManager()->getRepository('HbBlogBundle:Article');
        $articles = $em->findAll();
        return array('utilisateur' => $utilisateur, 'articles' => $articles);
    }

    /**
     * @Route("/update/{id}", name="BlogBundle_UtilisateurUpdate")
     * @Template()
     */
    public function updateAction(Utilisateur $utilisateur) {
        $form = $this->createForm(new UtilisateurEditType(), $utilisateur);

        $request = $this->get('request');

        if ($request->getMethod() == 'POST') {
            $form->bind($request);
            if ($form->isValid()) {
                $em = $this->getDoctrine()->getManager();
                $em->persist($utilisateur);
                $em->flush();
                return $this->redirect($this->generateUrl('BlogBundle_UtilisateurListId', array(
                                    'id' => $utilisateur->getId()
                )));
            }
        }
        return array('form' => $form->createView(),
            'utilisateur' => $utilisateur);
    }

    /**
     * @Route("/delete/{id}", name="BlogBundle_UtilisateurDelete")
     * @Template()
     */
    public function deleteAction(Utilisateur $utilisateur) {
        $form = $this->createFormBuilder()->getForm();
        $request = $this->getRequest();
        if ($request->getMethod() == 'POST') {
            $form->bind($request);
            if ($form->isValid()) {
                $em = $this->getDoctrine()->getManager();
                $em->remove($utilisateur);
                $em->flush();
                return $this->redirect($this->generateUrl('BlogBundle_UtilisateurList'));
            }
        }
        return array('form' => $form->createView(),
            'utilisateur' => $utilisateur);
    }

}
