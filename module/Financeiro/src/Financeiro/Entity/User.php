<?php

namespace Financeiro\Entity;

use Doctrine\ORM\Mapping as ORM;
use Financeiro\Entity\Ativo;


/**
 * User
 *
 * @ORM\Table(name="user", uniqueConstraints={@ORM\UniqueConstraint(name="username_UNIQUE", columns={"username"})}, indexes={@ORM\Index(name="fk_user_restricao1_idx", columns={"ativo_id"})})
 * @ORM\Entity(repositoryClass="Financeiro\Entity\UserRepository")
 * @ORM\Entity
 */
class User
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
     * @ORM\Column(name="username", type="string", length=16, nullable=false)
     */
    private $username;

    /**
     * @var string
     *
     * @ORM\Column(name="email", type="string", length=255, nullable=true)
     */
    private $email;

    /**
     * @var string
     *
     * @ORM\Column(name="password", type="string", length=32, nullable=false)
     */
    private $password;

    /**
     * @var string
     *
     * @ORM\Column(name="salt", type="string", length=255, nullable=false)
     */
    private $salt;

    /**
     * @var string
     *
     * @ORM\Column(name="telefone", type="string", length=11, nullable=true)
     */
    private $telefone;

    /**
     * @var string
     *
     * @ORM\Column(name="celular", type="string", length=11, nullable=true)
     */
    private $celular;

    /**
     * @var Ativo
     *
     * @ORM\ManyToOne(targetEntity="Ativo", inversedBy="user")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="ativo_id", referencedColumnName="id")
     * })
     */
    private $ativo;

    public function __construct($options = null) {
        Configurator::configure($this, $options);       
    }
    
    public function getId() {
        return $this->id;
    }

    public function getUsername() {
        return $this->username;
    }

    public function getEmail() {
        return $this->email;
    }

    public function getPassword() {
        return $this->password;
    }

    public function getSalt() {
        return $this->salt;
    }

    public function getTelefone() {
        return $this->telefone;
    }

    public function getCelular() {
        return $this->celular;
    }

    public function getAtivo() {
        return $this->ativo;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function setUsername($username) {
        $this->username = $username;
    }

    public function setEmail($email) {
        $this->email = $email;
    }

    public function setPassword($password) {
        $this->password = $password;
    }

    public function setSalt($salt) {
        $this->salt = $salt;
    }

    public function setTelefone($telefone) {
        $this->telefone = $telefone;
    }

    public function setCelular($celular) {
        $this->celular = $celular;
    }

    public function setAtivo(Ativo $ativo) {
        $this->ativo = $ativo;
    }

    public function toArray(){
        return array(
            'id'=>$this->getId(),
            'username'=>$this->getUsername(),
            'password'=>$this->getPassword(),
            'salt'=>$this->getSalt(),
            'email'=>$this->getEmail(),
            'celular'=>$this->getCelular(),
            'telefone'=>$this->getTelefone(),
            'ativo'=>$this->getAtivo(),
        );
    }
}
