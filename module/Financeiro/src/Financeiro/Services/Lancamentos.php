<?php

namespace Financeiro\Services;

use Doctrine\ORM\EntityManager;
use Zend\Authentication\AuthenticationService,
    Zend\Authentication\Storage\Session;
use Zend\Stdlib\Hydrator\ClassMethods;

class Lancamentos extends AbstractService {

    public function __construct(EntityManager $entityManager) {
        parent::__construct($entityManager);
        $this->entity = 'Financeiro\Entity\Lancamentos';
        $this->nameId = 'id';
        $this->validarDonoEntidade = true;
    }

    public function ajustarDate($date) {
        $s = explode('/', $date);
        return $s[2] . "-" . $s[1] . "-" . $s[0];
    }

    public function ajustarMes($date) {
        if ($date instanceof \DateTime) {
            return $date->format("Y-m") . "-01";
        }
        $s = explode('/', $date);
        return $s[1] . "-" . $s[0] . "-01";
    }

    public function moveFile(array $data, $id, $type = false) {
        if (!isset($data["tmp_name"])) {
            return NULL;
        }
        if (!empty($data["tmp_name"])) {
            if (!is_dir("data/files")) {
                mkdir("data/files");
            }
            if (!is_dir("data/files/{$id}")) {
                mkdir("data/files/{$id}");
            }
            $nome = time() . "_" . $data["name"];
            if ($type) {
                $nome = "c_" . $nome;
            }
            if (copy($data["tmp_name"], "data/files/{$id}/" . $nome)) {
                return $nome;
            }
            return NULL;
        }
        return NULL;
    }

    public function getSession() {
        return new \Zend\Authentication\Storage\Session("Financeiro");
    }

    public function getAuthentication() {
        $auth = new \Zend\Authentication\AuthenticationService();
        return $auth->setStorage($this->getSession());
    }

    public function inserir(array $data) {
        $auth = new AuthenticationService;
        $auth->setStorage(new Session("Financeiro"));
        $data["vencimento"] = new \DateTime($this->ajustarDate($data["vencimento"]));
        $data["arquivo_boleto"] = $this->moveFile($data["arquivo_boleto"], $this->getAuthentication()->getIdentity()->getId());
        $data["arquivo_comprovante"] = $this->moveFile($data["arquivo_comprovante"], $this->getAuthentication()->getIdentity()->getId(), TRUE);
        $data['centrocusto'] = $this->entityManager->getReference('Financeiro\Entity\Centrocusto', $data['centrocusto']);
        $data['cartegoria'] = $this->entityManager->getReference('Financeiro\Entity\Cartegoria', $data['cartegoria']);
        $data['periodo'] = $this->entityManager->getReference('Financeiro\Entity\Periodo', $data['periodo']);
        $data['conta'] = $this->entityManager->getReference('Financeiro\Entity\Conta', $data['conta']);
        $data['favorecido'] = $this->entityManager->getReference('Financeiro\Entity\Favorecido', $data['favorecido']);
        if ($data["cartao"] != 0) {
            $data['cartao'] = $this->entityManager->getReference('Financeiro\Entity\Cartao', $data['cartao']);
        } else {
            unset($data["cartao"]);
        }
        $data['tipo'] = $this->entityManager->getReference('Financeiro\Entity\Tipo', $data['tipo']);
        $data['user'] = $this->entityManager->getReference('Financeiro\Entity\User', $auth->getIdentity()->getId());
        $data["valor"] = str_replace(',', '.', str_replace('.', '', $data['valor']));
        if ("on" == $data["tipo_registro"]) {
            $data["valor"] = "-" . $data["valor"];
        }
        if ("" == $data["parcelas"]) {
            unset($data["parcelas"]);
        }
        if (isset($data["status"])) {
            if ($data["status"]) {
                $data["pagamento"] = new \DateTime("now");
            }
        }
        $data["competencia"] = new \DateTime($this->ajustarMes($data["competencia"]));
        $entity = new $this->entity($data);
        $this->entityManager->persist($entity);
        $this->entityManager->flush();
        return $entity;
    }

    public function update(array $data) {
        unset($data["user_id"]);
        $reference = $this->entityManager->getReference($this->entity, $data['id']);
        $data["vencimento"] = new \DateTime($this->ajustarDate($data["vencimento"]));
        $arquivoBoleto = $this->moveFile($data["arquivo_boleto"], $this->getAuthentication()->getIdentity()->getId());
        if ($arquivoBoleto) {
            if ($reference->getArquivoBoleto()) {
                unlink("data/files/" . $this->getAuthentication()->getIdentity()->getId() . "/" . $reference->getArquivoBoleto());
            }
            $data["arquivo_boleto"] = $arquivoBoleto;
        } else {
            unset($data["arquivo_boleto"]);
        }
        $arquivoComprovante = $this->moveFile($data["arquivo_comprovante"], $this->getAuthentication()->getIdentity()->getId(), TRUE);
        if ($arquivoComprovante) {
            if ($reference->getArquivoComprovante()) {
                unlink("data/files/" . $this->getAuthentication()->getIdentity()->getId() . "/" . $reference->getArquivoComprovante());
            }
            $data["arquivo_comprovante"] = $arquivoComprovante;
        } else {
            unset($data["arquivo_comprovante"]);
        }
        $data['centrocusto'] = $this->entityManager->getReference('Financeiro\Entity\Centrocusto', $data['centrocusto']);
        $data['cartegoria'] = $this->entityManager->getReference('Financeiro\Entity\Cartegoria', $data['cartegoria']);
        $data['periodo'] = $this->entityManager->getReference('Financeiro\Entity\Periodo', $data['periodo']);
        $data['conta'] = $this->entityManager->getReference('Financeiro\Entity\Conta', $data['conta']);
        $data['favorecido'] = $this->entityManager->getReference('Financeiro\Entity\Favorecido', $data['favorecido']);
        if ($data["cartao"] != 0) {
            $data['cartao'] = $this->entityManager->getReference('Financeiro\Entity\Cartao', $data['cartao']);
        } else {
            unset($data["cartao"]);
        }
        $data['tipo'] = $this->entityManager->getReference('Financeiro\Entity\Tipo', $data['tipo']);

        $data["valor"] = str_replace(',', '.', str_replace('.', '', $data['valor']));
        if ("on" == $data["tipo_registro"]) {
            if ($data["valor"] > 0) {
                $data["valor"] = "-" . $data["valor"];
            }
        } else {
            if ($data["valor"] < 0) {
                $data["valor"] = substr($data["valor"], 1);
            }
        }
        if ("" == $data["parcelas"]) {
            unset($data["parcelas"]);
        }
        if (isset($data["status"])) {
            if ("1" === $data["status"]) {
                $data["pagamento"] = new \DateTime("now");
            }
        }
        $data["competencia"] = new \DateTime($this->ajustarMes($data["competencia"]));
        $entity = (new ClassMethods())->hydrate($data, $reference);
        $this->entityManager->persist($entity);
        $this->entityManager->flush();
        return $entity;
    }

    public function ajustar($array) {
        $array["valor"] = number_format($array["valor"], 2, ',', '.');

        $array["tipo_registro"] = "off";
        if ($array["valor"] < 0) {
            $array["tipo_registro"] = "on";
            $array["valor"] = substr($array["valor"], 1);
        }
        $array["vencimento"] = $array["vencimento"]->format('d/m/Y');
        $array["competencia"] = $array["competencia"]->format('m/Y');


        return $array;
    }

    public function apagaFiles($arquivo) {
        unlink("data/files/" . $this->getAuthentication()->getIdentity()->getId() . "/" . $arquivo);
    }

    public function removeAnexos($entity) {
        if (NULL != $entity->getArquivoBoleto() and $entity->getArquivoBoleto() != '') {
            $this->apagaFiles($entity->getArquivoBoleto());
        }
        if (NULL != $entity->getArquivoComprovante() and $entity->getArquivoComprovante() != '') {
            $this->apagaFiles($entity->getArquivoComprovante());
        }
    }

    public function delete($id) {
        $entity = $this->validarDono($id);
        if ($entity) {
            $this->removeAnexos($entity);
            $this->entityManager->remove($entity);
            $this->entityManager->flush();
            return $id;
        }
    }

}
