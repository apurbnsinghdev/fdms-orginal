<?php
namespace App\Exports;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;

class SizeWiseDfExport implements FromView, ShouldAutoSize, WithColumnFormatting {

    use Exportable;

    protected $data;

    public function __construct($data) {
        $this->data = $data;
    }

    public function view(): View {
        return view('reports.inventory.size_wise_df_status_report', $this->data);
    }

    public function columnFormats(): array
    {
        return [
            'B' => 'wrap-text',
        ];
    }
}