<?php

namespace CentroCusto\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="f_centrocusto")
 * @ORM\Entity(repositoryClass="CentroCusto\Entity\CentroCustoRepository")
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
     * @var string
     *
     * @ORM\Column(name="descricao", type="string", length=255, nullable=false)
     */
    protected $descricao;
    
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
        $this->descricao = $descricao;
    }

    public function __toString() {
        return $this->descricao;
    }
    
    public function toArray(){
        return array(
          'idfCentrocusto' => $this->getIdfCentrocusto(),
          'descricao' => $this->getDescricao()
        );
    }


}
