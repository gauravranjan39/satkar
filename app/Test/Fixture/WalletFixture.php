<?php
/**
 * Wallet Fixture
 */
class WalletFixture extends CakeTestFixture {

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false, 'key' => 'primary'),
		'customer_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false),
		'order_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false),
		'order_item_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false),
		'credit' => array('type' => 'decimal', 'null' => false, 'default' => null, 'length' => '7,2', 'unsigned' => false),
		'debit' => array('type' => 'decimal', 'null' => false, 'default' => null, 'length' => '7,2', 'unsigned' => false),
		'balance' => array('type' => 'decimal', 'null' => false, 'default' => null, 'length' => '7,2', 'unsigned' => false),
		'refund' => array('type' => 'boolean', 'null' => false, 'default' => '0', 'comment' => '0=not refunded,1=refunded'),
		'status' => array('type' => 'boolean', 'null' => false, 'default' => null),
		'created' => array('type' => 'timestamp', 'null' => false, 'default' => null),
		'indexes' => array(
			'PRIMARY' => array('column' => 'id', 'unique' => 1)
		),
		'tableParameters' => array('charset' => 'latin1', 'collate' => 'latin1_swedish_ci', 'engine' => 'InnoDB')
	);

/**
 * Records
 *
 * @var array
 */
	public $records = array(
		array(
			'id' => 1,
			'customer_id' => 1,
			'order_id' => 1,
			'order_item_id' => 1,
			'credit' => '',
			'debit' => '',
			'balance' => '',
			'refund' => 1,
			'status' => 1,
			'created' => 1557481492
		),
	);

}
