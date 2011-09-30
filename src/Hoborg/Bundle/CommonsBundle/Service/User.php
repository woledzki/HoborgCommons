<?php
namespace Hoborg\Bundle\CommonsBundle\Service;

use Hoborg\Bundle\CommonsBundle\Mapper\Factory;
use Symfony\Component\HttpFoundation\Response;

class User {

	/**
	 * Default constructor.
	 *
	 * @param Hoborg\Bundle\CommonsBundle\Mapper\Factory $mapperFactory
	 */
	public function __construct(Factory $mapperFactory) {
		$this->mapperFactory = $mapperFactory;
	}

	/**
	 * Returns public data gor given user.
	 *
	 * @param string $login
	 */
	public function user($login) {
		$userMapper = $this->mapperFactory->getUserMapper();
		$user = $userMapper->getByLogin($login);

		$response = new Response();
		if (empty($user)) {
			$response->setContent(json_encode(array('error' => 'user not found')) . "\n");
		} else {
			$response->setContent(json_encode(array('user' => $user)) . "\n");
		}

		$response->setStatusCode(200);
		$response->headers->set('Content-Type', 'application/json');
		return $response;
	}
}