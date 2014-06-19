<?php

namespace Financeiro\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Cartao
 * @ORM\Entity
 * @ORM\Table(name="cartao", indexes={@ORM\Index(name="fk_cartao_user1_idx", columns={"user_id"})})
 * @ORM\Entity(repositoryClass="Financeiro\Entity\CartaoRepository")
 */
class Cartao
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
     * @var string
     *
     * @ORM\Column(name="vencimento", type="string",length=2, nullable=false)
     */
    private $vencimento;

    /**
     * @var User
     *
     * @ORM\ManyToOne(targetEntity="User")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     * })
     */
    private $user;
    
    public function __construct($options=null) {
        Configurator::configure($this, $options);
    }
    
    public function getId() {
        return $this->id;
    }

    public function getDescricao() {
        return $this->descricao;
    }

    public function getVencimento() {
        return $this->vencimento;
    }

    public function getUser() {
        return $this->user;
    }

    public function setId($id) {
        $this->id = $id;
        return $this;
    }

    public function setDescricao($descricao) {
        $this->descricao = $descricao;
        return $this;
    }

    public function setVencimento($vencimento) {
        $this->vencimento = $vencimento;
        return $this;
    }

    public function setUser(User $user) {
        $this->user = $user;
        return $this;
    }

    public function toArray(){
        return array(
            'id'=>  $this->getId(),
            'descricao'=>  $this->getDescricao(),
            'vencimento'=> $this->getVencimento(),
            'user'=>  $this->getUser(),
        );
    }
    
    
    
    


}
