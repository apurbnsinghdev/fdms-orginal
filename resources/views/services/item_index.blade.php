@extends('layouts.admin')
@section('title', 'DF list for complain')
@section('content')
<div class="content-header">
    <div class="leftside-content-header">
        <ul class="breadcrumbs">
            <li><i class="fa fa-table" aria-hidden="true"></i><a href="#">Outlet's DF</a></li>
            <li><a>List For Complain</a></li>
        </ul>
    </div>
</div>

<div class="row animated fadeInRight">
    <div class="col-sm-12">
        <h4 class="section-subtitle">
            <b>Outlet's DF List For Complain</b>
        </h4>
        <span class="pull-right">
            <a class="btn btn-success btn-right-side" style="cursor:pointer" onclick="showModal('personal')">Personal DF Complain Entry</a>
        </span>
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
                            <th>Token(s)</th>
                            <th>Action</th>
                          </tr>
                        </thead>
                        <tbody>
                        </tbody>
                  </table>
                </div>
            </div>
        </div>
        <!-- Modal for problem entry start-->
        @include('common_pages.common_modal',['modalTitle'=>'Complain Entry'])
         <!-- Modal for problem entry end-->
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
                 $.fn.select2.defaults.set( "theme", "bootstrap" );
                 $(".select2").select2({
                    // placeholder: function(){
                    //     $(this).data('placeholder');
                    // },
                    allowClear: true
                });
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

@slot('css')
    <link rel="stylesheet" href="{{ asset('vendor/select2/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('vendor/select2/css/select2-bootstrap.min.css') }}">
@endslot

@include('common_pages.max_length')
<script src="{{ asset('vendor/select2/js/select2.min.js') }}"></script>
 <script>


        $(document).ready( function () {
            $('#datatable').DataTable({
                "processing": true,
                "serverSide": true,
                "order": [], /* No ordering applied by DataTables during initialisation */
                "pageLength": 25,
                "ajax": "{{ route('ajax.items.serviceIndex') }}",
                "columns": [
                    { "data": "serial_no" },
                    {
                        "orderable": false,
                        "data": "depot",
                        "name": "depots.name"
                    },
                    {
                        "data": "outlet_name",
                        "name": "shops.outlet_name"
                     },
                    {
                        "data": "proprietor_name",
                        "name": "shops.proprietor_name"
                    },
                    {
                        "data": "mobile",
                        "name": "shops.mobile"
                    },
                     {
                        "data": "size",
                        "name": "sizes.name"
                    },
                     {
                        "data": "problems",
                        "orderable": false,
                        "bSearchable": false,
                        render: function (data, type, full, meta) {
                            var tokens='';
                             if(data.length){
                                tokens=data.map(a => a.token);
                             }
                             return tokens;
                        }
                    },
                    {
                        "data": "serial_no",
                        "orderable": false,
                        "bSearchable": false,
                        render: function (data, type, full, meta) {
                             return `<a class="btn" style="cursor:pointer" onclick="showModal('`+data+`')">Complain Entry</a>`;
                        }
                    }
                ]
            });
        });
    </script>
@endcomponent

