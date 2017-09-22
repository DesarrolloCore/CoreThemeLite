<?php 
/**
 * Template Name: Somos
 *
 * A custom page template without sidebar.
 *
 * The "Template Name:" bit above allows this to be selectable
 * from a dropdown menu on the edit page screen.
 *
 * @package WordPress
 * @subpackage core
 * @since Core Theme 0.42
 */

get_header(); global $post;?>


<?php 
	$id = get_the_ID();
	$uri = wp_get_attachment_image_src( get_post_thumbnail_id($id), 'large' );
?>

<!-- Blog Single -->
	<?php /*?><section id="blog" class="post-detail">
		<div class="box-dark parallax" data-stellar-background-ratio="0.5" style="background-image: url('<?php echo $uri[0] ?>');">
			<div class="shadow-bg">
				<div class="wrapper">
					<!-- Post Media -->
					<div class="post-media type-photo">
                    	
						<img src="<?php echo $uri[0] ?>" alt="Post Title" class="img-full">
					</div>
					<!-- Post Media End -->
				</div>
			</div>
		</div><?php */?>
		
		<div class="box-white">
			<div class="wrapper padding-all">
				<!-- Post Title -->
				<div class="post-title">
                	<?php get_breadcrumb(); ?>
					<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>
                    <h1><?php //the_title(); ?></h1>
				</div>
				<!-- Post Title -->
				
				<!-- Post Content -->
				<div class="post-desc">
					<?php the_content(); ?>
                    <?php endwhile;  wp_reset_postdata();?>
				</div>
				<!-- Post Content End -->
				
				
				
				<div class="space"></div>
			</div>
		</div>
	</section>
	<!-- Blog Single End -->
  
<style>
#single p{
	text-align:justify;
}
.attachment-large{
	width:100% !important;
	height: auto !important;
}
ul.breadcrumbs {
    list-style: none;
    padding: 0;
    margin: 0;
    font-size:12px;
}
ul.breadcrumbs li {
    float: left;
    margin: 0 5px 0 0;
    padding: 0;
}
.alignright{
	float:right;
	margin:15px;	
}
.alignleft{
	float:left;
	margin:15px;	
}
body {background-color:#FFFFFF !important;}
.borde-redondo{border-radius:15px;}
</style>
<div style="margin-bottom:5rem"></div>
<?php get_footer(); ?>

