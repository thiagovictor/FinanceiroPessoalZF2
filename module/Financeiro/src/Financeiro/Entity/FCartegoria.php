<?php

namespace Financeiro\Entity;

use Doctrine\ORM\Mapping as ORM;
use Financeiro\Entity\FCentrocusto;

/**
 * FCartegoria
 *
 * @ORM\Table(name="f_cartegoria", indexes={@ORM\Index(name="FK_f_cartegoria_f_centrocusto", columns={"centrocusto"})})
 * @ORM\Entity
 * @ORM\Entity(repositoryClass="Financeiro\Entity\CartegoriaRepository")
 */
class FCartegoria
{
    /**
     * @var integer
     *
     * @ORM\Column(name="idf_cartegoria", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    protected $idfCartegoria;

    /**
     * @var string
     *
     * @ORM\Column(name="descricao", type="string", length=255, nullable=false)
     */
    protected $descricao;

    /**
     * @var FCentrocusto
     *
     * @ORM\ManyToOne(targetEntity="Financeiro\Entity\FCentrocusto", inversedBy="f_cartegoria")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="centrocusto", referencedColumnName="idf_centrocusto")
     * })
     */
    protected $centrocusto;
    
    public function __construct($options = null) {
        Configurator::configure($this, $options);       
    }
    
    public function getIdfCartegoria() {
        return $this->idfCartegoria;
    }

    public function getDescricao() {
        return $this->descricao;
    }

    public function getCentrocusto() {
        return $this->centrocusto;
    }

    public function setIdfCartegoria($idfCartegoria) {
        $this->idfCartegoria = $idfCartegoria;
    }

    public function setDescricao($descricao) {
        $this->descricao = $descricao;
    }

    public function setCentroCusto(FCentrocusto $centrocusto) {
        $this->centrocusto = $centrocusto;
    }
    
    public function toArray(){
        return array(
          'idf_cartegoria'=>$this->getIdfCartegoria(),
          'descricao'=>  $this->getDescricao(),
          'centrocusto'=>  $this->getCentrocusto()
        );
    }



}
