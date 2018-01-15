<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 09/01/2018
 * Time: 22:32
 */

namespace AppBundle\Controller;
use AppBundle\Entity\cv;
use AppBundle\Entity\parcour;
use AppBundle\Form\cvType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;

/**
 * Class cvController
 * @package AppBundle\Controller
 * @Route("/cv")
 */
class cvController extends Controller
{

    /**
     * @Route("/create",name="create")
     */
    public function createAction(Request $request){
        $cv=new cv();$par=new parcour();
        $form = $this->createForm('AppBundle\Form\cvType', $cv);
        $form->handleRequest($request);
        if($form->isValid() && $form->isSubmitted()){
            $em=$this->getDoctrine()->getManager();

            $par->setCv($cv);

            $em->persist($cv);
            $em->flush();
            return $this->render("cv/new.html.twig",array('form'=>$form->createView()));
        }
        return $this->render("cv/new.html.twig",array('form'=>$form->createView()));

    }
}