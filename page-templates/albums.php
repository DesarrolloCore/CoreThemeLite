<?php 
/**
 * Template Name: Albums
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
get_header(); ?>

<!-- Latest compiled and minified CSS -->


<div class="container">
<?php 
global $wpdb;
$id = $_GET["g"];
$results = $wpdb->get_results( 'SELECT * FROM wp_bwg_gallery WHERE published = 1 ORDER BY id DESC', OBJECT );
$count = 0;//var_dump($results);
function mes($num){
	$mes = array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");
	return $mes[$num - 1];
}
?>

	<script>
		<?php /*?>jQuery(document).ready(function(){
		    jQuery("#menuH > ul > li:nth-child(5)").append('<div class="barrita_roja"></div>');
		    jQuery(".galeria__caja--trans").hover(function(){
		    	jQuery(this).css("background-color","rgba(0,0,0,0)");
		    	jQuery(this).children().fadeIn( "slow" );
		    }, function(){
		    	jQuery(this).css("background-color","rgba(0,0,0,0.4)");
		    	jQuery(this).children().fadeOut( "slow" );
		    });
		});<?php */?>
	</script>

	<main>
		<div style="height: 5rem;"></div>
		<div id="galeria">
			<div class="width">
				<p class="gal-tit" style="padding-bottom:3rem; color:#615a63">GALERÍA TRABAJANDO</p>
				<div class="galeria__cols">
					<div class="col-sm-12 no-pad Fl">
						<?php foreach ($results as $k => $g):
						 ?>
							<a class="fancy2" rel="gal" href="/galeria/?id=<?php echo $g->id."&album=".$g->name; ?>">
								<div class="col-sm-3 col-sm-offset-1 Fl no-pad" style="background-repeat: no-repeat; background-size: cover; background-position: center; background-image: url('/wp-content/uploads/photo-gallery/<?php echo $g->preview_image ?>');" data-foto="/wp-content/uploads/photo-gallery/<?php echo $g->image_url ?>">
									<div class="galeria__caja--trans">
										<div class="hover">
											<div class="gal-fecha"><?php /*$x = new DateTime($g->fecha); echo $x->format('d'); ?><br><span><?php $x = new DateTime($g->fecha); echo mes($x->format('m'));*/ ?><?php echo $g->description; ?></span></div>
											<div class="clear"></div>
											<div class="gal-texto"><?php echo $g->name; ?></div>
										</div>
									</div><!-- end |.galeria__caja--trans -->
								</div><!-- end |.galeria__caja -->
							</a>
						<?php endforeach ?>
					</div><!-- end |.galeria__col--1 Fl -->
					<div class="clear"></div><!-- end |.clear -->
					<div class="Fr">
						<a href="/" class="btn btn-danger btn-sm pull-right" style="margin-top:2rem">Inicio</a>
					</div><!-- end |.Fr -->
					<div class="clear"></div><!-- end |.clear -->
				</div><!-- end |.galeria__cols -->
			<!--<div class="row" style="padding-top:3rem">
            	<hr>
                <iframe width="100%" height="350" scrolling="yes" frameborder="no" src="https://w.soundcloud.com/player/?url=https%3A//api.soundcloud.com/users/145862987&amp;color=ff5500&amp;auto_play=false&amp;hide_related=false&amp;show_comments=true&amp;show_user=true&amp;show_reposts=false"></iframe>
            </div>-->
			</div><!-- end |.width -->
		</div><!-- end #galeria| -->
	</main>
	<div style="height: 3rem; clear: both;"></div>
</div>
<style>
	.gal-tit {
		text-align: left; 
		font-size: 24px; 	
	}
	.no-pad {
		padding-left: 0;
		margin-bottom: 4rem;
		padding-right: 0;
	}
	.galeria__caja--trans {
		height: 20rem;
	}
	.hover {
		display: inline-block;
	}
	.gal-fecha {
		background-color: #ab1727;
		color: #fff;
		float: right;
		padding: 1rem;
		text-align: center;
		text-transform: uppercase;
	}
	.gal-texto{
		background-color: #ab1727;
		color: #fff;
		text-align: center;
		bottom: 2rem;
		position: absolute;
		width: 90%;
		margin-left: 1rem;
		margin-right: 1rem;
	}
	.galeria__caja--trans{
		background-color:rgba(0,0,0,.4);
	}
	.hover p{
		margin-bottom:0px;
	}

</style>
<script>


$( document ).ready(function() {

jQuery("#mnu_inicio").removeClass("active");
jQuery("#mnu_conoceme").removeClass("active");
jQuery("#mnu_galeria").addClass("active");
jQuery("#mnu_contacto").removeClass("active");

});

</script>
<?php get_footer(); ?>

