<!DOCTYPE html>
<html lang="sk">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('pageTitle') - FilmWeb</title>

    <!-- CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css?family=Lato:300,400,700|Roboto&display=swap" rel="stylesheet"> 
	<link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick.min.css" rel="stylesheet">
	<link href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick-theme.min.css" rel="stylesheet">
	<link rel="stylesheet" href="{{ asset('style.css') }}">
</head>
<body>
    <!-- Navbar -->
	<nav class="navbar navbar-dark bg-black navbar-expand-lg">
		<div class="container">
			<a class="navbar-brand" href="/">FilmWeb.sk</a>

			<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navCollapse" aria-controls="navCollapse" aria-expanded="false" aria-label="Toggle navigation">
			<span class="navbar-toggler-icon"></span>
			</button>
					
			<div class="collapse navbar-collapse" id="navCollapse">
				<ul class="navbar-nav ml-auto">
					<li class="nav-item"><a class="nav-link {{ Request::is('/') ? 'active' : '' }}" href="/">Novinky</a></li>
					<li class="nav-item"><a class="nav-link {{ Request::is('filmy') ? 'active' : '' }}" href="/filmy">Filmy</a></li>
					<li class="nav-item"><a class="nav-link {{ Request::is('serialy') ? 'active' : '' }}" href="/serialy">Seriály</a></li>
					<li class="nav-item"><a class="nav-link btn btn-outline-light btn-login" href="#" onclick="showSearch()"><i class="fa fa-search"></i> Hľadať</a></li>
					@guest
					<li class="nav-item"><a class="nav-link btn btn-outline-light btn-login" href="{{ route('login') }}"><i class="fa fa-user"></i> Prihlásiť sa</a></li>
					@else
					<li class="nav-item dropdown">
						<a class="nav-link nav-userdropdown dropdown-toggle btn btn-outline-light btn-login" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
						<i class="fa fa-user"></i> {{ Auth::user()->name }}
						</a>
						<div class="dropdown-menu dropdown-userpanel animate slideIn" aria-labelledby="navbarDropdownMenuLink">
						@if (Auth::user()->hasRole('admin'))
						<a class="dropdown-item" href="/admin">
						<i class="fa fa-cogs"></i> Administrácia
                    	</a>
						@endif
						<a class="dropdown-item" href="{{ route('users.edit') }}">
						<i class="fa fa-user" aria-hidden="true"></i> Upraviť profil
                    	</a>
						<a class="dropdown-item" href="{{ route('logout') }}"
                            onclick="event.preventDefault();
                            document.getElementById('logout-form').submit();">
                        	<i class="fa fa-sign-out" aria-hidden="true"></i> Odhlásiť sa
                    	</a>

                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                          @csrf
                        </form>
						</div>
					</li>
					@endguest
				</ul>
			</div>

		</div>
	</nav>
	
	<!-- Search Bar -->

	<div class="bg-black d-none" id="searchbar">
		<form action="/search" method="GET">
			<div class="form-group search-input-group"> 
				<span class="fa fa-search form-control-f"></span>
				<input type="search" name="search" class="form-control" placeholder="Hľadať film, seriál..." id="searchtype">
			</div>
		</form>
	</div>

    @yield('content')

    <footer class="footer mt-auto py-3 bg-black">
		<div class="container">
			<div class="row align-items-center">
				<div class="col-md-3">
					<a class="footer-brand" href="/">FilmWeb.sk</a>
				</div>
			</div>
		</div>
	</footer>

    <!-- JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick.min.js"></script>
	<script src="{{ asset('app.js') }}"></script>
</body>
</html>