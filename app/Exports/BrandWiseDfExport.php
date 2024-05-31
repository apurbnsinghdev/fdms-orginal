<?php
namespace App\Exports;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;

class BrandWiseDfExport implements FromView, ShouldAutoSize, WithColumnFormatting, WithEvents {

	use Exportable;

	protected $data;

	public function __construct($data) {
		$this->data = $data;
	}

	public function view(): View {

		if ($this->data['param'] == 0) {
			return view('reports.inventory.brand_wise.region_report', $this->data);
		} elseif ($this->data['param'] == 1) {
			return view('reports.inventory.brand_wise.location_report', $this->data);
		} else {

			return view('reports.inventory.brand_wise.depot_report', $this->data);
		}
	}

	public function columnFormats(): array
	{
		return [
			'B' => 'wrap-text',
		];
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

				$highestRow = $event->sheet->getDelegate()->getHighestRow();
				$brand_id = null;

				if ($this->data['param'] == 0) {
					$loop = 4;
				} elseif ($this->data['param'] == 1) {
					$loop = 5;
				} else {
					$loop = 4;
				}

				foreach ($this->data['brandSizes'] as $brand) {

					if ($brand_id == null) {
						$brand_id = $brand->brand_id;
						$brand_code = $brand->brand_code;
					} elseif ($brand_id != $brand->brand_id) {
						$brand_id = null;
					}

					if ($brand_id == null) {

						//$cell = $event->sheet->getDelegate()->getCellByColumnAndRow($loop, 1);
						$cellName = $this->columnLetter($loop);

						$event->sheet->getDelegate()->getStyle($cellName . '1:' . $cellName . $highestRow)->applyFromArray($styleArray);
						$loop++;
					}

					$loop++;

				}

				$cellName = $this->columnLetter($loop);

				$event->sheet->getDelegate()->getStyle($cellName . '1:' . $cellName . $highestRow)->applyFromArray($styleArray);

				$cellName = $this->columnLetter($loop + 1);

				$event->sheet->getDelegate()->getStyle($cellName . '1:' . $cellName . $highestRow)->applyFromArray($styleArray);

				//apply style to merge cells

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