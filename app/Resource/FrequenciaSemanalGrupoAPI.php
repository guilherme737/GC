<?php
namespace SlimRest\Resource;

use \SlimRest\Resource as Resource;

class FrequenciaSemanalGrupoAPI extends Resource {

	private $_BASE_FUNC = "/frequencia-semanal-grupo"


	public function routes(){

		$this->get($_BASE_FUNC, [$this, 'obterTodos']);
		
		$this->get($_BASE_FUNC."/{id}", [$this, 'obterPorId']);		
		
		$this->post($_BASE_FUNC, [$this, 'inserir']);
		
		//$this->patch("/membro/{id}", [$this, 'atualizar']);
		
		$this->delete($_BASE_FUNC."/{id}", [$this, 'excluir']);
	}

	public function obterTodos($req, $res, $args){


		$membros = \Membro::find('all');
		

		return $this->respond($res, \Membro::collection_to_array());
		
	}

	public function obterPorId($req, $res, $args) {

	}

	public function inserir($req, $res, $args){
		return $this->respond($res, ['state' => false]);
	}

	public function atualizar($req, $res, $args) {

	}

	public function excluir($req, $res, $args) {

	}

}