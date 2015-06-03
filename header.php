<?php 
/**
 * header.php
 *
 * The header for the theme.
 */
?>

<?php 
	// Get the favicon.
	$favicon = IMAGES . '/icons/favicon.png';

	// Get the custom touch icon.
	$touch_icon = IMAGES . '/icons/apple-touch-icon-152x152-precomposed.png';
?>

<!DOCTYPE html>
<!--[if IE 8]> <html <?php language_attributes(); ?> class="ie8"> <![endif]-->
<!--[if !IE]><!--> <html <?php language_attributes(); ?>> <!--<![endif]-->

<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<title><?php wp_title( '|', true, 'right' ); ?><?php bloginfo( 'name' ); ?></title>
	

	<!-- Mobile Specific Meta -->
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

	<!--[if lt IE 9]>
		<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
	<![endif]-->
    
    <link href='http://fonts.googleapis.com/css?family=Lato:400,700,900' rel='stylesheet' type='text/css'>

	<!-- Favicon and Apple Icons -->
	<link rel="shortcut icon" href="<?php echo $favicon; ?>">
	<link rel="apple-touch-icon-precomposed" sizes="152x152" href="<?php echo $touch_icon; ?>">
    <link rel="stylesheet" type="text/css" href="<?php bloginfo('stylesheet_directory' ); ?>/css/datepicker_assets/jquery-ui.min.css">
    <link rel="stylesheet" type="text/css" href="<?php bloginfo('stylesheet_directory' ); ?>/css/datepicker_assets/jquery-ui.structure.min.css">
    <link rel="stylesheet" type="text/css" href="<?php bloginfo('stylesheet_directory' ); ?>/css/datepicker_assets/jquery-ui.theme.min.css">
    <link rel="stylesheet" type="text/css" href="<?php bloginfo('stylesheet_directory' ); ?>/css/william_style.css">


    <script type="text/javascript" src="<?php bloginfo('stylesheet_directory' ); ?>/js/jquery-1.8.3.min.js"></script>
    <script type="text/javascript" src="<?php bloginfo('stylesheet_directory' ); ?>/js/jquery.ui.datepicker.js"></script>
    <script type="text/javascript"src="<?php bloginfo('stylesheet_directory' ); ?>/css/datepicker_assets/jquery-ui.min.js"></script>
    <script type="text/javascript"src="<?php bloginfo('stylesheet_directory' ); ?>/js/form_ajax.js"></script>

    <?php wp_head(); ?>
    
    <script>
      (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
      (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
      m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
      })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

      ga('create', 'UA-63061552-1', 'auto');
      ga('send', 'pageview');

    </script>
    
    
</head>
<body <?php body_class(); ?>>
    
    

    <!-- HEADER -->
    <header class="site-header" role="banner">
        <div class="container header-contents">
			<div class="row">
				<div class="col-xs-12 col-md-3">
					<div class="site-logo">
						<a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="Williams Garage - Airport transfers in Malta" rel="home"></a>
					</div> <!-- end site-logo -->
				</div> <!-- end col-xs-3 -->
				<div class="col-xs-9">
					<nav class="site-navigation" role="navigation">
						<?php 
							wp_nav_menu(
								array(
									'theme_location' => 'main-menu',
									'menu_class' => 'site-menu'
								)
							);
						?>
					</nav>
				</div> <!-- end col-xs-9 -->
			</div> <!-- end row -->
		</div> <!-- end container -->
	</header> <!-- end site-header -->