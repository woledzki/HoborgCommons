<?php

namespace Hoborg\Bundle\CommonsBundle\Features\Context;

use Hoborg\Bundle\CommonsBundle\Features\Context\Api\ResponseContext;
use Behat\BehatBundle\Context\BehatContext,
	Behat\BehatBundle\Context\MinkContext;
use Behat\Behat\Context\ClosuredContextInterface,
	Behat\Behat\Context\TranslatedContextInterface,
	Behat\Behat\Exception\PendingException;
use Behat\Gherkin\Node\PyStringNode,
	Behat\Gherkin\Node\TableNode;

//
// Require 3rd-party libraries here:
//
//   require_once 'PHPUnit/Autoload.php';
//   require_once 'PHPUnit/Framework/Assert/Functions.php';
//

/**
 * Feature context.
 */
class FeatureContext extends BehatContext {

	public function __construct($parameters) {
		parent::__construct($parameters);
		$this->useContext('api_user', new Api\Direct\UserContext($parameters));
		$this->useContext('api-rest_user', new Api\Rest\UserContext($parameters));
		$this->useContext('api_response', new Api\ResponseContext($parameters));
		$this->useContext('phabric_creator', new Phabric\Creator($parameters));
	}

}
