<?php

class Commons_Model_Mapper_Factory {

    const DB_IDENTITY_NAME = 'db.identity';

    const MAPPER_IDENTITY_USER = 'IdentityUser';
    const MAPPER_IDENTITY_USER_TOKEN = 'IdentityUserToken';

    static protected $mappers = array();

    /**
     * Returns initialized Identity User mapper.
     *
     * @return Commons_Model_Identity_Mapper_User
     */
    static public function getIdentityUserMapper() {
        if (!isset(self::$mappers[self::MAPPER_IDENTITY_USER])) {
            $connectionName = static::getDbConnectionName(self::DB_IDENTITY_NAME);
            $db = Hoborg_Database::getConnection($connectionName);
            self::$mappers[self::MAPPER_IDENTITY_USER] = Commons_Model_Identity_Mapper_User::getInstance($db);
        }

        return self::$mappers[self::MAPPER_IDENTITY_USER];
    }

    /**
     * Returns initialized Identity UserToken mapper.
     *
     * @return Commons_Model_Identity_Mapper_UserToken
     */
    static public function getIdentityUserTokenMapper() {
        if (!isset(self::$mappers[self::MAPPER_IDENTITY_USER_TOKEN])) {
            $connectionName = static::getDbConnectionName(self::DB_IDENTITY_NAME);
            $db = Hoborg_Database::getConnection($connectionName);
            self::$mappers[self::MAPPER_IDENTITY_USER_TOKEN] = Commons_Model_Identity_Mapper_UserToken::getInstance($db);
        }

        return self::$mappers[self::MAPPER_IDENTITY_USER_TOKEN];
    }

    static protected function getDbConnectionName($module) {
        $cfg = Hoborg_Config_Loader::getModuleConfig('Commons');
        $dbConfig = Hoborg_Config_Helper::getValueByKey($cfg, $module);

        return $dbConfig;
    }
}