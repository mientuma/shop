<?php
/**
 * Created by PhpStorm.
 * User: Mateusz
 * Date: 27.01.2017
 * Time: 10:45
 */

namespace AppBundle\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\Controller;

abstract class BaseController extends Controller
{
    /**
     * @return \Doctrine\Common\Persistence\ObjectManager|object
     */
    public function getEntityManager()
    {
        $em = $this->getDoctrine()->getManager();
        return $em;
    }

}