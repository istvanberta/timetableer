<?php

// Step 1. - Load the config file.
$config = include('config.php');
if (!$config) {
    exit("Can't load the config file!");
}

// Step 2. - Connect to the DB.
$connection = mysqli_connect(
    $config['db_host'],
    $config['db_user'],
    $config['db_pass'],
    $config['db_name']
);
if (!$connection) {
    exit("Can't connect to database!");
}

// Step 3. - Create tables.
$query = file_get_contents('db_schema.sql');
if (!mysqli_multi_query($connection, $query)) {
    exit("Can't create table!");
}

// Step 4. - Success.
echo 'Setup successfull!';