<?php
App::uses('AppController', 'Controller');
/**
 * Posts Controller
 *
 */
class ClientesController extends AppController {

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
        $this->Cliente->recursive = 0;
        $this->set('clientes', $this->Cliente->find('all'));
    }

/**
 * adicionar method
 *
 * @return void
 */
    public function adicionar() {
        if ($this->request->is('post')) {

            //cria post
            $this->Post->create();

            //dados adicionais
            $this->Post->set('criado', null);
            
            $slug = $this->Create_slug($this->request->data['Post']['titulo']);
            $this->Post->set('slug', $slug);

            if($this->request->data['Post']['status'] == 'Agendado'){

                // fix formato da data
                $publicar = date('Y-m-d h:i:s', strtotime( str_replace('/', '-', $this->request->data['Post']['publicar'])));
                $finalizar = date('Y-m-d h:i:s', strtotime( str_replace('/', '-', $this->request->data['Post']['finalizar'])));

                $this->request->data['Post']['publicar']  = $publicar;
                $this->request->data['Post']['finalizar'] = $finalizar;
               
            }

            $usuario = $this->Auth->user();
            $this->Post->set('usuario_id',  $usuario['id']);

            if ($this->Post->save($this->request->data)) {

                $this->Session->setFlash(__('Post adicionado com sucesso'), 'Flash/sucesso');
                return $this->redirect(array('action' => 'index'));

            }else
                $this->Session->setFlash('Ocorreu um erro ao tentar salvar o post, tente novamente', 'Flash/erro');

        }

        $status = array(
            'Rascunho' => 'Rascunho',
            'Agendado' => 'Agendado',
            'Publicado' => 'Publicado'
        );
        $this->set('status', $status);

        $categorias = $this->Post->Categoria->find('list',
            array('fields' =>
                array( 'Categoria.nome')
            )
        );

        $this->set('categoriasDisponiveis', json_encode($categorias));

       // print_r($categorias); exit();

        // $comentarios = $this->Post->Comentarios->find('list',
        //     array(
        //         'conditions' => array(
        //             'NOT' => array('Grupo.nome' => 'Kadmin')
        //         ),
        //          'fields' => array(
        //             'Grupo.id',
        //             'Grupo.nome'
        //         )
        //     )
        // );
        // $this->set(compact('categorias'));
    }


}
