<?php
App::uses('AppController', 'Controller');
/**
 * Categorias Controller
 *
 */
class OrcamentosController extends AppController {


/**
 * Scaffold
 *
 * @var mixed
 */
	public $scaffold;

/**
 * index method
 *
 * @return void
 */
    public function index() {
        $this->Orcamento->recursive = 2;
        // $orcamentos = $this->Orcamento->find('all');
        // debug($orcamentos);exit();
       $this->set('orcamentos', $this->Orcamento->find('all'));
    }

/**
 * add method
 *
 * @return void
 */
    public function adicionar() {

        if ($this->request->is('post')) {

            //cria grupo
            $this->Orcamento->create();

            if ($this->Orcamento->save($this->request->data)) {

                $this->Session->setFlash('Orçamento adicionada com sucesso', 'Flash/sucesso');
                return $this->redirect(array('action' => 'index'));

            }else
                $this->Session->setFlash('Ocorreu um erro ao tentar salvar o orçamento, tente novamente', 'Flash/erro');

        }
        // Lista clientes
        $clientes = $this->Orcamento->Cliente->find('list');
        $this->set('clientes', $clientes);

        // Lista despesas
        $despesas_all = $this->Orcamento->Despesa->find('all', array('recursive' => -1, 'fields' => array('Despesa.id AS value', 'Despesa.valor AS data-price', 'Despesa.titulo AS name')));
        foreach ($despesas_all as $key => $value) {
            $despesas[] = $value['Despesa'];
        }
        $this->set('despesas', $despesas);
       // debug($despesas);die();

        // Lista especialidades
        $especialidades_all = $this->Orcamento->Especialidade->find('all', array('recursive' => -1, 'fields' => array('Especialidade.id AS value', 'Especialidade.valor AS data-price', 'Especialidade.titulo AS name')));
        
        foreach ($especialidades_all as $key => $value) {
            $especialidades[] = $value['Especialidade'];
        }
        // debug($especialidades);
        $this->set('especialidades', $especialidades);

             
        // Lista Materiais
        $materiais_all = $this->Orcamento->MaterialDistribuidor->find('all', array('recursive' => -1, 'fields' => array('MaterialDistribuidor.id AS value', 'MaterialDistribuidor.valor AS data-price', 'MaterialDistribuidor.titulo AS name')));;

        foreach ($materiais_all as $key => $value) {
            $materiais[] = $value['MaterialDistribuidor'];
        }
         // debug($materiais);exit();

        $this->set('materiais', $materiais);

    }


/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
    public function editar($id = null) {
        if (!$this->Orcamento->exists($id)) {
            throw new NotFoundException(__('Orçamento inválido'));
        }

        $this->Orcamento->id = $id;

        if ($this->request->is(array('post', 'put'))) {

            if ($this->Orcamento->save($this->request->data)) {
                $this->Session->setFlash(__('Orçamento salvo com sucesso'), 'Flash/sucesso');
                return $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('Não foi possivel salvar o orçamento, tente novamente'),  'Flash/erro');
            }
        } else {
            $options = array('conditions' => array('Orcamento.' . $this->Orcamento->primaryKey => $id));
            $this->request->data = $this->Orcamento->find('first', $options);
            $this->set('orcamento', $this->Orcamento->find('first', $options));

            // Lista clientes
            $clientes = $this->Orcamento->Cliente->find('list');
            $this->set('clientes', $clientes);

            // Lista despesas
            $despesas = $this->Orcamento->Despesa->find('list');
            $this->set('despesas', $despesas);

            // Lista especialidades
            $especialidades = $this->Orcamento->Especialidade->find('list');
            $this->set('especialidades', $especialidades);
           
            // Lista Materiais
            $materiais_all = $this->Orcamento->MaterialDistribuidor->find('all');
            // var_dump($materiais_all);exit();

            $materiais=array();
            foreach ($materiais_all as $key => $value) {
                $materiais[$value['MaterialDistribuidor']['id']] = $value['Material']['titulo'] . '-' . $value['Distribuidor']['nome'];
            }

            $this->set('materiais', $materiais);
        }
    }

}
