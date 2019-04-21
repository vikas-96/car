<?php

$config = [
	'frmManu' => [
		[
            'field' => 'mname',
            'label' => 'manufacturer name',
            'rules' => 'trim|required|callback_NameValidation|is_unique[manufacturer.manufacturer_name]|xss_clean'
        ],
	],
	'frmModel' => [
		[
			'field' => 'modelname',
            'label' => 'model name',
            'rules' => 'trim|required|xss_clean'
		],
		[
			'field' => 'manufacturer',
            'label' => 'manufacturer',
            'rules' => 'trim|required'
		],
		[
			'field' => 'color',
            'label' => 'color',
            'rules' => 'trim|required|callback_NameValidation|xss_clean'
		],
		[
			'field' => 'year',
            'label' => 'year',
            'rules' => 'trim|required|min_length[4]|max_length[4]|xss_clean'
		],
		[
			'field' => 'Rnumber',
            'label' => 'Registration number',
            'rules' => 'trim|required|xss_clean'
		],
		[
			'field' => 'note',
            'label' => 'Note',
            'rules' => 'trim|required|xss_clean'
		],
	]
];

?>