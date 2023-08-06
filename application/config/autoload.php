<?php
defined('BASEPATH') or exit('No direct script access allowed');

$autoload['packages'] = array();
$autoload['libraries'] = array('database', 'session', 'form_validation', 'email', 'curl');
$autoload['drivers'] = array();
$autoload['helper'] = array('url', 'form', 'file', 'site', 'andy', 'string');
$autoload['config'] = array();
$autoload['language'] = array();
$autoload['model'] = array('Menu_model', 'mydb');
