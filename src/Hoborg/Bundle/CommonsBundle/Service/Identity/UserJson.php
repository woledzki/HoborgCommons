<?php
namespace Hoborg\Bundle\CommonsBundle\Service\Identity;

use Hoborg\Bundle\CommonsBundle\Mapper\Factory;
use Hoborg\Bundle\CommonsBundle\Service\Identity\User\Login;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

class UserJson extends User implements ContainerAwareInterface{

	/**
	 * Default constructor.
	 *
	 * @param Hoborg\Bundle\CommonsBundle\Mapper\Factory $mapperFactory
	 */
	public function __construct(Factory $mapperFactory) {
		$this->mapperFactory = $mapperFactory;
	}

	public function login($login, $password) {
		$response = new Response();
		$user = parent::login($login, $password);
		$response->setContent(json_encode($user));

		return $response;
	}

	/**
	 * Returns public data gor given user.
	 *
	 * @param string $login
	 */
	public function getUser($login) {
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