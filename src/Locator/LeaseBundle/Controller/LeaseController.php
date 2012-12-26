<?php

namespace Locator\LeaseBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Locator\LeaseBundle\Entity\Lease;
use Locator\LeaseBundle\Form\LeaseType;

/**
 * Lease controller.
 *
 * @Route("/lease")
 */
class LeaseController extends Controller
{
    /**
     * @Template
     */
    public function menuAction() {
        $em = $this->getDoctrine()->getManager();
        $leases = $em->getRepository('LocatorLeaseBundle:Lease')->findAll();

        return compact('leases');
    }

    /**
     * @Route("/doc-lease:{id}", name="lease_doc_lease")
     * @Template()
     */
    public function docLeaseAction($id) {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('LocatorLeaseBundle:Lease')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Lease entity.');
        }

        return compact('entity');
    }

    /**
     * Lists all Lease entities.
     *
     * @Route("/", name="lease")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('LocatorLeaseBundle:Lease')->findAll();

        return array(
            'entities' => $entities,
        );
    }

    /**
     * Finds and displays a Lease entity.
     *
     * @Route("/{id}/show", name="lease_show")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('LocatorLeaseBundle:Lease')->find($id);
        $lastQuittance = $em->getRepository('LocatorQuittanceBundle:Quittance')->findLastByLease($id);
        $quittances    = $em->getRepository('LocatorQuittanceBundle:Quittance')->findByLease($id);

        $total = 0;
        foreach( $quittances as $quittance )
            $total += $quittance->getTotal(false);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Lease entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'        => $entity,
            'lastQuittance' => $lastQuittance,
            'total'         => $total,
            'delete_form'   => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to create a new Lease entity.
     *
     * @Route("/new", name="lease_new")
     * @Template()
     */
    public function newAction()
    {
        $entity = new Lease();
        $form   = $this->createForm(new LeaseType(), $entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Creates a new Lease entity.
     *
     * @Route("/create", name="lease_create")
     * @Method("POST")
     * @Template("LocatorLeaseBundle:Lease:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $entity  = new Lease();
        $form = $this->createForm(new LeaseType(), $entity);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('lease_show', array('id' => $entity->getId())));
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Displays a form to edit an existing Lease entity.
     *
     * @Route("/{id}/edit", name="lease_edit")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('LocatorLeaseBundle:Lease')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Lease entity.');
        }

        $editForm = $this->createForm(new LeaseType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Edits an existing Lease entity.
     *
     * @Route("/{id}/update", name="lease_update")
     * @Method("POST")
     * @Template("LocatorLeaseBundle:Lease:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('LocatorLeaseBundle:Lease')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Lease entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createForm(new LeaseType(), $entity);
        $editForm->bind($request);

        if ($editForm->isValid()) {
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('lease_edit', array('id' => $id)));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Deletes a Lease entity.
     *
     * @Route("/{id}/delete", name="lease_delete")
     * @Method("POST")
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('LocatorLeaseBundle:Lease')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Lease entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('lease'));
    }

    private function createDeleteForm($id)
    {
        return $this->createFormBuilder(array('id' => $id))
            ->add('id', 'hidden')
            ->getForm()
        ;
    }
}
