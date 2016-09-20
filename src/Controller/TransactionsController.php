<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Transactions Controller
 *
 * @property \App\Model\Table\TransactionsTable $Transactions
 */

/*
* Transaction Status
*   0. Pending Code Verification
*   1. Code Verified
*   2. Return Requested
*   3. Transaction closed
*/
class TransactionsController extends AppController
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
            'contain' => ['Requests', 'Owners', 'Borrowers', 'Books'],
            'conditions' => array(
                "Transactions.owner_id = $user_id"
            ),
            'order' => ['Transactions.id' => 'DESC']];
        $issueTransactions = $this->paginate($this->Transactions);
        $this->set(compact('issueTransactions'));
        $this->set('_serialize', ['issueTransactions']);

        $this->set(compact('issueTransactions'));
        $this->set('_serialize', ['issueTransactions']);
        $this->paginate = [
            'contain' => ['Requests', 'Owners', 'Borrowers', 'Books'],
            'conditions' => array(
                "Transactions.borrower_id = $user_id"
            ),
            'order' => ['Transactions.id' => 'DESC']];
        $borrowTransactions = $this->paginate($this->Transactions);

        $this->set(compact('borrowTransactions'));
        $this->set('_serialize', ['borrowTransactions']);
        $this->set('title', 'All Transactions');
    }

    /**
     * View method
     *
     * @param string|null $id Transaction id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $transaction = $this->Transactions->get($id, [
            'contain' => ['Books', 'Owners', 'Borrowers', 'Requests']
        ]);

        $this->set('transaction', $transaction);
        $this->set('_serialize', ['transaction']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $transaction = $this->Transactions->newEntity();
        if ($this->request->is('post')) {
            $transaction = $this->Transactions->patchEntity($transaction, $this->request->data);
            if ($this->Transactions->save($transaction)) {
                $this->Flash->success(__('The transaction has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The transaction could not be saved. Please, try again.'));
            }
        }
        $books = $this->Transactions->Books->find('list', ['limit' => 200]);
        $owners = $this->Transactions->Owners->find('list', ['limit' => 200]);
        $borrowers = $this->Transactions->Borrowers->find('list', ['limit' => 200]);
        $this->set(compact('transaction', 'books', 'owners', 'borrowers'));
        $this->set('_serialize', ['transaction']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Transaction id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $transaction = $this->Transactions->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $transaction = $this->Transactions->patchEntity($transaction, $this->request->data);
            if ($this->Transactions->save($transaction)) {
                $this->Flash->success(__('The transaction has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The transaction could not be saved. Please, try again.'));
            }
        }
        $books = $this->Transactions->Books->find('list', ['limit' => 200]);
        $owners = $this->Transactions->Owners->find('list', ['limit' => 200]);
        $borrowers = $this->Transactions->Borrowers->find('list', ['limit' => 200]);
        $this->set(compact('transaction', 'books', 'owners', 'borrowers'));
        $this->set('_serialize', ['transaction']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Transaction id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    /*public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $transaction = $this->Transactions->get($id);
        if ($this->Transactions->delete($transaction)) {
            $this->Flash->success(__('The transaction has been deleted.'));
        } else {
            $this->Flash->error(__('The transaction could not be deleted. Please, try again.'));
        }
        return $this->redirect(['action' => 'index']);
    }*/
    
    public function success($id = null)
    {
        $transaction = $this->Transactions->get($id, [
            'contain' => ['Books', 'Owners', 'Borrowers', 'Requests']
        ]);

        $this->set('transaction', $transaction);
        $this->set('_serialize', ['transaction']);
        $this->set('title', 'Transaction Details');
    }
    
    public function verifyCode($id = null)
    {
        $user_id = $this->request->session()->read('Auth.User.id');
        $transaction = $this->Transactions->get($id, [
            'contain' => ['Books', 'Owners', 'Borrowers', 'Requests']
        ]);
        
        if($transaction->owner_id == $user_id)
        {
            $this->Flash->success(__('Please enter the code below which was given by the borrower during pickup.'));
            if($transaction->status == 0)
            {
                $this->set('transaction', $transaction);
                $this->set('_serialize', ['transaction']);
            }
            else
            {
                $this->Flash->error(__('You have already verified code for this transaction'));
                return $this->redirect(['action' => 'index']);
            }
        }
        else
        {
            $this->Flash->error(__('You can\'t verify code for this transaction'));
            return $this->redirect(['action' => 'index']);
        }
        $this->set('title', "Verify Code for transaction id: ".$transaction->id);
    }
    
    public function checkEnteredCode($id = null)
    {
        $user_id = $this->request->session()->read('Auth.User.id');
        $transaction = $this->Transactions->get($id, [
            'contain' => ['Books', 'Owners', 'Borrowers', 'Requests']
        ]);
        
        $enteredCode = trim($this->request->data['enteredCode']);
        $this->set('random', $enteredCode);
        
        if($transaction->owner_id == $user_id)
        {
           if($enteredCode == $transaction->random)
            {
                $this->Flash->success(__('Code verified successfully. You will now get your rent as soon as the borrower return the book.'));
                $transaction->set(array('status' => 1));
                if($this->Transactions->save($transaction))
                    return $this->redirect(['action' => 'issue']);
                else
                    return $this->redirect(['action' => 'issue']);
            }
            else
            {
                $this->Flash->error(__('This code doesn\'t match. Please enter the code again!'));
                return $this->redirect(['action' => 'verifyCode', $id]);
            }
        }
        else
        {
            $this->Flash->error(__('You are not permitted to verify this code.'));
            return $this->redirect(['action' => 'issue']);
        }
    }
    
    public function returnBook($id = null)
    {
        $user_id = $this->request->session()->read('Auth.User.id');
        $transaction = $this->Transactions->get($id, [
            'contain' => ['Books', 'Owners', 'Borrowers', 'Requests']
        ]);
        if($transaction->status == 1)
        {
            $transaction->set(array('status' => 2));
            if($this->Transactions->save($transaction))
            {
                $this->Flash->success(__('Your return request is accepted successfully. Drop the book to the owner and ask him/her to immediately confirm the return.'));
                return $this->redirect(['action' => 'borrow']);
            }
            else
            {
                $this->Flash->error(__('Oops! It seem like something went weong.'));
                $transaction->set(array('status' => 1));
                $this->Transactions->save($transaction);
                return $this->redirect(['action' => 'borrow']);
            }
        }
        else
        {
            $this->Flash->error(__('The code for this transaction is not verified yet. Please ask the owner to verify the code so that you may return this book'));
            return $this->redirect(['action' => 'borrow']);
        }
    }
    
    public function confirmReturn($id = null)
    {
        $user_id = $this->request->session()->read('Auth.User.id');
        $transaction = $this->Transactions->get($id, [
            'contain' => ['Books', 'Owners', 'Borrowers', 'Requests']
        ]);
        $transaction->set(array('status' => 3));
        if($this->Transactions->save($transaction))
        {
            $this->loadModel('Books');
            $book = $this->Books->get($transaction->book_id);
            $book->set(array('status' => 0));
            $this->Books->save($book);
            $this->Flash->success(__('Thanks! for the confirmation. You will get your rent soon. '));
            return $this->redirect(['action' => 'issue']);
        }
        else
        {
            $transaction->set(array('status' => 2));
            $this->Transactions->save($transaction);
            $this->Flash->error('Oops! Something went wrong. Please write to us about this.');
            return $this->redirect(['action' => 'issue']);
        } 
    }
    
    public function issue()
    {
        $user_id = $this->request->session()->read('Auth.User.id');
        $this->paginate = [
            'contain' => ['Requests', 'Owners', 'Borrowers', 'Books'],
            'conditions' => array(
                "Transactions.owner_id = $user_id"
            ),
            'order' => ['Transactions.id' => 'DESC']];
        $transactions = $this->paginate($this->Transactions);
        $this->set(compact('transactions'));
        $this->set('_serialize', ['transactions']);
        $this->set('title', 'Issue Transactions');
    }
    
    public function borrow()
    {
        $user_id = $this->request->session()->read('Auth.User.id');
        $this->paginate = [
            'contain' => ['Requests', 'Owners', 'Borrowers', 'Books'],
            'conditions' => array(
                "Transactions.borrower_id = $user_id"
            ),
            'order' => ['Transactions.id' => 'DESC']];
        $transactions = $this->paginate($this->Transactions);
        $this->set(compact('transactions'));
        $this->set('_serialize', ['transactions']);
        $this->set('title', 'Borrow Transactions');
    }
}
