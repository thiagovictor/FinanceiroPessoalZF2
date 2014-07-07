<?php

namespace Financeiro\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Lancamentos
 *
 * @ORM\Table(name="lancamentos", indexes={@ORM\Index(name="fk_lancamentos_tipo1_idx", columns={"tipo_id"}), @ORM\Index(name="fk_lancamentos_user1_idx", columns={"user_id"}), @ORM\Index(name="fk_lancamentos_periodos1_idx", columns={"periodo_id"}), @ORM\Index(name="fk_lancamentos_cartegoria1_idx", columns={"cartegoria_id"}), @ORM\Index(name="fk_lancamentos_conta1_idx", columns={"conta_id"}), @ORM\Index(name="fk_lancamentos_favorecido1_idx", columns={"favorecido_id"}), @ORM\Index(name="fk_lancamentos_centrocusto1_idx", columns={"centrocusto_id"}), @ORM\Index(name="fk_lancamentos_cartao1_idx", columns={"cartao_id"})})
 * @ORM\Entity(repositoryClass="Financeiro\Entity\LancamentosRepository")
 */
class Lancamentos
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
     * @ORM\Column(name="valor", type="decimal", precision=15, scale=2, nullable=false)
     */
    private $valor;

    /**
     * @var string
     *
     * @ORM\Column(name="descricao", type="string", length=255, nullable=false)
     */
    private $descricao;

    /**
     * @var string
     *
     * @ORM\Column(name="pagamento", type="date", nullable=false)
     */
    private $pagamento;
    
    /**
     * @var string
     *
     * @ORM\Column(name="vencimento", type="date", nullable=false)
     */
    private $vencimento;

    /**
     * @var integer
     *
     * @ORM\Column(name="parcelas", type="integer", nullable=true)
     */
    private $parcelas;

    /**
     * @var string
     *
     * @ORM\Column(name="arquivo_boleto", type="string", length=255, nullable=true)
     */
    private $arquivoBoleto;

    /**
     * @var string
     *
     * @ORM\Column(name="arquivo_comprovante", type="string", length=255, nullable=true)
     */
    private $arquivoComprovante;

    /**
     * @var boolean
     *
     * @ORM\Column(name="status", type="boolean", nullable=false)
     */
    private $status = '0';

    /**
     * @var string
     *
     * @ORM\Column(name="idparcela", type="string", length=45, nullable=true)
     */
    private $idparcela;

    /**
     * @var string
     *
     * @ORM\Column(name="idrecorrente", type="string", length=45, nullable=true)
     */
    private $idrecorrente;

    /**
     * @var string
     *
     * @ORM\Column(name="transf", type="string", length=45, nullable=true)
     */
    private $transf;

    /**
     * @var string
     *
     * @ORM\Column(name="documento", type="string", length=45, nullable=true)
     */
    private $documento;

    /**
     * @var Tipo
     *
     * @ORM\ManyToOne(targetEntity="Tipo")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="tipo_id", referencedColumnName="id")
     * })
     */
    private $tipo;

    /**
     * @var User
     *
     * @ORM\ManyToOne(targetEntity="User")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     * })
     */
    private $user;

    /**
     * @var Periodo
     *
     * @ORM\ManyToOne(targetEntity="Periodo")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="periodo_id", referencedColumnName="id")
     * })
     */
    private $periodo;

    /**
     * @var Cartegoria
     *
     * @ORM\ManyToOne(targetEntity="Cartegoria")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="cartegoria_id", referencedColumnName="id")
     * })
     */
    private $cartegoria;

    /**
     * @var Conta
     *
     * @ORM\ManyToOne(targetEntity="Conta")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="conta_id", referencedColumnName="id")
     * })
     */
    private $conta;

    /**
     * @var Favorecido
     *
     * @ORM\ManyToOne(targetEntity="Favorecido")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="favorecido_id", referencedColumnName="id")
     * })
     */
    private $favorecido;

    /**
     * @var Centrocusto
     *
     * @ORM\ManyToOne(targetEntity="Centrocusto")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="centrocusto_id", referencedColumnName="id")
     * })
     */
    private $centrocusto;

    /**
     * @var Cartao
     *
     * @ORM\ManyToOne(targetEntity="Cartao")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="cartao_id", referencedColumnName="id")
     * })
     */
    private $cartao;
    
    public function __construct($options=null) {
        Configurator::configure($this, $options);
    }
    
    public function getId() {
        return $this->id;
    }

    public function getValor() {
        return $this->valor;
    }

    public function getDescricao() {
        return $this->descricao;
    }
        
    public function getPagamento() {
        return $this->pagamento;
    }
    
    public function getVencimento() {
        return $this->vencimento;
    }

    public function getParcelas() {
        return $this->parcelas;
    }

    public function getArquivoBoleto() {
        return $this->arquivoBoleto;
    }

    public function getArquivoComprovante() {
        return $this->arquivoComprovante;
    }

    public function getStatus() {
        return $this->status;
    }

    public function getIdparcela() {
        return $this->idparcela;
    }

    public function getIdrecorrente() {
        return $this->idrecorrente;
    }

    public function getTransf() {
        return $this->transf;
    }

    public function getDocumento() {
        return $this->documento;
    }

    public function getTipo() {
        return $this->tipo;
    }

    public function getUser() {
        return $this->user;
    }

    public function getPeriodo() {
        return $this->periodo;
    }

    public function getCartegoria() {
        return $this->cartegoria;
    }

    public function getConta() {
        return $this->conta;
    }

    public function getFavorecido() {
        return $this->favorecido;
    }

    public function getCentrocusto() {
        return $this->centrocusto;
    }

    public function getCartao() {
        return $this->cartao;
    }

    public function setId($id) {
        $this->id = $id;
        return $this;
    }

    public function setValor($valor) {
        $this->valor = $valor;
        return $this;
    }

    public function setDescricao($descricao) {
        $this->descricao = $descricao;
        return $this;
    }

    public function setPagamento($pagamento) {
        $this->pagamento = $pagamento;
        return $this;
    }

        public function setVencimento($vencimento) {
        $this->vencimento = $vencimento;
        return $this;
    }

    public function setParcelas($parcelas) {
        $this->parcelas = $parcelas;
        return $this;
    }

    public function setArquivoBoleto($arquivoBoleto) {
        $this->arquivoBoleto = $arquivoBoleto;
        return $this;
    }

    public function setArquivoComprovante($arquivoComprovante) {
        $this->arquivoComprovante = $arquivoComprovante;
        return $this;
    }

    public function setStatus($status) {
        $this->status = $status;
        return $this;
    }

    public function setIdparcela($idparcela) {
        $this->idparcela = $idparcela;
        return $this;
    }

    public function setIdrecorrente($idrecorrente) {
        $this->idrecorrente = $idrecorrente;
        return $this;
    }

    public function setTransf($transf) {
        $this->transf = $transf;
        return $this;
    }

    public function setDocumento($documento) {
        $this->documento = $documento;
        return $this;
    }

    public function setTipo(Tipo $tipo) {
        $this->tipo = $tipo;
        return $this;
    }

    public function setUser(User $user) {
        $this->user = $user;
        return $this;
    }

    public function setPeriodo(Periodo $periodo) {
        $this->periodo = $periodo;
        return $this;
    }

    public function setCartegoria(Cartegoria $cartegoria) {
        $this->cartegoria = $cartegoria;
        return $this;
    }

    public function setConta(Conta $conta) {
        $this->conta = $conta;
        return $this;
    }

    public function setFavorecido(Favorecido $favorecido) {
        $this->favorecido = $favorecido;
        return $this;
    }

    public function setCentrocusto(Centrocusto $centrocusto) {
        $this->centrocusto = $centrocusto;
        return $this;
    }

    public function setCartao(Cartao $cartao) {
        $this->cartao = $cartao;
        return $this;
    }
}
