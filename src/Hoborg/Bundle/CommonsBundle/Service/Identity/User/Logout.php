<?php

class Commons_Lib_Rpc_Identity_Logout
extends Commons_Lib_Rpc_Identity_aCall {

    public function process($userToken) {
        return true;
    }
}
