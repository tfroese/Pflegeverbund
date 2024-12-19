<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);


header("Content-Type: text/html; charset=UTF-8");

include('include/sendLeadImport.php');

$interface_password = '7huG9RFQkzGTKxGGUt6h8pf4Zy3Rq8a7dAbfuXWE';
$interface_brokercode = '1562c7dd6c0490759f9f47daf1d8383f';



// Default vaules
$lead_checked = 'Nein';
$lead_art = 'PG51';
$lead_lastname = 'X';
$lead_name = 'X';
$lead_zip = '22869';
$lead_location = 'Schenefeld';
$lead_email = 'tfroese@me.com';
$lead_birthday = '01.01.1900';
$lead_phone_private = '01624150818';
$lead_ref = htmlspecialchars($_SERVER['HTTP_REFERER']);

$lead_topic_free_consulting = 'TRUE';
$lead_topic_free_products = 'TRUE';
$lead_topic_housekeeping = 'TRUE';
$lead_topic_emergency_device = 'TRUE';

$lead_start_time = '01.01.2025';


$lead_target = 'others';
$lead_carelevel = '0';


if(isset($_POST['lead_name'])){
    $lead_name = htmlspecialchars($_POST['lead_name']);
}

if(isset($_POST['lead_lastname'])){
    $lead_lastname = htmlspecialchars($_POST['lead_lastname']);
}

if(isset($_POST['lead_zip'])){
    $lead_zip = htmlspecialchars($_POST['lead_zip']);
}

if(isset($_POST['lead_email'])){
    $lead_email = htmlspecialchars($_POST['lead_email']);
}

if(isset($_POST['lead_phone_private'])){
    $lead_phone_private = htmlspecialchars($_POST['lead_phone_private']);
}



if(isset($_POST['lead_target'])){
    $lead_target = htmlspecialchars($_POST['lead_target']);
}

if(isset($_POST['lead_carelevel'])){
    $lead_carelevel = htmlspecialchars($_POST['lead_carelevel']);
}



if(isset($_POST['lead_start_time'])){
    $lead_start_time = $_POST['lead_start_time'];
    $date = DateTime::createFromFormat('Y-m-d', $lead_start_time);
    $formatted_date = $date->format('d.m.Y');
    $lead_start_time = $formatted_date;
}



// Send request to API

if(isset($_POST['lead_topic_free_consulting'])){
    $lead_art = 'PFB';
    sendLeadImportRequest($lead_checked, $interface_password, $interface_brokercode, $lead_art, $lead_lastname, $lead_name, $lead_zip, $lead_location, $lead_email, $lead_phone_private, $lead_ref, $lead_target, $lead_carelevel, $lead_start_time);
}

if(isset($_POST['lead_topic_free_products'])){
    $lead_art = 'PFH';
    sendLeadImportRequest($lead_checked, $interface_password, $interface_brokercode, $lead_art, $lead_lastname, $lead_name, $lead_zip, $lead_location, $lead_email, $lead_phone_private, $lead_ref, $lead_target, $lead_carelevel, $lead_start_time);
}

if(isset($_POST['lead_topic_free_products'])){
    $lead_art = 'HAHI';
    sendLeadImportRequest($lead_checked, $interface_password, $interface_brokercode, $lead_art, $lead_lastname, $lead_name, $lead_zip, $lead_location, $lead_email, $lead_phone_private, $lead_ref, $lead_target, $lead_carelevel, $lead_start_time);
}

if(isset($_POST['lead_topic_emergency_device'])){
    $lead_art = 'HSN';
    sendLeadImportRequest($lead_checked, $interface_password, $interface_brokercode, $lead_art, $lead_lastname, $lead_name, $lead_zip, $lead_location, $lead_email, $lead_phone_private, $lead_ref, $lead_target, $lead_carelevel, $lead_start_time);
}


?>