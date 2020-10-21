<?php
$config	=	array(
			'admin_login'	=>	array(
								array(	'field'	=>	'email',
										'label'	=>	'Email',
										'rules'	=>	'trim|required|valid_email'
									),
								array(	'field'	=>	'password',
										'label'	=>	'Password',
										'rules'	=>	'required'
									)
							)
			);