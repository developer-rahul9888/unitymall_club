<?php

$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => 'https://send.bulkgv.net/API/v1/gettoken',
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'GET',
  CURLOPT_HTTPHEADER => array(
    'username: ZVBPNPCHVMBUAQTZYOWPLTXVWXWYERDS',
    'password: ]soLj$si!x6IL![KP~rkQ^sXG^hT3yJS',
    'Authorization: Basic WlZCUE5QQ0hWTUJVQVFUWllPV1BMVFhWV1hXWUVSRFM6XXNvTGokc2kheDZJTCFbS1B+cmtRXnNYR15oVDN5SlM='
  ),
));

$response = curl_exec($curl);

curl_close($curl);
echo $response;

$response = json_decode($response,true);
echo '<pre>'; print_r($response);

/****
****
*** @ PHP AES-128-CBC class
*** @ Developed by Takis Maletsas
****
****/

class AES
{
    private $data, $key, $cipher, $mode, $IV;

    public function __construct()
    {
        $this->key = '6d66fb7debfd15bf716bb14752b9603b';
        $this->cipher =OPENSSL_RAW_DATA;
        $this->mode = 'aes-256-cbc';
        $this->IV = '716bb14752b9603b';
    }

    public function encrypt()
    {
        return trim(
            base64_encode(openssl_encrypt($this->data, $this->mode,$this->key, $this->cipher, $this->IV)));
    }

    public function decrypt()
    {
        return trim(
            openssl_decrypt(base64_decode($this->data),$this->mode, $this->key,$this->cipher,  $this->IV));
    }

    public function setData($data)
    {
        $this->data = $data;
    }

    public function setKey($key)
    {
        $this->key = $key;
    }

    public function setIV($IV)
    {
        $this->IV = $IV;
    }

    public function getKey()
    {
        return $this->key;
    }

    public function getIV()
    {
        return $this->IV;
    }
}

?>

<?php 

/****
****
*** @ PHP AES-128-CBC class
*** @ Developed by Takis Maletsas 
****
****/

//require "aes.class.php";

$aes = new AES;
$aes->setData($response['data']);

//$encrypted = $aes->encrypt();

//You can use setKey() and setIV() in the encryption process.
//If you don't, the class will produce random key and IV.
//You can get them with getKey() and getIV().

$aes->setKey('6d66fb7debfd15bf716bb14752b9603b');
$aes->setIV('716bb14752b9603b');
//$aes->setData($encrypted);

$decrypted = str_replace('"','',$aes->decrypt());

echo  "<br/>" . $decrypted;

//Encrypted: hibcqPrxD0rv2E5b5/LzYQ==
//Decrypted: Hello world !

?>

<?php

$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => 'https://send.bulkgv.net/API/v1/getbrands',
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'POST',
  
  CURLOPT_HTTPHEADER => array(
    'token: '.$decrypted,
    'Content-Type: application/json'
  ),
));

$response = curl_exec($curl);

curl_close($curl);
echo $response;
$response = json_decode($response,true);
echo '<pre>'; print_r($response);

$aes->setData($response['data']);
$decrypted = $aes->decrypt();
//$decrypted = str_replace('"','',$aes->decrypt());

//echo  "<br/>" . $decrypted;
$response = json_decode($decrypted,true);
echo '<pre>'; print_r($response);