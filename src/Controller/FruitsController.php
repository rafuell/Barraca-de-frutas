<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * Fruits Controller
 *
 * @property \App\Model\Table\FruitsTable $Fruits
 */
class FruitsController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $query = $this->Fruits->find();
        $fruits = $this->paginate($query);

        $this->set(compact('fruits'));
    }

    /**
     * View method
     *
     * @param string|null $id Fruit id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $fruit = $this->Fruits->get($id, contain: ['SaleItems']);
        $this->set(compact('fruit'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $fruit = $this->Fruits->newEmptyEntity();
        if ($this->request->is('post')) {
            $fruit = $this->Fruits->patchEntity($fruit, $this->request->getData());
            if ($this->Fruits->save($fruit)) {
                $this->Flash->success(__('The fruit has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The fruit could not be saved. Please, try again.'));
        }
        $this->set(compact('fruit'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Fruit id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $fruit = $this->Fruits->get($id, contain: []);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $fruit = $this->Fruits->patchEntity($fruit, $this->request->getData());
            if ($this->Fruits->save($fruit)) {
                $this->Flash->success(__('The fruit has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The fruit could not be saved. Please, try again.'));
        }
        $this->set(compact('fruit'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Fruit id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $fruit = $this->Fruits->get($id);
        if ($this->Fruits->delete($fruit)) {
            $this->Flash->success(__('The fruit has been deleted.'));
        } else {
            $this->Flash->error(__('The fruit could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
