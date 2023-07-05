<?php
include_once('../model/controller.php');
session_start();
session_destroy();
header('location: ../');


?>