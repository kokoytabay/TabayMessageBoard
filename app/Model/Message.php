<?php
App::uses('AppModel', 'Model');
/**
 * Message Model
 *
 * @property To $To
 * @property From $From
 * @property MessageContent $MessageContent
 */
class Message extends AppModel {

/**
 * Validation rules
 *
 * @var array
 */
	public $validate = array(
		'to_id' => array(
			'notBlank' => array(
				'rule' => 'notBlank',
				'message' => 'A recipient is required'
			)
		),
		'content' => array(
			'notBlank' => array(
				'rule' => 'notBlank',
				'message' => 'A message is required'
			)
		)
	);

/**
 * belongsTo associations
 *
 * @var array
 */
	public $belongsTo = array(
		'MessageTo' => array(
			'className' => 'User',
			'foreignKey' => 'to_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'MessageFrom' => array(
			'className' => 'User',
			'foreignKey' => 'from_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);

/**
 * hasMany associations
 *
 * @var array
 */
	public $hasMany = array(
		'MessageContent' => array(
			'className' => 'MessageContent',
			'foreignKey' => 'message_id',
			'dependent' => false,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		)
	);

}
