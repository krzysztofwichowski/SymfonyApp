<?php



use Doctrine\ORM\Mapping as ORM;

/**
 * Alcohol
 *
 * @ORM\Table(name="alcohol", indexes={@ORM\Index(name="fk_Alcohol_Groups1_idx", columns={"gid"})})
 * @ORM\Entity
 */
class Alcohol
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
     * @ORM\Column(name="name", type="string", length=45, nullable=false)
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
     * @var \Groups
     *
     * @ORM\ManyToOne(targetEntity="Groups")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="gid", referencedColumnName="id")
     * })
     */
    private $gid;


}

