<?php
App::uses('OrderTransaction', 'Model');

/**
 * OrderTransaction Test Case
 */
class OrderTransactionTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.order_transaction',
		'app.order',
		'app.customer',
		'app.order_item',
		'app.category'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->OrderTransaction = ClassRegistry::init('OrderTransaction');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->OrderTransaction);

		parent::tearDown();
	}

}
