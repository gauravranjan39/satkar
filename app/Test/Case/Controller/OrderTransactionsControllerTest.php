<?php
App::uses('OrderTransactionsController', 'Controller');

/**
 * OrderTransactionsController Test Case
 */
class OrderTransactionsControllerTest extends ControllerTestCase {

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
		'app.category',
		'app.user'
	);

}
