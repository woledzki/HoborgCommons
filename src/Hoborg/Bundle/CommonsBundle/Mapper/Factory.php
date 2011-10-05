<?php
namespace Hoborg\Bundle\CommonsBundle\Mapper;

use Hoborg\Bundle\CommonsBundle\Mapper\Identity\User;

class Factory {

	const DB_IDENTITY_NAME = 'hoborg_cmns_identity';

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
	public function __construct($doctrine) {
		$this->connectionFactory = $doctrine;
	}

	/**
	 * Returns User mapper class.
	 *
	 * @return Hoborg\Bundle\CommonsBundle\Mapper\Identity\User
	 */
	public function getUserMapper() {
		if (null === $this->userMapper) {
			$adapter = $this->connectionFactory->getConnection(self::DB_IDENTITY_NAME);
			$this->userMapper = new User($adapter);
		}

		return $this->userMapper;
	}

}
