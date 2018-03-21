<?php

namespace Droids\Mechanoids;

use Phalcon\Mvc\Model;
use Phalcon\Mvc\Model\Message;
use Phalcon\Mvc\Model\Validator\Uniqueness;
use Phalcon\Mvc\Model\Validator\InclusionIn;

class Robots extends Model {

    public function validation() {

        $this->validate(
            new InclusionIn([
                'field' => 'type',
                'domain' => [
                    'droid',
                    'mechanical',
                    'virtual'
                ]
            ])
        );

        $this->validate(
            new Uniqueness([
                'field' => 'name',
                'message' => 'Robot name must be unique'
                ]
            )
        );

        if ($this->year < 0) {
            $this->appendMessage(
                new Message ('Year cannot be less than 0')
            );
        }

        if ($this->validationHasFailed === true) {
            return false;
        }
    }


}