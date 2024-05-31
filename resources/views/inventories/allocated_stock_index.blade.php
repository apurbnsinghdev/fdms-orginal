@extends('layouts.admin')
@section('title', 'Allocated Stock Lists')
@section('content')
<div class="content-header">
    <div class="leftside-content-header">
        <ul class="breadcrumbs">
            <li><i class="fa fa-table" aria-hidden="true"></i><a href="#">Allocated Stock</a></li>
            <li><a>Lists</a></li>
        </ul>
    </div>
</div>
<div class="row animated fadeInRight">
    <div class="col-sm-12">
       <h4 class="section-subtitle"><b>Allocated Stock Lists</b></h4>
        <span class="pull-right">
            {!! Html::decode(link_to_route('inventories.stockIndex','<i class="fa fa-list"></i>',null,array('class'=>'btn btn-success btn-right-side'))) !!}
        </span>
        <div class="panel">
            <div class="panel-content">
         <div class="table-responsive">
                    <table id="datatable" class="data-table table table-striped nowrap table-hover" cellspacing="0" width="100%">
                        <thead>
                          <tr>
                            <th class="no-sort">Invoice No.</th>
                            <th>Invoice Date</th>
                            <th>Created Date</th>
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
@endsection
@component('common_pages.data_table_script')
 <script src="{{ asset('vendor/moment/moment.js') }}"></script>
 <script>
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
                "ajax": "{{ route('ajax.allocation.index',[]) }}",
                "columns": [
                    {
                      "data": "stock.invoice_no",
                      "defaultContent":""
                    },
                    {
                      "data": "stock.invoice_date",
                       render: function(data, type, row){
                            if(type === "sort" || type === "type"){
                                return data;
                            }
                            return moment(data).format("ll");
                        }
                    },
                    {
                      "data": "created_at",
                       render: function(data, type, row){
                            if(type === "sort" || type === "type"){
                                return data;
                            }
                            return moment(data).format("lll");
                        }
                    },
                    {
                      "data": "stock_id",
                      "orderable": false,
                      "bSearchable": false,
                      render: function (data, type, full, meta) {
                        var actions='<a href="' + laravelObj.appHost + "/depot/allocations/" + data + '"><span aria-hidden="true" class="fa fa-list fa-x"></span></a>';
                          if(full.stock.is_allocated<2){
                            actions+='<a href="' + laravelObj.appHost + "/allocations/" + data + '/edit"><span aria-hidden="true" class="fa fa-edit fa-x"></span></a>'+
                                '<form method="POST" action="'+laravelObj.appHost+'/allocations/'+data+'" accept-charset="UTF-8" class="delete-form"><input name="_method" type="hidden" value="DELETE"><input name="_token" type="hidden" value="'+Laravel.csrfToken+'"><button type="submit" class="btn btn-xs" title="" data-original-title="Delete"><span aria-hidden="true" class="fa fa-remove"></span></button></form>';
                          }
                          return  actions;
                        }
                    }
                ],
                "fnDrawCallback": function (oSettings) {
                    var tooltipArr = [
                        { "className": "fa-edit", "title": "Edit" },
                        { "className": "fa-list", "title": "View List" },
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



