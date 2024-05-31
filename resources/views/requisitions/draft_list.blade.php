<a style="cursor:pointer" onclick="getDetails('{{ $data->id }}')">
	<span aria-hidden="true" class="fa fa-eye fa-x"></span>
</a>
{!! Html::decode(link_to_route('requisitions.edit', '<span aria-hidden="true" class="fa fa-edit fa-x"></span>', array($data->id)))!!}
{!! Form::delete(route('requisitions.destroy',array($data->id))) !!}
