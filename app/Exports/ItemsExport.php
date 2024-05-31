<?php
namespace App\Exports;
use App\Item;
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

class ItemsExport implements FromQuery, WithMapping, WithHeadings, ShouldAutoSize, WithEvents, WithColumnFormatting {
	use Exportable;

	protected $sl_no = 0;
	protected $data;
	protected $param;
	protected $totalData = 0;
	public function __construct($param = 'with_serial_dF') {
		$this->param = $param;
	}

	public function query() {

		$item = Item::query();

		$item->with([
			'size' => function ($q) {
				return $q->select('id', 'name');
			},
			'brand',
			'depot' => function ($q) {
				return $q->select('id', 'name');
			},
		])
			->select('items.id', 'items.size_id', 'items.brand_id', 'items.depot_id', 'items.shop_id', 'items.serial_no', 'items.freeze_status', 'items.item_status', 'items.created_at', 'shops.outlet_name as outlet_name')
			->join('depot_users', 'depot_users.depot_id', '=', 'items.depot_id')
			->leftJoin('shops', function ($join) {
				$join->on('shops.id', '=', 'items.shop_id');
				$join->where('items.item_status', '<>', NULL);
			})
			->where('depot_users.user_id', auth()->user()->id);

		if ($this->param == 'without_serial_dF') {
			$item->whereNull('items.serial_no');
		} elseif ($this->param == 'with_serial_dF') {
			$item->whereNotNull('items.serial_no')->whereNull('item_status')->whereIn('items.freeze_status', ['used', 'fresh']);
		} elseif ($this->param == 'injected_dF') {
			$item->whereNotNull('items.serial_no')->whereNotNull('item_status')->whereIn('items.freeze_status', ['used', 'damage_applied', 'low_cooling']);
		} elseif ($this->param == 'support_dF') {
			$item->whereNotNull('items.serial_no')->where('items.freeze_status', 'support');
		} elseif ($this->param == 'low_cooling_dF') {
			$item->whereNotNull('items.serial_no')->where('items.freeze_status', 'low_cooling');
		} elseif ($this->param == 'in_sip_dF') {
			$item->whereNotNull('items.serial_no')->whereIn('items.freeze_status', ['used', 'low_cooling'])->where('items.item_status', 'in_sip');
		} elseif ($this->param == 'damage_dF') {
			$item->where('items.freeze_status', 'damage');
		} else {
			$item->whereNull('items.freeze_status');
		}
		$item->orderBy('items.updated_at', 'desc');

		$this->totalData = $item->count();

		$this->data = $item;

		return $this->data;
	}

	public function headings(): array
	{
		if ($this->param == 'without_serial_dF') {
			return [
				'SL No.',
				'Brand',
				'Size',
				'Depot',
				'Longevity Period',
				'Status',
				'Created',
			];
		} else {
			return [
				'SL No.',
				'Serial',
				'Brand',
				'Size',
				'Depot',
				'Longevity Period',
				'Status',
				'Created',
			];
		}
	}

	/**
	 * @var object $invoice
	 */
	public function map($invoice): array
	{

		$brand = $invoice->brand->name . ' (' . $invoice->brand->short_code . ')';
		$this->sl_no = $this->sl_no + 1;
		if ($this->param == 'without_serial_dF') {

			return [
				$this->sl_no,
				$brand,
				$invoice->size->name,
				$invoice->depot->name,
				$invoice->longevity_period,
				$invoice->freeze_status,
				Date::dateTimeToExcel($invoice->created_at),
			];
		} else {
			return [
				$this->sl_no,
				$invoice->serial_no ?? '',
				$brand,
				$invoice->size->name ?? '',
				$invoice->depot->name ?? '',
				$invoice->longevity_period ?? '',
				$invoice->freeze_status,
				Date::dateTimeToExcel($invoice->created_at),
			];
		}
	}
	/**
	 * @return array
	 */
	public function columnFormats(): array
	{
		if ($this->param == 'without_serial_dF') {
			return [
				'G' => NumberFormat::FORMAT_DATE_DDMMYYYY,
			];
		} else {
			return [
				'H' => NumberFormat::FORMAT_DATE_DDMMYYYY,
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

				//inserts 1 new rows, right before row 1:
				$event->sheet->getDelegate()->insertNewRowBefore(1, 1);

				//Set top row height:
				$event->sheet->getDelegate()->getRowDimension('1')->setRowHeight(40);

				//merge two or more cells together, to become one cell
				$event->sheet->getDelegate()->mergeCells('A1:H1');

				$today = date("j F, Y");
				//Set value to merge cells
				$event->sheet->getDelegate()->setCellValue("A1", "Dhaka Ice Cream Industries Ltd.\nDF Lists.\n As On " . $today);

				$cellRange = 'A2:C2';
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

				$footar1 = $this->totalData + 4;
				$footar11 = $footar1 + 1;
				$event->sheet->getDelegate()->getCell('B' . $footar1)->setValue('.............');
				$event->sheet->getDelegate()->getCell('B' . $footar11)->setValue('Provided By:');

				$footar1 = $this->totalData + 4;
				$footar11 = $footar1 + 1;
				$event->sheet->getDelegate()->getCell('C' . $footar1)->setValue('.............');
				$event->sheet->getDelegate()->getCell('C' . $footar11)->setValue('Checked By:');

				$footar1 = $this->totalData + 4;
				$footar11 = $footar1 + 1;
				$event->sheet->getDelegate()->getCell('D' . $footar1)->setValue('.............');
				$event->sheet->getDelegate()->getCell('D' . $footar11)->setValue('Approved By:');

			},
		];
	}
}

?>