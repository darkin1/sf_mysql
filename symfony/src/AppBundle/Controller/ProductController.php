<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Product;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class ProductController extends Controller
{
    /**
     * @Route("/create")
     */
    public function createAction()
    {

        $product = new Product();
        $product->setName('p' . time());
        $product->setType('type1');

        $em = $this->getDoctrine()->getManager();
        $em->persist($product);
        $em->flush();


        return $this->render('AppBundle:Product:create.html.twig', array(
            'id' => $product->getId()
        ));
    }

}
