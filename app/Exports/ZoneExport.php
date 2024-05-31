<?php
namespace App\Exports;

use App\Zone;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Events\AfterSheet;
use \Maatwebsite\Excel\Sheet;

class ZoneExport implements FromQuery, WithMapping, WithHeadings, ShouldAutoSize, WithEvents {
    use Exportable;

    protected $param;
    protected $data;
    protected $sl_no = 0;

    public function __construct(int $param = 0) {
        $this->param = $param;
    }

    public function query() {

        $this->data = Zone::query()->where('level', $this->param);
        if ($this->param == '1') {
            $this->data->with(['parent']);
        }

        if (!$this->param) {
            $this->data->orderByRaw('CAST(code AS SIGNED INTEGER) ASC');
        }

        return $this->data;

    }

    public function headings(): array
    {

        if (!$this->param) {

            return ['SI NO.',
                'Region',
                'Code',
            ];
        } else if ($this->param == 1) {
            return [
                'SI No.',
                'Region',
                'Area',
            ];
        }
    }

    /**
     * @var object $invoice
     */
    public function map($invoice): array
    {
        $this->sl_no = $this->sl_no + 1;
        if (!$this->param) {
            return [
                $this->sl_no,
                $invoice->name,
                $invoice->code,
            ];
        } else if ($this->param == 1) {
            return [
                $this->sl_no,
                $invoice->parent->name,
                $invoice->name,
            ];
        }

    }

    /**
     * Description: Some coustom hook into events, The events will be activated by adding the WithEvents concern
     * @return array //return an array of events
     */
    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function (AfterSheet $event) {

                if ($this->param == '0') {
                    $zone = 'Region';
                } else if ($this->param == '1') {
                    $zone = 'Area';
                }

                //inserts 1 new rows, right before row 1:
                $event->sheet->getDelegate()->insertNewRowBefore(1, 1);

                //Set top row height:
                $event->sheet->getDelegate()->getRowDimension('1')->setRowHeight(40);

                //merge two or more cells together, to become one cell
                $event->sheet->getDelegate()->mergeCells('A1:E1');

                $today = date("j F, Y");
                //Set value to merge cells
                $event->sheet->getDelegate()->setCellValue("A1", "Dhaka Ice Cream Industries Ltd.\n$zone Lists.\n As On " . $today);

                $cellRange = 'A2:E2';
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
                $event->sheet->getDelegate()->getStyle('A1:E1')->applyFromArray($styleArray);

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