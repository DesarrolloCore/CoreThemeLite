<html xmlns:fb="http://ogp.me/ns/fb#">
<?php

/**

 * Template Name: Galeria-Album

 *

 * A custom page template without sidebar.

 *

 * The "Template Name:" bit above allows this to be selectable

 * from a dropdown menu on the edit page screen.

 *

 * @package WordPress

 * @subpackage GMK-Theme

 * @since GMK Wordpress Theme 0.42

 */



get_header(); ?>
<!-- Latest compiled and minified CSS -->
<script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-5464f2dd131e4afe" async="async"></script>
<div class="container">
<?php 
global $wpdb;
$count = 0;
$id = $_GET['id'];
$album = $_GET['album'];
 ?>
 	<script>
		jQuery(document).ready(function(){
		    jQuery(".caja_gali").hover(function() {
   		    	jQuery(this).find(".red_tit_gali").show().animate({
   		    		'width': '100%',
   		    		'height': '100%'
				}).text(jQuery(this).data('tit'));
    		}, function() {
    		    jQuery(this).find(".red_tit_gali").hide().animate({
    		   		'width': '0%',
    		   		'height': '0px'
				}).text(jQuery(this).data('tit'));
    		});
		});
	</script>
	<main>
		<div style="height: 5rem;"></div>
		 <div id="galeria" class="container">
	    	<p align="center" style="font-size:42px; color:#615a63;"><?php echo $album; ?></p>
	    	<div style="height: 2rem;"></div>
	    	<div class="cajas_gali">
	    	<?php		
    			$results = $wpdb->get_results( 'SELECT * FROM wp_bwg_image WHERE gallery_id ='.$id.'  ORDER BY id DESC', OBJECT ); 
			?>
	    	<?php foreach ($results as $k => $g): //var_dump($g);exit();?>
	    		<a class="fancy col-xs-12 col-sm-4 col-md-3" style="text-decoration:none;" rel="gal" title="<?php echo $g->alt; ?>" href="<?php echo get_site_url(); ?>/wp-content/uploads/photo-gallery<?php $cadena = str_replace(" ","%20",$g->image_url); echo $cadena ?>">
	    			<div class="caja_gali Fl" style="background-image: url('/wp-content/uploads/photo-gallery/<?php $cadena = str_replace(" ","%20",$g->image_url); echo $cadena ?>');">
	    			<div class="red_tit_gali" data-tit="<?php echo $g->alt; ?>"><strong style="color:#fff"><?php echo $g->alt; ?></strong><br><?php //$t=new DateTime($g->date); echo date_format($t, sU'M Y'); ?></div><!-- end |.red_tit_gali -->
	    			</div><!-- end |.caja_gali Fl -->
	    		</a>
	    	<?php endforeach ?>
	    	</div><!-- end |.cajas_gali -->
	    </div>
        <div class="clear"></div><!-- end |.clear -->
	    <a href="/album" class="btn btn-danger btn-sm pull-right" style="margin-top:2rem">Atrás</a>
	 </main>
     <div style="height: 3rem; clear: both;"></div>
</div>

<style>
	.caja_gali{
		/*width: 25%;*/
		height: 180px;
		background-position: top;
		-webkit-background-size: cover;
		background-size: cover;
		background-repeat: no-repeat;
	}
	
	.red_tit_gali{
		width: 0%;
		height: 0px;
		background-color: rgba(0,0,0,0.5);
		color: #fff;
		display: none;
		text-align: center;
		font-family: "Franklin Gothic";
		font-size: 20px;
		padding-top: 70px;
	}
	a.fancy {
  		padding-bottom: 3rem;
	}
	.galeria__caja--trans{
		background-color:rgba(0,0,0,.4);
	}
</style>


<script>

	
	
	jQuery("a.fancy").fancybox({
		beforeShow : function() {						
			this.title = '<div class="addthis addthis_default_style "><a addthis:url="' + this.href + '" addthis:image="' + this.href + '" addthis:title="' + this.title + '" class="addthis_button_facebook"></a><a href="' + this.href + '"  addthis:url="' + this.href + '" addthis:title="' + this.title + '" class="addthis_button_twitter"></a></a><a href="' + this.href + '" addthis:url="' + this.href + '" addthis:title="' + this.title + '" addthis:image="' + this.href + '" class="addthis_button_compact"></a><a href="' + this.href + '" addthis:url="' + this.href + '" addthis:title="' + this.title + '" class="addthis_counter addthis_bubble_style"></a></div>';
		},
		afterShow : function() {
			 addthis.toolbox(
				jQuery(".addthis").get()
			);
			addthis.counter(
				jQuery(".addthis_counter").get()
			);
		},
		helpers : {
			title : {
				type : 'inside'
			}   
		},
		'transitionIn'	:	'elastic',
		'transitionOut'	:	'elastic',
		'speedIn'		:	600, 
		'speedOut'		:	200, 
		'overlayShow'	:	false
	});
</script>

<script>

$( document ).ready(function() {

jQuery("#mnu_inicio").removeClass("active");
jQuery("#mnu_conoceme").removeClass("active");
jQuery("#mnu_galeria").addClass("active");
jQuery("#mnu_contacto").removeClass("active");

});

</script>
<?php get_footer(); ?>

