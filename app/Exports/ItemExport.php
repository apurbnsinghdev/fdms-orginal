<?php
namespace App\Exports;
use App\Item;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;

class ItemExport implements FromView, ShouldAutoSize, WithColumnFormatting {

    protected $depotId;
    public function __construct($depotId) {
        $this->depotId = $depotId;
    }

    public function view(): View {
        return view('exports.item-export', [
            'items' => Item::with([
                'brand' => function ($q) {
                    return $q->select('id', 'short_code');
                },
                'size' => function ($q) {
                    return $q->select('id', 'name');
                },
                'Depot' => function ($q) {
                    return $q->select('id', 'name');
                },
            ])
                ->where('depot_id', $this->depotId)
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