<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<title><?php wp_title(); ?></title>

	<!-- Definir viewport para dispositivos web móviles -->
	<meta name="viewport" content="width=device-width, minimum-scale=1">

    <link rel="shortcut icon" type="image/png"  href="<?php echo get_bloginfo('stylesheet_directory'); ?>/favicon.png" />    
    <link rel="shortcut icon" type="image/png"  href="/favicon.png" />   

	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
	<?php /*?> jQuery <?php */?>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
    
	<?php /*?>BOOTSTRAP 3.3.5<?php */?>
    <link rel="stylesheet" type="text/css" href="<?php  echo get_bloginfo('stylesheet_directory') ?>/bootstrap-3.3.5-dist/css/bootstrap.min.css">
    <script src="<?php echo get_bloginfo('stylesheet_directory') ?>/bootstrap-3.3.5-dist/js/bootstrap.min.js"></script>
    
    <?php /*?>Font Awesome<?php */?>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
    
    <?php include_once("compartir_rs.php"); ?>
	<link rel="stylesheet" media="all" href="<?php bloginfo( 'stylesheet_url' ); ?>" />
    
	<?php wp_head(); ?>

</head>
<body>