<?php

namespace App\Traits;
use App\User;
use App\Sms;

trait SmsTrait {
/* common method  =============== start */
    
    //get designated users by depot or distributor
    private function getUsersByDesignations($designationIdArr,$depotId = null,$distributorId = null){
        if($depotId){
            return $data = User::select('users.id','users.name','users.mobile')
            ->join('depot_users', 'users.id','=' ,'depot_users.user_id')
            ->where('depot_users.depot_id',$depotId)
            ->whereIn('users.designation_id',$designationIdArr)
            ->get();
        }
        if($distributorId){
            return $data = User::select('users.id','users.name','users.mobile')
            ->join('distributor_users', 'users.id','=' ,'distributor_users.user_id')
            ->where('distributor_users.distributor_id',$distributorId)
            ->whereIn('users.designation_id',$designationIdArr)
            ->get();
        }
     
    }
    //if same messge send to multiple designated users
    private function smsForMultipleDesignations($obj,$message,$isDistributor=null){
        $arr = [];
        if($message->designations){
            $patterns = $this->messagePattern($obj);
            $msg = urlencode(preg_replace(array_keys($patterns), array_values($patterns), $message->message));
            if($isDistributor){
                $users = $this->getUsersByDesignations(json_decode($message->designations,true),null,$obj->distributor_id);
            }else{
                $users = $this->getUsersByDesignations(json_decode($message->designations,true),$obj->depot_id);
            }
            $i = 0;
            foreach ($users as $user){
                //dd($user->toArray());
                if($user->mobile){
                    $arr[$i][0] = $user->mobile;
                    $arr[$i][1] = $msg;
                    $arr[$i][2] = time().$i;//token
                    $i++;
                }
            }
        }
        return $arr;
    }
     
    private function messagePattern($obj){
        $patterns = [];
        foreach ($obj->toArray() as $ke => $vl){
            $pattern = '/<!--'.$ke.'-->/';
            $patterns[$pattern] = $vl;
        }
        return $patterns;
    }
    
/* common method  =============== end */
    
/* service module  =============== start */
    
    //when df problem entry then sms for team leader
    private function newComplainSMSForTeamleader($obj,$message){
        return $this->smsForMultipleDesignations($obj,$message);
    }
    
    
    //when df problem entry then sms for shop owner
    private function complainReceivedConfirmationSMSForShopOwner($obj,$message){
        $patterns = $this->messagePattern($obj);
        $msg = preg_replace(array_keys($patterns), array_values($patterns), $message->message);
        $arr = [];
        $arr[0][0] = $obj->mobile;
        $arr[0][1] = urlencode($msg);
        $arr[0][2] = time();//token
        return $arr;
    }
    //when assigned a technician for df problem
    private function complainSMSForAssignedTechnician($obj,$message){
        $patterns = $this->messagePattern($obj);
        $msg = urlencode(preg_replace(array_keys($patterns), array_values($patterns), $message->message));
        $arr = [];
        $arr[0][0] = $obj->technician_mobile;
        $arr[0][1] = $msg;
        $arr[0][2] = time();//token
        return $arr;
    }
    //complain or problem resolved sms for shop owner
    private function complainResolvedSMSForShopOwner($obj,$message){
        $patterns = $this->messagePattern($obj);
        $msg = preg_replace(array_keys($patterns), array_values($patterns), $message->message);
        $arr = [];
        $arr[0][0] = $obj->mobile;
        $arr[0][1] = urlencode($msg);
        $arr[0][2] = time();//token
        return $arr;
    }
    
    //complain or problem resolved sms for shop owner
    private function complainResolvedSMSForExecutive($obj,$message){
        $patterns = $this->messagePattern($obj);
        $msg = preg_replace(array_keys($patterns), array_values($patterns), $message->message);
        $arr = [];
        $arr[0][0] = $obj->sender_mobile;
        $arr[0][1] = urlencode($msg);
        $arr[0][2] = time();//token
        return $arr;
    }
    //send sms to shop owner for need to pull df
    private function needToPullSmsForShopOwner($obj,$message){
        $patterns = $this->messagePattern($obj);
        $msg = preg_replace(array_keys($patterns), array_values($patterns), $message->message);
        $arr = [];
        $arr[0][0] = $obj->mobile;
        $arr[0][1] = urlencode($msg);
        $arr[0][2] = time();//token
        return $arr;
    }
    
/* service module  =============== end */
    
/* requisition module  =============== start */
    //requisition cancel sms for executive
    private function requisitionCancelSMSForExecutive($obj,$message){
        $patterns = $this->messagePattern($obj);
        $msg = urlencode(preg_replace(array_keys($patterns), array_values($patterns), $message->message));
        $arr = [];
        $arr[0][0] = $obj->sender_mobile;
        $arr[0][1] = $msg;
        $arr[0][2] = time();//token
        return $arr;
    }
    //requisition hold sms for executive
    private function requisitionHoldSMSForExecutive($obj,$message){
        $patterns = $this->messagePattern($obj);
        $msg = urlencode(preg_replace(array_keys($patterns), array_values($patterns), $message->message));
        $arr = [];
        $arr[0][0] = $obj->sender_mobile;
        $arr[0][1] = $msg;
        $arr[0][2] = time();//token
        return $arr;
    }
    //requisition final approval sms for shop owner
    private function requisitionFinalApprovedSMSForShopOwner($obj,$message){
        $patterns = $this->messagePattern($obj);
        $msg = urlencode(preg_replace(array_keys($patterns), array_values($patterns), $message->message));
        $arr = [];
        $arr[0][0] = $obj->mobile;
        $arr[0][1] = $msg;
        $arr[0][2] = time();//token
        return $arr;
    }
    
    //requisition final approval sms for executive
    private function requisitionFinalApprovedSMSForExecutive($obj,$message){
        $patterns = $this->messagePattern($obj);
        $msg = urlencode(preg_replace(array_keys($patterns), array_values($patterns), $message->message));
        $arr = [];
        $arr[0][0] = $obj->sender_mobile;
        $arr[0][1] = $msg;
        $arr[0][2] = time();//token
        return $arr;
    }
    //if bkash payment is valid then  sms send to shop owner
    private function bkashPaymentConfirmationSMSShopOwner($obj,$message){
        $patterns = $this->messagePattern($obj);
        $msg = urlencode(preg_replace(array_keys($patterns), array_values($patterns), $message->message));
        $arr = [];
        $arr[0][0] = $obj->mobile;
        $arr[0][1] = $msg;
        $arr[0][2] = time();//token
        return $arr;
    }
/* requisition module  =============== end */
/* settlement colse    =============== start */
    //when pay to outlet
    private function payableConfirmationSMSForShopOwner($obj,$message){
        $arr = [];
        $i = 0;
        foreach ($obj as $shop){
            $patterns = $this->messagePattern($shop);
            $msg = urlencode(preg_replace(array_keys($patterns), array_values($patterns), $message->message));
            $arr[$i][0] = $shop->mobile;
            $arr[$i][1] = $msg;
            $arr[$i][2] = time().$i;//token
            $i++;
        }
       return $arr;
    }
    
    //when pay to outlet send sms to executive
    private function payableConfirmationSMSForExecutive($obj,$message){
        $arr = [];
        $i = 0;
        foreach ($obj as $shop){
            $patterns = $this->messagePattern($shop);
            $msg = urlencode(preg_replace(array_keys($patterns), array_values($patterns), $message->message));
            $arr[$i][0] = $shop->sender_mobile;
            $arr[$i][1] = $msg;
            $arr[$i][2] = time().$i;//token
            $i++;
        }
        return $arr;
    }
/* settlement colse    =============== start */
    
/* promotional sms ===================start */
    private function generatePromotionalSms($obj){
        $arr = [];
        $msg = urlencode($obj->message);
        $i = 0;
        foreach ($obj->receivers as $value){
                $arr[$i][0] = $value;//mobile no
                $arr[$i][1] = $msg;
                $arr[$i][2] = time().$i;//token
                $i++;
        }
        return $arr;
    }
/* promotional sms ===================end */
    private function generateSms($obj,$actionName){
        $messages = Sms::getMessage($actionName);
        $i = 0;
        $sms = [];
        foreach ($messages as $message){
            $fn = camel_case(studly_case($message->subject));
            $fnData = $this->$fn($obj,$message);
            if(count($fnData) > 0){
                foreach ($fnData as $data){
                    $sms[$i] =  $data;
                    $i++;
                }
            }
        }
        return $sms;
    }
    //main method for send sms to users
    protected function sendSms($obj,$actionName=null){
        if($actionName){
            $sms = $this->generateSms($obj,$actionName);
        }else{
            $sms =  $this->generatePromotionalSms($obj);
        }
        if(count($sms) > 0){
            if(env('APP_ENV') == 'local'){
              return [];  
            }
            
            $user = env('POLAR_SMS_USER'); 
            $pass = env('POLAR_SMS_PASS'); 
            $sid = env('POLAR_SMS_SID'); 
            $param = "user=$user&pass=$pass";
            foreach($sms as $key => $value){
                foreach ($value as $k => $vl){
                    $param .="&sms[$key][$k]=".$vl;
                }
            }
            $param .= "&sid=$sid";
            $url="http://sms.sslwireless.com/pushapi/dynamic/server.php"; 
            $crl = curl_init(); 
            curl_setopt($crl,CURLOPT_SSL_VERIFYPEER,FALSE); 
            curl_setopt($crl,CURLOPT_SSL_VERIFYHOST,2); 
            curl_setopt($crl,CURLOPT_URL,$url); 
            curl_setopt($crl,CURLOPT_HEADER,0); 
            curl_setopt($crl,CURLOPT_RETURNTRANSFER,1); 
            curl_setopt($crl,CURLOPT_POST,1); 
            curl_setopt($crl,CURLOPT_POSTFIELDS,$param); 
            $response = curl_exec($crl); 
            curl_close($crl); 
            
            if($response){
                $xml=simplexml_load_string($response,'SimpleXMLElement',LIBXML_NOCDATA) or die("Error: Cannot create object");
                $xmlToArr =  json_decode(json_encode($xml), TRUE);
                $bouncedMobileArr = [];
                if(!empty($xmlToArr['SMSINFO'])){
                    foreach ($xmlToArr['SMSINFO'] as $key => $value){
                        //when reponse multiple
                        if(is_array($value)){
                            if(empty($value['REFERENCEID'])){
                                $bouncedMobileArr[] = $value['MSISDN'];
                            }
                        }else{
                            //when reponse single
                            if(!array_key_exists('REFERENCEID',$xmlToArr['SMSINFO'])){
                                if($key == 'MSISDN'){
                                    $bouncedMobileArr[] = $value;
                                }
                            }
                        }
                    }
                    return $bouncedMobileArr;
                }else{
                    return 'fail';
                }
            }else{
                return 'fail';
            }
        }
    }
}
