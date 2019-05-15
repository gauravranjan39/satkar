<?php
App::uses('Wallet', 'Model');

/**
 * Wallet Test Case
 */
class WalletTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.wallet',
		'app.customer',
		'app.reference',
		'app.order',
		'app.order_item',
		'app.category',
		'app.order_transaction'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->Wallet = ClassRegistry::init('Wallet');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Wallet);

		parent::tearDown();
	}

}
