<?php

require 'vendor/autoload.php';

$config = require_once 'config.php';
$kong = new Kong\Kong($config['option']);

$project = [
    'service_name' => 'dj-agency',
    'route_name' => 'dj-agency-r',
    'upstream_name' => 'dj-agency-up',
    'host' => ['agency.winbet888.net'],
    'target' => '127.0.0.1:7007'
];

project($kong, $project);
function project(Kong\Kong $kong, $project){
    $ret = $kong->createProject($project);
    if ($ret === false) {
        echo $kong->getErr();
    } else {
        echo 'project create success';
    }
}


//$kong->deleteUpstream($project['upstream_name']);


//echo $kong->addCertificate($cert['crt'], $cert['key']);

//echo $kong->addTarget($project['target'], $project['upstream_name']);

//$kong->initCertificate($config['cert']);

//$kong->addSni('api.winbet888.net', '');

//$kong->initPlugin();