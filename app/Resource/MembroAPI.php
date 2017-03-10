<?php
namespace SlimRest\Resource;

use \SlimRest\Resource as Resource;

class MembroAPI extends Resource {

	public function routes(){
		
		$this->get('/membro', [$this, 'obterTodos']);
		
		$this->get("/membro/{id}", [$this, 'obterPorId']);		
		
		$this->post("/membro", [$this, 'inserir']);
		
		//$this->patch("/membro/{id}", [$this, 'atualizar']);
		
		$this->delete("/membro/{id}", [$this, 'excluir']);
	}

	public function obterTodos($req, $res, $args){

		$membros = \Membro::find('all');
		//$membros  = \Membro::model()->findAll();

		/*
		$json = array_map(function($res){
		  return $res->to_json();
		}, $membros);
		*/

		//var_dump($json);

		//print_r($this->app);

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