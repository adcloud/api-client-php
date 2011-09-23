<?php

function autoloader($class) 
{
	require str_replace('_', '/', $class) . '.php';
}

spl_autoload_register('autoloader');

set_include_path(
  dirname(__FILE__) . '/../lib/'. PATH_SEPARATOR 
  . get_include_path()
);

