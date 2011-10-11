<?php
namespace Hoborg\Bundle\CommonsBundle\Service\Identity;

use Hoborg\Bundle\CommonsBundle\Mapper\Factory;
use Symfony\Component\HttpFoundation\Response;

class User {

	const CODE_INVALID_CREDENTIALS = 1501;
	const CODE_INVALID_TOKEN = 1502;

	/**
	 * Default constructor.
	 *
	 * @param Hoborg\Bundle\CommonsBundle\Mapper\Factory $mapperFactory
	 */
	public function __construct(Factory $mapperFactory) {
		$this->mapperFactory = $mapperFactory;
	}

	/**
	 * Logs-in user with given login and password.
	 *
	 * @param string $login
	 * @param string $password
	 *
	 * @return Hoborg\Bundle\CommonsBundle\Model\Identity\User
	 */
	public function login($login, $password) {
		$userMapper = $this->mapperFactory->getUserMapper();
		$user = $userMapper->getUserByLoginAndPassword($login, $password);

		if (!empty($user)) {
			$userTokenMapper = $this->mapperFactory->getUserTokenMapper();
			// create new Token - one user can have multiple tokens/sessions
			$userToken = $userTokenMapper->createTokenForUserId($user->getId());
			$user->assignToken($userToken);
		}

		return $user;
	}

	/**
	 * Logs out user by token.
	 *
	 * @param string $token
	 */
	public function logout($token) {
		//$userTokenMapper = $this->mapperFactory->getUserTokenMapper();
		//$userTokenMapper->deleteUserTokens($token);

		return true;
	}

	/**
	 * Returns public data gor given user.
	 *
	 * @param string $login
	 */
	public function getUserByLogin($login) {
		$userMapper = $this->mapperFactory->getUserMapper();
		$user = $userMapper->getByLogin($login);

		return $user;
	}

	/**
	 * Returns User by given token.
	 * Enter description here ...
	 * @param unknown_type $token
	 */
	public function getUser($token) {
		$userMapper = $this->mapperFactory->getUserMapper();
		$user = $userMapper->getByToken($token);

		return $user;
	}

	public function addUser($token, array $userData) {
	}

	public function updateUser($token, array $userData) {
	}
}

