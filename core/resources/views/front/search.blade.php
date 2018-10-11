<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="description" content="this is a demo meta description">
    <meta name="keywords" content="this is a demo meta keywords">
    <link rel="shortcut icon" href="{{asset('assets/images/logo/icon.png') }}" type="image/x-icon">
    <title>{{$gnl->title}} | {{$gnl->subtitle}} </title>
    <link rel="stylesheet" href="{{asset('assets/front/css/animate.css') }}">
    <link rel="stylesheet" href="{{asset('assets/front/css/bootstrap.4.0.0.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/admin/global/plugins/font-awesome/css/font-awesome.min.css') }}" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="{{asset('assets/front/css/magnific-popup.css') }}">
    <link rel="stylesheet" href="{{asset('assets/front/css/slicknav.min.css') }}">
    <link rel="stylesheet" href="{{asset('assets/front/css/owl.carousel.min.2.2.1.css') }}">
    <link rel="stylesheet" href="{{asset('assets/front/css/style.css') }}">
    <link rel="stylesheet" href="{{asset('assets/front/css/responsive.css') }}">
    <script src="{{asset('assets/front/js/jquery-2.2.4.min.js') }}"></script>
     <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css">
      <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script>
</head>

</head>
<body>
    <!--navbar area start-->
    <nav class="navbar-area">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-6 col-sm-8">
                    <a href="{{url('/')}}" class="logo"><img src="{{asset('assets/images/logo/logo.png') }}" alt="logo image"></a>
                </div>
                <div class="col-lg-9 col-md-6 col-sm-4">
                    <div class="responsive-menu-wrapper"></div>
                    <ul id="main-menu" class="text-right">
                        @auth
                        <li><a href="{{route('home')}}">{{Auth::user()->name}}</a></li>
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
                        @else
                        <li><a href="{{route('login')}}">Sign In</a></li>
                        <li><a href="{{route('register')}}">Sign Up</a></li>
                        @endauth
                    </ul>
                </div>
            </div>
        </div>
    </nav>
    <!--navbar area end-->
@if (session('success'))
<script type="text/javascript">
        $(document).ready(function(){
            swal("Success!", "{{ session('success') }}", "success");
        });
</script>
@endif

@if (session('alert'))
<script type="text/javascript">
        $(document).ready(function(){
            swal("Sorry!", "{{ session('alert') }}", "error");
        });
</script>
@endif
<section class="subscription-section subscription-bg" id="subscribe" style="background-image: url({{asset('assets/images/section')}}/{{$front->secbg4}});">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="subscription-form">
                    <form class="form-inline" method="POST" action="{{route('search.wallet')}}">
                        {{csrf_field()}}
                        <input type="text" name="wallet"  class="form-control mb-2 mr-sm-2 mb-sm-0"  value="{{$qry}}" required>
                        <button type="submit" class="btn btn-primary"><i class="fa fa-search"></i> Seacrch</button>
                    </form>
                </div>
                <hr/>
            </div>
        </div>
        <div class="row text-center">
            <div class="col-lg-10 col-md-10 col-sm-10 ml-auto mr-auto" >
                    @foreach($trans as $tn)
                       <div class="card">
                          <div class="card-header">Transaction Amount: <strong>{{$tn->amount}} </strong>{{$gnl->cur}}</div>
                          <div class="card-body">
                            <ul class="list-group">
                              <li class="list-group-item">Receiver Wallet: <strong @if($qry==$tn->receiver) style="color: #ff6600;" @endif>{{$tn->receiver}}</strong></li>
                              <li class="list-group-item">Sender Wallet:  <strong @if($qry==$tn->sender) style="color: #ff6600;" @endif>{{$tn->sender}}</strong></li>
                              <li class="list-group-item">Transaction ID: <strong @if($qry==$tn->trxid) style="color: #ff6600;" @endif>{{$tn->trxid}}</strong></li>
                              <li class="list-group-item">Trx Time: <strong>{{$tn->created_at}}</strong></li>
                            </ul>
                          </div>
                        </div>
                        <hr/>
                @endforeach 
            </div>
        </div>
    </div>
</section>

<!--footer area start-->
<footer class="footer-area">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 text-center">
                <p>&COPY; {!!$front->footer1!!}</p>
            </div>
        </div>
    </div>
</footer>
<!--footer area end-->

<!--back to top start-->
<div class="back-to-top">
    <i class="fa fa-angle-up"></i>
</div>
<!--back to top end-->

    <!-- popper js -->
    <script src="{{asset('assets/front/js/popper.min.js') }}"></script>
    <!-- bootstrap.4.0.0 js -->
    <script src="{{asset('assets/front/js/bootstrap.4.0.0.min.js') }}"></script>
    <!-- wow js -->
    <script src="{{asset('assets/front/js/wow.min.js') }}"></script>
    <!-- magnific-popup js -->
    <script src="{{asset('assets/front/js/jquery.magnific-popup.min.js') }}"></script>
    <!-- slicknav js -->
    <script src="{{asset('assets/front/js/jquery.slicknav.min.js') }}"></script>
    <!-- owl carousel 2.2.1 js -->
    <script src="{{asset('assets/front/js/owl.carousel.min.2.2.1.js') }}"></script>
    <!-- rcountdown js -->
    <script src="{{asset('assets/front/js/rcoundown.js') }}"></script>
    <!-- waypoint js -->
    <script src="{{asset('assets/front/js/waypoints.min.js') }}"></script>
    <!-- waypoint js -->
    <script src="{{asset('assets/front/js/jquery.counterup.min.js') }}"></script>
    <!-- main js -->
    <script src="{{asset('assets/front/js/main.js') }}"></script>
</body>
</html>
