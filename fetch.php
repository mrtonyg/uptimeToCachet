<?php
/**
 * Created by PhpStorm.
 * User: anthonygeorge
 * Date: 1/26/18
 * Time: 11:06 PM
 */
require_once 'vendor/autoload.php';
use Vdhicts\UptimeRobot\Client as uptimeClient;
use \DivineOmega\CachetPHP\Factories\CachetInstanceFactory;

$cachetendpoint = 'https://status.mediamanaged.com/api/v1/';
$uptimeendpoint = 'https://api.uptimerobot.com/v2/';
$cachettoken    = '1STdSGGSrkZFGuSduS2w';
$uptimetoken='u153423-9286d08940508b01e445abd9';


$cachetClient = CachetInstanceFactory::create($cachetendpoint, $cachettoken);

$uptimeConfig = new uptimeClient\Configuration($uptimetoken,$uptimeendpoint);
$uptimeClient = new uptimeClient\Client($uptimeConfig);

//Load Monitors from uptime
$response = $uptimeClient->perform('getMonitors',['limit'=>'50']);
//Load components from cachet
$cachetComponents = $cachetClient->getAllComponents();      // Components
$cachetIncidents = $cachetClient->getAllIncidents();        // Incidents
$cachetMetrics = $cachetClient->getAllMetrics();            // Metrics
$cachetMetricPoints = $metrics[0]->getAllMetricPoints();      // Metric Points
//, ['monitors' => '15830-32696-83920']);
//print $response;
//var_dump(json_decode($response, true));
