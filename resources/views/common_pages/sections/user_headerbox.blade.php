 <div class="header-section" id="user-headerbox">
    <div class="user-header-wrap">
        <div class="user-photo">
        @if(auth()->user()->avatar)
        	<img alt="profile photo" src="{{ asset('storage/images/avatar/'.auth()->user()->avatar) }}" title="{{auth()->user()->name}}"/>
        @else
        	<img alt="profile photo" src="{{ asset('storage/images/avatar/avatar_user.jpg') }}" title="{{auth()->user()->name}}"/>
        @endif
        </div>
        <div class="user-info">
            <span class="user-name" title="{{auth()->user()->name}}">{{ auth()->user()->name }}</span>
            <span class="user-profile" title="{{auth()->user()->designation->title}}">{{ auth()->user()->designation->title }}</span>
        </div>
        <i class="fa fa-plus icon-open" aria-hidden="true" title=""></i>
        <i class="fa fa-minus icon-close" aria-hidden="true" title=""></i>
    </div>
    <div class="user-options dropdown-box">
        <div class="drop-content basic">
            <ul>
                <li> <a href="{{ route('users.show') }}"><i class="fa fa-user" aria-hidden="true"></i> Profile</a></li>
                <li> <a href="{{ route('password.change') }}"><i class="fa fa-edit" aria-hidden="true"></i> Change Passwrod</a></li>
                @if ($is_switch)
                    <li>
                        <a href="#"
                            data-toggle="tooltip" data-placement="left" title="Switch"
                            onclick="event.preventDefault();
                                     document.getElementById('switch-form').submit();">
                            Switch Account <i class="fa fa-sign-out pull-right"></i>
                        </a>
                         <form id="switch-form" action="{{ route('users.SwitchBetweenUserToUser') }}" method="POST" style="display: none;">
                            {{ csrf_field() }}
                        </form>
                   </li>
                 @endif
                  @if (session()->exists('polar_administrattor_id'))
                    <li>
                        <a href="#"
                            data-toggle="tooltip" data-placement="left" title="Switch Back"
                            onclick="event.preventDefault();
                                     document.getElementById('switch-form2').submit();">
                            Back To Your Account <i class="fa fa-sign-out pull-right"></i>
                        </a>
                         <form id="switch-form2" action="{{ route('users.SwitchBackToAdmin') }}" method="POST" style="display: none;">
                            {{ csrf_field() }}
                            {{Form::hidden('administrator_id',session()->get('polar_administrattor_id'))}}
                        </form>
                   </li>
                 @endif
               {{--  <li> <a href="{{ route('template',array('pages_lock-screen')) }}"><i class="fa fa-lock" aria-hidden="true"></i> Lock Screen</a></li>
                <li><a href="#"><i class="fa fa-cog" aria-hidden="true"></i> Configurations</a></li> --}}
            </ul>
        </div>
    </div>
</div>