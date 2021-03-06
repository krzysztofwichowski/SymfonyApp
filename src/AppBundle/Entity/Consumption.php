<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Consumption
 *
 * @ORM\Table(name="consumption", indexes={@ORM\Index(name="fk_Consumption_User_idx", columns={"uid"}), @ORM\Index(name="fk_Consumption_Alcohol1_idx", columns={"aid"})})
 * @ORM\Entity
 */
class Consumption
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
     * @var \DateTime
     *
     * @ORM\Column(name="date", type="date", nullable=false)
     */
    private $date;

    /**
     * @ORM\ManyToOne(targetEntity="User", inversedBy="consumption")
     * @ORM\JoinColumn(name="uid", referencedColumnName="id")
     */
    protected $user;

    /**
     * @ORM\ManyToOne(targetEntity="Alcohol", inversedBy="consumption")
     * @ORM\JoinColumn(name="aid", referencedColumnName="id")
     */
    protected $alcohol;

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
     * @return \DateTime
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * @param \DateTime $date
     */
    public function setDate($date)
    {
        $this->date = $date;
    }

    /**
     * Set user
     *
     * @param \AppBundle\Entity\User $user
     *
     * @return Consumption
     */
    public function setUser(\AppBundle\Entity\User $user = null)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get user
     *
     * @return \AppBundle\Entity\User
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * Set alcohol
     *
     * @param \AppBundle\Entity\Alcohol $alcohol
     *
     * @return Consumption
     */
    public function setAlcohol(\AppBundle\Entity\Alcohol $alcohol = null)
    {
        $this->alcohol = $alcohol;

        return $this;
    }

    /**
     * Get alcohol
     *
     * @return \AppBundle\Entity\Alcohol
     */
    public function getAlcohol()
    {
        return $this->alcohol;
    }
}
