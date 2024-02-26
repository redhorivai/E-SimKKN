<?php
namespace App\Libraries\RequestApi;

class RequestApi
{
    function xpostrequestImageAPI($url, $datapost)
    {
        $arrheader =  array(
            'Accept: application/json',
            'Content-Type: Application/x-www-form-urlencoded'
        );

        $session = curl_init($url);
        curl_setopt($session, CURLOPT_HTTPHEADER, $arrheader);
        curl_setopt($session, CURLOPT_POST, 1);
        curl_setopt($session, CURLOPT_POSTFIELDS, $datapost);
        curl_setopt($session, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($session, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($session, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($session, CURLOPT_SSL_CIPHER_LIST, 'DEFAULT@SECLEVEL=1');
        $response = curl_exec($session);
        return $response;
    }

    function xrequestAPI($url)
    {
        $session = curl_init($url);
        $arrheader =  array(
            'Content-Type:application/json',
        );
        curl_setopt($session, CURLOPT_HTTPHEADER, $arrheader);
        curl_setopt($session, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($session, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($session, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($session, CURLOPT_SSL_CIPHER_LIST, 'DEFAULT@SECLEVEL=1');
        $response = curl_exec($session);
        return $response;
    }

    function xpostrequestAPI($url, $datapost)
    {
        $arrheader =  array(
            'Accept: application/json',
            'Content-Type: Application/x-www-form-urlencoded'
        );

        $session = curl_init($url);
        curl_setopt($session, CURLOPT_HTTPHEADER, $arrheader);
        curl_setopt($session, CURLOPT_POST, 1);
        curl_setopt($session, CURLOPT_POSTFIELDS, implode($datapost));
        curl_setopt($session, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($session, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($session, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($session, CURLOPT_SSL_CIPHER_LIST, 'DEFAULT@SECLEVEL=1');
        $response = curl_exec($session);
        return $response;
    }

}
?>