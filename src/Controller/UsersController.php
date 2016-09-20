<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Event\Event;

/**
 * Users Controller
 *
 * @property \App\Model\Table\UsersTable $Users
 */
class UsersController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
        $users = $this->paginate($this->Users);

        $this->set(compact('users'));
        $this->set('_serialize', ['users']);
    }

    /**
     * View method
     *
     * @param string|null $id User id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $user_id = $this->request->session()->read('Auth.User.id');
        $user = $this->Users->get($id, [
            'contain' => ['Posts']
        ]);

        $this->set('user', $user);
        $this->set('_serialize', ['user']);
        
        //Load books and reviews related to the user
        
        $this->loadModel('Books');
        $books = $this->Books->find('all', ['contain' => ['Users', 'Reviews'],
            'conditions' => array(
                "Books.user_id = $user->id")]);
        $this->set('books', $books);
        $this->set('_serialize', ['books']);
        
        if($user->id == $user_id)
            $this->set('title', 'Your Profile');
        else
            $this->set('title', "$user->name's Profile");
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $user = $this->Users->newEntity();
        if ($this->request->is('post')) {
            $user = $this->Users->patchEntity($user, $this->request->data);
            if ($this->Users->save($user)) {
                $this->Flash->success(__('The user has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The user could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('user'));
        $this->set('_serialize', ['user']);
    }

    /**
     * Edit method
     *
     * @param string|null $id User id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $user = $this->Users->get($id, [
            'contain' => []
        ]);
        $photo = $user->photo;
        if($id == $this->request->session()->read('Auth.User.id'))
        {
            if ($this->request->is(['patch', 'post', 'put'])) {
            $user = $this->Users->patchEntity($user, $this->request->data);
            if($this->request->data['photo']['name'] == null)
            {
                $user->photo = $photo;
            }
            $user->set(array('image_dir' => 'img'));
            if ($this->Users->save($user)) {
                $this->Flash->success(__('Your profile has been updated successfully.'));
                return $this->redirect(['action' => 'view',$id]);
            } else {
                $this->Flash->error(__('The user could not be saved. Please, try again.'));
            }
        }
            $this->set(compact('user'));
            $this->set('_serialize', ['user']);
        }
        else
        {
            $this->Flash->error(__('You are not authorized to do this.'));
            return $this->redirect(['controller' => 'home','action' => 'index']);
        }
    }

    /**
     * Delete method
     *
     * @param string|null $id User id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
     public function delete($id = null)
    {
        $this->Flash->error(__('You are not authorized to do this.'));
        return $this->redirect(['controller' => 'home','action' => 'index']);
         
        /* $this->request->allowMethod(['post', 'delete']);
        $user = $this->Users->get($id);
        if ($this->Users->delete($user)) {
            $this->Flash->success(__('The user has been deleted.'));
        } else {
            $this->Flash->error(__('The user could not be deleted. Please, try again.'));
        }
        return $this->redirect(['action' => 'index']); */
    } 
    
    //Login Function
    public function login()
    {
        if($this->request->session()->read('Auth.User'))
        {
            $this->Flash->error(__('You are already logged in.'));
            return $this->redirect(['controller' => 'home','action' => 'index']);
        }
        if($this->request->is('post'))
        {
               $user = $this->Auth->identify();
               if($user)
               {
                   $this->Auth->setUser($user);
                   return $this->redirect($this->Auth->redirectUrl());
               }
        }
        
        //In case of bad login
        $this->Flash->error('You must login first.');
    }
    
    //Logout action
    public function logout()
    {
        $this->Flash->success('You have logged out successfully.');
        $this->Auth->logout();
        return $this->redirect(['controller' => 'home']);
    }

    public function register()
    {
        $user = $this->Users->newEntity();
        if($this->request->is('post'))
        {
            $user = $this->Users->patchEntity($user,$this->request->data);
            if($this->Users->save($user))
            {
                $this->Flash->success("You are successfully registered");
                return $this->redirect(['action' => 'login']);
            }
            else
                $this->Flash->error('Something went wrong!');
        }
        $this->set(compact('user'));
        $this->set('_serialize',['user']);
    }
    
    public function beforeFilter(Event $event)
    {
        parent::beforeFilter($event);
        // Allow users to register and logout.
        // You should not add the "login" action to allow list. Doing so would
        // cause problems with normal functioning of AuthComponent.
        $this->Auth->allow(['add', 'logout']);
        $this->Auth->allow(['register']);
        $this->Auth->allow(['home']);
    }
}
