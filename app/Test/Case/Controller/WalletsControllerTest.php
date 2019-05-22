<?php
App::uses('WalletsController', 'Controller');

/**
 * WalletsController Test Case
 */
class WalletsControllerTest extends ControllerTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.wallet',
		'app.customer',
		'app.order',
		'app.order_item',
		'app.category',
		'app.order_transaction',
		'app.user'
	);

}
