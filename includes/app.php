<?php 
// app.php

// Incluyes los archivos de configuración y funciones
require_once 'funciones.php';
require_once 'config/database.php';
require_once __DIR__ . '/../vendor/autoload.php';

// Intentas conectarte a la base de datos
$db = conectarDB();

// Usa el objeto $db para verificar la conexión

use Model\ActiveRecord;

ActiveRecord::setDB($db);