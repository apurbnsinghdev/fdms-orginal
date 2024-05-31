<?php

namespace App\Traits;
use App\HoldStock;
use App\Item;
use App\Shop;
trait StockCheckTrait {

	public function checkAvailableStock($size_id, $shop_id = null, $depotId = null, $isLowcooling = false) {
		//modified mipel:15-may-2019
		if ($shop_id) {
			$depotId = Shop::where('id', $shop_id)->value('depot_id');
		}
		if ($isLowcooling) {
			$totalItem = Item::availableDFQty(true)
				->where('depot_id', $depotId)
				->where('size_id', $size_id)
				->count();
		} else {
			$totalItem = Item::availableDFQty()
				->where('depot_id', $depotId)
				->where('size_id', $size_id)
				->count();
			$holdStock = HoldStock::where('depot_id', $depotId)
				->where('size_id', $size_id)
				->sum('qty');
			$totalItem = $totalItem - $holdStock;
		}
		return $totalItem;
	}

	private function calculateAvailabeDFStock($depotId, $sizeId, $brandId = null) {
		/*
			check available items/df from items table
			then check hold quantity in same depot,same brand and same size
			then calculate the remaining quantity.
			//mipellim(16-may-2019)
		*/
		$availableDF = Item::select('items.depot_id', 'items.size_id', 'items.brand_id', \DB::raw('COUNT(items.id) as total'))
			->availableDFQty()
			->where('items.depot_id', $depotId)
			->where('items.size_id', $sizeId)
			->groupBy(['items.size_id', 'items.brand_id', 'items.depot_id']);

		if ($brandId) {
			$availableDF->where('items.brand_id', $brandId);
		}
		//dd($availableDF->get()->toArray());

		return HoldStock::rightJoinSub($availableDF, 'items', function ($join) {
			$join->on('items.brand_id', '=', 'hold_stocks.brand_id')
				->on('items.size_id', '=', 'hold_stocks.size_id')
				->on('items.depot_id', '=', 'hold_stocks.depot_id');
		})
			->whereRaw('hold_stocks.qty < items.total')
		//->where('hold_stocks.qty', '<', \DB::raw('items.total'))
			->orWhereNull('hold_stocks.qty')
		//->select('items.size_id', 'items.brand_id', 'items.total', 'hold_stocks.qty', \DB::raw('items.total-IFNULL(hold_stocks.qty,0) as remain'))
			->select('items.brand_id', \DB::raw('items.total-IFNULL(hold_stocks.qty,0) as remain'))
		//->get();
			->pluck('remain', 'items.brand_id');
		//dd($x->toArray());
	}

}
