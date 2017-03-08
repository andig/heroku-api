<?php

use Symfony\Component\HttpFoundation\Request;

$config = [];

// database

$dbopts = parse_url(getenv('DATABASE_URL'));

$connectionParams = [
    'dbname' => ltrim($dbopts["path"],'/'),
    'user' => $dbopts["user"],
    'password' => $dbopts["pass"],
    'host' => $dbopts["host"],
    'driver' => 'pdo_'.$dbopts['scheme'],
];

$config['db'] = $connectionParams;


// trusted proxies

$proxies = [$_SERVER['REMOTE_ADDR']];

Request::setTrustedProxies($proxies);
$config['proxies'] = $proxies;
