<?php get_header(); global $post;?>
<div class="container">
  	<section id="main" class="col-xs-12 col-sm-7 col-md-8">
  	  	<article id="single" class="post-detail">
        	<?php get_breadcrumb(); ?>
      		<?php if ( have_posts() ) 
				while ( have_posts() ) : the_post(); ?>
					<?php if ( is_front_page() ) { ?>
                    	<h2><?php the_title(); ?></h2>
                    <?php } else { ?>
                    	<h1><?php the_title(); ?></h1>
                    <?php } ?>
                    <?php 
					$id = get_the_ID();
					$uri = wp_get_attachment_image_src( get_post_thumbnail_id($id), 'large' );
					 ?>
                    <div class="col-xs-12" style="">
                        <div class="shadow-bg">
                            <div class="wrapper">
                                <!-- Post Media -->
                                <div class="post-media type-photo">                                    
                                    <img src="<?php echo $uri[0] ?>" alt="<?php the_title(); ?>" class="img-full">
                                </div>
                                <!-- Post Media End -->
                            </div>
                        </div>
                        
                    </div>
                    <div class="clearfix"></div>
					<div><?php the_content(); ?></div>
					
					
				<?php //comments_template(); ?>
            <?php endwhile; 
			wp_reset_postdata();?>
		</article> <!-- Fin de single -->
        <div style="margin-bottom:5rem"></div>
    <?php
	$prev_post = get_previous_post(true);
	if (!empty( $prev_post )): ?>
		<a class="pull-left" href="<?php echo get_permalink( $prev_post->ID ); ?>" style="color:black"><i class="fa fa-arrow-circle-o-left" style="font-size:15px; color:#00A3FF"></i>  Anterior</a>
	<?php else: ?> 
		<span class="pull-left" href="#" style="color:gray;"><i class="fa fa-arrow-circle-o-left" style="font-size:15px; color:#90CEDD"></i> Anterior</span>
	<?php endif; ?>
	
	 <?php
	$next_post = get_next_post(true);
	if (!empty( $next_post )): ?>
		<a class="pull-right" href="<?php echo get_permalink( $next_post->ID ); ?>" style="color:black">Siguiente <i class="fa fa-arrow-circle-o-right" style="font-size:15px; color:#00A3FF"></i></a>
	<?php else: ?> 
		<span class="pull-right" href="#" style="color:gray;">Siguiente <i class="fa fa-arrow-circle-o-right" style="font-size:15px; color:#90CEDD"></i>	</span>
	<?php endif; ?>
    
	<div class="clearfix"></div>

  </section> <!-- Fin de main -->
  <?php  get_sidebar()?>
  </div>
<div style="margin-bottom:5rem"></div>
<?php get_footer(); ?>