<?php
namespace Hoborg\Bundle\CommonsBundle\Mapper\Identity;

use Hoborg\Bundle\CommonsBundle\Mapper\Mapper;

class User extends Mapper {

	public function getByLogin($login) {
		$sql = 'SELECT * FROM user WHERE user.login = ' . $this->adapter->quote($login);

		$result = $this->adapter->fetchAll($sql);
		if (empty($result)) {
			return array();
		}

		return $result[0];
	}

	/**
	 *
	 * @param string $userToken, $login
	 *
	 * @return Commons_Model_Identity_User
	 */
	public function getUserByToken($userToken) {
		$user = null;

		$sql = 'SELECT * FROM user ' .
                'LEFT JOIN user_token on user.`id` = user_token.`user_id` ' .
                'WHERE user_token.`id` = \''. $userToken . '\'';

		$results = $this->adapter->fetchAll($sql);

		if (1 === count($results)) {
			$user = new Commons_Model_Identity_User();
			$user->fromArray($results[0]);
		}

		return $user;
	}

	/**
	 *
	 * @param int $id
	 *
	 * @return Commons_Model_Identity_User
	 */
	public function getUserById($id) {
		$user = null;

		$sql = 'SELECT * FROM user ' .
                'LEFT JOIN user_token on user.`id` = user_token.`user_id` ' .
                'WHERE user.`id` = '. $id;

		$results = $this->adapter->fetchAll($sql);

		if (1 === count($results)) {
			$user = new Commons_Model_Identity_User();
			$user->fromArray($results[0]);
		}

		return $user;
	}

	/**
	 * Returns User model.
	 *
	 * @param string $login
	 * @param string $password
	 *
	 * @return Commons_Model_Identity_User
	 */
	public function getUserByLoginAndPassword($login, $password) {
		$user = null;

		$sql = 'SELECT * FROM user ' .
                'WHERE `login` = \'' . $login . '\' ' .
                'AND `password` = \'' . md5($password) . '\'';

		$results = $this->adapter->fetchAll($sql);

		if (1 === count($results)) {
			$user = new Commons_Model_Identity_User();
			$user->fromArray($results[0]);
		}

		return $user;
	}
}