<?php
$add = '';
if(isset($_POST['recurring']) && $_POST['recurring'] == 'yes')
{ ?>
<script type="text/javascript">var recurring_units= new Array(); recurring_units = ["<?php  echo $_POST['recurring_units_week']; ?>","<?php  echo $_POST['recurring_units_week2']; ?>","<?php  echo $_POST['recurring_units_month']; ?>","<?php  echo $_POST['recurring_units_month2']; ?>","<?php  echo $_POST['recurring_units_quarter']; ?>","<?php  echo $_POST['recurring_units_month6']; ?>","<?php  echo $_POST['recurring_units_year']; ?>"]; var indefinite = "<?php echo $_POST['indefinite'];?>"</script>
<?php
$add = '<div style="margin-left: 50px;" id="myElementId"><h3>Payment Options</h3><div style="margin-bottom:10px; margin-top:10px;"><input type="radio" id="is_recurring" name="is_recurring" value="0" checked="checked" onclick="recurring_setup(this.value);"><label class="option" for="is_recurring"><span></span> I want to make a one-time payment</div><div style="margin-bottom:10px;"><input type="radio" id="recurring-manytime" name="is_recurring" value="1" onclick="recurring_setup(this.value,\''.$_POST['recurring_installment'].'\',\''.$_POST['recurring_subscription'].'\',recurring_units,indefinite);"><label class="option" for="recurring-manytime"><span></span> I want to make a recurring payment</label>
</div><div id="method_display" style="padding-left:20px;"></div>';
$add .= '</div>';
}

if(isset($_POST['payment_methods']) && $_POST['payment_methods'] == 'Creditcard')
{
?>				
				<div id="card_fields" style="margin-top:20px;">
				<?php echo $add;?>
				<br /><div style="margin-left: 50px;"><h3>Card Information</h3></div><br />
				<label style="margin-left: 50px;display: block;width: 140px;float: left;">Name on card</label> 
				<span class="required">*</span><input type="text" name="name" id="name" size="20" maxlength="50" /><br /><br />
				<label style="margin-left: 50px;display: block;width: 140px;float: left;">Credit Card Number</label>
				<span class="required" style="float:left">*</span><input type="text" id="ccn" name="x_card_num" size="20" autocomplete="Off" style="float:left"/>
				<br /><br />
				<div style="clear:both"></div>
				<label style="margin-left: 50px;display: block;width: 140px;float: left;">Expiration date</label> 
				<span class="required">*</span><select name="x_exp_date_m" id="x_exp_date_m">
				<?php
					for($i=1;$i<=12;$i++){
					$month_num =  date("m");
					$all =date("m",strtotime(date('Y-'.$i.'-01')));
								if($all == $month_num){$selected = 'selected';}else{$selected='';}
	               echo	'<option value="'.$all.'" '.$selected.'>'.date("F",strtotime(date('Y-'.$i.'-01'))).'</option>';
							 }
				   echo '</select>';					
					?>
				 / 
				<select name="x_exp_date_y" id="x_exp_date_y">
				<?php
					for($i=0;$i<=10;$i++){
					$year = date('Y')+$i;
					$year_two = date('y')+$i;
					echo '<option value="'.$year_two.'">'.$year.'</option>';
						}
					echo '</select>'; ?>
				<br /><br />
				<label style="margin-left: 50px;display: block;width: 140px;float: left;">Card Verification (CVV)</label> 
				<span class="required">*</span><input type="text" name="x_card_code" id="x_card_code" size="4" maxlength="4" />&nbsp
				<img src="<?php echo $_POST['mod_url'];?>help.png" id="cvv_help" title="the 3 last digits on the back of your credit card" alt="" onclick="document.getElementById('cvv_help_img').style.display='block'" /><br /><br />
			    <img src="<?php echo $_POST['mod_url'];?>cvv.png" id="cvv_help_img" alt=""style="display: none;margin-left: 211px;" />
				<div id="divMsg"  >
				<input type="button" id="asubmit_credit_card" value="Confirm order"  class="button" onclick="return credit_card_valid();"/>
				</div>
				
<?php } if(isset($_POST['payment_methods']) && $_POST['payment_methods'] == 'eCheck') { ?>

				<div id="check_fields" style="margin-top:20px;">
				<?php echo $add;?>
				<br /><div style="margin-left: 50px;"><h3>eCheck Information</h3></div><br />
				<label style="margin-left: 50px;display: block;width: 140px;float: left;">Routing Number</label> 
				<span class="required">*</span><input type="text" name="RoutingNumber" id="RoutingNumber" size="20" maxlength="9" autocomplete="Off"/><br /><br />
				<label style="margin-left: 50px;display: block;width: 140px;float: left;">Check Number</label>
				<span class="required">*</span><input type="text" id="CheckNumber" name="CheckNumber" size="20" maxlength="10" autocomplete="Off"/><br /><br />
				<label style="margin-left: 50px;display: block;width: 140px;float: left;">Account Number</label> 
			    <span class="required">*</span><input type="text" id="AccountNumber" name="AccountNumber" size="20" maxlength="17" autocomplete="Off"/>
				<br /><br />
				<label style="margin-left: 50px;display: block;width: 140px;float: left;">Retype Account Number</label> 
				<span class="required">*</span><input type="text" name="RetypeAccountNumber" id="RetypeAccountNumber" size="20" maxlength="17" autocomplete="Off"/><br /><br />
				<label style="margin-left: 50px;display: block;width: 146px;float: left;">Account Type</label> 
				<select name="AccountType" id="AccountType">
					<option value="SavingsAccount">Savings Account</option>
					<option value="CheckingAccount">Checking Account</option>
				</select><br /><br />
				<label style="margin-left: 50px;display: block;width: 146px;float: left;">Check Type</label> 
				<select name="CheckType" id="CheckType">
					<option value="Company">Company</option>
					<option value="Personal">Personal</option>
				</select><br /><br />
				<label style="margin-left: 50px;display: block;width: 140px;float: left;">Name on Account</label> 
				<span class="required">*</span><input type="text" name="NameOnAccount" id="NameOnAccount" size="20" maxlength="100" autocomplete="Off"/><br /><br />
				<div id="divMsg"  >
				<input type="button" id="asubmit_echeck" value="Confirm order"  class="button" onclick="return echeck_valid();"/>
				</div>
<?php } if(isset($_POST['payment_methods']) && $_POST['payment_methods'] == 'Invoice') { ?>
				<div id="card_fields" style="margin-top:20px;">
				<label style="margin-left: 50px;display: block;width: 140px;float: left;">Check Number</label>
				<input type="text" name="InvoiceCheckNumber" id="InvoiceCheckNumber" size="20" maxlength="50" autocomplete="Off"/><br /><br />
				<div id="divMsg"  >
				<input type="button" id="asubmit_invoice" value="Confirm order"  class="button" onclick="return invoice_valid();"/>
				</div>
<?php } if(isset($_POST['payment_methods']) && $_POST['payment_methods'] == 'PurchaseOrder') { ?>
				<div id="card_fields" style="margin-top:20px;">
				<label style="margin-left: 50px;display: block;width: 140px;float: left;">Purchase Order Number</label>
				 <input type="text" name="PurchaseOrderNumber" id="PurchaseOrderNumber" size="20" maxlength="50" autocomplete="Off"/><br /><br />
				<div id="divMsg"  >
				<input type="button" id="asubmit_purchaseorder" value="Confirm order"  class="button" onclick="return purchaseorder_valid();"/>
			   </div>
<?php } ?>