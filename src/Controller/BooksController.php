<?php
namespace App\Controller;

/*
* Book Status
0. Available
1. Requested
2. Issued

* Request ownerAck field
0. Pending
1. Accepted
2. Declined
3. Cancelled
4. Issued
*/

use App\Controller\AppController;
use Cake\I18n\Time;
use Cake\ORM\TableRegistry;
use Cake\I18n\Date;

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
            'contain' => ['Users'],
            'conditions' => array(
                "Books.user_id = $user_id"
            )
            
        ];
        $books = $this->paginate($this->Books);
        

        $this->set(compact('books'));
        $this->set('_serialize', ['books']);
        $this->set('title', 'All Books');
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
        
        $this->loadModel('Reviews');
        $this->paginate = [
            'contain' => ['Books', 'Users'],
            'conditions' => array(
                'Reviews.book_id' => "$book->id"
            )
        ];
        $reviews = $this->paginate($this->Reviews);

        $this->set(compact('reviews'));
        $this->set('_serialize', ['reviews']);
        $this->set('title', "Book View - $book->title");
        
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
            $book->set(array('user_id' => "$user_id", 'status' => '0'));
            if ($this->Books->save($book)) {
                $this->Flash->success(__('The book has been saved.'));
                return $this->redirect(['action' => 'myAddedBooks']);
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
        $user_id = $this->request->session()->read('Auth.User.id');
        $book = $this->Books->get($id, [
            'contain' => []
        ]);
        $photo = $book->photo;
        if($book->status == 0 && $book->user_id == $user_id)
        {
            if ($this->request->is(['patch', 'post', 'put'])) {
                $book = $this->Books->patchEntity($book, $this->request->data);
                if($this->request->data['photo']['name'] == null)
                {
                    $book->photo = $photo;
                }
                if ($this->Books->save($book)) {
                    $this->Flash->success(__('The book has been saved.'));
                    return $this->redirect(['action' => 'view', $id]);
                } else {
                    $this->Flash->error(__('The book could not be saved. Please, try again.'));
                }
            }
            $users = $this->Books->Users->find('list', ['limit' => 200]);
            $this->set(compact('book', 'users'));
            $this->set('_serialize', ['book']);
            $this->set('title', "Edit Book - $book->title");
        }
        else
        {
            $this->Flash->error(__('You can\'t edit this book.'));
            return $this->redirect(['action' => 'myAddedBooks']);
        }
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
        //$this->request->allowMethod(['post', 'delete']);
        $book = $this->Books->get($id);
        if ($this->Books->delete($book)) {
            $this->Flash->success(__('The book has been deleted.'));
        } else {
            $this->Flash->error(__('The book could not be deleted. Please, try again.'));
        }
        return $this->redirect(['action' => 'myAddedBooks']);
    }

    public function borrow($id = null)
    {
        $user_id = $this->request->session()->read('Auth.User.id');
        if($id == null)
            return $this->redirect(['action' => 'search-book']);
        //echo "1234";
        $book = $this->Books->get($id, [
            'contain' => ['Users', 'Reviews']
        ]);
        if($book->user_id != $user_id)
        {
            $this->set('book', $book);
            if($book->status == 1)
            {
                $this->Flash->error("This book is already borrowed so you can't generate request for this book.");
                return $this->redirect(['action' => 'index']);
            }
            $this->set('_serialize', ['book']);
        }
        else
            {
                $this->Flash->error('How come you want to borrow your own book?');
                return $this->redirect(['controller' => 'books', 'action' => 'index']);
            }
        $this->set('title', "Borrow ".$book->title);
        //redirect if the book is already borrowed with an error
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
        
        
        //$this->request->allowMethod(['post', 'confirmBorrow']);
        $user_id = $this->request->session()->read('Auth.User.id');
        $book = $this->Books->get($id, [
            'contain' => ['Users', 'Reviews']
        ]);
        if($book->status == 0) // Status is 0 if book is available
        {    
            $owner_id = $book->user_id;
            $Weeks = $this->request->data['Weeks'];
            if($Weeks == '0')
            {
                $this->Flash->error('Please select the number of weeks first!');
                return $this->redirect(['controller' => 'books', 'action' => 'borrow', $id]);
            }
            
            if($book->user_id != $user_id)
            {
                $this->loadModel('requests');
                $request = $this->requests->newEntity();
                $request->set(array(
                    'book_id' => "$id",
                    'borrower_id' => "$user_id",
                    'owner_id' => "$owner_id",
                    'Weeks' => "$Weeks",
                    'ownerAck' => 0,
                    'rentPaid' => 0
                ));

                if($this->requests->save($request))
                {    
                     $book = $this->Books->get($id, [
                    'contain' => ['Users', 'Reviews']
                    ]);
                    $book->set(array('status' => '1'));
                    $this->loadModel('Books');
                    if($this->Books->save($book))
                    { 
                        $this->Flash->success('Your request is sent to the owner. We will notify you once the owner accepts your request.');
                        return $this->redirect(['controller' => 'requests', 'action' => 'borrow']);
                    }
                }
                else
                {
                    $this->Flash->error('Something went wrong!');
                    return $this->redirect(['controller' => 'requests', 'action' => 'index']);
                }
            }
            else
            {
                $this->Flash->error('How come you want to generate borrow request for your own book?');
                return $this->redirect(['controller' => 'books', 'action' => 'index']);
            }
        }    
    }
    
    
    public function myAddedBooks($id = null)
    {
        $user_id = $this->request->session()->read('Auth.User.id');
        $this->log("user_id = $user_id", 'debug');
        $this->paginate = [
            'contain' => ['Users'],
            //Show only the books added by the user by using condition
            'conditions' => array(
                "Books.user_id = $user_id"
                //'Books.user_id = 1'
            ),
        'order' => ['Books.id' => 'DESC']];
        $books = $this->paginate($this->Books);
        

        $this->set(compact('books'));
        $this->set('_serialize', ['books']);
        $this->set('title', 'My Added Book');
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
                "Books.status = 0"
                //'Books.user_id = 1'
            )];
        $books = $this->paginate($this->Books);
        $this->set(compact('books'));
        $this->set('_serialize', ['books']);
        $this->set('title', 'Borrow Book');
    }
    
    public function issued()
    {
        $user_id = $this->request->session()->read('Auth.User.id');
        $this->loadModel('Transactions');
        $this->paginate = [
            'contain' => ['Requests', 'Owners', 'Borrowers', 'Books'],
            'conditions' => array(
                "Transactions.owner_id = $user_id"
            ),
            'order' => ['Transactions.id' => 'DESC']];
        $transactions = $this->paginate($this->Transactions);
        $this->set(compact('transactions'));
        $this->set('_serialize', ['transactions']);
        $this->set('title', 'My Issued Books');
    }
    
    public function borrowed()
    {
        $user_id = $this->request->session()->read('Auth.User.id');
        $this->loadModel('Transactions');
        $this->paginate = [
            'contain' => ['Requests', 'Owners', 'Borrowers', 'Books'],
            'conditions' => array(
                "Transactions.borrower_id = $user_id"
            ),
            'order' => ['Transactions.id' => 'DESC']];
        $transactions = $this->paginate($this->Transactions);
        $this->set(compact('transactions'));
        $this->set('_serialize', ['transactions']);
        $this->set('title', 'My Borrowed Books');
    }   
}
