<?php
namespace Hoborg\Bundle\Commons\Service\Identity;

abstract class Call {

    protected $mappers = array();

    protected function getUserMapper() {
        if (!isset($this->mappers['User'])) {
            $this->mappers['User'] = new Commons_Model_Identity_Mapper_User();
        }

        return $this->mappers['User'];
    }
}