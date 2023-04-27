<?php

namespace Ay4t\PHPExpedisi\Provider;

class RajaOngkir extends AbstractProvider
{
    /**
     * @var string
     * starter, basic, pro
     */
    protected $tipeAkun = 'pro';

    private $tipeAkunLists = ['starter', 'basic', 'pro'];

    private $params = [];

    /**
    * __construct
    *
    * @return parent::__construct()
    */
    public function __construct()
    {
        // jika this->tipeAkun tidak berada pada list
        if (!in_array($this->tipeAkun, $this->tipeAkunLists)) {
            throw new \Exception("Tipe akun tidak valid", 1);
        }

        // list base url berdasarkan tipe akun
        $baseUrlLists = [
            'starter' => 'https://api.rajaongkir.com/starter',
            'basic' => 'https://api.rajaongkir.com/basic',
            'pro' => 'https://pro.rajaongkir.com/api',
        ];

        // set base url
        $baseUrl = $baseUrlLists[$this->tipeAkun];
        $this->setBaseUrl($baseUrl);
    }

    /**
     * Province
     * Method "province" digunakan untuk mendapatkan daftar propinsi yang ada di Indonesia.
     */
    public function province( string $id = null ) {
        if( $id ){ $this->params['id'] = $id; }
        return $this->request('/province', 'GET', $this->params);
    }

    /**
     * City
     * Method "city" digunakan untuk mendapatkan daftar kota/kabupaten yang ada di Indonesia.
     */
    public function city( string $id = null ){
        if( $id ){ $this->params['id'] = $id; }
        return $this->request('/city', 'GET', $this->params);
    }

    /**
     * Subdistrict
     * Method "subdistrict" digunakan untuk mendapatkan daftar kecamatan yang ada di Indonesia.
     */
    public function subdistrict( string $city, string $id = null ){
        if( $id ){ $this->params['id'] = $id; }
        $this->params['city'] = $city;
        return $this->request('/subdistrict', 'GET', $this->params);
    }

    /**
     * Cost
     * Method “cost” digunakan untuk mengetahui tarif pengiriman (ongkos kirim) dari dan ke kecamatan tujuan tertentu dengan berat tertentu pula.
     */
    public function cost( array $params ){
        $originTypeList         = ['city', 'subdistrict'];
        $destinationTypeList    = ['city', 'subdistrict'];
        $required_field = [
            'origin',
            'originType',
            'destination',
            'destinationType',
            'weight',
            'courier'
        ];

        // validate params required
        foreach ($required_field as $field) {
            if (!isset($params[$field])) {
                throw new \Exception("Field {$field} is required", 1);
            }
        }

        // validate originType
        if (!in_array($params['originType'], $originTypeList)) {
            throw new \Exception("Origin type is not valid", 1);
        }

        // validate destinationType
        if (!in_array($params['destinationType'], $destinationTypeList)) {
            throw new \Exception("Destination type is not valid", 1);
        }
        
        return $this->setQueryType('form_params')
            ->request('/cost', 'POST', $params);
    }

    /**
     * Waybill
     * Method “waybill” untuk digunakan melacak/mengetahui status pengiriman berdasarkan nomor resi.
     */
    public function waybill( array $params ){
        $required_field = [
            'waybill',
            'courier'
        ];

        // validate params required
        foreach ($required_field as $field) {
            if (!isset($params[$field])) {
                throw new \Exception("Field {$field} is required", 1);
            }
        }
        
        return $this->setQueryType('form_params')
            ->request('/waybill', 'POST', $params);
    }

    /**
     * Currency
     * Method "currency" digunakan untuk mendapatkan informasi nilai tukar rupiah terhadap US dollar.
     */
    public function currency(){
        return $this->request('/currency', 'GET');
    }
    

    // getResult
    public function getResult()
    {
        $result     = $this->result;
        
        if (isset($result->rajaongkir->results)) {
            return $result->rajaongkir->results;
        }

        if (isset($result->rajaongkir->result)) {
            return $result->rajaongkir->result;
        }

        if(isset($result->rajaongkir->status->code)){
            // jika code == 400
            if($result->rajaongkir->status->code == 400){
                return $result->rajaongkir->status->description;
            }
        }

        return $this->result;
    }

	/**
	 * 
	 * @param string $tipeAkun 
	 * @return self
	 */
	public function setTipeAkun($tipeAkun): self {
		$this->tipeAkun = $tipeAkun;
		return $this;
	}
}
