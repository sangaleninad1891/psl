<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\ORM\EntityManager;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\RadioType;
use Symfony\Component\Validator\Constraints;
use AppBundle\Entity\Contact;
use AppBundle\Entity\Type;



class DefaultController extends Controller
{
    /**
     * @Route("/home", name="phonebook_homepage")
     */
    public function indexAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();

        $query = $em
            ->createQueryBuilder('t')
            ->select('c.id, c.fistname, c.lastname, c.contactnumber, t.phonetype')
            ->from('AppBundle:Contact', 'c')
            ->LeftJoin('AppBundle:Type', 't')
            ->where('c.id = t.id')
            ->orderBy('c.lastname', 'ASC')
            ->getQuery()
            ->getResult();

        return $this->render('default/index.html.twig', array(
            'all_contacts' => $query,
        ));
    }


    /**
     * @Route("/add-contact", name="phonebook_create")
     */
    public function createAction(Request $request)
    {

        $defaultData = array('message' => 'Type your message here');
        $form = $this->createFormBuilder($defaultData)
            ->add('firstname', TextType::class, array("label" => "First Name", "attr" => array("class" => 'form-control form-field')))
            ->add('lastname', TextType::class, array("label" => "Last Name", "attr" => array("class" => 'form-control form-field')))
            ->add('contactnumber', IntegerType::class, array("label" => "Contact Number", "attr" => array("class" => 'form-control form-field ', "placeholder" =>"XXXXXXXXXX", "maxlength"=>"10")))
            ->add('phonetype', ChoiceType::class, array("label" => "Phone Type", "choices" => array("Work" => "Work", "Cellular" => "Cellular", "Home" => "Home", "Other" => "Other"),"attr" => array("class" => 'form-field form-field-radio')))
            ->add('save', SubmitType::class, array("label" => "Save Contact", "attr" => array("class" => 'submit-button btn btn-success')))
            ->getForm();

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {

            $data = $form->getData();

            $contact = new Contact();
            $contact->setFistname($data['firstname']);
            $contact->setLastname($data['lastname']);
            $contact->setContactnumber($data['contactnumber']);

            $type = new Type();
            $type->setPhonetype($data['phonetype']);

            $contact->setType($type);

            $em = $this->getDoctrine()->getManager();
            $em->persist($contact);
            $em->persist($type);
            $em->flush();
            $this->addFlash('notice', 'New contact is added to PSL Phonebook.');

            return $this->redirectToRoute('phonebook_homepage');
            // return $this->redirect('add-contact');
        }

        return $this->render('default/create.html.twig', array(
            'form' => $form->createView())
        );
    }


    /**
     * @Route("/edit/{id}", name="phonebook_edit")
     */
    public function editAction($id, Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $contact_details = $em->getRepository('AppBundle:Contact');
        $contact = $contact_details->find($id);

        return $this->render('default/edit.html.twig', array('contact' => $contact));
    }


    /**
     * @Route("/view/{id}", name="phonebook_details")
     */
    public function detailsAction($id, Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $contact_details = $em->getRepository('AppBundle:Contact');
        $contact = $contact_details->find($id);

        $query = $em
            ->createQueryBuilder('t')
            ->select('c.id, c.fistname, c.lastname, c.contactnumber, t.phonetype')
            ->from('AppBundle:Contact', 'c')
            ->LeftJoin('AppBundle:Type', 't')
            ->where('c.id = t.id AND t.id = :id')
            ->getQuery()
            ->getArrayResult();

        return $this->render('default/view.html.twig', array('contact' => $contact));

    }

}
