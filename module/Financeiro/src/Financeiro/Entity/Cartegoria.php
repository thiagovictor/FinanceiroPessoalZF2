<?php

namespace Financeiro\Entity;

use Doctrine\ORM\Mapping as ORM;
use Financeiro\Entity\Centrocusto;
use Financeiro\Entity\User;
use Zend\Stdlib\Hydrator\ClassMethods;

/**
 * Cartegoria
 * 
 * @ORM\Entity
 * @ORM\Table(name="cartegoria", indexes={@ORM\Index(name="fk_cartegoria_centrocusto1_idx", columns={"centrocusto_id"}), @ORM\Index(name="fk_cartegoria_user1_idx", columns={"user_id"})})
 * @ORM\Entity(repositoryClass="Financeiro\Entity\CartegoriaRepository")
 */
class Cartegoria
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
     * @ORM\Column(name="descricao", type="string", length=255, nullable=false)
     */
    private $descricao;

    /**
     * @var Centrocusto
     *
     * @ORM\ManyToOne(targetEntity="Centrocusto", inversedBy="cartegoria")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="centrocusto_id", referencedColumnName="id")
     * })
     */
    private $centrocusto;

    /**
     * @var User
     *
     * @ORM\ManyToOne(targetEntity="User", inversedBy="cartegoria")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     * })
     */
    private $user;

    public function __construct($options = null) {
        (new ClassMethods())->hydrate($options,$this);
    }
    
    public function getId() {
        return $this->id;
    }

    public function getDescricao() {
        return $this->descricao;
    }

    public function getCentrocusto() {
        return $this->centrocusto;
    }

    public function getUser() {
        return $this->user;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function setDescricao($descricao) {
        $this->descricao = $descricao;
    }

    public function setCentrocusto(Centrocusto $centrocusto) {
        $this->centrocusto = $centrocusto;
    }

    public function setUser(User $user) {
        $this->user = $user;
    }    
}
