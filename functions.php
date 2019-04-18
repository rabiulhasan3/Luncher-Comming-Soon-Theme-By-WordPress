<?php 
	if(site_url() == 'http://localhost/wordpress'){
		define('VERSION',time());
	}else{
		define("VERSION", wp_get_theme()->get('Version'));
	}
	
	function jupiter_bootstraping(){
		load_theme_textdomain( 'luncher');
		add_theme_support( 'title-tag' );
		add_theme_support( 'post-thumbnails' );
	}
	add_action( 'after_setup_theme', 'jupiter_bootstraping' );

	function jupiter_theme_assets(){

		$pagename = basename(get_page_template());
		
		if(is_page()){
			if($pagename == 'launcher.php'){
				wp_enqueue_style( 'luncher-css',get_stylesheet_uri(),null,VERSION );
				wp_enqueue_style( 'google-font','//fonts.googleapis.com/css?family=Open+Sans:400,700,800' );
				wp_enqueue_style( 'animate-css', get_theme_file_uri( 'assets/css/animate.css' ));
				wp_enqueue_style( 'icomon-css', get_theme_file_uri( 'assets/css/icomoon.css' ) );
				wp_enqueue_style( 'icomon-css', get_theme_file_uri( 'assets/css/icomoon.css' ) );
				wp_enqueue_style( 'bootstrap-css', get_theme_file_uri( 'assets/css/bootstrap.css' ) );
				wp_enqueue_style( 'main-css', get_theme_file_uri( 'assets/css/style.css' ) );


				wp_enqueue_script( 'modernizr-js',get_theme_file_uri( 'assets/js/modernizr-2.6.2.min.js'), array('jquery'),null, true );
				wp_enqueue_script( 'easing-js',get_theme_file_uri( 'assets/js/jquery.easing.1.3.js'), array('jquery'),null, true );
				wp_enqueue_script( 'bootstrap-js',get_theme_file_uri( 'assets/js/bootstrap.min.js'), array('jquery'),null, true );
				wp_enqueue_script( 'waypoints-js',get_theme_file_uri( 'assets/js/jquery.waypoints.min.js'), array('jquery'),null, true );
				wp_enqueue_script( 'simplyCountdown-js',get_theme_file_uri( 'assets/js/simplyCountdown.js'), array('jquery'),null, true );
				wp_enqueue_script( 'main-js',get_theme_file_uri( 'assets/js/main.js'), array('jquery'),VERSION, true );

				$luncher_year = get_post_meta(get_the_ID(),'year',true);
				$luncher_month = get_post_meta(get_the_ID(),'month',true);
				$luncher_day = get_post_meta(get_the_ID(),'day',true);

				wp_localize_script( 'main-js', 'datedata', array(
					'year' => $luncher_year,
					'month' => $luncher_month,
					'day' => $luncher_day,
				) );
			}else{
				wp_enqueue_style( 'bootstrap-css', get_theme_file_uri( 'assets/css/bootstrap.css' ) );
				wp_enqueue_style( 'main-css', get_theme_file_uri( 'assets/css/style.css' ) );

				wp_enqueue_script( 'bootstrap-js',get_theme_file_uri( 'assets/js/bootstrap.min.js'), array('jquery'),null, true );
				wp_enqueue_script( 'main-js',get_theme_file_uri( 'assets/js/main.js'), array('jquery'),VERSION, true );
			}
		}

		

	}
	add_action( 'wp_enqueue_scripts','jupiter_theme_assets');

	function jupiter_style(){
		if(is_page()){
			$thumbnail_url = get_the_post_thumbnail_url( null,'large' );
			?>
				<style>
					.slide-header{
						background-image: url(<?php echo $thumbnail_url; ?>);
					}
					.slide-header h1 a{
						margin-top: 30px!important;
					}
				</style>
			<?php
		}
	}
	add_action( 'wp_head', 'jupiter_style');
 ?>