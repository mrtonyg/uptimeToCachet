<?php
/**
 * Created by PhpStorm.
 * User: anthonygeorge
 * Date: 1/26/18
 * Time: 11:06 PM
 */
require_once 'vendor/autoload.php';
use Vdhicts\UptimeRobot\Client;
// Load the configuration once, the URL is optional
$configuration = new Client\Configuration('u153423-9286d08940508b01e445abd9');
//, 'OPTIONAL_API_URL');
// Start the client once
$client = new Client\Client($configuration);
// Perform the request, returns a string for further processing
$response = $client->perform('getMonitors',['limit'=>'50']);
//, ['monitors' => '15830-32696-83920']);
print $response;
var_dump(json_decode($response, true));
