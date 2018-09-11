<?php



use Doctrine\ORM\Mapping as ORM;

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
     * @var \Alcohol
     *
     * @ORM\ManyToOne(targetEntity="Alcohol")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="aid", referencedColumnName="id")
     * })
     */
    private $aid;

    /**
     * @var \User
     *
     * @ORM\ManyToOne(targetEntity="User")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="uid", referencedColumnName="id")
     * })
     */
    private $uid;


}

