	<?php
		global $opciones;
        $thumb = get_post_meta($post->ID,'_thumbnail_id',false);
        $thumb = wp_get_attachment_image_src($thumb[0], false);
        $thumb = $thumb[0];
		
		/* Se dejan en variables para solo modificar en un solo lugar */
		$titulo = $opciones['titulo'];
		$descripcion = $opciones['extracto'];
		$twitter = $opciones['usuarioTwitter'];//sin el @
		// La imagen se debe de subir en la raíz de wordpress
		$default_image = $opciones['imagenDestacada'];
		$GLOBALS["default_image"] = $default_image;
		/**************************************************************/
		
    ?>
    <?php if(!is_home()) { ?>
        <meta property="og:type" content="article" />
        <meta property="og:title" content="<?php single_post_title(''); ?>" />
        <meta property="og:description" content="<?php 
        while(have_posts()):the_post();
	        $out_excerpt = strip_tags(str_replace(array("\r\n", "\r", "\n"), "", get_the_excerpt()));
	        echo apply_filters('the_excerpt_rss', $out_excerpt);
        endwhile; 	?>" />
        <meta property="og:url" content="<?php the_permalink(); ?>"/>
        <meta property="og:image" content="<?php if ( $thumb[0] == null ) { echo $default_image; } else { echo $thumb; } ?>" />
    <?php  } else { ?>
        <!-- Schema.org markup for Google+ -->
		<meta itemprop="name" content="<?php echo $titulo; ?>">
		<meta itemprop="description" content="<?php echo $descripcion; ?>">
		<meta itemprop="image" content="<?php echo $default_image; ?>" />
		<!-- Twitter Card data -->
		<meta name="twitter:card" content="summary_large_image">
		<meta name="twitter:site" content="@<?php echo $twitter; ?>">
		<meta name="twitter:title" content="<?php echo $titulo; ?>">
		<meta name="twitter:description" content="<?php echo $descripcion; ?>">
		<meta name="twitter:creator" content="@<?php echo $twitter; ?>">
		<!-- Twitter summary card with large image must be at least 280x150px -->
		<meta name="twitter:image:src" content="<?php echo $default_image; ?>" />
		<!-- Open Graph data -->
		<meta property="og:title" content="<?php echo $titulo; ?>" />
		<meta property="og:type" content="page" />
		<meta property="og:url" content="<?php echo get_site_url(); ?>" />
		<meta property="og:image" content="<?php echo $default_image; ?>" />
		<meta property="og:description" content="<?php echo $descripcion?>" />
		<meta property="og:site_name" content="<?php echo $titulo; ?>" />
    <?php  }  ?>
    <meta name="description" content="<?php echo $descripcion; ?>">