<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * Users Controller
 *
 * @property \App\Model\Table\UsersTable $Users
 */
class UsersController extends AppController
{
    // Remover o redirecionamento automático de login aqui
    // public function beforeFilter(\Cake\Event\EventInterface $event)
    // {
    //     parent::beforeFilter($event);
    //     $allowed = ['login', 'logout', 'add'];

    //     $currentAction = $this->request->getParam('action');

    //     if (!in_array($currentAction, $allowed)) {
    //         $user = $this->request->getSession()->read('user');

    //         if (!$user) {
    //             $this->Flash->error('Você precisa estar logado para acessar esta página.');
    //             return $this->redirect(['action' => 'login']);
    //         }
    //     }
    // }

    public function login()
    {
        if ($this->request->is('post')) {
            $email = $this->request->getData('email');
            $password = $this->request->getData('password');

            $user = $this->Users->find()
                ->where(['email' => $email])
                ->first();

            if ($user && password_verify($password, $user->password)) {
                $this->request->getSession()->write('user', $user);
                $this->Flash->success('Login realizado com sucesso!');

                if ($user->role === 'admin') {
                    return $this->redirect(['controller' => 'Fruits', 'action' => 'index']);
                } else {
                    return $this->redirect(['controller' => 'Sales', 'action' => 'index']);
                }
            }

            $this->Flash->error('Email ou senha inválidos.');
        }
    }

    public function logout()
    {
        $this->request->getSession()->destroy();
        $this->Flash->success('Você saiu do sistema.');
        return $this->redirect(['action' => 'login']);
    }

    public function index()
    {
        $query = $this->Users->find();
        $users = $this->paginate($query);

        $this->set(compact('users'));
    }

    public function view($id = null)
    {
        $user = $this->Users->get($id, contain: []);
        $this->set(compact('user'));
    }

    public function add()
    {
        $user = $this->Users->newEmptyEntity();

        if ($this->request->is('post')) {
            $data = $this->request->getData();
            $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT); // Hash da senha
            $user = $this->Users->patchEntity($user, $data);

            if ($this->Users->save($user)) {
                $this->Flash->success(__('Usuário criado com sucesso.'));
                
                // Crie a sessão do usuário diretamente após a criação
                $this->request->getSession()->write('user', $user);
                
                // Redirecione para a página de acordo com o tipo de usuário
                if ($user->role === 'admin') {
                    return $this->redirect(['controller' => 'Fruits', 'action' => 'index']);
                } else {
                    return $this->redirect(['controller' => 'Sales', 'action' => 'index']);
                }
            }

            $this->Flash->error(__('Erro ao salvar o usuário.'));
        }

        $this->set(compact('user'));
    }

    public function edit($id = null)
    {
        $user = $this->Users->get($id, contain: []);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $user = $this->Users->patchEntity($user, $this->request->getData());
            if ($this->Users->save($user)) {
                $this->Flash->success(__('Usuário atualizado com sucesso.'));
                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('Erro ao atualizar o usuário.'));
        }
        $this->set(compact('user'));
    }

    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $user = $this->Users->get($id);
        if ($this->Users->delete($user)) {
            $this->Flash->success(__('Usuário excluído com sucesso.'));
        } else {
            $this->Flash->error(__('Erro ao excluir o usuário.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
