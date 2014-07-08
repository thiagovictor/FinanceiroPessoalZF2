<?php

namespace Financeiro\Entity;

use Doctrine\ORM\Mapping as ORM;
use Zend\Stdlib\Hydrator\ClassMethods;

/**
 * Tipo
 * @ORM\Entity
 * @ORM\Table(name="tipo")
 * @ORM\Entity(repositoryClass="Financeiro\Entity\TipoRepository")
 */
class Tipo
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
     * @ORM\Column(name="descricao", type="string", length=45, nullable=false)
     */
    private $descricao;

    /**
     * @var string
     *
     * @ORM\Column(name="javascript", type="string", length=255, nullable=true)
     */
    private $javascript;
    
    public function __construct(array $options= array()) {
        (new ClassMethods())->hydrate($options, $this);
    }
    
    public function getId() {
        return $this->id;
    }

    public function getDescricao() {
        return $this->descricao;
    }

    public function getJavascript() {
        return $this->javascript;
    }

    public function setId($id) {
        $this->id = $id;
        return $this;
    }

    public function setDescricao($descricao) {
        $this->descricao = $descricao;
        return $this;
    }

    public function setJavascript($javascript) {
        $this->javascript = $javascript;
        return $this;
    }

}
