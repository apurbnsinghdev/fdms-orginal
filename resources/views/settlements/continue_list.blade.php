@extends('layouts.admin')
@section('title', 'Continue Lists')
@section('content')

<div class="content-header">
    <div class="leftside-content-header">
        <ul class="breadcrumbs">
            <li><i class="fa fa-table" aria-hidden="true"></i><a href="#">Settlement</a></li>
            <li><a>Continue List</a></li>
        </ul>
    </div>
</div>

<div class="tabs">
    <ul class="nav nav-tabs">
        <li class="@if($param=='without_rent'){{ 'active' }}@endif"><a href="{{ route('settlements.continueList',['without_rent']) }}">Without Rent</a></li>
        <li class="@if($param=='rent'){{ 'active' }}@endif"><a href="{{ route('settlements.continueList',['rent']) }}">Full Paid/Concession</a></li>
    </ul>
</div>

<div class="row animated fadeInRight">
    <div class="col-sm-12">
        <h4 class="section-subtitle">
            <b>
                @if ($param=='without_rent')
                   Without Rent
                @else
                    Full Paid/Concession
                @endif
                List
            </b>
        </h4>
      {{--   <span class="pull-right">
            {!! Html::decode(link_to_route('shops.download','<i class="fa fa-download" aria-hidden="true"></i>',!$param?[]:['param'=>1],array('class'=>'btn btn-success btn-right-side'))) !!}
        </span> --}}

        <div class="panel">
            <div class="panel-content">
				        <div class="table-responsive">
                    <table id="datatable" class="data-table nowrap table table-striped table-hover" cellspacing="0" width="100%">
                        <thead>
                          <tr>
                            <th>Outlet</th>
                            <th>DF Code</th>
                            <th class="no-sort">Injected Date</th>
                            <th class="no-sort">Used Month</th>
                            @if ($param=='rent')
                              <th class="no-sort">Received Amount</th>
                              <th class="no-sort">Installment</th>
                              <th class="no-sort">Due Amount</th>
                            @endif
                            <th>Depot</th>
                            <th>Distributor</th>
                            <th>Status</th>
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
     <!-- Modal -->
     @include('common_pages.common_modal',['modalTitle'=>'All Documents'])
</div>
@endsection
@component('common_pages.data_table_script')
@slot('css')
  <style>
    tr td:last-child{
      text-transform:capitalize;
    }
  </style>
@endslot
 <script src="{{ asset('vendor/moment/moment.js') }}"></script>
 <script>
        $(document).ready( function () {
            $('#datatable').DataTable({
                "processing": true,
                "serverSide": true,
                "order": [], /* No ordering applied by DataTables during initialisation */
                "pageLength": 25,
                "columnDefs": [ {
                  "targets": 'no-sort',
                  "orderable": false,
                  "order": []
                } ],
                "ajax": "{{ route('ajax.settlements.continueList',[$param]) }}",
                "columns": [
                    {
                      "data": "outlet_name",
                      "name":"shops.outlet_name"
                    },
                    {
                      "data": "df_code",
                      "name":"items.serial_no"
                     },
                    {
                      "data": "inject_date",
                       render: function(data, type, row){
                            if(type === "sort" || type === "type"){
                                return data;
                            }
                            return moment(data).format("lll");
                        }
                     },
                    {
                     "data": "usedMonths",
                      "orderable": false,
                      "bSearchable": false
                     },
                    @if ($param=='rent')
                      {
                        "data": "receive_amount",
                        "bSearchable": false
                       },
                       {
                        "data": "installment",
                        "bSearchable": false
                       },
                      {
                        "data": "dueAmount",
                        "bSearchable": false
                       },
                    @endif
                    {
                      "data": "depot",
                      "name":"depots.name"
                     },
                    {
                     "data": "distributor",
                     "name":"distributors.outlet_name"
                    },
                    {
                      "data": "status",
                      "name":"settlements.status"
                    },
                    {
                    	  "data": "shop_id",
                          "orderable": false,
                          "bSearchable": false,
                          render: function (data, type, full, meta) {
                          		 return  `<a style="cursor:pointer" onclick="getAllDocuments(`+data+`,`+full.requisition_id+`)"><span aria-hidden="true" class="fa fa-file fa-x"></span></a>`;
                          }
                    }
                ],
                "fnDrawCallback": function (oSettings) {
                    var tooltipArr = [
                    	{"className": "fa-file", "title": "View Documents" }
                         
                    ];
                    tooltipArr.forEach(function(item, index) {
                        var tis = $('.' + item.className).parent();
                        tis.attr("title", item.title);
                        tis.tooltip();
                    });
                }
            });
        });

        //view all documents
        function getAllDocuments(shopId,requisitionId){
      	  var modalBody=$('#modal-body');
          	modalBody.css('padding-top',0);
          	modalBody.html('');
      		$.ajax({
      			type: 'Get',
                url:"{{ route('ajax.getAllDocuments') }}",
                data:{shop_id:shopId,requisition_id:requisitionId}
            }) .done(function(response) {
              $('#modal-title').html('All Documents');
              $('#modal-body').html(response);
            })
            .fail(function(response) {
              console.log(response);
          });
          $('#common-modal').modal('show');
      };
    </script>
@endcomponent

