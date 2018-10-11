<div id="sidebar" class="sidebar">
  <div data-scrollbar="true" data-height="100%">
    <ul class="nav text-center">
      <li class="nav-profile">
        <div class="info text-center">
          <img src="{{asset('assets/images/profile')}}/{{Auth::user()->photo}}" class="img-responsive img-rounded" style="max-height:70px; max-width: 70px; margin: auto;">
          <a href="{{route('profile')}}" style="text-decoration: none; font-size: 15px; color: #ddd;">{{Auth::user()->name}}</a>

          <small>{{Auth::user()->username}}</small>
        </div>
      </li>
    </ul>
    <ul class="nav" style="text-transform: uppercase;">
      <li class="@if(request()->path() == 'home') active @endif"><a href="{{route('home')}}"><i class="fa fa-dashboard"></i> <span>Dashboard</span></a></li> 
       <li class="@if(request()->path() == 'home/profile') active @endif"><a href="{{route('profile')}}"><i class="fa fa-user"></i> <span>Profile</span></a></li> 
      <li class="@if(request()->path() == 'home/referal') active @endif"><a href="{{route('referal')}}"><i class="fa fa-users" aria-hidden="true"></i> <span>Reference log</span></a></li>
      @if($gnl->transaction==1)
       <li class="@if(request()->path() == 'home/transactions') active @endif"><a href="{{route('transaction.log')}}"><i class="fa fa-exchange" aria-hidden="true"></i> <span>Transaction log</span></a></li> 
       <li class="@if(request()->path() == 'home/all-wallets') active @endif"><a href="{{ route('all.wallets') }}"><i class="fa fa-list" aria-hidden="true"></i> <span>All Wallets</span></a></li>
       <li class="@if(request()->path() == 'home/purchase-gateway') active @endif"><a href="{{route('purchase.gateway')}}"><i class="fa fa-shopping-cart" aria-hidden="true"></i> <span>Purchase {{$gnl->cur}}</span></a></li>
      @endif
      @if($gnl->lending==1)
      <li class="has-sub @if(request()->path() == 'home/lending-packages') active 
          @elseif(request()->path() == 'home/lending-log') active 
            @endif" >
            <a href="javascript:;">
                <b class="caret pull-right"></b>
                <i class="fa fa-play"></i>
                <span>Lending</span>
            </a>
            <ul class="sub-menu">
              <li class="@if(request()->path() == 'home/lending-packages') active @endif">
                <a href="{{route('lending.packages')}}"><i class="fa fa-list" aria-hidden="true"></i> <span>Lending Packages</span></a>
              </li>  
              <li class="@if(request()->path() == 'home/trade-log') active @endif"><a href="{{route('lending.log')}}"><i class="fa fa-list" aria-hidden="true"></i> <span>Lending Log</span></a>
              </li>
          </ul>
        </li>
      @endif
      @if($gnl->ico==1)
      <li class="@if(request()->path() == 'home/my-coin') active @endif"><a href="{{route('myCoin')}}"><i class="fa fa-list" aria-hidden="true"></i> <span>{{$gnl->cur}} Purchase Log</span></a></li>
      @endif
      <li class="@if(request()->path() == 'home/change-password') active @endif">
        <a href="{{route('changepass')}}"><i class="fa fa-lock" aria-hidden="true"></i> <span>Password</span></a>
      </li> 
      <li class="@if(request()->path() == 'home/g2fa') active @endif">
        <a href="{{route('go2fa')}}"><i class="fa fa-shield" aria-hidden="true"></i> <span>Security</span></a>
      </li>

      <li>
        <a href="{{ route('logout') }}"
        onclick="event.preventDefault();
        document.getElementById('logout-form').submit();"><i class="fa fa-sign-out" aria-hidden="true"></i>
        <span>SIGN OUT</span>
      </a>

      <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
        {{ csrf_field() }}
      </form>
    </li>

    <li><a href="javascript:;" class="sidebar-minify-btn" data-click="sidebar-minify"><i class="fa fa-angle-double-left"></i></a></li>

  </ul>

</div>

</div>
<div class="sidebar-bg"></div>
