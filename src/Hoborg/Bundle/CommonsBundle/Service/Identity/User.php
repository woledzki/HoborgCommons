<?php
namespace Hoborg\Bundle\CommonsBundle\Service\Identity;

use Hoborg\Bundle\CommonsBundle\Mapper\Factory;
use Hoborg\Bundle\CommonsBundle\Service\Identity\User\Login;
use Symfony\Component\HttpFoundation\Response;

class User {

	/**
	 * Default constructor.
	 *
	 * @param Hoborg\Bundle\CommonsBundle\Mapper\Factory $mapperFactory
	 */
	public function __construct(Factory $mapperFactory) {
		$this->mapperFactory = $mapperFactory;
	}

	public function login($login, $password) {
		$login = new Login($login, $password, $this->mapperFactory->getUserMapper());
		$user = $login->process();
		return $user;
	}

	/**
	 * Returns public data gor given user.
	 *
	 * @param string $login
	 */
	public function getUser($login) {
		$userMapper = $this->mapperFactory->getUserMapper();
		$user = $userMapper->getByLogin($login);
		return $user;
	}
}