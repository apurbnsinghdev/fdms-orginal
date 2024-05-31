<a style="cursor:pointer" onclick="getDetails('{{ $data->id }}')"><span aria-hidden="true" class="fa fa-eye fa-x"></span></a>
@if ($isExecutive && ($data->doc_verified != 'yes' || ($data->payment_verified != 'yes' && $data->payment_methods !='bkash')))
     {!!  Html::decode(link_to_route('requisitions.edit', '<span aria-hidden="true" class="fa fa-upload fa-x"></span>', array($data->id)))!!}
@endif
@if ($isExecutive && $data->payment_verified != 'yes' && $data->payment_methods=='bkash' && !$data->payment_confirm)
    <a style="cursor:pointer" onclick="getTransactionId('{{ $data->id }}')"><span aria-hidden="true" class="fa fa-plus fa-x"></span></a>
@endif