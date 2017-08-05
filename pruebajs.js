// JavaScript Document
function ok(msn)
	{
		alertify.success('<i class="icon fa fa-check"></i>Alerta!<br><strong>'+msn+'</strong>'); 
		return false;
	}
	function error(msn)
	{  
		alertify.error('<i class="icon fa fa-ban"></i>Alerta!<br><strong>'+msn+'</strong>'); 
		return false; 
	}
function INICIAR(idps)
{
	var cat = $('#categoria').val();
	
	if(cat=="")
	{
		//error;
	}
	else
	{
	 $.post('funciones.php',{opcion:'INICIAR',cat:cat,idps:idps},
	 function(data)
	 {
		 $('#divpalabra').html(data);
	 });
	}
}
function INICIAR2()
{
	
	if(le!="" && le!=null){
		INICIAR(le);
		}
}
function AHORCADO(a)
{
	 
	 
	 var idps=a;
	
	 $.post('funciones.php',{opcion:'AHORCADO',idps:idps},
	 function(data)
	 {
		 $('#divahorcado').html(data);
	 });
}

function CALIFICAR(idps)
{
	var let = $('#letra').val();
	if(let!="")
    {
	   $.post('funciones.php',{opcion:"CALIFICAR",lets:let,idps:idps},
	   function(data)
	   {
		   var res = data[0].res;
		   var msn = data[0].msn;
		   if(res=="ok"){
			     ok(msn); 
				 setTimeout(INICIAR(idps),1000); 
				 
			 }
			 else if(res=="ok1")
			 {
		        ok(msn);
				setTimeout(INICIAR(idps),1000);
			 }
			 else if(res=='error2')
			 {
			   error(msn);	 
			   setTimeout(AHORCADO(idps),1000);
		     }
			 else if(res=="error3")
			 {
				 error(msn);
			 }
			 else if(res=='error1')
			 {
				error(msn);	 
			   setTimeout(AHORCADO(idps),1000);
			 }
	   },"json");
    }
}