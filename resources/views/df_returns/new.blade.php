@if (!$isExecutive)
  <div class="dropdown">
      <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown">Actions <span class="caret"></span></button>
      <ul class="dropdown-menu">
          @foreach ($actionsArr as $val)
            <li><a href="javascript:void(0)" class="text-capitalize" data-id="{{ $data->id }}" data-stage="{{ $data->stage }}" data-name="{{ $val }}" onclick="showModal2(this)">{{ $val }}</a></li>
          @endforeach
      </ul>
  </div>
@endif