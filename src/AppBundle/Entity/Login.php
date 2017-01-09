<?php
/**
 * Created by PhpStorm.
 * User: Mateusz
 * Date: 12.10.2016
 * Time: 20:19
 */

namespace AppBundle\Entity;

use Symfony\Component\Validator\Constraints as Assert;
use AppBundle\Validator\Constraints as AcmeAssert;


class Login
{
    /**
     * @Assert\NotBlank()
     * @AcmeAssert\ContainsAlphanumeric(
     *     message="Podany nick zawiera niepoprawne znaki. Można używać wyłącznie liter i liczb."
     * )
     */
    private $login;

    /**
     * @Assert\NotBlank()
     * @AcmeAssert\ContainsAlphanumeric(
     *     message="Podane hasło zawiera niepoprawne znaki. Można używać wyłącznie liter i liczb."
     * )
     */
    private $password;

    /**
     * @return mixed
     */
    public function getLogin()
    {
        return $this->login;
    }

    /**
     * @param mixed $login
     */
    public function setLogin($login)
    {
        $this->login = $login;
    }

    /**
     * @return mixed
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * @param mixed $password
     */
    public function setPassword($password)
    {
        $this->password = $password;
    }

}