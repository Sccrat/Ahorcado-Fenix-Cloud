<?php 
  session_start();
	//ini_set("session.cookie_lifetime","10800");
	//ini_set("session.gc_maxlifetime","10800");
	error_reporting(0);
	include('Conexion.php');

?>

<!DOCTYPE HTML>
<html>
<head>
<title></title>
<link href="bootstrap.css?<?php echo time(); ?>" rel='stylesheet' type='text/css' />
 <script type="text/javascript" src="jQuery-2.1.4.min.js?<?php echo time(); ?>"></script>
<script type="text/javascript" src="pruebajs.js?<?php echo time(); ?>"></script>
<script type="text/javascript" src="alertify.js?<?php echo time(); ?>"></script>
<link href="alertify.css?<?php echo time(); ?>" rel='stylesheet' type='text/css' />
<div class="col-md-3">
<select class="form-control" id="categoria">
        <option value="">-Seleccione-</option>
        <?php
							$con = mysqli_query($conectar,"select * from categorias  order by cat_nombre");
							$num = mysqli_num_rows($con);
							for($i = 0; $i < $num; $i++)
							{
								$dato = mysqli_fetch_array($con);
								$clave = $dato['cat_clave_int'];
								$categoria = $dato['cat_nombre'];
						?>
        <option value="<?php echo $clave; ?>"><?php echo $categoria; ?></option>
        <?php
							}
						?>
      </select>
    </div>
<div class="col-md-1">
<a class="btn btn-block btn-primary  btn-md" onClick="INICIAR('')" ><i class="glyphicon glyphicon-plus-sign"></i>&nbsp;Iniciar</a>
</div>
<div class="col-md-6" style="display:none">
<?php 

$letras=array();
			
				$cons=mysqli_query($conectar,"select * from letraseleccionadas where  les_estado='1'");
				$nums=mysqli_num_rows($cons); ?>
				<span style="font-size:24px">Letras erroneas:</span>
                <?php
				for($s=0;$s<$nums;$s++)
				{
					$datos=mysqli_fetch_array($cons);
					$letra=trim($datos['les_letra']);
					$letras[]=$letra; 
					?>
					<span style="font-size:24px"><?php print_r($letras[$s]);?></span>
                    
		<?php }
				
?>


</div>
<div class="col-md-12" id="divpalabra"></div>
<div class="col-md-12" id="divahorcado"></div>