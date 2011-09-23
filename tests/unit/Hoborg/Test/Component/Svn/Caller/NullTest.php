<?php
namespace Hoborg\Test\Component\Svn\Caller;

use Hoborg\Component\Svn\Caller\Null;

class NullTest extends \PHPUnit_Framework_TestCase {

	public function testConstructor() {
		$caller = new Null();
		$this->assertTrue(true);
	}
}
