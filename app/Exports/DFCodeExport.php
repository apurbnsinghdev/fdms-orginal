<?php
namespace App\Exports;
use App\DfCode;
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

class DFCodeExport implements FromQuery, WithMapping, WithHeadings, ShouldAutoSize, WithEvents, WithColumnFormatting {
	use Exportable;

	protected $sl_no = 0;
	protected $data;
	protected $param;
	protected $totalData = 0;
	public function __construct($param = '2018') {
		$this->param = $param;
	}

	public function query() {

		$codes = DfCode::query();

		$codes->where('year', $this->param)->orderBy('post_code', 'desc');

		$this->totalData = $codes->count();

		$this->data = $codes;

		return $this->data;
	}

	public function headings(): array
	{
		return [
			'SL No.',
			'Brand',
			'Size',
			'Year',
			'DF Code',
			'Created',
		];
	}

	/**
	 * @var object $invoice
	 */
	public function map($code): array
	{
		$this->sl_no = $this->sl_no + 1;
		return [
			$this->sl_no,
			$code->brand,
			$code->size,
			$code->year,
			$code->serial_no,
			Date::dateTimeToExcel($code->created_at),
		];
	}
	/**
	 * @return array
	 */
	public function columnFormats(): array
	{
		return [
			'F' => NumberFormat::FORMAT_DATE_DDMMYYYY,
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
				$event->sheet->getDelegate()->getRowDimension('1')->setRowHeight(20);

				//merge two or more cells together, to become one cell
				$event->sheet->getDelegate()->mergeCells('A1:F1');

				$today = date("j F, Y");
				//Set value to merge cells
				$event->sheet->getDelegate()->setCellValue("A1", "Dhaka Ice Cream Industries Ltd.\nDF Code Lists:$this->param.\n As On " . $today);

				$cellRange = 'A2:F2';
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
			},
		];
	}
}

?>