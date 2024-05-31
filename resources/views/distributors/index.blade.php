@extends('layouts.admin')
@section('title', 'Shop Lists')
@section('content')
<div class="content-header">
    <div class="leftside-content-header">
        <ul class="breadcrumbs">
            <li><i class="fa fa-table" aria-hidden="true"></i><a href="#">Distributor</a></li>
            <li><a>Lists</a></li>
        </ul>
    </div>
</div>

<div class="row animated fadeInRight">
    <div class="col-sm-12">
        <h4 class="section-subtitle">
            <b> Distributor Lists</b>
        </h4>
        <span class="pull-right">

          {!! Html::decode(link_to_route('distributor.download','<i class="fa fa-download" aria-hidden="true"></i>',[],array('class'=>'btn btn-success btn-right-side'))) !!}

            {!! Html::decode(link_to_route('distributors.create','<i class="fa fa-plus"></i>',[],array('class'=>'btn btn-success btn-right-side'))) !!}
        </span>
        <div class="panel">
            <div class="panel-content">
				 <div class="table-responsive">
                    <table id="datatable" class="data-table table table-striped table-hover" cellspacing="0" width="100%">
                        <thead>
                          <tr>
                            <th class="no-sort">Distributor</th>
                            <th class="no-sort">Proprietor Name</th>
                            <th class="no-sort">Distributor Code</th>
                            <th class="no-sort">Mobile</th>
                            <th>Depot</th>
                            <th>Region</th>
                            <th>Area</th>
                            <th>District</th>
                            <th>Thana</th>
                            <th class="no-sort">Status</th>
                        	  <th></th>
                            <th class="no-sort">Action</th>
                          </tr>
                        </thead>
                        <tbody>
                        </tbody>
                  </table>
                </div>
            </div>
        </div>
        <!-- Modal -->
        @include('common_pages.common_modal',['modalTitle'=>'Distributor Informations'])
        @include('common_pages.common_modal',['modalTitle'=>'Delete Distributor','id'=>'common-modal2','bodyid'=>'modal-body2'])
    </div>
</div>

@endsection
@component('common_pages.data_table_script')
@slot('css')
  <style>
    tr td{
      text-transform:capitalize;
    }
  </style>
@endslot
 <script>
 		//show modal for details view
        function showModal(id){
            $.get(laravelObj.appHost+"/get-distributor-details/"+id, function(data, status){
                var modalBody=$('#modal-body');
                modalBody.css('padding-top',0);
                modalBody.html(data);
            });
            $('#common-modal').modal('show');
        };

      //show modal for delete distributor
        function showModal2(id,depotId){
        	$.ajax({
              type: 'POST',
              url:"{{ route('ajax.shops.getDepotDistributor') }}",
              data:{_token:window.Laravel.csrfToken,distributor_id:id,depot_id:depotId}
          	}) .done(function(response) {
          		 var modalBody=$('#modal-body2');
                 modalBody.css('padding-top',0);
                 modalBody.html(response);
                 $('#common-modal2').modal('show');

          })
          .fail(function(response) {
          });
        }

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
                "ajax": "{{ route('ajax.distributor.get') }}",
                "columns": [
                    { "data": "outlet_name" },
                    { "data": "proprietor_name" },
                   	{ "data": "code" },
                    { "data": "mobile" },
                    { "data": "depot.name" },
                    { "data": "region.name" },
                    {
                      'data':'area.name',
                      "orderable": false,
                      'defaultContent':''
                    },
                    {
                      'data':'district.name',
                      'defaultContent':''
                    },
                    {
                      'data':'thana.name',
                      "orderable": false,
                      'defaultContent':''
                    },
                    {
                        "data": "status",
                        'defaultContent':''
                     },

                     {
                         "data": "id",
                         "orderable": false,
                         "bSearchable": false,
                          render: function (data, type, full, meta) {
                              var btn = '';
                              if(full.retailers_count){
                            	  btn = '<a href="' + laravelObj.appHost + "/distributor/shops/" + data + '"><span aria-hidden="true" class="fa fa-list fa-x"></span></a>';
                              }
                             return btn;
                         }
                      },
                    {
                        "data": "id",
                        "orderable": false,
                        "bSearchable": false,
                        render: function (data, type, full, meta) {
                        	 if(full.status=='inactive'){
                        		 return `<a style="cursor:pointer" onclick="showModal(`+data+`)"><span aria-hidden="true" class="fa fa-eye fa-x"></span></a> `+
                                 '<a href="' + laravelObj.appHost + "/distributors/" + data + '/edit"><span aria-hidden="true" class="fa fa-edit fa-x"></span></a>';
                        	 }else{
                        		 return `<a style="cursor:pointer" onclick="showModal(`+data+`)"><span aria-hidden="true" class="fa fa-eye fa-x"></span></a> `+
                                 '<a href="' + laravelObj.appHost + "/distributors/" + data + '/edit"><span aria-hidden="true" class="fa fa-edit fa-x"></span></a>'+
                                 '<a style="cursor:pointer" onclick="showModal2('+data+','+full.depot_id+')"><span aria-hidden="true" class="fa fa-remove fa-x"></span></a>';

                        	 }
                        }
                    },
                ],
                "fnDrawCallback": function (oSettings) {
                    var tooltipArr = [
                        { "className": "fa-edit", "title": "Edit" },
                        { "className": "fa-eye", "title": "View" },
                        { "className": "fa-remove", "title": "Delete" },
                        { "className": "fa-wpforms", "title": "Requisition Create" },
                        { "className": "fa-list", "title": "Retailer List" },

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
@endcomponent

