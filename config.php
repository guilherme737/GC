<?php
	// this returns the configuration to database
	return [
		"database" => [
			"connections" => array(
				"development" => "mysql://root:@localhost/celula",
				"test" => "mysql://root:@localhost/celula",
				"primary" => "mysql://root:@localhost/celula"
			) ,
			"models_dir" => "app/Model"
		]
	];
