<?php
namespace App\Exports;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;

class ComplainExport implements FromView, ShouldAutoSize, WithEvents {

    use Exportable;

    protected $reportView;
    protected $data;

    public function __construct($view, $data) {
        $this->data = $data;
        $this->reportView = $view;

    }

    public function view(): View {

        return view($this->reportView, $this->data);
    }
    public function registerEvents(): array
    {

        return [
            AfterSheet::class => function (AfterSheet $event) {

                //Style to merge cells
                $styleArray = [
                    'font' => [
                        'bold' => true,
                    ],
                    'alignment' => [
                        'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                    ],
                    'borders' => [
                        'top' => [
                            'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                        ],
                    ],

                ];

                $highestColumn = $event->sheet->getDelegate()->getHighestColumn();
                $event->sheet->getDelegate()->getStyle('A1:' . $highestColumn . '1')->applyFromArray($styleArray);
            },
        ];
    }

    public function columnLetter($c) {

        $c = intval($c);
        if ($c <= 0) {
            return '';
        }

        $letter = '';

        while ($c != 0) {
            $p = ($c - 1) % 26;
            $c = intval(($c - $p) / 26);
            $letter = chr(65 + $p) . $letter;
        }

        return $letter;

    }

}