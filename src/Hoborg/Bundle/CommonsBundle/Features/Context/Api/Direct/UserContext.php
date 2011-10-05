<?php
namespace Hoborg\Bundle\CommonsBundle\Features\Context\Api\Direct;

use Behat\BehatBundle\Context\BehatContext,
Behat\BehatBundle\Context\MinkContext;
use Behat\Behat\Context\ClosuredContextInterface,
Behat\Behat\Context\TranslatedContextInterface,
Behat\Behat\Exception\PendingException;
use Behat\Gherkin\Node\PyStringNode,
Behat\Gherkin\Node\TableNode;

class UserContext extends BehatContext {

	protected $lastUser = null;

	/**
	 * @Given /^I am not logged in$/
	 */
	public function iAmNotLoggedIn() {
		// nothing to do
	}

	/**
	 * @When /^I use Internal API to login with "([^"]+)" and "([^"]+)"$/
	 */
	public function iUseInternalApiToLoginWithAnd($login, $password) {
		$container = $this->getContainer();

		// save this response
		$user = $container->get('hoborg.identity')->login($login, $password);
		$userArray = array();
		if (!empty($user)) {
			$userArray = $user->toArray();
		}

		$this->getMainContext()->getSubcontext('api_response')->response = $userArray;
	}


	/**
	 * @When /^I use Internal API to logout(?: "([^"]+)?")?$/
	 */
	public function iUseInternalApiToLogout($userLogin = null) {
		$container = $this->getContainer();

		// save this response
		//		$user = $container->get('hoborg.identity')->logout($userLogin);
	}


	/**
	 * @When /^I use Internal API to request user "([^"]*)"$/
	 */
	public function iUseInternalApiToRequestUser($userLogin) {
		$container = $this->getContainer();
		$user = $container->get('hoborg.identity')->getUserByLogin($userLogin);

		// save this response
		$userArray = array();
		if (!empty($user)) {
			$userArray = $user->toArray();
		}
		$this->getMainContext()->getSubcontext('api_response')->response = $userArray;
	}
}
