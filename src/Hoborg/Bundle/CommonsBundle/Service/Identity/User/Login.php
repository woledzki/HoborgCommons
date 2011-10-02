<?php
namespace Hoborg\Bundle\CommonsBundle\Service\Identity\User;

use Hoborg\Bundle\CommonsBundle\Service\Call;

class Login extends Call {

	protected $login = null;
	protected $password = null;

	public function __construct($login, $password, $userMapper) {
		$this->login = $login;
		$this->password = $password;
		$this->userMapper = $userMapper;
	}

	public function process() {
//		$userTokenMapper = Commons_Model_Mapper_Factory::getIdentityUserTokenMapper();

		$user = $this->userMapper->getUserByLoginAndPassword($this->login, $this->password);
		return $user;

		// create new Token - one user can have multiple tokens/sessions
//		$userToken = $userTokenMapper->createTokenForUserId($user->getId());

//		return Hoborg_Rpc_Response::getArray($userToken, Hoborg_Rpc_Response::CODE_SUCCESS);
	}
}
