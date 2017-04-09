<?php

    /**
     * config.php
     *
     * CantinhoPet
     * Configure pages.
     */
    //header('Content-Type: text/html; charset=utf-8');

    // display errors, warnings, and notices
    ini_set("display_errors", true);
    error_reporting(E_ALL);
    
    // Set default timezone
    date_default_timezone_set('America/Bahia');

    // requirements
    require("helpers.php");

    // Start session
    session_start();

    // Require Default Library
	include("messages.php");
	include("strings.php");
	include("datetime.php");
	include("validation.php");

    // GC Library
    require(__DIR__ . "/../vendor/gc.php");
    GC::init(__DIR__ . "/../config.json");
?>