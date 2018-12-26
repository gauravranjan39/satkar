<?php
App::uses('OrderItemsController', 'Controller');

/**
 * OrderItemsController Test Case
 */
class OrderItemsControllerTest extends ControllerTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.order_item',
		'app.order',
		'app.customer',
		'app.order_transaction',
		'app.category',
		'app.user'
	);

}
