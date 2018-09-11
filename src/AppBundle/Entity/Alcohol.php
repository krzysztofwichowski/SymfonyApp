<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Alcohol
 *
 * @ORM\Table(name="alcohol", indexes={@ORM\Index(name="fk_Alcohol_Groups1_idx", columns={"gid"})})
 * @ORM\Entity
 * @UniqueEntity("name")
 */
class Alcohol
{
    /**
     * @ORM\OneToMany(targetEntity="Consumption", mappedBy="aid")
     */
    protected $consumption;

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
     * @var float
     *
     * @ORM\Column(name="price", type="float", precision=10, scale=0, nullable=false)
     */
    private $price;

    /**
     * @var float
     *
     * @ORM\Column(name="alcoholicStrength", type="float", precision=10, scale=0, nullable=false)
     */
    private $alcoholicstrength;

    /**
     * @ORM\ManyToOne(targetEntity="Groups", inversedBy="alcohol", cascade={"all"})
     * @ORM\JoinColumn(name="gid", referencedColumnName="id")
     */
    protected $groups;
    

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

    /**
     * @return float
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * @param float $price
     */
    public function setPrice($price)
    {
        $this->price = $price;
    }

    /**
     * @return float
     */
    public function getAlcoholicstrength()
    {
        return $this->alcoholicstrength;
    }

    /**
     * @param float $alcoholicstrength
     */
    public function setAlcoholicstrength($alcoholicstrength)
    {
        $this->alcoholicstrength = $alcoholicstrength;
    }

    public function __construct()
    {
        $this->consumption = new ArrayCollection();
    }

    /**
     * Set groups
     *
     * @param \AppBundle\Entity\Groups $groups
     *
     * @return Alcohol
     */
    public function setGroups(\AppBundle\Entity\Groups $groups = null)
    {
        $this->groups = $groups;

        return $this;
    }

    /**
     * Get groups
     *
     * @return \AppBundle\Entity\Groups
     */
    public function getGroups()
    {
        return $this->groups;
    }

    /**
     * Add consumption
     *
     * @param \AppBundle\Entity\Consumption $consumption
     *
     * @return Alcohol
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
