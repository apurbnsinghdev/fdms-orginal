<?php

namespace App\Traits;
use App\Item;
use App\Settlement;
use Carbon\Carbon;

trait SettlementCreateCloseData {
	private function getSettlementDataForCreate($reqisition, $item) {

		$now = Carbon::now();
		$insertableData['inject_date'] = $now;
		$insertableData['item_id'] = $reqisition->item_id;
		$insertableData['shop_id'] = $reqisition->shop_id;
		$insertableData['requisition_id'] = $reqisition->id;

		if ($reqisition->payment_modes != 'without_rent' && $reqisition->receive_amount) {

			$insertableData['receive_amount'] = $reqisition->receive_amount;

			$date = $now->day;
			$month = $now->month;
			$year = $now->year;
			if ($date <= 15) {
				$insertableData['month_from'] = Carbon::createFromDate($year, $month, 1);
			} else {
				$insertableData['month_from'] = Carbon::createFromDate($year, $month + 1, 1);
			}

			if ($item->size->installment) {
				$installment = $item->size->installment;
				$totalMonth = (int) round($reqisition->receive_amount / $installment);
				$monthTo = Carbon::parse($insertableData['month_from']);
				$insertableData['month_to'] = $monthTo->addMonths($totalMonth)->subDay(1);
				$insertableData['installment'] = $installment;
			} else {
				$insertableData = [];
			}
		}
		return $insertableData;
	}

	private function settlementLockUnlock($obj, $unlock = false) {
		if (!$unlock) {
			$status = 'reserve';
			$unlockStatus = 'continue';
			$saveData['status'] = $status;
		} else {
			$status = 'continue';
			$unlockStatus = 'reserve';
			$saveData['status'] = $status;
			$saveData['closed_date'] = null;
			$saveData['payable_amount'] = 0;
		}
		$sattlementObj = Settlement::where('shop_id', $obj->shop_id)
			->where('item_id', $obj->current_df)
			->where('status', $unlockStatus)
			->first();
		if (!$sattlementObj) {
			$message = "Previous settlement already closed/replaced or could not found";
			return redirect()->back()->with('flash_danger', $message);
		}
		Item::where('id', $obj->current_df)->update(['item_status' => $status]);
		$sattlementObj->update($saveData);
	}

	private function settlementClose($obj, $closeStatus = null, $forDamage = false) {
		if ($forDamage) {
			$sattlementObj = Settlement::where('shop_id', $obj->shop_id)
				->where('item_id', $obj->current_df)
				->whereNotNull('damage_application_id')
				->whereIn('status', ['reserve', 'continue'])
				->first();
		} else {
			$sattlementObj = Settlement::where('shop_id', $obj->shop_id)
				->where('item_id', $obj->current_df)
				->where(function ($q) {
					$q->where('status', 'reserve')
						->orWhereNotNull('damage_application_id');
				})
				->first();
		}

		if (!$sattlementObj) {
			$message = "Settlement already closed/replaced or could not found";
			return redirect()->back()->with('flash_danger', $message);
		}
		$saveData = [];
		//if damage application exist and approved before requisition replace approved
		if ($sattlementObj->status == 'closed' && $sattlementObj->damage_application_id) {
			$saveData['status'] = 'replace';
		} else {
			$closeDate = Carbon::now();
			if ($obj->withdrawal_date) {
				$closeDate = Carbon::parse($obj->withdrawal_date);
			}

			$saveData['closed_date'] = $closeDate;
			$saveData['status'] = 'replace'; //for replace requistion
			if ($closeStatus) {
				$saveData['status'] = $closeStatus; //for return application
			}

			if ($sattlementObj->receive_amount > 0) {
				if ($sattlementObj->month_to > $closeDate) {
					$countMonth = $sattlementObj->month_from->diffInMonths($closeDate);
					if ($closeDate->day > 15 && $sattlementObj->month_from <= $closeDate) {
						$countMonth = $countMonth + 1;
					}
					$saveData['payable_amount'] = (int) $sattlementObj->receive_amount - ($countMonth * $sattlementObj->installment);
				} else {
					$saveData['payable_amount'] = 0;
				}
			}
		}

		Item::where('id', $obj->current_df)->update(['item_status' => null]);
		$sattlementObj->update($saveData);
	}

	private function updateSettleMent($conditionArr, $updateFldArr) {
		return Settlement::where($conditionArr)->update($updateFldArr);
	}
}
