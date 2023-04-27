<?php

// show php errors
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once __DIR__ . '/../vendor/autoload.php';

$apiKey     = 'your_api_key';

$expedisi   = new Ay4t\PHPExpedisi\PHPExpedisi('RajaOngkir');
$providers  = $expedisi->providers;
$providers->setTipeAkun('pro');
$providers->setApiKey($apiKey);

// contoh get all province
$getProvince    = $providers->province();

// contoh get province dengan ID tertentu
// $getProvince    = $providers->province(15);

// contoh get all city
// $getCity    = $providers->city();

// contoh get city dengan ID tertentu
// $getCity    = $providers->city(39);

// contoh get subdistrict
// $getSubdistrict    = $providers->subdistrict( $city = 39 );

// contoh untuk get cost
/* $getCost    = $providers->cost([
    'origin'            => 537, // ID kota/kabupaten asal
    'originType'        => 'subdistrict', // tipe origin ( city / subdistrict )
    'destinationType'   => 'subdistrict', // tipe destination ( city / subdistrict )
    'destination'       => 574, // ID kota/kabupaten tujuan
    'weight'            => 1700, // berat barang dalam gram
    'courier'           => 'jne:tiki:pos', // kode kurir pengantar ( jne / tiki / pos )
]); */


// contoh get currency
// $getCurrency    = $providers->currency();

// contoh get waybill
/* $getWaybill    = $providers->waybill([
    'waybill'   => '003098519675',
    'courier'   => 'sicepat'
]); */

echo '<pre>';
print_r($providers->getResult());
echo '</pre>';