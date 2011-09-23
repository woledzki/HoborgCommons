<?php

class Commons_Model_Identity_Mapper_UserToken
extends Commons_Model_aMapper {

    /**
     *
     * @param string $login
     * @param string $password
     *
     * @return string
     */
    public function createTokenForUserId($userId) {
        $token = '';
        $now = time();

        // generate random token
        $chars = 'ABCDEFGHIJKLMNOPQRSTUXYVWZabcdefghijklmnopqrstuxyvwz0123456789/=!@#$%^*()_-[]{}';
        $tokenSize = 32;

        list($usec, $sec) = explode(' ', microtime());
        $seed = (float) $sec + ((float) $usec * 100000);
        srand($seed);

        for ($i = 0; $i < $tokenSize; $i++) {
            $token .= $chars[rand(0, strlen($chars) - 1)];
        }

        $data = array(
            'id' => $token,
            'user_id' => $userId,
            'valid_until' => $now,
        );

        $results = $this->dbAdapter->insert('user_token', $data);

        return $token;
    }
}