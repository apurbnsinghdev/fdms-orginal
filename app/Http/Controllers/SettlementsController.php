<?php

namespace App\Http\Controllers;

use App\Settlement;
use App\Traits\SmsTrait;
use Illuminate\Http\Request;

class SettlementsController extends Controller {
    use SmsTrait;
    
	public function continueSettlementList($param = 'without_rent') {
		return view('settlements.continue_list', compact('param'));
	}

	public function closedSettlementList($param = 'payable') {
		return view('settlements.closed_list', compact('param'));
	}

	public function payToOutlet(Request $request) {
		$ids = $request->get('id');
		if ($ids) {
		 foreach ($ids as $ke => $val) {
				Settlement::where('id', $val)->update(
					[
						'paid_amount' => \DB::raw('payable_amount'),
						'paid_date' => \Carbon\Carbon::now(),
						'payable_amount' => 0,
					]
				);
			} 
			
			//payable sms for show owner
			$dataForSms = Settlement::join('shops','shops.id','=','settlements.shop_id')
			->join('items','items.id','=','settlements.item_id')
			->join('distributor_users','distributor_users.distributor_id','=','shops.distributor_id')
			->join('users','users.id','=','distributor_users.user_id')
			->join('roles','roles.id','=','users.role_id')
			->whereIn('settlements.id',$ids)
			->where('roles.can_apply',1)
			->whereNotNull('shops.mobile')
			->select('shops.proprietor_name','shops.outlet_name','shops.mobile','items.serial_no as df_code','settlements.paid_amount','users.name as sender','users.mobile as sender_mobile')
			->get();
			
			$outLetDataObj= $dataForSms->unique(function($item){
			    return $item['mobile'].$item['df_code'];
			});
			 //sms send to shop owner
		     $this->sendSms($outLetDataObj, 'payToOutlet');
		     
		     //sms send to executive
		     $this->sendSms($dataForSms, 'payToOutlet_executive');
			 
			return redirect()->route('settlements.closedList', ['paid'])->with('flash_success', 'Successfully paid');
		} else {
			return redirect()->route('settlements.closedList', ['payable'])->with('flash_danger', 'No Outlet is selected.');
		}

	}

	public function downloadMoneyReceipt($id) {
		$datas = Settlement::select('settlements.*', 'shops.outlet_name','distributors.outlet_name as distributor_name', 'shops.address', 'items.serial_no','depots.name','sizes.name as size')
			->join('shops', 'shops.id', '=', 'settlements.shop_id')
			->join('depots', 'depots.id', '=', 'shops.depot_id')
			->join('shops as distributors', 'distributors.id', '=', 'shops.distributor_id')
			->join('items', 'items.id', '=', 'settlements.item_id')
			->join('sizes', 'sizes.id', '=', 'items.size_id')
			->find($id);

		//https://packagist.org/packages/barryvdh/laravel-dompdf
		$pdf = \domPDF::loadView('pdf.payable_money_receipt', compact('datas'));
		//return view('pdf.gate_pass', compact('reqisition', 'item'));
		return $pdf->download('payable_money_receipt-' . $id . '.pdf');
	}

}
