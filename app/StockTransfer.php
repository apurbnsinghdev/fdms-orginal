<?php

namespace App;

use App\DepotUser;
use DB;
use Illuminate\Database\Eloquent\Model;

class StockTransfer extends Model {

    public function fromDepot() {
        return $this->belongsTo('App\Depot', 'from_depot');
    }
    public function toDepot() {
        return $this->belongsTo(Depot::class, 'to_depot');
    }
    public function stock_transfer_details() {
        return $this->hasMany(StockTransferDetail::class);
    }

    /**
     * Scope a query to only include Not Received by users.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeNotReceived($query) {
        return $query->where('received_by', 0);
    }

    /**
     * Scope a query to only include Not Canceled by users.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeNotCanceled($query) {
        return $query->where('canceled_by', 0);
    }

    /**
     * Scope a query to only include Not Canceled by users.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeNotApproved($query) {
        return $query->where('canceled_by', 0);
    }

    /**
     * Scope a query to only include Received by users.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeReceived($query) {
        return $query->where('received_by', '>', 0);
    }

    /**
     * Scope a query to only include Canceled by users.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeCanceled($query) {
        return $query->where('canceled_by', '>', 0);
    }

    public function findStockTransfer($id) {

        return $this->with(['stock_transfer_details' => function ($q) {

            return $q->select('id', 'stock_transfer_id', 'brand_id', 'size_id', 'placed_qty')
                ->with([
                    'brand',
                    'size' => function ($q) {
                        return $q->select('id', 'name');
                    },
                ]);

        }])
            ->join('depots as fd', 'fd.id', '=', 'stock_transfers.from_depot')
            ->join('depots as td', 'td.id', '=', 'stock_transfers.to_depot')
            ->join('users as u', 'u.id', '=', 'stock_transfers.placed_by')
            ->select(
                'stock_transfers.id',
                'stock_transfers.created_at',
                'stock_transfers.placed_qty',
                'stock_transfers.created_at as placed_date',
                'fd.name as from_depot',
                'td.name as to_depot',
                'u.name as placed_by'
            )
            ->whereIn('stock_transfers.status', ['pending', 'approve'])
            ->notCanceled()
            ->notReceived()
            ->find($id);
    }

    public function getStockTransferLists() {
        $depotIds = DepotUser::where('user_id', auth()->user()->id)->pluck('depot_id');
        return $this->with(['stock_transfer_details' => function ($q) {

            return $q->select('id', 'stock_transfer_id', 'brand_id', 'size_id', 'placed_qty')
                ->with([
                    'brand',
                    'size' => function ($q) {
                        return $q->select('id', 'name');
                    },
                ]);

        }])
            ->join('depots as fd', 'fd.id', '=', 'stock_transfers.from_depot')
            ->join('depots as td', 'td.id', '=', 'stock_transfers.to_depot')
            ->join('users as u', 'u.id', '=', 'stock_transfers.placed_by')
            ->select(
                'stock_transfers.id',
                'stock_transfers.placed_qty',
                'stock_transfers.created_at as placed_date',
                'stock_transfers.status',
                'fd.id as from_depot_id',
                'fd.name as from_depot',
                'td.name as to_depot_id',
                'td.name as to_depot',
                'u.name as placed_by'
            )
            ->whereIn('stock_transfers.status', ['pending', 'approve'])
            ->orderBy('stock_transfers.updated_at', 'desc')
            ->whereIn('to_depot', $depotIds)
            ->notCanceled()
            ->notReceived()
            ->get();
    }

    public function availableDepotStocks($from_depot) {

        return $availableDfs = \App\Item::with([
            'size' => function ($q) {
                return $q->select('id', 'name');
            },
            'brand' => function ($q) {
                return $q->select('id', 'short_code');
            },
        ])
            ->select('items.size_id', 'items.brand_id', \DB::raw('COUNT(items.id) as total'))
            ->where('items.freeze_status', '=', 'fresh')
            ->whereNull('items.item_status')
            ->whereNull('items.serial_no')
            ->where('items.depot_id', $from_depot)
            ->groupBy(['items.size_id', 'items.brand_id'])
            ->get();

    }

    public function stockTransferEditableData($from_depot, $transfer_id) {

        $availableDfs = DB::table('items')
            ->join('brands', 'brands.id', '=', 'items.brand_id')
            ->join('sizes', 'sizes.id', '=', 'items.size_id')
            ->select('items.size_id', 'items.brand_id', 'sizes.name as size', 'brands.short_code as brand', \DB::raw('SUM(CASE WHEN items.item_status is null then 1 else 0 end) as totalAvailabe'))
            ->where('items.freeze_status', '=', 'fresh')
            ->whereNull('items.serial_no')
            ->where('items.depot_id', $from_depot)
            ->groupBy(['items.size_id', 'sizes.name', 'items.brand_id', 'brands.short_code']);

        $transfer = DB::table('stock_transfer_details as std')

            ->rightJoinSub($availableDfs, 'stock', function ($join) use ($transfer_id) {
                $join->on('std.brand_id', '=', 'stock.brand_id')
                    ->on('std.size_id', '=', 'stock.size_id')
                    ->where('std.stock_transfer_id', $transfer_id);
            })
            ->select('stock.*', 'std.placed_qty', 'std.id as stock_transfer_detail_id', 'std.stock_transfer_id')
            ->get();

        return $transfer;

    }

}
