@extends('layouts.admin')
@section('title', 'DF list for complain')
@section('content')
<div class="content-header">
    <div class="leftside-content-header">
        <ul class="breadcrumbs">
            <li><i class="fa fa-table" aria-hidden="true"></i><a href="#">Services</a></li>
            <li><a>List of Service History</a></li>
        </ul>
    </div>
</div>

<div class="row animated fadeInRight">
    <div class="col-sm-12">
        <h4 class="section-subtitle">
            <b>Service History</b>
        </h4>
        <div class="panel">
            <div class="panel-content">
				 <div class="table-responsive">
                    <table id="datatable" class="data-table table table-striped nowrap table-hover" cellspacing="0" width="100%">
                        <thead>
                          <tr>
                            <th>DF Code</th>
                            <th>Depot</th>
                            <th>Outlet</th>
                            <th>Proprietor</th>
                            <th>Mobile</th>
                            <th>DF Size</th>
                            <th>Action</th>
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
@section('vuescript')
<script>
        function showModal(serial,){
        	laravelObj.common=serial;
            var modalBody=$('#modal-body');
            modalBody.css('padding-top',0);
            modalBody.html('');
            $.ajax({
                type: 'Get',
                url:"{{ route('ajax.items.getItemDetailsBySeraial') }}",
                data:{serial:serial}
            }).done(function(response) {
                 modalBody.html(response);
            }).fail(function(response) {
                console.log(response);
            });
            $('#common-modal').modal('show');
        };

      //get distributor(request goes in requisition route)
        function getDepotDistributor(depotId){
        	$('#shop-list').html('');
        	$.ajax({
              type: 'Get',
              url:"{{ route('ajax.getShops') }}",
              data:{depot_id:depotId,distributor:1}
          	}) .done(function(response) {
             $('#shop-list').html(response);
             //remove empty value option
             $('#shop_id option')
             .filter(function() {
                 return !this.value || $.trim(this.value).length == 0 || $.trim(this.text).length == 0;
             })
             .remove();

            if('{{old('shop_id')}}'){
            	$("#shop_id").val('{{old('shop_id')}}').change();
            }

          })
          .fail(function(response) {
          });
        }
    </script>
@stop

@component('common_pages.data_table_script')
    @include('common_pages.max_length')
 <script>

        $(document).ready( function () {
            $('#datatable').DataTable({
                "processing": true,
                "serverSide": true,
                "order": [], /* No ordering applied by DataTables during initialisation */
                "pageLength": 25,
                "ajax": "{{ route('ajax.items.serviceHistory') }}",
                "columns": [
                    { "data": "serial_no" },
                    {
                        "orderable": false,
                        "data": "depot",
                        "name":"depots.name"
                    },
                    { "data": "outlet_name","name":"shops.outlet_name" },
                    { "data": "proprietor_name" ,"name":"shops.proprietor_name"},
                    { "data": "mobile","name":"shops.mobile" },
                     { "data": "size","name":"sizes.name" },
                    {
                        "data": "serial_no",
                        "orderable": false,
                        "bSearchable": false,
                        render: function (data, type, full, meta) {
                            var actionStr = '';

                            actionStr = actionStr + '<a href="'+laravelObj.appHost+'/service-history/'+full.id+'" class="btn btn-info">Service History</a>';
                            return actionStr;

                        }
                    }
                ]
            });
        });
    </script>
@endcomponent

