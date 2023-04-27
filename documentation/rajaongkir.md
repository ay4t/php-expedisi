# Integrasi dengan RajaOngkir
RajaOngkir memiliki data ongkos kirim yang terpadu. Sehingga Anda cukup sekali saja menginputkan tujuan pengiriman, maka ongkir dari seluruh kurir akan muncul.
# Requirement
- ApiKey RajaOngkir
- Akun starter / basic / PRO lebih bagus

# Contoh Penggunaan
Pertama Anda harus instansiasi class dan properti seperti dibawah ini:
```
$apiKey     = 'your_api_key';

$expedisi   = new Ay4t\PHPExpedisi\PHPExpedisi('RajaOngkir');
$providers  = $expedisi->providers;
$providers->setTipeAkun('pro');
$providers->setApiKey($apiKey);
```
kemudian tinggal menambahkan beberapa fungsi yang dibutuhkan. Contoh get all province
```
$getProvince    = $providers->province();
echo '<pre>';
print_r($providers->getResult());
echo '</pre>';
```
contoh get provinsi dengan ID tertentu
```
$getProvince    = $providers->province(15);
echo '<pre>';
print_r($providers->getResult());
echo '</pre>';
```
contoh get all city
```
$getCity    = $providers->city();
```
contoh get city dengan ID tertentu
```
$getCity    = $providers->city(39);
```

contoh get subdistrict
```
$getSubdistrict    = $providers->subdistrict( $city = 39 );
```

contoh untuk get cost
```
$getCost    = $providers->cost([
    'origin'            => 537, // ID kota/kabupaten asal
    'originType'        => 'subdistrict', // tipe origin ( city / subdistrict )
    'destinationType'   => 'subdistrict', // tipe destination ( city / subdistrict )
    'destination'       => 574, // ID kota/kabupaten tujuan
    'weight'            => 1700, // berat barang dalam gram
    'courier'           => 'jne:tiki:pos', // kode kurir pengantar ( jne / tiki / pos )
]);
```
contoh get currency
```
$getCurrency    = $providers->currency();
```
contoh get waybill
```
$getWaybill    = $providers->waybill([
    'waybill'   => '003098519675',
    'courier'   => 'sicepat'
]);
```