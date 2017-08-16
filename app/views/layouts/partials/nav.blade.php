<div role="navigation" class="navbar navbar-default navbar-static-top topnav">
  <div class="container">
    <div class="navbar-header">
      <a href="" class="navbar-brand"></a>
    </div>
    <div id="top-navbar-collapse" class="navbar-collapse">
      <ul class="nav navbar-nav">
        <li class="{{ (Request::is('topics*') ? ' active' : '') }}"><a href="{{url('/')}}"><img src="{{ URL::asset('assets/images/logo.png') }}" class="logo-fast" title="Forum Analisis Statistik" alt="FAST Logo"></a></li>
        <li class="{{ (Request::is('topics*') ? ' active' : '') }}"><a href="{{ route('topics.index') }}" style="padding-top: 22px;">{{ lang('Topics') }}</a></li>
        <li class="{{ (Request::is('topics*') ? ' active' : '') }}"><a href="{{ route('analysis.index')}}" style="padding-top: 22px;">Analysis</a></li>
        <li class="{{ (Request::is('topics*') ? ' active' : '') }}"><a href="{{ route('tableGenerator.index')}}" style="padding-top: 22px;">Table Generator</a></li>
        <li class="{{ (Request::is('topics*') ? ' active' : '') }}"><a href="{{ route('analysis.index')}}" style="padding-top: 22px;">Galery</a></li>
        <!--<li class="{{ (Request::is('nodes/40') ? ' active' : '') }}"><a href="{{ route('nodes.show', 40) }}">{{ lang('Jobs') }}</a></li>
        -->
        <li class="{{ (Request::is('wiki*') ? ' active' : '') }}"><a href="{{ route('wiki') }}" style="padding-top: 22px;">{{ lang('Wiki') }}</a></li>
        
      </ul>

      <div class="navbar-right">
        {{ Form::open(['route'=>'search', 'method'=>'get', 'class'=>'navbar-form navbar-left']) }}
          <div class="form-group" style="padding-top: 10px;">
          {{ Form::text('q', null, ['class' => 'form-control search-input mac-style', 'placeholder' => lang('Search')]) }}
          </div>
        {{ Form::close() }}

        <ul class="nav navbar-nav github-login" >
            @if (Auth::check())
              <li>
                  <a href="{{ route('notifications.index') }}" class="text-warning" style="padding-top: 21px;">
                      <span class="badge badge-{{ $currentUser->notification_count > 0 ? 'important' : 'fade'; }}" id="notification-count">
                          {{ $currentUser->notification_count }}
                      </span>
                  </a>
              </li>
               <li>
                @include('messenger.unread-count')
              </li>
              <li>
                  <a href="{{ route('users.show', $currentUser->id) }}" style="padding-top: 21px;">
                      <i class="fa fa-user"></i> {{{ $currentUser->name }}}
                  </a>
              </li>
              <li>
                  <a class="button" href="{{ URL::route('logout') }}" onclick=" return confirm('{{ lang('Are you sure want to logout?') }}')" style="padding-top: 21px;">
                      <i class="fa fa-sign-out"></i> {{ lang('Logout') }}
                  </a>
              </li>
          @else
              <a href="{{ URL::route('login') }}" class="btn btn-info" id="login-btn" style="margin-top: 17px">
                <i class=""></i>
                {{ lang('Login') }}
              </a>
          @endif
        </ul>
      </div>
    </div>

  </div>
</div>
