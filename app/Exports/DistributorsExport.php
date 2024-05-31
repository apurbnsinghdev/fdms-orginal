<?php
namespace App\Exports;
use App\Shop;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Events\AfterSheet;
use \Maatwebsite\Excel\Sheet;

class DistributorsExport implements FromQuery, WithMapping, WithHeadings, ShouldAutoSize, WithEvents {
    use Exportable;

    protected $param;
    protected $sl_no = 0;

    public function __construct() {

    }

    public function query() {

        $query = Shop::with([
            'region' => function ($q) {
                return $q->select('id', 'name');
            },
            'area' => function ($q) {
                return $q->select('id', 'name');
            },
            'district' => function ($q) {
                return $q->select('id', 'name');
            },
            'thana' => function ($q) {
                return $q->select('id', 'name');
            },
            'depot' => function ($q) {
                return $q->select('id', 'name');
            },
        ])
            ->select('shops.id', 'shops.outlet_name', 'shops.proprietor_name', 'shops.is_distributor', 'shops.distributor_id', 'shops.mobile', 'shops.depot_id', 'shops.region_id', 'shops.area_id', 'shops.district_id', 'shops.thana_id', 'shops.code', 'shops.status')
            ->withCount('retailers')
            ->where('shops.is_distributor', true)
            ->join('distributor_users', 'distributor_users.distributor_id', '=', 'shops.id')
            ->where('distributor_users.user_id', auth()->user()->id)
            ->orderBy('shops.updated_at', 'desc');

        return $query;

    }

    public function headings(): array
    {

        return ['#',
            'Distributor',
            'Proprietor Name',
            'Distributor Code',
            'Mobile',
            'Depot',
            'Region',
            'Area',
            'District',
            'Thana',
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
            $invoice->outlet_name,
            $invoice->proprietor_name,
            $invoice->code,
            (int) $invoice->mobile,
            $invoice->depot->name ?? '',
            $invoice->region->name ?? '',
            $invoice->area->name ?? '',
            $invoice->district->name ?? '',
            $invoice->thana->name ?? '',
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

                $shopName = 'Distributor';

                //inserts 1 new rows, right before row 1:
                $event->sheet->getDelegate()->insertNewRowBefore(1, 1);

                //Set top row height:
                $event->sheet->getDelegate()->getRowDimension('1')->setRowHeight(40);

                //merge two or more cells together, to become one cell
                $event->sheet->getDelegate()->mergeCells('A1:K1');

                //Set value to merge cells
                $today = date("j F, Y");
                //Set value to merge cells
                $event->sheet->getDelegate()->setCellValue("A1", "Dhaka Ice Cream Industries Ltd.\n$shopName Lists.\n As On " . $today);

                $cellRange = 'A2:K2';
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
                $event->sheet->getDelegate()->getStyle('A1:K1')->applyFromArray($styleArray);

                $styleArray = [
                    'borders' => [
                        'outline' => [
                            'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THICK,
                            'color' => ['argb' => 'DDDDDDDD'],
                        ],
                    ],
                ];
                //apply style to Header cells
                $event->sheet->getDelegate()->getStyle('A2:K2')->applyFromArray($styleArray);

            },
        ];
    }
}

?>