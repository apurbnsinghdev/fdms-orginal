<?php
namespace App\Exports;
use App\Brand;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Events\AfterSheet;

class BrandExport implements FromQuery, WithMapping, WithHeadings, ShouldAutoSize, WithEvents {
    use Exportable;

    protected $data;
    public function __construct() {

        $this->data = Brand::all();
    }

    public function query() {

        return Brand::query();
    }

    public function headings(): array
    {

        return [
            'SI NO.',
            'Brand Name',
            'Short Code',
        ];
    }

    /**
     * @var object $invoice
     */
    public function map($invoice): array
    {
        return [
            $invoice->id,
            $invoice->name,
            $invoice->short_code,
        ];
    }

    /**
     * Description: Some coustom hook into events, The events will be activated by adding the WithEvents concern
     * @return array //return an array of events
     */
    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function (AfterSheet $event) {

                //inserts 1 new rows, right before row 1:
                $event->sheet->getDelegate()->insertNewRowBefore(1, 1);

                //Set top row height:
                $event->sheet->getDelegate()->getRowDimension('1')->setRowHeight(40);

                //merge two or more cells together, to become one cell
                $event->sheet->getDelegate()->mergeCells('A1:D1');

                $today = date("j F, Y");
                //Set value to merge cells
                $event->sheet->getDelegate()->setCellValue("A1", "Dhaka Ice Cream Industries Ltd.\nBrand Lists.\n As On " . $today);

                $cellRange = 'A2:D2';
                $event->sheet->getDelegate()->getStyle($cellRange)->getFont()->setSize(14);

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
                    'fill' => [
                        'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_GRADIENT_LINEAR,
                        'rotation' => 90,
                        'startColor' => [
                            'argb' => 'FFA0A0A0',
                        ],
                        'endColor' => [
                            'argb' => 'FFFFFFFF',
                        ],
                    ],
                ];

                //apply style to merge cells
                $event->sheet->getDelegate()->getStyle('A1:D1')->applyFromArray($styleArray);

                $footar1 = $this->data->count() + 4;
                $footar11 = $footar1 + 1;
                $event->sheet->getDelegate()->getCell('A' . $footar1)->setValue('.............');
                $event->sheet->getDelegate()->getCell('A' . $footar11)->setValue('Provided By:');

                $footar1 = $this->data->count() + 4;
                $footar11 = $footar1 + 1;
                $event->sheet->getDelegate()->getCell('B' . $footar1)->setValue('.............');
                $event->sheet->getDelegate()->getCell('B' . $footar11)->setValue('Checked By:');

                $footar1 = $this->data->count() + 4;
                $footar11 = $footar1 + 1;
                $event->sheet->getDelegate()->getCell('C' . $footar1)->setValue('.............');
                $event->sheet->getDelegate()->getCell('C' . $footar11)->setValue('Approved By:');

            },
        ];
    }
}

?>