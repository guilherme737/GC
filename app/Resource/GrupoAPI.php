<?php
namespace SlimRest\Resource;

use \SlimRest\Resource as Resource;

class GrupoAPI extends Resource {

	public function routes(){
		
		$this->get('/grupo', [$this, 'obterTodos']);
		
		$this->get("/grupo/{id}", [$this, 'obterPorId']);		
		
		$this->post("/grupo", [$this, 'inserir']);
		
		$this->put("/grupo/{id}", [$this, 'atualizar']);
		
		$this->delete("/grupo/{id}", [$this, 'excluir']);
	}

	public function obterTodos($req, $res, $args){

		$grupos = \Grupo::find('all');
	
		return $this->respond($res, \Grupo::collection_to_array());
	}

	public function obterPorId($req, $res, $args) {

		$grupo = \Grupo::find($id);

		return $this->respond($res, $grupo->to_json());
	}

	public function inserir($req, $res, $args){

		$grupo = new Grupo();

		$grupo->save();

		return $this->respond($res, ['state' => false]);
	}

	public function atualizar($req, $res, $args) {

		$grupo = \Grupo::find($id);


		// some code...

		$grupo->save();

	}

	public function excluir($req, $res, $args) {

		$grupo = \Grupo::find($id);

		$grupo->delete();
	}

}