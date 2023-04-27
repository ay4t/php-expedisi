<?php

/**
 * STUKTUR FOLDER dari module ini sebagai berikut:
 *  src//
 *  ├── Exception/
 *  │   └── ProviderException.php
 *  ├── Interfaces/
 *  │   └── ProviderInterface.php
 *  ├── Provider/
 *  │   ├── AbstractProvider.php
 *  │   └── RajaOngkir.php
 *  ├── Util/
 *  │   ├── Endpoint.php
 *  │   └── Request.php
 *  └── Vendor.php
 */

namespace Ay4t\PHPExpedisi;


/**
 * Summary of PHPExpedisi
 */
class Vendor
{
   
   /**
    * Summary of providers
    * @var \Ay4t\PHPExpedisi\Provider\AbstractProvider
    */
   public $providers;

   /**
 * __construct
   *
   * @return parent::__construct()
   */
   public function __construct(string $providers = 'RajaOngkir' )
   {

      try {
         
         $className  = '\Ay4t\PHPExpedisi\Provider\\' . $providers;
         $this->providers = new $className();

      } catch (\Throwable $th) {
         
         throw new \Exception("Class {$providers} not found", 1);
         
      }

   }
}
