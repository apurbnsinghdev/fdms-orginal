<?php
namespace App\Exports;
use App\Depot;
use App\Designation;
use App\Role;
use App\User;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Events\AfterSheet;

class UserExport implements FromQuery, WithMapping, WithHeadings, ShouldAutoSize, WithEvents {
    use Exportable;

    protected $data;
    protected $depots;
    protected $sl_no = 0;
    public function __construct() {

        $this->depots = Depot::select('id', 'name')->get();
    }

    public function query() {

        $this->data = User::query();

        $this->data->with([
            'role' => function ($q) {
                $q->select('id', 'name');
            },
            'designation' => function ($q) {
                $q->select('id', 'title');
            },
            'depots',
        ]);

        return $this->data;
    }

    public function headings(): array
    {

        return [
            'SI NO.',
            'Name',
            'Email',
            'Mobile',
            'Role',
            'Designation',
            'Assigned Depot',
            'Status',
        ];
    }

    /**
     * @var object $invoice
     */
    public function map($invoice): array
    {
        $this->sl_no = $this->sl_no + 1;
        $assignedDepot = '';

        if ($invoice->depots->count()) {
            $assignedDepot = implode(', ', $this->depots->whereIn('id', $invoice->depots->pluck('depot_id'))->pluck('name')->toArray()) . '(' . $this->depots->whereIn('id', $invoice->depots->pluck('depot_id'))->pluck('name')->count() . ')';
        }

        return [
            $this->sl_no,
            $invoice->name,
            $invoice->email ?? '',
            $invoice->mobile ?? '',
            $invoice->role->name ?? '',
            $invoice->designation->title ?? '',
            $assignedDepot,
            $invoice->status ?? '',
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
                $event->sheet->getDelegate()->getColumnDimension('G')->setAutoSize(false);
                $event->sheet->getDelegate()->getColumnDimension('G')->setWidth(25);

                $event->sheet->getDelegate()->getStyle('G1:G' . $event->sheet->getDelegate()->getHighestRow())->getAlignment()->setWrapText(true);
                //$event->sheet->getDelegate()->getStyle('G8')->getAlignment()->setWrapText(true);

                //inserts 1 new rows, right before row 1:
                $event->sheet->getDelegate()->insertNewRowBefore(1, 1);

                //Set top row height:
                $event->sheet->getDelegate()->getRowDimension('1')->setRowHeight(40);

                //merge two or more cells together, to become one cell
                $event->sheet->getDelegate()->mergeCells('A1:H1');

                $today = date("j F, Y");
                //Set value to merge cells
                $event->sheet->getDelegate()->setCellValue("A1", "Dhaka Ice Cream Industries Ltd.\nUsers Lists.\n As On " . $today);

                $cellRange = 'A2:H2';
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
                $event->sheet->getDelegate()->getStyle('A1:H1')->applyFromArray($styleArray);

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