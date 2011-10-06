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

	protected $baseUrl = 'http://cms.hoborglabs.tests/api/cmns/identity';

	/**
	 * @When /^I use REST API to logout$/
	 */
	public function iUseRestApiToLogout() {
	}

	/**
	 * @When /^I use REST API to login with "([^"]*)" and "([^"]*)"$/
	 */
	public function iUseRestApiToLogin($login, $password) {
		$postdata = 'login=' . urlencode($login) .
				'&password=' . urlencode($password);
		$ch = curl_init($this->baseUrl . '/login');
		curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $postdata);

		$r = curl_exec($ch);
		$ch_info = curl_getinfo($ch);

		if (curl_errno($ch)) throw new Behat\Behat\Exception\Exception();
		else curl_close($ch);

		$userArray = json_decode($r, true);
		$this->getMainContext()->getSubcontext('api_response')->response = $userArray;
	}


	/**
	 * @When /^I use REST API to request user "([^"]*)"$/
	 */
	public function iUseRestApiToRequestUser($userLogin) {
		$url = $this->baseUrl . '/user/' . $userLogin;

		// save this response
		$userArray = json_decode(file_get_contents($url), true);
		$this->getMainContext()->getSubcontext('api_response')->response = $userArray;
	}

}
