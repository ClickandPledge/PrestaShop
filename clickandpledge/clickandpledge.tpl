{*
* 2007-2011 PrestaShop
*
* NOTICE OF LICENSE
*
* This source file is subject to the Academic Free License (AFL 3.0)
* that is bundled with this package in the file LICENSE.txt.
* It is also available through the world-wide-web at this URL:
* http://opensource.org/licenses/afl-3.0.php
* If you did not receive a copy of the license and are unable to
* obtain it through the world-wide-web, please send an email
* to license@prestashop.com so we can send you a copy immediately.
*
* DISCLAIMER
*
* Do not edit or add to this file if you wish to upgrade PrestaShop to newer
* versions in the future. If you wish to customize PrestaShop for your
* needs please refer to http://www.prestashop.com for more information.
*
*  @author PrestaShop SA <contact@prestashop.com>
*  @copyright  2007-2011 PrestaShop SA
*  @version  Release: $Revision: 6594 $
*  @license    http://opensource.org/licenses/afl-3.0.php  Academic Free License (AFL 3.0)
*  International Registered Trademark & Property of PrestaShop SA
*}
<link rel="shortcut icon" type="image/x-icon" href="{$module_dir}secure.png" />
<link href="{$module_dir}css/custom.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="{$module_dir}new_js.js"></script>
<style type="text/css">
{literal}
.required {color:#FF0000;}
h3{display:inline;}
{/literal}
</style>
<script type="text/javascript">
var mess_error = "{l s='Your card number is false' mod='clickandpledge' js=1}";
var urls = "{$module_dir}clickandpledgeview.php";
var mod_url = "{$module_dir}";
var recurring = '';
var recurring_installment = '';
var recurring_subscription = '';
var indefinite = '';
var	recurring_units_week = '';
var	recurring_units_week2 = "";
var	recurring_units_month = "";
var	recurring_units_month2 = "";
var	recurring_units_quarter = "";
var	recurring_units_month6 = "";
var	recurring_units_year = "";
</script>
<p class="payment_module" >

	{if $isFailed == 1}
	<p style="color: red;">
			{if !empty($smarty.get.message)}
				{l s='Error,' mod='clickandpledge'}{$smarty.get.message|htmlentities}
			{else}
				{l s='Error, please verify the card information' mod='clickandpledge'}
			{/if}
		</p>
	{/if}

{if $cart->product.reduction}
<span id="old_price_display" style="text-decoration:line-through;">{convertPrice price=$cart->product.price_without_reduction}</span>
{/if}
	<form id="aut" name="cnp_form" action="{$module_dir}validation.php" method="post">
            <span style="border: 1px solid #595A5E; background-color:#fff;display: block;padding: 0.6em;text-decoration: none;"> 
<!--			<a id="clicknpledge" href="#" title="{l s='Pay with Click and Pledge' mod='clickandpledge'}" style="display: block;text-decoration: none;">-->		
		<div class="cp_logo"><img src="{$module_dir}CP-Secured.jpg" alt="secure payment"/></div>
			<!--	{l s='Secured credit card payment with Click and Pledge API' mod='clickandpledge'} -->
				
<!--			</a>-->		
				<div id="aut2">
			{if $cards|@count > 1}
			<div id="payment_methods">
			 
			{foreach from=$cards  key=k item=foo}
			{if $k == $defalut_payment}
			<input type="radio" value="{$k}" name="payment_methods" id="{$k}" checked="checked" />&nbsp; <label for="{$k}"><span></span><b>{$foo} </b></label>
			<script type="text/javascript">
			var defalut_method = "{$k}";
			{literal}
			setTimeout("defalut(defalut_method)",20);
			{/literal}
			</script>
			{else}
			<input type="radio" value="{$k}" name="payment_methods" id="{$k}" />&nbsp; <label for="{$k}"><span></span><b>{$foo} </b></label>
			{/if}
			{/foreach}
			</div>
			{else}
			
			{foreach from=$cards  key=k item=foo}
			<input type="hidden" value="{$k}" name="payment_methods" id="new_payment_methods" />
			{/foreach}
			<script type="text/javascript">
			var defalut_method = document.getElementById('new_payment_methods').value;
			recurring = "{$recurring}";
			recurring_installment = "{$recurring_method.installment}";
			recurring_subscription = "{$recurring_method.subscription}";
			indefinite = "{$indefinite}";
			recurring_units_week ="{$recurring_units.Week}";
			recurring_units_week2 ="{$recurring_units.Weeks2}";
			recurring_units_month ="{$recurring_units.Month}";
			recurring_units_month2 ="{$recurring_units.Months2}";
			recurring_units_quarter ="{$recurring_units.Quarter}";
			recurring_units_month6 ="{$recurring_units.Months6}";
			recurring_units_year ="{$recurring_units.Year}";
			{literal}
			setTimeout("defalut(defalut_method)",20);
			{/literal}
			</script>
			{/if}
			
			
			{foreach from=$p key=k item=v}
				<input type="hidden" name="{$k|escape}" value="{$v|escape}" />
			{/foreach} 
			
			{* payment_methods_display info *}
			<div id="loading" style="display:none">
			<img src="{$module_dir}loading.gif"  alt="loading" />
			</div>
			<div id="payment_methods_display">
			
			</div>

			</div>
		</span>
	</form>
</p>
<script type="text/javascript">
{literal}
function defalut(method)
{
$.ajax({
	  url: urls,
	  type: "post",
	  data: {payment_methods:method,mod_url:mod_url,recurring:recurring,recurring_installment:recurring_installment,recurring_subscription:recurring_subscription,indefinite:indefinite,recurring_units_week:recurring_units_week,recurring_units_week2:recurring_units_week2,recurring_units_month:recurring_units_month,recurring_units_month2:recurring_units_month2,recurring_units_quarter:recurring_units_quarter,recurring_units_month6:recurring_units_month6,recurring_units_year:recurring_units_year},
	  success: function(mess){
		   $("#payment_methods_display").html(mess);
	  },
	  error:function(){
		  $("#payment_methods_display").html('there is error while submit');
	  }   
	});
}
{/literal}
var loading_gif = "{$module_dir}loading.gif";
recurring = "{$recurring}";
recurring_installment = "{$recurring_method.installment}";
recurring_subscription = "{$recurring_method.subscription}";
indefinite = "{$indefinite}";
recurring_units_week ="{$recurring_units.Week}";
recurring_units_week2 ="{$recurring_units.Weeks2}";
recurring_units_month ="{$recurring_units.Month}";
recurring_units_month2 ="{$recurring_units.Months2}";
recurring_units_quarter ="{$recurring_units.Quarter}";
recurring_units_month6 ="{$recurring_units.Months6}";
recurring_units_year ="{$recurring_units.Year}";
	{literal}
	function credit_card_valid()
	{
				var name = document.cnp_form.name.value.trim();
	var reg_cardtype =/^(?:4[0-9]{12}(?:[0-9]{3})?|5[1-5][0-9]{14}|6(?:011|5[0-9][0-9])[0-9]{12}|3[47][0-9]{13}|3(?:0[0-5]|[68][0-9])[0-9]{11}|(?:2131|1800|35\d{3})\d{11})+$/; 
	            var numb = document.cnp_form.ccn.value;
	            var mo = document.cnp_form.x_exp_date_m.value;
	            var yr = document.cnp_form.x_exp_date_y.value;
	            var cv = document.cnp_form.x_card_code.value;
	            var check=new Date();
                var c_mo=(check.getMonth()+1);
                var c_ye=(check.getFullYear() + '').substring(2, 4);
				var myElem = document.getElementById('myElementId');
			if(myElem != null)
			{	
				if(document.cnp_form.is_recurring[1].checked)
				{
					if(document.getElementById("times").style.display != 'none')
					{
						if(document.cnp_form.number_of_times.value.trim() == '')
						{
						alert("Please Enter Valid Number Of Recurrings");
						document.cnp_form.number_of_times.focus();
						return false;
						}
						if(document.cnp_form.number_of_times.value <= 1)
						{
						alert("Please Enter the Installments Morethan 1");
						document.cnp_form.number_of_times.focus();
						return false;
						}
						if(/[^0-9]/.test(document.cnp_form.number_of_times.value)){
						alert("Please Enter Numbers Only");
						document.cnp_form.number_of_times.focus();
						return false;
						}
						if(document.getElementsByName('recurring_method').length >= 2)
						{
					if(document.cnp_form.recurring_method[0].value == 'Installment' && document.cnp_form.number_of_times.value > 998 && document.cnp_form.recurring_method[0].checked)
							{
							alert("Max Installments should be maximum 998");
							document.cnp_form.number_of_times.focus();
							return false;
							}
						}
						else if(document.cnp_form.recurring_method.value == 'Installment' && document.cnp_form.number_of_times.value > 998 && document.cnp_form.recurring_method.checked)				{
						alert("Max Installments should be maximum 998");
						document.cnp_form.number_of_times.focus();
						return false;
						}
					}				
				}
			 }	
				if(name=="" )
				{
					 alert("Please Enter The Name on the Card !");
					 document.cnp_form.name.focus();
					 return false;
				}else if(/[^a-zA-Z0-9\.\,\#\&\-\ \']/.test(name)){
					  alert("Please enter only Alphanumerics,. and space");
					  document.cnp_form.name.focus();
					  return false;
				}else if(!reg_cardtype.test(numb)){
					  alert("Please Enter The Valid Card Number !");
					 document.cnp_form.ccn.focus();
					  return false;
				}else if(yr < c_ye){
					 alert("Please Select Valid Year");
					 return false;					
				}else if(mo < c_mo && yr == c_ye){	
					 alert("Please Select Valid Month");
					 return false;
				}else if(cv.length < 3 || cv.length > 4){				
					alert("Please Enter The Valid CVV Number !");
					document.cnp_form.x_card_code.focus();		
					return false;					
				}else if(/[^0-9]/.test(cv)){
					  alert("Please Enter The Numbers Only");
					  document.cnp_form.x_card_code.focus();
					  return false;
				}	
				else{					
				document.cnp_form.submit();
					$('#divMsg').html('<b style="color:green">please wait..</b> <img src="'+loading_gif+'" alt="loading" />');
				}
			}
	
	function echeck_valid()
		{
				var reg_installments =/^([0-9])+$/; 
				var reg_cardname=/^([a-zA-Z0-9\.\,\#\-\'\ ])+$/; 

				var RoutingNumber = document.cnp_form.RoutingNumber.value;
	            var CheckNumber = document.cnp_form.CheckNumber.value;
	            var AccountNumber = document.cnp_form.AccountNumber.value;
				var RetypeAccountNumber = document.cnp_form.RetypeAccountNumber.value;
				var NameOnAccount = document.cnp_form.NameOnAccount.value.trim();
				
				var myElem = document.getElementById('myElementId');
			if(myElem != null)
			{	
				if(document.cnp_form.is_recurring[1].checked)
				{
					if(document.getElementById("times").style.display != 'none')
					{
						if(document.cnp_form.number_of_times.value.trim() == '')
						{
						alert("Please Enter Valid Number Of Recurrings");
						document.cnp_form.number_of_times.focus();
						return false;
						}
						if(document.cnp_form.number_of_times.value <= 1)
						{
						alert("Please Enter the Installments Morethan 1");
						document.cnp_form.number_of_times.focus();
						return false;
						}
						if(/[^0-9]/.test(document.cnp_form.number_of_times.value)){
						alert("Please Enter Numbers Only");
						document.cnp_form.number_of_times.focus();
						return false;
						}
					if(document.getElementsByName('recurring_method').length >= 2)
						{
					if(document.cnp_form.recurring_method[0].value == 'Installment' && document.cnp_form.number_of_times.value > 998 && document.cnp_form.recurring_method[0].checked)
							{
							alert("Max Installments should be maximum 998");
							document.cnp_form.number_of_times.focus();
							return false;
							}
						}
						else if(document.cnp_form.recurring_method.value == 'Installment' && document.cnp_form.number_of_times.value > 998 && document.cnp_form.recurring_method.checked)				{
						alert("Max Installments should be maximum 998");
						document.cnp_form.number_of_times.focus();
						return false;
						}
					}				
				}
			 }	
				
				if(!reg_installments.test(RoutingNumber))
				{
					  alert("Please Enter Valid Routing Number");
					  document.cnp_form.RoutingNumber.focus();
					  return false;
				}
				else if(RoutingNumber.length < 9 || RoutingNumber.length > 9)
				{
					  alert("Routing Number Must contain 9 digits");
					  document.cnp_form.RoutingNumber.focus();
					  return false;
				}
				else if(!reg_installments.test(CheckNumber))
				{
					  alert("Please Enter Valid CheckNumber");
					 document.cnp_form.CheckNumber.focus();
					 return false;
				}
				
				else if(CheckNumber.length > 10)
				{
					  alert("Check Number Allows Maximum 10 digits");
					  document.cnp_form.CheckNumber.focus();
					  return false;
				}
			
				else if(!reg_installments.test(AccountNumber))
				{
					  alert("Please Enter Valid Account Number");
					  $("#AccountNumber").focus();
					  return false;
				}
				
				else if(AccountNumber.length > 17)
				{
					  alert("Account Number should be less than 17 digits");
					  document.cnp_form.AccountNumber.focus();
					  return false;
				}
				
				else if(AccountNumber != RetypeAccountNumber)
				{
					  alert("Account Number and Retype Account Number Must be same");
					  document.cnp_form.RetypeAccountNumber.focus();
					  return false;
				}
			
				else if(!reg_cardname.test(NameOnAccount))
				{
					  alert("Please enter only Alphanumerics,. and space");
					  document.cnp_form.NameOnAccount.focus();
					  return false;
				}else
				{
					document.cnp_form.submit();
					$('#divMsg').html('<b style="color:green">please wait..</b> <img src="'+loading_gif+'" alt="loading" />');
				}
		
		}		
		
		function invoice_valid()
			{
				var reg_installments =/^([0-9])+$/; 
				var InvoiceCheckNumber = document.cnp_form.InvoiceCheckNumber.value;
				
				if(!reg_installments.test(InvoiceCheckNumber))
				{
					  alert("Please Enter valid Invoice Check Number");
					  document.cnp_form.InvoiceCheckNumber.focus();
					  return false;
				}
				
				else if(InvoiceCheckNumber.length > 50)
				{
					  alert("Invoice Check Number should be less than 50 digits");
					  document.cnp_form.InvoiceCheckNumber.focus();
					  return false;
				}
				
				else
				{
					document.cnp_form.submit();
					$('#divMsg').html('<b style="color:green">please wait..</b> <img src="'+loading_gif+'" alt="loading" />');
				}
			
			}	
		function purchaseorder_valid()
			{
				var reg_installments =/^([0-9])+$/; 
				var PurchaseOrderNumber = document.cnp_form.PurchaseOrderNumber.value;
				
				if(!reg_installments.test(PurchaseOrderNumber))
				{
					  alert("Please Enter valid Purchase Order Number");
					  document.cnp_form.PurchaseOrderNumber.focus();
					  return false;
				}
				
				else if(PurchaseOrderNumber.length > 50)
				{
					  alert("Purchase Order Number should be less than 50 digits");
					  document.cnp_form.PurchaseOrderNumber.focus();
					  return false;
				}
				
				else
				{
					document.cnp_form.submit();
					$('#divMsg').html('<b style="color:green">please wait..</b> <img src="'+loading_gif+'" alt="loading" />');
				}
			}
		$(document).ready(function(){
//			$('#clicknpledge').click(function(e){
//				e.preventDefault();
//				$('#clicknpledge').fadeOut("fast",function(){
//					$("#aut2").show();
//					$('#clicknpledge').fadeIn('fast');
//				});
//				$('#clicknpledge').unbind();
//				$('#clicknpledge').click(function(e){
//					e.preventDefault();
//				});
//			});
			
			
			$('#payment_methods').click(function() {
			if($('#Creditcard').is(':checked')){
			$("#loading").show();
			$.ajax({
				  url: urls,
				  type: "post",
				  data: {payment_methods:'Creditcard',mod_url:mod_url,recurring:recurring,recurring_installment:recurring_installment,recurring_subscription:recurring_subscription,indefinite:indefinite,recurring_units_week:recurring_units_week,recurring_units_week2:recurring_units_week2,recurring_units_month:recurring_units_month,recurring_units_month2:recurring_units_month2,recurring_units_quarter:recurring_units_quarter,recurring_units_month6:recurring_units_month6,recurring_units_year:recurring_units_year},
				  success: function(mess){
 					   $("#payment_methods_display").html(mess);
						$("#loading").hide();
				  },
				  error:function(){
					  $("#payment_methods_display").html('there is error while submit');
				  }   
				}); 
			  }
			  
			if($('#eCheck').is(':checked')){
			$("#loading").show();
			$.ajax({
				  url: urls,
				  type: "post",
				  data: {payment_methods:'eCheck',mod_url:mod_url,recurring:recurring,recurring_installment:recurring_installment,recurring_subscription:recurring_subscription,indefinite:indefinite,recurring_units_week:recurring_units_week,recurring_units_week2:recurring_units_week2,recurring_units_month:recurring_units_month,recurring_units_month2:recurring_units_month2,recurring_units_quarter:recurring_units_quarter,recurring_units_month6:recurring_units_month6,recurring_units_year:recurring_units_year},
				  success: function(mess){
 					   $("#payment_methods_display").html(mess);
						$("#loading").hide();
				  },
				  error:function(){
					  $("#payment_methods_display").html('there is error while submit');
				  }   
				}); 
				
			  }
			 
			if($('#Invoice').is(':checked')){
			$("#loading").show();
			$.ajax({
				  url: urls,
				  type: "post",
				  data: {payment_methods:'Invoice',mod_url:mod_url},
				  success: function(mess){
 					   $("#payment_methods_display").html(mess);
						$("#loading").hide();
				  },
				  error:function(){
					  $("#payment_methods_display").html('there is error while submit');
				  }   
				}); 
			  }
			  
			if($('#PurchaseOrder').is(':checked')){
			$("#loading").show();
			$.ajax({
				  url: urls,
				  type: "post",
				  data: {payment_methods:'PurchaseOrder',mod_url:mod_url},
				  success: function(mess){
 					   $("#payment_methods_display").html(mess);
						$("#loading").hide();
				  },
				  error:function(){
					  $("#payment_methods_display").html('there is error while submit');
				  }   
				}); 
			  }
			  
			});
		
		});
	{/literal}
</script>