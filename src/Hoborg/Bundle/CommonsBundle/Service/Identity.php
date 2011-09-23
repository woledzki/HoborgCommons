<?php
namespace Hoborg\Bundle\Commons\Service;

class Identity {

    const CODE_INVALID_CREDENTIALS = 1501;
    const CODE_INVALID_TOKEN = 1502;

    public function login($login, $password) {
    }

    public function logout($token) {
    }

    public function addUser($token, array $userData) {
    }

    public function getUser($token) {
    }

    public function updateUser($token, array $userData) {
    }
}