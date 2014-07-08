<?php

namespace Financeiro\Entity;

use Doctrine\ORM\Mapping as ORM;
use Zend\Stdlib\Hydrator\ClassMethods;

/**
 * Favorecido
 * @ORM\Entity
 * @ORM\Table(name="favorecido", indexes={@ORM\Index(name="fk_favorecido_user1_idx", columns={"user_id"})})
 * @ORM\Entity(repositoryClass="Financeiro\Entity\FavorecidoRepository")
 */
class Favorecido
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
     * @var User
     *
     * @ORM\ManyToOne(targetEntity="User", inversedBy="favorecido")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     * })
     */
    private $user;
    
    public function __construct(array $options = array()) {
        (new ClassMethods())->hydrate($options, $this);
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

    public function setId($id) {
        $this->id = $id;
        return $this;
    }

    public function setDescricao($descricao) {
        $this->descricao = $descricao;
        return $this;
    }

    public function setUser(User $user) {
        $this->user = $user;
        return $this;
    }

}
