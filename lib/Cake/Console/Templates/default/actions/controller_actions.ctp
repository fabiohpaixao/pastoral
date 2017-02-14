<?php
/**
 * Bake Template for Controller action generation.
 *
 * PHP 5
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       Cake.Console.Templates.default.actions
 * @since         CakePHP(tm) v 1.3
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */
?>

/**
 * médoto index
 *
 * @return void
 */
	public function index() {
		$this-><?php echo $currentModelName ?>->recursive = 0;
		$this->set('<?php echo $pluralName ?>', $this-><?php echo $currentModelName ?>->find('all'));
	}

/**
 * método visualizar
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function visualizar($id = null) {
		if (!$this-><?php echo $currentModelName; ?>->exists($id)) {
			throw new NotFoundException('<?php echo strtolower($singularHumanName); ?> inválido');
		}
		$options = array('conditions' => array('<?php echo $currentModelName; ?>.' . $this-><?php echo $currentModelName; ?>->primaryKey => $id));
		$this->set('<?php echo $singularName; ?>', $this-><?php echo $currentModelName; ?>->find('first', $options));
	}

<?php $compact = array(); ?>
/**
 * método adicionar
 *
 * @return void
 */
	public function adicionar() {
		if ($this->request->is('post')) {
			$this-><?php echo $currentModelName; ?>->create();
			if ($this-><?php echo $currentModelName; ?>->save($this->request->data)) {
<?php if ($wannaUseSession): ?>
				$this->Session->setFlash('<?php echo ucfirst($singularHumanName); ?> salvo com sucesso', 'Flash/sucesso');
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash('Ocorreu um erro ao tentar salvar, tente novamente', 'Flash/erro');
<?php else: ?>
				return $this->flash('<?php echo ucfirst($singularHumanName); ?> salvo com sucesso',  array('action' => 'index'));
<?php endif; ?>
			}
		}
<?php
	foreach (array('belongsTo', 'hasAndBelongsToMany') as $assoc):
		foreach ($modelObj->{$assoc} as $associationName => $relation):
			if (!empty($associationName)):
				$otherModelName = $this->_modelName($associationName);
				$otherPluralName = $this->_pluralName($associationName);
				echo "\t\t\${$otherPluralName} = \$this->{$currentModelName}->{$otherModelName}->find('list');\n";
				$compact[] = "'{$otherPluralName}'";
			endif;
		endforeach;
	endforeach;
	if (!empty($compact)):
		echo "\t\t\$this->set(compact(".join(', ', $compact)."));\n";
	endif;
?>
	}

<?php $compact = array(); ?>
/**
 * método editar
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function editar($id = null) {
		if (!$this-><?php echo $currentModelName; ?>->exists($id)) {
			throw new NotFoundException('<?php echo strtolower($singularHumanName); ?> inválido');
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this-><?php echo $currentModelName; ?>->save($this->request->data)) {
<?php if ($wannaUseSession): ?>
				$this->Session->setFlash('<?php echo ucfirst($singularHumanName); ?> salvo com sucesso', 'Flash/sucesso');
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash('Ocorreu um erro ao tentar salvar, tente novamente', 'Flash/erro');
<?php else: ?>
				return $this->flash('<?php echo ucfirst($singularHumanName); ?> salvo com sucesso', array('action' => 'index'));
<?php endif; ?>
			}
		} else {
			$options = array('conditions' => array('<?php echo $currentModelName; ?>.' . $this-><?php echo $currentModelName; ?>->primaryKey => $id));
			$this->request->data = $this-><?php echo $currentModelName; ?>->find('first', $options);
		}
<?php
		foreach (array('belongsTo', 'hasAndBelongsToMany') as $assoc):
			foreach ($modelObj->{$assoc} as $associationName => $relation):
				if (!empty($associationName)):
					$otherModelName = $this->_modelName($associationName);
					$otherPluralName = $this->_pluralName($associationName);
					echo "\t\t\${$otherPluralName} = \$this->{$currentModelName}->{$otherModelName}->find('list');\n";
					$compact[] = "'{$otherPluralName}'";
				endif;
			endforeach;
		endforeach;
		if (!empty($compact)):
			echo "\t\t\$this->set(compact(".join(', ', $compact)."));\n";
		endif;
	?>
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function excluir($id = null) {
		$this-><?php echo $currentModelName; ?>->id = $id;
		if (!$this-><?php echo $currentModelName; ?>->exists()) {
			throw new NotFoundException('<?php echo strtolower($singularHumanName); ?> inválido');
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this-><?php echo $currentModelName; ?>->delete()) {
<?php if ($wannaUseSession): ?>
			$this->Session->setFlash('<?php echo ucfirst($singularHumanName); ?> foi excluido com sucesso', 'Flash/sucesso');
		} else {
			$this->Session->setFlash('Ocorreu um erro ao tentar excluir, tente novamente', 'Flash/erro');
		}
		return $this->redirect(array('action' => 'index'));
<?php else: ?>
			return $this->flash('<?php echo ucfirst($singularHumanName); ?> excluido com sucesso', array('action' => 'index'));
		} else {
			return $this->flash('Ocorreu um erro ao tentar excluir, tente novamente', array('action' => 'index'));
		}
<?php endif; ?>
	}
