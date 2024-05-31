<?php
namespace App\Exports;
use App\Shop;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Events\AfterSheet;
use PhpOffice\PhpSpreadsheet\Shared\Date;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;
use \Maatwebsite\Excel\Sheet;
use \Carbon\Carbon;


class ShopExport implements FromQuery, WithMapping, WithHeadings, ShouldAutoSize, WithEvents ,WithColumnFormatting{
	use Exportable;

	protected $param;
	protected $depot_id;
	protected $distributor_id;
	protected $sl_no = 0;

	public function __construct(int $param = 0, int $depot_id = 0, int $distributor_id = 0) {
		$this->param = $param;
		$this->depot_id = $depot_id;
		$this->distributor_id = $distributor_id;
	}

	public function query() {
	    
		$query = Shop::select(
			'shops.id',
		    'shops.created_at',
			'shops.outlet_name as outlet_name',
			'shops.proprietor_name',
			'shops.is_distributor',
			'shops.distributor_id',
			'shops.mobile',
		    'shops.category',
		    'shops.nid',
		    'shops.trade_license',
		    'shops.estimated_sales',
			'division.name as divisionName',
			'district.name as districtName',
			'thana.name as thanaName',
			'region.name as regionName',
			'area.name as areaName',
			'shops.code',
			'shops.status',
		    'shops.address',
			'distributor.outlet_name as distributor',
			'depots.name as depotName'
		)
			->withCount('requisitions')
			->where('shops.is_distributor', false)
			->join('depots', 'depots.id', '=', 'shops.depot_id')
			->leftJoin('zones as region', 'region.id', '=', 'shops.region_id')
			->leftJoin('zones as area', 'area.id', '=', 'shops.area_id')
			->leftJoin('locations as division', 'division.id', '=', 'shops.division_id')
			->leftJoin('locations as district', 'district.id', '=', 'shops.district_id')
			->leftJoin('locations as thana', 'thana.id', '=', 'shops.thana_id')
			->join('distributor_users', 'distributor_users.distributor_id', '=', 'shops.distributor_id')
			->join('shops as distributor', 'distributor.id', '=', 'shops.distributor_id')
			->where('distributor_users.user_id', auth()->user()->id);
		
		if(!empty($this->depot_id)){
		    $query->where('shops.depot_id', $this->depot_id);
		}
		if(!empty($this->distributor_id)){
		    $query->where('shops.distributor_id', $this->distributor_id);
		}
		if (!$this->param) {
			$query->join('settlements', 'shops.id', '=', 'settlements.shop_id')
				->whereIn('settlements.status', ['continue', 'reserve'])
				->join('items', 'items.id', '=', 'settlements.item_id')
				->join('sizes', 'sizes.id', '=', 'items.size_id')
				->join('brands', 'brands.id', '=', 'items.brand_id')
				->addSelect('items.serial_no as dfCodes','items.freeze_status','sizes.name as size_title','brands.name as brandName','settlements.receive_amount','settlements.inject_date');
		} else {
			$query->leftJoin('settlements', 'settlements.shop_id', '=', 'shops.id')
				->selectRaw('SUM(settlements.status in ("continue","reserve")) as countVal')
				->having('countVal', '<', 1)
				->orHavingRaw('countVal is null')
				->groupBy('shops.id')->orderBy('shops.updated_at', 'desc');

		}
		
		return $query;

	}

	public function headings(): array
	{
		if (!$this->param) {
			$arr = ['Outlet ID',
				'Outlet',
			    'Proprietor Name',
				'DF Codes',
			    'Brand',
			    'Size',
			    'Freeze Status',
			    'Inject Date',
			    'Receive Amount',
			    'Category',
			    'NID',
			    'Trade License',
			    'Estimated Sales',
				'Distributor',
				'Mobile',
				'Depot',
				'Region',
				'Area',
				'Division',
				'District',
				'Thana',
			    'Address'
			];
		} else {
			$arr = ['Outlet ID',
				'Outlet',
				'Proprietor Name',
				'Distributor',
			    'Category',
			    'NID',
			    'Trade License',
			    'Estimated Sales',
				'Mobile',
				'Depot',
				'Region',
				'Area',
				'Division',
				'District',
				'Thana',
			    'Address'
			];
		}

		return $arr;
	}

	/**
	 * @var object $invoice
	 */
	public function map($invoice): array
	{
	   // dd($invoice);
		$this->sl_no = $this->sl_no + 1;
		if (!$this->param) {
			$arr = [
				//$this->sl_no,
			    $invoice->id,
				$invoice->outlet_name,
			    $invoice->proprietor_name,
				$invoice->dfCodes,
			    $invoice->brandName,
			    $invoice->size_title,
			    ucwords(str_replace('_', ' ', $invoice->freeze_status)),
			    Date::dateTimeToExcel(Carbon::parse($invoice->inject_date)),
			    $invoice->receive_amount ?? '0',
			    $invoice->category ?? '',
			    $invoice->nid ? 'NID-'.$invoice->nid : '',
			    $invoice->trade_license ?? '',
			    $invoice->estimated_sales ?? '',
			    $invoice->distributor,
				(int) $invoice->mobile,
				$invoice->depotName ?? '',
				$invoice->regionName ?? '',
				$invoice->areaName ?? '',
				$invoice->divisionName ?? '',
				$invoice->districtName ?? '',
				$invoice->thanaName ?? '',
			    $invoice->address ?? '',
			];
		} else {
			$arr = [
				//$this->sl_no,
			    $invoice->id,
				$invoice->outlet_name,
				$invoice->proprietor_name,
				$invoice->distributor,
			    $invoice->category ?? '',
			    $invoice->nid ? 'NID-'.$invoice->nid : '',
			    $invoice->trade_license ?? '',
			    $invoice->estimated_sales ?? '',
				(int) $invoice->mobile,
				$invoice->depotName ?? '',
				$invoice->regionName ?? '',
				$invoice->areaName ?? '',
				$invoice->divisionName ?? '',
				$invoice->districtName ?? '',
				$invoice->thanaName ?? '',
			    $invoice->address ?? '',
			];
		}
		return $arr;

	}
	public function columnFormats(): array
	{
	    if (!$this->param) {
	        return [
	            'H' => NumberFormat::FORMAT_DATE_DDMMYYYY,
	            'K' => NumberFormat::FORMAT_TEXT,
	        ];
	    }else{
	        return [];
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

				if (!$this->param) {
					$shopName = 'Injected DF Retailer';
				} else {
					$shopName = 'Not Injected DF Retailer';
				}

				//inserts 1 new rows, right before row 1:
				$event->sheet->getDelegate()->insertNewRowBefore(1, 1);

				//Set top row height:
				$event->sheet->getDelegate()->getRowDimension('1')->setRowHeight(40);

				//merge two or more cells together, to become one cell
				$event->sheet->getDelegate()->mergeCells('A1:V1');

				//Set value to merge cells
				$today = date("j F, Y");
				//Set value to merge cells
				$event->sheet->getDelegate()->setCellValue("A1", "Dhaka Ice Cream Industries Ltd.\n$shopName Lists.\n As On " . $today);

				$cellRange = 'A2:V2';
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
				$event->sheet->getDelegate()->getStyle('A1:V1')->applyFromArray($styleArray);

				$styleArray = [
					'borders' => [
						'outline' => [
							'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THICK,
							'color' => ['argb' => 'DDDDDDDD'],
						],
					],
				];
				//apply style to Header cells
				$event->sheet->getDelegate()->getStyle('A2:V2')->applyFromArray($styleArray);

			},
		];
	}
}

?>