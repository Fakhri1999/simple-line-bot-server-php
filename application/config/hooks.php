<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$hook['pre_system'] = function () {
	$dotenv = Dotenv\Dotenv::create(FCPATH);
	$dotenv->overload();
	log_message('INFO', 'Environment successfully loaded');
};