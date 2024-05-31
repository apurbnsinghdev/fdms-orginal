@php $deedPaperUpload = ''; @endphp
@if($document_verify)
  @php
    $deedPaperUpload="document_verify";
  @endphp
@endif

<a style="cursor:pointer" onclick="getDetails('{{ $data->id }}')"><span aria-hidden="true" class="fa fa-eye fa-x"></span></a>
@if($generate_gatepass && $data->item_id)
    {!! Html::decode(link_to_route('requisitions.generate_gatepass','<i class="fa fa-download fa-x" aria-hidden="true"></i>' , [$data->id],['title'=>'Download Gate Pass'])) !!}
 @endif

{!! Html::decode(link_to_route('requisitions.deedPapergenerate','<i class="fa fa-book fa-x" aria-hidden="true"></i>' , [$data->id],['title'=>'Download Deed Paper'])) !!}
@if($deedPaperUpload)
	{!! Html::decode(link_to_route('requisitions.document_verify','<i class="fa fa-upload fa-x" aria-hidden="true"></i>' , [$data->id],['title'=>'Upload Deed Paper'])) !!}
@endif
<a style="cursor:pointer" onclick="getAllDocuments({{ $data->shop_id }},{{$data->id}})"><span aria-hidden="true" class="fa fa-file fa-x"></span></a>

