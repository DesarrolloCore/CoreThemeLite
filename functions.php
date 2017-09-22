<?php
// Registro del menú de WordPress

add_theme_support( 'nav-menus' );

if ( function_exists( 'register_nav_menus' ) ) {
    register_nav_menus(
        array(
          'main' => 'Main'
        )
    );
}     
//  Main Sidebar
if(function_exists('register_sidebar'))
	  register_sidebar(array(
	  'name' => 'Main Sidebar',
	   'before_widget' => '<hr>',
		'after_widget' => '',
	  'before_title' => '<h3>',
	  'after_title' => '</h3>',
));
//Habilitar thumbnails
add_theme_support('post-thumbnails');
set_post_thumbnail_size(150, 150, true);

// Permitir comentarios encadenados
function enable_threaded_comments(){
    if (is_singular() AND comments_open() AND (get_option('thread_comments') == 1)) {
       wp_enqueue_script('comment-reply');
    }
}
add_action('get_header', 'enable_threaded_comments');

add_filter( 'wp_title', 'baw_hack_wp_title_for_home' );
function baw_hack_wp_title_for_home( $title )
{
  if( empty( $title ) && ( is_home() || is_front_page() ) ) {
    return get_bloginfo( 'title' ) . ' | ' . get_bloginfo( 'description' );
  }
  return $title;
}


//DESACTIVAR RSS y COMMENT RSS

function disable_all_feeds() {
   wp_die( __('Lo siento, nuestro contenido no está disponible mediante RSS. Por favor, visita <a href="'. get_bloginfo('url') .'">la web</a>para leerla') );
}

add_action('do_feed', 'disable_all_feeds', 1);
add_action('do_feed_rdf', 'disable_all_feeds', 1);
add_action('do_feed_rss', 'disable_all_feeds', 1);
add_action('do_feed_rss2', 'disable_all_feeds', 1);
add_action('do_feed_atom', 'disable_all_feeds', 1);
add_action('comments_rss2_url', 'disable_all_feeds', 1);


//Muestra las categorias a las que esta relacionada
function get_breadcrumb(){
    global $wp_query;
    if ( !is_home() ){
        // Start the UL
        echo '<ul class="breadcrumbs">';        // Add the Home link
        echo '<li><a href="'. get_settings('home') .'">'. get_bloginfo('name') .' / </a></li>';
        if ( is_category() ){
            //$catTitle = single_cat_title( "", false );
			$cat = get_query_var('cat');
  			$yourcat = get_category ($cat);
            $cat = get_category_by_slug( $yourcat->slug );
            echo "<li>  ". rtrim(get_category_parents( $cat, TRUE, " / " ) , " / ")."</li>";
        }
        elseif ( is_archive() && !is_category() )        {
            echo "<li>  Archives</li>";
        }
        elseif ( is_search() ) {

            echo "<li>  Search Results</li>";
        }
        elseif ( is_404() ) {
            echo "<li>  404 Not Found</li>";
        }
        elseif ( is_single() ) {
            $category = get_the_category();
            $category_id = get_cat_ID( $category[0]->cat_name );

            echo '<li>  '. get_category_parents( $category_id, TRUE, " / " );
            echo the_title('','', FALSE) ."</li>";
        }elseif ( is_page() ){
            $post = $wp_query->get_queried_object();

            if ( $post->post_parent == 0 ){
                echo "<li>  ".the_title('','', FALSE)."</li>";
            } else {
                $title = the_title('','', FALSE);
                $ancestors = array_reverse( get_post_ancestors( $post->ID ) );
                array_push($ancestors, $post->ID);

                foreach ( $ancestors as $ancestor ){
                    if( $ancestor != end($ancestors) ){
                        echo '<li>  <a href="'. get_permalink($ancestor) .'">'. strip_tags( apply_filters( 'single_post_title', get_the_title( $ancestor ) ) ) .'</a></li>';
                    } else {
                        echo '<li>  '. strip_tags( apply_filters( 'single_post_title', get_the_title( $ancestor ) ) ) .'</li>';
                    }
                }
            }
        }
        // End the UL
        echo "</ul>";
    }
	echo "<br><br>";
}

/*NECESARIO PARA PAGINACION EN CATEGORY'S*/

function wpse_modify_category_query( $query ) {
	if ( ! is_admin() && $query->is_main_query() ) {
		$paged = (get_query_var('paged')) ? get_query_var('paged') : 1; 
		if ( $query->is_category() ) {
			$query->set( 'posts_per_page', '7' );
			$query->set( 'orderby', 'post_date' );
			$query->set( 'order', 'DESC' );
			$query->set( 'paged', $paged);
		}
		if($query->is_home()){
			if(!session_id()) {
				session_start();
			}
			$query->set( 'posts_per_page', 9 );
			$query->set( 'orderby', 'modified' );
			$query->set( 'paged', $paged);
			$_SESSION["query"] = $query->query_vars;
		}
	} 
}
add_action( 'pre_get_posts', 'wpse_modify_category_query' );

function add_theme_caps() {
	/***************************************************************/
	/* Darle permisos de editar en el photo-gallery a los editores */
	/***************************************************************/
    $role = get_role( 'editor' );
    $role->add_cap( 'manage_options' ); 
	
	
	/******Argumentos para la descarga de los plugins************/
	/*$args = array(
            'path' => ABSPATH.'wp-content/plugins/',
            'preserve_zip' => false
    );
	
	
	/************************************************************/
	/* Verificar si está el plugin en caso contrario instalarlo */
	/************************************************************/
	
	/*if ( !is_plugin_active( 'wps-hide-login/wps-hide-login.php' ) ) {
		$plugin = array('name' => 'WPS Hide Login', 'path' => 'https://downloads.wordpress.org/plugin/wps-hide-login.1.1.3.zip', 'install' => 'wps-hide-login/wps-hide-login.php');
	  	mm_plugin_download($plugin['path'], $args['path'].$plugin['name'].'.zip');
		mm_plugin_unpack($args, $args['path'].$plugin['name'].'.zip');
		//mm_plugin_activate($plugin['install']);
	} 
	if ( !is_plugin_active( 'photo-gallery/photo-gallery.php' ) ) {
		$plugin = array('name' => 'Photo Gallery', 'path' => 'https://downloads.wordpress.org/plugin/photo-gallery.1.2.78.zip', 'install' => 'photo-gallery/photo-gallery.php');
	  	mm_plugin_download($plugin['path'], $args['path'].$plugin['name'].'.zip');
		mm_plugin_unpack($args, $args['path'].$plugin['name'].'.zip');
		//mm_plugin_activate($plugin['install']);
	}*/
	
	if ( !is_plugin_active( 'core-options/core-options.php' ) ) {
		rcopy("{$_SERVER['DOCUMENT_ROOT']}/wp-content/themes/coreLite/plugins/core-options/","{$_SERVER['DOCUMENT_ROOT']}/wp-content/plugins/core-options/");
		mm_plugin_activate('core-options/core-options.php');
	}
}
/****************************************************************/
/* Carga la función de add_theme_caps cuando se inicie el admin */
/****************************************************************/
add_action( 'admin_init', 'add_theme_caps');
/****************************************************************/

/*******************************************************/
/* Funciones para forzar la instalación de los plugins */
/*******************************************************/

/*function mm_plugin_download($url, $path) {
    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $data = curl_exec($ch);
    curl_close($ch);
    if(file_put_contents($path, $data))
    	return true;
    else
        return false;
}

function mm_plugin_unpack($args, $target){
    if($zip = zip_open($target)) {
		while($entry = zip_read($zip)) {
			$is_file = substr(zip_entry_name($entry), -1) == '/' ? false : true;
			$file_path = $args['path'].zip_entry_name($entry);
			if($is_file) {
				if(zip_entry_open($zip,$entry,"r")) {
						$fstream = zip_entry_read($entry, zip_entry_filesize($entry));
					file_put_contents($file_path, $fstream );
					chmod($file_path, 0777);
					//echo "save: ".$file_path."<br />";
				}
				zip_entry_close($entry);
			} else {
				if(zip_entry_name($entry) && !file_exists($file_path)) {
					mkdir($file_path);
					chmod($file_path, 0777);
					//echo "create: ".$file_path."<br />";
				}
			}
		}
        zip_close($zip);
    }
    if($args['preserve_zip'] === false) {
        unlink($target);
    }
}*/

function mm_plugin_activate($installer) {
    $current = get_option('active_plugins');
    $plugin = plugin_basename(trim($installer));

    if(!in_array($plugin, $current)) {
		$current[] = $plugin;
		sort($current);
		do_action('activate_plugin', trim($plugin));
		update_option('active_plugins', $current);
		do_action('activate_'.trim($plugin));
		do_action('activated_plugin', trim($plugin));
		return true;
    } else
        return false;
}
/*******************************************************/
/*******************************************************/

/**********************************************************************/
/* Caracteres que muestran cuando el texto no se alcanza a visualizar */
/**********************************************************************/
function new_excerpt_more($more) {
	global $post;
	return ' [...]';
}
add_filter('excerpt_more', 'new_excerpt_more');
/**********************************************************************/

/***********************************************/
/* Longitud del excerpt son palabras a mostrar */
/***********************************************/
function custom_excerpt_length( $length ) {
	return 30;
}
add_filter( 'excerpt_length', 'custom_excerpt_length', 1 );
/***********************************************/

/*************************************************/
/* Función para traer los articulos relacionados */
/*************************************************/
/*function related_post($id){
	$tags = wp_get_post_tags($id);
	if ($tags) {
		$tag_ids = array();
		foreach($tags as $individual_tag) {
			$tag_ids[] = $individual_tag->term_id;
		}
		$args=array(
			'tag__in' => $tag_ids,
			'post__not_in' => array($id),
			'showposts'=>6, // Number of related posts that will be shown.
			'caller_get_posts'=>1,
			'post_status' => 'publish'
		);
		$my_query = new wp_query($args);
		if( $my_query->have_posts() ) {
			echo '<h3>Artículos relacionados</h3><ul class="row">';
			while ($my_query->have_posts()) {
				$my_query->the_post();
				$id_rel = get_the_ID();
				$uri = wp_get_attachment_image_src( get_post_thumbnail_id($id_rel), 'medium' );
				?>
                <li class="col-xs-12 col-sm-6 col-md-4 related">
                    <div class="media">
                        <div class="related-image">
                            <a href="<?php the_permalink() ?>">
                              <div class="imgs" style="background-image:url(<?php echo $uri[0] ?>);"></div>
                            </a>
                        </div>
                        <div class="media-body">
                            <h1><?php the_title(); ?></h1>
                            <p>
                            	<?php the_excerpt(); ?>
                            </p>
                            <div class="clearfix"></div>   
                            <div>             
                            	<a href="<?php the_permalink()?>" class="btn btn-default btn-md">VER MÁS</a>
                            </div>
                        </div>           
                    </div>  
                </li>
                <?php 
			}
			echo '</ul>';
		}
		wp_reset_postdata(); 
	}
}*/
/*************************************************/

/******************************************/
/* Función para cachar el widgets de tags */
/******************************************/
/*function widget_custom_tag_cloud($args) {
    // Tag font unit px, pt, em
    $args['unit'] = 'px';
    // Maximum tag text size
    $args['largest'] = 20;
    // Minimum tag text size
    $args['smallest'] = 12;
    // Outputs our edited widget
    return $args;
}
add_filter( 'widget_tag_cloud_args', 'widget_custom_tag_cloud' );
/******************************************/

/*********************************************/
/* Función para agregar el clearfix al final */
/*********************************************/
add_filter ( 'wp_tag_cloud', 'show_tag_cloud_count' );
function show_tag_cloud_count( $return ) {
	return $return . '<div class="clearfix"></div>';
}
/*********************************************/

/**********************/
/* Cachar search form */
/**********************/
/**
 * Generate custom search form
 *
 * @param string $form Form HTML.
 * @return string Modified form HTML.
 */
/*function wpdocs_my_search_form( $form ) {
	$form = '<form method="get" id="searchform" role="search" class="searchform" action="' . home_url( '/' ) . '">
				<div class="input-group add-on">
					<input type="text" value="' . get_search_query() . '" name="s" id="s" class="form-control" placeholder="Buscar">
					<div class="input-group-btn">
						<button class="btn btn-default" type="submit" value="Buscar"><i class="glyphicon glyphicon-search"></i></button>
					</div>
				</div>
			</form>'; 
    return $form;
}
add_filter( 'get_search_form', 'wpdocs_my_search_form' );
/**********************/

/************************************************/
/* Función ajax para la carga dinámica de posts */
/************************************************/
/*add_action( 'wp_ajax_get_post_lazy', 'post_lazy' );
add_action( 'wp_ajax_nopriv_get_post_lazy', 'post_lazy' );

function post_lazy() {
	global $wpdb; // this is how you get access to the database
	$paged = $_REQUEST["page"];
	$args = $_SESSION["query"];
	$args["paged"] = $paged;
	$args["posts_per_page"] = 9;
	$args["post_status"] = "publish";
	$args["orderby"] = 'modified';
	$query = new WP_Query( $args );
	posts_masonry($query);
	exit(); // this is required to terminate immediately and return a proper response
}
/************************************************/

/********************************************************************************************/
/* Función para cargar la información de un post en el homepage con las clases para masonry */
/********************************************************************************************/
/*function posts_masonry($query2){
	if($query2->have_posts()):
		while($query2->have_posts()){ 
			$query2->the_post();
			?>
				<div class="grid-item">
					<div class="image">
						<?php 
							$featured_image = "";
							if(has_post_thumbnail()){
								$img_psot_medium = wp_get_attachment_image_src( get_post_thumbnail_id($query2->ID), 'medium' );
								$featured_image = $img_psot_medium[0];
							}else{
								$featured_image = $GLOBALS["default_image"];
							} 
						?>
						<a href="<?php the_permalink();?>">
							<img width="100%" height="auto" src="<?php echo $featured_image;?>" class="attachment-thumbnail size-thumbnail wp-post-image" alt="core">
						</a>
					</div>
					<div class="post_info">
						<div class="post_title">
							<p><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></p>
							<p><i class="fa fa-commenting"></i> <?php comments_number( 'Sin respuestas', 'una respuestas', '% respuestas' ); ?></p>
						</div>
						<div class="post_author">
							<p><?php echo get_avatar( get_the_author_meta( 'ID' ), 32 ); ?> <?php the_author_posts_link();?></p>
						</div>
					</div>
				</div>
			<?php
		}
	endif;
}
/********************************************************************************************/

//* Cambia el logotipo de la página inicio de sesión de WordPress (usar imagen de 80x80px)
function mi_logo_personalizado() { ?>
    <style type="text/css">
        body.login div#login h1 a {
            background-image: url(<?php echo get_stylesheet_directory_uri(); ?>/images/logocore.png);
			padding-bottom: 10px;
			background-size: contain;
			width: 150px;
			height: 150px;
		}
    </style>
<?php }
add_action( 'login_enqueue_scripts', 'mi_logo_personalizado' );

function mi_logo_personalizado_url() {
    return get_bloginfo( 'url' );
}
add_filter( 'login_headerurl', 'mi_logo_personalizado_url' );
function mi_logo_personalizado_url_titulo() {
    return '';
}
add_filter( 'login_headertitle', 'mi_logo_personalizado_url_titulo' );

/*******************************************************************************************/
/*Función para cargar las opciones del tema core*/
$opciones;
add_action( 'init', 'cargar_opciones' );
function cargar_opciones(){
	global $opciones;
	global $wpdb;
	$temp = $wpdb->get_results("SELECT * FROM {$wpdb->prefix}opciones WHERE activo = 'activo'");
	foreach($temp as $row){
		$opciones[$row->opcion] = $row->valor;
	}
}
/*******************************************************************************************/

/**
 * Recursively copy files from one directory to another
 * 
 * @param String $src - Source of files being moved
 * @param String $dest - Destination of files being moved
 */
function rcopy($src, $dest){

    // If source is not a directory stop processing
    if(!is_dir($src)) return false;

    // If the destination directory does not exist create it
    if(!is_dir($dest)) { 
        if(!mkdir($dest)) {
            // If the destination directory could not be created stop processing
            return false;
        }    
    }

    // Open the source directory to read in files
    $i = new DirectoryIterator($src);
    foreach($i as $f) {
        if($f->isFile()) {
            copy($f->getRealPath(), "$dest/" . $f->getFilename());
        } else if(!$f->isDot() && $f->isDir()) {
            rcopy($f->getRealPath(), "$dest/$f");
        }
    }
}

?>