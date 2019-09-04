<?php
/**
 * Created by PhpStorm.
 * User: CHARLY
 * Date: 07/04/2019
 * Time: 10:34 PM
 */
session_start();

error_reporting(E_ALL);
//


include_once '../config/config.php';
include_once '../lib/util.php';




$_PATH = explode('/',$_GET{'url'});
$_PATH[1] = $_PATH[1]?$_PATH[1]:'index';

include_once $_PATH[0].'_controller.php';






?>
