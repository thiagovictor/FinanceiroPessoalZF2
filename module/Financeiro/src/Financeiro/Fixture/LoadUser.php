<?php

namespace Financeiro\Fixture;

use Doctrine\Common\DataFixtures\AbstractFixture,
    Doctrine\Common\Persistence\ObjectManager;
use Financeiro\Entity\Centrocusto;
use Financeiro\Entity\Cartegoria;
use Financeiro\Entity\Ativo;
use Financeiro\Entity\User;
use Financeiro\Entity\Conta;
use Financeiro\Entity\Favorecido;
use Financeiro\Entity\Cartao;
use Financeiro\Entity\Periodo;
use Financeiro\Entity\Tipo;
use Financeiro\Entity\Lancamentos;

class LoadUser extends AbstractFixture {

    public function load(ObjectManager $manager) {

        $ativo = new Ativo;
        $ativo->setNome("Ativo");
        $manager->persist($ativo);

        $user = new User();
        $user->setUsername("Thiago Santos")
                ->setTelefone("8756-2190")
                ->setPassword("123")
                ->setEmail("thiago.santos@tsaengenharia.com.br")
                ->setAtivo($ativo);
        $manager->persist($user);

        $centrocusto = new Centrocusto;
        $centrocusto->setDescricao("ALIMENTAÇÃO")
                ->setUser($user);
        $manager->persist($centrocusto);

        $cartegoria = new Cartegoria;
        $cartegoria->setDescricao("PADARIA")
                ->setCentrocusto($centrocusto)
                ->setUser($user);
        $manager->persist($cartegoria);

        $conta = new Conta;
        $conta->setDescricao("Santander")
                ->setSaldo("10.00")
                ->setUser($user);
        $manager->persist($conta);
        
        $favorecido = new Favorecido;
        $favorecido->setDescricao("AMANDA DE PAULA FORTUNATO FERREIRA")
                ->setUser($user);
        $manager->persist($favorecido);
        
        $cartao = new Cartao;
        $cartao->setDescricao("Não")
                ->setVencimento("0")
                ->setUser($user);
        $manager->persist($cartao);
        
        $cartao = new Cartao;
        $cartao->setDescricao("Mastercard")
                ->setVencimento("18")
                ->setUser($user);
        $manager->persist($cartao);
        
        $periodo = new Periodo;
        $periodo->setDescricao("MENSAL");
        $manager->persist($periodo);
        
        $tipo = new Tipo();
        $tipo->setDescricao("NORMAL")
                ->setJavascript("javascript");
        $manager->persist($tipo);
        
        $lancamento = new Lancamentos;
        $lancamento->setCartao($cartao)
                ->setCartegoria($cartegoria)
                ->setCentrocusto($centrocusto)
                ->setConta($conta)
                ->setDescricao("Chips e bala")
                ->setDocumento("006563")
                ->setFavorecido($favorecido)
                ->setIdparcela("3")
                ->setPeriodo($periodo)
                ->setStatus("0")
                ->setTipo($tipo)
                ->setUser($user)
                ->setValor(10.25)
                ->setVencimento(new \DateTime("now"));
        $manager->persist($lancamento);
        $manager->flush();
    }
}
