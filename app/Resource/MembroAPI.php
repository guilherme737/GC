<?php
namespace SlimRest\Resource;

use \SlimRest\Resource as Resource;

class MembroAPI extends Resource {

	public function routes(){
		$this->get('/membro', [$this, 'obterPorId']);
		$this->post('/membro', [$this, 'inserir']);
	}

	public function obterPorId($req, $res, $args){

		$membros = \Membro::find('all');
		//$membros  = \Membro::model()->findAll();

		$json = array_map(function($res){
		  return $res->to_json();
		}, $membros);

		//var_dump($json);



		return $this->respond($res, $json);
	}

	public function inserir($req, $res, $args){
		return $this->respond($res, ['state' => false]);
	}

}