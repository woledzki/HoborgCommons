<?php
namespace Hoborg\Bundle\Commons\Service\Identity;

class Login extends Call {

	public function process($login, $password) {
		$userMapper = Commons_Model_Mapper_Factory::getIdentityUserMapper();
		$userTokenMapper = Commons_Model_Mapper_Factory::getIdentityUserTokenMapper();

		$user = $userMapper->getUserByLoginAndPassword($login, $password);
		if (null === $user) {
			return new Hoborg_Rpc_Response($user, Commons_Lib_Rpc_Identity::CODE_INVALID_CREDENTIALS, 'Invalid Credentials');
		}

		// create new Token - one user can have multiple tokens/sessions
		$userToken = $userTokenMapper->createTokenForUserId($user->getId());

		return Hoborg_Rpc_Response::getArray($userToken, Hoborg_Rpc_Response::CODE_SUCCESS);
	}
}
