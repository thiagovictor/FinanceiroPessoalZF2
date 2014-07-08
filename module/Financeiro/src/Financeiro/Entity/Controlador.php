<?php

namespace Financeiro\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Zend\Stdlib\Hydrator\ClassMethods;
use Financeiro\Entity\Acoes;

/**
 * Controlador
 *
 * @ORM\Entity
 * @ORM\Table(name="controlador")
 * @ORM\Entity(repositoryClass="Financeiro\Entity\ControladorRepository")
 */
class Controlador
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
     * @ORM\Column(name="descricao", type="text", nullable=true)
     */
    private $descricao;
    
    /**
    *
    * @ORM\OneToMany(targetEntity="Acoes", mappedBy="controlador")
    */
    protected $acoes;

    public function __construct(array $options = array()) {
        (new ClassMethods())->hydrate($options, $this);
        $this->acoes = new ArrayCollection();
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

    public function getAcoes() {
        return $this->acoes;
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

    public function setAcoes($acoes) {
        $this->acoes = $acoes;
        return $this;
    }  
}
