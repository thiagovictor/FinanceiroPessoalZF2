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
    }
    
    public function ajustarDate($date) {
        $s = explode('/', $date);
        return $s[2]."-".$s[1]."-".$s[0];
    }
    public function inserir(array $data) {
        $auth = new AuthenticationService;
        $auth->setStorage(new Session("Financeiro"));
        $data["vencimento"] = new \DateTime($this->ajustarDate($data["vencimento"]));
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
        $entity = new $this->entity($data);
        $this->entityManager->persist($entity);
        $this->entityManager->flush();
        return $entity;
    }

    public function update(array $data) {
        $reference = $this->entityManager->getReference($this->entity, $data['id']);
        
        $data["vencimento"] = new \DateTime($this->ajustarDate($data["vencimento"]));
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
        
        return $array;
        
    }
}
