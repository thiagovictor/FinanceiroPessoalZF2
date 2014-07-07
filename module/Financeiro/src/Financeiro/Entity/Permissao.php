<?php

namespace Financeiro\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Permissao
 *
 * @ORM\Entity
 * @ORM\Table(name="permissao", indexes={@ORM\Index(name="fk_permissao_user1_idx", columns={"user_id"}), @ORM\Index(name="fk_permissao_controlador1_idx", columns={"controlador_id"}), @ORM\Index(name="fk_permissao_acoes1_idx", columns={"acoes_id"})})
 * @ORM\Entity(repositoryClass="Financeiro\Entity\PermissaoRepository")
 */
class Permissao
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
     * @var User
     *
     * @ORM\ManyToOne(targetEntity="User", inversedBy="permissao")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     * })
     */
    private $user;

    /**
     * @var Controlador
     *
     * @ORM\ManyToOne(targetEntity="Controlador", inversedBy="permissao")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="controlador_id", referencedColumnName="id")
     * })
     */
    private $controlador;

    /**
     * @var Acoes
     *
     * @ORM\ManyToOne(targetEntity="Acoes", inversedBy="permissao")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="acoes_id", referencedColumnName="id")
     * })
     */
    private $acoes;
    
    public function __construct($options=null) {
        Configurator::configure($this, $options);
    }
    
    public function getId() {
        return $this->id;
    }

    public function getUser() {
        return $this->user;
    }

    public function getControlador() {
        return $this->controlador;
    }

    public function getAcoes() {
        return $this->acoes;
    }

    public function setId($id) {
        $this->id = $id;
        return $this;
    }

    public function setUser(User $user) {
        $this->user = $user;
        return $this;
    }

    public function setControlador(Controlador $controlador) {
        $this->controlador = $controlador;
        return $this;
    }

    public function setAcoes(Acoes $acoes) {
        $this->acoes = $acoes;
        return $this;
    }

}
