<?php
/*
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
*/
include(dirname(__FILE__). '/../../config/config.inc.php');
include(dirname(__FILE__). '/../../init.php');
include(dirname(__FILE__). '/clickandpledge.php');

/* Loading the object */	
$clickandpledge = new clickandpledge();


$context = Context::getContext();
$cart = $context->cart;
if ($cart->id_customer == 0 OR $cart->id_address_delivery == 0 OR $cart->id_address_invoice == 0 OR $cart->id == 0 OR !$clickandpledge->active)
	Tools::redirect('index.php?controller=order&step=1');

/* Transform the POST from the template to a GET for the CURL */
if (isset($_POST['x_exp_date']) && isset($_POST['x_exp_date_m']) && isset($_POST['x_exp_date_y']) && isset($_POST['x_exp_date_y']) && isset($_POST['name']))
{
    
	$_POST['x_exp_date'] = $_POST['x_exp_date_m'].$_POST['x_exp_date_y'];
	unset($_POST['x_exp_date_m']);
	unset($_POST['x_exp_date_y']);
	unset($_POST['name']);
}
$postString = '';
foreach ($_POST AS $key => $value)
	if ($key != "x_exp_date_m" OR $key != "x_exp_date_m")
		$postString .= $key.'='.urlencode($value).'&';
$postString .= 'x_exp_date='.str_pad($_POST["x_exp_date_m"], 2, "0",STR_PAD_LEFT).$_POST["x_exp_date_y"];

/****************** prestashop Country Codes*****************/

$prestashop_country_code = array( '1' => '276','2' => '040','3' => '056','4' => '124','5' => '156','6' => '724','7' => '246','8' => '250','9' => '300', '10' => '380','11' => '392','12' => '442','13' => '528','14' => '616','15' => '620','16' => '203','17' => '826','18' => '752','19' => '756','20' => '208','21' => '840','22' => '344','23' => '578','24' => '036','25' => '702','26' => '372','27' => '554','28' => '410','29' => '376','30' => '710','31' => '566','32' => '384','33' => '768','34' => '068','35' => '480','36' => '642','37' => '703','38' => '012','39' => '016','40' => '020','41' => '024','42' => '660','43' => '028','44' => '032','45' => '051','46' => '533','47' => '031','48' => '044','49' => '048','50' => '050','51' => '052','52' => '112','53' => '084','54' => '204','55' => '060','56' => '064','57' => '072','58' => '076','59' => '096','60' => '854','61' => '104','62' => '108','63' => '116','64' => '120','65' => '132','66' => '140','67' => '148','68' => '152','69' => '170','70' => '174','71' => '180','72' => '178','73' => '188','74' => '191','75' => '192','76' => '196','77' => '262','78' => '212','79' => '214','80' => '626','81' => '218','82' => '818','83' => '222','84' => '226','85' => '232','86' => '233','87' => '231','88' => '238','89' => '234','90' => '242','91' => '266','92' => '270','93' => '268','94' => '288','95' => '308','96' => '304','97' => '292','98' => '312','99' => '316','100' => '320','101' => '831','102' => '324','103' => '624','104' => '328','105' => '332','106' => '334','107' => '336','108' => '340','109' => '352','110' => '356','111' => '360','112' => '364','113' => '368','114' => '833','115' => '388','116' => '832','117' => '400','118' => '398','119' => '404','120' => '296','121' => '408','122' => '414','123' => '417','124' => '418','125' => '428','126' => '422','127' => '426','128' => '430','129' => '434','130' => '438','131' => '440','132' => '446','133' => '807','134' => '450','135' => '454','136' => '458','137' => '462','138' => '466','139' => '470','140' => '584','141' => '474','142' => '478','143' => '348','144' => '175','145' => '484','146' => '583','147' => '498','148' => '492','149' => '496','150' => '499','151' => '500','152' => '504','153' => '508','154' => '516','155' => '520','156' => '524','157' => '','158' => '540','159' => '558','160' => '562','161' => '570','162' => '574','163' => '580','164' => '512','165' => '586','166' => '585','167' => '275','168' => '591','169' => '598','170' => '600','171' => '604','172' => '608','173' => '612','174' => '630','175' => '634','176' => '638','177' => '643','178' => '646','179' => '652','180' => '659','181' => '662','182' => '663','183' => '666','184' => '670','185' => '882','186' => '674','187' => '678','188' => '682','189' => '686','190' => '688','191' => '690','192' => '694','193' => '705','194' => '090','195' => '706','196' => '239','197' => '144','198' => '729','199' => '740','200' => '744','201' => '748','202' => '760','203' => '158','204' => '762','205' => '834','206' => '764','207' => '772','208' => '776','209' => '780','210' => '788','211' => '792','212' => '795','213' => '796','214' => '798','215' => '800','216' => '804','217' => '784','218' => '858','219' => '860','220' => '548','221' => '862','222' => '704','223' => '092','224' => '850','225' => '876','226' => '732','227' => '887','228' => '894','229' => '716','230' => '008','231' => '004','232' => '010','233' => '070','234' => '074','235' => '086','236' => '100','237' => '136','238' => '162','239' => '166','240' => '184','241' => '254','242' => '258','243' => '260','244' => '248'         
          );


/********************* end *****************************/

/************ Create Xml File formate ***************/
    $post = (object)$_POST;
//	echo "<pre>";
//	print_r($post);
//	exit;
    $account_id = $post->x_login;
	$account_guid = $post->x_tran_key;
	$ExpMonth =  $post->x_exp_date_m;
    $ExpYear =  $post->x_exp_date_y;
	if(strlen($ExpMonth)==1)
	{
	    $ExpMonth="0".$ExpMonth;
	}else{
	    $ExpMonth=$ExpMonth;
	}
    $expiration_date_c = $ExpMonth."/".$ExpYear;
    $dom = new DOMDocument('1.0', 'UTF-8');
    $root = $dom->createElement('CnPAPI', '');
    $root->setAttribute("xmlns","urn:APISchema.xsd");
    $root = $dom->appendChild($root);
    
    $version=$dom->createElement("Version",$post->x_version);
    $version=$root->appendChild($version);
    
    $engine = $dom->createElement('Engine', '');
    $engine = $root->appendChild($engine);
    
    $application = $dom->createElement('Application','');
    $application = $engine->appendChild($application);
    
    $applicationid=$dom->createElement('ID','CnP:PaaS:Prestashop:2.0');
    $applicationid=$application->appendChild($applicationid);
    
    $applicationname=$dom->createElement('Name','Salesforce:CnP_PaaS_SC_Prestashop');
    $applicationid=$application->appendChild($applicationname);
	
    $applicationversion=$dom->createElement('Version',$post->x_version);
    $applicationversion=$application->appendChild($applicationversion);
    
    $request = $dom->createElement('Request', '');
    $request = $engine->appendChild($request);
    
    $operation=$dom->createElement('Operation','');
    $operation=$request->appendChild($operation);
    
    $operationtype=$dom->createElement('OperationType','Transaction');
    $operationtype=$operation->appendChild($operationtype);
    
    $ipaddress=$dom->createElement('IPAddress',$_SERVER['REMOTE_ADDR']);
    $ipaddress=$operation->appendChild($ipaddress);
    
	$authentication=$dom->createElement('Authentication','');
    $authentication=$request->appendChild($authentication);

    $accounttype=$dom->createElement('AccountGuid',$account_guid ); 
    $accounttype=$authentication->appendChild($accounttype);
    
    $accountid=$dom->createElement('AccountID',$account_id );
    $accountid=$authentication->appendChild($accountid);
	
	$order=$dom->createElement('Order','');
    $order=$request->appendChild($order);
    
    $ordermode=$dom->createElement('OrderMode',$post->x_test_request); 
    $ordermode=$order->appendChild($ordermode);

	 if(trim($post->x_app_campaign) != '')
	 {
	 $campaign=$dom->createElement('Campaign',substr(str_replace('&','&amp;',$post->x_app_campaign),0,80));
	 $campaign=$order->appendChild($campaign);
	 }
    
    $cardholder=$dom->createElement('CardHolder','');
    $cardholder=$order->appendChild($cardholder);
    
    $billinginfo=$dom->createElement('BillingInformation','');
    $billinginfo=$cardholder->appendChild($billinginfo);

    $billfirst_name=$dom->createElement('BillingFirstName',trim(str_replace('&','&amp;',$post->x_b_first_name)));
    $billfirst_name=$billinginfo->appendChild($billfirst_name);
    
    $billlast_name=$dom->createElement('BillingLastName',trim(str_replace('&','&amp;',$post->x_b_last_name)));
    $billlast_name=$billinginfo->appendChild($billlast_name);

    $bill_email=$dom->createElement('BillingEmail',trim($post->x_email));
    $bill_email=$billinginfo->appendChild($bill_email);
    
	if(trim($post->x_b_phone) != '')
	{
    $bill_phone=$dom->createElement('BillingPhone',trim($post->x_b_phone));
    $bill_phone=$billinginfo->appendChild($bill_phone);
	}
	
    $billingaddress=$dom->createElement('BillingAddress','');
    $billingaddress=$cardholder->appendChild($billingaddress);

    $billingaddress1=$dom->createElement('BillingAddress1',trim(str_replace('&','&amp;',substr($post->x_b_address1,0,100))));
    $billingaddress1=$billingaddress->appendChild($billingaddress1);
    
	if(trim($post->x_b_address2) != '')
	{
    $billingaddress2=$dom->createElement('BillingAddress2',trim(str_replace('&','&amp;',substr($post->x_b_address2,0,100))));
    $billingaddress2=$billingaddress->appendChild($billingaddress2);
    }
    
    $billing_city=$dom->createElement('BillingCity',trim(str_replace('&','&amp;',substr($post->x_b_city,0,100))));
    $billing_city=$billingaddress->appendChild($billing_city);
    
    $billing_state=$dom->createElement('BillingStateProvince',$post->x_b_state);
    $billing_state=$billingaddress->appendChild($billing_state);
    
    $billing_zip=$dom->createElement('BillingPostalCode',$post->x_b_zip);
    $billing_zip=$billingaddress->appendChild($billing_zip);

    $billing_country=$dom->createElement('BillingCountryCode',$prestashop_country_code[$post->x_b_country]);
    $billing_country=$billingaddress->appendChild($billing_country);

    $shippinginfo=$dom->createElement('ShippingInformation','');
    $shippinginfo=$cardholder->appendChild($shippinginfo);
	
	$shippingcontact=$dom->createElement('ShippingContactInformation','');
    $shippingcontact=$shippinginfo->appendChild($shippingcontact);
	
	$ship_first_name=$dom->createElement('ShippingFirstName',trim(str_replace('&','&amp;',$post->x_s_first_name)));
    $ship_first_name=$shippingcontact->appendChild($ship_first_name);
	
	$ship_last_name=$dom->createElement('ShippingLastName',trim(str_replace('&','&amp;',$post->x_s_last_name)));
    $ship_last_name=$shippingcontact->appendChild($ship_last_name);

    $ship_email=$dom->createElement('ShippingEmail',trim($post->x_email));
    $ship_email=$shippingcontact->appendChild($ship_email);	
	
	if(trim($post->x_s_phone) != '')
	{
    $ship_phone=$dom->createElement('ShippingPhone',trim($post->x_s_phone));
    $ship_phone=$shippingcontact->appendChild($ship_phone);  
	}
	
    $shippingaddress=$dom->createElement('ShippingAddress','');
    $shippingaddress=$shippinginfo->appendChild($shippingaddress);
    
    $ship_address1=$dom->createElement('ShippingAddress1',trim(str_replace('&','&amp;',substr($post->x_address1,0,100))));
    $ship_address1=$shippingaddress->appendChild($ship_address1);
	
	if(trim($post->x_address2) != '')
	{
    $ship_address2=$dom->createElement('ShippingAddress2',trim(str_replace('&','&amp;',substr($post->x_address2,0,100))));
    $ship_address2=$shippingaddress->appendChild($ship_address2);
	}
	
    $ship_city=$dom->createElement('ShippingCity',trim(str_replace('&','&amp;',substr($post->x_city,0,50))));
    $ship_city=$shippingaddress->appendChild($ship_city);

    $ship_state=$dom->createElement('ShippingStateProvince',trim($post->x_state));
    $ship_state=$shippingaddress->appendChild($ship_state);
    
    $ship_zip=$dom->createElement('ShippingPostalCode',$post->x_zip);
    $ship_zip=$shippingaddress->appendChild($ship_zip);
    
    $ship_country=$dom->createElement('ShippingCountryCode',$prestashop_country_code[$post->x_country]);
    $ship_country=$shippingaddress->appendChild($ship_country);
	
	$s=$post->customer_birthday;
	$date_display=date('m-d-Y', strtotime($s));

	if($post->x_b_company != '' ||  $post->x_b_phone_home != '' || $post->x_b_add_info != '' || $post->x_s_company != '' || $post->x_s_phone_home != '' || $post->x_s_add_info != '' || $post->x_gift_message != 'Not selected' || trim($post->x_comment_message) != '' || $post->customer_gender != '' || $s != '0000-00-00')
	{
	
	$customfieldlist = $dom->createElement('CustomFieldList','');
    $customfieldlist = $cardholder->appendChild($customfieldlist);
	
	if($post->x_b_company != '')
	{
	$customfield = $dom->createElement('CustomField','');
	$customfield = $customfieldlist->appendChild($customfield);
		
	$fieldname = $dom->createElement('FieldName','Billing Company');
	$fieldname = $customfield->appendChild($fieldname);
		
	$fieldvalue = $dom->createElement('FieldValue',substr(str_replace('&','&amp;',$post->x_b_company), 0, 500));
	$fieldvalue = $customfield->appendChild($fieldvalue);
	}
	
	if($post->x_b_phone_home != '')
	{
	$customfield6 = $dom->createElement('CustomField','');
	$customfield6 = $customfieldlist->appendChild($customfield6);
			
	$fieldname6 = $dom->createElement('FieldName','Billing Home Phone');
	$fieldname6 = $customfield6->appendChild($fieldname6);
			 
	$fieldvalue6 = $dom->createElement('FieldValue',substr($post->x_b_phone_home, 0, 500));
	$fieldvalue6 = $customfield6->appendChild($fieldvalue6);
	}
	
	if($post->x_b_add_info != '')
	{
	$customfield1 = $dom->createElement('CustomField','');
	$customfield1 = $customfieldlist->appendChild($customfield1);
			
	$fieldname1 = $dom->createElement('FieldName','Billing Additional Info');
	$fieldname1 = $customfield1->appendChild($fieldname1);
			 
	$fieldvalue1 = $dom->createElement('FieldValue',substr(str_replace('&','&amp;',$post->x_b_add_info), 0, 500));
	$fieldvalue1 = $customfield1->appendChild($fieldvalue1);
	
	}
	
	if($post->x_s_company != '')
	{
	$customfield2 = $dom->createElement('CustomField','');
	$customfield2 = $customfieldlist->appendChild($customfield2);
	
	$fieldname2 = $dom->createElement('FieldName','Shipping Company');
	$fieldname2 = $customfield2->appendChild($fieldname2);
	
	$fieldvalue2 = $dom->createElement('FieldValue',substr(str_replace('&','&amp;',$post->x_s_company), 0, 500));
    $fieldvalue2 = $customfield2->appendChild($fieldvalue2);
    }
	
	if($post->x_s_phone_home != '')
	{
    $customfield7 = $dom->createElement('CustomField','');
	$customfield7 = $customfieldlist->appendChild($customfield7);
	
	$fieldname7 = $dom->createElement('FieldName','Shipping Home Phone');
	$fieldname7 = $customfield7->appendChild($fieldname7);
	
	$fieldvalue7 = $dom->createElement('FieldValue',substr(str_replace('&','&amp;',$post->x_s_phone_home), 0, 500));
  	$fieldvalue7 = $customfield7->appendChild($fieldvalue7);
	}
	
	if($post->x_s_add_info != '')
	{
	$customfield3 = $dom->createElement('CustomField','');
	$customfield3 = $customfieldlist->appendChild($customfield3);
	
	$fieldname3 = $dom->createElement('FieldName','Shipping Additional Info');
	$fieldname3 = $customfield3->appendChild($fieldname3);
	
	$fieldvalue3 = $dom->createElement('FieldValue',substr(str_replace('&','&amp;',$post->x_s_add_info), 0, 500));
	$fieldvalue3 = $customfield3->appendChild($fieldvalue3);
	}
	if($post->x_gift_message != 'Not selected')
	{
	$customfield4 = $dom->createElement('CustomField','');
	$customfield4 = $customfieldlist->appendChild($customfield4);
	
	$fieldname4 = $dom->createElement('FieldName','Gift Message');
	$fieldname4 = $customfield4->appendChild($fieldname4);
	
	$fieldvalue4 = $dom->createElement('FieldValue',substr(str_replace('&','&amp;',$post->x_gift_message), 0, 500));
	$fieldvalue4 = $customfield4->appendChild($fieldvalue4);
	}
	
	if(trim($post->x_comment_message) != '')
	{
	$customfield5 = $dom->createElement('CustomField','');
	$customfield5 = $customfieldlist->appendChild($customfield5);
	
	$fieldname5 = $dom->createElement('FieldName','Comment');
	$fieldname5 = $customfield5->appendChild($fieldname5);
	
	$fieldvalue5 = $dom->createElement('FieldValue',substr(str_replace('&','&amp;',$post->x_comment_message), 0, 500));
	$fieldvalue5 = $customfield5->appendChild($fieldvalue5);
	}
	
	if($post->customer_gender == 1){
		$customer_title = "Mr";
	}
	 if($post->customer_gender == 2) {
		$customer_title = "Ms";
	}
	
	if($post->customer_gender != '')
	{
	$customfield8 = $dom->createElement('CustomField','');
	$customfield8 = $customfieldlist->appendChild($customfield8);
	
	$fieldname8 = $dom->createElement('FieldName','Title');
	$fieldname8 = $customfield8->appendChild($fieldname8);
	
	$fieldvalue8 = $dom->createElement('FieldValue',substr(str_replace('&','&amp;',$customer_title), 0, 500));
	$fieldvalue8 = $customfield8->appendChild($fieldvalue8);
	}
	
	if($s != '0000-00-00')
	{
	
	$customfield9 = $dom->createElement('CustomField','');
	$customfield9 = $customfieldlist->appendChild($customfield9);
	
	$fieldname9 = $dom->createElement('FieldName','BirthDay');
	$fieldname9 = $customfield9->appendChild($fieldname9);
	
	$fieldvalue9 = $dom->createElement('FieldValue',substr($date_display, 0, 500));
	$fieldvalue9 = $customfield9->appendChild($fieldvalue9);
	
	}
	
	}
	
    $paymentmethod=$dom->createElement('PaymentMethod','');
    $paymentmethod=$cardholder->appendChild($paymentmethod);
    
	if($post->payment_methods == 'Creditcard')
	{
	
    $payment_type=$dom->createElement('PaymentType','CreditCard');
    $payment_type=$paymentmethod->appendChild($payment_type);
	
    $creditcard=$dom->createElement('CreditCard','');
    $creditcard=$paymentmethod->appendChild($creditcard);

    $credit_name=$dom->createElement('NameOnCard',trim(str_replace('&', '&amp;',$post->name)));
    $credit_name=$creditcard->appendChild($credit_name);
    
    $credit_number=$dom->createElement('CardNumber',trim($post->x_card_num));
    $credit_number=$creditcard->appendChild($credit_number);
    
    $credit_cvv=$dom->createElement('Cvv2',trim($post->x_card_code));
    $credit_cvv=$creditcard->appendChild($credit_cvv);

    $credit_expdate=$dom->createElement('ExpirationDate',$expiration_date_c);
    $credit_expdate=$creditcard->appendChild($credit_expdate);
	
	if(isset($_POST['is_recurring']) && $_POST['is_recurring'] == 1)
	{
	$cnp_custom_id = _PS_CNP_CREDITCARD_RECURRING_ORDER_STATUS_;
	}
	else
	{
	$cnp_custom_id = _PS_CNP_CREDITCARD_ORDER_STATUS_;
	}
	
	}
	
	 if($post->payment_methods == 'eCheck')
	 {

	 $payment_type=$dom->createElement('PaymentType','Check');
	 $payment_type=$paymentmethod->appendChild($payment_type);
	 
	 $echeck=$dom->createElement('Check','');
	 $echeck=$paymentmethod->appendChild($echeck);
	 
	 $AccountNumber=$dom->createElement('AccountNumber',$post->AccountNumber);
	 $AccountNumber=$echeck->appendChild($AccountNumber);
	 
	 $AccountType=$dom->createElement('AccountType',$post->AccountType);
	 $AccountType=$echeck->appendChild($AccountType);
	 
	 $RoutingNumber=$dom->createElement('RoutingNumber',$post->RoutingNumber);
	 $RoutingNumber=$echeck->appendChild($RoutingNumber);
	 
	 $CheckNumber=$dom->createElement('CheckNumber',$post->CheckNumber);
	 $CheckNumber=$echeck->appendChild($CheckNumber);

	 $CheckType=$dom->createElement('CheckType',$post->CheckType);
	 $CheckType=$echeck->appendChild($CheckType);
	 
	 $NameOnAccount=$dom->createElement('NameOnAccount',str_replace('&', '&amp;',$post->NameOnAccount));
	 $NameOnAccount=$echeck->appendChild($NameOnAccount);
	 
	if(isset($_POST['is_recurring']) && $_POST['is_recurring'] == 1)
	{
	$cnp_custom_id = _PS_CNP_ECHECK_RECURRING_ORDER_STATUS_;
	}
	else
	{
	$cnp_custom_id = _PS_CNP_ECHECK_ORDER_STATUS_;
	}
	 
	 }			
	
	 if($post->payment_methods == 'Invoice')
	 {
	 
	 $payment_type=$dom->createElement('PaymentType','Invoice');
	 $payment_type=$paymentmethod->appendChild($payment_type);
	 
	 $invoice=$dom->createElement('Invoice','');
	 $invoice=$paymentmethod->appendChild($invoice);
	 
	 $CheckNumber=$dom->createElement('InvoiceCheckNumber',$post->InvoiceCheckNumber);
	 $CheckNumber=$invoice->appendChild($CheckNumber);
	 
	$cnp_custom_id = _PS_CNP_INVOICE_ORDER_STATUS_;
	 
	 }
	
	 if($post->payment_methods == 'PurchaseOrder')
	 {
	 
	 $payment_type=$dom->createElement('PaymentType','PurchaseOrder');
	 $payment_type=$paymentmethod->appendChild($payment_type);
	 
	 $PurchaseOrder=$dom->createElement('PurchaseOrder','');
	 $PurchaseOrder=$paymentmethod->appendChild($PurchaseOrder);
	 
	 $CheckNumber=$dom->createElement('PurchaseOrderNumber',$post->PurchaseOrderNumber);
	 $CheckNumber=$PurchaseOrder->appendChild($CheckNumber);
	 
	$cnp_custom_id = _PS_CNP_PURCHASE_ORDER_STATUS_;
	 
	 }

    $orderitemlist=$dom->createElement('OrderItemList','');
    $orderitemlist=$order->appendChild($orderitemlist);
    
		if(isset($_POST['indefinite_times']))$number_of_times = $_POST['indefinite_times'];else $number_of_times = $_POST['number_of_times'];
	if(count($_POST['x_product_name'])>0 && isset($_POST['is_recurring']) && $_POST['is_recurring'] == 1 && isset($_POST['recurring_method']) && $_POST['recurring_method'] == 'Installment')
	{
	    $item_id = $_POST['x_product_id'];
		$item_code = $_POST['x_product_unique_id'];
	    $itemcode_code=$_POST['x_product_name'];
		$item_quantity=$_POST['x_product_quantity'];
		$item_price=$_POST['x_product_price'];
		$item_tax=$_POST['x_product_tax'];
		$total=0;
		$total_tax=0;
		for($i=0;$i<count($_POST['x_product_name']);$i++)
		{
			if($itemcode_code[$i]!='')
			{
			    $orderitem=$dom->createElement('OrderItem','');
				$orderitem=$orderitemlist->appendChild($orderitem);
				
				 $itemid=$dom->createElement('ItemID',$item_id[$i]);
				 $itemid=$orderitem->appendChild($itemid);
				
				$itemname=$dom->createElement('ItemName',substr($itemcode_code[$i], 0, 25));
				$itemname=$orderitem->appendChild($itemname);
				
				$quntity=$dom->createElement('Quantity',$item_quantity[$i]);
				$quntity=$orderitem->appendChild($quntity);
				//echo $item_price[$i].'<br>'. $_POST['x_product_price_unitdiscount'][$i].'<br>';
				
				
				//echo number_format(($one_p_total/$_POST['number_of_times']),2,'.','')*100;exit;
				$unitprice=$dom->createElement('UnitPrice',$clickandpledge->floor_dec(($item_price[$i]/$_POST['number_of_times']),2,'.','')*100);
				$unitprice=$orderitem->appendChild($unitprice);
				
				$unit_deduct=$dom->createElement('UnitDeductible','000');
				$unit_deduct=$orderitem->appendChild($unit_deduct);
				
				$unit_tax=$dom->createElement('UnitTax',$clickandpledge->floor_dec(($item_tax[$i]/$number_of_times),2,'.','')*100);
				$unit_tax=$orderitem->appendChild($unit_tax);
				
				if($_POST['x_product_price_unitdiscount'][$i] != '')
				{
				$unit_disc=$dom->createElement('UnitDiscount',$clickandpledge->floor_dec(($_POST['x_product_price_unitdiscount'][$i]/$number_of_times),2,'.','')*100);
				$unit_disc=$orderitem->appendChild($unit_disc);
				}
				
				if($_POST['x_product_sku'][$i] != '')
				{
				$sku_code=$dom->createElement('SKU',substr($_POST['x_product_sku'][$i],0,100));
				$sku_code=$orderitem->appendChild($sku_code);
				}
				
				if($_POST['x_product_campaign'][$i] != '')
				{
				$campaign_code=$dom->createElement('Campaign',substr($_POST['x_product_campaign'][$i],0,80));
				$campaign_code=$orderitem->appendChild($campaign_code);
				}
				
				if(count(array_filter($_POST['x_product_attributes_name'])) && $i == 0)
				{
				
				$customfield_product = $dom->createElement('CustomFieldList','');
				$customfield_product = $orderitem->appendChild($customfield_product);
				}
				if($_POST['x_product_attributes_name'][$i] != '')
				{
					$customfield = $dom->createElement('CustomField','');
					$customfield = $customfield_product->appendChild($customfield);
					
					$fieldname = $dom->createElement('FieldName',substr($itemcode_code[$i], 0, 25).' Attributes');
					$fieldname = $customfield->appendChild($fieldname);
					
					$fieldvalue = $dom->createElement('FieldValue',substr(str_replace('&','&amp;',$_POST['x_product_attributes_name'][$i]), 0, 500));
					$fieldvalue = $customfield->appendChild($fieldvalue);

				if($_POST['x_selected_attribute_price'][$i] > 0)
				{
					$customfield1 = $dom->createElement('CustomField','');
					$customfield1 = $customfield_product->appendChild($customfield1);
					
					$fieldname1 = $dom->createElement('FieldName',substr($itemcode_code[$i], 0, 25).' Attribute Price');
					$fieldname1 = $customfield1->appendChild($fieldname1);
					
					$fieldvalue1 = $dom->createElement('FieldValue',substr(Tools::ps_round($_POST['x_selected_attribute_price'][$i],2), 0, 500));
					$fieldvalue1 = $customfield1->appendChild($fieldvalue1);
				}
				
				}
				 $total  += $item_quantity[$i]*$clickandpledge->floor_dec(($item_price[$i]/$number_of_times),2,'.','')*100;  
				 $total_tax += $item_quantity[$i]*$clickandpledge->floor_dec(($item_tax[$i]/$number_of_times),2,'.','')*100;
				 $total_disscount +=$item_quantity[$i]*$clickandpledge->floor_dec(($_POST['x_product_price_unitdiscount'][$i]/$number_of_times),2,'.','')*100;
				 // $without_recurring_total +=$one_p_total;
			}
		}
		//echo number_format(($post->x_shipping_cost/$number_of_times),2,'.','');exit;
		 $new_tax =$clickandpledge->floor_dec($post->x_total_tax/$number_of_times, 2, '.', '')*100+$total_tax; 
		 $new_toatl_disscount = $clickandpledge->floor_dec(($post->x_coupon_discount/$number_of_times),2,'.','')*100;
		 $total_shipping = $clickandpledge->floor_dec(($post->x_shipping_cost/$number_of_times),2,'.','')*100;
		 $front_toatl = ($total_shipping+$new_tax) - ($new_toatl_disscount+$total_disscount);
		 $total += $clickandpledge->floor_dec($front_toatl,2,'.','');
	}
	else
	{
		$item_id = $_POST['x_product_id'];
		$item_code = $_POST['x_product_unique_id'];
		$itemcode_code=$_POST['x_product_name'];
		$item_quantity=$_POST['x_product_quantity'];
		$item_price=$_POST['x_product_price'];
		$item_tax=$_POST['x_product_tax'];
		$total=0;
		$total_tax=0;
		for($i=0;$i<count($_POST['x_product_name']);$i++)
			{
			if($itemcode_code[$i]!='')
			{
			$orderitem=$dom->createElement('OrderItem','');
			$orderitem=$orderitemlist->appendChild($orderitem);
			
			 $itemid=$dom->createElement('ItemID',$item_id[$i]);
			 $itemid=$orderitem->appendChild($itemid);
			
			$itemname=$dom->createElement('ItemName',substr($itemcode_code[$i], 0, 25));
			$itemname=$orderitem->appendChild($itemname);
			
			$quntity=$dom->createElement('Quantity',$item_quantity[$i]);
			$quntity=$orderitem->appendChild($quntity);
			
			$unitprice=$dom->createElement('UnitPrice',$item_price[$i]*100);
			$unitprice=$orderitem->appendChild($unitprice);
			
			$unit_deduct=$dom->createElement('UnitDeductible','000');
			$unit_deduct=$orderitem->appendChild($unit_deduct);
			
			$unit_tax=$dom->createElement('UnitTax',$item_tax[$i]*100);
			$unit_tax=$orderitem->appendChild($unit_tax);
			
			if($_POST['x_product_price_unitdiscount'][$i] != '')
			{
			$unit_disc=$dom->createElement('UnitDiscount',Tools::ps_round($_POST['x_product_price_unitdiscount'][$i],2)*100);
			$unit_disc=$orderitem->appendChild($unit_disc);
			}
			
			if($_POST['x_product_sku'][$i] != '')
			{
			$sku_code=$dom->createElement('SKU',substr($_POST['x_product_sku'][$i],0,100));
			$sku_code=$orderitem->appendChild($sku_code);
			}
			
			if($_POST['x_product_campaign'][$i] != '')
			{
			$campaign_code=$dom->createElement('Campaign',substr($_POST['x_product_campaign'][$i],0,80));
			$campaign_code=$orderitem->appendChild($campaign_code);
			}
			
			if(count(array_filter($_POST['x_product_attributes_name'])) && $i == 0)
			{
			
			$customfield_product = $dom->createElement('CustomFieldList','');
			$customfield_product = $orderitem->appendChild($customfield_product);
			}
			if($_POST['x_product_attributes_name'][$i] != '')
			{
				$customfield = $dom->createElement('CustomField','');
				$customfield = $customfield_product->appendChild($customfield);
				
				$fieldname = $dom->createElement('FieldName',substr($itemcode_code[$i], 0, 25).' Attributes');
				$fieldname = $customfield->appendChild($fieldname);
				
				$fieldvalue = $dom->createElement('FieldValue',substr(str_replace('&','&amp;',$_POST['x_product_attributes_name'][$i]), 0, 500));
				$fieldvalue = $customfield->appendChild($fieldvalue);
				
				if($_POST['x_selected_attribute_price'][$i] > 0)
				{
				$customfield1 = $dom->createElement('CustomField','');
				$customfield1 = $customfield_product->appendChild($customfield1);
				
				$fieldname1 = $dom->createElement('FieldName',substr($itemcode_code[$i], 0, 25).' Attribute Price');
				$fieldname1 = $customfield1->appendChild($fieldname1);
				
				$fieldvalue1 = $dom->createElement('FieldValue',substr(Tools::ps_round($_POST['x_selected_attribute_price'][$i],2), 0, 500));
				$fieldvalue1 = $customfield1->appendChild($fieldvalue1);
			    }
			}
			 
			 $total +=$item_quantity[$i]*$item_price[$i]*100;
			 $total_tax +=$item_quantity[$i]*$item_tax[$i]*100;
			$total_disscount +=$item_quantity[$i]*Tools::ps_round($_POST['x_product_price_unitdiscount'][$i],2)*100;
			}
			}
		$new_tax = ($clickandpledge->floor_dec($post->x_total_tax, 2, '.', '')+ $total_tax)*100;
		$new_toatl_disscount = $post->x_coupon_discount*100;
		//echo $post->x_coupon_discount+$new_toatl_disscount+$total_disscount;
		 $total += ($post->x_shipping_cost*100+$total_tax+$new_tax) - ($new_toatl_disscount+$total_disscount);
		$total_shipping = $post->x_shipping_cost*100;
	}
   
    $shipping=$dom->createElement('Shipping','');
    $shipping=$order->appendChild($shipping);
    
    $shipping_method=$dom->createElement('ShippingMethod',$post->x_shipping_method);
    $shipping_method=$shipping->appendChild($shipping_method);
    
	if(isset($_POST['recurring_method']) && $_POST['recurring_method'] == 'Installment')
	{
    $shipping_value=$dom->createElement('ShippingValue',($clickandpledge->floor_dec(($post->x_shipping_cost/$number_of_times),2,'.','')*100));
    $shipping_value=$shipping->appendChild($shipping_value);
    }else{
    $shipping_value=$dom->createElement('ShippingValue',($post->x_shipping_cost*100));
    $shipping_value=$shipping->appendChild($shipping_value);
	}
	
    $shipping_tax=$dom->createElement('ShippingTax','000');
    $shipping_tax=$shipping->appendChild($shipping_tax);
    
	if(trim($post->x_send_recepit) == 'yes')
	{
    $receipt=$dom->createElement('Receipt','');
    $receipt=$order->appendChild($receipt);
	
	$recipt_lang=$dom->createElement('Language','ENG');
	$recipt_lang=$receipt->appendChild($recipt_lang);
	
	if(trim($post->x_org_info) != '')
	{
	$recipt_org=$dom->createElement('OrganizationInformation',substr(str_replace('&', '&amp;',addslashes($post->x_org_info)),0,1500));
	$recipt_org=$receipt->appendChild($recipt_org);
	}
	
	if(trim($post->x_thankyou_message != ''))
	{
	$recipt_thanks=$dom->createElement('ThankYouMessage',substr(str_replace('&','&amp;',addslashes($post->x_thankyou_message)),0,500));
	$recipt_thanks=$receipt->appendChild($recipt_thanks);
	}
	
	if(trim($post->x_terms_condition) != '')
	{
	$recipt_terms=$dom->createElement('TermsCondition',substr(str_replace('&','&amp;',addslashes($post->x_terms_condition)),0,1500));
	$recipt_terms=$receipt->appendChild($recipt_terms);
	}
	$recipt_deduct=$dom->createElement('Deductible','1');
	$recipt_deduct=$receipt->appendChild($recipt_deduct);
	
	$recipt_email=$dom->createElement('EmailNotificationList','');
	$recipt_email=$receipt->appendChild($recipt_email);

	$email_note=$dom->createElement('NotificationEmail',trim($post->x_email));
	$email_note=$recipt_email->appendChild($email_note);
	}
	
	
	$transation=$dom->createElement('Transaction','');
	$transation=$order->appendChild($transation);

	$trans_type=$dom->createElement('TransactionType','Payment');
	$trans_type=$transation->appendChild($trans_type);
	
	$trans_desc=$dom->createElement('DynamicDescriptor','DynamicDescriptor');
	$trans_desc=$transation->appendChild($trans_desc); 
	 
	 if(isset($_POST['is_recurring']) && $_POST['is_recurring'] == 1){

	 $trans_recurr=$dom->createElement('Recurring','');
	 $trans_recurr=$transation->appendChild($trans_recurr);
	 
	 $total_installment=$dom->createElement('Installment',$number_of_times);
	 $total_installment=$trans_recurr->appendChild($total_installment);
	 
	 $total_periodicity=$dom->createElement('Periodicity',$_POST['Periodicity']);
	 $total_periodicity=$trans_recurr->appendChild($total_periodicity);
	 
	 $total_installment=$dom->createElement('RecurringMethod',$_POST['recurring_method']);
	 $total_installment=$trans_recurr->appendChild($total_installment);
	 }
	 
	 
	$trans_totals=$dom->createElement('CurrentTotals','');
	$trans_totals=$transation->appendChild($trans_totals);
	
	$total_discount=$dom->createElement('TotalDiscount',$total_disscount+$new_toatl_disscount);
	$total_discount=$trans_totals->appendChild($total_discount);

	$total_tax=$dom->createElement('TotalTax',$new_tax);
	$total_tax=$trans_totals->appendChild($total_tax);

	$total_ship=$dom->createElement('TotalShipping',$total_shipping);
	$total_ship=$trans_totals->appendChild($total_ship);
	
	$total_deduct=$dom->createElement('TotalDeductible','000');
	$total_deduct=$trans_totals->appendChild($total_deduct);

	$total_amount=$dom->createElement('Total',abs($total));
	$total_amount=$trans_totals->appendChild($total_amount);
	
	$trans_coupon=$dom->createElement('CouponCode',$post->x_coupon_code);
	$trans_coupon=$transation->appendChild($trans_coupon);
			 
	$trans_coupon_discount=$dom->createElement('TransactionDiscount',$new_toatl_disscount);
	$trans_coupon_discount=$transation->appendChild($trans_coupon_discount);
	
	$trans_tax=$dom->createElement('TransactionTax',$new_tax);
	$trans_tax=$transation->appendChild($trans_tax);
   
    $response=array();
	$strParam =$dom->saveXML();
	//echo $strParam;exit;
	$connect = array('soap_version' => SOAP_1_1, 'trace' => 1, 'exceptions' => 0);
	$client = new SoapClient('https://paas.cloud.clickandpledge.com/paymentservice.svc?wsdl', $connect);
	$params = array('instruction'=>$strParam);
	$response = $client->Operation($params);
	
	$response_value=$response->OperationResult->ResultData;
	$result_array=$response->OperationResult->ResultCode;
	
	$transation_number = array('transaction_id' => $response->OperationResult->TransactionNumber);
	$xml_error=explode(":",$response->OperationResult->AdditionalInfo);
	
	if(isset($xml_error['2']))
	{
       $payment_error=str_replace("'",'',$xml_error['2']);
	   
	}
	else
	{
	   $payment_error="";
	}
	
	if($payment_error == '')
	{
		$response_value=$response->OperationResult->ResultData;
		$_SESSION['trasactionmess']=$response_value;
		if($transation_number!='')
		{
		    $cart = new Cart((int)$post->x_invoice_num);
			
			$customer = new Customer((int)$cart->id_customer);
		   
			$message = $response_value;
			//echo $cnp_custom_id; exit;
			if ($result_array == 0)
				$clickandpledge->validateOrder((int)$cart->id, $cnp_custom_id, (float)$post->x_amount, $clickandpledge->displayName, $message, $transation_number, NULL, false, $customer->secure_key);
			else
			   $clickandpledge->validateOrder((int)$cart->id, _PS_OS_ERROR_, (float)$post->x_amount, $clickandpledge->displayName, $message, NULL, NULL, false, $customer->secure_key);
		      
			Tools::redirect('order-confirmation.php?id_module='.(int)$clickandpledge->id.'&id_cart='.(int)$cart->id.'&key='.$customer->secure_key);
		}
		else
		{
			//$payment_status='Declined';
			//Tools::redirect('order.php?step=3&aimerror=1');
		 if (strstr($_SERVER['HTTP_REFERER'], '?')) { Tools::redirect($_SERVER['HTTP_REFERER'].'&step=3&aimerror=1'); }
		else { Tools::redirect($_SERVER['HTTP_REFERER'].'?step=3&aimerror=1'); }
			
		}
	 }else{
		$short_error = explode('-',$payment_error);
		//Tools::redirect('order.php?step=3&aimerror=1&message='.$short_error[0]);
		 if (strstr($_SERVER['HTTP_REFERER'], '?')) { Tools::redirect($_SERVER['HTTP_REFERER'].'&step=3&aimerror=1&message='.$short_error[0]); }
		else { Tools::redirect($_SERVER['HTTP_REFERER'].'?step=3&aimerror=1&message='.$short_error[0]); }
	    }