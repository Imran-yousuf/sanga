<?php
/**
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @since         0.2.9
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */
namespace App\Controller;

use Cake\Controller\Controller;
use Cake\Event\Event;

/**
 * Application Controller
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @link http://book.cakephp.org/3.0/en/controllers.html#the-app-controller
 */
class AppController extends Controller {

/**
 * Components this controller uses.
 *
 * Component names should not include the `Component` suffix. Components
 * declared in subclasses will be merged with components declared here.
 *
 * @var array
 */
	public $components = [
        'Flash',
        'RequestHandler',
        'Auth' => [
            'authenticate' => [
                'Form' => [
                    'fields' => [
                        'username' => 'name'
                        ]
                    ]
                ],
            'loginRedirect' => [
                'controller' => 'users',
                'action' => 'view'
            ],
            'logoutRedirect' => [
                'controller' => 'Pages',
                'action' => 'display',
                'home'
            ]
        ]
    ];
    
    public $helpers = [
        'Form' => [
            'widgets' => [
                'autocomplete' => [
                    'App\View\Widget\Autocomplete',
                    'text',
                    'label'
                ]
            ],
            'templates' => 'app_form.php'
        ]
    ];

    public function beforeFilter(Event $event) {
        $this->Auth->deny();
        $this->loadModel('Notifications');
        $nc = $this->Notifications->find('unread', ['user_id' => $this->Auth->user('id')])->count();
    	$this->set('notification_count', $nc);
    }    
}