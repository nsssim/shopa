<!DOCTYPE html>
<html lang="en">
<head>

<?php  $this->load->helper('url');   ?>
<?php  $CI =& get_instance();  ?>
<?php  $CURRENCY = "$"; ?>
<?php  $this->load->helper('url'); ?>

</head><!--/head-->


<HTML>
	<BODY> 
		<form action="https://www.eprocessingnetwork.com/cgi-bin/tdbe/transact.pl" method=post> 
			<table> 
			  	<TR>  <TD>ePNAccount:</TD> 
			      <!--<TD><input type=text name="ePNAccount" value="080880"></TD> -->
			      <TD><input type=text name="ePNAccount" value="1115570"></TD> 
			  	</TR> 
			  	
			  	<TR>  <TD>CardNo:</TD> 
			      <TD><input type=text name="CardNo" value="4111111111111111"></TD> 
			  	</TR> 
			  	
			  	<TR>  <TD>ExpMonth:</TD> 
			      <TD><input type=text name="ExpMonth" value="12"></TD> 
			 	</TR> 
			  	
			  	<TR>  <TD>ExpYear:</TD> 
			      <TD><input type=text name="ExpYear" value="09"></TD> 
				</TR> 
			  	
			  	<TR>  <TD>Total:</TD> 
			      <TD><input type=text name="Total" value="12.34"></TD> 
				</TR> 
			  	
			  	<TR>  <TD>Address:</TD> 
			      <TD><input  type=text  name="Address"  value="123  Fake  St."></TD>
			    </TR> 
			  	
			  	<TR>  <TD>Zip:</TD> 
			      <TD><input type=text name="Zip" value="12345"></TD> 
				</TR> 
			  	
			  	<TR>  <TD>EMail :</TD> 
			      <TD><input type=text name="EMail" value="email@address.com"></TD>   
			    </TR> 
			  	
			  	<TR>  <TD>CVV2Type:</TD> 
			      <TD><input type=text name="CVV2Type" value="1"></TD> 
				</TR> 
			  	
			  	<TR>  <TD>CVV2:</TD> 
			      <TD><input type=text name="CVV2" value="123"></TD> 
				</TR> 
			   
			   <TR>  <TD>RestrictKey:</TD> 
			      <!--<TD><input type=text name="RestrictKey"   value="yFqqXJh9Pqnugfr"></TD> -->
			      <TD><input type=text name="RestrictKey"   value="EDYAAGmnvu26btRE"></TD> 
			  	</TR> 
				
				<TR> 
			      <TD>TranType:</TD> 
			      <TD><input type=text name="TranType" value="Sale"></TD> 
			  	</TR> 
			  	
			  	<TR>  <TD>Submit:</TD> 
			      <TD><input type=submit name="submit" value="Submit"></TD> 
			 	</TR> 
			</table> 
		</form> 
	</BODY> 
</HTML> 
