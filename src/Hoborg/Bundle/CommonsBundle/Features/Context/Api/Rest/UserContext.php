<?php
namespace Hoborg\Bundle\CommonsBundle\Features\Context\Api\Rest;

use Behat\BehatBundle\Context\BehatContext,
Behat\BehatBundle\Context\MinkContext;
use Behat\Behat\Context\ClosuredContextInterface,
Behat\Behat\Context\TranslatedContextInterface,
Behat\Behat\Exception\PendingException;
use Behat\Gherkin\Node\PyStringNode,
Behat\Gherkin\Node\TableNode;

class UserContext extends BehatContext {

	/**
	 * @When /^I use REST API to logout$/
	 */
	public function iUseRestApiToLogout() {
	}

	/**
	 * @When /^I use REST API to login with "([^"]*)" and "([^"]*)"$/
	 */
	public function iUseRestApiToLoginWithAnd($login, $password) {
	}


	/**
	 * @When /^I use REST API to request user "([^"]*)"$/
	 */
	public function iUseRestApiToRequestUser($userLogin) {
		$this->response = array('login' => $userLogin);
	}


}
