<?php

namespace Financeiro\Validator;

use Zend\Validator\AbstractValidator;

class MesCompetencia extends AbstractValidator {

    const INVALID_FORMAT = 'invalidFormat';

    protected $messageTemplates = array(
        self::INVALID_FORMAT => 'Formato do mês inválido mm/aaaa'
    );

    private function validateDate($date, $format = 'm/Y') {
        $d = \DateTime::createFromFormat($format, $date);
        return $d && $d->format($format) == $date;
    }

    public function isValid($value) {

        if ($this->validateDate($value)) {
            return true;
        }
        $this->error(self::INVALID_FORMAT);
        return false;
    }

}
