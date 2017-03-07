<?php

class Membro extends ActiveRecord\Model {

	static $validates_presence_of = array(
		array('nome'), array('telefone'));
}


