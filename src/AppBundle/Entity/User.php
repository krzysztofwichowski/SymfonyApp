<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Security\Core\User\UserInterface;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * User
 *
 * @ORM\Table(name="user")
 * @ORM\Entity
 * @UniqueEntity("email")
 * @UniqueEntity("username")
 */
class User implements UserInterface, \Serializable
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="username", type="string", length=45, nullable=false, unique=true)
     */
    private $username;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="bdate", type="date", nullable=false)
     */
    private $bdate;

    /**
     * @var string
     *
     * @ORM\Column(name="email", type="string", length=45, nullable=false, unique=true)
     */
    private $email;

    /**
     * @var string
     *
     * @ORM\Column(name="password", type="string", length=255, nullable=false)
     */
    private $password;

    private $plainPassword;

    /**
     * @ORM\OneToMany(targetEntity="Consumption", mappedBy="user")
     */
    protected $consumption;

    public function __construct()
    {
        $this->consumption = new ArrayCollection();
    }

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return string
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * @param string $username
     */
    public function setUsername($username)
    {
        $this->username = $username;
    }

    /**
     * @return \DateTime
     */
    public function getBdate()
    {
        return $this->bdate;
    }

    /**
     * @param \DateTime $bdate
     */
    public function setBdate($bdate)
    {
        $this->bdate = $bdate;
    }

    /**
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param string $email
     */
    public function setEmail($email)
    {
        $this->email = $email;
    }

    /**
     * @return string
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * @param string $password
     */
    public function setPassword($password)
    {
        $this->password = $password;
    }

    /**
     * @return mixed
     */
    public function getPlainPassword()
    {
        return $this->plainPassword;
    }

    /**
     * @param mixed $plainPassword
     */
    public function setPlainPassword($plainPassword)
    {
        $this->plainPassword = $plainPassword;
    }

    public function serialize()
    {
        return serialize([
            $this->id,
            $this->username,
            $this->password,
        ]);
    }

    public function unserialize($serialized)
    {
        list(
            $this->id,
            $this->username,
            $this->password
            ) = unserialize($serialized);
    }

    public function getRoles()
    {
        return ['ROLE_USER'];
    }

    public function getSalt()
    {
        return null;
    }

    public function eraseCredentials()
    {
        $this->plainPassword = null;
    }

    /**
     * Add consumption
     *
     * @param \AppBundle\Entity\Consumption $consumption
     *
     * @return User
     */
    public function addConsumption(\AppBundle\Entity\Consumption $consumption)
    {
        $this->consumption[] = $consumption;

        return $this;
    }

    /**
     * Remove consumption
     *
     * @param \AppBundle\Entity\Consumption $consumption
     */
    public function removeConsumption(\AppBundle\Entity\Consumption $consumption)
    {
        $this->consumption->removeElement($consumption);
    }

    /**
     * Get consumption
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getConsumption()
    {
        return $this->consumption;
    }
}
