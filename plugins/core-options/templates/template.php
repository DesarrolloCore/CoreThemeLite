<form method='post' enctype="multipart/form-data">
    <div class="container-fluid">
    	<div class="row">
	        <div class='wrap'><h2>Redes Sociales <span class="help" title="Todas las URL van completas desde el http://">?</span></h2></div>
            <?php 
				global $opciones;
				//var_dump($opciones);
			?>
        	<div class="col-xs-12 col-md-4">
            	<div class="form-group">
                    <label for="facebook">Facebook</label>
                    <input type="text" class="form-control" id="facebook" name="facebook" placeholder="Facebook" value="<?php echo (isset($opciones["facebook"])?$opciones["facebook"]:"");?>">
                </div>
            </div>
        	<div class="col-xs-12 col-md-4">
            	<div class="form-group">
                    <label for="twitter">Twitter</label>
                    <input type="text" class="form-control" id="twitter" name="twitter" placeholder="Twitter" value="<?php echo (isset($opciones["twitter"])?$opciones["twitter"]:"");?>">
                </div>
            </div>
        	<div class="col-xs-12 col-md-4">
            	<div class="form-group">
                    <label for="youtube">YouTube</label>
                    <input type="text" class="form-control" id="youtube" name="youtube" placeholder="YouTube" value="<?php echo (isset($opciones["youtube"])?$opciones["youtube"]:"");?>">
                </div>
            </div>
        	<div class="col-xs-12 col-md-4">
            	<div class="form-group">
                    <label for="instagram">Instagram</label>
                    <input type="text" class="form-control" id="instagram" name="instagram" placeholder="Instagram" value="<?php echo (isset($opciones["instagram"])?$opciones["instagram"]:"");?>">
                </div>
            </div>
        	<div class="col-xs-12 col-md-4">
            	<div class="form-group">
                    <label for="pinterest">Pinterest</label>
                    <input type="text" class="form-control" id="pinterest" name="pinterest" placeholder="Pinterest" value="<?php echo (isset($opciones["pinterest"])?$opciones["pinterest"]:"");?>">
                </div>
            </div>
        	<div class="col-xs-12 col-md-4">
            	<div class="form-group">
                    <label for="correo">Correo electrónico</label>
                    <input type="text" class="form-control" id="correo" name="correo" placeholder="Correo electrónico" value="<?php echo (isset($opciones["correo"])?$opciones["correo"]:"");?>">
                </div>
            </div>
        </div>
        <hr>        
    	<div class="row">
	        <div class='wrap'><h2>Logos / Favicon</h2></div>
        	<div class="col-xs-12 col-md-4">
            	<div class="form-group">
                    <label for="logoPrincipal">Logo Principal</label>
                    <input type="text" class="form-control" id="logoPrincipal" name="logoPrincipal" placeholder="Logo Principal" value="<?php echo (isset($opciones["logoPrincipal"])?$opciones["logoPrincipal"]:"");?>">
                    <?php if(!empty($opciones["logoPrincipal"])){?>
                        <div align="center">
                            <img src="<?php echo $opciones["logoPrincipal"];?>" width="auto" height="100">
                        </div>
                    <?php } ?>
                </div>
            </div>
        	<div class="col-xs-12 col-md-4">
            	<div class="form-group">
                    <label for="logoMonocramatico">Logo Monocromático</label>
                    <input type="text" class="form-control" id="logoMonocramatico" name="logoMonocramatico" placeholder="Logo Monocromático" value="<?php echo (isset($opciones["logoMonocramatico"])?$opciones["logoMonocramatico"]:"");?>">
                    <?php if(!empty($opciones["logoMonocramatico"])){?>
                        <div align="center">
                            <img src="<?php echo $opciones["logoMonocramatico"];?>" width="auto" height="100">
                        </div>
                    <?php } ?>
                </div>
            </div>
        	<div class="col-xs-12 col-md-4">
            	<div class="form-group">
                    <label for="favicon">Favicon</label>
                    <input type="text" class="form-control" id="favicon" name="favicon" placeholder="Favicon" value="<?php echo (isset($opciones["favicon"])?$opciones["favicon"]:"");?>">
                    <?php if(!empty($opciones["favicon"])){?>
                        <div align="center">
                            <img src="<?php echo $opciones["favicon"];?>" width="auto" height="100">
                        </div>
                    <?php } ?>
                </div>
            </div>
            <p>Para subir imagenes da clic <a href="/wp-admin/upload.php" target="_blank">aquí</a> y copia el URL resultante que aparece al dar clic en la imagen</p>
        </div>
        <hr>
    	<div class="row">
	        <div class='wrap'><h2>Compartir</h2></div>
        	<div class="col-xs-12 col-md-4">
            	<div class="form-group">
                    <label for="titulo">Título <span title="25 characters">?</span></label>
                    <input type="text" class="form-control" id="titulo" name="titulo" placeholder="Título" value="<?php echo (isset($opciones["titulo"])?$opciones["titulo"]:"");?>">
                    <label for="usuarioTwitter">Usuario Twitter <span title="Sin el @">?</span></label>
                    <input type="text" class="form-control" id="usuarioTwitter" name="usuarioTwitter" placeholder="Usuario Twitter" value="<?php echo (isset($opciones["usuarioTwitter"])?$opciones["usuarioTwitter"]:"");?>">
                </div>
            </div>
        	<div class="col-xs-12 col-md-4">
            	<div class="form-group">
                    <label for="extracto">Extracto <span title="90 characters">?</span></label>
                    <textarea type="text" class="form-control" id="extracto" name="extracto" placeholder="Extracto" style="resize: none;" rows="4"><?php echo (isset($opciones["extracto"])?$opciones["extracto"]:"");?></textarea>
                </div>
            </div>
        	<div class="col-xs-12 col-md-4">
            	<div class="form-group">
                    <label for="imagenDestacada">Imagen Destacada <span title="image ratio: 1.9 : 1 (1200*628)">?</span></label>
                    <input type="text" class="form-control" id="imagenDestacada" name="imagenDestacada" placeholder="Imagen Destacada" value="<?php echo (isset($opciones["imagenDestacada"])?$opciones["imagenDestacada"]:"");?>">
                    <?php if(!empty($opciones["imagenDestacada"])){?>
                        <div align="center">
                            <img src="<?php echo $opciones["imagenDestacada"];?>" width="auto" height="100">
                        </div>
                    <?php } ?>
                </div>
            </div>
        </div><hr>
    	<div class="row">
	        <div class='wrap'><h2>Vídeos</h2></div>
        	<div class="col-xs-12 col-md-4">
            	<div class="form-group">
                    <label for="videoYoutube">Vídeo YouTube<span title="Vídeo YouTube que se muestra en el home">?</span></label>
                    <input type="text" class="form-control" id="videoYoutube" name="videoYoutube" placeholder="Vídeo YouTube" value="<?php echo (isset($opciones["videoYoutube"])?$opciones["videoYoutube"]:"");?>">
                </div>
            </div>
        </div>
        <div class="row">
        	<div class="form-group col-xs-12">
            	<div class="pull-right">
                	<button type="submit" class="btn btn-primary" name="action" value="Guardar">Guardar</button>
                </div>
            </div>
        </div>
    </div>
</form>
<?php
	if($_POST['action'] == "Guardar"){
		?>
        	<script type="text/javascript">
				jQuery(document).ready(function(e) {
                    window.location.href = window.location.href;
                });
			</script>
        <?php
	}
?>
<?php /*?><form method="post" id="ordenar">
    <label style="font-weight:bolder;">*En el shortcode <i>sliders</i> pasar como parametro <code>tipo="1"</code> para clases OWL, <code>tipo="2"</code> para nivoSlider y <code>tipo="3"</code> para que te devuelva un arreglo serializado.</label><br>
	<label>*Dar click en el botón "Aplicar" para que los cambios realizados en el orden se puedan ver reflejados.</label><input name="action" class="button button-primary" type="submit" value="Aplicar" onClick="ordenar_slider();">
</form><?php */?>

<?php /*?><form id="form"  method='post' enctype="multipart/form-data">
    <input type='hidden' name='action' value='insertar'> 
    <table id="editar" class="row">
       	<input type="hidden" name="id" id="id">
        <tr>
            <td>
                <label for='nombre'>URL</label>
            </td>
            <td>
                <input type='text' name='url'  id='url'>
            </td>
        </tr>
        <tr>
            <td>
                <label for='titulo'>Título</label>
            </td>
            <td>
                <textarea type='text' name='titulo'  id='titulo' cols="50" rows="10"></textarea>
            </td>
        </tr>
        <tr>
            <td>
                <label for='subtitulo'>Subtítulo</label>
            </td>
            <td>
                <textarea type='text' name='subtitulo'  id='subtitulo' cols="50" rows="10"></textarea>
            </td>
        </tr>
        <tr class="row_submit">
            <td colspan='2'>
                <input type='submit' name="action" class="button button-primary" value='Actualizar'>
            </td>
        </tr>
    </table>
</form><?php */?>