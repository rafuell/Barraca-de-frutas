<?php
declare(strict_types=1);

namespace App\Controller;

use Cake\Controller\Controller;

/**
 * Application Controller
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @link https://book.cakephp.org/5/en/controllers.html#the-app-controller
 */
class AppController extends Controller
{
    /**
     * Initialization hook method.
     *
     * Use this method to add common initialization code like loading components.
     *
     * e.g. `$this->loadComponent('FormProtection');`
     *
     * @return void
     */
    public function initialize(): void
    {
        parent::initialize();

        $this->loadComponent('Flash');
    }

    public function beforeFilter(\Cake\Event\EventInterface $event)
    {
        parent::beforeFilter($event);

        // Permitir acesso a login e add sem necessidade de login
        $allowedActions = ['login', 'add']; // Adicione 'add' aqui

        if (!in_array($this->request->getParam('action'), $allowedActions)) {
            $session = $this->request->getSession();
            if (!$session->check('user')) {
                // Se não estiver logado, redireciona para login
                return $this->redirect(['controller' => 'Users', 'action' => 'login']);
            }
        }
    }
}
