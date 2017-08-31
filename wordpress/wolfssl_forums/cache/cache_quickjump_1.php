<?php

if (!defined('FORUM')) exit;
define('FORUM_QJ_LOADED', 1);
$forum_id = isset($forum_id) ? $forum_id : 0;

?><form id="qjump" method="get" accept-charset="utf-8" action="https://www.wolfssl.com/forums/viewforum.php">
	<div class="frm-fld frm-select">
		<label for="qjump-select"><span><?php echo $lang_common['Jump to'] ?></span></label><br />
		<span class="frm-input"><select id="qjump-select" name="id">
			<optgroup label="General">
				<option value="6"<?php echo ($forum_id == 6) ? ' selected="selected"' : '' ?>>Announcements</option>
				<option value="5"<?php echo ($forum_id == 5) ? ' selected="selected"' : '' ?>>General Inquiries</option>
			</optgroup>
			<optgroup label="Product Support Forums">
				<option value="3"<?php echo ($forum_id == 3) ? ' selected="selected"' : '' ?>>wolfSSL (formerly CyaSSL)</option>
				<option value="7"<?php echo ($forum_id == 7) ? ' selected="selected"' : '' ?>>wolfCrypt</option>
				<option value="8"<?php echo ($forum_id == 8) ? ' selected="selected"' : '' ?>>wolfMQTT</option>
				<option value="2"<?php echo ($forum_id == 2) ? ' selected="selected"' : '' ?>>yaSSL (Deprecated) [READ ONLY]</option>
				<option value="4"<?php echo ($forum_id == 4) ? ' selected="selected"' : '' ?>>yaSSL Embedded Web Server [READ ONLY]</option>
			</optgroup>
		</select>
		<input type="submit" id="qjump-submit" value="<?php echo $lang_common['Go'] ?>" /></span>
	</div>
</form>
<?php

$forum_javascript_quickjump_code = <<<EOL
(function () {
	var forum_quickjump_url = "https://www.wolfssl.com/forums/forum$1-$2.html";
	var sef_friendly_url_array = new Array(7);
	sef_friendly_url_array[6] = "announcements";
	sef_friendly_url_array[5] = "general-inquiries";
	sef_friendly_url_array[3] = "wolfssl-formerly-cyassl";
	sef_friendly_url_array[7] = "wolfcrypt";
	sef_friendly_url_array[8] = "wolfmqtt";
	sef_friendly_url_array[2] = "yassl-deprecated-read-only";
	sef_friendly_url_array[4] = "yassl-embedded-web-server-read-only";

	PUNBB.common.addDOMReadyEvent(function () { PUNBB.common.attachQuickjumpRedirect(forum_quickjump_url, sef_friendly_url_array); });
}());
EOL;

$forum_loader->add_js($forum_javascript_quickjump_code, array('type' => 'inline', 'weight' => 60, 'group' => FORUM_JS_GROUP_SYSTEM));
?>
