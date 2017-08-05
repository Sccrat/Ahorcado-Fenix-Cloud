<?php
	session_start();
	//ini_set("session.cookie_lifetime","10800");
	//ini_set("session.gc_maxlifetime","10800");
	error_reporting(0);
	include('Conexion.php');
	
$opcion = $_POST['opcion'];
if($opcion=="INICIAR")
{
	$cat  = $_POST['cat'];
	$idps = $_POST['idps'];	//verificacion
	if($idps>0)
	{
		$conp = mysqli_query($conectar, "select pal_nombre from palabraseleccionada ps JOIN palabras p on p.pal_clave_int = ps.pal_clave_int where ps.pas_clave_int = '".$idps."'");
	$datp = mysqli_fetch_array($conp);
	$palabra = $datp['pal_nombre'];
	
	}
	else
	{
	$con = mysqli_query($conectar, "select ps.pas_clave_int,p.pal_nombre from palabraseleccionada ps join palabras p on p.pal_clave_int = ps.pal_clave_int where cat_clave_int = '".$cat."' and pas_estado = 0");
	$num = mysqli_num_rows($con);
	if($num>0)
	{
		$dat = mysqli_fetch_array($con);
		$idps = $dat['pas_clave_int'];
		$palabra = $dat['pal_nombre'];
		
	}
	else
	{
		$conr = mysqli_query($conectar, "select pal_clave_int, pal_nombre from palabras where cat_clave_int = '".$cat."' and pal_clave_int not in(select p.pal_clave_int from palabraseleccionada ps join palabras p on p.pal_clave_int = ps.pal_clave_int where cat_clave_int = '".$cat."') order by RAND() limit 1");
		$datr = mysqli_fetch_array($conr);
		$idp = $datr['pal_clave_int'];
		$palabra = $datr['pal_nombre'];
		
		$insp = mysqli_query($conectar,"INSERT INTO palabraseleccionada (pal_clave_int) VALUES('".$idp."')");
		$idps = mysqli_insert_id($conectar);		
	}
}
	if($palabra!="")
				{
	?>
			<table width="100%" cellpadding="2" cellspacing="2">
            <tr>
                <?php
				
				
				$letras=array();
			
				$cons=mysqli_query($conectar,"select * from letraseleccionadas where pas_clave_int='".$idps."' and les_estado='0'");
				$nums=mysqli_num_rows($cons);
				for($s=0;$s<$nums;$s++)
				{
					$datos=mysqli_fetch_array($cons);
					$letra=trim($datos['les_letra']);
					$letras[]=$letra;
				}
				
               
               

                $len = strlen($palabra);
                //CONSTRA
                
               
                   
                 for ($k = 0; $k < $len; $k++) 
				 {
                    $let = substr($palabra, $k, 1);
                    
						 if ($let == "" || $let == NULL || $let == " ") 
						 {
							?>
							<td style="padding:10px;width: 20px"></td>
							<?php
						 }
						 else
						 {            
							?>
							<td style="padding:10px;width: 20px">
							<?php  if (count($letras)>0 and $idps>0 ) 
								   {
								   //es correto no hace ninguna actualizacion solo imprime
										if(in_array(trim(strtoupper($let)),$letras)) 
										{	
											echo trim(strtoupper($let)); 								
										}
								   }  ?><br>__
							</td>
							<?php
						 }                   
               	 }
				
				echo "<style onload=AHORCADO('".$idps."')></style>";				
        	?>
        <td>
        <select class="form-control" id="letra" onchange="CALIFICAR('<?php echo $idps;?>')">
                <option>--seleccione--</option>
                <?php
                for($k=65;$k<91;$k++)
                {
                    $let = chr($k);
                    ?>
                    <option value="<?php echo $let;?>"><?php echo $let;?></option>
                <?php
                }
                ?>
            </select>
            </td>
    </tr>
</table>
<div>

</div>
<?php
				}
}
else if($opcion=="AHORCADO")
{
$idps = $_POST['idps'];
$cone = mysqli_query($conectar, "select * from letraseleccionadas where pas_clave_int = '".$idps."' and les_estado = 1");
$error = mysqli_num_rows($cone);//
?>
<div>
<span style="position:absolute<?php if($error>0){}else{ echo ';display:none';}?>" id="imagen1" ><img src="5.jpg"></span>
<span style="position:absolute<?php if($error>1){}else{ echo ';display:none';}?>" id="imagen2"><img src="6.jpg"></span>
<span style="position:absolute<?php if($error>2){}else{ echo ';display:none';}?>" id="imagen3"><img src="7.jpg"></span>
<span  style="position:absolute<?php if($error>3){}else{ echo ';display:none';}?>" id="imagen4"><img src="8.jpg"></span>
<span style="position:absolute<?php if($error>4){}else{ echo ';display:none';}?>"id="imagen5"><img src="9.jpg"></span>
<span style="position:absolute<?php if($error>5){}else{ echo ';display:none';}?>"id="imagen6"><img src="10.jpg"></span>
</div>
<?php

                
}
else if($opcion=="CALIFICAR")
{
   $lets = $_POST['lets'];
   $idps = $_POST['idps'];
   $sel=0;
	$consultar=mysqli_query($conectar,"select * from letraseleccionadas where pas_clave_int='".$idps."' and les_letra='".strtoupper($lets)."'");
	$nums=mysqli_num_rows($consultar);
	if($nums>0)
	{
		$dat = mysqli_fetch_array($con);
		$idl= $dat['les_clave_int'];
		$sel=1;
	}else
	{
		$insl = mysqli_query($conectar, "INSERT INTO letraseleccionadas (pas_clave_int,les_letra) VALUES('".$idps."','".strtoupper($lets)."')");
		$idl = mysqli_insert_id($conectar);
	}
	//selecccionar la plabra
	$conp = mysqli_query($conectar, "select pal_nombre from palabraseleccionada ps JOIN palabras p on p.pal_clave_int = ps.pal_clave_int where ps.pas_clave_int = '".$idps."'");
	$datp = mysqli_fetch_array($conp);
	$palabra = $datp['pal_nombre'];
	$aciertos = 0;
	$espacio = 0;
	 $len = strlen($palabra);
                //CONSTRA                   
	 for ($k = 0; $k < $len; $k++) 
	 {
		 $let = substr($palabra, $k, 1);
		 if ($let == "" || $let == NULL || $let == " "){$espacio++;}
		$lets = trim(strtoupper($lets));
		$let = trim(strtoupper($let));
		if( $let == $lets)
		{
			$aciertos++;
	    }
	 }
	 if($sel==1)
	 {
		 $res='error3';
		 $msn="LA LETRA YA FUE SELECCIONADA";
	 }
	 else
	 if($aciertos>0)
	 {
		$cone = mysqli_query($conectar, "UPDATE letraseleccionadas SET les_aciertos ='".$aciertos."' where les_clave_int = '".$idl."'");
		$conerrores = mysqli_query($conectar, "select * from letraseleccionadas where pas_clave_int = '".$idps."' and les_estado = 1");
		$error2 = mysqli_num_rows($conerrores);//
		
		$conpositivo = mysqli_query($conectar, "select sum(les_aciertos) as correctos from letraseleccionadas where pas_clave_int = '".$idps."' and les_estado = 0");
		$correctas = mysqli_num_rows($conpositivo);//
		$dato=mysqli_fetch_array($conpositivo);
		$correcto=$dato['correctos'];
		$positivo = $correcto + $espacio;
		if($error2>=6)
		{
		  $updp = mysqli_query($conectar, "UPDATE palabraseleccionada set pas_estado = 2 where pas_clave_int = '".$idps."'");
		  $res = "error1";
		  $msn = "PERDISTE";//llamar ahorcado
		}
		else if($positivo==$len)
		{
		  $updp = mysqli_query($conectar, "UPDATE palabraseleccionada set pas_estado = 1 where pas_clave_int = '".$idps."'");
		  $res = "ok1";
		  $msn = "GANASTE";
		}
		else
		{
		 $res = "ok";
		 $msn = "Encontro letra(s)";//si llama iniciar
		}
     }
	 else
	 {
	    $cone = mysqli_query($conectar, "UPDATE letraseleccionadas SET les_estado ='1',les_aciertos = '0' where les_clave_int = '".$idl."'"); 
		$conerrores = mysqli_query($conectar, "select * from letraseleccionadas where pas_clave_int = '".$idps."' and les_estado = 1");
		$error2 = mysqli_num_rows($conerrores);//
		
		$conpositivo = mysqli_query($conectar, "select sum(les_aciertos) as correctos from letraseleccionadas where pas_clave_int = '".$idps."' and les_estado = 0");
		$correctas = mysqli_num_rows($conpositivo);//
		$dato=mysqli_fetch_array($conpositivo);
		$correcto=$dato['correctos'];
		$positivo = $correcto + $espacio;
		if($error2>=6)
		{
		  $updp = mysqli_query($conectar, "UPDATE palabraseleccionada set pas_estado = 2 where pas_clave_int = '".$idps."'");
		  $res = "error1";
		  $msn = "PERDISTE";//llamar ahorcado
		}
		else if($positivo==$len)
		{
		  $updp = mysqli_query($conectar, "UPDATE palabraseleccionada set pas_estado = 1 where pas_clave_int = '".$idps."'");
		  $res = "ok1";
		  $msn = "GANASTE";
		}
		else
		{
		  $res = "error2";
		  $msn = "NO SE ENCONTRO";//llama a ahorcado
		}
		
	 }
	 $datoss[] = array("res"=>$res,"msn"=>$msn,"aciertos"=>$aciertos);
	 echo json_encode($datoss);
}
?>
