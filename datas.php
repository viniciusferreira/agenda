<?

// @vini  jan 014 

extract($_GET);
extract($_POST);

 include('datas_inc_topo.php');  $dDiasnapagina = 37; $dDia = 1;

if ($_REQUEST['ano'] <> "")  { $dAno = $_REQUEST['ano'];  }  else  {  $dAno = date("Y");  } 

include('datas_inc_tabelanotopo.php');

print "  <input   type='hidden'   name='dAno'   value='$dAno' >";	 

for ($mC=1;$mC<=12;$mC++) 
{///
	
$DTatual = mktime(0,0,0,$mC,$dDia,$dAno);//h.mi.sec.mes.dia.ano//ret o timestamp... //dDia é 1 que é onde inicia o mês...

print "<tr> <td class='classe_nomemes'> <div>";  

include('datas_inc_switch_mes.php');

$dias_no_mes = date("t",$DTatual);

echo Insere_td_embranco(Dia_da_semana(date("w",$DTatual))-1);

			for ($i=1;$i<=$dias_no_mes;$i++) {
			$DTexata = mktime(0,0,0,$mC,$i,$dAno);// o  $mc=mes ... $i=dia ... 
			
			// aqui apenas pra setar uma classe diferente pra se o dia é hoje
			($i==date("d")&&date("m",$DTatual)==date("m"))   ?    $classe="diaatual"   :   $classe="" ; 
			
			(isset($cod) && trim($cod)!='') ? $quercod2live=" AND codigo=$cod " : '' ;
			
			$r = mysql_query(" SELECT id FROM inter_aagenda WHERE dia='$i' AND mes='".date("m",$DTatual)."' $quercod2live");
						
            ($row = mysql_fetch_array($r, MYSQL_ASSOC) ) ?  $check=' checked=checked ' : $check='' ; 
			
			// o $i é o dia do mes que ta no loop ... 
			echo "<td class='".$classe." cdias cdia".Dia_da_semana(date("w",$DTexata)).
			"'>"    .    $i   .   "    <br> 
			<input type='checkbox' $check name='" . $i ."_". date("m",$DTatual) . "' >   </td> "   ;
			}
	
  echo Insere_td_embranco( $dDiasnapagina - $dias_no_mes - Dia_da_semana(date("w",$DTatual))+1 );
	
  echo "</tr>"; 

}/// final do for ... ($mC=1;$mC<=12;$mC++) ?>  </table>
 
<input type="text" name="nomemodelo" width="180" style="background-color:#CCC; width:300px"  /> 

<input name="" type="submit" value="INSERIR NOVO MODELO " /> 
 
</form>  <form name="jump"> <p align="center">

       <select name="modelo"> <?     
			  
	   $q = mysql_query("   SELECT DISTINCT  `nome`, codigo     FROM  `inter_aagenda` WHERE tipo =  'm' AND codigo=1 ");

       while ($r = mysql_fetch_array($q, MYSQL_ASSOC) )
		  {		      
 print "
 <option value='datas.php?cod=$r[codigo]'> LIMPAR </option> 
 ";  
	   }  ?> </select>
              
	<input type="button" 
              
	onClick="location=document.jump.modelo.options[document.jump.modelo.selectedIndex].value;" 
              
    value=" L I M P A R  "> </form>
    
      
    
    
      </p> 
      <p>
      
     <form name="jumpp"> <p align="center">

       <select name="modeloo"> <?     
			  
	   $q = mysql_query("   SELECT DISTINCT  `nome`, codigo     FROM  `inter_aagenda` WHERE tipo =  'm' ORDER BY NOME ");

       while ($r = mysql_fetch_array($q, MYSQL_ASSOC) )
		  {		      
			  print "<option value='datass.php?cod=$r[codigo]'> $r[nome] </option> ";  
	   }  ?> </select>
              
	<input type="button" 
              
	onClick="location=document.jumpp.modeloo.options[document.jumpp.modeloo.selectedIndex].value;" 
              
    value="carregar modelo como feriados"> </form> 
      
      
      
      
      
      
 <form name="jumppp"> <p align="center">

 <select name="modelooo"> <?     
			  
 $q = mysql_query("   SELECT DISTINCT  `nome`, codigo     FROM  `inter_aagenda` WHERE tipo =  'm'   ORDER BY NOME ");

 while ($r = mysql_fetch_array($q, MYSQL_ASSOC) )
 {		      
 print "<option value='datasss.php?cod=$r[codigo]'> $r[nome] </option> ";  
 }  ?> </select>
              
 <input type="button" 
              
 onClick="location=document.jumppp.modelooo.options[document.jumppp.modelooo.selectedIndex].value;" 
              
 value="excluir modelo"> </form>
      
      
      
      
      
      
      
      
      


<form name="jumpppp" action="datassss.php" method="get"> <p align="center">

       <select name="cod"> <?     
			  
	   $q = mysql_query("   SELECT DISTINCT  `nome`, codigo     FROM  `inter_aagenda` WHERE tipo =  'm'   ORDER BY NOME ");

       while ($r = mysql_fetch_array($q, MYSQL_ASSOC) )
		  {		      
			  print "<option value='$r[codigo]'> $r[nome] </option> ";  
	   }  ?> </select>
       
       
 <input type="text" name="novonomemod" width="150" style="background-color:#CCC; width:150px"  />
              
 <input type="submit"  value="EDITAR  MODELO"> </form>




      
      
      
      
      
      
      
      
      
      
      
      
  </p>   
      </body> </html> <?		
			  			   
 function Insere_td_embranco($numero_td_adicionar)  
 {
 for($i=1;$i<=$numero_td_adicionar;$i++) 
 {
 $tdString .= "<td></td>";
 }
 return $tdString;
 }  

function Dia_da_semana($Numdia) {// // converte o domingo pra sete 7 
if ($Numdia == 0) 	{ return 7; }  	else  	{ return $Numdia; }  }// ?>
