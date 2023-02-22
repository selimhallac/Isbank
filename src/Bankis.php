<?php
/*
Class İş Bank
@author Selim Hallaç
@blog selimhallac.com
*/
namespace Phpdev;

Class Isbank
{
    
    
    public $username = "";
    public $pasword = "";
    
    function __construct($username, $password)
    {
        $this->username       = $username;
        $this->password       = $password;
    }
    
    
    public function hesap_hareketleri()
    {
        
        try {

            $curl = curl_init();
            curl_setopt_array($curl, array(
                CURLOPT_URL => "https://posmatik2.isbank.com.tr/Authenticate.aspx",
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => "",
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 30,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => "POST",
                CURLOPT_POSTFIELDS => array('uid' => $this->username,'pwd' => $this->password),
            ));
        
            $response = curl_exec($curl);
            $err = curl_error($curl);
            curl_close($curl);
        
            @$objectarray =simplexml_load_string($response);
            // İşlem başarılı
            if ( isset($objectarray->Tarih)){
                    $res['statu'] = true;
                    $res['response'] = $objectarray;
                    echo json_encode($res);
        
            } else {
                $res['statu'] = false;
                $res['response'] = $response;
                echo json_encode($res);
            }
            // İşlem başarılı
        
        } catch (Throwable $e) {
            $res['statu'] = false;
            $res['response'] = 'Bağlantı problemi oluştu.';
            echo json_encode($res);
        }

    }
    
    
}
