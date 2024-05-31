<?php

namespace App\Traits;
 

trait BkashTrait {
    
    private $bkashReturnMessageArr = [
        '0000'=>'Transaction Successful',
        '0010'=>'Transaction is pending, please try again later.',
        '0011'=>'Transaction is pending, please try again later.',
        '0100'=>'Transaction ID is valid but transaction has been reversed.',
        '0111'=>'Transaction is failed.',
        '1001'=>'Invalid MSISDN input. Try with correct mobile no.',
        '1002'=>'Invalid transaction ID.',
        '1003'=>'Authorization Error, please contact site admin.',
        '1004'=>'Transaction ID not found.',
        '2000'=>'Access denied. User does not have access to this module.',
        '2001'=>'Access denied. User date time request is exceeded of the defined limit.',
        '3000'=>'Missing required mandatory fields for this module',
        '9999'=>'System error, could not process request. Please contact site admin.' 
    ];
    
    /**
     * Bkash api base url.
     *
     * @var string
     */
        private $base_url = 'https://www.bkashcluster.com:9081/dreamwave/merchant/trxcheck/sendmsg';
        
        
    /**
     * @param array $data
     */
    protected function callBkashApi($arr)
    {
        $headers = array('Content-Type: application/json');    
        $data = [
            'user' => env('POLAR_BKASH_USER'),
            'pass' => env('POLAR_BKASH_PASS'),
            'msisdn' => env('POLAR_BKASH_MSISDN')
        ];
        
        $data = array_merge($data,$arr);
       // return http_build_query(json_encode($data));
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $this->base_url);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec($ch);
        
        if (curl_error($ch)) {
            $error_msg = curl_error($ch);
        }
        
        curl_close($ch);
       if(isset($error_msg)){
           return json_decode($error_msg,true);
        }
        
       return json_decode($response,true);
    }
    
  
    
}
