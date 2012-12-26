<?php

namespace Locator\QuittanceBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Locator\QuittanceBundle\Entity\QuittanceItem;
use Locator\QuittanceBundle\Form\QuittanceItemType;

/**
 * QuittanceItem controller.
 *
 * @Route("/quittanceitem")
 */
class QuittanceItemController extends Controller
{
    /**
     * Lists all QuittanceItem entities.
     *
     * @Route("/", name="quittanceitem")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('LocatorQuittanceBundle:QuittanceItem')->findAll();

        return array(
            'entities' => $entities,
        );
    }

    /**
     * Finds and displays a QuittanceItem entity.
     * @Template()
     */
    public function quittanceAction($lease)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('LocatorQuittanceBundle:Quittance')->find($lease);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Quittance entity.');
        }

        return array(
            'entity' => $entity,
        );
    }

    /**
     * Finds and displays a QuittanceItem entity.
     *
     * @Route("/{id}/show", name="quittanceitem_show")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('LocatorQuittanceBundle:QuittanceItem')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find QuittanceItem entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to create a new QuittanceItem entity.
     *
     * @Route("/{qid}/new", name="quittanceitem_new")
     * @Template()
     */
    public function newAction($qid)
    {
        $em = $this->getDoctrine()->getManager();
        $entityQuittance = $em->getRepository('LocatorQuittanceBundle:Quittance')->find($qid);

        if (!$entityQuittance) {
            throw $this->createNotFoundException('Unable to find Quittance entity.');
        }

        $entity = new QuittanceItem();
        $entity->setQuittance($entityQuittance);
        $form   = $this->createForm(new QuittanceItemType(), $entity);

        return array(
            'entity' => $entity,
            'entityQuittance' => $entityQuittance,
            'form'   => $form->createView(),
        );
    }

    /**
     * Creates a new QuittanceItem entity.
     *
     * @Route("/{qid}/create", name="quittanceitem_create")
     * @Method("POST")
     * @Template("LocatorQuittanceBundle:QuittanceItem:new.html.twig")
     */
    public function createAction(Request $request, $qid)
    {
        $em = $this->getDoctrine()->getManager();
        $entityQuittance = $em->getRepository('LocatorQuittanceBundle:Quittance')->find($qid);

        if (!$entityQuittance) {
            throw $this->createNotFoundException('Unable to find Quittance entity.');
        }

        $entity  = new QuittanceItem();
        $form = $this->createForm(new QuittanceItemType(), $entity);
        $form->bind($request);

        $entity->setQuittance($entityQuittance);

        if ($form->isValid()) {
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('quittance_show', array('id' => $qid)));
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Displays a form to edit an existing QuittanceItem entity.
     *
     * @Route("/{id}/edit", name="quittanceitem_edit")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('LocatorQuittanceBundle:QuittanceItem')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find QuittanceItem entity.');
        }

        $editForm = $this->createForm(new QuittanceItemType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Edits an existing QuittanceItem entity.
     *
     * @Route("/{id}/update", name="quittanceitem_update")
     * @Method("POST")
     * @Template("LocatorQuittanceBundle:QuittanceItem:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('LocatorQuittanceBundle:QuittanceItem')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find QuittanceItem entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createForm(new QuittanceItemType(), $entity);
        $editForm->bind($request);

        if ($editForm->isValid()) {
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('quittance_show', array('id' => $entity->getQuittance()->getId())));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Deletes a QuittanceItem entity.
     *
     * @Route("/{id}/delete", name="quittanceitem_delete")
     * @Method("GET")
     */
    public function deleteAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();
        $entity = $em->getRepository('LocatorQuittanceBundle:QuittanceItem')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find QuittanceItem entity.');
        }

        $em->remove($entity);
        $em->flush();

        $this->get('session')->getFlashBag()->add('notice', 'Item deleted');

        return $this->redirect($this->getRequest()->headers->get('referer'));
    }

    private function createDeleteForm($id)
    {
        return $this->createFormBuilder(array('id' => $id))
            ->add('id', 'hidden')
            ->getForm()
        ;
    }
}
