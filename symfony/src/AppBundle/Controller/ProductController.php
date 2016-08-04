<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Comment;
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


        $comment = new Comment();
        $comment->setTitle('comment1');
        $comment->setDescription('comment1desc');
        $comment->setProduct($product);


        $em = $this->getDoctrine()->getManager();
        $em->persist($product);
        $em->persist($comment);
        $em->flush();


        return $this->render('AppBundle:Product:create.html.twig', array(
            'id' => $product->getId()
        ));
    }

    /**
     * @Route("/createComment")
     */
    public function createCommentAction() {

        $comment = new Comment();
        $comment->setTitle('comment2');
        $comment->setDescription('comment2desc');


        $repository = $this->getDoctrine()->getRepository('AppBundle:Product');
        $product = $repository->find(6);
        $product->addComment($comment);



        $em = $this->getDoctrine()->getManager();
        $em->persist($product);
        $em->flush();

        return $this->render('AppBundle:Product:create.html.twig', array());
    }

    /**
     * @Route("/showProduct")
     */
    public function showProductAction()
    {

        $repository = $this->getDoctrine()->getRepository('AppBundle:Product');
        $product = $repository->find(6);

        dump($product->getComments()[0]);

        return $this->render('AppBundle:Product:create.html.twig', array(

        ));
    }


    /**
     * @Route("/removeProduct")
     */
    public function removeProductAction()
    {
        $em = $this->getDoctrine()->getManager();
        $product = $em->getRepository('AppBundle:Product')->find(10);

        $em->remove($product);
        $em->flush();

        return $this->render('AppBundle:Product:create.html.twig', array(

        ));
    }



}
