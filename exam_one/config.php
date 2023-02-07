<?php

session_start();

define('DS', DIRECTORY_SEPARATOR);
define('BR', "<br>");
define('ROOT_PATH', buildRootPath());


function buildRootPath(): string
{
  // Build root path

  // $current_file = basename(__FILE__); // config.php
  $schema = $_SERVER['REQUEST_SCHEME'] . '://'; // http://
  $host = $_SERVER['HTTP_HOST'] . '/'; // localhost:portnumber

  $rootPath = $_SERVER['DOCUMENT_ROOT'];
  $thisPath = dirname($_SERVER['PHP_SELF']);
  $onlyPath = str_replace($rootPath, '', $thisPath);

  $path_arry = array_values(array_diff(explode('/', $onlyPath), ['']));

  $current_dir = [];

  for ($i = 0; $i < count($path_arry); $i++) {

    $flag = false;

    if ($path_arry[$i] === 'exam_one') {
      $flag = true;
    }
    $current_dir[] = $path_arry[$i];

    if ($flag) {
      break;
    }
  }

  $current_dir = implode('/', $current_dir);

  return $schema . $host . $current_dir;
}
