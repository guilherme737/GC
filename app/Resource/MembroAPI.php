<?php
namespace SlimRest\Resource;

use \SlimRest\Resource as Resource;

class MembroAPI extends Resource {

	public function routes(){

		$this->get('/membro', [$this, 'obterTodos']);
		
		$this->get("/membro/{id}", [$this, 'obterPorId']);		
		
		$this->post("/membro", [$this, 'inserir']);
		
		$this->put("/membro/{id}", [$this, 'atualizar']);
		
		$this->delete("/membro/{id}", [$this, 'excluir']);
	}

	public function obterTodos($req, $res, $args){

		$membros = \Membro::find('all');

		/*
		$json = array_map(function($res){
		  return $res->to_json();
		}, $membros);
		*/

		return $this->respond($res, \Membro::collection_to_array());
	}

	public function obterPorId($req, $res, $args) {

		$membro = \Membro::find($id);

		return $this->respond($res, $membro->to_json());
	}

	public function inserir($req, $res, $args){

		//$membro =  obter membro do request

		$membro = new Membro();

		$membro->save();

		return $this->respond($res, ['state' => false]);
	}

	public function atualizar($req, $res, $args) {

		$membro = \Membro::find($id);


		// some code...

		$membro->save();

	}

	public function excluir($req, $res, $args) {

		$membro = \Membro::find($id);

		$membro->delete();
	}

}