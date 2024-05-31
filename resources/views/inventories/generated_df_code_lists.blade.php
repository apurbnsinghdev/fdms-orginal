@extends('layouts.admin')
@section('title', 'Generate DF Codes')
@section('content')
<div class="content-header">
    <div class="leftside-content-header">
        <ul class="breadcrumbs">
            <li><i class="fa fa-table" aria-hidden="true"></i><a href="#">Generate</a></li>
            <li><a>DF Codes</a></li>
        </ul>
    </div>
</div>

@include('inventories.generate_df_code')

<div class="row animated fadeInRight">
    <div class="col-sm-12">
        <h4 class="section-subtitle">
            <b>DF Codes Lists</b>
        </h4>
        <span class="pull-right">
          @php
            if($years){
               echo Form::open(['url'=>route('inventories.downloadDFCode'),'method'=>'post','class'=>'form-inline'])
               .Form::select('year',$years,null,array('class' => 'form-control'))
              . Form::button('<i class="fa fa-download" aria-hidden="true"></i>', ['type'=>'submit','class'=>'btn btn-success btn-right-side'])
              . Form::close();
            }
          @endphp
        </span>
        <div class="panel">
            <div class="panel-content">
                <div class="table-responsive">
                    <table id="datatable" class="data-table table table-striped nowrap table-hover" cellspacing="0" width="100%">
                        <thead>
                          <tr>
                            <th>Brand</th>
                            <th>Size</th>
                            <th>Year</th>
                            <th class="no-sort">Created By</th>
                            <th>Created Time</th>
                            <th>DF Code</th>
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
                 "columnDefs": [ {
                  "targets": 'no-sort',
                  "orderable": false,
                  "order": []
                } ],
                "ajax": "{{ route('ajax.inventories.dfcodeLists') }}",
                "columns": [
                    {
                      "orderable": false,
                      "data": "brand"
                    },
                    { "data": "size" },
                    {
                        "data": "year"
                    },
                    {
                      "orderable": false,
                      "data": "user_name",
                      "name":"users.name",
                      "defaultContent":""
                     },
                    {
                        "data": "created_at",
                        "bSearchable": false,
                        render: function(data, type, row){
                            if(type === "sort" || type === "type"){
                                return data;
                            }
                            return moment(data).format("ll");
                        }
                    },
                    {
                      "orderable": false,
                      "data": "serial_no"
                    }
                ]
           });
      });
    </script>
@endcomponent




