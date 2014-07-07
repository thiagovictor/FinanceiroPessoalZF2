<?php

namespace Financeiro\Entity;

use Doctrine\ORM\Mapping as ORM;
use Zend\Stdlib\Hydrator\ClassMethods;

/**
 * Acoes
 * 
 * @ORM\Entity
 * @ORM\Table(name="acoes", indexes={@ORM\Index(name="fk_acoes_controlador1_idx", columns={"controlador_id"})})
 * @ORM\Entity(repositoryClass="Financeiro\Entity\AcoesRepository")
 */
class Acoes
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
     * @ORM\Column(name="nome", type="string", length=45, nullable=false)
     */
    private $nome;

    /**
     * @var string
     *
     * @ORM\Column(name="descricao", type="string", length=255, nullable=true)
     */
    private $descricao;

    /**
     * @var Controlador
     *
     * @ORM\ManyToOne(targetEntity="Controlador", inversedBy="Acoes")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="controlador_id", referencedColumnName="id")
     * })
     */
    private $controlador;

    public function __construct($options = null) {
        (new ClassMethods)->hydrate($options, $this);
    }
    
    public function getId() {
        return $this->id;
    }

    public function getNome() {
        return $this->nome;
    }

    public function getDescricao() {
        return $this->descricao;
    }

    public function getControlador() {
        return $this->controlador;
    }

    public function setId($id) {
        $this->id = $id;
        return $this;
    }

    public function setNome($nome) {
        $this->nome = $nome;
        return $this;
    }

    public function setDescricao($descricao) {
        $this->descricao = $descricao;
        return $this;
    }

    public function setControlador(Controlador $controlador) {
        $this->controlador = $controlador;
        return $this;
    }
}
