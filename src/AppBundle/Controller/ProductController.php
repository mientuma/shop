<?php

namespace AppBundle\Controller;

use Doctrine\Common\Collections\ArrayCollection;
use AppBundle\Entity\OrderedProducts;
use AppBundle\Entity\Orders;
use AppBundle\Entity\Supply;
use AppBundle\Entity\SupplyProducts;
use AppBundle\Form\EditProductForm;
use AppBundle\Form\OrderForm;
use AppBundle\Form\Type\SupplyForm;
use Doctrine\ORM\Tools\Pagination\Paginator;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Form\ProductForm;
use AppBundle\Entity\Products;
use Symfony\Component\HttpFoundation\Response;
use AppBundle\Form\UserType;
use AppBundle\Entity\User;
use Symfony\Component\HttpFoundation\Session\Session;
use AppBundle\Entity\Cart;

class ProductController extends BaseController
{
    /**
     * @Route("/products", name="showproducts")
     */
    public function showProductsAction()
    {
        $products = $this->getDoctrine()->getRepository('AppBundle:Products')->findAll();
        return $this->render('default/showProduct/showProduct.html.twig', array(
            'products' => $products
        ));
    }

    /**
     * @Route("/products/add", name="addproduct")
     */
    public function addProductAction(Request $request)
    {
        $product = new Products();
        $productForm = $this->createForm(ProductForm::class, $product);

        $productForm->handleRequest($request);

        if($productForm->isSubmitted() && $productForm->isValid())
        {
            $product = $productForm->getData();

            $em = $this->getEntityManager();
            $em->persist($product);
            $em->flush();
            $this->addFlash(
                'addNote',
                'Produkt został pomyślnie dodany!'
            );
            return $this->redirectToRoute('showproducts');
        }
        return $this->render('default/addProduct/AddProducts.html.twig', array(
            'productForm' => $productForm->createView(),
        ));
    }

    /**
     * @Route("/products/details/{id}", name="showproductdetails")
     */
    public function showProductDetailsAction($id)
    {
        $product = $this->getDoctrine()->getRepository('AppBundle:Products')->find($id);
        if(!$product)
        {
            throw $this->createNotFoundException();
        }
        return $this->render('default/showProductDetails/showProductDetails.html.twig', array(
            'product' => $product
        ));
    }

    /**
     * @Route("/products/edit/{id}", name="editproduct")
     */
    public function editProductAction($id, Request $request)
    {
        $product = $this->getDoctrine()->getRepository('AppBundle:Products')->find($id);

        $editForm = $this->createForm(EditProductForm::class, $product);

        $editForm->handleRequest($request);
        if($editForm->isSubmitted() && $editForm->isValid())
        {
            $em = $this->getEntityManager();
            $product = $em->getRepository('AppBundle:Products')->find($id);
            $product = $editForm->getData();
            $em->flush();
            $this->addFlash(
                'editNote',
                'Produkt został pomyślnie zaktualizowany!'
            );
            return $this->redirectToRoute('showproducts');
        }
        return $this->render('default/editProduct/editProduct.html.twig', array(
            'editForm' => $editForm->createView(),
        ));
    }

    /**
     * @Route("/products/delete/{id}", name="deleteproduct")
     */
    public function deleteProductAction($id)
    {
        $em = $this->getEntityManager();
        $product = $em->getRepository('AppBundle:Products')->find($id);
        $em->remove($product);
        $em->flush();
        $this->addFlash(
            'deleteNote',
            'Produkt został pomyślnie usunięty!'
        );
        return $this->redirectToRoute('showproducts');

    }
}