<?php
namespace SlimRest\Resource;

use \SlimRest\Resource as Resource;

class MembroAPI extends Resource {

	public function routes(){
		$this->get('/membro', [$this, 'obterPorId']);
		$this->post('/membro', [$this, 'inserir']);
	}

	public function obterPorId($req, $res, $args){

		// $membros = Membro::find('all',array('conditions' => array()));
		$membro  = \Membro::find_by_nome('Guilherme');

		return $this->respond($res, $membro);
	}

	public function inserir($req, $res, $args){
		return $this->respond($res, ['state' => false]);
	}

}