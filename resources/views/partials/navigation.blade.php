@if (!in_array(Route::currentRouteName(), ['login', 'register','checkout']))

        <!-- NAVIGATION -->
		<nav id="navigation">
			<!-- container -->
			<div class="container">
				<!-- responsive-nav -->
				<div id="responsive-nav">
					<!-- NAV -->
					<ul class="main-nav nav navbar-nav">
						<li class="active"><a href="{{ route('home') }}">Home</a></li>
						<li><a href="#">Hot Deals</a></li>
                        @foreach ($categories as $category)
						<li><a href="{{ route('front.cate-product-list', ['id' => $category->id]) }}">{{ $category->name }}</a></li>
                        @endforeach

					</ul>
					<!-- /NAV -->
				</div>
				<!-- /responsive-nav -->
			</div>
			<!-- /container -->
		</nav>
		<!-- /NAVIGATION -->
@endif
