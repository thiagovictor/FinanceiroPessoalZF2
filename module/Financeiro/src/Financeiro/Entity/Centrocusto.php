<?php

namespace Financeiro\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Financeiro\Entity\User;

/**
 * Centrocusto
 * @ORM\Entity
 * @ORM\Table(name="centrocusto", indexes={@ORM\Index(name="fk_f_centrocusto_user1_idx", columns={"user_id"})})
 * @ORM\Entity(repositoryClass="Financeiro\Entity\CentrocustoRepository")
 */
class Centrocusto
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    protected $id;

    /**
     * @var string
     *
     * @ORM\Column(name="descricao", type="string", length=255, nullable=false)
     */
    protected $descricao;

    /**
     * @var User
     *
     * @ORM\ManyToOne(targetEntity="User", inversedBy="centrocusto")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     * })
     */
    protected $user;
    
     /**
     *
     * @ORM\OneToMany(targetEntity="Financeiro\Entity\Cartegoria", mappedBy="centrocusto")
     */
    protected $cartegorias;
    
    public function __construct($options = null) {
        Configurator::configure($this, $options);
        $this->cartegorias = new ArrayCollection();
    }
    
    public function getId() {
        return $this->id;
    }

    public function getDescricao() {
        return $this->descricao;
    }

    public function getUser() {
        return $this->user;
    }

    public function getCartegorias() {
        return $this->cartegorias;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function setDescricao($descricao) {
        $this->descricao = $descricao;
    }

    public function setUser(User $user) {
        $this->user = $user;
    }

    public function setCartegorias($cartegorias) {
        $this->cartegorias = $cartegorias;
    }
    
    private function convertMaisculo($string) {
        return strtr(strtoupper($string),"àáâãäåæçèéêëìíîïðñòóôõö÷øùüúþÿ","ÀÁÂÃÄÅÆÇÈÉÊËÌÍÎÏÐÑÒÓÔÕÖ×ØÙÜÚÞß");
    }
    
    private function convertMinusculo($string) {
        return strtr(strtolower($string),"ÀÁÂÃÄÅÆÇÈÉÊËÌÍÎÏÐÑÒÓÔÕÖ×ØÙÜÚÞß","àáâãäåæçèéêëìíîïðñòóôõö÷øùüúþÿ");
    }
}
