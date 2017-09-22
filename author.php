<?php get_header(); 
	global $post;
	$cat = get_query_var('cat');
	$yourcat = get_category ($cat);
?>
<div class="container">
  	<section id="main" class="col-xs-12 col-sm-7 col-md-8">
  	  	<article id="single">
        	<?php //get_breadcrumb(); ?>
      		<?php if ( have_posts() ){ 
				while ( have_posts() ) : the_post(); 
					$id = get_the_ID();
					$uri = wp_get_attachment_image_src( get_post_thumbnail_id($id), 'medium' );
					?>				
					<div class="media">
						<div class="media-left">
							<a href="<?php the_permalink() ?>">
							  <div class="imgs" style="background-image:url(<?php echo $uri[0] ?>);"></div>
							</a>
						</div>
						<div class="media-body">
							<h1><?php the_title(); ?></h1>
							<p>
							<?php the_excerpt(); ?>
							<div class="clearfix"></div>                
							<a href="<?php the_permalink()?>" class="btn btn-default btn-md pull-right">VER MÁS</a>
							</p>
						</div>           
					</div>        
				<?php endwhile;
			}else{ ?>
            	<?php /*?><img src="<?php echo get_bloginfo('stylesheet_directory'); ?>/images/proximamenteGali.jpg" width="100%" height="auto" alt=""/><?php */?>
            <?php }?>
            
            <!-- paginador -->
                <div class="center">
                  <?php if ($wp_query->max_num_pages > 1) { // check if the max number of pages is greater than 1  ?>                        <ul class="pagination">
                            <?php
                               $inicio = ($paged>2?$paged-2:(1));
                               $fin = (($paged+2 >= $wp_query->max_num_pages)?$wp_query->max_num_pages:($paged+2));
                               for($i=$inicio; $i<=$fin;$i++){
                               ?>
                                    <li class="<?php echo ($paged==$i)? "active": "";  ?>"><a <?php if($paged!=$i){ ?>href="/category/<?php echo $yourcat->slug; ?>/page/<?php  echo $i?>"<?php } ?>><?php  echo $i?></a></li>
                            <?php
                               }?>
                        </ul>
                   <?php } ?>
               </div>
            
            <?php			
			  wp_reset_postdata();?>
		</article> <!-- Fin de single -->
  </section> <!-- Fin de main -->
  <?php  get_sidebar()?>
  </div> 
<?php get_footer(); ?>

