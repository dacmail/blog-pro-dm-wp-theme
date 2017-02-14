<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
	<aside class="pre-header">
		<div class="container">
			Noticias del Ayuntamiento de Madrid
			<a href="https://diario.madrid.es"><img class="logo-madrid" src="<?php ungrynerd_path('/images/logo_madrid.png') ?>" alt="Ayuntamiento de Madrid"></a>
		</div>
	</aside>
	<header class="navbar header" id="header">
		<div class="container">
			<div class="navbar-header">
				<button class="navbar-toggle collapsed" type="button" data-toggle="collapse" data-target="#main-menu">
					<span class="sr-only"><?php _e('Menu', 'ungrynerd'); ?></span>
					<i class="fa fa-bars"></i>
				</button>
				<a href="<?php echo esc_url(home_url('/')); ?>" class="logo navbar-brand">
					<?php if (has_custom_logo()): ?>
						<?php the_custom_logo(); ?>
					<?php else: ?>
						<?php bloginfo('name'); ?>
					<?php endif ?>
				</a>
			</div>
			<?php wp_nav_menu(array('container' => 'nav',
								'container_id' => 'main-menu',
								'container_class' => 'collapse width navbar-collapse',
								'menu_class' => 'main-nav',
								'theme_location' => 'main',
								'fallback_cb' => false)); ?>

		</div> <!--- /.container -->
		<?php if (has_header_image()): ?>
			<div class="header-image" style="background-image:url(<?php header_image(); ?>)"></div>
		<?php endif ?>
	</header>
