<?php

namespace Hb\BlogBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Hb\BlogBundle\Entity\Categorie;
use Hb\BlogBundle\Form\CategorieType;
use Hb\BlogBundle\Form\CategorieEditType;

/**
 * Description of CategorieController
 *
 * @author hb
 * 
 * @Route("/blog/categorie")
 */
class CategorieController extends Controller {

    /**
     * @Route("/", name="BlogBundle_CategorieList")
     * @Template()
     */
    public function indexAction() {
        $em = $this->getDoctrine()->getManager()->getRepository('HbBlogBundle:Categorie');
        $categories = $em->findAll();
        return array('categories' => $categories);
    }

    /**
     * @Route("/add", name="BlogBundle_CategorieAdd")
     * @Template()
     */
    public function addAction() {
        $categorie = new Categorie();

        $form = $this->createForm(new CategorieType(), $categorie);

        $request = $this->get('request');

        if ($request->getMethod() == 'POST') {
            $form->bind($request);
            if ($form->isValid()) {
                $em = $this->getDoctrine()->getManager();
                $em->persist($categorie);
                $em->flush();
                return $this->redirect($this->generateUrl('BlogBundle_CategorieList'));
            }
        }

        return array('form' => $form->createView());
    }

    /**
     * @Route("/voir/{id}", name="BlogBundle_CategorieListId")
     * @Template()
     */
    public function voirAction(Categorie $categorie) {
        return array('categorie' => $categorie);
    }

    /**
     * @Route("/update/{id}", name="blogbundle_Categorieupdate")
     * @Template()
     */
    public function updateAction(Categorie $categorie) {
        $form = $this->createForm(new CategorieEditType(), $categorie);

        $request = $this->get('request');

        if ($request->getMethod() == 'POST') {
            $form->bind($request);
            if ($form->isValid()) {
                $em = $this->getDoctrine()->getManager();
                $em->persist($categorie);
                $em->flush();
                return $this->redirect($this->generateUrl('blogbundle_Categorievoir', array(
                                    'id' => $categorie->getId()
                )));
            }
        }
        return array('form' => $form->createView(),
            'categorie' => $categorie);
    }

    /**
     * @Route("/delete/{id}", name="BlogBundle_CategorieDelete")
     * @Template()
     */
    public function deleteAction(Categorie $categorie) {
        $form = $this->createFormBuilder()->getForm();
        $request = $this->getRequest();
        if ($request->getMethod() == 'POST') {
            $form->bind($request);
            if ($form->isValid()) {
                $em = $this->getDoctrine()->getManager();
                $em->remove($categorie);
                $em->flush();
                return $this->redirect($this->generateUrl('BlogBundle_CategorieList'));
            }
        }
        return array('form' => $form->createView(),
            'categorie' => $categorie);
    }

}
