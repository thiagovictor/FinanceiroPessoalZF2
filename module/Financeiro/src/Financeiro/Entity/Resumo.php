<?php

namespace Financeiro\Entity;

use Doctrine\ORM\Mapping as ORM;
use Zend\Stdlib\Hydrator\ClassMethods;

/**
 * Resumo
 * 
 * @ORM\Entity
 * @ORM\Table(name="resumo", indexes={@ORM\Index(name="FK_User_Resumo_idx", columns={"user_id"})})
 * @ORM\Entity(repositoryClass="Financeiro\Entity\ResumoRepository")
 */
class Resumo
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
     * @ORM\Column(name="competencia", type="date", nullable=false)
     */
    private $competencia;

    /**
     * @var string
     *
     * @ORM\Column(name="despesa", type="decimal", precision=15, scale=2, nullable=false)
     */
    private $despesa;

    /**
     * @var string
     *
     * @ORM\Column(name="receita", type="decimal", precision=15, scale=2, nullable=false)
     */
    private $receita;

    /**
     * @var User
     *
     * @ORM\ManyToOne(targetEntity="User")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     * })
     */
    
    private $user;
    
    public function __construct(array $options = array()) {
        (new ClassMethods())->hydrate($options,$this);
    }
    public function getId() {
        return $this->id;
    }

    public function getCompetencia() {
        return $this->competencia;
    }

    public function getDespesa() {
        return $this->despesa;
    }

    public function getReceita() {
        return $this->receita;
    }

    public function getUser() {
        return $this->user;
    }

    public function setId($id) {
        $this->id = $id;
        return $this;
    }

    public function setCompetencia(\DateTime $competencia) {
        $this->competencia = $competencia;
        return $this;
    }

    public function setDespesa($despesa) {
        $this->despesa = $despesa;
        return $this;
    }

    public function setReceita($receita) {
        $this->receita = $receita;
        return $this;
    }

    public function setUser(User $user) {
        $this->user = $user;
        return $this;
    }


    
}
