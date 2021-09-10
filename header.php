<!DOCTYPE html>
<!--[if IE 7]>
<html class="ie ie7" <?php language_attributes(); ?>>
<![endif]-->
<!--[if IE 8]>
<html class="ie ie8" <?php language_attributes(); ?>>
<![endif]-->
<!--[if !(IE 7) | !(IE 8) ]><!-->
<html <?php language_attributes(); ?>>
<!--<![endif]-->
	<head>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width">
		<title><?php bloginfo('name'); ?> | <?php is_home() ? bloginfo('description') : wp_title(''); ?></title>
		<link rel="profile" href="http://gmpg.org/xfn/11">
		<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
		<link rel="shortcut icon" href="<?php echo get_template_directory_uri(); ?>/favicon.ico" type="image/x-icon">
		<link rel="icon" href="/favicon.ico" type="image/x-icon">
	<!--[if lt IE 9]>
	<script src="<?php echo get_template_directory_uri(); ?>/js/html5.js"></script>
	<![endif]-->
		<link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/style.css" type="text/css" media="all">
		<script language="javascript" type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/js/jquery-2.1.1.min.js"></script>	
		<script language="javascript" type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/js/functions.js?201501211146"></script>
		<link href='https://fonts.googleapis.com/css?family=Varela+Round' rel='stylesheet' type='text/css'>
		<link href="<?php echo get_template_directory_uri(); ?>/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
		<?php wp_head(); ?>
	</head>
	<body >
		 <header id="header" class="header ">	
			<div id="area-cabecalho" class="pageWidth">
			<!-- chamar função de alteração de logo dinamica -->
				
				<a href="<?php bloginfo('url'); ?>"><?php echo sambatech_chama_logo('',log,'',1); ?>  
				
			<!-- chamada do componente pesquisar -->
				<div id="pesquisar">
				<?php get_search_form(); ?>
				</div>
			</div>	
			<nav id="nav" class="nav ">
				<?php echo sambatech_menu_principal  ('menu'); ?>
			</nav>
		 </header>
	<?php wp_head(); ?>	