<?php

namespace Financeiro\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Acoes
 *
 * @ORM\Table(name="acoes", indexes={@ORM\Index(name="fk_acoes_controlador1_idx", columns={"controlador_id"})})
 * @ORM\Entity
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
     * @var \Controlador
     *
     * @ORM\ManyToOne(targetEntity="Controlador")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="controlador_id", referencedColumnName="id")
     * })
     */
    private $controlador;


}
