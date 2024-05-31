<?php
namespace App\Exports;
use App\Allocation;
use App\Stock;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;

class AllocationExport implements FromView, ShouldAutoSize, WithColumnFormatting {

    public function __construct(int $stockId) {
        $this->stockId = $stockId;
    }

    public function view(): View {
        return view('exports.allocations', [
            'stocks' => Stock::with([
                'stock_details' => function ($q) {
                    $q->with([
                        'brand',
                        'size' => function ($q) {
                            return $q->select('id', 'name');
                        },
                    ])
                        ->select('id', 'stock_id', 'brand_id', 'size_id', 'qty')
                        ->orderBy('id', 'asc');
                },
            ])
                ->select('id', 'invoice_no', 'invoice_date')
                ->find($this->stockId),
            'allocations' => Allocation::with([
                'depot' => function ($q) {
                    return $q->with(['user' => function ($q) {
                        return $q->with(['designation' => function ($q) {
                            return $q->select('id', 'title');},
                        ])
                            ->select('id', 'designation_id', 'name', 'mobile', 'email');
                    }])->select('id', 'name', 'user_id', 'address');},
                'allocation_details' => function ($q) {
                    return $q->select('allocation_id', 'stock_detail_id', 'qty');
                },
            ])
                ->select('id', 'depot_id')
                ->where('stock_id', $this->stockId)
                ->orderBy('updated_at', 'desc')
                ->get(),
        ]);
    }

    public function columnFormats(): array
    {
        return [
            'B' => 'wrap-text',
        ];
    }
}