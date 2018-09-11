<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Doctrine\Common\Collections\ArrayCollection;


/**
 * Groups
 *
 * @ORM\Table(name="groups")
 * @ORM\Entity
 * @UniqueEntity("name")
 */
class Groups
{
    /**
     * @ORM\OneToMany(targetEntity="Alcohol", mappedBy="gid")
     */
    protected $alcohol;

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
     * @ORM\Column(name="name", type="string", length=45, nullable=false, unique=true)
     */
    private $name;

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
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    public function __construct()
    {
        $this->alcohol = new ArrayCollection();
    }

    /**
     * Add alcohol
     *
     * @param \AppBundle\Entity\Alcohol $alcohol
     *
     * @return Groups
     */
    public function addAlcohol(\AppBundle\Entity\Alcohol $alcohol)
    {
        $this->alcohol[] = $alcohol;

        return $this;
    }

    /**
     * Remove alcohol
     *
     * @param \AppBundle\Entity\Alcohol $alcohol
     */
    public function removeAlcohol(\AppBundle\Entity\Alcohol $alcohol)
    {
        $this->alcohol->removeElement($alcohol);
    }

    /**
     * Get alcohol
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getAlcohol()
    {
        return $this->alcohol;
    }
}
