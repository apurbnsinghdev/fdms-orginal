@extends('layouts.admin')
@section('title', 'Stock Lists')
@section('content')
<div class="content-header">
    <div class="leftside-content-header">
        <ul class="breadcrumbs">
            <li><i class="fa fa-table" aria-hidden="true"></i><a href="#">Stock</a></li>
            <li><a>Lists</a></li>
        </ul>
    </div>
</div>
<div class="row animated fadeInRight">
    <div class="col-sm-12">
       <h4 class="section-subtitle"><b>Stock Lists</b></h4>
        <span class="pull-right">
            {!! Html::decode(link_to_route('inventories.stockCreate','<i class="fa fa-plus"></i>',[],array('class'=>'btn btn-success btn-right-side'))) !!}
        </span>
        <div class="panel">
            <div class="panel-content">
				        <div class="table-responsive">
                    <table id="datatable" class="data-table table table-striped nowrap table-hover" cellspacing="0" width="100%">
                        <thead>
                          <tr>
                            <th class="no-sort">Supplier</th>
                            <th class="no-sort">Invoice No.</th>
                            <th>Invoice Date</th>
                            <th class="no-sort">LC. No.</th>
                            <th class="no-sort">Number of Types</th>
                            <th>Total Items</th>
                            <th class="no-sort">Status</th>
                            <th class="no-sort">Action</th>
                          </tr>
                        </thead>
                        <tbody>
                        </tbody>
                  </table>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Modal -->
@include('common_pages.common_modal',['modalTitle'=>'Stock Informations'])
@endsection
@component('common_pages.data_table_script')
 <script src="{{ asset('vendor/moment/moment.js') }}"></script>
 <script>
        function showModal(id){
            $.get(laravelObj.appHost+"/get-stock-details/"+id, function(data, status){
               $('#modal-body').html(data);
            });
            $('#common-modal').modal('show');
        };

        $(document).ready( function () {
            $('#datatable').DataTable({
                "processing": true,
                "serverSide": true,
                "order": [], /* No ordering applied by DataTables during initialisation */
                "columnDefs": [ {
                  "targets": 'no-sort',
                  "orderable": false,
                  "order": []
                } ],
                "pageLength": 25,
                "ajax": "{{ route('ajax.stocks.get',[]) }}",
                "columns": [
                     {
                      "data": "supplier.name",
                      "defaultContent":""
                     },
                    {
                      "data": "invoice_no",
                      "defaultContent":""
                    },
                    {
                      "data": "invoice_date",
                      "bSearchable": false,
                       render: function(data, type, row){
                            if(type === "sort" || type === "type"){
                                return data;
                            }
                            return moment(data).format("ll");
                        }
                    },
                    { "data": "lc_no","defaultContent":"" },
                    {
                      "data": "no_of_type",
                      "bSearchable": false,
                      "defaultContent":"0" },
                    {
                      "data": "total_item",
                      "bSearchable": false,
                      "defaultContent":"0"
                    },
                    {
                      "data": "status",
                    },
                    {
                      "data": "id",
                      "orderable": false,
                      "bSearchable": false,
                      render: function (data, type, full, meta) {
                          if(full.is_allocated){
                            return `<a style="cursor:pointer" onclick="showModal(`+data+`)"><span aria-hidden="true" class="fa fa-eye fa-x"></span></a>`+
                             '<a href="' + laravelObj.appHost + "/stocks/" + data + '/edit"><span aria-hidden="true" class="fa fa-edit fa-x"></span></a>';
                          }else{
                            return `<a style="cursor:pointer" onclick="showModal(`+data+`)"><span aria-hidden="true" class="fa fa-eye fa-x"></span></a>`+
                            '<a href="' + laravelObj.appHost + "/stocks/" + data + '/stock-allocate"><span aria-hidden="true" class="fa fa-truck fa-x"></span></a>'+
                            '<a href="' + laravelObj.appHost + "/stocks/" + data + '/edit"><span aria-hidden="true" class="fa fa-edit fa-x"></span></a>'+
                            '<form method="POST" action="'+laravelObj.appHost+'/stocks/'+data+'" accept-charset="UTF-8" class="delete-form"><input name="_method" type="hidden" value="DELETE"><input name="_token" type="hidden" value="'+Laravel.csrfToken+'"><button type="submit" class="btn btn-xs" title="" data-original-title="Delete"><span aria-hidden="true" class="fa fa-remove"></span></button></form>';
                          }

                        }
                    }
                ],
                "fnDrawCallback": function (oSettings) {
                    var tooltipArr = [
                        { "className": "fa-edit", "title": "Edit" },
                        { "className": "fa-eye", "title": "View" },
                        { "className": "fa-truck", "title": "Allocate" },
                        { "className": "fa-remove", "title": "Delete" },
                    ];
                    tooltipArr.forEach(function(item, index) {
                        var tis = $('.' + item.className).parent();
                        tis.attr("title", item.title);
                        tis.tooltip();
                    });
                }
            });
        });
    </script>
    @slot('css')
      <style>
        .fa.fa-x{
          margin-left: 5px;
        }
      </style>
    @endslot
@endcomponent

