<?php
require 'AbstractFormatChecker.php';
require 'Check.php';
require 'FormatChecker.php';


$fcheck = new FormatChecker(["name"=>"test"]);
$fcheck->addCheck('name', 'required|strlen_max:10');
$fcheck->addCheck('undefined', 'required');
try {
    $fcheck->runChecks();
} catch (\Throwable $th) {
    echo 'Message: ' . $th->getMessage();
    echo "\n";
    echo 'Error Code: ' . $th->getCode();
}