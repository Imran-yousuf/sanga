<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Users Model
 */
class UsersTable extends Table {

/**
 * Initialize method
 *
 * @param array $config The configuration for the Table.
 * @return void
 */
	public function initialize(array $config) {
		$this->table('users');
		$this->displayField('name');
		$this->primaryKey('id');
		$this->addBehavior('Timestamp');

		$this->hasMany('Events', [
			'foreignKey' => 'user_id',
		]);
		$this->hasMany('Histories', [
			'foreignKey' => 'user_id',
		]);
		$this->hasMany('Notifications', [
			'foreignKey' => 'user_id',
		]);
		$this->belongsToMany('Contacts', [
			'foreignKey' => 'user_id',
			'targetForeignKey' => 'contact_id',
			'joinTable' => 'contacts_users',
		]);
		$this->belongsToMany('Groups', [
			'through' => 'groups_users'
		]);
		$this->belongsToMany('Usergroups', [
			'foreignKey' => 'user_id',
			'targetForeignKey' => 'usergroup_id',
			'joinTable' => 'users_usergroups',
		]);
	}

/**
 * Default validation rules.
 *
 * @param \Cake\Validation\Validator $validator
 * @return \Cake\Validation\Validator
 */
	public function validationDefault(Validator $validator) {
		$validator
			->add('id', 'valid', ['rule' => 'numeric'])
			->allowEmpty('id', 'create')
			->allowEmpty('name')
			->allowEmpty('password')
			->allowEmpty('realname')
			->add('email', 'valid', ['rule' => 'email'])
			->allowEmpty('email')
			->add('email', 'unique', ['rule' => 'validateUnique', 'provider' => 'table'])
			->allowEmpty('phone')
			->add('active', 'valid', ['rule' => 'boolean'])
			->allowEmpty('active')
			->add('role', 'valid', ['rule' => 'numeric'])
			->validatePresence('role', 'create')
			->notEmpty('role');

		return $validator;
	}

}