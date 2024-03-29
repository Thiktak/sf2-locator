<?php

namespace Locator\HouseBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Locator\HouseBundle\Entity\House;
use Locator\HouseBundle\Form\HouseType;

/**
 * House controller.
 *
 * @Route("/house")
 */
class HouseController extends Controller
{
    /**
     * @Template
     */
    public function menuAction() {
        return array();
    }

    /**
     * Lists all House entities.
     *
     * @Route("/", name="house")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('LocatorHouseBundle:House')->findAll();

        return array(
            'entities' => $entities,
        );
    }

    /**
     * Finds and displays a House entity.
     *
     * @Route("/{id}/show", name="house_show")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('LocatorHouseBundle:House')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find House entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to create a new House entity.
     *
     * @Route("/new", name="house_new")
     * @Template()
     */
    public function newAction()
    {
        $entity = new House();
        $form   = $this->createForm(new HouseType(), $entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Creates a new House entity.
     *
     * @Route("/create", name="house_create")
     * @Method("POST")
     * @Template("LocatorHouseBundle:House:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $entity  = new House();
        $form = $this->createForm(new HouseType(), $entity);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('house_show', array('id' => $entity->getId())));
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Displays a form to edit an existing House entity.
     *
     * @Route("/{id}/edit", name="house_edit")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('LocatorHouseBundle:House')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find House entity.');
        }

        $editForm = $this->createForm(new HouseType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Edits an existing House entity.
     *
     * @Route("/{id}/update", name="house_update")
     * @Method("POST")
     * @Template("LocatorHouseBundle:House:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('LocatorHouseBundle:House')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find House entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createForm(new HouseType(), $entity);
        $editForm->bind($request);

        if ($editForm->isValid()) {
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('house_edit', array('id' => $id)));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Deletes a House entity.
     *
     * @Route("/{id}/delete", name="house_delete")
     * @Method("POST")
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('LocatorHouseBundle:House')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find House entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('house'));
    }

    private function createDeleteForm($id)
    {
        return $this->createFormBuilder(array('id' => $id))
            ->add('id', 'hidden')
            ->getForm()
        ;
    }
}
