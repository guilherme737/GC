<?php

class Membro extends ActiveRecord\Model {

	static $table_name = "membro";

	static $validates_presence_of = array(
		array('nome'), array('telefone'));
}


