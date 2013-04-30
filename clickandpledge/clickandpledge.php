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
*  @version  Release: $Revision: 6626 $
*  @license    http://opensource.org/licenses/afl-3.0.php  Academic Free License (AFL 3.0)
*  International Registered Trademark & Property of PrestaShop SA
*/

if (!defined('_CAN_LOAD_FILES_'))
	 exit;

		// check if the order status is defined
		if (!defined('_PS_CNP_CREDITCARD_ORDER_STATUS_') || !defined('_PS_CNP_ECHECK_ORDER_STATUS_') || !defined('_PS_CNP_INVOICE_ORDER_STATUS_') || !defined('_PS_CNP_PURCHASE_ORDER_STATUS_') || !defined('_PS_CNP_CREDITCARD_RECURRING_ORDER_STATUS_') || !defined('_PS_CNP_ECHECK_RECURRING_ORDER_STATUS_')) {
				// order status is not defined - check if, it exists in the table
			$rq = Db::getInstance()->getRow('SELECT `id_order_state` FROM `'._DB_PREFIX_.'order_state_lang`	WHERE id_lang = 1 AND  name ="CnP Credit Card Payment"');
			
			if ($rq && isset($rq['id_order_state']) && intval($rq['id_order_state']) > 0) {
				// order status exists in the table - define it.
				define('_PS_CNP_CREDITCARD_ORDER_STATUS_', $rq['id_order_state']);

			} else {
		
				Db::getInstance()->Execute('INSERT INTO `'._DB_PREFIX_.'order_state` (`color`,`invoice`,`send_email`,`module_name`,`logable`) VALUES(\'LimeGreen\',1,1,\'clickandpledge\',1)');
				$cnp_creditcard = Db::getInstance()->Insert_ID();
				Db::getInstance()->Execute('INSERT INTO `'._DB_PREFIX_.'order_state_lang` (`id_order_state`, `id_lang`, `name`,`template`)
				VALUES(' . intval($cnp_creditcard) . ', 1, \'CnP Credit Card Payment\',\'payment\')');
				define('_PS_CNP_CREDITCARD_ORDER_STATUS_', $cnp_creditcard);

			   }

			$rq_check = Db::getInstance()->getRow('SELECT `id_order_state` FROM `'._DB_PREFIX_.'order_state_lang` WHERE id_lang = 1 AND  name ="CnP eCheck Payment"');
			
			if ($rq_check && isset($rq_check['id_order_state']) && intval($rq_check['id_order_state']) > 0) {
				// order status exists in the table - define it.
				define('_PS_CNP_ECHECK_ORDER_STATUS_', $rq_check['id_order_state']);

			} else {
		
				Db::getInstance()->Execute('INSERT INTO `'._DB_PREFIX_.'order_state` (`color`,`invoice`,`send_email`,`module_name`,`logable`) VALUES(\'LimeGreen\',1,1,\'clickandpledge\',1)');
				$cnp_echeck = Db::getInstance()->Insert_ID();
				Db::getInstance()->Execute('INSERT INTO `'._DB_PREFIX_.'order_state_lang` (`id_order_state`, `id_lang`, `name`,`template`)
				VALUES(' . intval($cnp_echeck) . ', 1, \'CnP eCheck Payment\',\'payment\')');
				define('_PS_CNP_ECHECK_ORDER_STATUS_',$cnp_echeck);

			   }
			$rq_invoice = Db::getInstance()->getRow('SELECT `id_order_state` FROM `'._DB_PREFIX_.'order_state_lang`	WHERE id_lang = 1 AND  name ="CnP Awaiting Invoice Payment"');
			
			if ($rq_invoice && isset($rq_invoice['id_order_state']) && intval($rq_invoice['id_order_state']) > 0) {
				// order status exists in the table - define it.
				define('_PS_CNP_INVOICE_ORDER_STATUS_', $rq_invoice['id_order_state']);

			} else {
		
				Db::getInstance()->Execute('INSERT INTO `'._DB_PREFIX_.'order_state` (`color`,`invoice`,`send_email`,`module_name`,`logable`) VALUES(\'RoyalBlue\',1,1,\'clickandpledge\',1)');
				$cnp_invoice = Db::getInstance()->Insert_ID();
				Db::getInstance()->Execute('INSERT INTO `'._DB_PREFIX_.'order_state_lang` (`id_order_state`, `id_lang`, `name`,`template`)
				VALUES(' . intval($cnp_invoice) . ', 1, \'CnP Awaiting Invoice Payment\',\'cheque\')');
				define('_PS_CNP_INVOICE_ORDER_STATUS_', $cnp_invoice);

			   }
		$rq_po = Db::getInstance()->getRow('SELECT `id_order_state` FROM `'._DB_PREFIX_.'order_state_lang`	WHERE id_lang = 1 AND  name ="CnP Awaiting Purchase Order Payment"');
			   
			if ($rq_po && isset($rq_po['id_order_state']) && intval($rq_po['id_order_state']) > 0) {
				// order status exists in the table - define it.
				define('_PS_CNP_PURCHASE_ORDER_STATUS_', $rq_po['id_order_state']);

			} else {
		
				Db::getInstance()->Execute('INSERT INTO `'._DB_PREFIX_.'order_state` (`color`,`invoice`,`send_email`,`module_name`,`logable`) VALUES(\'RoyalBlue\',1,1,\'clickandpledge\',1)');
				$cnp_purchaseorder = Db::getInstance()->Insert_ID();
				Db::getInstance()->Execute('INSERT INTO `'._DB_PREFIX_.'order_state_lang` (`id_order_state`, `id_lang`, `name`,`template`)
				VALUES(' . intval($cnp_purchaseorder) . ', 1, \'CnP Awaiting Purchase Order Payment\',\'cheque\')');
				define('_PS_CNP_PURCHASE_ORDER_STATUS_', $cnp_purchaseorder);

			   }
			   
			$rq_rp_credit = Db::getInstance()->getRow('SELECT `id_order_state` FROM `'._DB_PREFIX_.'order_state_lang`	WHERE id_lang = 1 AND  name ="CnP Credit Card Recurring Payment"');
			
			if ($rq_rp_credit && isset($rq_rp_credit['id_order_state']) && intval($rq_rp_credit['id_order_state']) > 0) {
				// order status exists in the table - define it.
				define('_PS_CNP_CREDITCARD_RECURRING_ORDER_STATUS_', $rq_rp_credit['id_order_state']);

			} else {
		
				Db::getInstance()->Execute('INSERT INTO `'._DB_PREFIX_.'order_state` (`color`,`invoice`,`send_email`,`module_name`,`logable`) VALUES(\'LimeGreen\',1,1,\'clickandpledge\',1)');
				$cnp_creditcard_recurring = Db::getInstance()->Insert_ID();
				Db::getInstance()->Execute('INSERT INTO `'._DB_PREFIX_.'order_state_lang` (`id_order_state`, `id_lang`, `name`,`template`)
				VALUES(' . intval($cnp_creditcard_recurring) . ', 1, \'CnP Credit Card Recurring Payment\',\'payment\')');
				define('_PS_CNP_CREDITCARD_RECURRING_ORDER_STATUS_', $cnp_creditcard_recurring);

			   }
			   
			$rq_rp_invoice = Db::getInstance()->getRow('SELECT `id_order_state` FROM `'._DB_PREFIX_.'order_state_lang`	WHERE id_lang = 1 AND  name ="CnP eCheck Recurring Payment"');
			
			if ($rq_rp_invoice && isset($rq_rp_invoice['id_order_state']) && intval($rq_rp_invoice['id_order_state']) > 0) {
				// order status exists in the table - define it.
				define('_PS_CNP_ECHECK_RECURRING_ORDER_STATUS_', $rq_rp_invoice['id_order_state']);

			} else {
		
				Db::getInstance()->Execute('INSERT INTO `'._DB_PREFIX_.'order_state` (`color`,`invoice`,`send_email`,`module_name`,`logable`) VALUES(\'LimeGreen\',1,1,\'clickandpledge\',1)');
				$cnp_echeck_recurring = Db::getInstance()->Insert_ID();
				Db::getInstance()->Execute('INSERT INTO `'._DB_PREFIX_.'order_state_lang` (`id_order_state`, `id_lang`, `name`,`template`)
				VALUES(' . intval($cnp_echeck_recurring) . ', 1, \'CnP eCheck Recurring Payment\',\'payment\')');
				define('_PS_CNP_ECHECK_RECURRING_ORDER_STATUS_', $cnp_echeck_recurring);

			   }
			}
	 
class clickandpledge extends PaymentModule
{
	public function __construct()
	{
		$this->name = 'clickandpledge';
		$this->tab = 'payments_gateways';
		$this->version = '2.0';
		$this->author = 'Click & Pledge';
		//$this->limited_countries = array('uk');
		$this->need_instance = 0;

        parent::__construct();

        $this->displayName = 'Click & Pledge API';
        $this->description = $this->l('Receive payment with Click & Pledge');
		
		/* Check if cURL is enabled */
		if (!is_callable('curl_exec'))
			$this->warning = $this->l('cURL extension must be enabled on your server to use this module.');
	}

	public function install()
	{
		return (parent::install() AND $this->registerHook('orderConfirmation') AND $this->registerHook('payment') AND Configuration::updateValue('CLICKANDPLEDGE_DEMO', 1) AND Configuration::updateValue('CLICKANDPLEDGE_SEND_RECEIPT_US', '1') AND Configuration::updateValue('CLICKANDPLEDGE_CREDITCARD', 'Credit Card') AND Configuration::updateValue('PAYMENT_METHOD_DEFAULT', 'Creditcard'));
	}
 
	public function uninstall()
	{
		//for US
		Configuration::deleteByName('CLICKANDPLEDGE_LOGIN_ID_US'); //Account ID
		Configuration::deleteByName('CLICKANDPLEDGE_KEY_US');  //GUID
		Configuration::deleteByName('CLICKANDPLEDGE_DEMO_US'); //Transaction mode
		Configuration::deleteByName('CLICKANDPLEDGE_CAMPAIGN_US'); //campaign name
		Configuration::deleteByName('CLICKANDPLEDGE_STATUS_US');  //status
		
		//for Euro
		Configuration::deleteByName('CLICKANDPLEDGE_LOGIN_ID_EURO');
		Configuration::deleteByName('CLICKANDPLEDGE_KEY_EURO');
		Configuration::deleteByName('CLICKANDPLEDGE_DEMO_EURO');
		Configuration::deleteByName('CLICKANDPLEDGE_CAMPAIGN_EURO');
		Configuration::deleteByName('CLICKANDPLEDGE_STATUS_EURO');
		
		//for Pound
		Configuration::deleteByName('CLICKANDPLEDGE_LOGIN_ID_POUND');
		Configuration::deleteByName('CLICKANDPLEDGE_KEY_POUND');
		Configuration::deleteByName('CLICKANDPLEDGE_DEMO_POUND');
		Configuration::deleteByName('CLICKANDPLEDGE_CAMPAIGN_POUND');
		Configuration::deleteByName('CLICKANDPLEDGE_STATUS_POUND');
		
		Configuration::deleteByName('CLICKANDPLEDGE_ORG_INFO_US');
		Configuration::deleteByName('CLICKANDPLEDGE_THANK_MESSAGE_US');
		Configuration::deleteByName('CLICKANDPLEDGE_TERMS_CONDI_US');
		Configuration::deleteByName('CLICKANDPLEDGE_SEND_RECEIPT_US');
		
		//recurring
		Configuration::deleteByName('CLICKANDPLEDGE_RECURRING_CONTRI');
		Configuration::deleteByName('CLICKANDPLEDGE_WEEK');
		Configuration::deleteByName('CLICKANDPLEDGE_2_WEEKS');
		Configuration::deleteByName('CLICKANDPLEDGE_MONTH');
		Configuration::deleteByName('CLICKANDPLEDGE_2_MONTHS');
		Configuration::deleteByName('CLICKANDPLEDGE_QUARTER');
		Configuration::deleteByName('CLICKANDPLEDGE_6_MONTHS');
		Configuration::deleteByName('CLICKANDPLEDGE_YEAR');
		
		Configuration::deleteByName('CLICKANDPLEDGE_INSTALLMENT');
		Configuration::deleteByName('CLICKANDPLEDGE_SUBSCRIPTION');
		Configuration::deleteByName('CLICKANDPLEDGE_INDEFINITE');
		
		Configuration::deleteByName('CLICKANDPLEDGE_CREDITCARD');
		Configuration::deleteByName('CLICKANDPLEDGE_CHECK');
		Configuration::deleteByName('CLICKANDPLEDGE_INVOICE');
		Configuration::deleteByName('CLICKANDPLEDGE_PURCH_ORD');
		Configuration::deleteByName('PAYMENT_METHOD_DEFAULT');
	
		return parent::uninstall();
	}

	public function hookOrderConfirmation($params)
	{
		global $smarty; 
        
		if ($params['objOrder']->module != $this->name) 
			return;
       
		if ($params['objOrder']->getCurrentState() != _PS_OS_ERROR_) 
			$smarty->assign(array('status' => 'ok', 'id_order' => intval($params['objOrder']->id)));
		else
			$smarty->assign('status', 'failed');
         
		return $this->display(__FILE__, 'hookorderconfirmation.tpl'); 
	}

	public function getContent()
	{
		$html = '';
		if (Tools::isSubmit('submitModule'))
		{
			//for us
			Configuration::updateValue('CLICKANDPLEDGE_LOGIN_ID_US', Tools::getvalue('clickandpledge_login_id_us'));
			Configuration::updateValue('CLICKANDPLEDGE_KEY_US', Tools::getvalue('clickandpledge_key_us'));
			Configuration::updateValue('CLICKANDPLEDGE_DEMO_US', Tools::getvalue('clickandpledge_demo_mode_us'));
			Configuration::updateValue('CLICKANDPLEDGE_CAMPAIGN_US', Tools::getvalue('clickandpledge_campaign_us'));
			Configuration::updateValue('CLICKANDPLEDGE_STATUS_US', Tools::getvalue('clickandpledge_status_us'));
			
			//for Euro
			Configuration::updateValue('CLICKANDPLEDGE_LOGIN_ID_EURO', Tools::getvalue('clickandpledge_login_id_euro'));
			Configuration::updateValue('CLICKANDPLEDGE_KEY_EURO', Tools::getvalue('clickandpledge_key_euro'));
			Configuration::updateValue('CLICKANDPLEDGE_DEMO_EURO', Tools::getvalue('clickandpledge_demo_mode_euro'));
			Configuration::updateValue('CLICKANDPLEDGE_CAMPAIGN_EURO', Tools::getvalue('clickandpledge_campaign_euro'));
			Configuration::updateValue('CLICKANDPLEDGE_STATUS_EURO', Tools::getvalue('clickandpledge_status_euro'));
			
			//for Pound
			Configuration::updateValue('CLICKANDPLEDGE_LOGIN_ID_POUND', Tools::getvalue('clickandpledge_login_id_pound'));
			Configuration::updateValue('CLICKANDPLEDGE_KEY_POUND', Tools::getvalue('clickandpledge_key_pound'));
			Configuration::updateValue('CLICKANDPLEDGE_DEMO_POUND', Tools::getvalue('clickandpledge_demo_mode_pound'));
			Configuration::updateValue('CLICKANDPLEDGE_CAMPAIGN_POUND', Tools::getvalue('clickandpledge_campaign_pound'));
			Configuration::updateValue('CLICKANDPLEDGE_STATUS_POUND', Tools::getvalue('clickandpledge_status_pound'));
			
			
			if (Tools::getValue('clickandpledge_send_receipt_us')){	Configuration::updateValue('CLICKANDPLEDGE_SEND_RECEIPT_US', 1);}
			else{ Configuration::updateValue('CLICKANDPLEDGE_SEND_RECEIPT_US', 0);}
			Configuration::updateValue('CLICKANDPLEDGE_ORG_INFO_US', Tools::getvalue('clickandpledge_org_info_us'));
			Configuration::updateValue('CLICKANDPLEDGE_THANK_MESSAGE_US', Tools::getvalue('clickandpledge_thank_message_us'));
			Configuration::updateValue('CLICKANDPLEDGE_TERMS_CONDI_US', Tools::getvalue('clickandpledge_terms_condition_us'));
			
			//recurring
			Configuration::updateValue('CLICKANDPLEDGE_RECURRING_CONTRI', Tools::getvalue('clickandpledge_recurring_contribution'));
			if(Configuration::get('CLICKANDPLEDGE_RECURRING_CONTRI') == 'on')
			{
			Configuration::updateValue('CLICKANDPLEDGE_WEEK', Tools::getvalue('clickandpledge_week'));
			Configuration::updateValue('CLICKANDPLEDGE_2_WEEKS', Tools::getvalue('clickandpledge_2_weeks'));
			Configuration::updateValue('CLICKANDPLEDGE_MONTH', Tools::getvalue('clickandpledge_month'));
			Configuration::updateValue('CLICKANDPLEDGE_2_MONTHS', Tools::getvalue('clickandpledge_2_months'));
			Configuration::updateValue('CLICKANDPLEDGE_QUARTER', Tools::getvalue('clickandpledge_quarter'));
			Configuration::updateValue('CLICKANDPLEDGE_6_MONTHS', Tools::getvalue('clickandpledge_6_months'));
			Configuration::updateValue('CLICKANDPLEDGE_YEAR', Tools::getvalue('clickandpledge_year'));
			
			Configuration::updateValue('CLICKANDPLEDGE_INSTALLMENT', Tools::getvalue('clickandpledge_installment'));
			Configuration::updateValue('CLICKANDPLEDGE_SUBSCRIPTION', Tools::getvalue('clickandpledge_subscription'));
			Configuration::updateValue('CLICKANDPLEDGE_INDEFINITE', Tools::getvalue('clickandpledge_indefinite'));
			}
			else
			{
					//	echo Configuration::get('CLICKANDPLEDGE_RECURRING_CONTRI');exit;

			Configuration::updateValue('CLICKANDPLEDGE_WEEK', '');
			Configuration::updateValue('CLICKANDPLEDGE_2_WEEKS', '');
			Configuration::updateValue('CLICKANDPLEDGE_MONTH','');
			Configuration::updateValue('CLICKANDPLEDGE_2_MONTHS', '');
			Configuration::updateValue('CLICKANDPLEDGE_QUARTER', '');
			Configuration::updateValue('CLICKANDPLEDGE_6_MONTHS', '');
			Configuration::updateValue('CLICKANDPLEDGE_YEAR', '');
			
			Configuration::updateValue('CLICKANDPLEDGE_INSTALLMENT', '');
			Configuration::updateValue('CLICKANDPLEDGE_SUBSCRIPTION', '');
			Configuration::updateValue('CLICKANDPLEDGE_INDEFINITE', '');
			}
			
			Configuration::updateValue('CLICKANDPLEDGE_CREDITCARD', Tools::getvalue('clickandpledge_creditcard'));
			Configuration::updateValue('CLICKANDPLEDGE_CHECK', Tools::getvalue('clickandpledge_check'));
			Configuration::updateValue('CLICKANDPLEDGE_INVOICE', Tools::getvalue('clickandpledge_invoice'));
			Configuration::updateValue('CLICKANDPLEDGE_PURCH_ORD', Tools::getvalue('clickandpledge_purchas_order'));
			Configuration::updateValue('PAYMENT_METHOD_DEFAULT', Tools::getvalue('payment_method_default'));
			
			$html .= $this->displayConfirmation($this->l('Configuration updated'));
		}

		return $html .='
		<h2>'.$this->displayName.'</h2>
		<script type="text/javascript" src="../modules/'.$this->name.'/new_js.js"></script>
		<script type="text/javascript" src="../modules/'.$this->name.'/tab.js"></script>
		<link href="../modules/'.$this->name.'/tab.css" rel="stylesheet" type="text/css">
		<fieldset class="form-wrapper"><legend><img src="../modules/'.$this->name.'/logo.gif" alt="" /> '.$this->l('Help').'</legend>
			<a href="http://apply.clickandpledge.com/" style="float: right;"><img src="../modules/'.$this->name.'/logo_clickandpledge.png" alt="" target="_blank"/></a>
			<h3>'.$this->l('In your PrestaShop admin panel').'</h3>
			- '.$this->l('Fill the Account ID field with the one provided by Click & Pledge ').'<br />
			- '.$this->l('Fill the GUID field with the transaction key provided by Click & Pledge ').'<br />
			<span style="color: red;" >- '.$this->l('Warning: Your website must possess a SSL certificate to use the Click & Pledge payment system. You are responsible for the safety of your customers\' bank information. PrestaShop cannot be blamed for any security issue on your website.').'</span><br />
			<br />
		</fieldset><br />
		<form action="'.Tools::htmlentitiesutf8($_SERVER['REQUEST_URI']).'" method="post" name="clickandpledgesettings" onsubmit="return validation();">
			<fieldset>
<legend><img src="../img/admin/contact.gif" alt="" />'.$this->l('Settings').'</legend>
				<h1>Click & Pledge Account Settings</h1>
				<div id="wrapper">
					  <div id="tabContainer">
						<div id="tabs">
						  <ul>
							<li id="tabHeader_1">USD($) Account Settings</li>
							<li id="tabHeader_2">Euro(&euro;) Account Settings</li>
							<li id="tabHeader_3">Pound(&pound;) Account Settings</li>
						  </ul>
						</div>

    <div id="tabscontent">
      <div class="tabpage" id="tabpage_1">
        <h2>USD($) Account</h2>
		<table cellpadding="0" cellspacing="0"><tr><td>
				<label for="clickandpledge_login_id_us">'.$this->l('Account ID').'</label>
				<input type="text" size="155" style="height: 30px;" id="clickandpledge_login_id_us" name="clickandpledge_login_id_us" value="'.Configuration::get('CLICKANDPLEDGE_LOGIN_ID_US').'" /></td></tr><tr><td>
				<label for="clickandpledge_key_us">'.$this->l('GUID').'</label>
				<input type="text" size="155" style="height: 30px;"  id="clickandpledge_key_us" name="clickandpledge_key_us" value="'.Configuration::get('CLICKANDPLEDGE_KEY_US').'" /></td></tr><tr><td>
				<label for="clickandpledge_campaign">'.$this->l('Campaign').'</label>
				<input type="text" size="155" style="height: 30px;"  id="clickandpledge_campaign_us" name="clickandpledge_campaign_us" value="'.Configuration::get('CLICKANDPLEDGE_CAMPAIGN_US').'" />
				</td></tr><tr><td>
<label for="clickandpledge_demo_mode_us">'.$this->l('Transaction mode').'</label>
<input type="radio" name="clickandpledge_demo_mode_us" value="1" style="vertical-align: middle;" '.(Tools::getValue('clickandpledge_demo_mode_us', Configuration::get('CLICKANDPLEDGE_DEMO_US')) ? 'checked="checked"' : '').' />
					<span style="color: #080;">'.$this->l('Live transactions').'</span>
					<input type="radio" name="clickandpledge_demo_mode_us" value="0" style="vertical-align: middle;" '.(!Tools::getValue('clickandpledge_demo_mode_us', Configuration::get('CLICKANDPLEDGE_DEMO_US')) ? 'checked="checked"' : '').' />
					<span style="color: #900;">'.$this->l('Test transactions').'</span>					
					</td></tr><tr><td>
		<label for="clickandpledge_status_us">'.$this->l('Status:').'</label>
				<span style="display:block;float:left;">
				    <input type="radio" name="clickandpledge_status_us" value="1" style="vertical-align: middle;" '.(Tools::getValue('clickandpledge_status_us', Configuration::get('CLICKANDPLEDGE_STATUS_US')) ? 'checked="checked"' : '').' />
					<span style="color: #080;">'.$this->l('Enable').'</span>
					<input type="radio" name="clickandpledge_status_us" value="0" style="vertical-align: middle;" '.(!Tools::getValue('clickandpledge_status_us', Configuration::get('CLICKANDPLEDGE_STATUS_US')) ? 'checked="checked"' : '').' />
					<span style="color: #900;">'.$this->l('Disable').'</span>
	</td></tr></table>
		</div>
		
			<div class="tabpage" id="tabpage_2">
			<h2>Euro(&euro;) Account</h2>
			<table cellpadding="0" cellspacing="0"><tr><td>
				<label for="clickandpledge_login_id_euro">'.$this->l('Account ID').'</label>
				<input type="text" size="155" style="height: 30px;" id="clickandpledge_login_id_euro" name="clickandpledge_login_id_euro" value="'.Configuration::get('CLICKANDPLEDGE_LOGIN_ID_EURO').'" />
				</td></tr><tr><td>
				<label for="clickandpledge_key_euro">'.$this->l('GUID').'</label>
				<input type="text" size="155" style="height: 30px;"  id="clickandpledge_key_euro" name="clickandpledge_key_euro" value="'.Configuration::get('CLICKANDPLEDGE_KEY_EURO').'" />
				</td></tr><tr><td>
				<label for="clickandpledge_campaign_euro">'.$this->l('Campaign').'</label>
				<input type="text" size="155" style="height: 30px;"  id="clickandpledge_campaign_euro" name="clickandpledge_campaign_euro" value="'.Configuration::get('CLICKANDPLEDGE_CAMPAIGN_EURO').'" />
				</td></tr><tr><td>
				<label for="clickandpledge_demo_mode_euro">'.$this->l('Transaction mode').'</label>
<input type="radio" name="clickandpledge_demo_mode_euro" value="1" style="vertical-align: middle;" '.(Tools::getValue('clickandpledge_demo_mode_euro', Configuration::get('CLICKANDPLEDGE_DEMO_EURO')) ? 'checked="checked"' : '').' />
					<span style="color: #080;">'.$this->l('Live transactions').'</span>
					<input type="radio" name="clickandpledge_demo_mode_euro" value="0" style="vertical-align: middle;" '.(!Tools::getValue('clickandpledge_demo_mode_euro', Configuration::get('CLICKANDPLEDGE_DEMO_EURO')) ? 'checked="checked"' : '').' />
					<span style="color: #900;">'.$this->l('Test transactions').'</span>					
					</td></tr><tr><td>
		<label for="clickandpledge_status_euro">'.$this->l('Status:').'</label>
				<span style="display:block;float:left;">
				    <input type="radio" name="clickandpledge_status_euro" value="1" style="vertical-align: middle;" '.(Tools::getValue('clickandpledge_status_euro', Configuration::get('CLICKANDPLEDGE_STATUS_EURO')) ? 'checked="checked"' : '').' />
					<span style="color: #080;">'.$this->l('Enable').'</span>
					<input type="radio" name="clickandpledge_status_euro" value="0" style="vertical-align: middle;" '.(!Tools::getValue('clickandpledge_status_euro', Configuration::get('CLICKANDPLEDGE_STATUS_EURO')) ? 'checked="checked"' : '').' />
					<span style="color: #900;">'.$this->l('Disable').'</span>
		</td></tr></table>
			</div>
			
			<div class="tabpage" id="tabpage_3">
			<h2>Pound(&pound;) Account</h2>
			<table cellpadding="0" cellspacing="0"><tr><td>
				<label for="clickandpledge_login_id_pound">'.$this->l('Account ID').'</label>
				<input type="text" size="155" style="height: 30px;" id="clickandpledge_login_id_pound" name="clickandpledge_login_id_pound" value="'.Configuration::get('CLICKANDPLEDGE_LOGIN_ID_POUND').'" />
				</td></tr><tr><td>
				<label for="clickandpledge_key_pound">'.$this->l('GUID').'</label>
				<input type="text" size="155" style="height: 30px;"  id="clickandpledge_key_pound" name="clickandpledge_key_pound" value="'.Configuration::get('CLICKANDPLEDGE_KEY_POUND').'" />
				</td></tr><tr><td>
				<label for="clickandpledge_campaign_pound">'.$this->l('Campaign').'</label>
				<input type="text" size="155" style="height: 30px;"  id="clickandpledge_campaign_pound" name="clickandpledge_campaign_pound" value="'.Configuration::get('CLICKANDPLEDGE_CAMPAIGN_POUND').'" />
				</td></tr><tr><td>
<label for="clickandpledge_demo_mode_pound">'.$this->l('Transaction mode').'</label>
<input type="radio" name="clickandpledge_demo_mode_pound" value="1" style="vertical-align: middle;" '.(Tools::getValue('clickandpledge_demo_mode_pound', Configuration::get('CLICKANDPLEDGE_DEMO_POUND')) ? 'checked="checked"' : '').' />
					<span style="color: #080;">'.$this->l('Live transactions').'</span>
					<input type="radio" name="clickandpledge_demo_mode_pound" value="0" style="vertical-align: middle;" '.(!Tools::getValue('clickandpledge_demo_mode_pound', Configuration::get('CLICKANDPLEDGE_DEMO_POUND')) ? 'checked="checked"' : '').' />
					<span style="color: #900;">'.$this->l('Test transactions').'</span>					
					</td></tr><tr><td>
		<label for="clickandpledge_status_pound">'.$this->l('Status:').'</label>
				<span style="display:block;float:left;">
				    <input type="radio" name="clickandpledge_status_pound" value="1" style="vertical-align: middle;" '.(Tools::getValue('clickandpledge_status_pound', Configuration::get('CLICKANDPLEDGE_STATUS_POUND')) ? 'checked="checked"' : '').' />
					<span style="color: #080;">'.$this->l('Enable').'</span>
					<input type="radio" name="clickandpledge_status_pound" value="0" style="vertical-align: middle;" '.(!Tools::getValue('clickandpledge_status_pound', Configuration::get('CLICKANDPLEDGE_STATUS_POUND')) ? 'checked="checked"' : '').' />
					<span style="color: #900;">'.$this->l('Disable').'</span>
		</td></tr></table>
	</div>
					
				</div>
				</div>
				</div>
				
				<h3>Other Settings</h3>
			<div style="background-color:white;padding-top:10px;">	
				<label for="clickandpledge_org_info">'.$this->l('Organization Information').'</label>
				<div class="margin-form">
				<textarea rows="8" size="20" id="clickandpledge_org_info_us" name="clickandpledge_org_info_us" style="width:800px;">'.Configuration::get('CLICKANDPLEDGE_ORG_INFO_US').'</textarea></div>
<label for="clickandpledge_login_id_us">'.$this->l('Thank You Message').'</label>
				<div class="margin-form">
				<textarea col="40" rows="8" size="20" id="clickandpledge_thank_message_us" name="clickandpledge_thank_message_us" style="width:800px;">'.Configuration::get('CLICKANDPLEDGE_THANK_MESSAGE_US').'</textarea></div>				
				
				<label for="clickandpledge_login_id_us">'.$this->l('Terms & Condition').'</label>
				<div class="margin-form">
				<textarea  name="clickandpledge_terms_condition_us" col="40" rows="8" style="width:800px;">'.Configuration::get('CLICKANDPLEDGE_TERMS_CONDI_US').'</textarea></div>
				<label for="clickandpledge_login_id_us">'.$this->l('Receipt setting').'</label>
				<div class="margin-form">
					<input type="checkbox" name="clickandpledge_send_receipt_us" '.(Tools::getValue('clickandpledge_send_receipt_us', Configuration::get('CLICKANDPLEDGE_SEND_RECEIPT_US')) ? 'checked="checked"' : '').' />
					<span>(Tell Click & Pledge to e-mail the customer a receipt based on your account settings.)</span> 
</div>				
				
			
		<label for="clickandpledge_cards">'.$this->l('Payment Methods:').'</label>
		<div class="margin-form" id="clickandpledge_payment_methods">
		<table cellpadding="5" cellspacing="3" style="font-weight:bold;">
		<tr><td></td><td>Default</td>
			<tr>
				<td><input type="checkbox" id="clickandpledge_creditcard" value="Credit Card" name="clickandpledge_creditcard" '.(Tools::getValue('clickandpledge_creditcard', Configuration::get('CLICKANDPLEDGE_CREDITCARD')) ? 'checked="checked"' : '').' onclick = "block_creditcard(this.checked,echeck);" '.(Tools::getValue('payment_method_default', Configuration::get('PAYMENT_METHOD_DEFAULT')) == 'Creditcard' ? 'checked="checked" disabled="disabled"' : '').' /> Credit Card</td><td><input type="radio" name="payment_method_default" value="Creditcard" '.(Tools::getValue('payment_method_default', Configuration::get('PAYMENT_METHOD_DEFAULT')) == 'Creditcard' ? 'checked="checked"' : '').' onclick ="defalut_payment(this.value);" ></td>
			</tr>
			<tr>
				<td><input type="checkbox" value="eCheck" id="clickandpledge_check" name="clickandpledge_check" '.(Tools::getValue('clickandpledge_check', Configuration::get('CLICKANDPLEDGE_CHECK')) ? 'checked="checked"' : '').' onclick ="block_echek(this.checked);" '.(Tools::getValue('payment_method_default', Configuration::get('PAYMENT_METHOD_DEFAULT')) == 'eCheck' ? 'checked="checked" disabled="disabled"' : '').'/> eCheck</td><td><input type="radio" name="payment_method_default" value="eCheck" '.(Tools::getValue('payment_method_default', Configuration::get('PAYMENT_METHOD_DEFAULT')) == 'eCheck' ? 'checked="checked"' : '').' onclick ="defalut_payment(this.value);"></td>
			</tr>
			<tr>
				<td><input type="checkbox" value="Invoice" id="clickandpledge_invoice" name="clickandpledge_invoice" '.(Tools::getValue('clickandpledge_invoice', Configuration::get('CLICKANDPLEDGE_INVOICE')) ? 'checked="checked"' : '').' '.(Tools::getValue('payment_method_default', Configuration::get('PAYMENT_METHOD_DEFAULT')) == 'Invoice' ? 'checked="checked" disabled="disabled"' : '').'/> Invoice</td><td><input type="radio" name="payment_method_default" value="Invoice" '.(Tools::getValue('payment_method_default', Configuration::get('PAYMENT_METHOD_DEFAULT')) == 'Invoice' ? 'checked="checked"' : '').' onclick ="defalut_payment(this.value);"></td>
			</tr>
			<tr>
				<td><input type="checkbox" value="Purchase Order" id="clickandpledge_purchas_order" name="clickandpledge_purchas_order" '.(Tools::getValue('clickandpledge_purchas_order', Configuration::get('CLICKANDPLEDGE_PURCH_ORD')) ? 'checked="checked"' : '').' '.(Tools::getValue('payment_method_default', Configuration::get('PAYMENT_METHOD_DEFAULT')) == 'PurchaseOrder' ? 'checked="checked" disabled="disabled"' : '').'/> Purchase Order</td><td><input type="radio" name="payment_method_default" value="PurchaseOrder" '.(Tools::getValue('payment_method_default', Configuration::get('PAYMENT_METHOD_DEFAULT')) == 'PurchaseOrder' ? 'checked="checked"' : '').' onclick ="defalut_payment(this.value);"></td>
			</tr>
		</table>
		</div>
		
		<div id="myDiv3"style="display:none">
		<label for="clickandpledge_recurring_contribution">'.$this->l('Recurring contributions').'</label>
		<div class="margin-form">
		<input type="checkbox" name="clickandpledge_recurring_contribution" '.(Tools::getValue('clickandpledge_recurring_contribution', Configuration::get('CLICKANDPLEDGE_RECURRING_CONTRI')) ? 'checked="checked"' : '').' onclick =block_recurring(this.checked); /> (Supported for Credit card and eCheck)
		<div id="myDiv" style="display:none"><b><h1>Supported recurring periodicity</h1></b>
		<table cellpadding="5" cellspacing="3" style="font-weight:bold;">
		<tr>
		<td><input type="checkbox" value="Week" name="clickandpledge_week" '.(Configuration::get('CLICKANDPLEDGE_WEEK') ? 'checked="checked"' : '').'/> Week</td>
		<td><input type="checkbox" value="2 Weeks" name="clickandpledge_2_weeks" '.(Configuration::get('CLICKANDPLEDGE_2_WEEKS') ? 'checked="checked"' : '').'/> 2 Weeks </td>
		<td><input type="checkbox" value="Month" name="clickandpledge_month" '.(Configuration::get('CLICKANDPLEDGE_MONTH') ? 'checked="checked"' : '').'/> Month</td>
		<td><input type="checkbox" value="2 Months" name="clickandpledge_2_months" '.(Configuration::get('CLICKANDPLEDGE_2_MONTHS') ? 'checked="checked"' : '').'/> 2 Months</td>
		<td><input type="checkbox" value="Quarter" name="clickandpledge_quarter" '.(Configuration::get('CLICKANDPLEDGE_QUARTER') ? 'checked="checked"' : '').'/> Quarter</td>
		<td><input type="checkbox" value="6 Months" name="clickandpledge_6_months" '.(Configuration::get('CLICKANDPLEDGE_6_MONTHS') ? 'checked="checked"' : '').'/> 6 Months</td>
		<td><input type="checkbox" value="Year" name="clickandpledge_year" '.(Configuration::get('CLICKANDPLEDGE_YEAR') ? 'checked="checked"' : '').'/> Year</td>
		</tr>
		</table>
		<b><h1>Recurring Method</h1></b>
		<table cellpadding="5" cellspacing="3" style="font-weight:bold;">
			<tr><td><input type="checkbox" value="Installment" name="clickandpledge_installment" '.(Configuration::get('CLICKANDPLEDGE_INSTALLMENT') ? 'checked="checked"' : '').'/> Installment (example: Split $1000 into 10 payments of $100 each)</td></tr>
			<tr><td><input type="checkbox" value="Subscription" name="clickandpledge_subscription" '.(Configuration::get('CLICKANDPLEDGE_SUBSCRIPTION') ? 'checked="checked"' : '').' onclick =block_subscription(this.checked); /> Subscription (example: Pay $10 every month for 20 times) </td></tr>
		</table>
		<div id="myDiv1"style="display:none">
		<b><h1>Enable Indefinite Recurring </h1></b>
		<input type="checkbox" value="999" name="clickandpledge_indefinite" '.(Configuration::get('CLICKANDPLEDGE_INDEFINITE') ? 'checked="checked"' : '').'/> Indefinite (~)<span style="color: #080;"> optional</span>
		</div>
		</div>
		</div>
		</div>
		</div>
		
		
				<br /><center><input type="submit" name="submitModule" value="'.$this->l('Update settings').'" class="button" /></center>
			</fieldset>
		</form>
		<script>
		var creditcard = document.clickandpledgesettings.clickandpledge_creditcard.checked;
		var echeck = document.clickandpledgesettings.clickandpledge_check.checked;
		function defalut_payment(mess)
		{
		 if(mess == "Creditcard")
		 {
		   document.getElementById("clickandpledge_creditcard").checked = true;
		   document.getElementById("clickandpledge_creditcard").disabled = true;
		   
		   document.getElementById("clickandpledge_check").disabled=false;
		   document.getElementById("clickandpledge_invoice").disabled=false;
		   document.getElementById("clickandpledge_purchas_order").disabled=false;
		 }
		 if(mess == "eCheck")
		 {
		   document.getElementById("clickandpledge_check").checked = true;
		   document.getElementById("clickandpledge_check").disabled=true;
		   
		   document.getElementById("clickandpledge_creditcard").disabled=false;
		   document.getElementById("clickandpledge_invoice").disabled=false;
		   document.getElementById("clickandpledge_purchas_order").disabled=false;
		 }
		 
		 if(mess == "Invoice")
		 {
		   document.getElementById("clickandpledge_invoice").checked = true;
		   document.getElementById("clickandpledge_invoice").disabled=true;
		   
		   document.getElementById("clickandpledge_check").disabled=false;
		   document.getElementById("clickandpledge_creditcard").disabled=false;
		   document.getElementById("clickandpledge_purchas_order").disabled=false;
		 }
		 if(mess == "PurchaseOrder")
		 {
		   document.getElementById("clickandpledge_purchas_order").checked = true;
		   document.getElementById("clickandpledge_purchas_order").disabled=true;
		   
		   document.getElementById("clickandpledge_creditcard").disabled=false;
		   document.getElementById("clickandpledge_invoice").disabled=false;
		   document.getElementById("clickandpledge_check").disabled=false;
		 }
		}
		
		if(creditcard || echeck)
		{
				document.getElementById("myDiv3").style.display="block";
		}
		if(document.clickandpledgesettings.clickandpledge_recurring_contribution.checked)
		{
		block_recurring(document.clickandpledgesettings.clickandpledge_recurring_contribution.checked)
		}
		if(document.clickandpledgesettings.clickandpledge_subscription.checked)
		{
		block_subscription(document.clickandpledgesettings.clickandpledge_subscription.checked)
		}
		if(document.clickandpledgesettings.clickandpledge_creditcard.checked)
		{
		block_creditcard(document.clickandpledgesettings.clickandpledge_creditcard.checked)
		}
		function validation()
		{
			var guid = document.clickandpledgesettings.clickandpledge_key_us.value.trim();
			var account = document.clickandpledgesettings.clickandpledge_login_id_us.value.trim();
			
			var recurring_contribution = document.clickandpledgesettings.clickandpledge_recurring_contribution.checked;

			var week = document.clickandpledgesettings.clickandpledge_week.checked;
			var week2 = document.clickandpledgesettings.clickandpledge_2_weeks.checked;
			var month = document.clickandpledgesettings.clickandpledge_month.checked;
			var months2 = document.clickandpledgesettings.clickandpledge_2_months.checked;
			var quarter = document.clickandpledgesettings.clickandpledge_quarter.checked;
			var months6 = document.clickandpledgesettings.clickandpledge_6_months.checked;
			var year = document.clickandpledgesettings.clickandpledge_year.checked;

			var recurring_installment = document.clickandpledgesettings.clickandpledge_installment.checked;
			var recurring_subscription = document.clickandpledgesettings.clickandpledge_subscription.checked;
			
			var creditcard = document.clickandpledgesettings.clickandpledge_creditcard.checked;
			var echeck = document.clickandpledgesettings.clickandpledge_check.checked;
			var invoice = document.clickandpledgesettings.clickandpledge_invoice.checked;
			var purchaseorder = document.clickandpledgesettings.clickandpledge_purchas_order.checked;
			var status = document.clickandpledgesettings.clickandpledge_status_us[0].checked;
			var status_euro = document.clickandpledgesettings.clickandpledge_status_euro[0].checked;
			var status_pound = document.clickandpledgesettings.clickandpledge_status_pound[0].checked;
			
			if(recurring_contribution)
			{
			if(!week && !week2 && !month && !months2 && !quarter && !months6 && !year)
			{
			alert("Select at least one recurring period");
			return false;
			}
			}
			if(recurring_contribution && (week || week2 || month || months2 || quarter || months6 || year))
			{
				if(!recurring_installment && !recurring_subscription)
				{
				alert("Select at least one recurring method");
				return false;
				}
			
			}

			if(((!creditcard && !echeck && !invoice && !purchaseorder) && status) || ((!creditcard && !echeck && !invoice && !purchaseorder) && status_euro) || ((!creditcard && !echeck && !invoice && !purchaseorder) && status_pound))
			{
				alert("Select at least one payment method");
				return false;
			}
		}
		</script>';
	}
		
		public function floor_dec($number,$precision,$separator)
		{
		$numberpart=explode($separator,$number);
		$ceil_number= array($numberpart[0],substr($numberpart[1],0,2));
		return implode($separator,$ceil_number);
		}

	public function set_out()
	{
	$new_html ='d';
	return $new_html;
	}
	
	public function hookPayment($params)
	{
		global $cookie, $smarty;
		
//		$currency_order = new Currency($cookie->id_currency);
     	$currency = Currency::getCurrencyInstance($this->context->cookie->id_currency);
		$iso_code_num = $currency->iso_code_num;

		if(Configuration::get('CLICKANDPLEDGE_STATUS_US') && $iso_code_num == 840 && Configuration::get('CLICKANDPLEDGE_LOGIN_ID_US') != '' && Configuration::get('CLICKANDPLEDGE_KEY_US') != '')
		{
		    $displaystatus = true;
			$login_id =  Configuration::get('CLICKANDPLEDGE_LOGIN_ID_US');
			$login_key =  Configuration::get('CLICKANDPLEDGE_KEY_US');
			$app_campaign = Configuration::get('CLICKANDPLEDGE_CAMPAIGN_US');
			$mode = Configuration::get('CLICKANDPLEDGE_DEMO_US') == 1 ? 'Production' : 'Test';
			
		}
		else if(Configuration::get('CLICKANDPLEDGE_STATUS_EURO') && $iso_code_num == 978 && Configuration::get('CLICKANDPLEDGE_LOGIN_ID_EURO') != '' && Configuration::get('CLICKANDPLEDGE_KEY_EURO') != '')
		{
		    $displaystatus = true;
			$login_id =  Configuration::get('CLICKANDPLEDGE_LOGIN_ID_EURO');
			$login_key =  Configuration::get('CLICKANDPLEDGE_KEY_EURO');
			$app_campaign = Configuration::get('CLICKANDPLEDGE_CAMPAIGN_EURO');
			$mode = Configuration::get('CLICKANDPLEDGE_DEMO_EURO')==1 ? 'Production' : 'Test';
		}
		else if(Configuration::get('CLICKANDPLEDGE_STATUS_POUND') && $iso_code_num == 826 && Configuration::get('CLICKANDPLEDGE_LOGIN_ID_POUND') != '' && Configuration::get('CLICKANDPLEDGE_KEY_POUND') != '')
		{
		    $displaystatus = true;
			$login_id =  Configuration::get('CLICKANDPLEDGE_LOGIN_ID_POUND');
			$login_key =  Configuration::get('CLICKANDPLEDGE_KEY_POUND');
			$app_campaign = Configuration::get('CLICKANDPLEDGE_CAMPAIGN_POUND');
			$mode = Configuration::get('CLICKANDPLEDGE_DEMO_POUND')==1 ? 'Production' : 'Test';
		}
		else{
		    $displaystatus = false;
		}
			
			$org_info =  Configuration::get('CLICKANDPLEDGE_ORG_INFO_US');
			$thankyou_message = Configuration::get('CLICKANDPLEDGE_THANK_MESSAGE_US');
			$terms_condition = Configuration::get('CLICKANDPLEDGE_TERMS_CONDI_US');
			$send_recepit = Configuration::get('CLICKANDPLEDGE_SEND_RECEIPT_US') == 1 ? 'yes' : 'no';
			$defalut_payment = Configuration::get('PAYMENT_METHOD_DEFAULT');
			$recurring = Configuration::get('CLICKANDPLEDGE_RECURRING_CONTRI')== 'on' ? 'yes' : 'no';
			$week =  Configuration::get('CLICKANDPLEDGE_WEEK');
			$week2 =  Configuration::get('CLICKANDPLEDGE_2_WEEKS');
			$month =  Configuration::get('CLICKANDPLEDGE_MONTH');
			$months2 =  Configuration::get('CLICKANDPLEDGE_2_MONTHS');
			$quarter =  Configuration::get('CLICKANDPLEDGE_QUARTER');
			$months6 =  Configuration::get('CLICKANDPLEDGE_6_MONTHS');
			$year =  Configuration::get('CLICKANDPLEDGE_YEAR');
			$recurring_installment = Configuration::get('CLICKANDPLEDGE_INSTALLMENT');
			$recurring_subscription = Configuration::get('CLICKANDPLEDGE_SUBSCRIPTION');
			$subscription_indefinite = Configuration::get('CLICKANDPLEDGE_INDEFINITE');
			
			$creditcard = $defalut_payment == 'Creditcard' ? 'Creditcard' : Configuration::get('CLICKANDPLEDGE_CREDITCARD');
			$check = $defalut_payment == 'eCheck' ? 'eCheck' : Configuration::get('CLICKANDPLEDGE_CHECK');
			$invoice = $defalut_payment == 'Invoice' ? 'Invoice' : Configuration::get('CLICKANDPLEDGE_INVOICE');
			$purchaseorder = $defalut_payment == 'PurchaseOrder' ? 'PurchaseOrder' : Configuration::get('CLICKANDPLEDGE_PURCH_ORD');
			
		    //shipping address
		    $invoiceAddress = new Address((int)$params['cart']->id_address_delivery);
			
			//billing address
		    $billingAddress = new Address((int)$params['cart']->id_address_invoice);
			$customer = new Customer((int)$cookie->id_customer);
			$shipping_method = new Carrier((int)$params['cart']->id_carrier);
			
			$oldMessage = new Message();
			
			$getmesdetails =$oldMessage->getMessageByCartId((int)$params['cart']->id);
			//MessageCore::getMessageByCartId(intval($params['cart']->id));
			
			$shipping_method_name = $shipping_method->name;
			$Totaltax = (float)($params['cart']->getOrderTotal(true, Cart::BOTH) - $params['cart']->getOrderTotal(false, Cart::BOTH));
			$productamount = $params['cart']->getOrderTotal(false, Cart::BOTH);
			$finalamount = $params['cart']->getOrderTotal(true, Cart::BOTH);			
			
			$cnpParams = array();
			$cnpParams['x_login'] = $login_id;
			$cnpParams['x_tran_key'] = $login_key;
			$cnpParams['x_org_info'] = $org_info;
			$cnpParams['x_app_campaign'] = $app_campaign; 
			$cnpParams['x_send_recepit'] = $send_recepit;
			$cnpParams['x_terms_condition'] = $terms_condition;
			$cnpParams['x_thankyou_message'] = $thankyou_message;

			//$cnpParams['x_currency'] = $cookie->id_currency;
			$cnpParams['x_currency_code'] = $iso_code_num;
			
			$cnpParams['x_version'] = '2.0';
			$cnpParams['x_delim_data'] = 'TRUE';
			$cnpParams['x_delim_char'] = '|';
			$cnpParams['x_relay_response'] = 'FALSE';
			$cnpParams['x_type'] = 'AUTH_CAPTURE';
			//$cnpParams['x_method'] = 'CC';
			$cnpParams['x_test_request'] = $mode;
			$cnpParams['x_invoice_num'] = (int)$params['cart']->id;
			$cnpParams['x_amount'] = number_format($params['cart']->getOrderTotal(true, 3), 2, '.', '');
			$cnpParams['x_address1'] = $invoiceAddress->address1;
			$cnpParams['x_address2'] = $invoiceAddress->address2;
			$cnpParams['x_zip'] = $invoiceAddress->postcode;
			$cnpParams['customer_gender'] = $customer->id_gender;
			$cnpParams['x_first_name'] = $customer->firstname;
			$cnpParams['x_last_name'] = $customer->lastname;
			$cnpParams['x_email'] = $customer->email;
			$cnpParams['customer_birthday'] = $customer->birthday;
			$cnpParams['x_gift'] = $params['cart']->gift;
			$cnpParams['x_gift_message'] = "";	
			$cnpParams['x_comment_message'] = $getmesdetails['message'];				
			$cnpParams['x_phone'] = (!empty($invoiceAddress->phone_mobile)) ? $invoiceAddress->phone_mobile : $invoiceAddress->phone;
			$cnpParams['x_city'] = $invoiceAddress->city;
			$cnpParams['x_state'] = State::getNameById($invoiceAddress->id_state);
			$cnpParams['x_country'] = $invoiceAddress->id_country;
			$cnpParams['x_total_product'] = $params['cart']->nbProducts();
			
			if($cnpParams['x_state']==""){
			$cnpParams['x_state']="States Not Available";
			
			}
			if($cnpParams['x_gift']==1){			
				$cnpParams['x_gift_message'] = $params['cart']->gift_message;
			}else{
				$cnpParams['x_gift_message'] = "Not selected";
			}
			
			// billing information
			$cnpParams['x_b_address1'] = $billingAddress->address1;
			$cnpParams['x_b_address2'] = $billingAddress->address2;
			$cnpParams['x_b_zip'] = $billingAddress->postcode;
			$cnpParams['x_b_first_name'] = $billingAddress->firstname;
			$cnpParams['x_b_last_name'] = $billingAddress->lastname;
			$cnpParams['x_b_company'] = $billingAddress->company;
			$cnpParams['x_b_add_info'] = $billingAddress->other;
			$cnpParams['x_b_phone_home'] = $billingAddress->phone;
			$cnpParams['x_b_phone'] = (!empty($billingAddress->phone_mobile)) ? $billingAddress->phone_mobile : $billingAddress->phone;
			$cnpParams['x_b_city'] = $billingAddress->city;
			$cnpParams['x_b_state'] = State::getNameById($billingAddress->id_state);
			$cnpParams['x_b_country'] = $billingAddress->id_country;
			$cnpParams['x_shipping_method'] = $shipping_method_name;
			if($cnpParams['x_b_state']==""){
			$cnpParams['x_b_state']="States Not Available";
			
			}
			
			//shipping contact information
			$cnpParams['x_s_first_name'] = $invoiceAddress->firstname;
			$cnpParams['x_s_last_name'] = $invoiceAddress->lastname;
			$cnpParams['x_s_company'] = $invoiceAddress->company;
			$cnpParams['x_s_add_info'] = $invoiceAddress->other;
			$cnpParams['x_s_phone_home'] = $invoiceAddress->phone;
			$cnpParams['x_s_phone'] = (!empty($invoiceAddress->phone_mobile)) ? $invoiceAddress->phone_mobile : $invoiceAddress->phone;
			//echo "<pre>";
			//print_r($params);
			
			$val=$params['cart']->getProducts();
			$applyAllRules = new SpecificPrice();
			
		    $currency = Currency::getCurrency((int)$params['cart']->id_currency);
			$sign = $currency['sign'];
			
			$taxCalculationMethod = Group::getPriceDisplayMethod((int)$customer->id_default_group);
			$useTax = !($taxCalculationMethod == PS_TAX_EXC);
			
			$shipping=Tools::displayPrice($params['cart']->getOrderTotal($useTax, Cart::ONLY_SHIPPING), $currency);
			
			$cr=array($sign,",","-");
			 			
			$shipping_cost=str_replace($cr,'',$shipping);
			$cnpParams['x_shipping_cost']=$shipping_cost;
			
			$discount = $params['cart']->getDiscounts();
			//echo "<pre>";
			//print_r($discount);
			$coupon_code = '';
			$coupon_discount = 000;
			if(!empty($discount))
			{
				// $coupon_code = $discount[0]['name'];
				for($i=0;$i < count($discount);$i++)
				{
				 $coupon_code .= $discount[$i]['code'].',';
				 
				 $coupon_discount = number_format(str_replace($cr,'',$discount[$i]['value_tax_exc']),'2','.','') + $coupon_discount;
				 }
			}
			//echo $coupon_discount;
			//			exit;

			$cnpParams['x_coupon_code'] = substr($coupon_code,0,-1);
			$cnpParams['x_coupon_discount'] = $coupon_discount;
			$cnpParams['x_total_tax'] = $Totaltax;
			$cnpParams['x_final_amount'] = $finalamount;
			
			for($i=0;$i<count($val);$i++)
			{
				$myprod = new Product($val[$i]['id_product']);
				$features = $myprod->getFrontFeatures($val[$i]['id_product']);
				
				//$getDefaultAttribute = $myprod->getDefaultAttribute(1);
				//print_r($getDefaultAttribute);exit;
				
				$getFeature = new Feature();
				$ff = $getFeature->getFeature(1,6);
				
				$pid = $val[$i]['id_product'];
				
				 if(count($features) > 0)
				 {
				 foreach($features as $new_few)
				 {
				 $fid =  $new_few['id_feature'];
			
				 
		$rq = Db::getInstance()->getRow('SELECT * FROM `'._DB_PREFIX_.'feature_product` WHERE id_feature ='.$fid.' AND  id_product ='.$pid.'');
		if(count($rq) > 0)
		{
		$new_fid = $rq['id_feature'];
		$new_fid_val = $rq['id_feature_value'];
		$feacture_name = Db::getInstance()->getRow('SELECT * FROM `'._DB_PREFIX_.'feature_lang` WHERE id_feature ='.$new_fid.' AND  name in("SKU","Campaign") and id_lang =1');
		if(count($feacture_name) > 0)
		{
		$feacture_value = Db::getInstance()->getRow('SELECT * FROM `'._DB_PREFIX_.'feature_value_lang` WHERE id_feature_value ='.$new_fid_val.' and id_lang =1');
			if($feacture_name['name'] == 'SKU')
			{
			$cnpParams['x_product_sku['.$i.']'] = $feacture_value['value'];
			}
			if($feacture_name['name'] == 'Campaign')
			{
			$cnpParams['x_product_campaign['.$i.']'] = $feacture_value['value'];
			 }
		}	
		}
				
				}
				
				}
				//echo "<pre>";
			//	print_r($params['cart']);
				
				$nn = $applyAllRules->getSpecificPrice($val[$i]['id_product'],$params['cart']->id_shop,$cookie->id_currency,$cookie->id_country,0,1,null,0,0,1);
			//	print_r($nn);
				if(is_array($nn))
				{
					if($nn['reduction_type'] == 'percentage')
						{
				//$cnpParams['x_product_price['.$i.']'] = Tools::ps_round($myprod->price + $val[$i]['price_attribute'],2);
				$cnpParams['x_product_price_unitdiscount['.$i.']'] = Tools::ps_round($myprod->price + $val[$i]['price_attribute'],2) * $nn['reduction'];
						          
						//echo "wait".$cal_pro;
						}else{
				//$cnpParams['x_product_price['.$i.']'] = Tools::ps_round($myprod->price + $val[$i]['price_attribute'],2);
				$cnpParams['x_product_price_unitdiscount['.$i.']'] = Tools::ps_round($myprod->price + $val[$i]['price_attribute'],2) - $nn['reduction'];
						}
				}
		//	exit;
				 $cnpParams['x_product_price['.$i.']'] = Tools::ps_round($myprod->price + $val[$i]['price_attribute'],2);
			     $cnpParams['x_product_id['.$i.']'] = $val[$i]['id_product'];
				 $cnpParams['x_product_unique_id['.$i.']'] = $val[$i]['unique_id'];
			     $cnpParams['x_product_name['.$i.']'] = $val[$i]['name'];
				 $cnpParams['x_product_quantity['.$i.']'] = $val[$i]['cart_quantity'];
				// $cnpParams['x_product_price['.$i.']'] = $val[$i]['price'];
				 $cnpParams['x_product_tax['.$i.']'] = number_format($val[$i]['ecotax'],'2','.','');
				// echo $val[$i]['price_attribute'];exit;
				 $cnpParams['x_selected_attribute_price['.$i.']'] = $val[$i]['price_attribute'];
				// $cnpParams['x_product_price_unitdiscount['.$i.']'] = number_format((($myprod->price +  $cnpParams['x_selected_attribute_price['.$i.']']) - $cnpParams['x_product_price['.$i.']']),'2','.','');
				 $cnpParams['x_product_attributes_name['.$i.']'] = $val[$i]['attributes'];
				 
			}
			$isFailed = Tools::getValue('aimerror');

			$cards = array();
			$recurring_units = array();
			$recurring_method = array();
			
			if($creditcard != '')$cards['Creditcard'] = $creditcard;
			if($check != '')$cards['eCheck'] = $check;
			if($invoice != '')$cards['Invoice'] = $invoice;
			if($purchaseorder != '')$cards['PurchaseOrder'] = $purchaseorder;
			
			if($recurring == 'yes')
			{
			if($week != '')$recurring_units['Week'] = $week;
			if($week2 != '')$recurring_units['Weeks2'] = $week2;
			if($month != '')$recurring_units['Month'] = $month;
			if($months2 != '')$recurring_units['Months2'] = $months2;
			if($quarter != '')$recurring_units['Quarter'] = $quarter;
			if($months6 != '')$recurring_units['Months6'] = $months6;
			if($year != '')$recurring_units['Year'] = $year;
			
			if($recurring_installment != '')$recurring_method['installment'] = $recurring_installment;
			if($recurring_subscription != '')
				{
				
				$recurring_method['subscription'] = $recurring_subscription;
				if($subscription_indefinite != '')$indefinite = $subscription_indefinite;
				
				}
			}
		
			$smarty->assign('p', $cnpParams);			
			$smarty->assign('cards', $cards);
			$smarty->assign('recurring', $recurring);
			$smarty->assign('recurring_units', $recurring_units);
			$smarty->assign('recurring_method', $recurring_method);
			$smarty->assign('indefinite', $indefinite);
			$smarty->assign('isFailed', $isFailed);
			$smarty->assign('defalut_payment', $defalut_payment);
			if($displaystatus)
			{
               return $this->display(__FILE__, 'clickandpledge.tpl');
			}
		//}
    }
}
?>