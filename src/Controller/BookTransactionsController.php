<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * BookTransactions Controller
 *
 * @property \App\Model\Table\BookTransactionsTable $BookTransactions
 */
class BookTransactionsController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Users', 'Books']
        ];
        $bookTransactions = $this->paginate($this->BookTransactions);

        $this->set(compact('bookTransactions'));
        $this->set('_serialize', ['bookTransactions']);
    }

    /**
     * View method
     *
     * @param string|null $id Book Transaction id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $bookTransaction = $this->BookTransactions->get($id, [
            'contain' => ['Users', 'Books']
        ]);

        $this->set('bookTransaction', $bookTransaction);
        $this->set('_serialize', ['bookTransaction']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $bookTransaction = $this->BookTransactions->newEntity();
        if ($this->request->is('post')) {
            $bookTransaction = $this->BookTransactions->patchEntity($bookTransaction, $this->request->data);
            if ($this->BookTransactions->save($bookTransaction)) {
                $this->Flash->success(__('The book transaction has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The book transaction could not be saved. Please, try again.'));
            }
        }
        $users = $this->BookTransactions->Users->find('list', ['limit' => 200]);
        $books = $this->BookTransactions->Books->find('list', ['limit' => 200]);
        $this->set(compact('bookTransaction', 'users', 'books'));
        $this->set('_serialize', ['bookTransaction']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Book Transaction id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $bookTransaction = $this->BookTransactions->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $bookTransaction = $this->BookTransactions->patchEntity($bookTransaction, $this->request->data);
            if ($this->BookTransactions->save($bookTransaction)) {
                $this->Flash->success(__('The book transaction has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The book transaction could not be saved. Please, try again.'));
            }
        }
        $users = $this->BookTransactions->Users->find('list', ['limit' => 200]);
        $books = $this->BookTransactions->Books->find('list', ['limit' => 200]);
        $this->set(compact('bookTransaction', 'users', 'books'));
        $this->set('_serialize', ['bookTransaction']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Book Transaction id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $bookTransaction = $this->BookTransactions->get($id);
        if ($this->BookTransactions->delete($bookTransaction)) {
            $this->Flash->success(__('The book transaction has been deleted.'));
        } else {
            $this->Flash->error(__('The book transaction could not be deleted. Please, try again.'));
        }
        return $this->redirect(['action' => 'index']);
    }
}
