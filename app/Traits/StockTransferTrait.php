<?php

namespace App\Traits;
use App\Depot;
use App\Item;
use App\StockTransfer;
use App\StockTransferDetail;
use App\StockTransferLog;
use DB;
use Illuminate\Http\Request;
trait StockTransferTrait {

    public function stockTransferLists() {

        $transferlists = (new StockTransfer)->getStockTransferLists();
        return view('inventories.stock_transfer.lists', compact('transferlists'));
    }

    public function stockTransferCreate(Request $request, $depot = null) {
        $trasferDepots = collect([]);
        $availableDfs = collect([]);
        $transferFrom = $depot;
        $transferTo = null;
        if ($request->isMethod('post')) {

            $transferFrom = $request->input('transfer_from');

            if ($request->input('submit') === 'search') {

                $request->validate([
                    'transfer_from' => 'required',

                ]);

                return redirect()->route('inventories.stockTransferCreate', [$transferFrom]);

            } else {

                $validData = $request->validate([
                    'transfer_from' => 'required',
                    'transfer_to' => 'required',
                ]);

                $items = collect($request->input('data'));
                $items = $items->filter(function ($value, $key) {
                    return !is_null($value['qty']);
                });

                if ($items->isEmpty()) {
                    return redirect()->back()->withInput($validData)->with('flash_danger', 'Minimum Stok transfer quentity required!');
                }

                $transferTo = $request->input('transfer_to');

                if (!$this->saveStockTransfer($transferFrom, $transferTo, $items)) {
                    return redirect()->route('inventories.stockTransferCreate', [$transferFrom])->with('flash_danger', 'Stock transfer failed!');
                } else {
                    return redirect()->route('inventories.stockTransferLists')->with('flash_success', 'Stock transfer succesfull!');
                }

            }
        }

        if ($transferFrom) {
            $trasferDepots = $this->transferableDepots($transferFrom);
            $availableDfs = (new StockTransfer)->availableDepotStocks($transferFrom);
        }

        $depots = Depot::pluck('name', 'id');
        return view('inventories.stock_transfer.create', compact('depots', 'trasferDepots', 'transferFrom', 'availableDfs'));
    }

    private function saveStockTransfer($transferFrom, $transferTo, $trnasferItems) {

        $stockTransfer = new StockTransfer;
        $stockTransferDetail = new StockTransferDetail;
        $itemObj = new Item;

        $totalPlacedQty = array_sum(array_column($trnasferItems->toArray(), 'qty'));

        DB::beginTransaction();

        try {

            //Saving Stock Transfer Master Data
            $stockTransfer->from_depot = $transferFrom;
            $stockTransfer->to_depot = $transferTo;
            $stockTransfer->placed_qty = $totalPlacedQty;
            $stockTransfer->placed_by = auth()->user()->id;
            $stockTransfer->save();

            $stockTransfer_id = $stockTransfer->id;

            $stockTransferDetailData = [];
            foreach ($trnasferItems as $transfer) {

                $stockTransferDetail = new stockTransferDetail;
                $stockTransferDetail->stock_transfer_id = $stockTransfer_id;
                $stockTransferDetail->brand_id = $transfer['brand_id'];
                $stockTransferDetail->size_id = $transfer['size_id'];
                $stockTransferDetail->placed_qty = $transfer['qty'];

                $stockTransferDetail->save();

                $stock_transfer_detail_id = $stockTransferDetail->id;

                //get transfarable depot items
                $itemIds = $itemObj
                    ->where([
                        ['depot_id', '=', $transferFrom],
                        ['brand_id', '=', $transfer['brand_id']],
                        ['size_id', '=', $transfer['size_id']],
                    ])
                    ->where('freeze_status', '=', 'fresh')
                    ->whereNull('item_status')
                    ->whereNull('serial_no')
                    ->limit($transfer['qty'])
                    ->pluck('id');

                //Items locked for transfer
                $itemObj->whereIn('id', $itemIds)
                    ->update(['item_status' => 'locked']);

            }

            DB::commit();
            // Looks Good
            return true;

        } catch (\Exception $e) {
            DB::rollback();
            // something went wrong
            return false;
        }

    }
    private function transferableDepots($transferFrom) {

        return Depot::where('id', '<>', $transferFrom)->pluck('name', 'id');

    }

    /**
     * Receive Stock Transfer Information.
     * And save information accordingly
     *
     * @param  Request  $request
     * @return Response
     */
    public function stockTransferReceive(Request $request) {

        //Valided Authencate User

        $requestData = $request->input('data');

        $stock_transfer_id = $requestData['stock_transfer_id'];
        unset($requestData['stock_transfer_id']);
        $stockTransfer = StockTransfer::find($stock_transfer_id);

        //Total Placed Quantity
        $totalPlacedQty = array_sum(array_column($requestData, 'receive_qty'));

        // Check if Master placed qty is equivalan to submited qty
        if ($stockTransfer->placed_qty == $totalPlacedQty) {

            if ($this->onReceived($stockTransfer, $requestData)) {
                $message = "You have successfully received";
                return redirect()->route('inventories.stockTransferLists')
                    ->with('flash_success', $message);
            }
        }

        $message = "Something is wrong!";
        return redirect()->route('inventories.stockTransferLists')
            ->with('flash_danger', $message);
    }

    private function onReceived($stockTransfer, $requestData) {
        $itemObj = new Item;
        $stockTransferLog = new StockTransferLog;

        DB::beginTransaction();
        try {

            foreach ($requestData as $data) {
                $stockTransferDetail = StockTransferDetail::find($data['stock_transfer_detail_id']);
                $stockTransferDetail->received_qty = (int) $data['receive_qty'];
                //$stockTransferDetail->missing_qty = (int) $data['missing_qty'];
                //$stockTransferDetail->excess_qty = (int) $data['excess_qty'];
                $stockTransferDetail->comments = $data['comments'];
                $stockTransferDetail->save();

                $qty = (int) $data['receive_qty'];

                //get transfarable depot items
                $itemIds = $itemObj
                    ->where([
                        ['depot_id', '=', $stockTransfer->from_depot],
                        ['brand_id', '=', $stockTransferDetail->brand_id],
                        ['size_id', '=', $stockTransferDetail->size_id],
                    ])
                    ->where('item_status', '=', 'locked')
                    ->whereNull('serial_no')
                    ->limit($qty)
                    ->pluck('id');

                //Insert log stok transfer log data

                foreach ($itemIds as $id) {

                    $stockTransferLog = new StockTransferLog;
                    $stockTransferLog->stock_transfer_id = $stockTransferDetail->stock_transfer_id;
                    $stockTransferLog->stock_transfer_detail_id = $stockTransferDetail->id;
                    $stockTransferLog->item_id = $id;

                    $stockTransferLog->save();

                }

                //Items unlocked and update status
                $itemObj->whereIn('id', $itemIds)
                    ->where('depot_id', $stockTransfer->from_depot)
                    ->update(['depot_id' => $stockTransfer->to_depot, 'item_status' => null]);

            }

            //Finaly save received user
            $stockTransfer->received_by = auth()->user()->id;
            $stockTransfer->status = 'receive';
            $stockTransfer->save();

            DB::commit();
            // Looks Good
            return true;

        } catch (\Exception $e) {

            dd($e);
            DB::rollback();
            // something went wrong
            return false;
        }

    }

    public function stockTransferApprove($transfer_id) {

        //Only authenticate user can approve it
        //Authenticate process goes here

        try {

            $stockTransfer = StockTransfer::findOrFail($transfer_id);
            $stockTransfer->status = 'approve';
            $stockTransfer->approved_by = auth()->user()->id;

            $stockTransfer->save();

        } catch (ModelNotFoundException $e) {
            return redirect()->route('inventories.stockTransferLists')->with('flash_danger', 'Stock transfer failed to Approve!');
        } catch (\Exception $e) {
            return redirect()->route('inventories.stockTransferLists')->with('flash_danger', 'Stock transfer failed to Approve!');
        }

        return redirect()->route('inventories.stockTransferLists')->with('flash_success', 'Stock transfer approved!');

    }

    public function stockTransferCancel(Request $request) {

        //Only authenticate user can approve it
        //Authenticate process goes here
        $itemObj = new Item;
        $stock_transfer_id = $request->input('stock_transfer_id');

        $stockTransfer = StockTransfer::findOrFail($stock_transfer_id);

        $transferData = (new StockTransfer)->findStockTransfer($stock_transfer_id);

        DB::beginTransaction();
        try {

            foreach ($transferData->stock_transfer_details as $data) {

                $qty = (int) $data->placed_qty;

                //get transfarable depot items
                $itemIds = $itemObj
                    ->where([
                        ['depot_id', '=', $stockTransfer->from_depot],
                        ['brand_id', '=', $data->brand_id],
                        ['size_id', '=', $data->size_id],
                    ])
                    ->where('item_status', '=', 'locked')
                    ->whereNull('serial_no')
                    ->limit($qty)
                    ->pluck('id');

                //Items unlocked and update status
                $itemObj->whereIn('id', $itemIds)
                    ->update(['item_status' => null]);

            }

            $stockTransfer->canceled_by = auth()->user()->id;
            $stockTransfer->status = 'cancel';
            $stockTransfer->save();

            DB::commit();
            // Looks Good

            return redirect()->route('inventories.stockTransferLists')->with('flash_success', 'Stock transfer successfully cancled!');

        } catch (\Exception $e) {

            DB::rollback();
            // something went wrong
            return redirect()->route('inventories.stockTransferLists')->with('flash_danger', 'Stock transfer failed to Cancled!');
        }

    }

    private function updateStockTransfer($from_depot, $requestData) {

        $itemObj = new Item;

        DB::beginTransaction();
        try {

            foreach ($requestData as $data) {

                $stock_transfer_detail_id = (int) $data['stock_transfer_detail_id'];
                $brand_id = (int) $data['brand_id'];
                $size_id = (int) $data['size_id'];
                $placed_qty = (int) (null != $data['placed_qty']) ? $data['placed_qty'] : 0;
                $qty = (int) (null != $data['qty']) ? $data['qty'] : 0;

                if ($qty > 0 && $placed_qty > $qty) {

                    $updatedQty = $placed_qty - $qty;

                    //get transfarable depot items
                    $itemIds = $itemObj
                        ->where([
                            ['depot_id', '=', $from_depot],
                            ['brand_id', '=', $brand_id],
                            ['size_id', '=', $size_id],
                        ])
                        ->where('item_status', '=', 'locked')
                        ->whereNull('serial_no')
                        ->limit($updatedQty)
                        ->pluck('id');

                    //Ites unlocked for transfer
                    $itemObj->whereIn('id', $itemIds)
                        ->update(['item_status' => null]);

                    $stockTransferDetail = StockTransferDetail::find($stock_transfer_detail_id);
                    $stockTransferDetail->placed_qty = $qty;
                    $stockTransferDetail->save();

                } else if ($qty > 0 && $placed_qty < $qty) {

                    $updatedQty = $qty - $placed_qty;

                    //get transfarable depot items
                    $itemIds = $itemObj
                        ->where([
                            ['depot_id', '=', $from_depot],
                            ['brand_id', '=', $brand_id],
                            ['size_id', '=', $size_id],
                        ])
                        ->where('freeze_status', 'fresh')
                        ->whereNull('item_status')
                        ->whereNull('serial_no')
                        ->limit($updatedQty)
                        ->pluck('id');

                    //Ites unlocked for transfer
                    $itemObj->whereIn('id', $itemIds)
                        ->update(['item_status' => 'locked']);

                    $stockTransferDetail = StockTransferDetail::find($stock_transfer_detail_id);
                    $stockTransferDetail->placed_qty = $qty;
                    $stockTransferDetail->save();

                } else {
                    continue;
                }
            }
            DB::commit();
            // Looks Good
            return true;
        } catch (\Exception $e) {

            dd($e);
            DB::rollback();
            // something went wrong
            return false;
        }

    }

    public function stockTransferUpdate(Request $request) {

        if ($request->filled('data') && $request->has('stock_transfer_id')) {

            $stock_transfer_id = $request->input('stock_transfer_id');

            $requestData = $request->input('data');

            $stockTransfer = StockTransfer::findOrFail($stock_transfer_id);

            if ($this->updateStockTransfer($stockTransfer->from_depot, $requestData)) {

                $totalPlacedQty = array_sum(array_column($requestData, 'qty'));
                $stockTransfer->placed_qty = $totalPlacedQty;
                $stockTransfer->save();

                return redirect()->route('inventories.stockTransferLists')->with('flash_success', 'Stock transfer successfully updated!');
            }

        }

        return redirect()->route('inventories.stockTransferLists')->with('flash_danger', 'Stock transfer failed to updated!');

    }

    public function StockTransferChalan($transfer_id) {

        $transferData = (new StockTransfer)->findStockTransfer($transfer_id);

        $fileName = 'Chalan For ' . $transferData->from_depot . '-to-' . $transferData->to_depot;

        $pdf = \domPDF::loadView('pdf.stock_transfer_chalan', compact('transferData'));
        //return view('pdf.gate_pass', compact('reqisition', 'item'));
        $customPaper = array(0, 0, 950, 950);
        return $pdf->setPaper($customPaper, 'landscape')->setWarnings(false)->download($fileName . '.pdf');

    }

}
