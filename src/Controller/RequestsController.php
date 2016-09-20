<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\I18n\Time;
use Cake\I18n\Date;


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

/**
 * Requests Controller
 *
 * @property \App\Model\Table\RequestsTable $Requests
 */
class RequestsController extends AppController
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
            'contain' => ['Books', 'Borrowers', 'Owners', 'Transactions'],
            'conditions' => array(
                "Requests.owner_id = $user_id",
                'Requests.transaction_id = 0'
        ),
        'order' => ['Requests.id' => 'DESC']];
        $issueRequests = $this->paginate($this->Requests);

        $this->set(compact('issueRequests'));
        $this->set('_serialize', ['issueRequests']);
        
        $this->paginate = [
            'contain' => ['Books', 'Borrowers', 'Owners', 'Transactions'],
            'conditions' => array(
                "Requests.borrower_id = $user_id",
                'Requests.transaction_id = 0'
        ),
        'order' => ['Requests.id' => 'DESC']];
        $borrowRequests = $this->paginate($this->Requests);

        $this->set(compact('borrowRequests'));
        $this->set('_serialize', ['borrowRequests']);
        $this->set('title', 'All Requests');
    }

    /**
     * View method
     *
     * @param string|null $id Request id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $request = $this->Requests->get($id, [
            'contain' => ['Books', 'Borrowers', 'Owners']
        ]);

        $this->set('request', $request);
        $this->set('_serialize', ['request']);
        $this->set('title', "Request id - $request->id");
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $request = $this->Requests->newEntity();
        if ($this->request->is('post')) {
            $request = $this->Requests->patchEntity($request, $this->request->data);
            if ($this->Requests->save($request)) {
                $this->Flash->success(__('The request has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The request could not be saved. Please, try again.'));
            }
        }
        $books = $this->Requests->Books->find('list', ['limit' => 200]);
        $borrowers = $this->Requests->Borrowers->find('list', ['limit' => 200]);
        $owners = $this->Requests->owners->find('list', ['limit' => 200]);
        $this->set(compact('request', 'books', 'borrowers', 'owners'));
        $this->set('_serialize', ['request']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Request id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $request = $this->Requests->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $request = $this->Requests->patchEntity($request, $this->request->data);
            if ($this->Requests->save($request)) {
                $this->Flash->success(__('The request has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The request could not be saved. Please, try again.'));
            }
        }
        $transactions = $this->Requests->Transactions->find('list', ['limit' => 200]);
        $books = $this->Requests->Books->find('list', ['limit' => 200]);
        $borrowers = $this->Requests->Borrowers->find('list', ['limit' => 200]);
        $owners = $this->Requests->owners->find('list', ['limit' => 200]);
        $this->set(compact('request', 'books', 'borrowers', 'owners', 'transactions'));
        $this->set('_serialize', ['request']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Request id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $request = $this->Requests->get($id);
        if ($this->Requests->delete($request)) {
            $this->Flash->success(__('The request has been deleted.'));
        } else {
            $this->Flash->error(__('The request could not be deleted. Please, try again.'));
        }
        return $this->redirect(['action' => 'index']);
    }
    
    public function issue()
    {
        $user_id = $this->request->session()->read('Auth.User.id');
        $this->paginate = [
            'contain' => ['Books', 'Borrowers', 'Owners'],
            'conditions' => array(
                "Requests.owner_id = $user_id",
                'Requests.transaction_id = 0'
            ),
            'order' => ['Requests.id' => 'DESC']
        ];
        $requests = $this->paginate($this->Requests);

        $this->set(compact('requests'));
        $this->set('_serialize', ['requests']);
        $this->set('title', 'Issue Requests');
    }
    
    public function borrow()
    {
        $user_id = $this->request->session()->read('Auth.User.id');
        $this->paginate = [
            'contain' => ['Books', 'Borrowers', 'Owners'],
            'conditions' => array(
                "Requests.borrower_id = $user_id",
                'Requests.transaction_id = 0'
            ),
            'order' => ['Requests.id' => 'DESC']
        ];
        $requests = $this->paginate($this->Requests);

        $this->set(compact('requests'));
        $this->set('_serialize', ['requests']);
        $this->set('title', 'Borrow Requests');
    }
    
    public function acceptIssueRequest($id = null)
    {
        $user_id = $this->request->session()->read('Auth.User.id');
        $request = $this->Requests->get($id, [
            'contain' => []
        ]);
        if($request->owner_id == $user_id)
        {
            $request->set(array('ownerAck' => '1'));
            //Changing book status pending
            if($this->Requests->save($request))
                $this->Flash->success(__('You have successfully accepted this request. Please ask the borrower to give you the unique code at the time of pickup and verify it from transactions otherwise you won\'t get your rent.'));
            else
                $this->Flash->error(__('Something went wrong.'));
        }
        else
        {
            $this->Flash->error(__('Something went wrong.'));
        }
        return $this->redirect(['action' => 'issue']);
    }
    
    public function declineIssueRequest($id = null)
    {
        $user_id = $this->request->session()->read('Auth.User.id');
        $request = $this->Requests->get($id, [
            'contain' => []
        ]);
        $book_id = $request->book_id;
        if($request->owner_id == $user_id)
        {
            $request->set(array('ownerAck' => '2'));
            if($this->Requests->save($request))
            {
                $this->loadModel('Books');
                $book = $this->Books->get($book_id);
                $book->set(array('status' => '0'));
                if($this->Books->save($book))
                {
                   $this->Flash->success(__('Request has been declined successfully.')); 
                }
            }
            else
                $this->Flash->error(__('Something went wrong request was not saved.'));
        }
        else
        {
            $this->Flash->error(__('Something went wrong.'));
        }
        return $this->redirect(['action' => 'issue']);
    }
    
    /* Function myBorrowRequests */
    
    public function myBorrowRequests()
    {
        $user_id = $this->request->session()->read('Auth.User.id');
        $this->paginate = [
            'contain' => ['Books', 'Borrowers', 'Owners'],
            'conditions' => array(
                "Requests.borrower_id = $user_id",
                'Requests.ownerAck = 1'
            )
        ];
        $requests = $this->paginate($this->Requests);

        $this->set(compact('requests'));
        $this->set('_serialize', ['requests']);
    }
    
    public function cancelBorrowRequest($id = null)
    {
        $user_id = $this->request->session()->read('Auth.User.id');
        $request = $this->Requests->get($id, [
            'contain' => []
        ]);
        $book_id = $request->book_id;
        if($request->borrower_id == $user_id)
        {
            $request->set(array('ownerAck' => '3'));
            if($this->Requests->save($request))
            {
                $this->loadModel('Books');
                $book = $this->Books->get($book_id);
                $book->set(array('status' => '0'));
                if($this->Books->save($book))
                {
                   $this->Flash->success(__('Request has been canceled successfully')); 
                }
            }
            else
                $this->Flash->error(__('Something went wrong request was not saved.'));
        }
        else
        {
            $this->Flash->error(__('Something went wrong.'));
        }
        return $this->redirect(['action' => 'borrow']);
    }
    
    public function payRent($id = null)
    {
        // Only need to show transaction status along with the rent and security deposit to be paid according to the number of weeks and a pay rent button.
        
        $user_id = $this->request->session()->read('Auth.User.id');
        $request = $this->Requests->get($id, [
            'contain' => ['Books', 'Borrowers', 'Owners']
        ]);
        
        if($request->ownerAck == '1' && $request->borower_id = $user_id)
        {    
            $book_id = $request->book_id;

            $this->set('request', $request);
            $this->set('_serialize', ['request']);

            // Calculate rent from the no of weeks
            $rent = $request->Weeks * 7 * 2;
            $this->set('rent', $rent);

            // Load books model and fethch the price to calculated security deposit
            $this->loadModel('Books');
            $book = $this->Books->get($book_id);
            $securityDeposit = $book->price * 60/100;
            $this->set('securityDeposit', $securityDeposit);

            // Generate Total
            $total = $rent + $securityDeposit;
            $this->set('total', $total);
        }
        else
        {
            $this->Flash->error(__('You can\'t pay rent for this request.'));
            return $this->redirect(['action' => 'view', $id]);
        }
        $this->set('title', "Pay rent for - $book->title");
    }
    
    public function confirmRentPaid($id = null)
    {
        /*
        * 1. Add status to rentpaid = 1;
        * 2. Add book status to issued
        * 3. Add a new transaction
        */
        
        $user_id = $this->request->session()->read('Auth.User.id');
        $request = $this->Requests->get($id, [
            'contain' => []
        ]);
        //Get owner and borrower ids
        $owner_id = $request->owner_id;
        $borrower_id = $request->borrower_id;
        $book_id = $request->book_id;
        
        //Generate a random number
        $random = substr(md5(rand()), 0, 7);
        
        //Calculate no of days according to weeks
        $weeks = $request->Weeks;
        
        if($weeks == 1)
            $days = '7';
        elseif($weeks == 2)
            $days = '14';
        elseif($weeks == 3)
            $days = '21';
        
        
        $dateIssue = Time::now();
        $dateIssue = $dateIssue->modify('+5 hours 30 minutes');
        $dateReturn = Time::now();
        $dateReturn = $dateReturn->modify('+5 hours 30 minutes');
        $dateReturn = $dateReturn->modify("+$days days");
        try
        {
            if($request->ownerAck == '1' && $request->borrower_id == $user_id && $request->rentPaid == '0')
            {
                /*$request->set(array('ownerAck' => '4', 'rentPaid' => '1'));
                $savedRequestEntity = $this->Requests->save($request);
                if($savedRequestEntity)
                {
                    $this->loadModel('Books');
                    $book = $this->Books->get($book_id);
                    $book->set(array('status' => '1', 'rentPaid' => '1'));
                    $savedBookEntity = $this->Books->save($book);
                    if($savedBookEntity)
                    { */
                //Adding a transaction
                $this->loadModel('transactions');
                $user_id = $this->request->session()->read('Auth.User.id');
                $transaction = $this->transactions->newEntity();
                $transaction->set(array(
                    'request_id' => "$id",
                    'status' => '0',
                    'issue_date' => $dateIssue,
                    'return_date' => $dateReturn,
                    'owner_id' => $owner_id,
                    'borrower_id' => $borrower_id,
                    'book_id' => $book_id,
                    'random' => $random));
                $savedTransactionEntity = $this->transactions->save($transaction);
                if($savedTransactionEntity)
                {
                    $this->loadModel('Requests');
                    $request->set(array('ownerAck' => '4', 'rentPaid' => '1', 'transaction_id' => $savedTransactionEntity->id, 'payment_date' => $dateIssue));
                    $savedRequestEntity = $this->Requests->save($request);
                    $this->loadModel('Books');
                    $book = $this->Books->get($book_id);
                    $book->set(array('status' => '1'));
                    $savedBookEntity = $this->Books->save($book);
                    if($savedRequestEntity)
                        $this->Flash->success(__('Transaction has been completed successfully'));
                }  
                else
                {
                    $this->Flash->error(__('Something went wrong and transaction was not completed.'));
                    if($savedTransactionEntity) $this->transactions->delete($savedTransactionEntity);
                }
            }
            else
            {
                $this->Flash->error(__('Something went wrong.'));
            }
           return $this->redirect(['controller' => 'transactions', 'action' => 'success', $savedTransactionEntity->id]);
        }
        catch(Exception $e)
        {
            if($savedTransactionEntity) $this->transactions->delete($savedTransactionEntity);
            if($savedBookEntity)
            {
                $this->loadModel('Books');
                $book = $this->Books->get($book_id);
                $book->set(array('status' => '1', 'rentPaid' => '0', 'payment_date' => $dateIssue));
                $this->Books->save($book);
            }
            if($savedRequestEntity)
            {
                $this->loadModel('Requests');
                $request = $this->Requests->get($id);
                $request->set(array('ownerAck' => '1', 'rentPaid' => '0'));
                $this->Books->save($book);
            }
        }
    }
    
    public function payments()
    {
        $user_id = $this->request->session()->read('Auth.User.id');
        $this->paginate = [
            'contain' => ['Books', 'Borrowers', 'Owners', 'Transactions'],
            'conditions' => array(
                "Requests.borrower_id = $user_id",
                "Requests.ownerAck = 1",
                "Requests.rentPaid = 0"
            ),
            'order' => ['Requests.id' => 'DESC']];
        $pendingPayments = $this->paginate($this->Requests);
        $this->set(compact('pendingPayments'));
        $this->set('_serialize', ['pendingPayments']);
        
        $this->paginate = [
            'contain' => ['Books', 'Borrowers', 'Owners', 'Transactions'],
            'conditions' => array(
                "Requests.borrower_id = $user_id",
                "Requests.rentPaid = 1"
            ),
            'order' => ['Requests.id' => 'DESC']];
        $paidPayments = $this->paginate($this->Requests);
        $this->set(compact('paidPayments'));
        $this->set('_serialize', ['paidPayments']);
        $this->set('title', 'My Payments');
    }
}   