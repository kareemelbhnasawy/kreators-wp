<?php
/**
 * The template for displaying 404 pages (not found).
 *
 * @package faimos
 */

global $faimos_redux;
get_header(); ?>

	<div class="faimos-breadcrumbs">
	    <div class="container">
	        <div class="row">
	            <div class="col-md-12 text-center">
	                <ol class="breadcrumb">
	                    <?php faimos_breadcrumb(); ?>
	                </ol>
	            </div>
	        </div>
	    </div>
	</div>

	<!-- Page content -->
	<div id="primary" class="content-area">
	    <main id="main" class="container blog-posts site-main">
	        <div class="col-md-12 main-content">

				<section class="error-404 not-found">
					<header class="page-header-404">
							<div class="col-md-12">
								<div class="row">

									<div class="col-md-6">
										<h2 class="page-title"><img src="<?php echo esc_url(get_template_directory_uri().'/images/404.png'); ?>" alt="<?php esc_attr_e( '404 Not Found', 'faimos' ); ?>" /></h2>
										
										<p class="text-left"><?php esc_html_e( 'Sorry! The page you were looking for could not be found. Try searching for it or browse through our website.', 'faimos' ); ?></p>
										<a class="vc_button_404" href="<?php echo esc_url(get_site_url()); ?>"><?php esc_html_e( 'Back to Home', 'faimos' ); ?></a>
									</div>
									<div class="col-md-6 error-404-img">
										<img src="<?php echo esc_url(get_template_directory_uri().'/images/404-page.png'); ?>" alt="<?php esc_attr_e( '404 Not Found', 'faimos' ); ?>" />
									</div>
								</div>
							</div>
					</header>
				</section>
			</div>
		</main>
	</div>

<?php get_footer(); ?>