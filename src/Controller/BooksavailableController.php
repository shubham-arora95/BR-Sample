<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Booksavailable Controller
 *
 * @property \App\Model\Table\BooksavailableTable $Booksavailable
 */
class BooksavailableController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
        $booksavailable = $this->paginate($this->Booksavailable);

        $this->set(compact('booksavailable'));
        $this->set('_serialize', ['booksavailable']);
    }

    /**
     * View method
     *
     * @param string|null $id Booksavailable id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $booksavailable = $this->Booksavailable->get($id, [
            'contain' => []
        ]);

        $this->set('booksavailable', $booksavailable);
        $this->set('_serialize', ['booksavailable']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $booksavailable = $this->Booksavailable->newEntity();
        if ($this->request->is('post')) {
            $booksavailable = $this->Booksavailable->patchEntity($booksavailable, $this->request->data);
            if ($this->Booksavailable->save($booksavailable)) {
                $this->Flash->success(__('The booksavailable has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The booksavailable could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('booksavailable'));
        $this->set('_serialize', ['booksavailable']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Booksavailable id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $booksavailable = $this->Booksavailable->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $booksavailable = $this->Booksavailable->patchEntity($booksavailable, $this->request->data);
            if ($this->Booksavailable->save($booksavailable)) {
                $this->Flash->success(__('The booksavailable has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The booksavailable could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('booksavailable'));
        $this->set('_serialize', ['booksavailable']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Booksavailable id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $booksavailable = $this->Booksavailable->get($id);
        if ($this->Booksavailable->delete($booksavailable)) {
            $this->Flash->success(__('The booksavailable has been deleted.'));
        } else {
            $this->Flash->error(__('The booksavailable could not be deleted. Please, try again.'));
        }
        return $this->redirect(['action' => 'index']);
    }
}
