<?php
namespace Hoborg\Bundle\CommonsBundle\Mapper;

use Hoborg\Bundle\CommonsBundle\Mapper\Identity\User;

class Factory {

	const DB_IDENTITY_NAME = 'db.identity';

	/**
	 * @var Hoborg\Bundle\CommonsBundle\Mapper\User
	 */
	protected $userMapper = null;

	/**
	 * DB adapter
	 *
	 * @var \Symfony\Bundle\DoctrineBundle\ConnectionFactory
	 */
	protected $connectionFactory = null;

	/**
	 * Public constructor.
	 *
	 * @param \Symfony\Bundle\DoctrineBundle\ConnectionFactory $adapter
	 */
	public function __construct(\Symfony\Bundle\DoctrineBundle\ConnectionFactory $connectionFactory) {
		$this->connectionFactory = $connectionFactory;
	}

	/**
	 * Returns User mapper class.
	 *
	 * @return Hoborg\Bundle\CommonsBundle\Mapper\Identity\User
	 */
	public function getUserMapper() {
		if (null === $this->userMapper) {
			$connectionConf = static::getDbConnectionName(self::DB_IDENTITY_NAME);
			$adapter = $this->connectionFactory->createConnection($connectionConf);
			$this->userMapper = new User($adapter);
		}

		return $this->userMapper;
	}

	/**
	 * Returns DB configuration array for given module name.
	 *
	 * @param string $module
	 *
	 * @return array
	 */
	protected function getDbConnectionName($module) {
		return array(
			'dbname' => 'hoborg_dev_cmns',
			'user' => 'hoborg_dev',
			'password' => 'hoborg',
			'host' => 'localhost',
			'driver' => 'pdo_mysql',
		);
	}
}
