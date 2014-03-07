<?php

/*
Include Fat Free Framework
*/
$f3 = require('../lib/base.php');

/*
Include configuration files
Setup
Routes and maps
Database
*/
$f3->config('../config/setup.cfg');
$f3->config('../config/routesmaps.cfg');
$f3->config('../config/db.cfg');

/*
Run Fat Free Framework
*/
$f3->run();

/*
Destroy the database object
*/
unset($db);

?>