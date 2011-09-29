# PHP API for Adcloud

This is a PHP client for the Adcloud public API. The description of
the API and all json schema definitions can be found 
[here](https://github.com/adcloud/api-json-schema).

# Example

<pre>
<?php

// Very very simple classloader
function __autoload($class) {
    require 'lib/' . str_replace('_', '/', $class) . '.php';
}

// Code and secret are the OAuth 2.0 (two-legged) credentials
// provided to you by Adcloud
$code = '0000000000000000000000000000000000000000';
$secret = '0000000000000000000000000000000000000000';

// Now we request the first entry of the advertiser report
// from 2011-09-09
$client = new Adcloud_Client($code, $secret);
$response = $client->request('reports/advertiser')
    ->addFilter('date', '2011-09-09')
    ->setPerPage(1)
    ->setPage(1)
    ->getResponse();

print_r($response);
</pre>

# Run tests

<pre>
phpunit
</pre>

# License

Copyright (c) 2011 Adcloud GmbH.
