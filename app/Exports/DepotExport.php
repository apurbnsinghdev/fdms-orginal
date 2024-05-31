<?php
namespace App\Exports;

use App\Depot;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Events\AfterSheet;
use \Maatwebsite\Excel\Sheet;

class DepotExport implements FromQuery, WithMapping, WithHeadings, ShouldAutoSize, WithEvents {
    use Exportable;

    protected $param;
    protected $sl_no = 0;

    public function __construct() {

    }

    public function query() {

        $this->data = Depot::query();
        $this->data->with([
            'division' => function ($q) {
                return $q->select('id', 'name');
            },
            'district' => function ($q) {
                return $q->select('id', 'name');
            },
            'thana' => function ($q) {
                return $q->select('id', 'name');
            },
            'region' => function ($q) {
                return $q->select('id', 'name');
            },
            'area' => function ($q) {
                return $q->select('id', 'name');
            },
        ])->orderByRaw('CAST(code AS SIGNED INTEGER) ASC');
        return $this->data;

    }

    public function headings(): array
    {

        return ['SI NO.',
            'Division',
            'District',
            'Thana',
            'Region',
            'Area',
            'Name',
            'Code',
            'Address',
            'Has Incharge',
        ];

    }

    /**
     * @var object $invoice
     */
    public function map($invoice): array
    {
        $this->sl_no = $this->sl_no + 1;
        return [
            $this->sl_no,
            $invoice->division->name ?? '',
            $invoice->district->name ?? '',
            $invoice->thana->name ?? '',
            $invoice->region->name ?? '',
            $invoice->area->name ?? '',
            $invoice->name ?? '',
            $invoice->code ?? '',
            $invoice->address ?? '',
            ($invoice->has_incharge == 0) ? 'Yes' : 'No',
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
                $event->sheet->getDelegate()->mergeCells('A1:J1');

                $today = date("j F, Y");
                //Set value to merge cells
                $event->sheet->getDelegate()->setCellValue("A1", "Dhaka Ice Cream Industries Ltd.\nDepot Lists.\n As On " . $today);

                $cellRange = 'A2:J2';
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
                $event->sheet->getDelegate()->getStyle('A1:J1')->applyFromArray($styleArray);

                $footar1 = $this->data->count() + 4;
                $footar11 = $footar1 + 1;
                $event->sheet->getDelegate()->getCell('B' . $footar1)->setValue('.............');
                $event->sheet->getDelegate()->getCell('B' . $footar11)->setValue('Provided By:');

                $footar1 = $this->data->count() + 4;
                $footar11 = $footar1 + 1;
                $event->sheet->getDelegate()->getCell('C' . $footar1)->setValue('.............');
                $event->sheet->getDelegate()->getCell('C' . $footar11)->setValue('Checked By:');

                $footar1 = $this->data->count() + 4;
                $footar11 = $footar1 + 1;
                $event->sheet->getDelegate()->getCell('D' . $footar1)->setValue('.............');
                $event->sheet->getDelegate()->getCell('D' . $footar11)->setValue('Approved By:');

            },
        ];
    }
}

?>