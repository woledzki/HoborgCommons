<?php

class Commons_Lib_Rpc_Identity_GetUser
extends Commons_Lib_Rpc_Identity_aCall {

    public function process($identityToken) {
        $mapper = Commons_Model_Mapper_Factory::getIdentityUserMapper();
        $user = $mapper->getUserByToken($identityToken);

        if (null === $user) {
            return new Hoborg_Rpc_Response($user, Commons_Lib_Rpc_Identity::CODE_INVALID_TOKEN, 'Invalid Token');
        }

        return new Hoborg_Rpc_Response($user->toArray(), Hoborg_Rpc_Response::CODE_SUCCESS);
    }
}