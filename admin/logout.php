<?php
require_once("../utils/helper.php");
session_start();
session_destroy();

redirect('../login/');
