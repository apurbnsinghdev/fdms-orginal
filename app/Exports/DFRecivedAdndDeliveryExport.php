<?php
namespace App\Exports;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class DFRecivedAdndDeliveryExport implements FromView, ShouldAutoSize {

    use Exportable;

    protected $data;
    protected $param;

    public function __construct($param, $data) {
        $this->param = $param;
        $this->data = $data;
    }

    public function view(): View {

        if ($this->param == 0) {
            return view('reports.inventory.receive_delivery.overall_report', $this->data);
        } elseif ($this->param == 1) {
            return view('reports.inventory.receive_delivery.received_report', $this->data);
        } else {
            return view('reports.inventory.receive_delivery.delivery_report', $this->data);
        }

    }

}