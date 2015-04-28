<?php



use Doctrine\ORM\Mapping as ORM;

/**
 * Fechamento
 *
 * @ORM\Table(name="fechamento", indexes={@ORM\Index(name="FK_User_fechamento_idx", columns={"id_user"}), @ORM\Index(name="FK_User_Conta_idx", columns={"id_conta"})})
 * @ORM\Entity
 */
class Fechamento
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
     * @ORM\Column(name="saldo", type="decimal", precision=15, scale=2, nullable=false)
     */
    private $saldo;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="competencia", type="date", nullable=false)
     */
    private $competencia;

    /**
     * @var \User
     *
     * @ORM\ManyToOne(targetEntity="User")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_user", referencedColumnName="id")
     * })
     */
    private $idUser;

    /**
     * @var \Conta
     *
     * @ORM\ManyToOne(targetEntity="Conta")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_conta", referencedColumnName="id")
     * })
     */
    private $idConta;


}
