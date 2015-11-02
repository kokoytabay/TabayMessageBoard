<?php
App::uses('AppModel', 'Model');
/**
 * MessageContent Model
 *
 * @property Message $Message
 * @property From $From
 */
class MessageContent extends AppModel {

/**
 * Validation rules
 *
 * @var array
 */
	public $validate = array();

/**
 * belongsTo associations
 *
 * @var array
 */
	public $belongsTo = array(
		'Message' => array(
			'className' => 'Message',
			'foreignKey' => 'message_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'MessageContentFrom' => array(
			'className' => 'User',
			'foreignKey' => 'from_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
}
