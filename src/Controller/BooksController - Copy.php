<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\I18n\Time;
use Cake\ORM\TableRegistry;

/**
 * Books Controller
 *
 * @property \App\Model\Table\BooksTable $Books
 */
class BooksController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
        $user_id = $this->request->session()->read('Auth.User.id');
        $this->log("user_id = $user_id", 'debug');
        $this->paginate = [
            'contain' => ['Users']
            /*'conditions' => array(
                "Books.user_id = $user_id"
                //'Books.user_id = 1'
            )*/
            
        ];
        $books = $this->paginate($this->Books);
        

        $this->set(compact('books'));
        $this->set('_serialize', ['books']);
    }

    /**
     * View method
     *
     * @param string|null $id Book id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $book = $this->Books->get($id, [
            'contain' => ['Users', 'Reviews']
        ]);

        $this->set('book', $book);
        $this->set('_serialize', ['book']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $user_id = $this->request->session()->read('Auth.User.id');
        $book = $this->Books->newEntity();
        $this->log($this->request->data, 'debug');
        if ($this->request->is('post')) {
            $book = $this->Books->patchEntity($book, $this->request->data);
            $book->set(array('user_id' => "$user_id"));
            if ($this->Books->save($book)) {
                $this->Flash->success(__('The book has been saved.'));
                //return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The book could not be saved. Please, try again.'));
            }
        }
        $users = $this->Books->Users->find('list', ['limit' => 200]);
        $this->set(compact('book', 'users'));
        $this->set('_serialize', ['book']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Book id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $book = $this->Books->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $book = $this->Books->patchEntity($book, $this->request->data);
            if ($this->Books->save($book)) {
                $this->Flash->success(__('The book has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The book could not be saved. Please, try again.'));
            }
        }
        $users = $this->Books->Users->find('list', ['limit' => 200]);
        $this->set(compact('book', 'users'));
        $this->set('_serialize', ['book']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Book id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $book = $this->Books->get($id);
        if ($this->Books->delete($book)) {
            $this->Flash->success(__('The book has been deleted.'));
        } else {
            $this->Flash->error(__('The book could not be deleted. Please, try again.'));
        }
        return $this->redirect(['action' => 'index']);
    }

    public function borrow($id = null)
    {
        if($id == null)
            return $this->redirect(['action' => 'index']);
        //echo "1234";
        $book = $this->Books->get($id, [
            'contain' => ['Users', 'Reviews']
        ]);
    
        $this->set('book', $book);
        if($book->is_borrowed == 1)
        {
            $this->Flash->error("Book is already borrowed");
            return $this->redirect(['action' => 'index']);
        }
        $this->set('_serialize', ['book']);
        
        //redirect if the book is already borrowed with an error
    }
    
    
    
    public function confirmBorrow($id = null)
    {
        $this->request->allowMethod(['post', 'confirmBorrow']);
        $Weeks = $this->request->data['Weeks'];
        $this->log($Weeks, 'debug');
    
        //Get book by id
        $book = $this->Books->get($id, [
            'contain' => ['Users', 'Reviews']
        ]);
        
        //Change is_borrow field 
        $book->set(array('is_borrowed' => '1'));
        
        //Adding a transaction
        /*$this->loadModel('transaction');
        $user_id = $this->request->session()->read('Auth.User.id');
        $time = Time::now();
        $transaction = $transactions->newEntity();
        $transaction->set(array(
            'user_id' => "$user_id", 
            'book_id' => "$id", 
            'issue_date' => "$time", 
            'return_date' => "$time" 
        )); */
        
        //save the changed record in DB
        /*if($this->Books->save($book))
        {
            $this->loadModel('transactions');
            $user_id = $this->request->session()->read('Auth.User.id');
            $time = date("Y-m-d");
            $transaction = $this->transactions->newEntity();
            $transaction->set(array(
                'user_id' => "$user_id", 
                'book_id' => "$id", 
                'issue_date' => "$time", 
                'return_date' => "$time" 
            ));
            if($this->transactions->save($transaction))
                $this->Flash->success('Success');
        }
        else
            $this->Flash->error('Something went wrong!');*/
        //return $this->response->redirect(['action' => 'index']);
    }
    
    public function generateRequest($id = null)
    {
        /*
        1. Fetch current user id
        2. Fetch the book for which the request is to be generated.
        3. Fetch the user_id of the owner by the book result
        4. Fetch the no. of weeks
        5. Save all this info (load model for requests and then save)
        6. Give request-id to the user
        */
        
        
        $this->request->allowMethod(['post', 'confirmBorrow']);
        $user_id = $this->request->session()->read('Auth.User.id');
        $book = $this->Books->get($id, [
            'contain' => ['Users', 'Reviews']
        ]);
        $owner_id = $book->user_id;
        $Weeks = $this->request->data['Weeks'];
        
        $this->loadModel('requests');
        $request = $this->requests->newEntity();
        $request->set(array(
            'book_id' => "$id",
            'user_id_borrower' => "$user_id",
            'user_id_owner' => "$owner_id",
            'Weeks' => "$Weeks",
            'ownerAck' => 1,
            'rentPaid' => 1
        ));
        
        if($this->requests->save($request))
        {    
            $this->Flash->success('Request successfully saved');
            return $this->redirect(['action' => 'index']);
        }
        else
        {
            $this->Flash->error('Something went wrong!');
            return $this->redirect(['action' => 'index']);
        }
        
        
    }
    
    
    public function myBooks($id = null)
    {
        $user_id = $this->request->session()->read('Auth.User.id');
        $this->log("user_id = $user_id", 'debug');
        $this->paginate = [
            'contain' => ['Users'],
            //Show only the books added by the user by using condition
            'conditions' => array(
                "Books.user_id = $user_id"
                //'Books.user_id = 1'
            )];
        $books = $this->paginate($this->Books);
        

        $this->set(compact('books'));
        $this->set('_serialize', ['books']);
    }
    
    public function searchbook()
    {
        $user_id = $this->request->session()->read('Auth.User.id');
        $this->log("user_id = $user_id", 'debug');
        $this->paginate = [
            'contain' => ['Users'],
            //Show only the books added by the user by using condition
            'conditions' => array(
                "Books.user_id != $user_id",
                "Books.is_borrowed = 0"
                //'Books.user_id = 1'
            )];
        $books = $this->paginate($this->Books);
        

        $this->set(compact('books'));
        $this->set('_serialize', ['books']);
    }
        
    
}
