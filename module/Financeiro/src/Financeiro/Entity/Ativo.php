<?php

namespace Financeiro\Entity;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Financeiro\Entity\User;

/**
 * Ativo
 *
 * @ORM\Entity
 * @ORM\Table(name="ativo")
 * @ORM\Entity(repositoryClass="Financeiro\Entity\AtivoRepository")
 */
class Ativo
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
     * @ORM\Column(name="nome", type="string", length=45, nullable=true)
     */
    private $nome;
    
    /**
    *
    * @ORM\OneToMany(targetEntity="User", mappedBy="ativo")
    */
    protected $usuarios;

    public function __construct($options = null) {
        Configurator::configure($this, $options);
        $this->usuarios = new ArrayCollection();
    }
    public function getId() {
        return $this->id;
    }

    public function getNome() {
        return $this->nome;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function setNome($nome) {
        $this->nome = $nome;
    }
    
    public function getUsuarios() {
        return $this->usuarios;
    }

    public function setUsuarios($usuarios) {
        $this->usuarios = $usuarios;
    }

    public function toArray(){
        return array(
            'id' => $this->getId(),
            'nome' => $this->getNome()
        );
    }
    
}
