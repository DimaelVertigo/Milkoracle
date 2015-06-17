<?php
/**
 * The header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="content">
 *
 * @package Milkoracle
 */
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="google-site-verification" content="RASKMs12ELII8T5aay9Yq_UeygmTLuQoyEeuVio8Wa8" />
<link href='https://fonts.googleapis.com/css?family=Open+Sans:400,700' rel='stylesheet' type='text/css'>
<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php if (is_front_page()){?>
	<header class="site-header site-header-big">
	
		<div class="container jumbotron">
			<!-- <button id="my-button">my-button</button> -->
			<div class="jumbotron-left"></div>
			<div class="jumbotron-right"><a href="<?php echo home_url(); ?>" class="main-logo"></a>
						
							<h1>Confessions from the<br>lunatic fringe</h1>
						</div>
			
			<nav class="navbar navbar-default">
				<div class="container-fluid">
					<?php if(function_exists('ubermenu')): ?>
						<?php ubermenu( 'main' , array( 'theme_location' => 'primary' ) ); ?>
						<a href="#" class="search-trigger"><div class="search-active" hidden><?php echo do_shortcode('[searchford id="390"]'); ?></div></a>
					<?php else: ?>
					<!-- <div class="menu-trigger"></div>					 -->
					<?php $args = array(
					  'items_wrap'      => '<ul class="nav navbar-nav">%3$s </ul>',
					);
					wp_nav_menu( $args ); ?>
					
					
				</div>
				<!-- /.container-fluid -->			
			</nav>
			<?php endif; ?>
		</div><!-- /.container-fluid -->			
	</header><!-- /.site-header -->
<?php } else if (is_404()){ ?>
<?php } else {?>
	<header class="site-header site-header-small">
		<div class="container jumbotron jumbotron-inners">
			<a href="<?php echo home_url(); ?>" class="main-logo main-logo-inners"></a>
			<h1>Confessions from the lunatic fringe</h1>
			<nav class="navbar navbar-default">
					<div class="container-fluid">
						<?php if(function_exists('ubermenu')): ?>
							<?php ubermenu( 'main' , array( 'theme_location' => 'primary' ) ); ?>
							<a href="#" class="search-trigger"><div class="search-active" hidden><?php echo do_shortcode('[searchford id="390"]'); ?></div></a>
						<?php else: ?>
						<!-- <div class="menu-trigger"></div>					 -->
						<?php $args = array(
						  'items_wrap'      => '<ul class="nav navbar-nav">%3$s </ul>',
						);
						wp_nav_menu( $args ); ?>
						
					</div>
					<!-- /.container-fluid -->			
				</nav>
				<?php endif; ?>
		</div>
	</header>
	<!-- /.site-header -->
<?php } ?>
	<div class="container">
		
	
	

