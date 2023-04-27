<?php

/**
 * STUKTUR FOLDER dari module ini sebagai berikut:
    src/
    ├── Exception/
    │   └── ProviderException.php
    ├── Provider/
    │   ├── AbstractProvider.php
    │   ├── Endpoint.php
    │   ├── RajaOngkir.php
    ├── Util/
    │   └── Request.php
    ├── PHPExpedisi.php
 */

namespace Ay4t\PHPExpedisi;


/**
 * Summary of PHPExpedisi
 */
class PHPExpedisi
{
   
   /**
    * Summary of providers
    * @var string
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
