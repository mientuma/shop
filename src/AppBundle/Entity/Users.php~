<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use AppBundle\Validator\Constraints as AcmeAssert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;


/**
 * Users
 *
 * @ORM\Table(name="users")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\UsersRepository")
 * @UniqueEntity("user",
 * message="Użytkownik o tym nicku już istnieje w naszej bazie!")
 * @UniqueEntity("email",
 * message="Użytkownik o tym adresie email już istnieje w naszej bazie!")
 */
class Users
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="user", type="string", length=255, unique=true)
     *
     * @AcmeAssert\ContainsAlphanumeric(
     *     message="Podany nick zawiera niepoprawne znaki. Można używać wyłącznie liter i liczb."
     * )
     * @Assert\NotBlank(
     *     message="Musisz wypełnić to pole!"
     * )
     *
     * @Assert\Length(
     * min = 3,
     * max = 20,
     * minMessage = "Twój nick musi składać się z przynajmniej {{ limit }} znaków",
     * maxMessage = "Twój nick może składać się z maksymalnie {{ limit }} znaków"
     * )
     *
     */
    private $user;

    /**
     * @var string
     *
     * @ORM\Column(name="pass", type="string", length=255)
     *
     * @AcmeAssert\ContainsAlphanumeric(
     *     message="Podane hasło zawiera niepoprawne znaki. Można używać wyłącznie liter i liczb."
     * )
     *
     * @Assert\NotBlank(
     *     message="Musisz wypełnić to pole!"
     * )
     *
     * @Assert\Length(
     * min = 6,
     * max = 30,
     * minMessage = "Twoje hasło musi składać się z przynajmniej {{ limit }} znaków",
     * maxMessage = "Twoje hasło może składać się z maksymalnie {{ limit }} znaków"
     * )
     *
     */
    private $pass;

    /**
     * @var string
     *
     * @AcmeAssert\ContainsAlphanumeric(
     *     message="Podane hasło zawiera niepoprawne znaki. Można używać wyłącznie liter i liczb."
     * )
     *
     * @Assert\NotBlank(
     *     message="Musisz wypełnić to pole!"
     * )
     *
     * @Assert\Length(
     * min = 6,
     * max = 30,
     * minMessage = "Twoje hasło musi składać się z przynajmniej {{ limit }} znaków",
     * maxMessage = "Twoje hasło może składać się z maksymalnie {{ limit }} znaków"
     * )
     *
     * @Assert\Expression(
     *     "this.getPass() === this.getPassSEC()",
     *     message="Podane hasła nie pasują do siebie!"
     * )
     *
     *
     */
    private $passSEC;

    /**
     * @var string
     *
     * @ORM\Column(name="email", type="string", length=255, unique=true)
     *
     *
     * @Assert\NotBlank(
     *     message="Musisz wypełnić to pole!"
     * )
     *
     * @Assert\Email(
     *     message="Podano nieprawidłowy adres email"
     * )
     *
     * @Assert\Length(
     * min = 5,
     * max = 30,
     * minMessage = "Twój adres email musi składać się z przynajmniej {{ limit }} znaków",
     * maxMessage = "Twój adres email może składać się z maksymalnie {{ limit }} znaków"
     * )
     *
     */
    private $email;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="registerDate", type="datetime")
     *
     * @Assert\Blank()
     *
     */
    private $registerDate;

    /**
     * @var string
     *
     * @ORM\Column(name="role", type="string", length=255)
     */
    private $role;

    /**
     * Get id
     *
     * @return int
     */

    public function getId()
    {
        return $this->id;
    }

    /**
     * Set user
     *
     * @param string $user
     *
     * @return Users
     */
    public function setUser($user)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get user
     *
     * @return string
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * Set pass
     *
     * @param string $pass
     *
     * @return Users
     */
    public function setPass($pass)
    {
        $this->pass = $pass;

        return $this;
    }

    /**
     * Get pass
     *
     * @return string
     */
    public function getPass()
    {
        return $this->pass;
    }

    /**
     * Set passSEC
     *
     * @param string $passSEC
     *
     * @return Users
     */
    public function setPassSEC($passSEC)
    {
        $this->passSEC = $passSEC;

        return $this;
    }

    /**
     * Get passSEC
     *
     * @return string
     */
    public function getPassSEC()
    {
        return $this->passSEC;
    }

    /**
     * Set email
     *
     * @param string $email
     *
     * @return Users
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get email
     *
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set registerDate
     *
     * @param \DateTime $registerDate
     *
     * @return Users
     */
    public function setRegisterDate($registerDate)
    {
        $this->registerDate = $registerDate;

        return $this;
    }

    /**
     * Get registerDate
     *
     * @return \DateTime
     */
    public function getRegisterDate()
    {
        return $this->registerDate;
    }

    /**
     * Set role
     *
     * @param string $role
     *
     * @return Products
     */
    public function setRole($role)
    {
        $this->role = $role;

        return $this;
    }

    /**
     * Get role
     *
     * @return string
     */
    public function getRole()
    {
        return $this->role;
    }


}
