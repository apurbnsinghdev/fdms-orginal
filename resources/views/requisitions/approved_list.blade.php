<a style="cursor:pointer" onclick="getDetails('{{ $data->id }}')"><span aria-hidden="true" class="fa fa-eye fa-x"></span></a>
@if ($isExecutive && ($data->doc_verified != 'yes'))
     {!!  Html::decode(link_to_route('requisitions.edit', '<span aria-hidden="true" class="fa fa-upload fa-x"></span>', array($data->id)))!!}
@endif
@if ($isExecutive && $data->payment_verified != 'yes' && $data->payment_methods=='bkash' && !$data->payment_confirm)
    <a style="cursor:pointer" onclick="getTransactionId('{{ $data->id }}')"><span aria-hidden="true" class="fa fa-plus fa-x"></span></a>
@endif

@php
  $actionsArray=[];
@endphp
 
@if($document_verify)
  @php
    $actionsArray[]="document_verify";
  @endphp
@endif
@if($payment_verify && $data->payment_verified !='yes' && $data->payment_methods != 'bkash')
  @php
    $actionsArray[]="payment_verify";
  @endphp
@endif
@if($bkash_verify && $data->payment_verified !='yes' && $data->payment_confirm && $data->payment_methods=='bkash')
  @php
    $actionsArray[]="bkash_verify";
  @endphp
@endif
@if($freeze_assign && !$data->item_id)
  @php
    $actionsArray[]="freeze_assign";
  @endphp
@endif

@if($generate_gatepass && $data->item_id)
  @php
    $actionsArray[]="generate_gatepass";
  @endphp
@endif

@if (!$isExecutive && count($actionsArray))
    <div class="dropdown">
        <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown">Actions <span class="caret"></span></button>
        <ul class="dropdown-menu">
            @foreach ($actionsArray as $key=>$val)
             {{-- $val=='generate_gatepass' --}}
               <li>{!! link_to_route('requisitions.'.$val,mystudy_case($val) , [$data->id]) !!}</li>
            @endforeach
        </ul>
    </div>
@endif
