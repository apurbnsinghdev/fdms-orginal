<?php

namespace App\Http\Controllers;
use App\ComplainType;
use App\DamageType;
use App\DfProblem;
use App\Item;
use App\Shop;
use App\Technician;
use App\Traits\DamageApplicationTrait;
use App\Traits\SmsTrait;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

class ServicesController extends Controller {
	use DamageApplicationTrait, SmsTrait;
	private function problemEntryStore($request) {
		$data = $request->except(['sender', 'problem_type_ids']);
		$sender = $request->only('sender');
		$problemTypeIds = $request->only('problem_type_ids');

		if (empty($problemTypeIds)) {
			$message = "Problem type could not be empty.";
			return redirect()->back()->with('flash_danger', $message);
		}

		$dfProblemObj = new DfProblem;
		// if ($data['df_code'] !== 'personal') {
		// 	//check application is pending or not
		// 	if ($dfProblemObj->where('df_code', $data['df_code'])->whereIn('status', ['pending', 'processing'])->exists()) {
		// 		$message = "One application is pending";
		// 		return redirect()->route('services.problemEntry', [])
		// 			->with('flash_danger', $message);
		// 	}
		// }

		$today = Carbon::today();
		$maxDailySerial = (int) $dfProblemObj->whereDate('created_at', $today->format('Y-m-d'))
			->max('daily_serial') + 1;
		$data['daily_serial'] = str_pad($maxDailySerial, 3, '0', STR_PAD_LEFT);
		$data['token'] = $today->format('ymd') . $data['daily_serial'];
		$data['user_id'] = auth()->user()->id;

		if ($data['df_code'] == 'personal') {
			if (!empty($data['distributor_id'])) {
				$distributorRegionId = Shop::where('id', $data['distributor_id'])->value('region_id');
				$data['region_id'] = $distributorRegionId;
			}
		}

		$query = $dfProblemObj->create($data);
		if ($query) {
			$complainsData = [];
			foreach ($problemTypeIds['problem_type_ids'] as $key => $value) {
				$complainsData[$key]['problem_type_id'] = $value;
				$complainsData[$key]['df_problem_id'] = $query->id;
			}
			ComplainType::insert($complainsData);
			//sms send to show owner and team leader
			$dataForSms = DfProblem::dfProblemForSms($query->id);
			$dataForSms->setAttribute('sender', $sender['sender']);
			$returnDataArr = $this->sendSms($dataForSms, 'problemEntry');

			$message = "You have successfully created";
			return redirect()->route('services.problemEntryList', ['new'])
				->with('flash_success', $message);

		} else {
			$message = "Something wrong!! Please try again";
			return redirect()->route('services.problemEntry', [])
				->with('flash_danger', $message);
		}

	}

	private function problemEntryUpdate($request, $id) {
		$data = $request->except('_method', '_token', 'office_copy', 'claim_copy', 'submit');
		$buttons = $request->only('submit');
		$dfproblems = DfProblem::dfProblemById($id);
		$oldItemId = $dfproblems->item_id;
		$support = $dfproblems->support;
		//if problem is complete
		$saveData = [];
		$isComplete = false;
		$fildName = [];
		//problem solve
		if ($buttons['submit'] == 'complete') {
			$isComplete = true;
			$validationOptions['work_description'] = 'required|max:150';
			$validationOptions['done_date'] = 'required|date';
			$saveData = $data;
			$saveData['status'] = 'completed';
			$fileRequest = $request->file();

			if (isset($data['old_office_copy']) && !$data['old_office_copy']) {
				$validationOptions['office_copy'] = 'required|mimes:jpeg|max:1024';
			}
			unset($saveData['old_office_copy']);
			if (isset($data['old_claim_copy']) && !$data['old_claim_copy']) {
				$validationOptions['claim_copy'] = 'required|mimes:jpeg|max:1024';
			}
			unset($saveData['old_claim_copy']);
			if (!empty($fileRequest['office_copy'])) {
				$validationOptions['office_copy'] = 'mimes:jpeg|max:1024';
				$fildName['office_copy'] = 'office_copy';
			}

			if (!empty($fileRequest['claim_copy'])) {
				$validationOptions['claim_copy'] = 'mimes:jpeg|max:1024';
				$fildName['claim_copy'] = 'claim_copy';
			}
		}
		$supportItemUpdate = $pullDfGatepass = $supportDfGatepass = false;
		if ($buttons['submit'] == 'processing') {
			$saveData['pull'] = 1;
			$validationOptions['attain_date'] = 'required|date';
			if (!empty($data['support'])) {
				$validationOptions['item_id'] = 'required';
				$saveData['item_id'] = $data['item_id'];
				if (!$support) {
					$saveData['support'] = 1;
				}
				$supportItemUpdate = true;
			}
		}

		if ($buttons['submit'] == 'support_df_gatepass') {
			$validationOptions['item_id'] = 'required';
			$saveData['item_id'] = $data['item_id'];
			$saveData['support'] = 2;
			$supportItemUpdate = true;
			$supportDfGatepass = true;
		}
		if ($buttons['submit'] == 'pull_df_gatepass') {
			$validationOptions['done_date'] = 'required|date';
			$saveData['pull'] = 3;
			$saveData['done_date'] = $data['done_date'];
			$pullDfGatepass = true;
		}
		$sendToInsip = false;
		if ($buttons['submit'] == 'office_copy' || $buttons['submit'] == 'claim_copy') {
			$validationOptions[$buttons['submit']] = 'required|mimes:jpeg|max:1024';
			$fildName[$buttons['submit']] = $buttons['submit'];
			if ($buttons['submit'] == 'office_copy') {
				$saveData['pull'] = 2;
				$sendToInsip = true;
			}
		}
		if (!$dfproblems->attain_date) {
			$validationOptions['attain_date'] = 'required|date';
			$saveData['attain_date'] = $data['attain_date'];
		}
		$request->validate($validationOptions);
		if (!empty($fildName)) {
			foreach ($fildName as $key => $value) {
				$upload = $request->file($value);
				//$upload->storeAs('images/problems', $value . '-' . $id . '.jpg');

				$directory = '../public' . DIRECTORY_SEPARATOR . 'storage' . DIRECTORY_SEPARATOR . 'images' . DIRECTORY_SEPARATOR . 'problems' . DIRECTORY_SEPARATOR;
				$imageUrl = $directory . $value . '-' . $id . '.jpg';
				Image::make($upload)->resize(500, 800)->save($imageUrl);

			}
		}
		//update problem
		$dfProblemUpdate = DfProblem::where('id', $id)->update($saveData);
		if ($dfProblemUpdate) {
			//assigned support DF reserve for problem's item
			if ($supportItemUpdate) {
				if ($oldItemId != $data['item_id']) {
					//old assigned support df will be free
					Item::itemUpdate(['item_status' => null], ['id' => $oldItemId]);
					//assigned new support df
					Item::itemUpdate(['shop_id' => $dfproblems->shop_id, 'item_status' => 'reserved'], ['id' => $data['item_id']]);
				}
			}
			//send to in_sip if DF Pulled
			if ($sendToInsip && $dfproblems->df_code != 'personal') {
				Item::itemUpdate(['item_status' => 'in_sip'], ['serial_no' => $dfproblems->df_code]);
			}
			//if generate gatepass for pull df
			if ($pullDfGatepass) {
				//gatepass pdf download
				return $this->generateGatepass($id, 'pull');
			}
			//if generate gatepass for support df
			if ($supportDfGatepass) {
				Item::itemUpdate(['shop_id' => $dfproblems->shop_id, 'item_status' => 'continue'], ['id' => $data['item_id']]);
				//gatepass pdf download
				return $this->generateGatepass($id, 'support');
			}

			$message = "Successfully Updated.";
			if ($isComplete) {
				//when status is complete then item will be continue
				if ($dfproblems->df_code != 'personal') {
					Item::itemUpdate(['item_status' => 'continue'], ['serial_no' => $dfproblems->df_code]);
				}
				//send sms for complete
				$smsDataObj = DfProblem::dfProblemForTechAssignedSms($id);
				$smsDataObj->setAttribute('sender', $dfproblems->officer->name);
				$smsDataObj->setAttribute('sender_mobile', $dfproblems->officer->mobile);
				$this->sendSms($smsDataObj, 'problemEntryEdit_for_complete');
				return redirect()->route('services.problemEntryList', ['processing'])
					->with('flash_success', $message);
			}
			if (isset($saveData['pull']) && $saveData['pull'] == 1) {
				//send sms for need to pull
				$this->sendSms(DfProblem::dfProblemForTechAssignedSms($id), 'problemEntryEdit_for_pull');
			}
			return redirect()->route('services.problemEntryEdit', [$id])
				->with('flash_success', $message);
		} else {
			$message = "Nothing Updated.";
			return redirect()->route('services.problemEntryEdit', [$id])
				->with('flash_danger', $message);
		}

	}

	public function problemEntry(Request $request) {
		if ($request->isMethod('post')) {
			return $this->problemEntryStore($request);
		} else {
			return view('services.item_index');
		}
	}

	public function problemEntryEdit(Request $request, $id) {
		if ($request->isMethod('put')) {
			return $this->problemEntryUpdate($request, $id);
		} else {
			$dfproblems = DfProblem::dfProblemById($id);
			$arr = ['completed', 'applied_for_damage', 'damage_approved'];
			if (in_array($dfproblems->status, $arr)) {
				if ($dfproblems->status == 'completed') {
					$params = 'completed';
				} else {
					$params = 'damage-applied';
				}
				$message = "Your application is " . mystudy_case($dfproblems->status);
				return redirect()->route('services.problemEntryList', [$params])
					->with('flash_danger', $message);
			}

			$supportDfList = Item::depotSupportDf($dfproblems->depot->id)
				->pluck('serial_no', 'id');
			if ($dfproblems->item_id) {
				$assignedSupportDf = Item::where('id', $dfproblems->item_id)->pluck('serial_no', 'id');
				$supportDfList = collect($assignedSupportDf->toArray() + $supportDfList->toArray());
			}

			$damageTypes = DamageType::pluck('name', 'id');
			return view('services.df_problem_edit', compact('dfproblems', 'supportDfList', 'damageTypes'));
		}
	}

	public function problemEntryList($param = 'pending') {
		return view('services.df_problem_index', compact('param'));
	}

	//technician assign for df problem
	public function assignTechnician(Request $request, $id) {
		$dfproblems = DfProblem::dfProblemById($id);
		if ($request->isMethod('post')) {
			$data = $request->except('_token');
			$request->validate([
				'technician_id' => 'required',
			]);
			$dfProblems = DfProblem::where('id', $id)
				->update([
					'status' => 'processing',
					'technician_id' => $data['technician_id'],
					'teamleader_id' => auth()->user()->id]
				);
			if ($data['submit'] == 'send') {
				//send sms to technician
				$sender = auth()->user()->name . '(' . auth()->user()->designation->short_name . '),' . auth()->user()->mobile;
				$smsDataObj = DfProblem::dfProblemForTechAssignedSms($id);
				$smsDataObj->setAttribute('sender', $sender);
				$returnDataArr = $this->sendSms($smsDataObj, 'assignTechnician');
				if (is_array($returnDataArr)) {
					if (empty($returnDataArr)) {
						$message = "You have successfully assigned technician & sent SMS.";
						return redirect()->route('services.assignTechnician', [$id])
							->with('flash_success', $message);
					} else {

						$bouncedNumber = implode(',', $returnDataArr);
						$message = "SMS Couldn\'t be sent the number: $bouncedNumber";
						return redirect()->route('services.assignTechnician', [$id])
							->with('flash_danger', $message);
					}
				} else {
					$message = "SMS Couldn\'t be sent, please try again.";
					return redirect()->route('services.assignTechnician', [$id])
						->with('flash_danger', $message);
				}
			}
			if ($dfProblems) {
				$message = "You have successfully assigned";
				return redirect()->route('services.assignTechnician', [$id])
					->with('flash_success', $message);
			} else {
				$message = "Something wrong!! Please try again";
				return redirect()->route('services.assignTechnician', [$id])
					->with('flash_danger', $message);
			}
		} else {
			//$technitians = Technician::where('status', 'active')->where('depot_id', $dfproblems->depot->id)->pluck('name', 'id');
			$technitians = Technician::where('status', 'active')->pluck('name', 'id');
			return view('services.assign_technician', compact('dfproblems', 'technitians'));
		}
	}

	//probolem reject
	public function problemReject(Request $request, $id) {
		$data = $request->all();
		$dfProblem = DfProblem::dfProblemById($id);
		$problem = false;
		if ($dfProblem->pull < 2 && $dfProblem->support < 2) {
			if ($dfProblem->support < 1) {
				$problem = $dfProblem->condByDfProblemId($id)->update(['status' => 'rejected']);
			} else {
				$itemId = $dfProblem->item_id;
				$itemData = [];
				$itemData['item_status'] = null;
				$problem = $dfProblem->condByDfProblemId($id)->update(['status' => 'rejected']);
				if ($problem) {
					Item::itemUpdate($itemData, ['id' => $itemId]);
				}
			}
		}

		if ($problem) {
			$message = "You have successfully deleted";
			return redirect()->route('services.problemEntryList', [$data['param']])
				->with('flash_success', $message);
		} else {
			$message = "Something wrong!! Please try again";
			return redirect()->route('services.problemEntryList', [$data['param']])
				->with('flash_danger', $message);
		}
	}

	//generate Claim copy for pull DF
	public function generateClaimCopy(Request $request, $id) {
		$dfProblem = DfProblem::dfProblemById($id);
		//return view('pdf.claim_copy', compact('dfProblem', 'item'));
		//https://packagist.org/packages/barryvdh/laravel-dompdf
		$pdf = \domPDF::loadView('pdf.claim_copy', compact('dfProblem', 'item'));
		//return view('pdf.gate_pass', compact('reqisition', 'item'));
		return $pdf->download('claim_copy.pdf');
	}

	//generate gatepass for support DF
	private function generateGatepass($id, $type) {
		$dfproblemObj = DfProblem::with(['officer' => function ($q) {
			return $q->select('id', 'name');
		}])
			->findOrFail($id);
		$item = collect([]);
		if ($type == 'support') {
			$purpose = 'Support';
			$item = Item::getItemById(['id' => $dfproblemObj->item_id]);
		} else {
			$purpose = 'Delivery After Repair';
			if ($dfproblemObj->df_code != 'personal') {
				$item = Item::getItemById(['serial_no' => $dfproblemObj->df_code]);
			}
		}
		$fileName = $type . '-df-gatepass-' . $id;
		// dd($item->toArray());
		//return view('pdf.service_df_gate_pass', compact('dfproblemObj','item','purpose','type'));
		//https://packagist.org/packages/barryvdh/laravel-dompdf
		$pdf = \domPDF::loadView('pdf.service_df_gate_pass', compact('dfproblemObj', 'item', 'purpose', 'type'));
		//return view('pdf.gate_pass', compact('reqisition', 'item'));
		$customPaper = array(0, 0, 950, 950);
		return $pdf->setPaper($customPaper, 'landscape')->setWarnings(false)->download($fileName . '.pdf');
	}

	public function history($id = 0) {

		if ($id > 0) {

			$item = Item::findOrFail($id);

			$settlements = \App\Settlement::where('item_id', $item->id)->first();

			$dfproblems = DfProblem::with([
				'complain_types' => function ($q) {
					return $q->with('problem_type')
						->select('df_problem_id', 'problem_type_id');
				},
				'region' => function ($q) {
					return $q->select('id', 'name');
				},
				'depot' => function ($q) {
					return $q->select('id', 'name');
				},
				'distributor' => function ($q) {
					return $q->select('id', 'outlet_name');
				},
				'technician' => function ($q) {
					return $q->select('id', 'name', 'mobile');
				},
				'officer' => function ($q) {
					return $q->with(['designation' => function ($dq) {
						$dq->select('id', 'short_name');
					}])
						->select('id', 'name', 'designation_id', 'mobile');
				},
			])
				->where('df_code', $item->serial_no)
				->orderBy('updated_at', 'desc')
				->get();

			return view('services.show_history', compact('item', 'dfproblems', 'settlements'));
		} else {
			return view('services.history');
		}
	}

}
