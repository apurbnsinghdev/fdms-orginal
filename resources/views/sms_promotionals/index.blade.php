@extends('layouts.admin')
@section('title', 'Supplier Lists')
@section('content')
<div class="content-header">
    <div class="leftside-content-header">
        <ul class="breadcrumbs">
            <li><i class="fa fa-table" aria-hidden="true"></i><a href="#">SMS</a></li>
            <li><a>Lists</a></li>
        </ul>
    </div>
</div>
@include('sms_promotionals.tab')
<div class="row animated fadeInRight">
    <div class="col-sm-12">
        <h4 class="section-subtitle">
            <b> {{ mystudy_case($param) }} SMS List</b>
        </h4>
        <span class="pull-right">
            {!! Html::decode(link_to_route('smsPromotionals.send','<i class="fa fa-plus"></i>',[$param],array('class'=>'btn btn-success btn-right-side'))) !!}
        </span>
        <div class="panel">
            <div class="panel-content">
				 <div class="table-responsive">
                    <table id="datatable" class="data-table table table-striped table-hover" cellspacing="0" width="100%">
                        <thead>
                          <tr>
                            <th class="no-sort">Subject</th>
                            <th class="no-sort">Sender</th>
                            <th class="no-sort">Message</th>
                            <th class="no-sort">Created</th>
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
@component('common_pages.data_table_script')
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
        "ajax": "{{ route('ajax.smsPromotionals.get',[$param]) }}",
        "columns": [
            { "data": "subject" },
            { "data": "name" },
            { "data": "message" },
            {
                "data": "created_at" 
            },
            {
                "data": "id",
                "orderable": false,
                "bSearchable": false,
                render: function (data, type, full, meta) {
                    return '<a href="' + laravelObj.appHost + "/sms-promotionals/" + data + '/re-send"><span aria-hidden="true" class="fa fa-copy fa-x"></span></a>';
                }
            },
        ],
        "fnDrawCallback": function (oSettings) {
            var tooltipArr = [
                { "className": "fa-copy", "title": "re send" },
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
@endcomponent