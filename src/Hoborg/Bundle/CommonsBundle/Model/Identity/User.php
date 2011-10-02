<?php
namespace Hoborg\Bundle\CommonsBundle\Model\Identity;

class User {

	public static function fromArray(array & $data) {
		$user = new self();
		$user->login = $data['login'];
		$user->firstName = $data['name_first'];
		$user->lastName = $data['name_last'];
		$user->fullName = $data['name_first'] . ' ' . $data['name_last'];

		return $user;
	}

	public function toArray() {
		return array(
			'login' => $this->login,
			'firstName' => $this->firstName,
			'lastName' => $this->lastName,
			'fullName' => $this->fullName,
		);
	}
}