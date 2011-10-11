<?php
namespace Hoborg\Bundle\CommonsBundle\Service;

use Hoborg\Bundle\CommonsBundle\Mapper\Factory;
use Hoborg\Bundle\CommonsBundle\Service\Identity\User\Login;
use Hoborg\Bundle\CommonsBundle\Service\Identity\User\Logout;
use Symfony\Component\HttpFoundation\Response;

class Identity {

	const CODE_INVALID_CREDENTIALS = 1501;
	const CODE_INVALID_TOKEN = 1502;

	/**
	 * Default constructor.
	 *
	 * @param Hoborg\Bundle\CommonsBundle\Mapper\Factory $mapperFactory
	 */
	public function __construct(Factory $mapperFactory) {
		$this->mapperFactory = $mapperFactory;
	}
}

