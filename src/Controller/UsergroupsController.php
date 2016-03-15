<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Usergroups Controller
 *
 * @property App\Model\Table\UsergroupsTable $Usergroups
 */
class UsergroupsController extends AppController
{

    public function isAuthorized($user = null)
    {
        //return true;
        // TODO
        //since we did not define who to invite people into a user group this whole
        //thing should not work
        return false;
    }

    /**
 * Index method
 *
 * @return void
 */
    public function index()
    {
        $this->set(
            'usergroups',
            $this->paginate(
                $this->Usergroups->find(
                    'ownedBy',
                    [
                        'User.id' => $this->Auth->user('id')
                    ]
                )
            )
        );
    }

    /**
 * Add method
 *
 * @return void
 */
    public function add()
    {
        $this->request->data['admin_user_id'] = $this->Auth->user('id');
        $usergroup = $this->Usergroups->newEntity($this->request->data);
        if ($this->request->is('post')) {
            if ($this->Usergroups->save($usergroup)) {
                $this->Flash->success('The usergroup has been saved.');
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error('The usergroup could not be saved. Please, try again.');
            }
        }
        $users = $this->Usergroups->Users->find('list');
        $this->set(compact('usergroup', 'users'));
    }

    /**
 * Edit method
 *
 * @param  string $id
 * @return void
 * @throws \Cake\Network\Exception\NotFoundException
 */
    public function edit($id = null)
    {
        $usergroup = $this->Usergroups->get(
            $id,
            [
            'contain' => ['Users']
            ]
        );
        if ($this->request->is(['patch', 'post', 'put'])) {
            $usergroup = $this->Usergroups->patchEntity($usergroup, $this->request->data);
            if ($this->Usergroups->save($usergroup)) {
                $this->Flash->success('The usergroup has been saved.');
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error('The usergroup could not be saved. Please, try again.');
            }
        }
        $users = $this->Usergroups->Users->find('list');
        $this->set(compact('usergroup', 'users'));
    }

    /**
 * Delete method
 *
 * @param  string $id
 * @return void
 * @throws \Cake\Network\Exception\NotFoundException
 */
    public function delete($id = null)
    {
        $usergroup = $this->Usergroups->get($id);
        $this->request->allowMethod(['post', 'delete']);
        if ($this->Usergroups->delete($usergroup)) {
            $this->Flash->success('The usergroup has been deleted.');
        } else {
            $this->Flash->error('The usergroup could not be deleted. Please, try again.');
        }
        return $this->redirect(['action' => 'index']);
    }
}
