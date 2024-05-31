@extends('layouts.admin')
@section('title', 'Closed Lists')
@section('content')

@php
  $payToOutlet=false;
@endphp
@if(isMenuRender('SettlementsController@payToOutlet',$menu_list))
   @php
     $payToOutlet=true;
   @endphp
@endif

<div class="content-header">
    <div class="leftside-content-header">
        <ul class="breadcrumbs">
            <li><i class="fa fa-table" aria-hidden="true"></i><a href="#">Settlement</a></li>
            <li><a>Closed List</a></li>
        </ul>
    </div>
</div>

<div class="tabs">
    <ul class="nav nav-tabs">
        <li class="@if($param=='payable'){{ 'active' }}@endif"><a href="{{ route('settlements.closedList',['payable']) }}">Payable</a></li>
        <li class="@if($param=='paid'){{ 'active' }}@endif"><a href="{{ route('settlements.closedList',['paid']) }}">Paid</a></li>
        <li class="@if($param=='all'){{ 'active' }}@endif"><a href="{{ route('settlements.closedList',['all']) }}">All</a></li>
    </ul>
</div>

<div class="row animated fadeInRight">
    <div class="col-sm-12">
        <h4 class="section-subtitle">
            <b>
                @if ($param=='payable')
                  Payable
                @elseif($param=='paid')
                  Paid
                @else
                  All
                @endif
                  List
            </b>
        </h4>
       {{--  <span class="pull-right">
            {!! Html::decode(link_to_route('shops.download','<i class="fa fa-download" aria-hidden="true"></i>',!$param?[]:['param'=>1],array('class'=>'btn btn-success btn-right-side'))) !!}
        </span> --}}

        <div class="panel">
            <div class="panel-content">
              {{ Form::model([],array('route' => array('settlements.payToOutlet'),'id'=>'frm-datatable')) }}
                <div class="table-responsive">
                  <table id="datatable" class="data-table table table-striped table-hover" cellspacing="0" width="100%">
                        <thead>
                          <tr>
                            @if ($param == 'payable' && $payToOutlet)
                            <th>
                            	<div class="checkbox-custom checkbox-success th-custom-check">
                              		<input type="checkbox" name="select_all" value="1" id="datatable-select-all"> 
                              		<label for="datatable-select-all" class="check"></label>
                          		</div>
                            </th>
                            @endif
                            <th>Outlet</th>
                            <th>DF Code</th>
                            <th class="no-sort">Injected Date</th>
                            <th class="no-sort">Closed Date</th>
                            <th class="no-sort">Used Month</th>
                            <th>Received Amount</th>
                            @if ($param == 'payable')
                              <th class="no-sort">Installment</th>
                              <th class="no-sort">Payable Amount</th>
                            @elseif($param == 'paid')
                              <th class="no-sort">Paid Amount</th>
                              <th class="no-sort">Paid Date</th>
                            @endif
                            <th>Depot</th>
                            <th>Distributor</th>
                            <th>Status</th>
                            @if ($param == 'paid')
                              <th class="no-sort">Money Receipt</th>
                            @endif
                          </tr>
                        </thead>
                        <tbody>
                        </tbody>
                  </table>
                </div>
                @if ($param == 'payable' && $payToOutlet)
                <p class="form-group">
                   <button type="submit" class="btn btn-primary">Pay</button>
                </p>
                @endif
              {{ Form::close() }}
            </div>
        </div>

    </div>
</div>
@endsection
@component('common_pages.data_table_script')
@slot('css')
  <style>
    tr td:nth-last-child(2),
    tr td:last-child{
      text-transform:capitalize;
    }
  </style>
@endslot
<script src="{{ asset('vendor/moment/moment.js') }}"></script>
 <script>
        String.prototype.capitalize = function() {
          return this.charAt(0).toUpperCase() + this.slice(1);
      }

  $(document).ready( function () {
      var table =$('#datatable').DataTable({
                "processing": true,
                "serverSide": true,
                "order": [], /* No ordering applied by DataTables during initialisation */
                "pageLength": 25,
                "columnDefs": [ {
                  "targets": 'no-sort',
                  "orderable": false,
                  "order": []
                }
              @if ($param == 'payable' && $payToOutlet)
                ,{
                   'targets': 0,
                   'searchable': false,
                   'orderable': false,
                   'className': 'dt-body-center',
                   'render': function (data, type, full, meta){
                	 return  '<div class="checkbox-custom checkbox-success">'+
                 		'<input type="checkbox" id="checkboxCustom'+data+'" name="id[]" value="' + $('<div/>').text(data).html() + '">'+ 
                 		'<label for="checkboxCustom'+data+'" class="check"></label>'+
             		'</div>';
                      // return '<input type="checkbox" name="id[]" value="' + $('<div/>').text(data).html() + '">';
                   }
                }
              @endif
                ],
                "ajax": "{{ route('ajax.settlements.closedList',[$param]) }}",
                "columns": [
                  @if ($param == 'payable' && $payToOutlet)
                    {
                      "data": "id",
                      "orderable": false,
                      "bSearchable": false
                    },
                  @endif
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
                            return moment(data).format("ll");
                        }
                     },
                    {
                      "data": "closed_date",
                       render: function(data, type, row){
                            if(type === "sort" || type === "type"){
                                return data;
                            }
                            return moment(data).format("ll");
                        }
                     },
                    {
                     "data": "usedMonths",
                      "orderable": false,
                      "bSearchable": false,
                      'defaultContent':''
                     },
                     {
                        "data": "receive_amount",
                        "bSearchable": false
                      },
                    @if ($param == 'payable')
                     {
                        "data": "installment",
                        "bSearchable": false
                       },
                      {
                        "data": "payable_amount",
                        "bSearchable": false
                       },
                    @elseif($param == 'paid')
                     {
                        "data": "paid_amount",
                        "bSearchable": false
                       },
                      {
                       "data": "paid_date"
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
                    }
                   @if ($param == 'paid')
                   ,{
                      "data": "id",
                      "orderable": false,
                      "bSearchable": false,
                      render: function (data, type, full, meta) {
                            return '<a href="' + laravelObj.appHost + "/settlements/download-money-receipt/" + data + '"><i class="fa fa-x fa-download" aria-hidden="true"></i></a>';
                        }
                    }
                   @endif
                ],
                "fnDrawCallback": function (oSettings) {
                    var tooltipArr = [
                        { "className": "fa-download", "title": "Download Money Receipt" },
                    ];
                    tooltipArr.forEach(function(item, index) {
                        var tis = $('.' + item.className).parent();
                        tis.attr("title", item.title);
                        tis.tooltip();
                    });
                }
          });

      // Handle click on "Select all" control
     $('#datatable-select-all').on('click', function(){
        // Get all rows with search applied
        var rows = table.rows({ 'search': 'applied' }).nodes();
        // Check/uncheck checkboxes for all rows in the table
        $('input[type="checkbox"]', rows).prop('checked', this.checked);
     });

     // Handle click on checkbox to set state of "Select all" control
     $('#datatable tbody').on('change', 'input[type="checkbox"]', function(){
        // If checkbox is not checked
        if(!this.checked){
           var el = $('#datatable-select-all').get(0);
           // If "Select all" control is checked and has 'indeterminate' property
           if(el && el.checked && ('indeterminate' in el)){
              // Set visual state of "Select all" control
              // as 'indeterminate'
              el.indeterminate = true;
           }
        }
     });


     // Handle form submission event
   $('#frm-datatable').on('submit', function(e){
      var form = this;

      // Iterate over all checkboxes in the table
      table.$('input[type="checkbox"]').each(function(){
         // If checkbox doesn't exist in DOM
         if(!$.contains(document, this)){
            // If checkbox is checked
            if(this.checked){
               // Create a hidden element
               $(form).append(
                  $('<input>')
                     .attr('type', 'hidden')
                     .attr('name', this.name)
                     .val(this.value)
               );
            }
         }
      });
   });
});
</script>
@endcomponent
