<?php

$start = microtime(true);
include_once("vendor/autoload.php");

use DWD\DWD;

DWD::update(); // Update warnings

//List all warnings
foreach(DWD::getWarnings() as $warning){
    echo "Warning for ".$warning->getRegion()."\n";
}
echo "\nTotal: ".count(DWD::getWarnings())." warnings\n\n";

//List all warnings that match "a"
$count = 0;
foreach(DWD::getWarning("a") as $warning){
    echo ++$count.": ".$warning->getRegion()." has a warning\n";
    echo "Starting at: ".date("d.m.Y H:i:s", $warning->getStartTime())."\n";
    echo "Event: ".$warning->getEvent()." (".$warning->getHeadline().")\n\n";
}

echo "The data is".(!DWD::isValid() ? " not" : "")." valid!\n";
echo "Running this took ".round(microtime(true) - $start, 2)."s!\n";