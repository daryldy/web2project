<?php /* $Id$ $URL$ */
if (!defined('W2P_BASE_DIR')) {
	die('You should not access this file directly');
}

require_once W2P_BASE_DIR . '/modules/admin/admin.class.php';
require_once W2P_BASE_DIR . '/modules/system/roles/roles.class.php';
require_once W2P_BASE_DIR . '/style/' . $uistyle . '/overrides.php';
require_once W2P_BASE_DIR . '/lib/captcha/Captcha.class.php';
require_once W2P_BASE_DIR . '/lib/captcha/Functions.php';
/*
Re-Generating variables for html form...
*/

$rnd = strtoupper(rnd_string());
$uid = urlencode(md5_encrypt($rnd));
$cid = md5_encrypt($rnd);

?>
<script language="javascript">
function submitIt(){
    var form = document.editFrm;
   if (form.user_username.value.length < <?php echo w2PgetConfig('username_min_len'); ?>) {
        alert("<?php echo $AppUI->_('Username size is invalid, should be greater than', UI_OUTPUT_JS); ?>" + ' ' + <?php echo w2PgetConfig('username_min_len'); ?>);
        form.user_username.focus();
    } else if (form.user_password.value.length < <?php echo w2PgetConfig('password_min_len'); ?>) {
        alert("<?php echo $AppUI->_('Password size is invalid, should be greater than', UI_OUTPUT_JS); ?>" + ' ' + <?php echo w2PgetConfig('password_min_len'); ?>);
        form.user_password.focus();
    } else if (form.user_password.value !=  form.password_check.value) {
        alert("<?php echo $AppUI->_('Password confirmation failed', UI_OUTPUT_JS); ?>");
        form.user_password.focus();
    } else if (form.contact_first_name.value.length < 1) {
        alert("<?php echo $AppUI->_('First name is invalid', UI_OUTPUT_JS); ?>");
        form.contact_first_name.focus();
    } else if (form.contact_last_name.value.length < 1) {
        alert("<?php echo $AppUI->_('Last name is invalid', UI_OUTPUT_JS); ?>");
        form.contact_last_name.focus();
    } else if (form.contact_email.value.length < 4) {
        alert("<?php echo $AppUI->_('Email is invalid', UI_OUTPUT_JS); ?>");
        form.contact_email.focus();
	} else if (form.spam_check.value.length < 1 ) {
        alert("<?php echo $AppUI->_('Anti Spam Security is invalid', UI_OUTPUT_JS); ?>");
    } else {
        form.submit();
    }
}
</script>
<table width="100%" cellspacing="0" cellpadding="0" border="0">
	<tr>
		<td width="508"><a href="http://www.web2project.net"><img border="0" alt="web2Project Home" src="./style/<?php echo $uistyle; ?>/images/w2p_logo.jpg"/></a></td>
		<td style="background: url(./style/<?php echo $uistyle; ?>/images/logo_bkgd.jpg)">&nbsp;</td>
	</tr>
</table>
<table width="100%" cellspacing="0" cellpadding="0" border="0">
	<tr>
		<td valign="top" style="background: url(./style/<?php echo $uistyle; ?>/images/nav_shadow.jpg)" align="left">
			<img width="1" height="13" border="0" src="./style/<?php echo $uistyle; ?>/images/nav_shadow.jpg" alt=""/>
		</td>
	</tr>
</table>
<table align="center" border="0" width="700" cellpadding="0" cellspacing="0" class="">
	<tr>
		<td style="padding-top:10px;padding-bottom:10px;" align="left" valign="top" class="txt"><h1>New Signup to web2Project!</h1>
		Please enter the info below to create a new signup.</td>
	</tr>
</table>
<form name="editFrm" action="./do_user_aed.php" method="post" accept-charset="utf-8">
	<input type="hidden" name="user_id" value="0" />
	<input type="hidden" name="contact_id" value="0" />
	<input type="hidden" name="username_min_len" value="<?php echo w2PgetConfig('username_min_len'); ?>)" />
	<input type="hidden" name="password_min_len" value="<?php echo w2PgetConfig('password_min_len'); ?>)" />
	<input type="hidden" name="cid" value="<?php echo $cid ?>" />

    <table style="border-style:none;" align="center" border="0" width="700" cellpadding="0" cellspacing="0" class="std">
		<tr><td colspan="5"><?php echo styleRenderBoxTop(); ?></td></tr>
		<tr>
            <td align="right" width="230">* <?php echo $AppUI->_('Login Name'); ?>:</td>
            <td colspan="2">
                <input type="text" class="text" name="user_username" value="" maxlength="255" size="40" />
            </td>
            <td class="right-brdr"><img src="./style/<?php echo $uistyle; ?>/images/shim.gif" width="1" height="1" /></td>
		</tr>
		<tr>
            <td align="right">* <?php echo $AppUI->_('Password'); ?>:</td>
            <td colspan="2"><input type="password" class="text" name="user_password" value="" maxlength="32" size="32" /> </td>
		</tr>
		<tr>
            <td align="right">* <?php echo $AppUI->_('Confirm Password'); ?>:</td>
            <td colspan="2"><input type="password" class="text" name="password_check" value="" maxlength="32" size="32" /> </td>
		</tr>
        <tr>
            <td align="right">* <?php echo $AppUI->_('Name'); ?>:</td>
            <td colspan="2">
                <input type="text" class="text" name="contact_first_name" value="" maxlength="25" />
                <input type="text" class="text" name="contact_last_name" value="" maxlength="25" />
            </td>
        </tr>
        <tr>
            <td align="right">* <?php echo $AppUI->_('Email'); ?>:</td>
            <td colspan="2"><input type="text" class="text" name="contact_email" value="" maxlength="255" size="40" /> </td>
        </tr>
        <tr>
            <td align="right"><?php echo $AppUI->_('Phone'); ?>:</td>
            <td colspan="2"><input type="text" class="text" name="contact_phone" value="" maxlength="50" size="40" /> </td>
        </tr>
        <tr>
            <td align="right"><?php echo $AppUI->_('Address'); ?>1:</td>
            <td colspan="2"><input type="text" class="text" name="contact_address1" value="" maxlength="50" size="40" /> </td>
        </tr>
        <tr>
            <td align="right"><?php echo $AppUI->_('Address'); ?>2:</td>
            <td colspan="2"><input type="text" class="text" name="contact_address2" value="" maxlength="50" size="40" /> </td>
        </tr>
        <tr>
            <td align="right"><?php echo $AppUI->_('City'); ?>:</td>
            <td colspan="2"><input type="text" class="text" name="contact_city" value="" maxlength="50" size="40" /> </td>
        </tr>
        <tr>
            <td align="right"><?php echo $AppUI->_('State'); ?>:</td>
            <td colspan="2"><input type="text" class="text" name="contact_state" value="" maxlength="50" size="40" /> </td>
        </tr>
        <tr>
            <td align="right"><?php echo $AppUI->_('Postcode') . ' / ' . $AppUI->_('Zip Code'); ?>:</td>
            <td colspan="2"><input type="text" class="text" name="contact_zip" value="" maxlength="50" size="40" /> </td>
        </tr>
		<tr>
			<td align="right"><?php echo $AppUI->_('Country'); ?>:</td>
			<td colspan="2">
                <?php
                    $countries = array('' => $AppUI->_('(Select a Country)')) + w2PgetSysVal('GlobalCountries');
                    echo arraySelect($countries, 'contact_country', 'size="1" class="text"', 0);
                ?>
			</td>
		</tr>
		<tr>
			<td valign="middle" align="right">* <?php echo $AppUI->_('Anti Spam Security'); ?>:</td>
			<td valign="middle" width="50"><input type="text" class="text" id="spam" name="spam_check" value="" maxlength="5" size="5" /></td>
			<td valign="middle" align="left"><img src="<?php echo W2P_BASE_URL; ?>/lib/captcha/CaptchaImage.php?uid=54;<?php echo $uid; ?>" alt="" /></td>
		</tr>
		<tr>
            <td align="right">* <?php echo $AppUI->_('Required Fields'); ?></td>
            <td colspan="2"></td>
		</tr>
		<tr>
		  <td align="left">
				&nbsp;<input type="button" value="<?php echo $AppUI->_('cancel'); ?>" onclick="history.go(-1)" class="button" />
		  </td>
		  <td colspan="2" align="right">
				<input type="button" value="<?php echo $AppUI->_('sign me up!'); ?>" onclick="submitIt()" class="button" />&nbsp;
		  </td>
		</tr>
		<tr><td colspan="5"><?php echo styleRenderBoxBottom(); ?></td></tr>
	</table>
</form>