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

// NOTE to create the schema run
// heroku run php misc/tools/doctrine orm:schema-tool:update --force

// trusted proxies

if (isset($_SERVER['REMOTE_ADDR'])) {
	$proxies = [$_SERVER['REMOTE_ADDR']];

	$config['proxies'] = $proxies;

	// Request::setTrustedProxies($proxies);
	Request::setTrustedHeaderName(Request::HEADER_FORWARDED, null);
	Request::setTrustedHeaderName(Request::HEADER_CLIENT_HOST, null);
}

// firewall

$config['firewall'] = array(
	[	// always allow /auth - this is required
		'path'		=> '/auth',
		'methods'	=> 'POST',
		'action'	=> 'allow'
	],
	[	// always allow GET - makes read access public
		'methods'	=> 'GET',
		'action'	=> 'allow'
	],
	[	// authorize all other requests
		'action'	=> 'auth'
	]
);
