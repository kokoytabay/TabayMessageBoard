<?php
App::uses('AppModel', 'Model');
App::uses('BlowfishPasswordHasher', 'Controller/Component/Auth');
/**
 * User Model
 *
 */
class User extends AppModel {

/**
 * Validation rules
 *
 * @var array
 */
	public $validate = array(
		'name' => array(
			'notBlank' => array(
				'rule' => 'notBlank',
				'message' => 'A name is required'
			),
			'between' => array(
				'rule' => array('lengthBetween', 5, 20),
				'message' => 'Name must be between 5 to 20 characters'
			)
		),
		'email' => array(
			'notBlank' => array(
				'rule' => 'notBlank',
				'message' => 'An email is required'
			),
			'email' => array(
				'rule' => 'email',
				'message' => 'Please enter a valid email'
			),
			'unique' => array(
				'rule' => 'isUnique',
				'message' => 'This email has already been taken'
			)
		),
		'password' => array(
			'notBlank' => array(
				'rule' => 'notBlank',
				'message' => 'A password is required'
			),
		),
		'confirm_password' => array(
			'notBlank' => array(
				'rule' => 'notBlank',
				'message' => 'Confirm password is required'
			),
			'compare' => array(
				'rule' => 'validatePasswords',
				'message' => 'The passwords do not match'
			)
		),
		'birthdate' => array(
			'rule' => array('date', 'ymd'),
			'message' => 'Please enter a valid date for birthdate in YYYY-MM-DD format',
			'allowEmpty' => true
		)
	);

/**
 * hasMany associations
 *
 * @var array
 */
	public $hasMany = array(
		'MessageRecipient' => array(
			'className' => 'Message',
			'foreignKey' => 'to_id',
			'dependent' => false,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		),
		'MessageSender' => array(
			'className' => 'Message',
			'foreignKey' => 'from_id',
			'dependent' => false,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		),
		'MessageContentUser' => array(
			'className' => 'MessageContent',
			'foreignKey' => 'from_id',
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

	public $genderOptions = array(
		'1' => 'Male', 
		'2' => 'Female'
	);

	public function validatePasswords() {
	    return $this->data[$this->alias]['password'] === $this->data[$this->alias]['confirm_password'];
	}

	public function beforeSave($options = array()) {
	    if (isset($this->data[$this->alias]['password'])) {
	        $passwordHasher = new BlowfishPasswordHasher();
	        $this->data[$this->alias]['password'] = $passwordHasher->hash($this->data[$this->alias]['password']);
	    }
	    return true;
	}
}
