<a style="cursor:pointer" onclick="getDetails('{{ $data->id }}')"><span aria-hidden="true" class="fa fa-eye fa-x"></span></a>

@if ($isExecutive || $data->created_by==auth()->user()->id)
  {!! Html::decode(link_to_route('requisitions.resend', '<i class="fa fa-paper-plane fa-x"></i>', array($data->id)))!!}
@endif

@if (!$isExecutive && $data->action_by==auth()->user()->id)
  <div class="dropdown">
      <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown">Actions <span class="caret"></span></button>
      <ul class="dropdown-menu">
          @php ($actionsArr=$actionsArr->diff(['hold']))
          @foreach ($actionsArr as $val)
            <li><a href="javascript:void(0)" class="text-capitalize" data-id="{{ $data->id }}" data-stage="{{ $data->stage }}" data-name="{{ $val }}" onclick="showModal(this)">{{ $val }}</a></li>
          @endforeach
      </ul>
  </div>
  @endif
