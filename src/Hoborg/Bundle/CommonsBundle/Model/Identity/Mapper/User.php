<?php

class Commons_Model_Identity_Mapper_User
extends Commons_Model_aMapper {

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

        $results = $this->dbAdapter->fetchAll($sql, array(), Zend_Db::FETCH_NUM);

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

        $results = $this->dbAdapter->fetchAll($sql, array(), Zend_Db::FETCH_NUM);

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

        $results = $this->dbAdapter->fetchAll($sql, array(), Zend_Db::FETCH_NUM);

        if (1 === count($results)) {
            $user = new Commons_Model_Identity_User();
            $user->fromArray($results[0]);
        }

        return $user;
    }
}