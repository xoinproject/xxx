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

<style type="text/css">

input 
{
	outline: none;
}
input[type=search] 
{
	-webkit-appearance: textfield;
	-webkit-box-sizing: content-box;
	font-family: inherit;
	font-size: 100%;
}
input::-webkit-search-decoration,
input::-webkit-search-cancel-button 
{
	display: none; 
}


input[type=search] {
	background: #ededed url(https://static.tumblr.com/ftv85bp/MIXmud4tx/search-icon.png) no-repeat 9px center;
	border: solid 1px #ccc;
	padding: 9px 10px 9px 32px;
	width: 0px;
	
	-webkit-border-radius: 10em;
	-moz-border-radius: 10em;
	border-radius: 10em;
	
	-webkit-transition: all .5s;
	-moz-transition: all .5s;
	transition: all .5s;
}
input[type=search]:focus {
	width: 230px;
	background-color: #fff;
	border-color: #{{$gnl->color}};
	
	-webkit-box-shadow: 0 0 5px rgba(109,207,246,.5);
	-moz-box-shadow: 0 0 5px rgba(109,207,246,.5);
	box-shadow: 0 0 5px rgba(109,207,246,.5);
}

input:-moz-placeholder {
	color: #999;
}
input::-webkit-input-placeholder {
	color: #999;
}
 </style>
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
						@if($front->about_sec==1)
						<li><a href="#about">About</a></li>
						@endif
						@if($front->service_sec==1)
						<li><a href="#why-us">Why us</a></li>
						@endif
						@if($front->roadmap_sec==1)
						<li><a href="#road-map">Road Map</a></li>
						@endif
						@if($front->team_sec==1)
						<li><a href="#team">Team</a></li>
						@endif
						
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

                        @if($front->search_sec==1)
						 <li>
						  	<form class="form-inline" method="POST" action="{{route('search.wallet')}}">
								{{csrf_field()}}
								<input type="search" name="wallet" placeholder="Wallet, Trx, Amount" required>
							</form>
						</li>
						@endif
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
<!--header area start-->
<header class="header-area header-area-bg" style="background-image: url({{asset('assets/images/section')}}/{{$front->secbg1}});">
	<div class="social-share-links">
		<ul>
			@foreach($socials as $social)
				<li><a href="{{$social->url}}"><i class="fa fa-{{$social->icon}}"></i></a></li>
			@endforeach
		</ul>
	</div>
	<div class="container">
		<div class="row justify-content-center text-center">
			<div class="col-lg-10">
				<div class="header-area-wraper">
					<div class="title">
						<h1>{{$front->ban_title}}</h1>
						<span class="sub-title">{{$front->ban_subtitle}}</span>
					</div>
					@if($front->banner_sec==1)
					<div class="header-countdown">
						<h4>{!!$front->ban_details!!}</strong></h4>
						<div class="countedowan-wrapper">
							<div id="clockdiv">
								<div>
									<span class="days" data-days="{{$days}}"></span>
									<div class="smalltext">Days</div>
								</div>
								<div>
									<span class="hours" data-hours="24"></span>
									<div class="smalltext">Hours</div>
								</div>
								<div>
									<span class="minutes" data-minutes="60"></span>
									<div class="smalltext">Mins</div>
								</div>
								<div>
									<span class="seconds" data-seconds="60"></span>
									<div class="smalltext">Secs</div>
								</div>
							</div>
						</div>
					</div>
					@endif
				</div>
			</div>
		</div>
	</div>
</header>
<!--header area end-->

@if($front->about_sec==1)
<!-- about us area start-->
<section class="about-us-area" id="about">
	<div class="container">
		<div class="row">
			<div class="col-lg-7 col-md-12 col-sm-12">
				<div class="about-us-image">
					<img src="{{asset('assets/front/img/video-iamge.jpg') }}" alt="why to choose us image">
					<div class="hover ">
						<span>
							<a href="{{$front->video}}" class="video-popup mfp-iframe">
							<i class="fa fa-play"></i>
						</a>
						</span>
					</div>
				</div>
			</div>
			<div class="col-lg-5 col-md-12 col-sm-12">
				<div class="about-us-content">
					<h2>{{$front->about_title}}</h2>
					<p>{!!$front->about_content!!}</p>
					<div class="coin-ended-on">
						<div class="row text-center">
						  <div class="col">
							<div class="single-coin-box ">
								<div class="icon">
									<i class="fa fa-usd"></i>
								</div>
								<span class="counter-text">{{$gnl->stock}}</span>
								<h5 class="text-uppercase"> total token</h5>
							</div>
						  </div>
						  <div class="col">
							<div class="single-coin-box">
								<div class="icon">
									<i class="fa fa-line-chart"></i>
								</div>
								<span class="counter-text">{{$front->ban_sold}}</span>
								<h5 class="text-uppercase"> sold token</h5>
							</div>
						  </div>
						  <div class="col">
							<div class="single-coin-box">
								<div class="icon">
									<i class="fa fa-clock-o"></i>
								</div>
								<span class="counter-text">{{$front->ban_price}}</span>
								<h5 class="text-uppercase">unsold token</h5>
							</div>
						  </div>
					  </div>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>
<!--about us area end-->
@endif
<!-- why us area start -->
@if($front->service_sec==1)
<section class="why-us-area" id="why-us">
	<div class="container">
		<div class="row justify-content-center">
			<div class="col-lg-6 text-center">
				<div class="section-title">
					<h2>{{$front->serv_title}}</h2>
					<p>{!!$front->serv_details!!}</p>
				</div>
			</div>
		</div>
		<div class="row text-center">
		 @foreach($services as $serv)	
			<div class="col-lg-3 col-md-6 col-sm-12">
				<div class="single-why-us-box">
					<div class="icon">
						<i class="fa fa-{{$serv->icon}}"></i>
					</div>
					<h4>{{$serv->title}}</h4>
					<p>{{$serv->details}}</p>
				</div>
			</div>
		  @endforeach
		</div>
	</div>
</section>
<!-- why us area end -->
@endif

@if($front->roadmap_sec==1)
<!-- road map section start -->
<section class="road-map-area" id="road-map">
	<div class="container">
		<div class="row justify-content-center">
			<div class="col-lg-6 text-center">
				<div class="section-title">
					<h2>{{$front->road_title}}</h2>
					<p>{!!$front->road_details!!}</p>
				</div>
			</div>
		</div>
		<div class="row justify-content-center">
			<div class="col-lg-10">
				<div class="Timeline" id="Timeline">
					<div class="Timeline-line">
						<div class="Timeline-line-menu"></div>
					</div>
				@foreach($roads as $road)
					<div class="Timeline-item">
						<div class="Timeline-item-inner">
							<div class="Timeline-item-index"></div>
							<div class="Timeline-item-top">
								<div class="Timeline-item-top-type">
									<i></i>
									<span>{{$road->title}}</span>
								</div>
							</div>
							<div class="Timeline-item-content">
								<div class="Timeline-item-content-title">
									 {{$road->details}}
								</div>
								<div class="Timeline-item-content-body"></div>
							</div>
						</div>
					</div>
				@endforeach
				</div>
			</div>
		</div>
	</div>
</section>
<!-- road map section end -->
@endif

@if($front->partner_sec==1)
<!--our partner area start-->
<section class="our-partner our-partner-bg" id="partner" style="background-image: url({{asset('assets/images/section')}}/{{$front->secbg2}});">
	<div class="container">
		<div class="row justify-content-center">
			<div class="col-lg-6 text-center">
				<div class="section-title">
					<h2>{{$front->testm_title}}</h2>
					<p>{!!$front->testm_details!!}</p>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-lg-12">
				<div class="partner-carousel owl-carousel">
				 @foreach($testims as $tm)   
					<div class="single-partner-logo-item">
						<img src="{{asset('assets/images/testimonial') }}/{{$tm->photo}}" alt="partner logo">
					</div>
				 @endforeach
				</div>
			</div>
		</div>
	</div>
</section>
<!--our partner area end-->
@endif

@if($front->team_sec==1)
<section class="why-us-area" id="team">
	<div class="container">
		<div class="row justify-content-center">
			<div class="col-lg-6 text-center">
				<div class="section-title">
					<h2>{{$front->team_title}}</h2>
					<p>{!!$front->team_details!!}</p>
				</div>
			</div>
		</div>
		<div class="row text-center">
		 @foreach($teams as $team)
			<div class="col-lg-3 col-md-6 col-sm-12">
				<div class="single-why-us-box">
					<div class="icon">
						<img src="{{asset('assets/images/team') }}/{{$team->photo}}" alt="UI Designer">
					</div>
					<h4>{{$team->title}}</h4>
					<p>{{$team->details}}</p>
				</div>
			</div>
		  @endforeach
		</div>
	</div>
</section>
<!--team area end-->
@endif

<!-- why us area start -->
@if($front->footer2==1)
@foreach($faqs as $faq)
<section class="why-us-area" id="why-us" style="background-color: #{{$faq->color}}">
	<div class="container">
		<div class="row justify-content-center">
			<div class="col-lg-6 text-center">
				<div class="section-title">
					<h2>{{$faq->title}}</h2>
				</div>
			</div>
		</div>
		<div class="row text-center">
			<div class="col-lg-12 col-md-12 col-sm-12">>
					{!!$faq->details!!}<
			</div>
		</div>
	</div>
</section>
@endforeach
<!-- why us area end -->
@endif

@if($front->subscribe_sec==1)
<!--subscription section start-->
<section class="subscription-section subscription-bg" id="subscribe" style="background-image: url({{asset('assets/images/section')}}/{{$front->secbg3}});">
	<div class="container">
		<div class="row justify-content-center">
			<div class="col-lg-8">
				<div class="section-title text-center">
					<h2>{{$front->subs_title}}</h2>
					<p>{!!$front->subs_details!!}</p>
				</div>
				<div class="subscription-form">
					<form class="form-inline">
						<input type="text" id="subemail" class="form-control mb-2 mr-sm-2 mb-sm-0"  placeholder="Your Email">
						<button type="button" id="subsc" class="btn btn-primary">Subscribe</button>
					</form>
				</div>
			</div>
		</div>
	</div>
</section>
@endif

<script>
  $(document).ready(function(){
    $(document).on('click','#subsc',function(e){
        e.preventDefault();
      var email = $('#subemail').val();
      $.ajax({
       type:'GET',
       url:'{{ route('subscribe') }}',
       data:{email:email},
       success:function(data){
        swal('success','Successfully Subscribed','success');
        console.log(data);
      },
      error:function (error) {
        var message = JSON.parse(error.responseText);
        swal('error',message.errors.email,'error');
        console.log(message.errors.email);

      }
    });
    });
  }); 
</script>
<!--subscription section end-->

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