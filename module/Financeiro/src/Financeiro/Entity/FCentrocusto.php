<?php

namespace Financeiro\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * @ORM\Entity
 * @ORM\Table(name="f_centrocusto")
 * @ORM\Entity(repositoryClass="Financeiro\Entity\CentroCustoRepository")
 */
class FCentrocusto
{
    /**
     * @var integer
     *
     * @ORM\Column(name="idf_centrocusto", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    protected $idfCentrocusto;
    
    /**
     *
     * @ORM\OneToMany(targetEntity="Financeiro\Entity\FCartegoria", mappedBy="f_centrocusto")
     */
    protected $cartegorias;
    /**
     * @var string
     *
     * @ORM\Column(name="descricao", type="string", length=255, nullable=false)
     */
    protected $descricao;
    
    public function __construct($options = null) {
        Configurator::configure($this, $options);
        $this->cartegorias = new ArrayCollection();
    }
    public function getIdfCentrocusto() {
        return $this->idfCentrocusto;
    }

    public function getDescricao() {
        return $this->descricao;
    }

    public function setIdfCentrocusto($idfCentrocusto) {
        $this->idfCentrocusto = $idfCentrocusto;
    }

    public function setDescricao($descricao) {
        $this->descricao = $this->convertMaisculo($descricao);
    }

    public function __toString() {
        return $this->descricao;
    }
    private function convertMaisculo($string) {
        return strtr(strtoupper($string),"àáâãäåæçèéêëìíîïðñòóôõö÷øùüúþÿ","ÀÁÂÃÄÅÆÇÈÉÊËÌÍÎÏÐÑÒÓÔÕÖ×ØÙÜÚÞß");
    }
    private function convertMinusculo($string) {
        return strtr(strtolower($string),"ÀÁÂÃÄÅÆÇÈÉÊËÌÍÎÏÐÑÒÓÔÕÖ×ØÙÜÚÞß","àáâãäåæçèéêëìíîïðñòóôõö÷øùüúþÿ");
    } 
    public function getCartegorias() {
      return $this->cartegorias;
    }
    public function toArray(){
        return array(
          'idf_centrocusto' => $this->getIdfCentrocusto(),
          'descricao' => $this->getDescricao()
        );
    }
    



}
