<?php
namespace Hoborg\Bundle\CommonsBundle\Features\Context\Phabric;

use Behat\BehatBundle\Context\BehatContext,
Behat\BehatBundle\Context\MinkContext;
use Behat\Behat\Context\ClosuredContextInterface,
Behat\Behat\Context\TranslatedContextInterface,
Behat\Behat\Exception\PendingException,
Behat\Behat\Exception\Exception;
use Behat\Gherkin\Node\PyStringNode,
Behat\Gherkin\Node\TableNode;

class Creator extends BehatContext {

	protected $phabric = null;

	public function __construct($parameters) {
		parent::__construct($parameters);

		$phabricConfig = $this->getContainer()->getParameter('Phabric');
		$dbConfog = $this->getContainer()->getParameter('database');
		$db = \Doctrine\DBAL\DriverManager::getConnection(array(
			'dbname' => $dbConfog['dbname'],
			'user' => $dbConfog['username'],
			'password' => $dbConfog['password'],
			'host' => $dbConfog['host'],
			'driver' => $dbConfog['driver'],
		));

		$datasource = new \Phabric\Datasource\Doctrine($db, $phabricConfig['entities']);
		$this->phabric = new \Phabric\Phabric($datasource);


		$this->phabric->addDataTransformation(
			'MD5', function($string) {
				return md5($string);
			}
		);

		$user = $this->phabric->createEntity('user', $phabricConfig['entities']['User']);
	}

	/**
	 * @Given /^a identity user exist:$/
	 */
	public function aIdentityUserExist(TableNode $table) {
		$user = $this->phabric->getEntity('user');
		$user->insertFromTable($table);
	}

}
