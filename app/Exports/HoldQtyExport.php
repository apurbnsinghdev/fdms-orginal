<?php
namespace App\Exports;

use App\HoldStock;
use App\Item;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Events\AfterSheet;
use \Maatwebsite\Excel\Sheet;

class HoldQtyExport implements FromCollection, WithHeadings, ShouldAutoSize, WithEvents {
	use Exportable;

	public function __construct() {

	}

	public function collection() {

		$availableDF = Item::select('items.depot_id', 'items.size_id', 'items.brand_id', \DB::raw('COUNT(items.id) as total'))
			->availableDFQty()
			->groupBy(['items.depot_id', 'items.size_id', 'items.brand_id']);

		$data = HoldStock::rightJoinSub($availableDF, 'items', function ($join) {
			$join->on('items.brand_id', '=', 'hold_stocks.brand_id')
				->on('items.size_id', '=', 'hold_stocks.size_id')
				->on('items.depot_id', '=', 'hold_stocks.depot_id');
		})
		//->whereRaw('hold_stocks.qty < items.total')
		//->orWhereNull('hold_stocks.qty')
			->join('depots', 'depots.id', '=', 'items.depot_id')
			->join('sizes', 'sizes.id', '=', 'items.size_id')
			->join('brands', 'brands.id', '=', 'items.brand_id')
			->select('depots.name as depot', 'brands.short_code as brand', 'sizes.name as size', 'items.total', /* \DB::raw("IFNULL(hold_stocks.qty,'0') as qty"),*/'hold_stocks.qty', \DB::raw('items.total-IFNULL(hold_stocks.qty,0) as remain'))
			->orderBy('items.depot_id')
			->get();

		return $data;
	}

	public function headings(): array
	{

		return [
			'Depot',
			'Brand',
			'Size',
			'Available Qty',
			'Hold Qty',
			'Remaining Qty',
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
				$event->sheet->getDelegate()->mergeCells('A1:F1');

				$today = date("j F, Y");
				//Set value to merge cells
				$event->sheet->getDelegate()->setCellValue("A1", "Dhaka Ice Cream Industries Ltd.\nDepot Hold Qty With Available Qty.\n As On " . $today);

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
				$event->sheet->getDelegate()->getStyle('A1:F1')->applyFromArray($styleArray);
			},
		];
	}
}

?>