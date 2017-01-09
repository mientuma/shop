<?php
/**
 * Created by PhpStorm.
 * User: Mateusz
 * Date: 18.10.2016
 * Time: 19:20
 */

namespace AppBundle\Validator\Constraints;


use Symfony\Component\Validator\Constraint;

/**
 * @Annotation
 */
class ContainsAlphanumeric extends Constraint

{
    public $message = 'The string "%string%" contains an illegal character: it can only contain letters or numbers.';
}
