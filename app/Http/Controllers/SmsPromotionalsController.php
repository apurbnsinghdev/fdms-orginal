<?php

namespace App\Http\Controllers;

use App\Depot;
use App\Designation;
use App\SmsPromotional;
use App\User;
use App\Traits\SmsTrait;
use Illuminate\Http\Request;
use App\Shop;

class SmsPromotionalsController extends Controller
{
    use SmsTrait;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($param = 'sales_team') {
        return view('sms_promotionals.index',compact('param'));
    }
    
    private function convertBanglatoUnicode($BanglaText) { 
        $unicodeBanglaTextForSms = strtoupper(bin2hex(iconv('UTF-8', 'UCS-2BE', $BanglaText))); 
        return $unicodeBanglaTextForSms; 
    }
    
    private function depotUsersByDesignation($depotArr=[],$designationArr=[]){
        $users = User::join('depot_users','depot_users.user_id','=','users.id')
        ->whereIn('depot_users.depot_id',$depotArr)
        ->whereIn('users.designation_id',$designationArr)
        ->whereNotNull('users.mobile')
        ->groupBy('users.mobile')
        ->pluck('users.mobile');
        return $users;
       
    }
    private function shopsOrDistributorsByDepot($depotArr=[],$type,$condArr=[]){
        $shopObj = Shop::whereIn('depot_id',$depotArr)
                        ->whereNotNull('mobile')
                        ->groupBy('mobile');
                       //for distirbutor
                      if($type == 'distributor'){
                          $shopObj->where('status','active')
                          ->where('is_distributor',1);
                      }
                      //for shop
                      if($type == 'shop'){
                          if(count($condArr) > 1){
                              //only active shop
                              $shopObj->where('status','active')
                              ->whereNotNull('distributor_id');
                          }else{
                              if($condArr[0] == 1){
                                  //only currently injected shop
                                  $shopObj->join('settlements','settlements.shop_id','=','shops.id')
                                  ->whereIn('settlements.status',['continue','reserve']);
                              }else{
                                  //only active shop
                                  $shopObj->where('status','active')
                                  ->whereNotNull('distributor_id');
                              }
                          }
                          
                      }
          return $shopObj->pluck('mobile');
    }
     
    private function sendSmsToSalesTeam($request,$param,$from){
        $request->validate([
            'subject' => 'required',
            'depots' => 'required',
            'receiver_group' => 'required',
            'message' => 'required|max:320',
        ]);
        $data = $request->except('_token');
        
        $data['depots'] = json_encode($data['depots']);
        $data['receiver_group'] = json_encode($data['receiver_group']);
        return $this->saveData($data,$param);
         
    }
    private function sendSmsToDistributors($request,$param,$from){
        $request->validate([
            'subject' => 'required',
            'depots' => 'required',
            'message' => 'required|max:320',
        ]);
        $data = $request->except('_token');
        $data['depots'] = json_encode($data['depots']);
        return $this->saveData($data,$param);
    }
    private function sendSmsToOutlets($request,$param,$from){
        $request->validate([
            'subject' => 'required',
            'depots' => 'required',
            'receiver_group' => 'required',
            'message' => 'required|max:320',
        ]);
        $data = $request->except('_token');
          
        $data['depots'] = json_encode($data['depots']);
        $data['receiver_group'] = json_encode($data['receiver_group']);
        return $this->saveData($data,$param,$from);
      
    }
    
    private function saveData($data,$param,$from="send"){
        $data['user_id'] = auth()->id();
        $data['type'] = $param;
        $query = SmsPromotional::create($data);
        if($query){
            $receiverObj = collect([]);
            $depotArr = json_decode($query->depots,true);
            if($param == 'distributors'){
                $receiverObj = $this->shopsOrDistributorsByDepot($depotArr,'distributor');
            }elseif ($param == 'outlets'){
                $receiverObj = $this->shopsOrDistributorsByDepot($depotArr,'shop',json_decode($query->receiver_group,true));
            }elseif($param == 'sales_team'){
                $receiverObj = $this->depotUsersByDesignation($depotArr,json_decode($query->receiver_group,true));
            }
            if($receiverObj->count()){
                $successCounter = 0;
                $chunkedSmsObj = $receiverObj->chunk(5000);
                $chunkedSmsObjLength = $chunkedSmsObj->count();
                foreach($chunkedSmsObj as $smsObj){
                    $smsObj = (object)['receivers'=>$smsObj];
                    $smsObj->message = $query->message;
                    $messageResponse = $this->sendSms($smsObj);
                    if(is_array($messageResponse)){
                        $successCounter++;
                    }
                }
               
                if($chunkedSmsObjLength == $successCounter){
                    $message = "Message send successfully";
                    $route = 'smsPromotionals.index';
                    $messageTyp = 'flash_success';
                }else{
                    if($successCounter > 0){
                        $message = "Some message could not be send";
                        $route = 'smsPromotionals.index';
                        $messageTyp = 'flash_danger';
                    }else{
                        $message = "Message could not be send";
                        $route = 'smsPromotionals.index';
                        $messageTyp = 'flash_danger';
                    }
                    
                }
            }else{
                $message = "You have no available receiver";
                $route = 'smsPromotionals.index';
                $messageTyp = 'flash_danger';
            }
            
        }else{
            $message = "Something wrong!! Please try again";
            if($from == 'resend'){
                $route = 'smsPromotionals.resend';
            }else{
                $route = 'smsPromotionals.send';
            }
           
            $messageTyp = 'flash_danger';
        }
        return redirect()->route($route, [$param])
        ->with($messageTyp, $message);
    }
    public function send(Request $request, $param) {
        if ($request->isMethod('post')) {
            $method = 'sendSmsTo'.ucwords(studly_case($param));
            return $this->$method($request,$param,'send');
        }
        $depots = Depot :: pluck('name','id');
        $designations = collect([]);
        if($param == 'sales_team'){
            $designations = Designation::where('status','active')->pluck('short_name','id');
        }
        
        return view('sms_promotionals.send',compact('param','depots','designations'));
    }
    public function reSend(Request $request, $id) {
        $smsPromotional = SmsPromotional::findOrFail($id);
        if ($request->isMethod('post')) {
           $method = 'sendSmsTo'.ucwords(studly_case($smsPromotional->type));
            return $this->$method($request,$smsPromotional->type,'resend');
        }
        $depots = Depot :: pluck('name','id');
        $designations = collect([]);
        if($smsPromotional->type == 'sales_team'){
            $designations = Designation::where('status','active')->pluck('short_name','id');
        }
        
        return view('sms_promotionals.resend',compact('smsPromotional','depots','designations'));
    }
}
