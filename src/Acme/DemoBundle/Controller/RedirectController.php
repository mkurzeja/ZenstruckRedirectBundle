<?php

namespace Acme\DemoBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Acme\DemoBundle\Entity\Redirect;
use Acme\DemoBundle\Form\RedirectType;

/**
 * Redirect controller.
 *
 * @Route("/redirect")
 */
class RedirectController extends Controller
{
    /**
     * Lists all Redirect entities.
     *
     * @Route("/", name="redirect")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getEntityManager();

        $entities = $em->getRepository('AcmeDemoBundle:Redirect')->findAll();

        return array('entities' => $entities);
    }

    /**
     * Finds and displays a Redirect entity.
     *
     * @Route("/{id}/show", name="redirect_show")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getEntityManager();

        $entity = $em->getRepository('AcmeDemoBundle:Redirect')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Redirect entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),        );
    }

    /**
     * Displays a form to create a new Redirect entity.
     *
     * @Route("/new", name="redirect_new")
     * @Template()
     */
    public function newAction()
    {
        $entity = new Redirect();
        $form   = $this->createForm(new RedirectType(), $entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView()
        );
    }

    /**
     * Creates a new Redirect entity.
     *
     * @Route("/create", name="redirect_create")
     * @Method("post")
     * @Template("AcmeDemoBundle:Redirect:new.html.twig")
     */
    public function createAction()
    {
        $entity  = new Redirect();
        $request = $this->getRequest();
        $form    = $this->createForm(new RedirectType(), $entity);
        $form->bindRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getEntityManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('redirect_show', array('id' => $entity->getId())));
            
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView()
        );
    }

    /**
     * Displays a form to edit an existing Redirect entity.
     *
     * @Route("/{id}/edit", name="redirect_edit")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getEntityManager();

        $entity = $em->getRepository('AcmeDemoBundle:Redirect')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Redirect entity.');
        }

        $editForm = $this->createForm(new RedirectType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Edits an existing Redirect entity.
     *
     * @Route("/{id}/update", name="redirect_update")
     * @Method("post")
     * @Template("AcmeDemoBundle:Redirect:edit.html.twig")
     */
    public function updateAction($id)
    {
        $em = $this->getDoctrine()->getEntityManager();

        $entity = $em->getRepository('AcmeDemoBundle:Redirect')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Redirect entity.');
        }

        $editForm   = $this->createForm(new RedirectType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        $request = $this->getRequest();

        $editForm->bindRequest($request);

        if ($editForm->isValid()) {
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('redirect_edit', array('id' => $id)));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Deletes a Redirect entity.
     *
     * @Route("/{id}/delete", name="redirect_delete")
     * @Method("post")
     */
    public function deleteAction($id)
    {
        $form = $this->createDeleteForm($id);
        $request = $this->getRequest();

        $form->bindRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getEntityManager();
            $entity = $em->getRepository('AcmeDemoBundle:Redirect')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Redirect entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('redirect'));
    }

    private function createDeleteForm($id)
    {
        return $this->createFormBuilder(array('id' => $id))
            ->add('id', 'hidden')
            ->getForm()
        ;
    }
}
