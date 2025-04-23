<?php
declare(strict_types=1);

namespace App\Controller;

use App\Controller\AppController;

/**
 * Sales Controller
 *
 * @property \App\Model\Table\SalesTable $Sales
 * @property \App\Model\Table\FruitsTable $Fruits
 * @property \App\Model\Table\SaleItemsTable $SaleItems
 */
class SalesController extends AppController
{
    public function index()
    {
        $query = $this->Sales->find()
            ->contain(['Users'])
            ->order(['Sales.created' => 'DESC']); // Ordenar por data da venda

        // Verificar se o filtro de vendedor foi enviado
        if ($this->request->getQuery('vendedor_id')) {
            $query->where(['Sales.user_id' => $this->request->getQuery('vendedor_id')]);
        }

        // Verificar se as datas de início e fim foram enviadas
        if ($this->request->getQuery('data_inicio') && $this->request->getQuery('data_fim')) {
            $dataInicio = $this->request->getQuery('data_inicio');
            $dataFim = $this->request->getQuery('data_fim');
            $query->where([
                'Sales.created >=' => $dataInicio,
                'Sales.created <=' => $dataFim,
            ]);
        }

        $sales = $this->paginate($query);
        $vendedores = $this->Sales->Users->find('list', ['limit' => 200]);

        $this->set(compact('sales', 'vendedores'));
    }

    public function view($id = null)
    {
        $sale = $this->Sales->get($id, ['contain' => ['Users', 'SaleItems.Fruits']]);
        $this->set(compact('sale'));
    }

    public function add()
    {
        $sale = $this->Sales->newEmptyEntity();
        $total = 0;  // Inicializando o total

        // Buscando as frutas para o dropdown
        $fruits = $this->Sales->Fruits->find('list', ['keyField' => 'id', 'valueField' => 'name'])->toArray();

        if ($this->request->is('post')) {
            // Obtendo os dados enviados pelo formulário
            $data = $this->request->getData();
            
            // Verifica se o ID da fruta foi enviado corretamente
            if (empty($data['fruit_id'])) {
                $this->Flash->error(__('Selecione uma fruta.'));
                return;
            }

            $fruit = $this->Sales->Fruits->get($data['fruit_id']);  // Recupera a fruta selecionada
            $quantity = (int)$data['quantity'];
            $discount = (int)$data['discount'];

            // Verifica se a quantidade é válida
            if ($quantity <= 0) {
                $this->Flash->error(__('Quantidade inválida.'));
                return;
            }

            // Verifica o valor total com desconto
            $totalPrice = $fruit->price * $quantity; // Preço sem desconto
            $discountedPrice = $totalPrice * ((100 - $discount) / 100);  // Calculando o preço com desconto

            $total = $discountedPrice; // Atualiza o total com o preço descontado

            // Preenche os dados da venda
            $sale = $this->Sales->patchEntity($sale, $data);
            $sale->total = $total;  // Atualiza o valor total da venda

            // Salva a venda
            if ($this->Sales->save($sale)) {
                // Cria o item de venda
                $saleItem = $this->Sales->SaleItems->newEmptyEntity();
                $saleItem->sale_id = $sale->id;
                $saleItem->fruit_id = $fruit->id;
                $saleItem->quantity = $quantity;
                $saleItem->unit_price = $fruit->price;
                $saleItem->discount_percent = $discount;

                // Salva o item de venda
                if ($this->Sales->SaleItems->save($saleItem)) {
                    // Atualiza o estoque da fruta
                    $fruit->quantity -= $quantity;
                    if (!$this->Sales->Fruits->save($fruit)) {
                        $this->Flash->error(__('Erro ao atualizar o estoque da fruta.'));
                    }

                    $this->Flash->success(__('A venda foi registrada.'));
                    return $this->redirect(['action' => 'index']);
                } else {
                    $this->Flash->error(__('Erro ao salvar o item de venda.'));
                }
            } else {
                $this->Flash->error(__('A venda não pôde ser salva.'));
            }
        }

        // Passando as variáveis para a view
        $this->set(compact('sale', 'fruits', 'total'));
    }

    public function edit($id = null)
    {
        $sale = $this->Sales->get($id);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $sale = $this->Sales->patchEntity($sale, $this->request->getData());
            if ($this->Sales->save($sale)) {
                $this->Flash->success(__('A venda foi salva.'));
                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('A venda não pôde ser salva. Por favor, tente novamente.'));
        }
        $users = $this->Sales->Users->find('list', ['limit' => 200])->all();
        $this->set(compact('sale', 'users'));
    }

    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $sale = $this->Sales->get($id);
        if ($this->Sales->delete($sale)) {
            $this->Flash->success(__('A venda foi deletada.'));
        } else {
            $this->Flash->error(__('A venda não pôde ser deletada. Por favor, tente novamente.'));
        }

        return $this->redirect(['action' => 'index']);
    }

    public function vender()
    {
        $fruitsTable = $this->fetchTable('Fruits');
        $saleItemsTable = $this->fetchTable('SaleItems');

        // Buscar frutas para o dropdown
        $fruits = $fruitsTable->find('list', ['keyField' => 'id', 'valueField' => 'name'])->toArray();
        $total = 0; // Inicializa a variável total

        if ($this->request->is('post')) {
            $data = $this->request->getData();
            $fruit = $fruitsTable->get($data['fruit_id']);
            $quantity = (int)$data['quantity'];
            $discount = (int)$data['discount'];

            // Verifica se há estoque suficiente
            if ($fruit->quantity < $quantity) {
                $this->Flash->error('Estoque insuficiente.');
                return;
            }

            // Cálculo do valor total com desconto
            $totalPrice = $fruit->price * $quantity;
            $discountedPrice = $totalPrice * ((100 - $discount) / 100);

            // Atribui o valor final com desconto
            $total = $discountedPrice;

            // Cria a venda
            $sale = $this->Sales->newEmptyEntity();
            $sale->user_id = $this->request->getSession()->read('user.id');
            $sale->total = $total;

            if ($this->Sales->save($sale)) {
                // Cria o item de venda
                $saleItem = $saleItemsTable->newEmptyEntity();
                $saleItem->sale_id = $sale->id;
                $saleItem->fruit_id = $fruit->id;
                $saleItem->quantity = $quantity;
                $saleItem->unit_price = $fruit->price;
                $saleItem->discount_percent = $discount;
                $saleItemsTable->save($saleItem);

                // Atualiza o estoque da fruta
                $fruit->quantity -= $quantity;
                $fruitsTable->save($fruit);

                $this->Flash->success('Venda registrada com sucesso.');
                return $this->redirect(['action' => 'index']);
            }

            $this->Flash->error('Erro ao registrar a venda.');
        }

        // Passando as frutas e o total para a view
        $this->set(compact('fruits', 'total'));
    }
}
