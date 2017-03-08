<?php

$config = [];

$dbopts = parse_url(getenv('DATABASE_URL'));

$connectionParams = array(
    'dbname' => ltrim($dbopts["path"],'/'),
    'user' => $dbopts["user"],
    'password' => $dbopts["pass"],
    'host' => $dbopts["host"],
    'driver' => 'pdo_'.$dbopts['scheme'],
);

$config['db'] = $connectionParams;
