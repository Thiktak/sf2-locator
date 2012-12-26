<?php

namespace Locator\QuittanceBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Locator\QuittanceBundle\Entity\Quittance;
use Locator\QuittanceBundle\Form\QuittanceType;
use Locator\QuittanceBundle\Form\QuittanceLeaseType;

/**
 * Quittance controller.
 *
 * @Route("/quittance")
 */
class QuittanceController extends Controller
{
    /**
     * Lists all Quittance entities.
     *
     * @Route("/list/{lid}", name="quittance")
     * @Template()
     */
    public function indexAction($lid)
    {
        $em = $this->getDoctrine()->getManager();
        $entities = $em->getRepository('LocatorQuittanceBundle:Quittance');
        $tags   = $em->getRepository('LocatorQuittanceBundle:Tags')->findAll();

        if( $lid )
            $entities = $entities->findByLease($lid, array('number' => 'DESC'));
        else
            $entities = $entities->findAll(null, array('number' => 'DESC'));


        return array(
            'entities' => $entities,
            'tags'     => $tags,
            'lid'      => $lid,
        );
    }

    
    /**
     * Add Tag
     *
     * @Route("/{id}/tag/add:{tid}", name="quittance_tag_add")
     * @Template()
     */
    public function tagAddAction($id, $tid)
    {
        $em = $this->getDoctrine()->getManager();

        $entityQuittance = $em->getRepository('LocatorQuittanceBundle:Quittance')->find($id);
        $entityTag       = $em->getRepository('LocatorQuittanceBundle:Tags')->find($tid);

        $entityQuittance->addTag($entityTag);
        $em->persist($entityQuittance);
        $em->flush();

        return $this->redirect($this->getRequest()->headers->get('referer'));
    }

    /**
     * Remove Tag
     *
     * @Route("/{id}/tag/remove:{tid}", name="quittance_tag_remove")
     * @Template()
     */
    public function tagRemoveAction($id, $tid)
    {
        $em = $this->getDoctrine()->getManager();

        $entityQuittance = $em->getRepository('LocatorQuittanceBundle:Quittance')->find($id);
        $entityTag       = $em->getRepository('LocatorQuittanceBundle:Tags')->find($tid);

        $entityQuittance->removeTag($entityTag);
        $em->persist($entityQuittance);
        $em->flush();

        return $this->redirect($this->getRequest()->headers->get('referer'));
    }

    /**
     * Finds and displays a Quittance entity.
     *
     * @Route("/{id}/show", name="quittance_show")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('LocatorQuittanceBundle:Quittance')->find($id);
        $tags   = $em->getRepository('LocatorQuittanceBundle:Tags')->findAll();

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Quittance entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'tags'        => $tags,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to create a new Quittance entity.
     *
     * @Route("/new", name="quittance_new")
     * @Template()
     */
    public function newLeaseAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('LocatorLeaseBundle:Lease')->findAll();

        if( ($lease = $request->get('lid')) )
            return $this->redirect($this->generateUrl('quittance_new_lease', array('lid' => $lease)));

        return array(
            'entities' => $entities
        );
    }

    /**
     * Displays a form to create a new Quittance entity.
     *
     * @Route("/new/{lid}", name="quittance_new_lease")
     * @Template()
     */
    public function newAction(Request $request, $lid)
    {
        $em = $this->getDoctrine()->getManager();
        $last = $em->getRepository('LocatorQuittanceBundle:Quittance')->findLastByLease($lid);

        $entity = new Quittance();
        
        if( $last ) {
            $dateStart = clone $last->getDateEnd();
            $dateStart = $dateStart->add(new \DateInterval('P1D'));
            $dateEnd = clone $dateStart;
            $dateEnd = $dateEnd->add(new \DateInterval('P1M'))->sub(new \DateInterval('P1D'));

            $entity->setClauses($last->getClauses());
            $entity->setDateStart($dateStart);
            $entity->setDateEnd($dateEnd);
        }
        $entity->setNumber(( $last ? $last->getNumber() : 0 ) + 1);

        $this->get('thiktak.core.form')->bind($entity, array('lease' => $lid));

        $form   = $this->createForm(new QuittanceType(), $entity);

        return array(
            'entity'    => $entity,
            'lastQuittance' => $last,
            'form'      => $form->createView(),
        );
    }

    /**
     * Creates a new Quittance entity.
     *
     * @Route("/{lid}/create", name="quittance_create")
     * @Method("POST")
     * @Template("LocatorQuittanceBundle:Quittance:new.html.twig")
     */
    public function createAction(Request $request, $lid)
    {
        $entity = new Quittance();
        $em    = $this->getDoctrine()->getManager();
        $lease = $em->getRepository('LocatorLeaseBundle:Lease')->find($lid);
        $last  = $em->getRepository('LocatorQuittanceBundle:Quittance')->findLastByLease($lid);
        $entity->setLease($lease);
        
        $form = $this->createForm(new QuittanceType(), $entity);
        $form->bind($request);
        //$this->get('thiktak.core.form')->bind($entity);

        
        if ($form->isValid() ) {
            $em->persist($entity);

            if( $last )
                foreach( $last->getItems(false) as $item ) {
                    $clone = clone $item;
                    $item->setQuittance($entity);
                    $entity->addItem($clone);

                    $em->persist($clone);
                }

            $em->flush();

            return $this->redirect($this->generateUrl('quittance_show', array('id' => $entity->getId())));
        }

        return array(
            'entity' => $entity,
            'lastQuittance' => $last,
            'form'   => $form->createView(),
        );
    }

    /**
     * Displays a form to edit an existing Quittance entity.
     *
     * @Route("/{id}/edit", name="quittance_edit")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('LocatorQuittanceBundle:Quittance')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Quittance entity.');
        }

        $editForm = $this->createForm(new QuittanceType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Edits an existing Quittance entity.
     *
     * @Route("/{id}/update", name="quittance_update")
     * @Method("POST")
     * @Template("LocatorQuittanceBundle:Quittance:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('LocatorQuittanceBundle:Quittance')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Quittance entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createForm(new QuittanceType(), $entity);
        $editForm->bind($request);

        if ($editForm->isValid()) {
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('quittance_edit', array('id' => $id)));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Deletes a Quittance entity.
     *
     * @Route("/{id}/delete", name="quittance_delete")
     * @Method("POST")
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('LocatorQuittanceBundle:Quittance')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Quittance entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('quittance'));
    }

    private function createDeleteForm($id)
    {
        return $this->createFormBuilder(array('id' => $id))
            ->add('id', 'hidden')
            ->getForm()
        ;
    }
}
