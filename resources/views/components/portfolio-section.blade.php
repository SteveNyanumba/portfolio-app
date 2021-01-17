
		<!-- Portfolio Section -->
		<section class="portfolio section" data-simplebar>
			<div class="container">
				<div class="header-page mt-70">
					<i class="fas fa-briefcase icon-page"></i>
  					<i class="far fa-times-circle close-page" data-tooltip="close page" data-position="left"></i>
					<h2>Portfolio</h2>
				</div>

				<!-- Portfolio Filter Row Start -->
				<div class="row mt-100 mob-mt">
					<div class="col-lg-12 col-sm-12 portfolio-filter">
						<ul>
							<li class="active" data-filter="*">All</li>
							<li data-filter=".brand">Brand</li>
							<li data-filter=".design">Design</li>
							<li data-filter=".graphic">Graphic</li>
						</ul>
					</div>
				</div>
				<!-- Portfolio Filter Row End -->

				<!-- Portfolio Item Row Start -->
				<div class="row portfolio-items mt-100 mb-100">
                    <x-portfolio.portfolioItem/>
                    <x-portfolio.portfolioItem/>
                    <x-portfolio.portfolioItem/>
                    <x-portfolio.portfolioItem/>
                    <x-portfolio.portfolioItem/>
				</div>
				<!-- Portfolio Item Row End -->
			</div>
		</section>
