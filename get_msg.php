<?php
	if(isset($_GET['c'])||isset($_GET['u'])||isset($_GET['r'])){
		if(isset($_GET['c'])){
			$img = 'graciasim.jpg';
			//$msj = '¡Gracias por enviar tu mensaje, nos pondremos en contacto!';
		}
		if(isset($_GET['u'])){
			$img = 'nombre2.jpg';
			//$msj = '¡Gracias por unirte a nuestro equipo!';
		}
		if(isset($_GET['r'])){
			$img = 'graciasreg.jpg';
			//$msj = '¡Gracias por registrarte en nuestra página pronto se enviara un correo para confirmación!';
		}
?>
<script>
	$( document ).ready(function() {
		$('#gracias').modal('show')
	});
</script>
<?php
	}
?>

<div id="gracias" class="modal fade" role="dialog" aria-labelledby="gridSystemModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <?php /*?><h4 class="modal-title" id="gridSystemModalLabel"><?php echo $msj; ?></h4><?php */?>
        </div>
        
        <div class="modal-body">
          <?php if(isset($img)){?>
          <div class="container-fluid">
            	<img src="<?php echo get_bloginfo('stylesheet_directory'); ?>/images/<?php echo $img; ?>" width="100%"/>
          </div>
		  <?php } ?>
          <?php if(isset($msj)){?>
           <div class="container-fluid">
            	<div class="row">
                	<div class="col-xs-12">
                    	<p><?php echo $msj; ?></p>
                    </div>
                </div>
          </div>
		  <?php } ?>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
        </div>
      </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<style type="text/css">
	.modal-dialog{
		top: 119px;
		z-index: 1051;
	}
</style>