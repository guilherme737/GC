<?php
namespace SlimRest\Resource;

use \SlimRest\Resource as Resource;

class GrupoAPI extends Resource {

	public function routes(){
		
		$this->get('/grupo', [$this, 'obterTodos']);
		
		$this->get("/grupo/{id}", [$this, 'obterPorId']);		
		
		$this->post("/grupo", [$this, 'inserir']);
		
		//$this->patch("/grupo/{id}", [$this, 'atualizar']);
		
		$this->delete("/grupo/{id}", [$this, 'excluir']);
	}

	public function obterTodos($req, $res, $args){

		$grupos = \Grupo::find('all');
		//$membros  = \Membro::model()->findAll();

		/*
		$json = array_map(function($res){
		  return $res->to_json();
		}, $membros);
		*/

		//var_dump($json);



		return $this->respond($res, \Grupo::collection_to_array());
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