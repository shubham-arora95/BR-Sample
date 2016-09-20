<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Reviews Controller
 *
 * @property \App\Model\Table\ReviewsTable $Reviews
 */
class ReviewsController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
        $user_id = $this->request->session()->read('Auth.User.id');
        $this->paginate = [
            'contain' => ['Books', 'Users'],
            'conditions' => array(
                'Reviews.user_id' => "$user_id"
            )
        ];
        $reviews = $this->paginate($this->Reviews);

        $this->set(compact('reviews'));
        $this->set('_serialize', ['reviews']);
    }

    /**
     * View method
     *
     * @param string|null $id Review id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $review = $this->Reviews->get($id, [
            'contain' => ['Books', 'Users']
        ]);

        $this->set('review', $review);
        $this->set('_serialize', ['review']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add($id = null)
    {
        if($id == null)
        {
            $this->set('showAllBooks', 1);
        }
        else
            $this->set('showAllBooks', 0);
        
        $user_id = $this->request->session()->read('Auth.User.id');
        $review = $this->Reviews->newEntity();
        if ($this->request->is('post')) {
            $review = $this->Reviews->patchEntity($review, $this->request->data);
            
            if($id != null)
            {
                $review->set(array('user_id' => "$user_id", 'book_id' => "$id"));
            }
            else
            {
                $review->set(array('user_id' => "$user_id"));
            }
            
            //$review->set(array('user_id' => "$user_id", 'book_id' => "$id"));
            if ($this->Reviews->save($review)) {
                $this->Flash->success(__('The review has been saved.'));
                return $this->redirect(['controller' => 'books', 'action' => 'view',$id]);
            } else {
                $this->Flash->error(__('The review could not be saved. Please, try again.'));
            }
        }
        $books = $this->Reviews->Books->find('list', [
            'limit' => 200,
            'conditions' => array(
                "Books.user_id = $user_id"
            )
        ]);
        $users = $this->Reviews->Users->find('list', ['limit' => 200]);
        $this->set(compact('review', 'books', 'users'));
        $this->set('_serialize', ['review']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Review id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $review = $this->Reviews->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $review = $this->Reviews->patchEntity($review, $this->request->data);
            if ($this->Reviews->save($review)) {
                $this->Flash->success(__('The review has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The review could not be saved. Please, try again.'));
            }
        }
        $books = $this->Reviews->Books->find('list', ['limit' => 200]);
        $users = $this->Reviews->Users->find('list', ['limit' => 200]);
        $this->set(compact('review', 'books', 'users'));
        $this->set('_serialize', ['review']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Review id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $review = $this->Reviews->get($id);
        if ($this->Reviews->delete($review)) {
            $this->Flash->success(__('The review has been deleted.'));
        } else {
            $this->Flash->error(__('The review could not be deleted. Please, try again.'));
        }
        return $this->redirect(['action' => 'index']);
    }
}
