<?php

define('FORUM_HOOKS_LOADED', 1);

$forum_hooks = array (
  'ed_pre_checkbox_display' => 
  array (
    0 => '$GLOBALS[\'ext_info_stack\'][] = array(
\'id\'				=> \'pun_tags\',
\'path\'			=> FORUM_ROOT.\'extensions/pun_tags\',
\'url\'			=> $GLOBALS[\'base_url\'].\'/extensions/pun_tags\',
\'dependencies\'	=> array (
)
);
$ext_info = $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];

if ($can_edit_subject && $forum_user[\'g_pun_tags_allow\'])
			{
				$res_tags = array();
				if (isset($pun_tags[\'topics\'][$cur_post[\'tid\']]))
				{
					foreach ($pun_tags[\'topics\'][$cur_post[\'tid\']] as $tag_id)
						$res_tags[] = $pun_tags[\'index\'][$tag_id];
				}

				?>
				<div class="sf-set set<?php echo ++$forum_page[\'item_count\'] ?>">
					<div class="sf-box text">
						<label for="fld<?php echo ++$forum_page[\'fld_count\'] ?>"><span><?php echo $lang_pun_tags[\'Topic tags\']; ?></span><small><?php echo $lang_pun_tags[\'Enter tags\']; ?></small></label><br />
							<span class="fld-input"><input id="fld<?php echo $forum_page[\'fld_count\'] ?>" type="text" name="pun_tags" value="<?php if (!empty($res_tags)) echo implode(\', \', $res_tags); else echo \'\';  ?>" size="70" maxlength="100"/></span>
					</div>
				</div>
				<?php
			}

array_pop($GLOBALS[\'ext_info_stack\']);
$ext_info = empty($GLOBALS[\'ext_info_stack\']) ? array() : $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];
',
    1 => '$GLOBALS[\'ext_info_stack\'][] = array(
\'id\'				=> \'pun_forum_news\',
\'path\'			=> FORUM_ROOT.\'extensions/pun_forum_news\',
\'url\'			=> $GLOBALS[\'base_url\'].\'/extensions/pun_forum_news\',
\'dependencies\'	=> array (
)
);
$ext_info = $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];

if ($forum_user[\'group_id\'] == FORUM_ADMIN || $forum_user[\'g_add_forum_news\'])
			{
				if (isset($_POST[\'form_sent\']))
					$pun_forum_news_option = isset($_POST[\'pun_forum_news\']) ? 1 : 0;
				else
					$pun_forum_news_option = $cur_post[\'forum_news\'];
				$forum_page[\'checkboxes\'][\'pun_forum_news\'] = \'<div class="mf-item"><span class="fld-input"><input type="checkbox" id="fld\'.(++$forum_page[\'fld_count\']).\'" name="pun_forum_news" value="1"\'.($pun_forum_news_option ? \' checked="checked"\' : \'\').\' /></span> <label for="fld\'.$forum_page[\'fld_count\'].\'">\'.$lang_pun_forum_news[\'Post mark\'].\'</label></div>\';
			}

array_pop($GLOBALS[\'ext_info_stack\']);
$ext_info = empty($GLOBALS[\'ext_info_stack\']) ? array() : $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];
',
  ),
  'po_pre_optional_fieldset' => 
  array (
    0 => '$GLOBALS[\'ext_info_stack\'][] = array(
\'id\'				=> \'pun_tags\',
\'path\'			=> FORUM_ROOT.\'extensions/pun_tags\',
\'url\'			=> $GLOBALS[\'base_url\'].\'/extensions/pun_tags\',
\'dependencies\'	=> array (
)
);
$ext_info = $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];

if ($fid && $forum_user[\'g_pun_tags_allow\'])
			{
				// if pun_approval is installed, we make adding of tags impossible when topic is being created.
				// User can add tags to the topic after it is approved.
				$query= array(
					\'SELECT\'	=> \'disabled\',
					\'FROM\'		=> \'extensions\',
					\'WHERE\'		=> \'id=\\\'pun_approval\\\'\'
				);
				$result=$forum_db->query_build($query) or error(__FILE__, __LINE__);

				$row = $forum_db->fetch_assoc($result);
				if ($row)
					$appr_disabled = $row[\'disabled\'];
				else
					$appr_disabled = true;

				// Chek if pun_approval is installed and enabled
				if ($appr_disabled || $forum_user[\'g_id\'] == FORUM_ADMIN)
				{
					?>
					<div class="sf-set set<?php echo ++$forum_page[\'item_count\'] ?>">
						<div class="sf-box text">
							<label for="fld<?php echo ++$forum_page[\'fld_count\'] ?>"><span><?php echo $lang_pun_tags[\'Topic tags\']; ?></span><small><?php echo $lang_pun_tags[\'Enter tags\']; ?></small></label><br />
								<span class="fld-input"><input id="fld<?php echo $forum_page[\'fld_count\'] ?>" type="text" name="pun_tags" value="<?php echo empty($_POST[\'pun_tags\']) ? \'\' : forum_htmlencode($_POST[\'pun_tags\']) ?>" size="70" maxlength="100"/></span>
						</div>
					</div>
					<?php
				}
				else
				{
					?>
					<div class="sf-set set<?php echo ++$forum_page[\'item_count\'] ?>">
						<div class="sf-box text">
							<label for="fld<?php echo ++$forum_page[\'fld_count\'] ?>"><span><?php echo $lang_pun_tags[\'Topic tags\']; ?></span><div class="fld-input"><?php echo $lang_pun_tags[\'Tags warning\'] ?></div></label><br />
						</div>
					</div>
					<?php
				}
			}

array_pop($GLOBALS[\'ext_info_stack\']);
$ext_info = empty($GLOBALS[\'ext_info_stack\']) ? array() : $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];
',
    1 => '$GLOBALS[\'ext_info_stack\'][] = array(
\'id\'				=> \'pun_forum_news\',
\'path\'			=> FORUM_ROOT.\'extensions/pun_forum_news\',
\'url\'			=> $GLOBALS[\'base_url\'].\'/extensions/pun_forum_news\',
\'dependencies\'	=> array (
)
);
$ext_info = $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];

if ($forum_user[\'group_id\'] == FORUM_ADMIN || $forum_user[\'g_add_forum_news\'])
				$forum_page[\'checkboxes\'][\'pun_forum_news\'] = \'<div class="mf-item"><span class="fld-input"><input type="checkbox" id="fld\'.(++$forum_page[\'fld_count\']).\'" name="pun_forum_news" value="1"\'.(isset($_POST[\'pun_forum_news\']) ? \' checked="checked"\' : \'\').\' /></span> <label for="fld\'.$forum_page[\'fld_count\'].\'">\'.$lang_pun_forum_news[\'Post mark\'].\'</label></div>\';

array_pop($GLOBALS[\'ext_info_stack\']);
$ext_info = empty($GLOBALS[\'ext_info_stack\']) ? array() : $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];
',
  ),
  'hd_visit_elements' => 
  array (
    0 => '$GLOBALS[\'ext_info_stack\'][] = array(
\'id\'				=> \'fancy_alerts\',
\'path\'			=> FORUM_ROOT.\'extensions/fancy_alerts\',
\'url\'			=> $GLOBALS[\'base_url\'].\'/extensions/fancy_alerts\',
\'dependencies\'	=> array (
)
);
$ext_info = $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];

$fancy_alerts = new Fancy_alerts;
				if (!isset($lang_fancy_alerts)) {
					if ($forum_user[\'language\'] != \'English\' && file_exists($ext_info[\'path\'].\'/lang/\'.$forum_user[\'language\'].\'/\'.$ext_info[\'id\'].\'.php\')) {
						require $ext_info[\'path\'].\'/lang/\'.$forum_user[\'language\'].\'/\'.$ext_info[\'id\'].\'.php\';
					} else {
						require $ext_info[\'path\'].\'/lang/English/\'.$ext_info[\'id\'].\'.php\';
					}
				}

				// TOPICS ALERTS
				if (!$forum_user[\'is_guest\']) {
					$fancy_topics_alerts_num = $fancy_alerts->get_num_topics_alerts_for_user($forum_user[\'id\'], $forum_user[\'group_id\']);

					if ($fancy_topics_alerts_num > 0) {
						$visit_links[\'fancy_alerts_topics\'] = \'<span id="fancy_alerts_visit_topics"><a title="\'.$lang_fancy_alerts[\'Alerts Topics Title\'].\'" id="fancy_alerts_topics_link" href="\'.forum_link($forum_url[\'fancy_alerts_topics_goto_alerts\'], $forum_user[\'id\']).\'">\'.$lang_fancy_alerts[\'Alerts Topics\'].\'<span id="fancy_alerts_topic_n">\'.$fancy_topics_alerts_num.\'</span></a></span>\';
					} else {
						$visit_links[\'fancy_alerts_topics\'] = \'<span id="fancy_alerts_visit_topics" style="display: none;"><a title="\'.$lang_fancy_alerts[\'Alerts Topics Title\'].\'" id="fancy_alerts_topics_link" href="\'.forum_link($forum_url[\'fancy_alerts_topics_goto_alerts\'], $forum_user[\'id\']).\'">\'.$lang_fancy_alerts[\'Alerts Topics\'].\'<span id="fancy_alerts_topic_n">0</span></a></span>\';
					}

					// QUOTES ALERTS
					$fancy_quotes_alerts_num = $fancy_alerts->get_num_quotes_alerts_for_user($forum_user[\'id\'], $forum_user[\'group_id\']);

					if ($fancy_quotes_alerts_num > 0) {
						$visit_links[\'fancy_alerts_posts\'] = \'<span id="fancy_alerts_visit_posts"><a title="\'.$lang_fancy_alerts[\'Alerts Quotes Title\'].\'" id="fancy_alerts_posts_link" href="\'.forum_link($forum_url[\'fancy_alerts_quotes_goto_alerts\'], $forum_user[\'id\']).\'">\'.$lang_fancy_alerts[\'Alerts Quotes\'].\'<span id="fancy_alerts_quotes_n">\'.$fancy_quotes_alerts_num.\'</span></a></span>\';
					} else {
						$visit_links[\'fancy_alerts_posts\'] = \'<span id="fancy_alerts_visit_posts" style="display: none;"><a title="\'.$lang_fancy_alerts[\'Alerts Quotes Title\'].\'" id="fancy_alerts_posts_link" href="\'.forum_link($forum_url[\'fancy_alerts_quotes_goto_alerts\'], $forum_user[\'id\']).\'">\'.$lang_fancy_alerts[\'Alerts Quotes\'].\'<span id="fancy_alerts_quotes_n">0</span></a></span>\';
					}
				}

array_pop($GLOBALS[\'ext_info_stack\']);
$ext_info = empty($GLOBALS[\'ext_info_stack\']) ? array() : $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];
',
    1 => '$GLOBALS[\'ext_info_stack\'][] = array(
\'id\'				=> \'pun_pm\',
\'path\'			=> FORUM_ROOT.\'extensions/pun_pm\',
\'url\'			=> $GLOBALS[\'base_url\'].\'/extensions/pun_pm\',
\'dependencies\'	=> array (
)
);
$ext_info = $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];

// \'New messages (N)\' link
			if (!$forum_user[\'is_guest\'] && $forum_config[\'o_pun_pm_show_new_count\'])
			{
				global $lang_pun_pm;

				if (!isset($lang_pun_pm))
				{
					if (file_exists($ext_info[\'path\'].\'/lang/\'.$forum_user[\'language\'].\'/\'.$ext_info[\'id\'].\'.php\'))
						include $ext_info[\'path\'].\'/lang/\'.$forum_user[\'language\'].\'/\'.$ext_info[\'id\'].\'.php\';
					else
						include $ext_info[\'path\'].\'/lang/English/\'.$ext_info[\'id\'].\'.php\';
				}

				// TODO: Do not include all functions, divide them into 2 files
				if(!defined(\'PUN_PM_FUNCTIONS_LOADED\'))
					require $ext_info[\'path\'].\'/functions.php\';

				($hook = get_hook(\'pun_pm_hd_visit_elements_pre_change\')) ? eval($hook) : null;

				//$visit_elements[\'<!-- forum_visit -->\'] = preg_replace(\'#(<p id="visit-links" class="options">.*?)(</p>)#\', \'$1 <span><a href="\'.forum_link($forum_url[\'pun_pm_inbox\']).\'">\'.pun_pm_unread_messages().\'</a></span>$2\', $visit_elements[\'<!-- forum_visit -->\']);
				if ($forum_user[\'g_read_board\'] == \'1\' && $forum_user[\'g_search\'] == \'1\')
				{
					$visit_links[\'pun_pm\'] = \'<span id="visit-pun_pm"><a href="\'.forum_link($forum_url[\'pun_pm_inbox\']).\'">\'.pun_pm_unread_messages().\'</a></span>\';
				}

				($hook = get_hook(\'pun_pm_hd_visit_elements_after_change\')) ? eval($hook) : null;
			}

array_pop($GLOBALS[\'ext_info_stack\']);
$ext_info = empty($GLOBALS[\'ext_info_stack\']) ? array() : $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];
',
  ),
  'ps_handle_img_tag_end' => 
  array (
    0 => '$GLOBALS[\'ext_info_stack\'][] = array(
\'id\'				=> \'fancy_image\',
\'path\'			=> FORUM_ROOT.\'extensions/fancy_image\',
\'url\'			=> $GLOBALS[\'base_url\'].\'/extensions/fancy_image\',
\'dependencies\'	=> array (
\'fancy_jquery_addons\'	=> array(
\'id\'				=> \'fancy_jquery_addons\',
\'path\'			=> FORUM_ROOT.\'extensions/fancy_jquery_addons\',
\'url\'			=> $GLOBALS[\'base_url\'].\'/extensions/fancy_jquery_addons\'),
)
);
$ext_info = $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];

if (!$is_signature && $forum_user[\'show_img\'] == \'0\') {
				$img_tag = \'<a href="\'.$url.\'" class="fancy_zoom">&lt;\'.$lang_common[\'Image link\'].\'&gt;</a>\';
			}

			if (!$is_signature && $forum_user[\'show_img\'] != \'0\') {

				// PIC.LG.UA
				if (FALSE !== strpos($url, \'pic.lg.ua\')) {
					$preview_url = preg_replace(\'!^(http://pic.lg.ua/x)/(\\d+)/(.*)/(sm|md)(_.+)!is\', \'${1}/${2}/${3}/pv${5}\', $url);
					$img_tag = \'<span class="postimg fancyimagethumbs"><img data-fancy="false" src="\'.$url.\'" alt="\'.forum_htmlencode($alt).\'" rel="\'.forum_htmlencode($preview_url).\'"/></span>\';
				} else if (FALSE !== strpos($url, \'imageshack.us\')) {
					// IMAGESHACK
					$preview_url = preg_replace(\'!^(http://img\\d+\\.imageshack\\.us)/(img\\d+)/(\\d+)/(.+)\\.th\\.(.+)!is\', \'${1}/${2}/${3}/${4}.${5}\', $url);
					$img_tag = \'<span class="postimg fancyimagethumbs"><img data-fancy="false" src="\'.$url.\'" alt="\'.forum_htmlencode($alt).\'" rel="\'.forum_htmlencode($preview_url).\'"/></span>\';
				} else if (FALSE !== strpos($url, \'radikal.ru\')) {
					// RADIKAL
					$preview_url = preg_replace(\'!^(http://.+\\.radikal.ru)/(.*)/(.*)(t|x)\\.(jpg|jpeg|png|gif|bmp|tif|tiff)!is\', \'${1}/${2}/${3}.${5}\', $url);
					$img_tag = \'<span class="postimg fancyimagethumbs"><img data-fancy="false" src="\'.$url.\'" alt="\'.forum_htmlencode($alt).\'" rel="\'.forum_htmlencode($preview_url).\'"/></span>\';
				} else if (FALSE !== strpos($url, \'photobucket.com\')) {
					// PHOTOBUCKET
					$preview_url = preg_replace(\'!^(http://i\\d+\\.photobucket\\.com/albums)/(x\\d+)/(.+)/th_(.+)!is\', \'${1}/${2}/${3}/${4}\', $url);
					$img_tag = \'<span class="postimg fancyimagethumbs"><img data-fancy="false" src="\'.$url.\'" alt="\'.forum_htmlencode($alt).\'" rel="\'.forum_htmlencode($preview_url).\'"/></span>\';
				} else if (FALSE !== strpos($url, \'piccy.info\')) {
					// PICCY.INFO
					$preview_url = preg_replace(\'!^(http://.*piccy.info/.*/\\d+/\\d+/\\d+/)(.*)_(240|500|800)(\\..*)!is\', \'${1}${2}${4}\', $url);
					$img_tag = \'<span class="postimg fancyimagethumbs"><img data-fancy="false" src="\'.$url.\'" alt="\'.forum_htmlencode($alt).\'" rel="\'.forum_htmlencode($preview_url).\'"/></span>\';
				} else if (FALSE !== strpos($url, \'imagepost.ru\')) {
					// IMAGEPOST.RU
					$preview_url = preg_replace(\'!^(http://)(imagepost\\.ru)/(thumbs)/(\\d+)/(.*)!is\', \'${1}${2}/images/${4}/${5}\', $url);
					$img_tag = \'<span class="postimg fancyimagethumbs"><img data-fancy="false" src="\'.$url.\'" alt="\'.forum_htmlencode($alt).\'" rel="\'.forum_htmlencode($preview_url).\'"/></span>\';
				} else if (FALSE !== strpos($url, \'savepic.\')) {
					// SAVEPIC
					$preview_url = preg_replace(\'!^(http://savepic\\.)(org|net)/(\\d+)m(\\..+)!is\', \'${1}${2}/${3}${4}\', $url);
					$img_tag = \'<span class="postimg fancyimagethumbs"><img data-fancy="false" src="\'.$url.\'" alt="\'.forum_htmlencode($alt).\'" rel="\'.forum_htmlencode($preview_url).\'"/></span>\';
				} else if (FALSE !== strpos($url, \'imageshost.ru\')) {
					// IMAGESHOST
					$preview_url = preg_replace(\'!^(http://img\\d+\\.imageshost\\.ru/img/\\d+/\\d+/\\d+/image_)(.*)_small\\.(jpg|jpeg|png|gif|bmp|tif|tiff)!is\', \'${1}${2}.${3}\', $url);
					$img_tag = \'<span class="postimg fancyimagethumbs"><img data-fancy="false" src="\'.$url.\'" alt="\'.forum_htmlencode($alt).\'" rel="\'.forum_htmlencode($preview_url).\'"/></span>\';
				} else if (FALSE !== strpos($url, \'ipicture.ru\')) {
					// IPICTURE.RU
					$preview_url = preg_replace(\'!^(http://s\\d+\\.ipicture\\.ru/uploads/\\d+/)(thumbs)/(.*)\\.(jpg|jpeg|png|gif|bmp|tif|tiff)!is\', \'${1}${3}.${4}\', $url);
					$img_tag = \'<span class="postimg fancyimagethumbs"><img data-fancy="false" src="\'.$url.\'" alt="\'.forum_htmlencode($alt).\'" rel="\'.forum_htmlencode($preview_url).\'"/></span>\';
				}
			}

array_pop($GLOBALS[\'ext_info_stack\']);
$ext_info = empty($GLOBALS[\'ext_info_stack\']) ? array() : $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];
',
  ),
  'ft_js_include' => 
  array (
    0 => '$GLOBALS[\'ext_info_stack\'][] = array(
\'id\'				=> \'pun_jquery\',
\'path\'			=> FORUM_ROOT.\'extensions/pun_jquery\',
\'url\'			=> $GLOBALS[\'base_url\'].\'/extensions/pun_jquery\',
\'dependencies\'	=> array (
)
);
$ext_info = $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];

switch ($forum_config[\'o_pun_jquery_include_method\'])
			{
				case PUN_JQUERY_INCLUDE_METHOD_GOOGLE_CDN:
					$ext_pun_jquery_url = \'//ajax.googleapis.com/ajax/libs/jquery/\'.PUN_JQUERY_VERSION.\'/jquery.min.js\';
					break;

				case PUN_JQUERY_INCLUDE_METHOD_MICROSOFT_CDN:
					$ext_pun_jquery_url = \'//ajax.aspnetcdn.com/ajax/jQuery/jquery-\'.PUN_JQUERY_VERSION.\'.min.js\';
					break;

				case PUN_JQUERY_INCLUDE_METHOD_JQUERY_CDN:
					$ext_pun_jquery_url = \'//code.jquery.com/jquery-\'.PUN_JQUERY_VERSION.\'.min.js\';
					break;

				case PUN_JQUERY_INCLUDE_METHOD_LOCAL:
				default:
					$ext_pun_jquery_url = $ext_info[\'url\'].\'/js/jquery-\'.PUN_JQUERY_VERSION.\'.min.js\';
					break;
			}

			$forum_loader->add_js($ext_pun_jquery_url, array(\'type\' => \'url\', \'async\' => false, \'weight\' => 75));

array_pop($GLOBALS[\'ext_info_stack\']);
$ext_info = empty($GLOBALS[\'ext_info_stack\']) ? array() : $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];
',
    1 => '$GLOBALS[\'ext_info_stack\'][] = array(
\'id\'				=> \'fancy_jquery_addons\',
\'path\'			=> FORUM_ROOT.\'extensions/fancy_jquery_addons\',
\'url\'			=> $GLOBALS[\'base_url\'].\'/extensions/fancy_jquery_addons\',
\'dependencies\'	=> array (
\'pun_jquery\'	=> array(
\'id\'				=> \'pun_jquery\',
\'path\'			=> FORUM_ROOT.\'extensions/pun_jquery\',
\'url\'			=> $GLOBALS[\'base_url\'].\'/extensions/pun_jquery\'),
)
);
$ext_info = $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];

$forum_loader->add_js($ext_info[\'url\'].\'/js/fancy_jquery_addons.min.js\', array(\'type\' => \'url\', \'async\' => false, \'weight\' => 77));

array_pop($GLOBALS[\'ext_info_stack\']);
$ext_info = empty($GLOBALS[\'ext_info_stack\']) ? array() : $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];
',
  ),
  'ul_end' => 
  array (
    0 => '$GLOBALS[\'ext_info_stack\'][] = array(
\'id\'				=> \'pun_admin_add_user\',
\'path\'			=> FORUM_ROOT.\'extensions/pun_admin_add_user\',
\'url\'			=> $GLOBALS[\'base_url\'].\'/extensions/pun_admin_add_user\',
\'dependencies\'	=> array (
)
);
$ext_info = $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];

if ($forum_user[\'g_id\'] == FORUM_ADMIN)
			{
				if ($forum_user[\'language\'] != \'English\' && file_exists($ext_info[\'path\'].\'/lang/\'.$forum_user[\'language\'].\'/\'.$ext_info[\'id\'].\'.php\'))
							require $ext_info[\'path\'].\'/lang/\'.$forum_user[\'language\'].\'/\'.$ext_info[\'id\'].\'.php\';
						else
							require $ext_info[\'path\'].\'/lang/English/\'.$ext_info[\'id\'].\'.php\';

				$username = \'\';
				$email = \'\';
				$edit_identity = \'\';
				$result_message = \'\';

				if (isset($_POST[\'add_user_form_sent\']) && $_POST[\'add_user_form_sent\'] == 1)
				{
					if ($ext_admin_add_user_user_added === true)
						$result_message = \'<div class="frm-info"><p>\'.$lang_admin_add_user[\'User added successfully\'].\'/p></div>\';
					else
					{
						$username = $_POST[\'req_username\'];
						$email = $_POST[\'req_email\'];
						$edit_identity = isset($_POST[\'edit_identity\']);
					}
				}

				$buffer_old = ob_get_contents();

				ob_end_clean();

				ob_start();

				$pun_add_user_form_action = $base_url.\'/userlist.php\';

				// Get output buffer and insert form
				$pos = strpos($buffer_old, \'<div class="main-foot">\');
				echo substr($buffer_old, 0 , $pos);
				?>

				<div class="main-head">
					<h2 class="hn"><span><?php echo $lang_admin_add_user[\'Add user\'] ?></span></h2>
				</div>
				<div class="main-content main-frm">
				<?php

				if (!empty($errors_add_users))
				{
					$error_li = array();
					for ($err_num = 0; $err_num < count($errors_add_users); $err_num++)
						$error_li[] = \'<li class="warn"><span>\'.$errors_add_users[$err_num].\'</span></li>\';

				?>
					<div class="ct-box error-box">
						<h2 class="warn hn"><?php echo $lang_admin_add_user[\'There are some errors\']; ?></h2>
						<ul class="error-list">
						<?php echo implode("\\n\\t\\t\\t\\t\\t\\t", $error_li)."\\n" ?>
						</ul>
					</div>
				<?php } ?>
					<form class="frm-form" id="frm-adduser" action="<?php echo $pun_add_user_form_action ?>#adduser-content" method="post">
						<div class="hidden">
							<input type="hidden" name="csrf_token" value="<?php echo generate_form_token($pun_add_user_form_action) ?>" />
							<input type="hidden" name="add_user_form_sent" value="1" />
						</div>

						<div class="frm-group group1">
							<div class="sf-set set1">
								<div class="sf-box text required">
									<label for="add_user_username">
										<span><?php echo $lang_admin_add_user[\'Username\'] ?></span>
										<small>
											<?php echo $lang_admin_add_user[\'Between 2 and 25 characters\'] ?>
										</small>
									</label>
									<span class="fld-input"><input type="text" id="add_user_username" name="req_username" size="35" value="<?php echo $username ?>" maxlength="25" required /></span>
								</div>
							</div>

							<div class="sf-set set2">
								<div class="sf-box text required">
									<label for="add_user_email">
										<span><?php echo $lang_admin_add_user[\'E-mail\'] ?></span>
										<small>
											<?php echo $lang_admin_add_user[\'Enter a current and valid e-mail address\'] ?>
										</small>
									</label>
									<span class="fld-input"><input type="text" id="add_user_email" name="req_email" size="35" value="<?php echo $email ?>" maxlength="80" required/></span>
								</div>
							</div>

							<div class="sf-set set3">
								<div class="sf-box checkbox">
									<span class="fld-input"><input type="checkbox" id="add_user_edit_user_identity" name="edit_identity" value="1"<?php echo $edit_identity ? \' checked="checked"\' : \'\' ?> /></span>
									<label for="add_user_edit_user_identity"><?php echo $lang_admin_add_user[\'Edit User Identity after adding User\'] ?></label>
								</div>
							</div>
						</div>

						<div class="frm-buttons">
							<span class="submit primary"><input type="submit" name="submit" value="<?php echo $lang_admin_add_user[\'Add user\'] ?>" /></span>
						</div>
					</form>
				</div>
				<?php

				echo substr($buffer_old, $pos, strlen($buffer_old) - $pos);
			}

array_pop($GLOBALS[\'ext_info_stack\']);
$ext_info = empty($GLOBALS[\'ext_info_stack\']) ? array() : $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];
',
  ),
  'ul_start' => 
  array (
    0 => '$GLOBALS[\'ext_info_stack\'][] = array(
\'id\'				=> \'pun_admin_add_user\',
\'path\'			=> FORUM_ROOT.\'extensions/pun_admin_add_user\',
\'url\'			=> $GLOBALS[\'base_url\'].\'/extensions/pun_admin_add_user\',
\'dependencies\'	=> array (
)
);
$ext_info = $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];

if ($forum_user[\'g_id\'] == FORUM_ADMIN)
			{
				$errors_add_users = array();
				if (isset($_POST[\'add_user_form_sent\']) && $_POST[\'add_user_form_sent\'] == 1)
				{
					$forum_extension[\'admin_add_user\'][\'user_added\'] = false;

					require_once FORUM_ROOT.\'include/functions.php\';
					require_once FORUM_ROOT.\'lang/\'.$forum_user[\'language\'].\'/profile.php\';

					$username = trim($_POST[\'req_username\']);
					$email = strtolower(trim($_POST[\'req_email\']));

					// Validate the username
					$errors_add_users = validate_username($username);

					// ... and the e-mail address
					require_once FORUM_ROOT.\'include/email.php\';

					if (!is_valid_email($email))
					   $errors_add_users[] = $lang_common[\'Invalid e-mail\'];

					// Check if it\'s a banned e-mail address
					$banned_email = is_banned_email($email);
					if ($banned_email && $forum_config[\'p_allow_banned_email\'] == \'0\')
						$errors_add_users[] = $lang_profile[\'Banned e-mail\'];

					// Check if someone else already has registered with that e-mail address
					$q = array(
						\'SELECT\'	=> \'COUNT(u.username)\',
						\'FROM\'	  	=> \'users AS u\',
						\'WHERE\'		=> \'u.email=\\\'\'.$forum_db->escape($email).\'\\\'\'
					);

					$result = $forum_db->query_build( $q ) or error(__FILE__, __LINE__);

					if (($forum_config[\'p_allow_dupe_email\'] == \'0\') && ($forum_db->result($result) > 0))
						$errors_add_users[] = $lang_profile[\'Dupe e-mail\'];

					if (empty($errors_add_users))
					{
						$salt = random_key(12);
						$password = random_key(8, true);
						$password_hash = sha1($salt.sha1($password));

						$errors = add_user(
							array(
								\'username\'				=> $username,
								\'group_id\'				=> ($forum_config[\'o_regs_verify\'] == \'0\') ? $forum_config[\'o_default_user_group\'] : FORUM_UNVERIFIED,
								\'salt\'					=> $salt,
								\'password\'				=> $password,
								\'password_hash\'			=> $password_hash,
								\'email\'					=> $email,
								\'email_setting\'			=> 1,
								\'save_pass\'				=> 0,
								\'timezone\'				=> $forum_config[\'o_default_timezone\'],
								\'dst\'					=> 0,
								\'language\'				=> $forum_config[\'o_default_lang\'],
								\'style\'					=> $forum_config[\'o_default_style\'],
								\'registered\'			=> time(),
								\'registration_ip\'		=> get_remote_address(),
								\'activate_key\'			=> ($forum_config[\'o_regs_verify\'] == \'1\') ? \'\\\'\'.random_key(8, true).\'\\\'\' : \'NULL\',
								\'require_verification\'	=> ($forum_config[\'o_regs_verify\'] == \'1\'),
								\'notify_admins\'			=> ($forum_config[\'o_regs_report\'] == \'1\')
								),
								$new_uid
						);

						if ($forum_user[\'language\'] != \'English\' && file_exists($ext_info[\'path\'].\'/lang/\'.$forum_user[\'language\'].\'/\'.$ext_info[\'id\'].\'.php\'))
							require $ext_info[\'path\'].\'/lang/\'.$forum_user[\'language\'].\'/\'.$ext_info[\'id\'].\'.php\';
						else
							require $ext_info[\'path\'].\'/lang/English/\'.$ext_info[\'id\'].\'.php\';

						$forum_flash->add_info($lang_admin_add_user[\'User added successfully\']);

						if (isset($_POST[\'edit_identity\']) && $_POST[\'edit_identity\'] == 1)
							redirect(forum_link($forum_url[\'profile_identity\'], $new_uid), $lang_admin_add_user[\'User added successfully\']);

						$ext_admin_add_user_user_added = true;
					}
					else
						$ext_admin_add_user_user_added = false;
				}
			}

array_pop($GLOBALS[\'ext_info_stack\']);
$ext_info = empty($GLOBALS[\'ext_info_stack\']) ? array() : $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];
',
    1 => '$GLOBALS[\'ext_info_stack\'][] = array(
\'id\'				=> \'pun_colored_usergroups\',
\'path\'			=> FORUM_ROOT.\'extensions/pun_colored_usergroups\',
\'url\'			=> $GLOBALS[\'base_url\'].\'/extensions/pun_colored_usergroups\',
\'dependencies\'	=> array (
)
);
$ext_info = $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];

if (!file_exists(FORUM_CACHE_DIR.\'cache_pun_coloured_usergroups.php\'))
			{
				if (!defined(\'CACHE_PUN_COLOURED_USERGROUPS_LOADED\')) {
					require $ext_info[\'path\'].\'/main.php\';
				}
				cache_pun_coloured_usergroups();
			}

array_pop($GLOBALS[\'ext_info_stack\']);
$ext_info = empty($GLOBALS[\'ext_info_stack\']) ? array() : $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];
',
  ),
  'mr_confirm_delete_posts_pre_redirect' => 
  array (
    0 => '$GLOBALS[\'ext_info_stack\'][] = array(
\'id\'				=> \'pun_attachment\',
\'path\'			=> FORUM_ROOT.\'extensions/pun_attachment\',
\'url\'			=> $GLOBALS[\'base_url\'].\'/extensions/pun_attachment\',
\'dependencies\'	=> array (
)
);
$ext_info = $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];

if (!$forum_config[\'attach_disable_attach\'])
			{
				$attach_query = array(
					\'SELECT\'	=>	\'id, file_path, owner_id\',
					\'FROM\'		=>	\'attach_files\',
					\'WHERE\'		=>	isset($posts) ? \'post_id IN(\'.implode(\',\', $posts).\')\' : \'topic_id IN(\'.implode(\',\', $topics).\')\'
				);
				$forum_page[\'is_admmod\'] = true;
				remove_attachments($attach_query, $cur_forum);
			}

array_pop($GLOBALS[\'ext_info_stack\']);
$ext_info = empty($GLOBALS[\'ext_info_stack\']) ? array() : $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];
',
    1 => '$GLOBALS[\'ext_info_stack\'][] = array(
\'id\'				=> \'fancy_alerts\',
\'path\'			=> FORUM_ROOT.\'extensions/fancy_alerts\',
\'url\'			=> $GLOBALS[\'base_url\'].\'/extensions/fancy_alerts\',
\'dependencies\'	=> array (
)
);
$ext_info = $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];

$fancy_alerts = new Fancy_alerts;
				$fancy_alerts->del_post_alerts($posts);

array_pop($GLOBALS[\'ext_info_stack\']);
$ext_info = empty($GLOBALS[\'ext_info_stack\']) ? array() : $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];
',
  ),
  'mr_qr_get_forum_data' => 
  array (
    0 => '$GLOBALS[\'ext_info_stack\'][] = array(
\'id\'				=> \'pun_attachment\',
\'path\'			=> FORUM_ROOT.\'extensions/pun_attachment\',
\'url\'			=> $GLOBALS[\'base_url\'].\'/extensions/pun_attachment\',
\'dependencies\'	=> array (
)
);
$ext_info = $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];

if (!$forum_config[\'attach_disable_attach\'])
			{
				$query[\'SELECT\'] .= \', g_pun_attachment_allow_upload, g_pun_attachment_upload_max_size, g_pun_attachment_files_per_post, g_pun_attachment_disallowed_extensions, g_pun_attachment_allow_delete_own, g_pun_attachment_allow_delete\';
				$query[\'JOINS\'][] = array(\'LEFT JOIN\' => \'groups AS g\', \'ON\' => \'g.g_id = \'.$forum_user[\'g_id\']);
			}

array_pop($GLOBALS[\'ext_info_stack\']);
$ext_info = empty($GLOBALS[\'ext_info_stack\']) ? array() : $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];
',
  ),
  'dl_start' => 
  array (
    0 => '$GLOBALS[\'ext_info_stack\'][] = array(
\'id\'				=> \'pun_attachment\',
\'path\'			=> FORUM_ROOT.\'extensions/pun_attachment\',
\'url\'			=> $GLOBALS[\'base_url\'].\'/extensions/pun_attachment\',
\'dependencies\'	=> array (
)
);
$ext_info = $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];

require $ext_info[\'path\'].\'/include/attach_func.php\';
			if (file_exists($ext_info[\'path\'].\'/lang/\'.$forum_user[\'language\'].\'/\'.$ext_info[\'id\'].\'.php\'))
				require $ext_info[\'path\'].\'/lang/\'.$forum_user[\'language\'].\'/\'.$ext_info[\'id\'].\'.php\';
			else
				require $ext_info[\'path\'].\'/lang/English/\'.$ext_info[\'id\'].\'.php\';

array_pop($GLOBALS[\'ext_info_stack\']);
$ext_info = empty($GLOBALS[\'ext_info_stack\']) ? array() : $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];
',
  ),
  'mr_start' => 
  array (
    0 => '$GLOBALS[\'ext_info_stack\'][] = array(
\'id\'				=> \'pun_attachment\',
\'path\'			=> FORUM_ROOT.\'extensions/pun_attachment\',
\'url\'			=> $GLOBALS[\'base_url\'].\'/extensions/pun_attachment\',
\'dependencies\'	=> array (
)
);
$ext_info = $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];

require $ext_info[\'path\'].\'/include/attach_func.php\';
			if (file_exists($ext_info[\'path\'].\'/lang/\'.$forum_user[\'language\'].\'/\'.$ext_info[\'id\'].\'.php\'))
				require $ext_info[\'path\'].\'/lang/\'.$forum_user[\'language\'].\'/\'.$ext_info[\'id\'].\'.php\';
			else
				require $ext_info[\'path\'].\'/lang/English/\'.$ext_info[\'id\'].\'.php\';

array_pop($GLOBALS[\'ext_info_stack\']);
$ext_info = empty($GLOBALS[\'ext_info_stack\']) ? array() : $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];
',
    1 => '$GLOBALS[\'ext_info_stack\'][] = array(
\'id\'				=> \'pun_move_posts\',
\'path\'			=> FORUM_ROOT.\'extensions/pun_move_posts\',
\'url\'			=> $GLOBALS[\'base_url\'].\'/extensions/pun_move_posts\',
\'dependencies\'	=> array (
)
);
$ext_info = $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];

if ($forum_user[\'language\'] != \'English\' && file_exists($ext_info[\'path\'].\'/lang/\'.$forum_user[\'language\'].\'/\'.$ext_info[\'id\'].\'.php\'))
				require $ext_info[\'path\'].\'/lang/\'.$forum_user[\'language\'].\'/\'.$ext_info[\'id\'].\'.php\';
			else
				require $ext_info[\'path\'].\'/lang/English/\'.$ext_info[\'id\'].\'.php\';

array_pop($GLOBALS[\'ext_info_stack\']);
$ext_info = empty($GLOBALS[\'ext_info_stack\']) ? array() : $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];
',
  ),
  'dl_qr_get_post_info' => 
  array (
    0 => '$GLOBALS[\'ext_info_stack\'][] = array(
\'id\'				=> \'pun_attachment\',
\'path\'			=> FORUM_ROOT.\'extensions/pun_attachment\',
\'url\'			=> $GLOBALS[\'base_url\'].\'/extensions/pun_attachment\',
\'dependencies\'	=> array (
)
);
$ext_info = $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];

if (!$forum_config[\'attach_disable_attach\'])
			{
				$query[\'SELECT\'] .= \', g_pun_attachment_allow_upload, g_pun_attachment_upload_max_size, g_pun_attachment_files_per_post, g_pun_attachment_disallowed_extensions, g_pun_attachment_allow_delete_own, g_pun_attachment_allow_delete\';
				$query[\'JOINS\'][] = array(\'LEFT JOIN\' => \'groups AS g\', \'ON\' => \'g.g_id = \'.$forum_user[\'g_id\']);
			}

array_pop($GLOBALS[\'ext_info_stack\']);
$ext_info = empty($GLOBALS[\'ext_info_stack\']) ? array() : $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];
',
  ),
  'dl_form_submitted' => 
  array (
    0 => '$GLOBALS[\'ext_info_stack\'][] = array(
\'id\'				=> \'pun_attachment\',
\'path\'			=> FORUM_ROOT.\'extensions/pun_attachment\',
\'url\'			=> $GLOBALS[\'base_url\'].\'/extensions/pun_attachment\',
\'dependencies\'	=> array (
)
);
$ext_info = $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];

if (!$forum_config[\'attach_disable_attach\'])
			{
				$attach_query = array(
					\'SELECT\'	=>	\'id, file_path, owner_id\',
					\'FROM\'		=>	\'attach_files\'
				);
				$attach_query[\'WHERE\'] = $cur_post[\'is_topic\'] ? \'post_id != 0 AND topic_id = \'.$cur_post[\'tid\'] : \'post_id = \'.$id;
			}

array_pop($GLOBALS[\'ext_info_stack\']);
$ext_info = empty($GLOBALS[\'ext_info_stack\']) ? array() : $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];
',
  ),
  'dl_topic_deleted_pre_redirect' => 
  array (
    0 => '$GLOBALS[\'ext_info_stack\'][] = array(
\'id\'				=> \'pun_attachment\',
\'path\'			=> FORUM_ROOT.\'extensions/pun_attachment\',
\'url\'			=> $GLOBALS[\'base_url\'].\'/extensions/pun_attachment\',
\'dependencies\'	=> array (
)
);
$ext_info = $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];

if (!$forum_config[\'attach_disable_attach\'])
			{
				remove_attachments($attach_query, $cur_post);
			}

array_pop($GLOBALS[\'ext_info_stack\']);
$ext_info = empty($GLOBALS[\'ext_info_stack\']) ? array() : $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];
',
  ),
  'dl_post_deleted_pre_redirect' => 
  array (
    0 => '$GLOBALS[\'ext_info_stack\'][] = array(
\'id\'				=> \'pun_attachment\',
\'path\'			=> FORUM_ROOT.\'extensions/pun_attachment\',
\'url\'			=> $GLOBALS[\'base_url\'].\'/extensions/pun_attachment\',
\'dependencies\'	=> array (
)
);
$ext_info = $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];

if (!$forum_config[\'attach_disable_attach\'])
			{
				remove_attachments($attach_query, $cur_post);
			}

array_pop($GLOBALS[\'ext_info_stack\']);
$ext_info = empty($GLOBALS[\'ext_info_stack\']) ? array() : $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];
',
  ),
  'mi_new_action' => 
  array (
    0 => '$GLOBALS[\'ext_info_stack\'][] = array(
\'id\'				=> \'pun_attachment\',
\'path\'			=> FORUM_ROOT.\'extensions/pun_attachment\',
\'url\'			=> $GLOBALS[\'base_url\'].\'/extensions/pun_attachment\',
\'dependencies\'	=> array (
)
);
$ext_info = $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];

if ($action == \'pun_attachment\' && !$forum_config[\'attach_disable_attach\'] && isset($_GET[\'item\']))
			{
				$attach_item = intval($_GET[\'item\']);
				if ($attach_item < 1)
					message($lang_common[\'Bad request\']);

				if (isset($_GET[\'secure_str\']))
				{
					preg_match(\'~(\\d+)f(\\d+)~\', $_GET[\'secure_str\'], $match);
					if (isset($match[0]))
					{
						$query = array(
							\'SELECT\'	=>	\'a.id, a.post_id, a.topic_id, a.owner_id, a.filename, a.file_ext, a.file_mime_type, a.size, a.file_path, a.secure_str\',
							\'FROM\'		=>	\'attach_files AS a\',
							\'JOINS\'		=>	array(
								array(
									\'INNER JOIN\' => \'forums AS f\',
									\'ON\'		=> \'f.id = \'.$match[2]
								),
								array(
									\'LEFT JOIN\'	=> \'forum_perms AS fp\',
									\'ON\'		=> \'(fp.forum_id = f.id AND fp.group_id = \'.$forum_user[\'g_id\'].\')\'
								)
							),
							\'WHERE\'		=> \'a.id = \'.$attach_item.\' AND (fp.read_forum IS NULL OR fp.read_forum = 1) AND secure_str = \\\'\'.$match[0].\'\\\'\'
						);
					}
					else
					{
						preg_match(\'~(\\d+)t(\\d+)~\', $_GET[\'secure_str\'], $match);
						if (isset($match[0]))
						{
							$query = array(
								\'SELECT\'	=>	\'a.id, a.post_id, a.topic_id, a.owner_id, a.filename, a.file_ext, a.file_mime_type, a.size, a.file_path, a.secure_str\',
								\'FROM\'		=>	\'attach_files AS a\',
								\'JOINS\'		=>	array(
									array(
										\'INNER JOIN\'	=> \'topics AS t\',
										\'ON\'		=> \'t.id = \'.$match[2]
									),
									array(
										\'INNER JOIN\'	=> \'forums AS f\',
										\'ON\'		=> \'f.id = t.forum_id\'
									),
									array(
										\'LEFT JOIN\'		=> \'forum_perms AS fp\',
										\'ON\'		=> \'(fp.forum_id = f.id AND fp.group_id = \'.$forum_user[\'g_id\'].\')\'
									)
								),
								\'WHERE\'		=> \'a.id = \'.$attach_item.\' AND (fp.read_forum IS NULL OR fp.read_forum = 1) AND secure_str = \\\'\'.$match[0].\'\\\'\'
							);
						}
						else
							message($lang_common[\'Bad request\']);
					}
					if ($forum_user[\'id\'] != $match[1])
						message($lang_common[\'Bad request\']);
				} else {
					$query = array(
						\'SELECT\'	=> \'a.id, a.post_id, a.topic_id, a.owner_id, a.filename, a.file_ext, a.file_mime_type, a.size, a.file_path, a.secure_str\',
						\'FROM\'		=> \'attach_files AS a\',
						\'JOINS\'		=> array(
							array(
								\'INNER JOIN\'	=> \'topics AS t\',
								\'ON\'			=> \'t.id = a.topic_id\'
							),
							array(
								\'INNER JOIN\'	=> \'forums AS f\',
								\'ON\'			=> \'f.id = t.forum_id\'
							),
							array(
								\'LEFT JOIN\'		=> \'forum_perms AS fp\',
								\'ON\'			=> \'(fp.forum_id = f.id AND fp.group_id = \'.$forum_user[\'g_id\'].\')\'
							)
						),
						\'WHERE\'		=> \'a.id = \'.$attach_item.\' AND (fp.read_forum IS NULL OR fp.read_forum = 1)\'
					);
				}

				$result = $forum_db->query_build($query) or error(__FILE__, __LINE__);
				$attach_info = $forum_db->fetch_assoc($result);

				if (!$attach_info)
					message($lang_common[\'Bad request\']);

				$query = array(
					\'SELECT\'	=> \'g_pun_attachment_allow_download\',
					\'FROM\'		=> \'groups\',
					\'WHERE\'		=> \'g_id = \'.$forum_user[\'group_id\']
				);
				$result = $forum_db->query_build($query) or error(__FILE__, __LINE__);
				$perms = $forum_db->fetch_assoc($result);

				if (!$perms) {
					message($lang_common[\'No permission\']);
				}

				if ($forum_user[\'g_id\'] != FORUM_ADMIN && !$perms[\'g_pun_attachment_allow_download\']) {
					message($lang_common[\'No permission\']);
				}

				if (isset($_GET[\'preview\']) && in_array($attach_info[\'file_ext\'], array(\'png\', \'jpg\', \'gif\', \'tiff\')))
				{
					if (file_exists($ext_info[\'path\'].\'/lang/\'.$forum_user[\'language\'].\'/\'.$ext_info[\'id\'].\'.php\'))
						require $ext_info[\'path\'].\'/lang/\'.$forum_user[\'language\'].\'/\'.$ext_info[\'id\'].\'.php\';
					else
						require $ext_info[\'path\'].\'/lang/English/\'.$ext_info[\'id\'].\'.php\';
					require $ext_info[\'path\'].\'/url.php\';

					$forum_page = array();
					$forum_page[\'download_link\'] = !empty($attach_info[\'secure_str\']) ? forum_link($attach_url[\'misc_download_secure\'], array($attach_item, $attach_info[\'secure_str\'])) : forum_link($attach_url[\'misc_download\'], $attach_item);
					$forum_page[\'view_link\'] = !empty($attach_info[\'secure_str\']) ? forum_link($attach_url[\'misc_view_secure\'], array($attach_item, $attach_info[\'secure_str\'])) : forum_link($attach_url[\'misc_view\'], $attach_info[\'id\']);

					// Setup breadcrumbs
					$forum_page[\'crumbs\'] = array(
						array($forum_config[\'o_board_title\'], forum_link($forum_url[\'index\'])),
						$lang_attach[\'Image preview\']
					);

					define(\'FORUM_PAGE\', \'attachment-preview\');
					require FORUM_ROOT.\'header.php\';

					// START SUBST - <!-- forum_main -->
					ob_start();

					?>
					<div class="main-head">
						<h2 class="hn"><span><?php echo $lang_attach[\'Image preview\']; ?></span></h2>
					</div>

					<div class="main-content main-frm">
						<div class="content-head">
							<h2 class="hn"><span><?php echo $attach_info[\'filename\']; ?></span></h2>
						</div>
						<fieldset class="frm-group group1">
							<span class="show-image"><img src="<?php echo $forum_page[\'view_link\']; ?>" alt="<?php echo forum_htmlencode($attach_info[\'filename\']); ?>" /></span>
							<p><?php echo $lang_attach[\'Download:\']; ?> <a href="<?php echo $forum_page[\'download_link\']; ?>"><?php echo forum_htmlencode($attach_info[\'filename\']); ?></a></p>
						</fieldset>
					</div>
					<?php

					$tpl_temp = trim(ob_get_contents());
					$tpl_main = str_replace(\'<!-- forum_main -->\', $tpl_temp, $tpl_main);
					ob_end_clean();
					// END SUBST - <!-- forum_main -->

					require FORUM_ROOT.\'footer.php\';
				}
				else
				{
					$fp = fopen($forum_config[\'attach_basefolder\'].$attach_info[\'file_path\'], \'rb\');

					if (!$fp)
						message($lang_common[\'Bad request\']);
					else
					{
						header(\'Content-Disposition: attachment; filename="\'.$attach_info[\'filename\'].\'"\');
						header(\'Content-Type: \'.$attach_info[\'file_mime_type\']);
						header(\'Pragma: no-cache\');
						header(\'Expires: 0\');
						header(\'Connection: close\');
						header(\'Content-Length: \'.$attach_info[\'size\']);

						fpassthru($fp);

						if (isset($_GET[\'download\']) && intval($_GET[\'download\']) == 1) {
							$query = array(
								\'UPDATE\'	=> \'attach_files\',
								\'SET\'		=> \'download_counter=download_counter+1\',
								\'WHERE\'		=> \'id=\'.$attach_item
							);
							$result = $forum_db->query_build($query) or error(__FILE__, __LINE__);
						}


						// End the transaction
						$forum_db->end_transaction();

						// Close the db connection (and free up any result data)
						$forum_db->close();

						exit();
					}
				}
			}

array_pop($GLOBALS[\'ext_info_stack\']);
$ext_info = empty($GLOBALS[\'ext_info_stack\']) ? array() : $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];
',
    1 => '$GLOBALS[\'ext_info_stack\'][] = array(
\'id\'				=> \'pun_forum_news\',
\'path\'			=> FORUM_ROOT.\'extensions/pun_forum_news\',
\'url\'			=> $GLOBALS[\'base_url\'].\'/extensions/pun_forum_news\',
\'dependencies\'	=> array (
)
);
$ext_info = $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];

if ($action == \'news\')
			{
				$pun_forum_news_query = array(
					\'SELECT\'	=>	\'post_id\',
					\'FROM\'		=>	\'pun_forum_news AS news\',
					\'JOINS\'		=>	array(
						array(
							\'LEFT JOIN\'	=> \'forum_perms AS fp\',
							\'ON\'		=> \'(fp.forum_id = news.forum_id AND fp.group_id = \'.$forum_user[\'g_id\'].\')\'
						)
					),
					\'WHERE\'		=>	\'(fp.read_forum IS NULL OR fp.read_forum = 1)\',
					\'ORDER BY\'	=>	\'news.posted DESC\'
				);
				$pun_forum_news_result = $forum_db->query_build($pun_forum_news_query) or error(__FILE__, __LINE__);

				$no_news = FALSE;
				$post_news_id = array();

				while ($cur_news = $forum_db->fetch_assoc($pun_forum_news_result))
					$post_news_id[] = $cur_news[\'post_id\'];

				if (count($post_news_id) > 0)
				{
					$news_count = count($post_news_id);
					$forum_page[\'num_pages\'] = ceil($news_count / $forum_user[\'disp_posts\']);
					$forum_page[\'page\'] = (!isset($_GET[\'p\']) || !is_numeric($_GET[\'p\']) || $_GET[\'p\'] <= 1 || $_GET[\'p\'] > $forum_page[\'num_pages\']) ? 1 : $_GET[\'p\'];
					$forum_page[\'start_from\'] = $forum_user[\'disp_posts\'] * ($forum_page[\'page\'] - 1);
					$forum_page[\'finish_at\'] = min(($forum_page[\'start_from\'] + $forum_user[\'disp_posts\']), ($news_count + 1));
					$forum_page[\'items_info\'] =  generate_items_info($lang_pun_forum_news[\'Forum news\'], ($forum_page[\'start_from\'] + 1), $news_count);

					$post_news_id = array_slice($post_news_id, $forum_page[\'start_from\'], $forum_page[\'finish_at\']);
					$pun_forum_news_query = array(
						\'SELECT\'	=>	\'news.*, u.avatar, u.avatar_width, u.avatar_height\',
						\'FROM\'		=>	\'pun_forum_news AS news\',
						\'JOINS\'		=> array(
							array(
								\'INNER JOIN\'	=> \'users AS u\',
								\'ON\'			=> \'u.id=news.poster_id\'
							),
						),
						\'WHERE\'		=>	\'post_id IN (\'.implode(\',\', $post_news_id).\')\'
					);
					$query_result = $forum_db->query_build($pun_forum_news_query) or error(__FILE__, __LINE__);

					$posts_info = array();
					while ($cur_post = $forum_db->fetch_assoc($query_result))
					{
						$tmp_index = array_search($cur_post[\'post_id\'], $post_news_id);
						$posts_info[$tmp_index] = $cur_post;
					}
					ksort($posts_info);
					unset($post_news_id);
				}
				else
					$no_news = TRUE;

				if ($no_news)
					message($lang_pun_forum_news[\'No news\']);

				if ($forum_page[\'page\'] < $forum_page[\'num_pages\'])
				{
					$forum_page[\'nav\'][\'last\'] = \'<link rel="last" href="\'.forum_sublink($forum_url[\'pun_forum_news\'], $forum_url[\'pun_forum_news_page\'], $forum_page[\'num_pages\']).\'" title="\'.$lang_common[\'Page\'].\' \'.$forum_page[\'num_pages\'].\'" />\';
					$forum_page[\'nav\'][\'next\'] = \'<link rel="next" href="\'.forum_sublink($forum_url[\'pun_forum_news\'], $forum_url[\'pun_forum_news_page\'], ($forum_page[\'page\'] + 1)).\'" title="\'.$lang_common[\'Page\'].\' \'.($forum_page[\'page\'] + 1).\'" />\';
				}
				if ($forum_page[\'page\'] > 1)
				{
					$forum_page[\'nav\'][\'prev\'] = \'<link rel="prev" href="\'.forum_sublink($forum_url[\'pun_forum_news\'], $forum_url[\'pun_forum_news_page\'], ($forum_page[\'page\'] - 1)).\'" title="\'.$lang_common[\'Page\'].\' \'.($forum_page[\'page\'] - 1).\'" />\';
					$forum_page[\'nav\'][\'first\'] = \'<link rel="first" href="\'.forum_link($forum_url[\'pun_forum_news\']).\'" title="\'.$lang_common[\'Page\'].\' 1" />\';
				}

				// Generate paging and posting links
				$forum_page[\'page_post\'][\'paging\'] = \'<p class="paging"><span class="pages">\'.$lang_common[\'Pages\'].\'</span> \'.paginate($forum_page[\'num_pages\'], $forum_page[\'page\'], $forum_url[\'pun_forum_news\'], $lang_common[\'Paging separator\']).\'</p>\';

				// Setup breadcrumbs
				$forum_page[\'crumbs\'] = array(
					array($forum_config[\'o_board_title\'], forum_link($forum_url[\'index\'])),
					$lang_pun_forum_news[\'Forum news\']
				);
				require FORUM_ROOT.\'lang/\'.$forum_user[\'language\'].\'/topic.php\';
				require FORUM_ROOT.\'include/parser.php\';

				$user_data_cache = array();

				define(\'FORUM_PAGE\', \'news\');
				require FORUM_ROOT.\'header.php\';
				// START SUBST - <!-- forum_main -->
				ob_start();

				?>
				<div class="main-head">
					<p class="options"><span class="feed first-item"><a class="feed" href="<?php echo forum_link($forum_url[\'pun_forum_news_rss\']); ?>"><?php echo $lang_pun_forum_news[\'RSS news feed\']; ?></a></span></p>
					<h2 class="hn"><span><?php echo $forum_page[\'items_info\'] ?></span></h2>
				</div>
				<div class="main-content main-topic">
				<?php

				$forum_page[\'item_count\'] = 0;
				$author_data_cache = array();
				foreach ($posts_info as $post_num => $post_info)
				{
					$forum_page[\'item_count\']++;
					$forum_page[\'author_ident\'] = $forum_page[\'message\'] = array();


					$forum_page[\'post_ident\'][\'link\'] = \'<span class="post-link"><a class="permalink" rel="bookmark" title="\'.$lang_topic[\'Permalink post\'].\'" href="\'.forum_link($forum_url[\'post\'], $post_info[\'post_id\']).\'">\'.format_time($post_info[\'posted\']).\'</a></span>\';

					if (isset($author_data_cache[$post_info[\'poster_id\']]))
						$forum_page[\'post_ident\'][\'author\'] = $author_data_cache[$post_info[\'poster_id\']][\'name\'];
					else
					{
						if ($forum_user[\'g_view_users\'] == \'1\')
							$forum_page[\'post_ident\'][\'author\'] = \'<span class="post-byline"><a title="\'.sprintf($lang_topic[\'Go to profile\'], forum_htmlencode($post_info[\'poster\'])).\'" href="\'.forum_link($forum_url[\'user\'], $post_info[\'poster_id\']).\'">\'.forum_htmlencode($post_info[\'poster\']).\'</a></span>\';
						else
							$forum_page[\'post_ident\'][\'author\'] = \'<span class="post-byline"><strong>\'.forum_htmlencode($post_info[\'poster\']).\'</strong></span>\';

						$author_data_cache[$post_info[\'poster_id\']][\'name\'] = $forum_page[\'post_ident\'][\'author\'];
					}

					if (isset($author_data_cache[$post_info[\'poster_id\']][\'avatar\']))
					{
						if (!empty($author_data_cache[$post_info[\'poster_id\']][\'avatar\']))
							$forum_page[\'author_ident\'][\'avatar\'] = $author_data_cache[$post_info[\'poster_id\']][\'avatar\'];
					}
					else
					{
						if ($post_info[\'poster_id\'] > 1)
						{
							if ($forum_config[\'o_avatars\'] == \'1\' && $forum_user[\'show_avatars\'] != \'0\')
							{
								$forum_page[\'avatar_markup\'] = generate_avatar_markup($post_info[\'poster_id\'], $post_info[\'avatar\'], $post_info[\'avatar_width\'], $post_info[\'avatar_height\']);

								if (!empty($forum_page[\'avatar_markup\']))
								{
									$forum_page[\'author_ident\'][\'avatar\'] = \'<li class="useravatar">\'.$forum_page[\'avatar_markup\'].\'</li>\';
									$author_data_cache[$post_info[\'poster_id\']][\'avatar\'] = $forum_page[\'author_ident\'][\'avatar\'];
								}
								else
									$author_data_cache[$post_info[\'poster_id\']][\'avatar\'] = \'\';
							}
						}
					}

					// Give the post some class
					$forum_page[\'item_status\'] = array(
						\'post\',
						($forum_page[\'item_count\'] % 2 != 0) ? \'odd\' : \'even\'
					);

					if ($forum_page[\'item_count\'] == 1)
						$forum_page[\'item_status\'][\'firstpost\'] = \'firstpost\';

					if (($forum_page[\'start_from\'] + $forum_page[\'item_count\']) == $forum_page[\'finish_at\'])
						$forum_page[\'item_status\'][\'lastpost\'] = \'lastpost\';

					// Perform the main parsing of the message (BBCode, smilies, censor words etc)
					$forum_page[\'message\'][\'message\'] = parse_message($post_info[\'message\'], $post_info[\'hide_smilies\']);

					if ($forum_config[\'o_censoring\'] == \'1\')
						$forum_page[\'message\'][\'message\'] = censor_words($forum_page[\'message\'][\'message\']);

			?>
					<div class="<?php echo implode(\' \', $forum_page[\'item_status\']) ?>">
						<div id="p<?php echo $post_info[\'post_id\'] ?>" class="posthead">
							<h3 class="hn post-ident"><?php echo implode(\' \', $forum_page[\'post_ident\']) ?></h3>
						</div>
						<div class="postbody">
							<div class="post-author">
								<ul class="author-ident">
									<?php echo implode("\\n\\t\\t\\t\\t\\t\\t", $forum_page[\'author_ident\'])."\\n" ?>
								</ul>
							</div>
							<div class="post-entry">
								<div class="entry-content">
									<?php echo implode("\\n\\t\\t\\t\\t\\t\\t", $forum_page[\'message\'])."\\n" ?>
								</div>
							</div>
						</div>
					</div>
			<?php

				}

				?>
				</div>
				<div class="main-foot">
					<h2 class="hn"><span><?php echo $forum_page[\'items_info\'] ?></span></h2>
				</div>

				<?php

				$tpl_temp = forum_trim(ob_get_contents());
				$tpl_main = str_replace(\'<!-- forum_main -->\', $tpl_temp, $tpl_main);
				ob_end_clean();
				// END SUBST - <!-- forum_main -->

				require FORUM_ROOT.\'footer.php\';
			}

array_pop($GLOBALS[\'ext_info_stack\']);
$ext_info = empty($GLOBALS[\'ext_info_stack\']) ? array() : $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];
',
    2 => '$GLOBALS[\'ext_info_stack\'][] = array(
\'id\'				=> \'pun_pm\',
\'path\'			=> FORUM_ROOT.\'extensions/pun_pm\',
\'url\'			=> $GLOBALS[\'base_url\'].\'/extensions/pun_pm\',
\'dependencies\'	=> array (
)
);
$ext_info = $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];

if ($action == \'pun_pm_send\' && !$forum_user[\'is_guest\'])
{
	if(!defined(\'PUN_PM_FUNCTIONS_LOADED\'))
		require $ext_info[\'path\'].\'/functions.php\';

	if (!isset($lang_pun_pm))
	{
		if (file_exists($ext_info[\'path\'].\'/lang/\'.$forum_user[\'language\'].\'/\'.$ext_info[\'id\'].\'.php\'))
			include $ext_info[\'path\'].\'/lang/\'.$forum_user[\'language\'].\'/\'.$ext_info[\'id\'].\'.php\';
		else
			include $ext_info[\'path\'].\'/lang/English/\'.$ext_info[\'id\'].\'.php\';
	}

	$pun_pm_body = isset($_POST[\'req_message\']) ? $_POST[\'req_message\'] : \'\';
	$pun_pm_subject = isset($_POST[\'pm_subject\']) ? $_POST[\'pm_subject\'] : \'\';
	$pun_pm_receiver_username = isset($_POST[\'pm_receiver\']) ? $_POST[\'pm_receiver\'] : \'\';
	$pun_pm_message_id = isset($_POST[\'message_id\']) ? (int) $_POST[\'message_id\'] : false;

	if (isset($_POST[\'send_action\']) && in_array($_POST[\'send_action\'], array(\'send\', \'draft\', \'delete\', \'preview\')))
		$pun_pm_send_action = $_POST[\'send_action\'];
	elseif (isset($_POST[\'pm_draft\']))
		$pun_pm_send_action = \'draft\';
	elseif (isset($_POST[\'pm_send\']))
		$pun_pm_send_action = \'send\';
	elseif (isset($_POST[\'pm_delete\']))
		$pun_pm_send_action = \'delete\';
	else
		$pun_pm_send_action = \'preview\';

	($hook = get_hook(\'pun_pm_after_send_action_set\')) ? eval($hook) : null;

	if ($pun_pm_send_action == \'draft\')
	{
		// Try to save the message as draft
		// Inside this function will be a redirect, if everything is ok
		$pun_pm_errors = pun_pm_save_message($pun_pm_body, $pun_pm_subject, $pun_pm_receiver_username, $pun_pm_message_id);
		// Remember $pun_pm_message_id = false; inside this function if $pun_pm_message_id is incorrect

		// Well... Go processing errors

		// We need no preview
		$pun_pm_msg_preview = false;
	}
	elseif ($pun_pm_send_action == \'send\')
	{
		// Try to send the message
		// Inside this function will be a redirect, if everything is ok
		$pun_pm_errors = pun_pm_send_message($pun_pm_body, $pun_pm_subject, $pun_pm_receiver_username, $pun_pm_message_id);
		// Remember $pun_pm_message_id = false; inside this function if $pun_pm_message_id is incorrect

		// Well... Go processing errors

		// We need no preview
		$pun_pm_msg_preview = false;
	}
	elseif ($pun_pm_send_action == \'delete\' && $pun_pm_message_id !== false)
	{
		pun_pm_delete_from_outbox(array($pun_pm_message_id));
		redirect(forum_link($forum_url[\'pun_pm_outbox\']), $lang_pun_pm[\'Message deleted\']);
	}
	elseif ($pun_pm_send_action == \'preview\')
	{
		// Preview message
		$pun_pm_errors = array();
		$pun_pm_msg_preview = pun_pm_preview($pun_pm_receiver_username, $pun_pm_subject, $pun_pm_body, $pun_pm_errors);
	}

	($hook = get_hook(\'pun_pm_new_send_action\')) ? eval($hook) : null;

	$pun_pm_page_text = pun_pm_send_form($pun_pm_receiver_username, $pun_pm_subject, $pun_pm_body, $pun_pm_message_id, false, false, $pun_pm_msg_preview);

	// Setup navigation menu
	$forum_page[\'main_menu\'] = array(
		\'inbox\'		=> \'<li class="first-item"><a href="\'.forum_link($forum_url[\'pun_pm_inbox\']).\'"><span>\'.$lang_pun_pm[\'Inbox\'].\'</span></a></li>\',
		\'outbox\'	=> \'<li><a href="\'.forum_link($forum_url[\'pun_pm_outbox\']).\'"><span>\'.$lang_pun_pm[\'Outbox\'].\'</span></a></li>\',
		\'write\'		=> \'<li class="active"><a href="\'.forum_link($forum_url[\'pun_pm_write\']).\'"><span>\'.$lang_pun_pm[\'Compose message\'].\'</span></a></li>\',
	);

	// Setup breadcrumbs
	$forum_page[\'crumbs\'] = array(
		array($forum_config[\'o_board_title\'], forum_link($forum_url[\'index\'])),
		array($lang_pun_pm[\'Private messages\'], forum_link($forum_url[\'pun_pm\'])),
		array($lang_pun_pm[\'Compose message\'], forum_link($forum_url[\'pun_pm_write\']))
	);

	($hook = get_hook(\'pun_pm_pre_send_output\')) ? eval($hook) : null;

	define(\'FORUM_PAGE\', \'pun_pm-write\');
	require FORUM_ROOT.\'header.php\';

	// START SUBST - <!-- forum_main -->
	ob_start();

	echo $pun_pm_page_text;

	$tpl_temp = trim(ob_get_contents());
	$tpl_main = str_replace(\'<!-- forum_main -->\', $tpl_temp, $tpl_main);
	ob_end_clean();
	// END SUBST - <!-- forum_main -->

	require FORUM_ROOT.\'footer.php\';
}

$section = isset($_GET[\'section\']) ? $_GET[\'section\'] : null;

if ($section == \'pun_pm\' && !$forum_user[\'is_guest\'])
{
	if (!isset($lang_pun_pm))
	{
		if (file_exists($ext_info[\'path\'].\'/lang/\'.$forum_user[\'language\'].\'/\'.$ext_info[\'id\'].\'.php\'))
			include $ext_info[\'path\'].\'/lang/\'.$forum_user[\'language\'].\'/\'.$ext_info[\'id\'].\'.php\';
		else
			include $ext_info[\'path\'].\'/lang/English/\'.$ext_info[\'id\'].\'.php\';
	}

	if (!defined(\'PUN_PM_FUNCTIONS_LOADED\'))
		require $ext_info[\'path\'].\'/functions.php\';

	$pun_pm_page = isset($_GET[\'pmpage\']) ? $_GET[\'pmpage\'] : \'\';

	($hook = get_hook(\'pun_pm_pre_page_building\')) ? eval($hook) : null;

	// pun_pm_get_page() performs everything :)
	// Remember $pun_pm_page correction inside pun_pm_get_page() if this variable is incorrect
	$pun_pm_page_text = pun_pm_get_page($pun_pm_page);

	// Setup navigation menu
	$forum_page[\'main_menu\'] = array(
		\'inbox\'		=> \'<li class="first-item\'.($pun_pm_page == \'inbox\' ? \' active\' : \'\').\'"><a href="\'.forum_link($forum_url[\'pun_pm_inbox\']).\'"><span>\'.$lang_pun_pm[\'Inbox\'].\'</span></a></li>\',
		\'outbox\'	=> \'<li\'.(($pun_pm_page == \'outbox\') ? \' class="active"\' : \'\').\'><a href="\'.forum_link($forum_url[\'pun_pm_outbox\']).\'"><span>\'.$lang_pun_pm[\'Outbox\'].\'</span></a></li>\',
		\'write\'		=> \'<li\'.(($pun_pm_page == \'write\' || $pun_pm_page == \'compose\') ? \' class="active"\' : \'\').\'><a href="\'.forum_link($forum_url[\'pun_pm_write\']).\'"><span>\'.$lang_pun_pm[\'Compose message\'].\'</span></a></li>\',
	);

	// Setup breadcrumbs
	$forum_page[\'crumbs\'] = array(
		array($forum_config[\'o_board_title\'], forum_link($forum_url[\'index\'])),
		array($lang_pun_pm[\'Private messages\'], forum_link($forum_url[\'pun_pm\']))
	);

	if ($pun_pm_page == \'inbox\')
		$forum_page[\'crumbs\'][] = array($lang_pun_pm[\'Inbox\'], forum_link($forum_url[\'pun_pm_inbox\']));
	else if ($pun_pm_page == \'outbox\')
		$forum_page[\'crumbs\'][] = array($lang_pun_pm[\'Outbox\'], forum_link($forum_url[\'pun_pm_outbox\']));
	else if ($pun_pm_page == \'write\' || $pun_pm_page == \'compose\')
		$forum_page[\'crumbs\'][] = array($lang_pun_pm[\'Compose message\'], forum_link($forum_url[\'pun_pm_write\']));

	($hook = get_hook(\'pun_pm_pre_page_output\')) ? eval($hook) : null;

	define(\'FORUM_PAGE\', \'pun_pm-\'.$pun_pm_page);
	require FORUM_ROOT.\'header.php\';

	// START SUBST - <!-- forum_main -->
	ob_start();

	echo $pun_pm_page_text;

	$tpl_temp = trim(ob_get_contents());
	$tpl_main = str_replace(\'<!-- forum_main -->\', $tpl_temp, $tpl_main);
	ob_end_clean();
	// END SUBST - <!-- forum_main -->

	require FORUM_ROOT.\'footer.php\';
}

array_pop($GLOBALS[\'ext_info_stack\']);
$ext_info = empty($GLOBALS[\'ext_info_stack\']) ? array() : $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];
',
    3 => '$GLOBALS[\'ext_info_stack\'][] = array(
\'id\'				=> \'fancy_alerts\',
\'path\'			=> FORUM_ROOT.\'extensions/fancy_alerts\',
\'url\'			=> $GLOBALS[\'base_url\'].\'/extensions/fancy_alerts\',
\'dependencies\'	=> array (
)
);
$ext_info = $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];

//
				if ($action == \'fancy_alerts_topics_mark_read\') {
					$fancy_alerts = new Fancy_alerts;
					$fancy_alerts->action_topics_mark_read();
				}

				//
				if ($action == \'fancy_alerts_quotes_mark_read\') {
					$fancy_alerts = new Fancy_alerts;
					$fancy_alerts->action_quotes_mark_read();
				}

				//
				if ($action == \'fancy_alerts_topics_on\') {
					$fancy_alerts = new Fancy_alerts;
					$fancy_alerts->action_alerts_topics_on();
				}

				//
				if ($action == \'fancy_alerts_topics_off\') {
					$fancy_alerts = new Fancy_alerts;
					$fancy_alerts->action_alerts_topics_off();
				}

				// FOR ASYNC STATUS UPDATE
				if ($action == \'fancy_alerts_update_status\') {
					$fancy_alerts = new Fancy_alerts;
					$fancy_alerts->action_get_status();
				}

array_pop($GLOBALS[\'ext_info_stack\']);
$ext_info = empty($GLOBALS[\'ext_info_stack\']) ? array() : $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];
',
    4 => '$GLOBALS[\'ext_info_stack\'][] = array(
\'id\'				=> \'fancy_js_cache\',
\'path\'			=> FORUM_ROOT.\'extensions/fancy_js_cache\',
\'url\'			=> $GLOBALS[\'base_url\'].\'/extensions/fancy_js_cache\',
\'dependencies\'	=> array (
)
);
$ext_info = $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];

if ($action == \'fancy_js_cache_clear\') {
				if (!$forum_user[\'is_admmod\']) {
					message($lang_common[\'No permission\']);
				}

				if (!isset($lang_fancy_js_cache)) {
					if (file_exists($ext_info[\'path\'].\'/lang/\'.$forum_user[\'language\'].\'/\'.$ext_info[\'id\'].\'.php\')) {
						require $ext_info[\'path\'].\'/lang/\'.$forum_user[\'language\'].\'/\'.$ext_info[\'id\'].\'.php\';
					} else {
						require $ext_info[\'path\'].\'/lang/English/\'.$ext_info[\'id\'].\'.php\';
					}
				}

				// We validate the CSRF token. If it\'s set in POST and we\'re at this point, the token is valid.
				// If it\'s in GET, we need to make sure it\'s valid.
				if (!isset($_POST[\'csrf_token\']) && (!isset($_GET[\'csrf_token\']) || $_GET[\'csrf_token\'] !== generate_form_token(\'fancy_js_cache_clear\'.$forum_user[\'id\']))) {
					csrf_confirm_form();
				}

				fancy_js_cacher_clear_cache();

				$forum_flash->add_info($lang_fancy_js_cache[\'Clear Cache redirect\']);

				redirect(forum_link($forum_url[\'admin_extensions_manage\']), $lang_fancy_js_cache[\'Clear Cache redirect\']);
			}

array_pop($GLOBALS[\'ext_info_stack\']);
$ext_info = empty($GLOBALS[\'ext_info_stack\']) ? array() : $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];
',
    5 => '$GLOBALS[\'ext_info_stack\'][] = array(
\'id\'				=> \'last_topic_title_on_forum_index\',
\'path\'			=> FORUM_ROOT.\'extensions/last_topic_title_on_forum_index\',
\'url\'			=> $GLOBALS[\'base_url\'].\'/extensions/last_topic_title_on_forum_index\',
\'dependencies\'	=> array (
)
);
$ext_info = $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];

if ($action == \'sync_forum_last_title\') {
				if (!$forum_user[\'is_admmod\']) {
					message($lang_common[\'No permission\']);
				}

				// We validate the CSRF token. If it\'s set in POST and we\'re at this point, the token is valid.
				// If it\'s in GET, we need to make sure it\'s valid.
				if (!isset($_POST[\'csrf_token\']) && (!isset($_GET[\'csrf_token\']) || $_GET[\'csrf_token\'] !== generate_form_token(\'sync_forum_last_title\'.$forum_user[\'id\']))) {
					csrf_confirm_form();
				}

				$query = array(
					\'SELECT\'	=> \'id\',
					\'FROM\'		=> \'forums\'
				);
				$result = $forum_db->query_build($query) or error(__FILE__, __LINE__);

				while ($cur_forum = $forum_db->fetch_assoc($result)) {
					sync_forum(intval($cur_forum[\'id\'], 10));
				}

				// Lang
				if (!isset($lang_last_topic_title_on_forum_index)) {
					if ($forum_user[\'language\'] != \'English\' && file_exists($ext_info[\'path\'].\'/lang/\'.$forum_user[\'language\'].\'/\'.$ext_info[\'id\'].\'.php\')) {
						require $ext_info[\'path\'].\'/lang/\'.$forum_user[\'language\'].\'/\'.$ext_info[\'id\'].\'.php\';
					} else {
						require $ext_info[\'path\'].\'/lang/English/\'.$ext_info[\'id\'].\'.php\';
					}
				}

				$forum_flash->add_info($lang_last_topic_title_on_forum_index[\'All forums synced\']);
				redirect(forum_link($forum_url[\'admin_extensions_manage\']), $lang_last_topic_title_on_forum_index[\'All forums synced\']);
			}

array_pop($GLOBALS[\'ext_info_stack\']);
$ext_info = empty($GLOBALS[\'ext_info_stack\']) ? array() : $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];
',
  ),
  'aop_pre_redirect' => 
  array (
    0 => '$GLOBALS[\'ext_info_stack\'][] = array(
\'id\'				=> \'pun_attachment\',
\'path\'			=> FORUM_ROOT.\'extensions/pun_attachment\',
\'url\'			=> $GLOBALS[\'base_url\'].\'/extensions/pun_attachment\',
\'dependencies\'	=> array (
)
);
$ext_info = $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];

if ($section == \'pun_attach\')
			{
				redirect(forum_link($attach_url[\'admin_options_attach\']), $lang_admin_settings[\'Settings updated\'].\' \'.$lang_admin_common[\'Redirect\']);
			}

array_pop($GLOBALS[\'ext_info_stack\']);
$ext_info = empty($GLOBALS[\'ext_info_stack\']) ? array() : $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];
',
  ),
  'aop_new_section_validation' => 
  array (
    0 => '$GLOBALS[\'ext_info_stack\'][] = array(
\'id\'				=> \'pun_attachment\',
\'path\'			=> FORUM_ROOT.\'extensions/pun_attachment\',
\'url\'			=> $GLOBALS[\'base_url\'].\'/extensions/pun_attachment\',
\'dependencies\'	=> array (
)
);
$ext_info = $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];

if ($section == \'pun_attach\')
{
	if (!isset($form[\'use_icon\']) || $form[\'use_icon\'] != \'1\') $form[\'use_icon\'] = \'0\';
	if (!isset($form[\'create_orphans\']) || $form[\'create_orphans\'] != \'1\') $form[\'create_orphans\'] = \'0\';
	if (!isset($form[\'disable_attach\']) || $form[\'disable_attach\'] != \'1\') $form[\'disable_attach\'] = \'0\';
	if (!isset($form[\'disp_small\']) || $form[\'disp_small\'] != \'1\') $form[\'disp_small\'] = \'0\';

	if ($form[\'always_deny\'])
	{
		$form[\'always_deny\'] = preg_replace(\'/\\s/\',\'\',$form[\'always_deny\']);
		$match = preg_match(\'/(^[a-zA-Z0-9])+(([a-zA-Z0-9]+\\,)|([a-zA-Z0-9]))+([a-zA-Z0-9]+$)/\',$form[\'always_deny\']);

		if (!$match)
			message($lang_attach[\'Wrong deny\']);
	}

	if (preg_match(\'/^[0-9]+$/\', $form[\'small_height\']))
		$form[\'small_height\'] = intval($form[\'small_height\']);
	else
		$form[\'small_height\'] = $forum_config[\'attach_small_height\'];

	if (preg_match(\'/^[0-9]+$/\',$form[\'small_width\']))
		$form[\'small_width\'] = intval($form[\'small_width\']);
	else
		$form[\'small_width\'] = $forum_config[\'attach_small_width\'];

	$names = explode(\',\', $forum_config[\'attach_icon_name\']);
	$icons = explode(\',\', $forum_config[\'attach_icon_extension\']);

	$num_icons = count($icons);
	for ($i = 0; $i < $num_icons; $i++)
	{
		if (!empty($_POST[\'attach_ext_\'.$i]) && !empty($_POST[\'attach_ico_\'.$i]))
		{
			if (!preg_match("/^[a-zA-Z0-9]+$/", forum_trim($_POST[\'attach_ext_\'.$i])) && !preg_match("/^([a-zA-Z0-9]+\\.+(png|gif|jpeg|jpg|ico))+$/", forum_trim($_POST[\'attach_ico_\'.$i])))
				message($lang_attach[\'Wrong icon/name\']);

			$icons[$i] = trim($_POST[\'attach_ext_\'.$i]);
			$names[$i] = trim($_POST[\'attach_ico_\'.$i]);
		}
	}

	if (isset($_POST[\'add_field_icon\']) && isset($_POST[\'add_field_file\']))
	{
		if (!empty($_POST[\'add_field_icon\']) && !empty($_POST[\'add_field_file\']))
		{
			if (!(preg_match("/^[a-zA-Z0-9]+$/",trim($_POST[\'add_field_icon\'])) && preg_match("/^([a-zA-Z0-9]+\\.+(png|gif|jpeg|jpg|ico))+$/",trim($_POST[\'add_field_file\']))))
				message ($lang_attach[\'Wrong icon/name\']);

			$icons[] = trim($_POST[\'add_field_icon\']);
			$names[] = trim($_POST[\'add_field_file\']);
		}
	}

	$icons = implode(\',\', $icons);
	$icons = preg_replace(\'/\\,{2,}/\',\',\',$icons);
	$icons = preg_replace(\'/\\,{1,}+$/\',\'\',$icons);

	$names = implode(\',\', $names);
	$names = preg_replace(\'/\\,{2,}/\',\',\',$names);
	$names = preg_replace(\'/\\,{1,}+$/\',\'\',$names);

	$query = array(
		\'UPDATE\'	=> \'config\',
		\'SET\'		=> \'conf_value=\\\'\'.$forum_db->escape($icons).\'\\\'\',
		\'WHERE\'		=> \'conf_name = \\\'attach_icon_extension\\\'\'
	);
	$result = $forum_db->query_build($query) or error (__FILE__, __LINE__);

	$query = array(
		\'UPDATE\'	=> \'config\',
		\'SET\'		=> \'conf_value=\\\'\'.$forum_db->escape($names).\'\\\'\',
		\'WHERE\'		=> \'conf_name=\\\'attach_icon_name\\\'\'
	);
	$result = $forum_db->query_build($query) or error (__FILE__, __LINE__);
	}

	if ($section == \'list_attach\')
	{
	$query = array(
		\'SELECT\'	=> \'COUNT(id) AS num_attach\',
		\'FROM\'		=> \'attach_files\'
	);

	$result = $forum_db->query_build($query) or error(__FILE__, __LINE__);
	$num_attach = $forum_db->fetch_assoc($result);

	if (!is_null($num_attach) && $num_attach !== false)
	{
		for ($i = 0; $i < $num_attach[\'num_attach\']; $i++)
		{
			if (isset($_POST[\'attach_\'.$i]))
			{
				if (isset($_POST[\'attach_to_post_\'.$i]) && !empty($_POST[\'attach_to_post_\'.$i]))
				{
					$post_id = intval($_POST[\'attach_to_post_\'.$i]);
					$attach_id = intval($_POST[\'attachment_\'.$i]);
					$query = array(
						\'SELECT\'	=> \'id, topic_id, poster_id\',
						\'FROM\'		=> \'posts\',
						\'WHERE\'		=> \'id=\'.$post_id
					);
					$result = $forum_db->query_build($query) or error(__FILE__, __LINE__);

					$info = $forum_db->fetch_assoc($result);
					if (is_null($info) || $info === false)
						message ($lang_attach[\'Wrong post\']);

					$query = array(
						\'UPDATE\'	=> \'attach_files\',
						\'SET\'		=> \'post_id=\'.intval($info[\'id\']).\', topic_id=\'.intval($info[\'topic_id\']).\', owner_id=\'.intval($info[\'poster_id\']),
						\'WHERE\'		=> \'id=\'.$attach_id
					);
					$result = $forum_db->query_build($query) or error(__FILE__, __LINE__);

					redirect(forum_link($attach_url[\'admin_attachment_manage\']), $lang_attach[\'Attachment added\']);
				}
				else
					message ($lang_attach[\'Wrong post\']);
			}
		}
	}
}

array_pop($GLOBALS[\'ext_info_stack\']);
$ext_info = empty($GLOBALS[\'ext_info_stack\']) ? array() : $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];
',
  ),
  'aop_pre_update_configuration' => 
  array (
    0 => '$GLOBALS[\'ext_info_stack\'][] = array(
\'id\'				=> \'pun_attachment\',
\'path\'			=> FORUM_ROOT.\'extensions/pun_attachment\',
\'url\'			=> $GLOBALS[\'base_url\'].\'/extensions/pun_attachment\',
\'dependencies\'	=> array (
)
);
$ext_info = $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];

if ($section == \'pun_attach\')
			{
				while (list($key, $input) = @each($form))
				{
					if ($forum_config[\'attach_\'.$key] != $input)
					{
						if ($input != \'\' || is_int($input))
							$value = \'\\\'\'.$forum_db->escape($input).\'\\\'\';
						else
							$value = \'NULL\';

						$query = array(
							\'UPDATE\'	=> \'config\',
							\'SET\'		=> \'conf_value=\'.$value,
							\'WHERE\'		=> \'conf_name=\\\'attach_\'.$key.\'\\\'\'
						);

						$forum_db->query_build($query) or error(__FILE__,__LINE__);
					}
				}

				require_once FORUM_ROOT.\'include/cache.php\';
				generate_config_cache();

				redirect(forum_link($attach_url[\'admin_options_attach\']), $lang_admin_settings[\'Settings updated\'].\' \'.$lang_admin_common[\'Redirect\']);
			}

array_pop($GLOBALS[\'ext_info_stack\']);
$ext_info = empty($GLOBALS[\'ext_info_stack\']) ? array() : $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];
',
  ),
  'ca_fn_generate_admin_menu_new_sublink' => 
  array (
    0 => '$GLOBALS[\'ext_info_stack\'][] = array(
\'id\'				=> \'pun_attachment\',
\'path\'			=> FORUM_ROOT.\'extensions/pun_attachment\',
\'url\'			=> $GLOBALS[\'base_url\'].\'/extensions/pun_attachment\',
\'dependencies\'	=> array (
)
);
$ext_info = $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];

require $ext_info[\'path\'].\'/url.php\';
			if (file_exists($ext_info[\'path\'].\'/lang/\'.$forum_user[\'language\'].\'/\'.$ext_info[\'id\'].\'.php\'))
				require $ext_info[\'path\'].\'/lang/\'.$forum_user[\'language\'].\'/\'.$ext_info[\'id\'].\'.php\';
			else
				require $ext_info[\'path\'].\'/lang/English/\'.$ext_info[\'id\'].\'.php\';

			if ((FORUM_PAGE_SECTION == \'management\') && ($forum_user[\'g_id\'] == FORUM_ADMIN))
				$forum_page[\'admin_submenu\'][\'pun_attachment_management\'] = \'<li class="\'.((FORUM_PAGE == \'admin-attachment-manage\') ? \'active\' : \'normal\').((empty($forum_page[\'admin_menu\'])) ? \' first-item\' : \'\').\'"><a href="\'.forum_link($attach_url[\'admin_attachment_manage\']).\'">\'.$lang_attach[\'Attachment\'].\'</a></li>\';
			if ((FORUM_PAGE_SECTION == \'settings\') && ($forum_user[\'g_id\'] == FORUM_ADMIN))
				$forum_page[\'admin_submenu\'][\'pun_attachment_settings\'] = \'<li class="\'.((FORUM_PAGE == \'admin-options-attach\') ? \'active\' : \'normal\').((empty($forum_page[\'admin_menu\'])) ? \' first-item\' : \'\').\'"><a href="\'.forum_link($attach_url[\'admin_options_attach\']).\'">\'.$lang_attach[\'Attachment\'].\'</a></li>\';

array_pop($GLOBALS[\'ext_info_stack\']);
$ext_info = empty($GLOBALS[\'ext_info_stack\']) ? array() : $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];
',
    1 => '$GLOBALS[\'ext_info_stack\'][] = array(
\'id\'				=> \'pun_stop_bots\',
\'path\'			=> FORUM_ROOT.\'extensions/pun_stop_bots\',
\'url\'			=> $GLOBALS[\'base_url\'].\'/extensions/pun_stop_bots\',
\'dependencies\'	=> array (
)
);
$ext_info = $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];

if ($forum_user[\'g_id\'] == FORUM_ADMIN && FORUM_PAGE_SECTION == \'settings\')
			{
				global $lang_pun_stop_bots;

				if (!isset($forum_url[\'pun_stop_bots_section\']))
					include $ext_info[\'path\'].\'/url/Default.php\';

				if (!isset($lang_pun_stop_bots))
				{
					if (file_exists($ext_info[\'path\'].\'/lang/\'.$forum_user[\'language\'].\'/\'.$ext_info[\'id\'].\'.php\'))
						include $ext_info[\'path\'].\'/lang/\'.$forum_user[\'language\'].\'/\'.$ext_info[\'id\'].\'.php\';
					else
						include $ext_info[\'path\'].\'/lang/English/\'.$ext_info[\'id\'].\'.php\';
				}

				$forum_page[\'admin_submenu\'][\'pun_stop_bots_questions\'] = \'<li class="\'.((FORUM_PAGE == \'admin-pun_stop_bots_questions\') ? \'active\' : \'normal\').((empty($forum_page[\'admin_submenu\'])) ? \' first-item\' : \'\').\'"><a href="\'.forum_link($forum_url[\'pun_stop_bots_section\']).\'">\'.$lang_pun_stop_bots[\'Management tab\'].\'</a></li>\';
			}

array_pop($GLOBALS[\'ext_info_stack\']);
$ext_info = empty($GLOBALS[\'ext_info_stack\']) ? array() : $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];
',
    2 => '$GLOBALS[\'ext_info_stack\'][] = array(
\'id\'				=> \'pun_tags\',
\'path\'			=> FORUM_ROOT.\'extensions/pun_tags\',
\'url\'			=> $GLOBALS[\'base_url\'].\'/extensions/pun_tags\',
\'dependencies\'	=> array (
)
);
$ext_info = $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];

if (file_exists($ext_info[\'path\'].\'/lang/\'.$forum_user[\'language\'].\'/\'.$ext_info[\'id\'].\'.php\'))
				require $ext_info[\'path\'].\'/lang/\'.$forum_user[\'language\'].\'/\'.$ext_info[\'id\'].\'.php\';
			else
				require $ext_info[\'path\'].\'/lang/English/\'.$ext_info[\'id\'].\'.php\';
			require $ext_info[\'path\'].\'/pun_tags_url.php\';

			if ((FORUM_PAGE_SECTION == \'management\') && ($forum_user[\'g_id\'] == FORUM_ADMIN))
				$forum_page[\'admin_submenu\'][\'pun_tags_management\'] = \'<li class="\'.((FORUM_PAGE == \'admin-management-manage_tags\') ? \'active\' : \'normal\').((empty($forum_page[\'admin_menu\'])) ? \' first-item\' : \'\').\'"><a href="\'.forum_link($pun_tags_url[\'Section pun_tags\']).\'">\'.$lang_pun_tags[\'Section tags\'].\'</a></li>\';

array_pop($GLOBALS[\'ext_info_stack\']);
$ext_info = empty($GLOBALS[\'ext_info_stack\']) ? array() : $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];
',
    3 => '$GLOBALS[\'ext_info_stack\'][] = array(
\'id\'				=> \'fancy_stop_spam\',
\'path\'			=> FORUM_ROOT.\'extensions/fancy_stop_spam\',
\'url\'			=> $GLOBALS[\'base_url\'].\'/extensions/fancy_stop_spam\',
\'dependencies\'	=> array (
)
);
$ext_info = $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];

if ($forum_user[\'is_admmod\'] && FORUM_PAGE_SECTION == \'fancy_stop_spam\') {
				$forum_page[\'admin_submenu\'][\'fancy_stop_spam_logs\'] = \'
					<li class="\'.((FORUM_PAGE == \'admin-fancy_stop_spam_logs\') ? \'active\' : \'normal\').
						((empty($forum_page[\'admin_submenu\'])) ? \' first-item\' : \'\').\'">
						<a href="\'.forum_link($forum_url[\'fancy_stop_spam_admin_logs\']).\'">\'.$lang_fancy_stop_spam["Admin submenu logs"].\'</a>
					</li>\';

				$forum_page[\'admin_submenu\'][\'fancy_stop_spam_new_users\'] = \'
					<li class="\'.((FORUM_PAGE == \'admin-fancy_stop_spam_new_users\') ? \'active\' : \'normal\').
						((empty($forum_page[\'admin_submenu\'])) ? \' first-item\' : \'\').\'">
						<a href="\'.forum_link($forum_url[\'fancy_stop_spam_admin_new_users\']).\'">\'.$lang_fancy_stop_spam["Admin submenu new users"].\'</a>
					</li>\';

				$forum_page[\'admin_submenu\'][\'fancy_stop_spam_suspicious_users\'] = \'
					<li class="\'.((FORUM_PAGE == \'admin-fancy_stop_spam_suspicious_users\') ? \'active\' : \'normal\').
						((empty($forum_page[\'admin_submenu\'])) ? \' first-item\' : \'\').\'">
						<a href="\'.forum_link($forum_url[\'fancy_stop_spam_admin_suspicious_users\']).\'">\'.$lang_fancy_stop_spam["Admin submenu suspicious users"].\'</a>
					</li>\';
			}

array_pop($GLOBALS[\'ext_info_stack\']);
$ext_info = empty($GLOBALS[\'ext_info_stack\']) ? array() : $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];
',
  ),
  'aop_new_section' => 
  array (
    0 => '$GLOBALS[\'ext_info_stack\'][] = array(
\'id\'				=> \'pun_attachment\',
\'path\'			=> FORUM_ROOT.\'extensions/pun_attachment\',
\'url\'			=> $GLOBALS[\'base_url\'].\'/extensions/pun_attachment\',
\'dependencies\'	=> array (
)
);
$ext_info = $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];

if ($section == \'pun_attach\')
				require $ext_info[\'path\'].\'/pun_attach.php\';
			else if ($section == \'pun_list_attach\')
				require $ext_info[\'path\'].\'/pun_list_attach.php\';

array_pop($GLOBALS[\'ext_info_stack\']);
$ext_info = empty($GLOBALS[\'ext_info_stack\']) ? array() : $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];
',
    1 => '$GLOBALS[\'ext_info_stack\'][] = array(
\'id\'				=> \'pun_stop_bots\',
\'path\'			=> FORUM_ROOT.\'extensions/pun_stop_bots\',
\'url\'			=> $GLOBALS[\'base_url\'].\'/extensions/pun_stop_bots\',
\'dependencies\'	=> array (
)
);
$ext_info = $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];

if ($section == \'pun_stop_bots_questions\')
			{
				if (file_exists($ext_info[\'path\'].\'/lang/\'.$forum_user[\'language\'].\'/\'.$ext_info[\'id\'].\'.php\'))
					include $ext_info[\'path\'].\'/lang/\'.$forum_user[\'language\'].\'/\'.$ext_info[\'id\'].\'.php\';
				else
					include $ext_info[\'path\'].\'/lang/English/\'.$ext_info[\'id\'].\'.php\';
				include $ext_info[\'path\'].\'/url/Default.php\';

				$forum_page = array();
				$forum_page[\'errors\'] = array();

				if (isset($_POST[\'add_question\']) && !empty($pun_stop_bots_questions))
				{
					$question = forum_trim($_POST[\'question\']);
					$answers = pun_stop_bots_prepare_answers(strtolower(forum_trim($_POST[\'answers\'])));

					if ($question == \'\' || $answers == \'\')
						$forum_page[\'errors\'][] = $lang_pun_stop_bots[\'Management err empty fields\'];

					if (empty($forum_page[\'errors\']))
					{
						$stop_bots_error = pun_stop_bots_add_question($question, $answers);
						if ($stop_bots_error !== TRUE)
							$forum_page[\'errors\'][] = $stop_bots_error;
						else
						{
							pun_stop_bots_generate_cache();
							redirect(forum_link($forum_url[\'pun_stop_bots_section\']), $lang_pun_stop_bots[\'Management question add\'].\' \'.$lang_admin_common[\'Redirect\']);
						}
					}
				}
				else if (isset($_POST[\'update\']) && !empty($pun_stop_bots_questions))
				{
					$question_id = intval(key($_POST[\'update\']));
					if ($question_id < 1)
						message($lang_common[\'Bad request\']);

					$question = forum_trim($_POST[\'question\'][$question_id]);
					$answers = pun_stop_bots_prepare_answers(strtolower(forum_trim($_POST[\'answers\'][$question_id])));

					if ($question == \'\' || $answers == \'\')
						$forum_page[\'errors\'][] = $lang_pun_stop_bots[\'Management err empty fields\'];

					if (empty($forum_page[\'errors\']))
					{
						$stop_bots_error = pun_stop_bots_update_question($question_id, $question, $answers);
						if ($stop_bots_error !== TRUE)
							$forum_page[\'errors\'][] = $stop_bots_error;
						else
						{
							pun_stop_bots_generate_cache();
							redirect(forum_link($forum_url[\'pun_stop_bots_section\']), $lang_pun_stop_bots[\'Management question add\'].\' \'.$lang_admin_common[\'Redirect\']);
						}
					}
				}
				else if (isset($_POST[\'remove\']) && !empty($pun_stop_bots_questions))
				{
					$question_id = intval(key($_POST[\'remove\']));
					if ($question_id < 1)
						message($lang_common[\'Bad request\']);

					$stop_bots_error = pun_stop_bots_delete_question($question_id);
					if ($stop_bots_error !== TRUE)
						$forum_page[\'errors\'][] = $stop_bots_error;
					else
					{
						pun_stop_bots_generate_cache();
						redirect(forum_link($forum_url[\'pun_stop_bots_section\']), $lang_pun_stop_bots[\'Management question remove\'].\' \'.$lang_admin_common[\'Redirect\']);
					}
				}

				$forum_page[\'crumbs\'] = array(
					array($forum_config[\'o_board_title\'], forum_link($forum_url[\'index\'])),
					array($lang_admin_common[\'Forum administration\'], forum_link($forum_url[\'admin_index\'])),
					array($lang_admin_common[\'Settings\'], forum_link($forum_url[\'admin_settings_setup\'])),
					array($lang_pun_stop_bots[\'Management tab\'], forum_link($forum_url[\'pun_stop_bots_section\']))
				);
				$forum_page[\'form_action\'] = forum_link($forum_url[\'pun_stop_bots_section\']);
				$forum_page[\'csrf_token\'] = generate_form_token($forum_page[\'form_action\']);
				$forum_page[\'group_count\'] = $forum_page[\'item_count\'] = $forum_page[\'fld_count\'] = 0;

				define(\'FORUM_PAGE_SECTION\', \'settings\');
				define(\'FORUM_PAGE\', \'admin-pun_stop_bots_questions\');
				require FORUM_ROOT.\'header.php\';

				// START SUBST - <!-- forum_main -->
				ob_start();

				include $ext_info[\'path\'].\'/views/management.php\';

				$tpl_temp = forum_trim(ob_get_contents());
				$tpl_main = str_replace(\'<!-- forum_main -->\', $tpl_temp, $tpl_main);
				ob_end_clean();
				// END SUBST - <!-- forum_main -->

				require FORUM_ROOT.\'footer.php\';
			}

array_pop($GLOBALS[\'ext_info_stack\']);
$ext_info = empty($GLOBALS[\'ext_info_stack\']) ? array() : $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];
',
  ),
  'aop_start' => 
  array (
    0 => '$GLOBALS[\'ext_info_stack\'][] = array(
\'id\'				=> \'pun_attachment\',
\'path\'			=> FORUM_ROOT.\'extensions/pun_attachment\',
\'url\'			=> $GLOBALS[\'base_url\'].\'/extensions/pun_attachment\',
\'dependencies\'	=> array (
)
);
$ext_info = $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];

require $ext_info[\'path\'].\'/include/attach_func.php\';
			if (file_exists($ext_info[\'path\'].\'/lang/\'.$forum_user[\'language\'].\'/\'.$ext_info[\'id\'].\'.php\'))
				require $ext_info[\'path\'].\'/lang/\'.$forum_user[\'language\'].\'/\'.$ext_info[\'id\'].\'.php\';
			else
				require $ext_info[\'path\'].\'/lang/English/\'.$ext_info[\'id\'].\'.php\';
			require $ext_info[\'path\'].\'/url.php\';

			$section = isset($_GET[\'section\']) ? $_GET[\'section\'] : null;

			if (isset($_POST[\'apply\']) && ($section == \'list_attach\') && isset($_POST[\'form_sent\']))
				unset($_POST[\'form_sent\']);

array_pop($GLOBALS[\'ext_info_stack\']);
$ext_info = empty($GLOBALS[\'ext_info_stack\']) ? array() : $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];
',
    1 => '$GLOBALS[\'ext_info_stack\'][] = array(
\'id\'				=> \'pun_stop_bots\',
\'path\'			=> FORUM_ROOT.\'extensions/pun_stop_bots\',
\'url\'			=> $GLOBALS[\'base_url\'].\'/extensions/pun_stop_bots\',
\'dependencies\'	=> array (
)
);
$ext_info = $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];

include $ext_info[\'path\'].\'/functions.php\';
			if (file_exists(FORUM_CACHE_DIR.\'cache_pun_stop_bots.php\'))
				include FORUM_CACHE_DIR.\'cache_pun_stop_bots.php\';
			if (!defined(\'PUN_STOP_BOTS_CACHE_LOADED\') || $pun_stop_bots_questions[\'cached\'] < (time() - 43200))
			{
				pun_stop_bots_generate_cache();
				require FORUM_CACHE_DIR.\'cache_pun_stop_bots.php\';
			}

array_pop($GLOBALS[\'ext_info_stack\']);
$ext_info = empty($GLOBALS[\'ext_info_stack\']) ? array() : $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];
',
  ),
  'ed_pre_main_fieldset_end' => 
  array (
    0 => '$GLOBALS[\'ext_info_stack\'][] = array(
\'id\'				=> \'pun_attachment\',
\'path\'			=> FORUM_ROOT.\'extensions/pun_attachment\',
\'url\'			=> $GLOBALS[\'base_url\'].\'/extensions/pun_attachment\',
\'dependencies\'	=> array (
)
);
$ext_info = $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];

if (!$forum_config[\'attach_disable_attach\'])
				show_attachments(isset($uploaded_list) ? $uploaded_list : array(), $cur_post);

array_pop($GLOBALS[\'ext_info_stack\']);
$ext_info = empty($GLOBALS[\'ext_info_stack\']) ? array() : $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];
',
  ),
  'ed_pre_redirect' => 
  array (
    0 => '$GLOBALS[\'ext_info_stack\'][] = array(
\'id\'				=> \'pun_attachment\',
\'path\'			=> FORUM_ROOT.\'extensions/pun_attachment\',
\'url\'			=> $GLOBALS[\'base_url\'].\'/extensions/pun_attachment\',
\'dependencies\'	=> array (
)
);
$ext_info = $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];

if (!$forum_config[\'attach_disable_attach\'] && isset($_POST[\'submit_button\']))
			{
				$attach_query = array(
					\'UPDATE\'	=>	\'attach_files\',
					\'SET\'		=>	\'owner_id = \'.$forum_user[\'id\'].\', topic_id = \'.$cur_post[\'tid\'].\', post_id = \'.$id.\', secure_str = NULL\',
					\'WHERE\'		=>	\'secure_str = \\\'\'.$forum_db->escape($attach_secure_str).\'\\\'\'
				);
				$forum_db->query_build($attach_query) or error(__FILE__, __LINE__);
			}

array_pop($GLOBALS[\'ext_info_stack\']);
$ext_info = empty($GLOBALS[\'ext_info_stack\']) ? array() : $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];
',
    1 => '$GLOBALS[\'ext_info_stack\'][] = array(
\'id\'				=> \'pun_forum_news\',
\'path\'			=> FORUM_ROOT.\'extensions/pun_forum_news\',
\'url\'			=> $GLOBALS[\'base_url\'].\'/extensions/pun_forum_news\',
\'dependencies\'	=> array (
)
);
$ext_info = $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];

if ($forum_user[\'group_id\'] == FORUM_ADMIN || $forum_user[\'g_add_forum_news\'])
			{
				if ($cur_post[\'forum_news\'])
				{
					if ($pun_forum_news)
					{
						$pun_forum_news_query = array(
							\'UPDATE\'	=>	\'pun_forum_news\',
							\'SET\'		=>	\'message=\\\'\'.$forum_db->escape($message).\'\\\', hide_smilies=\\\'\'.$hide_smilies.\'\\\'\',
							\'WHERE\'		=>	\'post_id = \'.$id
						);
					}
					else
					{
						$pun_forum_news_query = array(
							\'DELETE\'	=>	\'pun_forum_news\',
							\'WHERE\'		=>	\'post_id = \'.$id
						);
					}
					$forum_db->query_build($pun_forum_news_query) or error(__FILE__, __LINE__);
				}
				else
				{
					if ($pun_forum_news)
					{
						$pun_forum_news_query = array(
							\'INSERT\'	=>	\'post_id, poster, poster_id, message, hide_smilies, posted, forum_id\',
							\'INTO\'		=>	\'pun_forum_news\',
							\'VALUES\'	=>	$id.\', \\\'\'.$forum_db->escape($cur_post[\'poster\']).\'\\\', \'.$cur_post[\'poster_id\'].\', \\\'\'.$forum_db->escape($message).\'\\\', \'.$hide_smilies.\', \'.$cur_post[\'posted\'].\', \'.$cur_post[\'fid\']
						);
						$forum_db->query_build($pun_forum_news_query) or error(__FILE__, __LINE__);
					}
				}
			}

array_pop($GLOBALS[\'ext_info_stack\']);
$ext_info = empty($GLOBALS[\'ext_info_stack\']) ? array() : $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];
',
    2 => '$GLOBALS[\'ext_info_stack\'][] = array(
\'id\'				=> \'fancy_alerts\',
\'path\'			=> FORUM_ROOT.\'extensions/fancy_alerts\',
\'url\'			=> $GLOBALS[\'base_url\'].\'/extensions/fancy_alerts\',
\'dependencies\'	=> array (
)
);
$ext_info = $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];

$fancy_alerts = new Fancy_alerts;
				$fancy_alerts->update_quote_alerts($cur_post[\'tid\'], $id, $message);

array_pop($GLOBALS[\'ext_info_stack\']);
$ext_info = empty($GLOBALS[\'ext_info_stack\']) ? array() : $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];
',
    3 => '$GLOBALS[\'ext_info_stack\'][] = array(
\'id\'				=> \'last_topic_title_on_forum_index\',
\'path\'			=> FORUM_ROOT.\'extensions/last_topic_title_on_forum_index\',
\'url\'			=> $GLOBALS[\'base_url\'].\'/extensions/last_topic_title_on_forum_index\',
\'dependencies\'	=> array (
)
);
$ext_info = $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];

if ($can_edit_subject) {
				sync_forum(intval($cur_post[\'fid\'], 10));
			}

array_pop($GLOBALS[\'ext_info_stack\']);
$ext_info = empty($GLOBALS[\'ext_info_stack\']) ? array() : $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];
',
  ),
  'ed_pre_header_load' => 
  array (
    0 => '$GLOBALS[\'ext_info_stack\'][] = array(
\'id\'				=> \'pun_attachment\',
\'path\'			=> FORUM_ROOT.\'extensions/pun_attachment\',
\'url\'			=> $GLOBALS[\'base_url\'].\'/extensions/pun_attachment\',
\'dependencies\'	=> array (
)
);
$ext_info = $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];

if (!$forum_config[\'attach_disable_attach\'])
				$forum_page[\'form_attributes\'][\'enctype\'] = \'enctype="multipart/form-data"\';

array_pop($GLOBALS[\'ext_info_stack\']);
$ext_info = empty($GLOBALS[\'ext_info_stack\']) ? array() : $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];
',
  ),
  'ed_end_validation' => 
  array (
    0 => '$GLOBALS[\'ext_info_stack\'][] = array(
\'id\'				=> \'pun_attachment\',
\'path\'			=> FORUM_ROOT.\'extensions/pun_attachment\',
\'url\'			=> $GLOBALS[\'base_url\'].\'/extensions/pun_attachment\',
\'dependencies\'	=> array (
)
);
$ext_info = $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];

if (!$forum_config[\'attach_disable_attach\'])
			{
				foreach (array_keys($_POST) as $key)
				{
					if (preg_match(\'~delete_(\\d+)~\', $key, $matches))
					{
						$attach_delete_id = $matches[1];
						break;
					}
				}
				if (isset($attach_delete_id))
				{
					foreach ($uploaded_list as $attach_index => $attach)
						if ($attach[\'id\'] == $attach_delete_id)
						{
							$delete_attach = $attach;
							$attach_delete_index = $attach_index;
							break;
						}
					if (isset($delete_attach) && ($forum_user[\'g_id\'] == FORUM_ADMIN || $cur_post[\'g_pun_attachment_allow_delete\'] || ($cur_post[\'g_pun_attachment_allow_delete_own\'] && $forum_user[\'id\'] == $delete_attach[\'owner_id\'])))
					{
						$attach_query = array(
							\'DELETE\'	=>	\'attach_files\',
							\'WHERE\'		=>	\'id = \'.$delete_attach[\'id\']
						);
						$forum_db->query_build($attach_query) or error(__FILE__, __LINE__);
						unset($uploaded_list[$attach_delete_index]);
						if ($forum_config[\'attach_create_orphans\'] == \'0\')
							unlink($forum_config[\'attach_basefolder\'].$delete_attach[\'file_path\']);
					}
					else
						$errors[] = $lang_attach[\'Del perm error\'];
					$_POST[\'preview\'] = 1;
				}
				else if (isset($_POST[\'add_file\']))
				{
					attach_create_attachment($attach_secure_str, $cur_post);
					$_POST[\'preview\'] = 1;
				}
			}

array_pop($GLOBALS[\'ext_info_stack\']);
$ext_info = empty($GLOBALS[\'ext_info_stack\']) ? array() : $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];
',
    1 => '$GLOBALS[\'ext_info_stack\'][] = array(
\'id\'				=> \'pun_forum_news\',
\'path\'			=> FORUM_ROOT.\'extensions/pun_forum_news\',
\'url\'			=> $GLOBALS[\'base_url\'].\'/extensions/pun_forum_news\',
\'dependencies\'	=> array (
)
);
$ext_info = $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];

if ($forum_user[\'group_id\'] == FORUM_ADMIN || $forum_user[\'g_add_forum_news\'])
				$pun_forum_news = isset($_POST[\'pun_forum_news\']) ? 1 : 0;

array_pop($GLOBALS[\'ext_info_stack\']);
$ext_info = empty($GLOBALS[\'ext_info_stack\']) ? array() : $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];
',
    2 => '$GLOBALS[\'ext_info_stack\'][] = array(
\'id\'				=> \'fancy_stop_spam\',
\'path\'			=> FORUM_ROOT.\'extensions/fancy_stop_spam\',
\'url\'			=> $GLOBALS[\'base_url\'].\'/extensions/fancy_stop_spam\',
\'dependencies\'	=> array (
)
);
$ext_info = $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];

$fancy_stop_spam = Fancy_stop_spam::singleton();
			$check_max_links_result = $fancy_stop_spam->max_links_check($message);

			if ($check_max_links_result !== TRUE) {
				$errors[] = $check_max_links_result;
			}

array_pop($GLOBALS[\'ext_info_stack\']);
$ext_info = empty($GLOBALS[\'ext_info_stack\']) ? array() : $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];
',
  ),
  'po_pre_header_load' => 
  array (
    0 => '$GLOBALS[\'ext_info_stack\'][] = array(
\'id\'				=> \'pun_attachment\',
\'path\'			=> FORUM_ROOT.\'extensions/pun_attachment\',
\'url\'			=> $GLOBALS[\'base_url\'].\'/extensions/pun_attachment\',
\'dependencies\'	=> array (
)
);
$ext_info = $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];

if (!$forum_config[\'attach_disable_attach\'])
				$forum_page[\'form_attributes\'][\'enctype\'] = \'enctype="multipart/form-data"\';

array_pop($GLOBALS[\'ext_info_stack\']);
$ext_info = empty($GLOBALS[\'ext_info_stack\']) ? array() : $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];
',
    1 => '$GLOBALS[\'ext_info_stack\'][] = array(
\'id\'				=> \'fancy_stop_spam\',
\'path\'			=> FORUM_ROOT.\'extensions/fancy_stop_spam\',
\'url\'			=> $GLOBALS[\'base_url\'].\'/extensions/fancy_stop_spam\',
\'dependencies\'	=> array (
)
);
$ext_info = $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];

if ($forum_config[\'o_fancy_stop_spam_post_form_honeypot\'] == \'1\') {
				$fancy_stop_spam_post_key_id = uniqid();
				$forum_page[\'hidden_fields\'][\'form_honey_key_id\'] = \'<input type="hidden" name="form_honey_key_id" value="\'.$fancy_stop_spam_post_key_id.\'" />\';
			}

array_pop($GLOBALS[\'ext_info_stack\']);
$ext_info = empty($GLOBALS[\'ext_info_stack\']) ? array() : $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];
',
  ),
  'po_pre_req_info_fieldset_end' => 
  array (
    0 => '$GLOBALS[\'ext_info_stack\'][] = array(
\'id\'				=> \'pun_attachment\',
\'path\'			=> FORUM_ROOT.\'extensions/pun_attachment\',
\'url\'			=> $GLOBALS[\'base_url\'].\'/extensions/pun_attachment\',
\'dependencies\'	=> array (
)
);
$ext_info = $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];

if (!$forum_config[\'attach_disable_attach\'])
				show_attachments(isset($uploaded_list) ? $uploaded_list : array(), $cur_posting);

array_pop($GLOBALS[\'ext_info_stack\']);
$ext_info = empty($GLOBALS[\'ext_info_stack\']) ? array() : $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];
',
  ),
  'vt_start' => 
  array (
    0 => '$GLOBALS[\'ext_info_stack\'][] = array(
\'id\'				=> \'pun_attachment\',
\'path\'			=> FORUM_ROOT.\'extensions/pun_attachment\',
\'url\'			=> $GLOBALS[\'base_url\'].\'/extensions/pun_attachment\',
\'dependencies\'	=> array (
)
);
$ext_info = $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];

if (!$forum_config[\'attach_disable_attach\'])
			{
				require $ext_info[\'path\'].\'/include/attach_func.php\';
				if (file_exists($ext_info[\'path\'].\'/lang/\'.$forum_user[\'language\'].\'/\'.$ext_info[\'id\'].\'.php\'))
					require $ext_info[\'path\'].\'/lang/\'.$forum_user[\'language\'].\'/\'.$ext_info[\'id\'].\'.php\';
				else
					require $ext_info[\'path\'].\'/lang/English/\'.$ext_info[\'id\'].\'.php\';
				require $ext_info[\'path\'].\'/url.php\';
			}

array_pop($GLOBALS[\'ext_info_stack\']);
$ext_info = empty($GLOBALS[\'ext_info_stack\']) ? array() : $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];
',
    1 => '$GLOBALS[\'ext_info_stack\'][] = array(
\'id\'				=> \'pun_colored_usergroups\',
\'path\'			=> FORUM_ROOT.\'extensions/pun_colored_usergroups\',
\'url\'			=> $GLOBALS[\'base_url\'].\'/extensions/pun_colored_usergroups\',
\'dependencies\'	=> array (
)
);
$ext_info = $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];

if (!file_exists(FORUM_CACHE_DIR.\'cache_pun_coloured_usergroups.php\'))
			{
				if (!defined(\'CACHE_PUN_COLOURED_USERGROUPS_LOADED\')) {
					require $ext_info[\'path\'].\'/main.php\';
				}
				cache_pun_coloured_usergroups();
			}

array_pop($GLOBALS[\'ext_info_stack\']);
$ext_info = empty($GLOBALS[\'ext_info_stack\']) ? array() : $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];
',
    2 => '$GLOBALS[\'ext_info_stack\'][] = array(
\'id\'				=> \'fancy_simtopics\',
\'path\'			=> FORUM_ROOT.\'extensions/fancy_simtopics\',
\'url\'			=> $GLOBALS[\'base_url\'].\'/extensions/fancy_simtopics\',
\'dependencies\'	=> array (
)
);
$ext_info = $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];

if (!isset($lang_fancy_simtopics)) {
				if (file_exists($ext_info[\'path\'].\'/lang/\'.$forum_user[\'language\'].\'/\'.$ext_info[\'id\'].\'.php\')) {
					require $ext_info[\'path\'].\'/lang/\'.$forum_user[\'language\'].\'/\'.$ext_info[\'id\'].\'.php\';
				} else {
					require $ext_info[\'path\'].\'/lang/English/\'.$ext_info[\'id\'].\'.php\';
				}

				$forum_loader->add_css(\'#fancy_simtopics_block { margin: 1em 0 1.5em; } #fancy_simtopics_block ul { list-style: none; } #fancy_simtopics_block h3 { font-size: 1.1em; }\', array(\'type\' => \'inline\'));
			}

array_pop($GLOBALS[\'ext_info_stack\']);
$ext_info = empty($GLOBALS[\'ext_info_stack\']) ? array() : $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];
',
  ),
  'vt_qr_get_topic_info' => 
  array (
    0 => '$GLOBALS[\'ext_info_stack\'][] = array(
\'id\'				=> \'pun_attachment\',
\'path\'			=> FORUM_ROOT.\'extensions/pun_attachment\',
\'url\'			=> $GLOBALS[\'base_url\'].\'/extensions/pun_attachment\',
\'dependencies\'	=> array (
)
);
$ext_info = $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];

if (!$forum_config[\'attach_disable_attach\'])
			{
				$query[\'SELECT\'] .= \', g_pun_attachment_allow_download\';
				$query[\'JOINS\'][] = array(\'LEFT JOIN\' => \'groups AS g\', \'ON\' => \'g.g_id = \'.$forum_user[\'g_id\']);
			}

array_pop($GLOBALS[\'ext_info_stack\']);
$ext_info = empty($GLOBALS[\'ext_info_stack\']) ? array() : $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];
',
    1 => '$GLOBALS[\'ext_info_stack\'][] = array(
\'id\'				=> \'fancy_alerts\',
\'path\'			=> FORUM_ROOT.\'extensions/fancy_alerts\',
\'url\'			=> $GLOBALS[\'base_url\'].\'/extensions/fancy_alerts\',
\'dependencies\'	=> array (
)
);
$ext_info = $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];

if (!$forum_user[\'is_guest\']) {
					// GET OWNER
					$query[\'SELECT\'] .= \', coalesce(p.poster_id, 1) AS topic_owner\';
					$query[\'JOINS\'][] = array(
						\'LEFT JOIN\'	=> \'posts AS p\',
						\'ON\'		=> \'(t.first_post_id=p.id)\'
					);

					// GET ALERTS STATUS
					$query[\'SELECT\'] .= \', fat.user_id AS is_fancy_alerts_topic\';
					$query[\'JOINS\'][] = array(
						\'LEFT JOIN\'	=> \'fancy_alerts_topics AS fat\',
						\'ON\'		=> \'(t.id=fat.topic_id AND fat.user_id=\'.$forum_user[\'id\'].\')\'
					);
				}

array_pop($GLOBALS[\'ext_info_stack\']);
$ext_info = empty($GLOBALS[\'ext_info_stack\']) ? array() : $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];
',
    2 => '$GLOBALS[\'ext_info_stack\'][] = array(
\'id\'				=> \'fancy_simtopics\',
\'path\'			=> FORUM_ROOT.\'extensions/fancy_simtopics\',
\'url\'			=> $GLOBALS[\'base_url\'].\'/extensions/fancy_simtopics\',
\'dependencies\'	=> array (
)
);
$ext_info = $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];

$query[\'SELECT\'] .= \', f.fancy_simtopics_show\';

array_pop($GLOBALS[\'ext_info_stack\']);
$ext_info = empty($GLOBALS[\'ext_info_stack\']) ? array() : $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];
',
  ),
  'vt_main_output_start' => 
  array (
    0 => '$GLOBALS[\'ext_info_stack\'][] = array(
\'id\'				=> \'pun_attachment\',
\'path\'			=> FORUM_ROOT.\'extensions/pun_attachment\',
\'url\'			=> $GLOBALS[\'base_url\'].\'/extensions/pun_attachment\',
\'dependencies\'	=> array (
)
);
$ext_info = $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];

if (!$forum_config[\'attach_disable_attach\'])
			{
				$attach_query = array(
					\'SELECT\'	=>	\'id, post_id, filename, file_ext, file_mime_type, size, download_counter, uploaded_at, file_path\',
					\'FROM\'		=>	\'attach_files\',
					\'WHERE\'		=>	\'topic_id = \'.$id,
					\'ORDER BY\'	=>	\'filename\'
				);
				$attach_result = $forum_db->query_build($attach_query) or error(__FILE__, __LINE__);
				$attach_list = array();
				while ($cur_attach = $forum_db->fetch_assoc($attach_result))
				{
					if (!isset($attach_list[$cur_attach[\'post_id\']]))
						$attach_list[$cur_attach[\'post_id\']] = array();
					$attach_list[$cur_attach[\'post_id\']][] = $cur_attach;
				}
			}

array_pop($GLOBALS[\'ext_info_stack\']);
$ext_info = empty($GLOBALS[\'ext_info_stack\']) ? array() : $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];
',
  ),
  'vt_row_pre_display' => 
  array (
    0 => '$GLOBALS[\'ext_info_stack\'][] = array(
\'id\'				=> \'pun_attachment\',
\'path\'			=> FORUM_ROOT.\'extensions/pun_attachment\',
\'url\'			=> $GLOBALS[\'base_url\'].\'/extensions/pun_attachment\',
\'dependencies\'	=> array (
)
);
$ext_info = $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];

if (!$forum_config[\'attach_disable_attach\'] && isset($attach_list[$cur_post[\'id\']]))
			{
				if (isset($forum_page[\'message\'][\'signature\']))
					$forum_page[\'message\'][\'signature\'] = show_attachments_post($attach_list[$cur_post[\'id\']], $cur_post[\'id\'], $cur_topic).$forum_page[\'message\'][\'signature\'];
				else
					$forum_page[\'message\'][\'attachments\'] = show_attachments_post($attach_list[$cur_post[\'id\']], $cur_post[\'id\'], $cur_topic);
			}

array_pop($GLOBALS[\'ext_info_stack\']);
$ext_info = empty($GLOBALS[\'ext_info_stack\']) ? array() : $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];
',
    1 => '$GLOBALS[\'ext_info_stack\'][] = array(
\'id\'				=> \'fancy_addthis\',
\'path\'			=> FORUM_ROOT.\'extensions/fancy_addthis\',
\'url\'			=> $GLOBALS[\'base_url\'].\'/extensions/fancy_addthis\',
\'dependencies\'	=> array (
)
);
$ext_info = $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];

if ($cur_post[\'id\'] == $cur_topic[\'first_post_id\']) {
				if ($forum_config[\'o_fancy_addthis_button_gplus\'] == \'1\' ||
					$forum_config[\'o_fancy_addthis_button_twitter\'] == \'1\' ||
					$forum_config[\'o_fancy_addthis_button_facebook\'] == \'1\') {

					$forum_page[\'message\'][\'fancy_addthis_topic_block\'] = \'
						<div id="fancy_addthis_topic_toolbox">
							<table cellspacing="0" cellpadding="0" class="addthis_toolbox addthis_default_style" addthis:url="\'.forum_link($forum_url[\'topic\'], array($id, sef_friendly($cur_topic[\'subject\']))).\'" addthis:title="\'.forum_htmlencode($cur_topic[\'subject\']).\'">
							<tbody>
								<tr valign="bottom">\';

					if ($forum_config[\'o_fancy_addthis_button_facebook\'] == \'1\'):
						$forum_page[\'message\'][\'fancy_addthis_topic_block\'] .= \'<td><a class="addthis_button_facebook_like" fb:like:locale="en_US"></a></td>\';
					endif;

					if ($forum_config[\'o_fancy_addthis_button_twitter\'] == \'1\'):
						$forum_page[\'message\'][\'fancy_addthis_topic_block\'] .= \'<td><a class="addthis_button_tweet" tw:count="none"></a></td>\';
					endif;

					if ($forum_config[\'o_fancy_addthis_button_gplus\'] == \'1\'):
						$forum_page[\'message\'][\'fancy_addthis_topic_block\'] .= \'<td><a class="addthis_button_google_plusone" g:plusone:count="false" g:plusone:size="medium"></a></td>\';
					endif;

					$forum_page[\'message\'][\'fancy_addthis_topic_block\'] .= \'
								</tr>
							</tbody>
							</table>
						</div>\';
				}
			}

array_pop($GLOBALS[\'ext_info_stack\']);
$ext_info = empty($GLOBALS[\'ext_info_stack\']) ? array() : $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];
',
  ),
  'ed_start' => 
  array (
    0 => '$GLOBALS[\'ext_info_stack\'][] = array(
\'id\'				=> \'pun_attachment\',
\'path\'			=> FORUM_ROOT.\'extensions/pun_attachment\',
\'url\'			=> $GLOBALS[\'base_url\'].\'/extensions/pun_attachment\',
\'dependencies\'	=> array (
)
);
$ext_info = $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];

if (!$forum_config[\'attach_disable_attach\'])
			{
				require $ext_info[\'path\'].\'/include/attach_func.php\';
				if (file_exists($ext_info[\'path\'].\'/lang/\'.$forum_user[\'language\'].\'/\'.$ext_info[\'id\'].\'.php\'))
					require $ext_info[\'path\'].\'/lang/\'.$forum_user[\'language\'].\'/\'.$ext_info[\'id\'].\'.php\';
				else
					require $ext_info[\'path\'].\'/lang/English/\'.$ext_info[\'id\'].\'.php\';
				require $ext_info[\'path\'].\'/url.php\';
			}

array_pop($GLOBALS[\'ext_info_stack\']);
$ext_info = empty($GLOBALS[\'ext_info_stack\']) ? array() : $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];
',
  ),
  'ed_qr_get_post_info' => 
  array (
    0 => '$GLOBALS[\'ext_info_stack\'][] = array(
\'id\'				=> \'pun_attachment\',
\'path\'			=> FORUM_ROOT.\'extensions/pun_attachment\',
\'url\'			=> $GLOBALS[\'base_url\'].\'/extensions/pun_attachment\',
\'dependencies\'	=> array (
)
);
$ext_info = $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];

if (!$forum_config[\'attach_disable_attach\'])
			{
				$query[\'SELECT\'] .= \', g_pun_attachment_allow_upload, g_pun_attachment_upload_max_size, g_pun_attachment_files_per_post, g_pun_attachment_disallowed_extensions, g_pun_attachment_allow_delete_own, g_pun_attachment_allow_delete\';
				$query[\'JOINS\'][] = array(\'LEFT JOIN\' => \'groups AS g\', \'ON\' => \'g.g_id = \'.$forum_user[\'g_id\']);
			}

array_pop($GLOBALS[\'ext_info_stack\']);
$ext_info = empty($GLOBALS[\'ext_info_stack\']) ? array() : $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];
',
    1 => '$GLOBALS[\'ext_info_stack\'][] = array(
\'id\'				=> \'pun_forum_news\',
\'path\'			=> FORUM_ROOT.\'extensions/pun_forum_news\',
\'url\'			=> $GLOBALS[\'base_url\'].\'/extensions/pun_forum_news\',
\'dependencies\'	=> array (
)
);
$ext_info = $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];

if ($forum_user[\'group_id\'] == FORUM_ADMIN || $forum_user[\'g_add_forum_news\'])
				$query[\'SELECT\'] .= \', p.forum_news\';

array_pop($GLOBALS[\'ext_info_stack\']);
$ext_info = empty($GLOBALS[\'ext_info_stack\']) ? array() : $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];
',
  ),
  'ed_post_selected' => 
  array (
    0 => '$GLOBALS[\'ext_info_stack\'][] = array(
\'id\'				=> \'pun_attachment\',
\'path\'			=> FORUM_ROOT.\'extensions/pun_attachment\',
\'url\'			=> $GLOBALS[\'base_url\'].\'/extensions/pun_attachment\',
\'dependencies\'	=> array (
)
);
$ext_info = $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];

if (!$forum_config[\'attach_disable_attach\'])
			{
				$attach_secure_str = $forum_user[\'id\'].\'t\'.$cur_post[\'tid\'];

				$attach_query = array(
					\'SELECT\'	=>	\'id, owner_id, post_id, topic_id, filename, file_ext, file_mime_type, file_path, size, download_counter, uploaded_at, secure_str\',
					\'FROM\'		=>	\'attach_files\',
					\'WHERE\'		=>	\'post_id = \'.$id.\' OR secure_str = \\\'\'.$attach_secure_str.\'\\\'\',
					\'ORDER BY\'	=>	\'filename\'
				);

				$attach_result = $forum_db->query_build($attach_query) or error(__FILE__, __LINE__);

				$uploaded_list = array();
				while ($cur_attach = $forum_db->fetch_assoc($attach_result))
					$uploaded_list[] = $cur_attach;
			}

array_pop($GLOBALS[\'ext_info_stack\']);
$ext_info = empty($GLOBALS[\'ext_info_stack\']) ? array() : $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];
',
  ),
  'agr_add_end_qr_add_group' => 
  array (
    0 => '$GLOBALS[\'ext_info_stack\'][] = array(
\'id\'				=> \'pun_attachment\',
\'path\'			=> FORUM_ROOT.\'extensions/pun_attachment\',
\'url\'			=> $GLOBALS[\'base_url\'].\'/extensions/pun_attachment\',
\'dependencies\'	=> array (
)
);
$ext_info = $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];

$query[\'INSERT\'] .= \', g_pun_attachment_allow_download, g_pun_attachment_allow_upload, g_pun_attachment_allow_delete, g_pun_attachment_allow_delete_own, g_pun_attachment_upload_max_size, g_pun_attachment_files_per_post, g_pun_attachment_disallowed_extensions\';
			$query[\'VALUES\'] .= \', \'.implode(\',\', array($allow_down, $allow_upl, $allow_del, $allow_del_own, $size, $per_post, \'\\\'\'.$forum_db->escape($file_ext).\'\\\'\'));

array_pop($GLOBALS[\'ext_info_stack\']);
$ext_info = empty($GLOBALS[\'ext_info_stack\']) ? array() : $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];
',
    1 => '$GLOBALS[\'ext_info_stack\'][] = array(
\'id\'				=> \'pun_colored_usergroups\',
\'path\'			=> FORUM_ROOT.\'extensions/pun_colored_usergroups\',
\'url\'			=> $GLOBALS[\'base_url\'].\'/extensions/pun_colored_usergroups\',
\'dependencies\'	=> array (
)
);
$ext_info = $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];

if (!empty($link_color))
			{
				$query[\'INSERT\'] .= \', link_color\';
				$query[\'VALUES\'] .= \',\\\'\'.$forum_db->escape($link_color).\'\\\'\';
			}

			if (!empty($hover_color))
			{
				$query[\'INSERT\'] .= \', hover_color\';
				$query[\'VALUES\'] .= \',\\\'\'.$forum_db->escape($hover_color).\'\\\'\';
			}

array_pop($GLOBALS[\'ext_info_stack\']);
$ext_info = empty($GLOBALS[\'ext_info_stack\']) ? array() : $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];
',
    2 => '$GLOBALS[\'ext_info_stack\'][] = array(
\'id\'				=> \'pun_forum_news\',
\'path\'			=> FORUM_ROOT.\'extensions/pun_forum_news\',
\'url\'			=> $GLOBALS[\'base_url\'].\'/extensions/pun_forum_news\',
\'dependencies\'	=> array (
)
);
$ext_info = $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];

$query[\'INSERT\'] .= \', g_add_forum_news\';
			$query[\'VALUES\'] .= \', \'.$pun_forum_news_add_news;

array_pop($GLOBALS[\'ext_info_stack\']);
$ext_info = empty($GLOBALS[\'ext_info_stack\']) ? array() : $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];
',
  ),
  'agr_edit_end_qr_update_group' => 
  array (
    0 => '$GLOBALS[\'ext_info_stack\'][] = array(
\'id\'				=> \'pun_attachment\',
\'path\'			=> FORUM_ROOT.\'extensions/pun_attachment\',
\'url\'			=> $GLOBALS[\'base_url\'].\'/extensions/pun_attachment\',
\'dependencies\'	=> array (
)
);
$ext_info = $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];

if (isset($allow_down))
				$query[\'SET\'] .= \', g_pun_attachment_allow_download = \'.$allow_down.\', g_pun_attachment_allow_upload = \'.$allow_upl.\', g_pun_attachment_allow_delete = \'.$allow_del.\', g_pun_attachment_allow_delete_own = \'.$allow_del_own.\', g_pun_attachment_upload_max_size = \'.$size.\', g_pun_attachment_files_per_post = \'.$per_post.\', g_pun_attachment_disallowed_extensions = \\\'\'.$forum_db->escape($file_ext).\'\\\'\';

array_pop($GLOBALS[\'ext_info_stack\']);
$ext_info = empty($GLOBALS[\'ext_info_stack\']) ? array() : $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];
',
    1 => '$GLOBALS[\'ext_info_stack\'][] = array(
\'id\'				=> \'pun_colored_usergroups\',
\'path\'			=> FORUM_ROOT.\'extensions/pun_colored_usergroups\',
\'url\'			=> $GLOBALS[\'base_url\'].\'/extensions/pun_colored_usergroups\',
\'dependencies\'	=> array (
)
);
$ext_info = $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];

if (!empty($link_color))
				$query[\'SET\'] .= \', link_color = \\\'\'.$forum_db->escape($link_color).\'\\\'\';
			else
				$query[\'SET\'] .= \', link_color = NULL\';
			if (!empty($hover_color))
				$query[\'SET\'] .= \', hover_color = \\\'\'.$forum_db->escape($hover_color).\'\\\'\';
			else
				$query[\'SET\'] .= \', hover_color = NULL\';

array_pop($GLOBALS[\'ext_info_stack\']);
$ext_info = empty($GLOBALS[\'ext_info_stack\']) ? array() : $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];
',
    2 => '$GLOBALS[\'ext_info_stack\'][] = array(
\'id\'				=> \'pun_forum_news\',
\'path\'			=> FORUM_ROOT.\'extensions/pun_forum_news\',
\'url\'			=> $GLOBALS[\'base_url\'].\'/extensions/pun_forum_news\',
\'dependencies\'	=> array (
)
);
$ext_info = $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];

$query[\'SET\'] .= \', g_add_forum_news = \'.$pun_forum_news_add_news;

array_pop($GLOBALS[\'ext_info_stack\']);
$ext_info = empty($GLOBALS[\'ext_info_stack\']) ? array() : $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];
',
    3 => '$GLOBALS[\'ext_info_stack\'][] = array(
\'id\'				=> \'pun_tags\',
\'path\'			=> FORUM_ROOT.\'extensions/pun_tags\',
\'url\'			=> $GLOBALS[\'base_url\'].\'/extensions/pun_tags\',
\'dependencies\'	=> array (
)
);
$ext_info = $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];

$pun_tags_allow = isset($_POST[\'pun_tags_allow\']) ? intval($_POST[\'pun_tags_allow\']) : \'0\';
			$query[\'SET\'] .= \', g_pun_tags_allow=\'.$pun_tags_allow;

array_pop($GLOBALS[\'ext_info_stack\']);
$ext_info = empty($GLOBALS[\'ext_info_stack\']) ? array() : $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];
',
  ),
  'hd_head' => 
  array (
    0 => '$GLOBALS[\'ext_info_stack\'][] = array(
\'id\'				=> \'pun_attachment\',
\'path\'			=> FORUM_ROOT.\'extensions/pun_attachment\',
\'url\'			=> $GLOBALS[\'base_url\'].\'/extensions/pun_attachment\',
\'dependencies\'	=> array (
)
);
$ext_info = $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];

if (!$forum_config[\'attach_disable_attach\'] && in_array(FORUM_PAGE, array(\'viewtopic\', \'postedit\', \'attachment-preview\')))
			{
				if ($forum_user[\'style\'] != \'Oxygen\' && is_dir($ext_info[\'path\'].\'/css/\'.$forum_user[\'style\']))
					$forum_loader->add_css($ext_info[\'url\'].\'/css/\'.$forum_user[\'style\'].\'/pun_attachment.min.css\', array(\'type\' => \'url\'));
				else
					$forum_loader->add_css($ext_info[\'url\'].\'/css/Oxygen/pun_attachment.min.css\', array(\'type\' => \'url\'));
			}

array_pop($GLOBALS[\'ext_info_stack\']);
$ext_info = empty($GLOBALS[\'ext_info_stack\']) ? array() : $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];
',
    1 => '$GLOBALS[\'ext_info_stack\'][] = array(
\'id\'				=> \'pun_bbcode\',
\'path\'			=> FORUM_ROOT.\'extensions/pun_bbcode\',
\'url\'			=> $GLOBALS[\'base_url\'].\'/extensions/pun_bbcode\',
\'dependencies\'	=> array (
)
);
$ext_info = $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];

if ($forum_user[\'pun_bbcode_enabled\'] && ((FORUM_PAGE == \'viewtopic\' && $forum_config[\'o_quickpost\']) || in_array(FORUM_PAGE, array(\'post\', \'postedit\', \'pun_pm-write\', \'pun_pm-inbox\', \'pun_pm-compose\'))))
			{
				if (!defined(\'FORUM_PARSER_LOADED\'))
					require FORUM_ROOT.\'include/parser.php\';

				// Load CSS
				if ($forum_user[\'style\'] != \'Oxygen\' && file_exists($ext_info[\'path\'].\'/css/\'.$forum_user[\'style\'].\'/pun_bbcode.min.css\'))
					$forum_loader->add_css($ext_info[\'url\'].\'/css/\'.$forum_user[\'style\'].\'/pun_bbcode.min.css\', array(\'type\' => \'url\', \'weight\' => \'90\', \'media\' => \'screen\'));
				else
					$forum_loader->add_css($ext_info[\'url\'].\'/css/Oxygen/pun_bbcode.min.css\', array(\'type\' => \'url\', \'weight\' => \'90\', \'media\' => \'screen\'));

				// CSS for disabled JS hide bar
				$forum_loader->add_css(\'#pun_bbcode_bar { display: none; }\', array(\'type\' => \'inline\', \'noscript\' => true));

				// Load JS
				$forum_loader->add_js(\'PUNBB.pun_bbcode=(function(){return{init:function(){return true;},insert_text:function(d,h){var g,f,e=(document.all)?document.all.req_message:((document.getElementById("afocus")!==null)?(document.getElementById("afocus").req_message):(document.getElementsByName("req_message")[0]));if(!e){return false;}if(document.selection&&document.selection.createRange){e.focus();g=document.selection.createRange();g.text=d+g.text+h;e.focus();}else{if(e.selectionStart||e.selectionStart===0){var c=e.selectionStart,b=e.selectionEnd,a=e.scrollTop;e.value=e.value.substring(0,c)+d+e.value.substring(c,b)+h+e.value.substring(b,e.value.length);if(d.charAt(d.length-2)==="="){e.selectionStart=(c+d.length-1);}else{if(c===b){e.selectionStart=b+d.length;}else{e.selectionStart=b+d.length+h.length;}}e.selectionEnd=e.selectionStart;e.scrollTop=a;e.focus();}else{e.value+=d+h;e.focus();}}}};}());PUNBB.common.addDOMReadyEvent(PUNBB.pun_bbcode.init);\', array(\'type\' => \'inline\'));

				($hook = get_hook(\'pun_bbcode_styles_loaded\')) ? eval($hook) : null;
			}

array_pop($GLOBALS[\'ext_info_stack\']);
$ext_info = empty($GLOBALS[\'ext_info_stack\']) ? array() : $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];
',
    2 => '$GLOBALS[\'ext_info_stack\'][] = array(
\'id\'				=> \'pun_colored_usergroups\',
\'path\'			=> FORUM_ROOT.\'extensions/pun_colored_usergroups\',
\'url\'			=> $GLOBALS[\'base_url\'].\'/extensions/pun_colored_usergroups\',
\'dependencies\'	=> array (
)
);
$ext_info = $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];

if (file_exists(FORUM_CACHE_DIR.\'cache_pun_coloured_usergroups.php\'))
			{
				require FORUM_CACHE_DIR.\'cache_pun_coloured_usergroups.php\';
				$forum_loader->add_css($pun_colored_usergroups_cache, array(\'type\' => \'inline\', \'media\' => \'screen\'));
			}

array_pop($GLOBALS[\'ext_info_stack\']);
$ext_info = empty($GLOBALS[\'ext_info_stack\']) ? array() : $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];
',
    3 => '$GLOBALS[\'ext_info_stack\'][] = array(
\'id\'				=> \'pun_pm\',
\'path\'			=> FORUM_ROOT.\'extensions/pun_pm\',
\'url\'			=> $GLOBALS[\'base_url\'].\'/extensions/pun_pm\',
\'dependencies\'	=> array (
)
);
$ext_info = $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];

// Incuding styles for pun_pm
			if (defined(\'FORUM_PAGE\') && \'pun_pm\' == substr(FORUM_PAGE, 0, 6))
			{
				if ($forum_user[\'style\'] != \'Oxygen\' && file_exists($ext_info[\'path\'].\'/css/\'.$forum_user[\'style\'].\'/pun_pm.min.css\'))
					$forum_loader->add_css($ext_info[\'url\'].\'/css/\'.$forum_user[\'style\'].\'/pun_pm.min.css\', array(\'type\' => \'url\', \'media\' => \'screen\'));
				else
					$forum_loader->add_css($ext_info[\'url\'].\'/css/Oxygen/pun_pm.min.css\', array(\'type\' => \'url\', \'media\' => \'screen\'));
			}

array_pop($GLOBALS[\'ext_info_stack\']);
$ext_info = empty($GLOBALS[\'ext_info_stack\']) ? array() : $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];
',
    4 => '$GLOBALS[\'ext_info_stack\'][] = array(
\'id\'				=> \'pun_tags\',
\'path\'			=> FORUM_ROOT.\'extensions/pun_tags\',
\'url\'			=> $GLOBALS[\'base_url\'].\'/extensions/pun_tags\',
\'dependencies\'	=> array (
)
);
$ext_info = $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];

if (in_array(FORUM_PAGE, array(\'index\', \'viewforum\', \'viewtopic\', \'searchtopics\', \'searchposts\', \'admin-management-manage_tags\')))
			{
				if ($forum_user[\'style\'] != \'Oxygen\' && file_exists($ext_info[\'path\'].\'/style/\'.$forum_user[\'style\'].\'/pun_tags.css\'))
					$forum_loader->add_css($ext_info[\'url\'].\'/style/\'.$forum_user[\'style\'].\'/pun_tags.css\', array(\'type\' => \'url\', \'media\' => \'screen\'));
				else
					$forum_loader->add_css($ext_info[\'url\'].\'/style/Oxygen/pun_tags.min.css\', array(\'type\' => \'url\', \'media\' => \'screen\'));
			}

array_pop($GLOBALS[\'ext_info_stack\']);
$ext_info = empty($GLOBALS[\'ext_info_stack\']) ? array() : $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];
',
    5 => '$GLOBALS[\'ext_info_stack\'][] = array(
\'id\'				=> \'fancy_alerts\',
\'path\'			=> FORUM_ROOT.\'extensions/fancy_alerts\',
\'url\'			=> $GLOBALS[\'base_url\'].\'/extensions/fancy_alerts\',
\'dependencies\'	=> array (
)
);
$ext_info = $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];

if ($forum_user[\'style\'] != \'Oxygen\' && file_exists($ext_info[\'path\'].\'/css/\'.$forum_user[\'style\'].\'/fancy_alerts.min.css\')) {
					$forum_loader->add_css($ext_info[\'url\'].\'/css/\'.$forum_user[\'style\'].\'/fancy_alerts.min.css\', array(\'type\' => \'url\', \'media\' => \'screen\'));
				} else {
					$forum_loader->add_css($ext_info[\'url\'].\'/css/Oxygen/fancy_alerts.min.css\', array(\'type\' => \'url\', \'media\' => \'screen\'));
				}

				if (intval($forum_config[\'o_fancy_alerts_autoupdate_interval\'], 10) > 0) {
					$fancy_alerts_js_env = \'
						PUNBB.env.fancy_alerts = {
							autoupdate_url: "\'.forum_link($forum_url[\'fancy_alerts_autoupdate_status\']).\'",
							autoupdate_time: "\'.intval($forum_config[\'o_fancy_alerts_autoupdate_interval\'], 10).\'"
						};\';

					$forum_loader->add_js($fancy_alerts_js_env, array(\'type\' => \'inline\'));
					$forum_loader->add_js($ext_info[\'url\'].\'/js/fancy_alerts.min.js\', array(\'type\' => \'url\', \'async\' => true));
				}

array_pop($GLOBALS[\'ext_info_stack\']);
$ext_info = empty($GLOBALS[\'ext_info_stack\']) ? array() : $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];
',
    6 => '$GLOBALS[\'ext_info_stack\'][] = array(
\'id\'				=> \'fancy_jquery_addons\',
\'path\'			=> FORUM_ROOT.\'extensions/fancy_jquery_addons\',
\'url\'			=> $GLOBALS[\'base_url\'].\'/extensions/fancy_jquery_addons\',
\'dependencies\'	=> array (
\'pun_jquery\'	=> array(
\'id\'				=> \'pun_jquery\',
\'path\'			=> FORUM_ROOT.\'extensions/pun_jquery\',
\'url\'			=> $GLOBALS[\'base_url\'].\'/extensions/pun_jquery\'),
)
);
$ext_info = $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];

if ($forum_user[\'style\'] != \'Oxygen\' && file_exists($ext_info[\'path\'].\'/css/\'.$forum_user[\'style\'].\'/fancy_jquery_addons.min.css\')) {
				$forum_loader->add_css($ext_info[\'url\'].\'/css/\'.$forum_user[\'style\'].\'/fancy_jquery_addons.min.css\', array(\'type\' => \'url\', \'media\' => \'screen\'));
			} else {
				$forum_loader->add_css($ext_info[\'url\'].\'/css/Oxygen/fancy_jquery_addons.min.css\', array(\'type\' => \'url\', \'media\' => \'screen\'));
			}

array_pop($GLOBALS[\'ext_info_stack\']);
$ext_info = empty($GLOBALS[\'ext_info_stack\']) ? array() : $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];
',
    7 => '$GLOBALS[\'ext_info_stack\'][] = array(
\'id\'				=> \'fancy_image\',
\'path\'			=> FORUM_ROOT.\'extensions/fancy_image\',
\'url\'			=> $GLOBALS[\'base_url\'].\'/extensions/fancy_image\',
\'dependencies\'	=> array (
\'fancy_jquery_addons\'	=> array(
\'id\'				=> \'fancy_jquery_addons\',
\'path\'			=> FORUM_ROOT.\'extensions/fancy_jquery_addons\',
\'url\'			=> $GLOBALS[\'base_url\'].\'/extensions/fancy_jquery_addons\'),
)
);
$ext_info = $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];

if (defined(\'FORUM_PAGE\')) {
				if (in_array(FORUM_PAGE, array(\'news\', \'postdelete\', \'modtopic\', \'post\', \'viewtopic\', \'searchposts\', \'pun_pm-inbox\', \'pun_pm-outbox\'))) {
					// LOAD LANG
					if (!isset($lang_fancy_image)) {
						if ($forum_user[\'language\'] != \'English\' && file_exists($ext_info[\'path\'].\'/lang/\'.$forum_user[\'language\'].\'/\'.$ext_info[\'id\'].\'.php\')) {
							require $ext_info[\'path\'].\'/lang/\'.$forum_user[\'language\'].\'/\'.$ext_info[\'id\'].\'.php\';
						} else {
							require $ext_info[\'path\'].\'/lang/English/\'.$ext_info[\'id\'].\'.php\';
						}
					}

					$forum_loader->add_css(\'a.fancy_zoom:hover { text-decoration: none !important; }\', array(\'type\' => \'inline\'));

					$fancy_image_js_env = \'
						PUNBB.env.fancy_image = {
							lang_title: "\'.forum_htmlencode($lang_fancy_image[\'Original\']).\'",
						};\';


					$forum_loader->add_js($fancy_image_js_env, array(\'type\' => \'inline\'));

					//$forum_loader->add_js($ext_info[\'url\'].\'/js/fancy_image.min.js\', array(\'type\' => \'url\', \'async\' => true));

					// For speed use inline JS
					$forum_loader->add_js(\'PUNBB.fancy_image=(function(){function c(){$(".fancyimagethumbs > img").each(function(){if($(this).data("fancy")===true){return;}$(this).data("fancy",true);var f=$(this),d=f.attr("rel"),e=f.parents("a").eq(0),g=f.parents(".post").find("h4").attr("id");if(!e){return;}if(d){e.attr("href",d);if(g){e.attr("rel",g);}e.addClass("fancy_zoom");f.removeAttr("rel");}e.fancybox({"zoomSpeedIn":100,"zoomSpeedOut":100,"padding":0,"cyclic":true,"overlayShow":false,"showCloseButton":true,"changeSpeed":100,"changeFade":100,"hideOnContentClick":true,"transitionIn":"none","transitionOut":"none","centerOnScroll":false,"titleFormat":a,"showNavArrows":true,"titleShow":true,"enableEscapeButton":true,"titlePosition":"over","onStart":function(j,h,i){if(b(j[h].href)===null){i.titleShow=false;}},"onComplete":function(l,h,i){var k=b(l[h].href),j=0;if(k!==null){$("#fancy_title_link").attr("href",k);}if($("#fancybox-img").length>0){j=$("#fancybox-img").height()*$("#fancybox-img").width();if(j<300000){$("#fancybox-title").hide();}}}});});}function a(g,f,d,e){return"<div id=\\"fancybox-title-over\\"><a id=\\"fancy_title_link\\" href=\\"\\">"+PUNBB.env.fancy_image.lang_title+"</a></div>";}function b(d){var e=null;if(d.indexOf("pic.lg.ua")>0){e=d.replace("pv_","");}else{if(d.indexOf("iteam.net.ua/uploads/")>0){e=d.replace("N_","O_");}else{if(d.indexOf("imageshack.us")>0){e=d.replace(".th.",".");}else{if(d.indexOf("radikal.ru")>0){e=null;}else{if(d.indexOf("piccy.info")>0){e=null;}else{if(d.indexOf("imagepost.ru")>0){e=null;}else{if(d.indexOf("ipicture.ru")>0){e=null;}else{if(d.indexOf("imageshost.ru")>0){e=null;}}}}}}}}return e;}return{init:function(){$(document).bind("run.fancy_image",c).trigger("run.fancy_image");}};}());$(document).ready(PUNBB.fancy_image.init);\', array(\'type\' => \'inline\'));
				}
		    }

array_pop($GLOBALS[\'ext_info_stack\']);
$ext_info = empty($GLOBALS[\'ext_info_stack\']) ? array() : $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];
',
    8 => '$GLOBALS[\'ext_info_stack\'][] = array(
\'id\'				=> \'fancy_link_icons\',
\'path\'			=> FORUM_ROOT.\'extensions/fancy_link_icons\',
\'url\'			=> $GLOBALS[\'base_url\'].\'/extensions/fancy_link_icons\',
\'dependencies\'	=> array (
)
);
$ext_info = $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];

if ($forum_user[\'style\'] !== \'Oxygen\' && file_exists($ext_info[\'path\'].\'/css/\'.$forum_user[\'style\'].\'/fancy_link_icons.min.css\')) {
				$forum_loader->add_css($ext_info[\'url\'].\'/css/\'.$forum_user[\'style\'].\'/fancy_link_icons.min.css\', array(\'type\' => \'url\', \'media\' => \'screen\'));
			} else {
				$forum_loader->add_css($ext_info[\'url\'].\'/css/Oxygen/fancy_link_icons.min.css\', array(\'type\' => \'url\', \'media\' => \'screen\'));
			}

array_pop($GLOBALS[\'ext_info_stack\']);
$ext_info = empty($GLOBALS[\'ext_info_stack\']) ? array() : $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];
',
    9 => '$GLOBALS[\'ext_info_stack\'][] = array(
\'id\'				=> \'fancy_prettify\',
\'path\'			=> FORUM_ROOT.\'extensions/fancy_prettify\',
\'url\'			=> $GLOBALS[\'base_url\'].\'/extensions/fancy_prettify\',
\'dependencies\'	=> array (
)
);
$ext_info = $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];

if (defined(\'FORUM_PAGE\')) {
				if (in_array(FORUM_PAGE, array(\'news\', \'postdelete\', \'postedit\', \'modtopic\', \'post\', \'viewtopic\', \'searchposts\', \'pun_pm-inbox\', \'pun_pm-outbox\'))) {
					if ($forum_user[\'style\'] != \'Oxygen\' && file_exists($ext_info[\'path\'].\'/css/\'.$forum_user[\'style\'].\'/fancy_prettify.min.css\')) {
						$forum_loader->add_css($ext_info[\'url\'].\'/css/\'.$forum_user[\'style\'].\'/fancy_prettify.min.css\');
					} else {
						$forum_loader->add_css($ext_info[\'url\'].\'/css/Oxygen/fancy_prettify.min.css\');
					}

					$forum_loader->add_js($ext_info[\'url\'].\'/js/fancy_prettify.min.js\', array(\'type\' => \'url\', \'async\' => true));
				}
			}

array_pop($GLOBALS[\'ext_info_stack\']);
$ext_info = empty($GLOBALS[\'ext_info_stack\']) ? array() : $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];
',
    10 => '$GLOBALS[\'ext_info_stack\'][] = array(
\'id\'				=> \'fancy_scroll_to_top\',
\'path\'			=> FORUM_ROOT.\'extensions/fancy_scroll_to_top\',
\'url\'			=> $GLOBALS[\'base_url\'].\'/extensions/fancy_scroll_to_top\',
\'dependencies\'	=> array (
\'pun_jquery\'	=> array(
\'id\'				=> \'pun_jquery\',
\'path\'			=> FORUM_ROOT.\'extensions/pun_jquery\',
\'url\'			=> $GLOBALS[\'base_url\'].\'/extensions/pun_jquery\'),
)
);
$ext_info = $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];

$forum_loader->add_js($ext_info[\'url\'].\'/js/fancy_scroll_to_top.min.js\',
				array(
					\'type\' 		=> \'url\',
					\'async\' 	=> TRUE,
					\'weight\' 	=> 140
				)
			);

			if ($forum_user[\'style\'] != \'Oxygen\' && file_exists($ext_info[\'path\'].\'/css/\'.$forum_user[\'style\'].\'/fancy_scroll_to_top.min.css\')) {
				$forum_loader->add_css($ext_info[\'url\'].\'/css/\'.$forum_user[\'style\'].\'/fancy_scroll_to_top.min.css\',
					array(\'type\' => \'url\', \'media\' => \'screen\'))
				;
			} else {
				// Optimze: inline for Oxygen
				$forum_loader->add_css(\'#topcontrol{font-size:.8em;padding:.4em .5em .5em;border-radius:.3em;color:#cb4b16;font-weight:bold;cursor:pointer;z-index:10;background:#e6eaf6;background:-moz-linear-gradient(center top,#f5f7fd,#e6eaf6) repeat scroll 0 0 transparent;background:-o-linear-gradient(top,#f5f7fd,#e6eaf6);background:-webkit-gradient(linear,0 0,0 100%,from(#f5f7fd),to(#e6eaf6));background:-webkit-linear-gradient(top,#f5f7fd,#e6eaf6);background:-ms-linear-gradient(top,#f5f7fd,#e6eaf6);background:linear-gradient(top,#f5f7fd,#e6eaf6);text-shadow:0 1px 1px #bbb;-moz-box-shadow:0 1px 2px rgba(0,0,0,.2);-webkit-box-shadow:0 1px 2px rgba(0,0,0,.2);box-shadow:0 1px 2px rgba(0,0,0,.2)}#topcontrol:hover{color:#db4c18;-moz-transform:scaley(1.15);-webkit-transform:scaley(1.15)}\',
					array(\'type\' => \'inline\'))
				;
			}

array_pop($GLOBALS[\'ext_info_stack\']);
$ext_info = empty($GLOBALS[\'ext_info_stack\']) ? array() : $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];
',
    11 => '$GLOBALS[\'ext_info_stack\'][] = array(
\'id\'				=> \'fancy_stop_spam\',
\'path\'			=> FORUM_ROOT.\'extensions/fancy_stop_spam\',
\'url\'			=> $GLOBALS[\'base_url\'].\'/extensions/fancy_stop_spam\',
\'dependencies\'	=> array (
)
);
$ext_info = $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];

if ($forum_user[\'style\'] !== \'Oxygen\' && file_exists($ext_info[\'path\'].\'/css/\'.$forum_user[\'style\'].\'/fancy_stop_spam.css\')) {
				$forum_loader->add_css($ext_info[\'url\'].\'/css/\'.$forum_user[\'style\'].\'/fancy_stop_spam.css\', array(\'type\' => \'url\', \'media\' => \'screen\'));
			} else {
				$forum_loader->add_css($ext_info[\'url\'].\'/css/Oxygen/fancy_stop_spam.css\', array(\'type\' => \'url\', \'media\' => \'screen\'));
			}

array_pop($GLOBALS[\'ext_info_stack\']);
$ext_info = empty($GLOBALS[\'ext_info_stack\']) ? array() : $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];
',
    12 => '$GLOBALS[\'ext_info_stack\'][] = array(
\'id\'				=> \'quadric_google_analytics\',
\'path\'			=> FORUM_ROOT.\'extensions/quadric_google_analytics\',
\'url\'			=> $GLOBALS[\'base_url\'].\'/extensions/quadric_google_analytics\',
\'dependencies\'	=> array (
)
);
$ext_info = $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];

if ( ! empty($forum_config[\'o_quadric_google_analytics_tracking_code\'])) {
				$analytics_tpl = 
	\'<script type="text/javascript">

		var _gaq = _gaq || [];
		_gaq.push([\\\'_setAccount\\\', \\\'\' . $forum_config[\'o_quadric_google_analytics_tracking_code\'] . \'\\\']);
		\' . ($forum_config[\'o_quadric_google_analytics_tracking_mode\'] >= 2 ? \'_gaq.push([\\\'_setDomainName\\\', \\\'\' . (count(explode(\'.\', $_SERVER[\'HTTP_HOST\'])) > 2 ? implode(\'.\', array_slice(explode(\'.\', $_SERVER[\'HTTP_HOST\']), 1)) : $_SERVER[\'HTTP_HOST\']) . \'\\\']);\' : null) . \'
		\' . ($forum_config[\'o_quadric_google_analytics_tracking_mode\'] == 3 ? \'_gaq.push([\\\'_setAllowLinker\\\', true]);\' : null) . \'
		_gaq.push([\\\'_trackPageview\\\']);

		(function() {
			var ga = document.createElement(\\\'script\\\'); ga.type = \\\'text/javascript\\\'; ga.async = true;
			ga.src = (\\\'https:\\\' == document.location.protocol ? \\\'https://ssl\\\' : \\\'http://www\\\') + \\\'.google-analytics.com/ga.js\\\';
			var s = document.getElementsByTagName(\\\'script\\\')[0]; s.parentNode.insertBefore(ga, s);
		})();

	</script>\';
				
				$tpl_main = str_replace(\'</head>\', $analytics_tpl.\'</head>\', $tpl_main);
			}

array_pop($GLOBALS[\'ext_info_stack\']);
$ext_info = empty($GLOBALS[\'ext_info_stack\']) ? array() : $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];
',
  ),
  'po_start' => 
  array (
    0 => '$GLOBALS[\'ext_info_stack\'][] = array(
\'id\'				=> \'pun_attachment\',
\'path\'			=> FORUM_ROOT.\'extensions/pun_attachment\',
\'url\'			=> $GLOBALS[\'base_url\'].\'/extensions/pun_attachment\',
\'dependencies\'	=> array (
)
);
$ext_info = $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];

if (!$forum_config[\'attach_disable_attach\'])
			{
				require $ext_info[\'path\'].\'/include/attach_func.php\';
				if (file_exists($ext_info[\'path\'].\'/lang/\'.$forum_user[\'language\'].\'/\'.$ext_info[\'id\'].\'.php\'))
					require $ext_info[\'path\'].\'/lang/\'.$forum_user[\'language\'].\'/\'.$ext_info[\'id\'].\'.php\';
				else
					require $ext_info[\'path\'].\'/lang/English/\'.$ext_info[\'id\'].\'.php\';
				require $ext_info[\'path\'].\'/url.php\';
			}

array_pop($GLOBALS[\'ext_info_stack\']);
$ext_info = empty($GLOBALS[\'ext_info_stack\']) ? array() : $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];
',
  ),
  'po_qr_get_topic_forum_info' => 
  array (
    0 => '$GLOBALS[\'ext_info_stack\'][] = array(
\'id\'				=> \'pun_attachment\',
\'path\'			=> FORUM_ROOT.\'extensions/pun_attachment\',
\'url\'			=> $GLOBALS[\'base_url\'].\'/extensions/pun_attachment\',
\'dependencies\'	=> array (
)
);
$ext_info = $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];

if (!$forum_config[\'attach_disable_attach\'])
			{
				$query[\'SELECT\'] .= \', g_pun_attachment_allow_upload, g_pun_attachment_upload_max_size, g_pun_attachment_files_per_post, g_pun_attachment_disallowed_extensions, g_pun_attachment_allow_delete_own\';
				$query[\'JOINS\'][] = array(\'LEFT JOIN\' => \'groups AS g\', \'ON\' => \'g.g_id = \'.$forum_user[\'g_id\']);
			}

array_pop($GLOBALS[\'ext_info_stack\']);
$ext_info = empty($GLOBALS[\'ext_info_stack\']) ? array() : $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];
',
  ),
  'po_qr_get_forum_info' => 
  array (
    0 => '$GLOBALS[\'ext_info_stack\'][] = array(
\'id\'				=> \'pun_attachment\',
\'path\'			=> FORUM_ROOT.\'extensions/pun_attachment\',
\'url\'			=> $GLOBALS[\'base_url\'].\'/extensions/pun_attachment\',
\'dependencies\'	=> array (
)
);
$ext_info = $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];

if (!$forum_config[\'attach_disable_attach\'])
			{
				$query[\'SELECT\'] .= \', g_pun_attachment_allow_upload, g_pun_attachment_upload_max_size, g_pun_attachment_files_per_post, g_pun_attachment_disallowed_extensions, g_pun_attachment_allow_delete_own\';
				$query[\'JOINS\'][] = array(\'LEFT JOIN\' => \'groups AS g\', \'ON\' => \'g.g_id = \'.$forum_user[\'g_id\']);
			}

array_pop($GLOBALS[\'ext_info_stack\']);
$ext_info = empty($GLOBALS[\'ext_info_stack\']) ? array() : $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];
',
  ),
  'po_form_submitted' => 
  array (
    0 => '$GLOBALS[\'ext_info_stack\'][] = array(
\'id\'				=> \'pun_attachment\',
\'path\'			=> FORUM_ROOT.\'extensions/pun_attachment\',
\'url\'			=> $GLOBALS[\'base_url\'].\'/extensions/pun_attachment\',
\'dependencies\'	=> array (
)
);
$ext_info = $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];

if (!$forum_config[\'attach_disable_attach\'])
			{
				$attach_secure_str = $forum_user[\'id\'].($tid ? \'t\'.$tid : \'f\'.$fid);
				$attach_query = array(
					\'SELECT\'	=>	\'id, owner_id, post_id, topic_id, filename, file_ext, file_mime_type, file_path, size, download_counter, uploaded_at, secure_str\',
					\'FROM\'		=>	\'attach_files\',
					\'WHERE\'		=>	\'secure_str = \\\'\'.$forum_db->escape($attach_secure_str).\'\\\'\'
				);

				$attach_result = $forum_db->query_build($attach_query) or error(__FILE__, __LINE__);

				$uploaded_list = array();
				while ($cur_attach = $forum_db->fetch_assoc($attach_result))
				{
					$uploaded_list[] = $cur_attach;
				}
			}

array_pop($GLOBALS[\'ext_info_stack\']);
$ext_info = empty($GLOBALS[\'ext_info_stack\']) ? array() : $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];
',
    1 => '$GLOBALS[\'ext_info_stack\'][] = array(
\'id\'				=> \'pun_stop_bots\',
\'path\'			=> FORUM_ROOT.\'extensions/pun_stop_bots\',
\'url\'			=> $GLOBALS[\'base_url\'].\'/extensions/pun_stop_bots\',
\'dependencies\'	=> array (
)
);
$ext_info = $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];

if (!$forum_page[\'is_admmod\'] && !isset($_POST[\'preview\']))
			{
				include $ext_info[\'path\'].\'/functions.php\';
				if (file_exists(FORUM_CACHE_DIR.\'cache_pun_stop_bots.php\'))
					include FORUM_CACHE_DIR.\'cache_pun_stop_bots.php\';
				if (!defined(\'PUN_STOP_BOTS_CACHE_LOADED\') || $pun_stop_bots_questions[\'cached\'] < (time() - 43200))
				{
					pun_stop_bots_generate_cache();
					require FORUM_CACHE_DIR.\'cache_pun_stop_bots.php\';
				}
				if (file_exists($ext_info[\'path\'].\'/lang/\'.$forum_user[\'language\'].\'/\'.$ext_info[\'id\'].\'.php\'))
					include $ext_info[\'path\'].\'/lang/\'.$forum_user[\'language\'].\'/\'.$ext_info[\'id\'].\'.php\';
				else
					include $ext_info[\'path\'].\'/lang/English/\'.$ext_info[\'id\'].\'.php\';

				$pun_stop_bots_true_answer = FALSE;

				//Check up the cookie.
				if (isset($_COOKIE[PUN_STOP_BOTS_COOKIE_NAME]))
					$pun_stop_bots_true_answer = pun_stop_bots_check_cookie();
				//Check up the entered question.
				else if (isset($_POST[\'pun_stop_bots_submit\']))
				{
					$query = array(
						\'SELECT\'	=> \'pun_stop_bots_question_id\',
						\'FROM\'		=> $forum_user[\'is_guest\'] ? \'online\' : \'users\',
						\'WHERE\'		=> $forum_user[\'is_guest\'] ? \'ident = \\\'\'.$forum_user[\'ident\'].\'\\\'\' : \'id = \'.$forum_user[\'id\']
					);
					$result = $forum_db->query_build($query) or error(__FILE__, __LINE__);
					$row = $forum_db->fetch_assoc($result);

					if ($row)
						$question_id = $row[\'pun_stop_bots_question_id\'];
					else
						message($lang_common[\'Bad request\']);

					$answer = isset($_POST[\'pun_stop_bots_answer\']) ? forum_trim(strtolower($_POST[\'pun_stop_bots_answer\'])) : null;
					if (!empty($answer))
						$pun_stop_bots_true_answer = pun_stop_bots_compare_answers($answer, $question_id);
					else
						$pun_stop_bots_true_answer = FALSE;
					//Generate new question in case of incorrect answer.
					if (!$pun_stop_bots_true_answer)
						$new_question_id = $forum_user[\'is_guest\'] ? pun_stop_bots_generate_guest_question_id() : pun_stop_bots_generate_user_question_id();
				}

				// If it is a user and answer is correct set new cookie.
				if (!$forum_user[\'is_guest\'] && !isset($_COOKIE[PUN_STOP_BOTS_COOKIE_NAME]) && $pun_stop_bots_true_answer)
				{
					$new_question_id = $forum_user[\'is_guest\'] ? pun_stop_bots_generate_guest_question_id() : pun_stop_bots_generate_user_question_id();
					pun_stop_bots_set_cookie($new_question_id);
				}
				else if ($forum_user[\'is_guest\'] && $pun_stop_bots_true_answer)
				{
					$query = array(
						\'UPDATE\'	=>	\'online\',
						\'SET\'		=>	\'pun_stop_bots_question_id = NULL\',
						\'WHERE\'		=>	\'ident = \\\'\'.$forum_user[\'ident\'].\'\\\'\'
					);
					$forum_db->query_build($query) or error(__FILE__, __LINE__);
				}
				else if (!$pun_stop_bots_true_answer)
				{
					//If it is first request of the page, we need to generate new question.
					if (!isset($new_question_id))
						$new_question_id =  $forum_user[\'is_guest\'] ? pun_stop_bots_generate_guest_question_id() : pun_stop_bots_generate_user_question_id();

					$forum_page[\'crumbs\'] = array(
						array($forum_config[\'o_board_title\'], forum_link($forum_url[\'index\'])),
						$lang_pun_stop_bots[\'Stop bots question legend\']
					);

					$forum_page[\'form_handler\'] = $_SERVER[\'REQUEST_URI\'];
					$forum_page[\'question\'] = $pun_stop_bots_questions[\'questions\'][$new_question_id][\'question\'];
					$forum_page[\'hidden_fields\'] = $_POST;

					define(\'FORUM_PAGE\', \'pun_stop_bots_page\');
					require FORUM_ROOT.\'header.php\';

					// START SUBST - <!-- forum_main -->
					ob_start();

					include $ext_info[\'path\'].\'/views/question_page.php\';

					$tpl_temp = forum_trim(ob_get_contents());
					$tpl_main = str_replace(\'<!-- forum_main -->\', $tpl_temp, $tpl_main);
					ob_end_clean();
					// END SUBST - <!-- forum_main -->

					require FORUM_ROOT.\'footer.php\';
				}
			}

array_pop($GLOBALS[\'ext_info_stack\']);
$ext_info = empty($GLOBALS[\'ext_info_stack\']) ? array() : $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];
',
    2 => '$GLOBALS[\'ext_info_stack\'][] = array(
\'id\'				=> \'fancy_stop_spam\',
\'path\'			=> FORUM_ROOT.\'extensions/fancy_stop_spam\',
\'url\'			=> $GLOBALS[\'base_url\'].\'/extensions/fancy_stop_spam\',
\'dependencies\'	=> array (
)
);
$ext_info = $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];

// CHECK HONEY FIELDS
			if ($forum_config[\'o_fancy_stop_spam_post_form_honeypot\'] == \'1\' && !isset($_POST[\'preview\'])) {
				if (!isset($_POST[\'form_honey_key_id\'])) {
					$fancy_stop_spam = Fancy_stop_spam::singleton();
					$fancy_stop_spam->log(Fancy_stop_spam::LOG_POST_HONEYPOT_EMPTY, $forum_user[\'id\'], get_remote_address());
					message($lang_fancy_stop_spam[\'Post bot message\']);
				} else {
					$fancy_stop_spam_fullkey = \'email_confirm_xxx_\'.forum_htmlencode(forum_trim($_POST[\'form_honey_key_id\']));
					if (!empty($_POST[$fancy_stop_spam_fullkey])) {
						$fancy_stop_spam = Fancy_stop_spam::singleton();
						$fancy_stop_spam->log(Fancy_stop_spam::LOG_POST_HONEYPOT, $forum_user[\'id\'], get_remote_address());
						$errors[] = $lang_fancy_stop_spam[\'Post bot message\'];
					}
				}
			}

			// CHECK SUBMIT VALUE
			if ($forum_config[\'o_fancy_stop_spam_check_submit\'] == \'1\' && !isset($_POST[\'preview\']) && $forum_user[\'is_guest\']) {
				if (($_POST[\'submit\'] != $lang_post[\'Submit reply\'].Fancy_stop_spam::SUBMIT_MARK) ||
					($_POST[\'submit\'] != $lang_post[\'Submit topic\'].Fancy_stop_spam::SUBMIT_MARK)) {
					$fancy_stop_spam = Fancy_stop_spam::singleton();
					$fancy_stop_spam->log(Fancy_stop_spam::LOG_POST_SUBMIT, $forum_user[\'id\'], get_remote_address());
					message($lang_fancy_stop_spam[\'Post bot message\']);
				}
			}

array_pop($GLOBALS[\'ext_info_stack\']);
$ext_info = empty($GLOBALS[\'ext_info_stack\']) ? array() : $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];
',
  ),
  'po_end_validation' => 
  array (
    0 => '$GLOBALS[\'ext_info_stack\'][] = array(
\'id\'				=> \'pun_attachment\',
\'path\'			=> FORUM_ROOT.\'extensions/pun_attachment\',
\'url\'			=> $GLOBALS[\'base_url\'].\'/extensions/pun_attachment\',
\'dependencies\'	=> array (
)
);
$ext_info = $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];

if (!$forum_config[\'attach_disable_attach\'])
			{
				foreach (array_keys($_POST) as $key)
				{
					if (preg_match(\'~delete_(\\d+)~\', $key, $matches))
					{
						$attach_delete_id = $matches[1];
						break;
					}
				}

				if (isset($attach_delete_id))
				{
					foreach ($uploaded_list as $attach_index => $attach)
					{
						if ($attach[\'id\'] == $attach_delete_id)
						{
							$delete_attach = $attach;
							$attach_delete_index = $attach_index;
							break;
						}
					}

					if (isset($delete_attach) && ($forum_user[\'g_id\'] == FORUM_ADMIN || $cur_posting[\'g_pun_attachment_allow_delete_own\']))
					{
						$attach_query = array(
							\'DELETE\'	=>	\'attach_files\',
							\'WHERE\'		=>	\'id = \'.$delete_attach[\'id\']
						);
						$forum_db->query_build($attach_query) or error(__FILE__, __LINE__);
						unset($uploaded_list[$attach_delete_index]);
						if ($forum_config[\'attach_create_orphans\'] == \'0\')
							unlink($forum_config[\'attach_basefolder\'].$delete_attach[\'file_path\']);
					}
					else
						$errors[] = $lang_attach[\'Del perm error\'];

					$_POST[\'preview\'] = 1;
				}
				else if (isset($_POST[\'add_file\']))
				{
					attach_create_attachment($attach_secure_str, $cur_posting);
					$_POST[\'preview\'] = 1;
				}
			}

array_pop($GLOBALS[\'ext_info_stack\']);
$ext_info = empty($GLOBALS[\'ext_info_stack\']) ? array() : $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];
',
    1 => '$GLOBALS[\'ext_info_stack\'][] = array(
\'id\'				=> \'pun_forum_news\',
\'path\'			=> FORUM_ROOT.\'extensions/pun_forum_news\',
\'url\'			=> $GLOBALS[\'base_url\'].\'/extensions/pun_forum_news\',
\'dependencies\'	=> array (
)
);
$ext_info = $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];

if ($forum_user[\'group_id\'] == FORUM_ADMIN || $forum_user[\'g_add_forum_news\'])
				$pun_forum_news = isset($_POST[\'pun_forum_news\']) ? 1 : 0;

array_pop($GLOBALS[\'ext_info_stack\']);
$ext_info = empty($GLOBALS[\'ext_info_stack\']) ? array() : $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];
',
    2 => '$GLOBALS[\'ext_info_stack\'][] = array(
\'id\'				=> \'pun_tags\',
\'path\'			=> FORUM_ROOT.\'extensions/pun_tags\',
\'url\'			=> $GLOBALS[\'base_url\'].\'/extensions/pun_tags\',
\'dependencies\'	=> array (
)
);
$ext_info = $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];

if (!empty($_POST[\'pun_tags\']) && $forum_user[\'g_pun_tags_allow\'])
				$new_tags = pun_tags_parse_string(utf8_trim($_POST[\'pun_tags\']));

array_pop($GLOBALS[\'ext_info_stack\']);
$ext_info = empty($GLOBALS[\'ext_info_stack\']) ? array() : $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];
',
    3 => '$GLOBALS[\'ext_info_stack\'][] = array(
\'id\'				=> \'fancy_stop_spam\',
\'path\'			=> FORUM_ROOT.\'extensions/fancy_stop_spam\',
\'url\'			=> $GLOBALS[\'base_url\'].\'/extensions/fancy_stop_spam\',
\'dependencies\'	=> array (
)
);
$ext_info = $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];

if ($forum_config[\'o_fancy_stop_spam_check_identical_posts\'] == \'1\') {
				if (!$forum_user[\'is_admmod\'] &&
					(utf8_strlen($message) > Fancy_stop_spam::IDENTICAL_POST_MIN_LENGTH) &&
					($forum_user[\'num_posts\'] < Fancy_stop_spam::IDENTICAL_USER_MAX_POSTS_FOR_CHECK)) {
					$fancy_stop_spam = Fancy_stop_spam::singleton();
					if ($fancy_stop_spam->identical_message_check($forum_user[\'id\'], sha1($message))) {
						$fancy_stop_spam->log(Fancy_stop_spam::LOG_IDENTICAL_POST, $forum_user[\'id\'], get_remote_address());
						$errors[] = $lang_fancy_stop_spam[\'Post Identical message\'];
					}
				}
			}

			$fancy_stop_spam = Fancy_stop_spam::singleton();
			$check_max_links_result = $fancy_stop_spam->max_links_check($message);

			if ($check_max_links_result !== TRUE) {
				$errors[] = $check_max_links_result;
			}

array_pop($GLOBALS[\'ext_info_stack\']);
$ext_info = empty($GLOBALS[\'ext_info_stack\']) ? array() : $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];
',
  ),
  'po_pre_redirect' => 
  array (
    0 => '$GLOBALS[\'ext_info_stack\'][] = array(
\'id\'				=> \'pun_attachment\',
\'path\'			=> FORUM_ROOT.\'extensions/pun_attachment\',
\'url\'			=> $GLOBALS[\'base_url\'].\'/extensions/pun_attachment\',
\'dependencies\'	=> array (
)
);
$ext_info = $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];

if (!$forum_config[\'attach_disable_attach\'] && isset($_POST[\'submit_button\']))
			{
				$attach_query = array(
					\'UPDATE\'	=>	\'attach_files\',
					\'SET\'		=>	\'owner_id = \'.$forum_user[\'id\'].\', topic_id = \'.(isset($new_tid) ? $new_tid : $tid).\', post_id = \'.$new_pid.\', secure_str = NULL\',
					\'WHERE\'		=>	\'secure_str = \\\'\'.$forum_db->escape($attach_secure_str).\'\\\'\'
				);
				$forum_db->query_build($attach_query) or error(__FILE__, __LINE__);
			}

array_pop($GLOBALS[\'ext_info_stack\']);
$ext_info = empty($GLOBALS[\'ext_info_stack\']) ? array() : $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];
',
  ),
  'agr_add_edit_end_validation' => 
  array (
    0 => '$GLOBALS[\'ext_info_stack\'][] = array(
\'id\'				=> \'pun_attachment\',
\'path\'			=> FORUM_ROOT.\'extensions/pun_attachment\',
\'url\'			=> $GLOBALS[\'base_url\'].\'/extensions/pun_attachment\',
\'dependencies\'	=> array (
)
);
$ext_info = $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];

$group_id = isset($_POST[\'group_id\']) ? intval($_POST[\'group_id\']) : \'\';
			if ($_POST[\'mode\'] == \'add\' || (!empty($group_id) && $group_id != FORUM_ADMIN))
			{
				$allow_down = isset($_POST[\'download\']) && $_POST[\'download\'] == \'1\' ? \'1\' : \'0\';
				$allow_upl = isset($_POST[\'upload\']) && $_POST[\'upload\'] == \'1\' ? \'1\' : \'0\';
				$allow_del = isset($_POST[\'delete\']) && $_POST[\'delete\'] == \'1\' ? \'1\' : \'0\';
				$allow_del_own = isset($_POST[\'owner_delete\']) && $_POST[\'owner_delete\'] == \'1\' ? \'1\' : \'0\';

				$size = isset($_POST[\'max_size\']) ? intval($_POST[\'max_size\']) : \'0\';
				$upload_max_filesize = get_bytes(ini_get(\'upload_max_filesize\'));
				$post_max_size = get_bytes(ini_get(\'post_max_size\'));
				if ($size > $upload_max_filesize ||  $size > $post_max_size)
					$size = min($upload_max_filesize, $post_max_size);

				$per_post = isset($_POST[\'per_post\']) ? intval($_POST[\'per_post\']) : \'1\';
				$file_ext = isset($_POST[\'file_ext\']) ? trim($_POST[\'file_ext\']) : \'\';

				if (!empty($file_ext))
				{
					$file_ext = preg_replace(\'/\\s/\', \'\', $file_ext);
					$match = preg_match(\'/(^[a-zA-Z0-9])+(([a-zA-Z0-9]+\\,)|([a-zA-Z0-9]))+([a-zA-Z0-9]+$)/\', $file_ext);

					if (!$match)
						message($lang_attach[\'Wrong allowed\']);
				}
			}

array_pop($GLOBALS[\'ext_info_stack\']);
$ext_info = empty($GLOBALS[\'ext_info_stack\']) ? array() : $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];
',
    1 => '$GLOBALS[\'ext_info_stack\'][] = array(
\'id\'				=> \'pun_colored_usergroups\',
\'path\'			=> FORUM_ROOT.\'extensions/pun_colored_usergroups\',
\'url\'			=> $GLOBALS[\'base_url\'].\'/extensions/pun_colored_usergroups\',
\'dependencies\'	=> array (
)
);
$ext_info = $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];

$link_color = forum_trim($_POST[\'link_color\']);
			$hover_color = forum_trim($_POST[\'hover_color\']);

array_pop($GLOBALS[\'ext_info_stack\']);
$ext_info = empty($GLOBALS[\'ext_info_stack\']) ? array() : $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];
',
    2 => '$GLOBALS[\'ext_info_stack\'][] = array(
\'id\'				=> \'pun_forum_news\',
\'path\'			=> FORUM_ROOT.\'extensions/pun_forum_news\',
\'url\'			=> $GLOBALS[\'base_url\'].\'/extensions/pun_forum_news\',
\'dependencies\'	=> array (
)
);
$ext_info = $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];

$pun_forum_news_add_news = isset($_POST[\'add_forum_news\']) ? intval($_POST[\'add_forum_news\']) : \'0\';

array_pop($GLOBALS[\'ext_info_stack\']);
$ext_info = empty($GLOBALS[\'ext_info_stack\']) ? array() : $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];
',
  ),
  'agr_add_edit_group_flood_fieldset_end' => 
  array (
    0 => '$GLOBALS[\'ext_info_stack\'][] = array(
\'id\'				=> \'pun_attachment\',
\'path\'			=> FORUM_ROOT.\'extensions/pun_attachment\',
\'url\'			=> $GLOBALS[\'base_url\'].\'/extensions/pun_attachment\',
\'dependencies\'	=> array (
)
);
$ext_info = $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];

?>

	<div class="content-head">
		<h3 class="hn"><span><?php echo $lang_attach[\'Group attach part\'] ?></span></h3>
	</div>
	<fieldset class="mf-set set<?php echo ++$forum_page[\'item_count\'] ?>">
		<legend><span><?php echo $lang_attach[\'Attachment rules\'] ?></span></legend>
		<div class="mf-box">
			<div class="mf-item">
				<span class="fld-input"><input type="checkbox" id="fld<?php echo ++$forum_page[\'fld_count\'] ?>" name="download" value="1"<?php if ($group[\'g_pun_attachment_allow_download\'] == \'1\') echo \' checked="checked"\' ?> /></span>
				<label for="fld<?php echo $forum_page[\'fld_count\'] ?>"><?php echo $lang_attach[\'Download\']?></label>
			</div>
			<div class="mf-item">
				<span class="fld-input"><input type="checkbox" id="fld<?php echo ++$forum_page[\'fld_count\'] ?>" name="upload" value="1"<?php if ($group[\'g_pun_attachment_allow_upload\'] == \'1\') echo \' checked="checked"\' ?> /></span>
				<label for="fld<?php echo $forum_page[\'fld_count\'] ?>"><?php echo $lang_attach[\'Upload\'] ?></label>
			</div>
			<div class="mf-item">
				<span class="fld-input"><input type="checkbox" id="fld<?php echo ++$forum_page[\'fld_count\'] ?>" name="delete" value="1"<?php if ($group[\'g_pun_attachment_allow_delete\'] == \'1\') echo \' checked="checked"\' ?> /></span>
				<label for="fld<?php echo $forum_page[\'fld_count\'] ?>"><?php echo $lang_attach[\'Delete\'] ?></label>
			</div>
			<div class="mf-item">
				<span class="fld-input"><input type="checkbox" id="fld<?php echo ++$forum_page[\'fld_count\'] ?>" name="owner_delete" value="1"<?php if ($group[\'g_pun_attachment_allow_delete_own\'] == \'1\') echo \' checked="checked"\' ?> /></span>
				<label for="fld<?php echo $forum_page[\'fld_count\'] ?>"><?php echo $lang_attach[\'Owner delete\'] ?></label>
			</div>
		</div>
	</fieldset>
	<div class="sf-set set<?php echo ++$forum_page[\'item_count\'] ?>">
		<div class="sf-box text">
			<label for="fld<?php echo ++$forum_page[\'fld_count\'] ?>"><span><?php echo $lang_attach[\'Size\'] ?></span> <small><?php echo $lang_attach[\'Size comment\'] ?></small></label><br />
			<span class="fld-input"><input type="text" id="fld<?php echo $forum_page[\'fld_count\'] ?>" name="max_size" size="15" maxlength="15" value="<?php echo $group[\'g_pun_attachment_upload_max_size\'] ?>" /></span>
		</div>
		<div class="sf-box text">
			<label for="fld<?php echo ++$forum_page[\'fld_count\'] ?>"><span><?php echo $lang_attach[\'Per post\'] ?></span></label><br />
			<span class="fld-input"><input type="text" id="fld<?php echo $forum_page[\'fld_count\'] ?>" name="per_post" size="4" maxlength="5" value="<?php echo $group[\'g_pun_attachment_files_per_post\'] ?>" /></span>
		</div>
		<div class="sf-box text">
			<label for="fld<?php echo ++$forum_page[\'fld_count\'] ?>"><span><?php echo $lang_attach[\'Allowed files\'] ?></span><small><?php echo $lang_attach[\'Allowed comment\'] ?></small></label><br />
			<span class="fld-input"><input type="text" id="fld<?php echo $forum_page[\'fld_count\'] ?>" name="file_ext" size="80" maxlength="80" value="<?php echo $group[\'g_pun_attachment_disallowed_extensions\'] ?>" /></span>
		</div>
	</div>

<?php

array_pop($GLOBALS[\'ext_info_stack\']);
$ext_info = empty($GLOBALS[\'ext_info_stack\']) ? array() : $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];
',
    1 => '$GLOBALS[\'ext_info_stack\'][] = array(
\'id\'				=> \'pun_tags\',
\'path\'			=> FORUM_ROOT.\'extensions/pun_tags\',
\'url\'			=> $GLOBALS[\'base_url\'].\'/extensions/pun_tags\',
\'dependencies\'	=> array (
)
);
$ext_info = $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];

?>
				<div class="content-head">
					<h3 class="hn"><span><?php echo $lang_pun_tags[\'Permissions\']; ?></span></h3>
				</div>
				<fieldset class="mf-set set<?php echo ++$forum_page[\'item_count\'] ?>">
					<legend><span><?php echo $lang_pun_tags[\'Create tags perms\']; ?></span></legend>
					<div class="mf-box">
						<div class="mf-item">
							<span class="fld-input"><input type="checkbox" id="fld<?php echo ++$forum_page[\'fld_count\'] ?>" name="pun_tags_allow" value="1"<?php if ($group[\'g_pun_tags_allow\'] == \'1\') echo \' checked="checked"\' ?> /></span>
						<label for="fld<?php echo $forum_page[\'fld_count\'] ?>"><?php echo $lang_pun_tags[\'Name check\']; ?></label>
						</div>
					</div>
				</fieldset>
			<?php

array_pop($GLOBALS[\'ext_info_stack\']);
$ext_info = empty($GLOBALS[\'ext_info_stack\']) ? array() : $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];
',
  ),
  'agr_start' => 
  array (
    0 => '$GLOBALS[\'ext_info_stack\'][] = array(
\'id\'				=> \'pun_attachment\',
\'path\'			=> FORUM_ROOT.\'extensions/pun_attachment\',
\'url\'			=> $GLOBALS[\'base_url\'].\'/extensions/pun_attachment\',
\'dependencies\'	=> array (
)
);
$ext_info = $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];

require $ext_info[\'path\'].\'/include/attach_func.php\';
			if (file_exists($ext_info[\'path\'].\'/lang/\'.$forum_user[\'language\'].\'/\'.$ext_info[\'id\'].\'.php\'))
				require $ext_info[\'path\'].\'/lang/\'.$forum_user[\'language\'].\'/\'.$ext_info[\'id\'].\'.php\';
			else
				require $ext_info[\'path\'].\'/lang/English/\'.$ext_info[\'id\'].\'.php\';

array_pop($GLOBALS[\'ext_info_stack\']);
$ext_info = empty($GLOBALS[\'ext_info_stack\']) ? array() : $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];
',
    1 => '$GLOBALS[\'ext_info_stack\'][] = array(
\'id\'				=> \'pun_colored_usergroups\',
\'path\'			=> FORUM_ROOT.\'extensions/pun_colored_usergroups\',
\'url\'			=> $GLOBALS[\'base_url\'].\'/extensions/pun_colored_usergroups\',
\'dependencies\'	=> array (
)
);
$ext_info = $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];

if (!file_exists(FORUM_CACHE_DIR.\'cache_pun_coloured_usergroups.php\'))
			{
				if (!defined(\'CACHE_PUN_COLOURED_USERGROUPS_LOADED\')) {
					require $ext_info[\'path\'].\'/main.php\';
				}
				cache_pun_coloured_usergroups();
			}

array_pop($GLOBALS[\'ext_info_stack\']);
$ext_info = empty($GLOBALS[\'ext_info_stack\']) ? array() : $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];
',
  ),
  'mr_confirm_delete_topics_pre_redirect' => 
  array (
    0 => '$GLOBALS[\'ext_info_stack\'][] = array(
\'id\'				=> \'pun_attachment\',
\'path\'			=> FORUM_ROOT.\'extensions/pun_attachment\',
\'url\'			=> $GLOBALS[\'base_url\'].\'/extensions/pun_attachment\',
\'dependencies\'	=> array (
)
);
$ext_info = $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];

if (!$forum_config[\'attach_disable_attach\'])
			{
				$attach_query = array(
					\'SELECT\'	=>	\'id, file_path, owner_id\',
					\'FROM\'		=>	\'attach_files\',
					\'WHERE\'		=>	isset($posts) ? \'post_id IN(\'.implode(\',\', $posts).\')\' : \'topic_id IN(\'.implode(\',\', $topics).\')\'
				);
				$forum_page[\'is_admmod\'] = true;
				remove_attachments($attach_query, $cur_forum);
			}

array_pop($GLOBALS[\'ext_info_stack\']);
$ext_info = empty($GLOBALS[\'ext_info_stack\']) ? array() : $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];
',
    1 => '$GLOBALS[\'ext_info_stack\'][] = array(
\'id\'				=> \'pun_tags\',
\'path\'			=> FORUM_ROOT.\'extensions/pun_tags\',
\'url\'			=> $GLOBALS[\'base_url\'].\'/extensions/pun_tags\',
\'dependencies\'	=> array (
)
);
$ext_info = $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];

pun_tags_remove_orphans();
			pun_tags_generate_cache();

array_pop($GLOBALS[\'ext_info_stack\']);
$ext_info = empty($GLOBALS[\'ext_info_stack\']) ? array() : $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];
',
  ),
  'mr_confirm_split_posts_pre_redirect' => 
  array (
    0 => '$GLOBALS[\'ext_info_stack\'][] = array(
\'id\'				=> \'pun_attachment\',
\'path\'			=> FORUM_ROOT.\'extensions/pun_attachment\',
\'url\'			=> $GLOBALS[\'base_url\'].\'/extensions/pun_attachment\',
\'dependencies\'	=> array (
)
);
$ext_info = $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];

$attach_query = array(
				\'UPDATE\'	=>	\'attach_files\',
				\'SET\'		=>	\'topic_id=\'.$new_tid,
				\'WHERE\'		=>	\'post_id IN (\'.implode(\',\', $posts).\')\'
			);
			$forum_db->query_build($attach_query) or error(__FILE__, __LINE__);

array_pop($GLOBALS[\'ext_info_stack\']);
$ext_info = empty($GLOBALS[\'ext_info_stack\']) ? array() : $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];
',
    1 => '$GLOBALS[\'ext_info_stack\'][] = array(
\'id\'				=> \'pun_tags\',
\'path\'			=> FORUM_ROOT.\'extensions/pun_tags\',
\'url\'			=> $GLOBALS[\'base_url\'].\'/extensions/pun_tags\',
\'dependencies\'	=> array (
)
);
$ext_info = $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];

if (!empty($new_tags) && $forum_user[\'g_pun_tags_allow\'])
			{
				foreach ($new_tags as $pun_tag)
					pun_tags_add_new($pun_tag, $new_tid);
				pun_tags_generate_cache();
			}

array_pop($GLOBALS[\'ext_info_stack\']);
$ext_info = empty($GLOBALS[\'ext_info_stack\']) ? array() : $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];
',
  ),
  'mr_confirm_merge_topics_pre_redirect' => 
  array (
    0 => '$GLOBALS[\'ext_info_stack\'][] = array(
\'id\'				=> \'pun_attachment\',
\'path\'			=> FORUM_ROOT.\'extensions/pun_attachment\',
\'url\'			=> $GLOBALS[\'base_url\'].\'/extensions/pun_attachment\',
\'dependencies\'	=> array (
)
);
$ext_info = $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];

$attach_query = array(
				\'UPDATE\'	=>	\'attach_files\',
				\'SET\'		=>	\'topic_id=\'.$merge_to_tid,
				\'WHERE\'		=>	\'topic_id IN(\'.implode(\',\', $topics).\')\'
			);
			$forum_db->query_build($attach_query) or error(__FILE__, __LINE__);

array_pop($GLOBALS[\'ext_info_stack\']);
$ext_info = empty($GLOBALS[\'ext_info_stack\']) ? array() : $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];
',
    1 => '$GLOBALS[\'ext_info_stack\'][] = array(
\'id\'				=> \'pun_tags\',
\'path\'			=> FORUM_ROOT.\'extensions/pun_tags\',
\'url\'			=> $GLOBALS[\'base_url\'].\'/extensions/pun_tags\',
\'dependencies\'	=> array (
)
);
$ext_info = $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];

$query = array(
				\'UPDATE\'	=>	\'topic_tags\',
				\'SET\'		=>	\'topic_id = \'.$merge_to_tid,
				\'WHERE\'		=>	\'topic_id IN(\'.implode(\',\', $topics).\') AND topic_id != \'.$merge_to_tid
			);
			$forum_db->query_build($query) or error(__FILE__, __LINE__);
			pun_tags_generate_cache();

array_pop($GLOBALS[\'ext_info_stack\']);
$ext_info = empty($GLOBALS[\'ext_info_stack\']) ? array() : $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];
',
  ),
  'pf_change_details_settings_email_fieldset_end' => 
  array (
    0 => '$GLOBALS[\'ext_info_stack\'][] = array(
\'id\'				=> \'pun_bbcode\',
\'path\'			=> FORUM_ROOT.\'extensions/pun_bbcode\',
\'url\'			=> $GLOBALS[\'base_url\'].\'/extensions/pun_bbcode\',
\'dependencies\'	=> array (
)
);
$ext_info = $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];

if (file_exists($ext_info[\'path\'].\'/lang/\'.$forum_user[\'language\'].\'/\'.$ext_info[\'id\'].\'.php\'))
				include $ext_info[\'path\'].\'/lang/\'.$forum_user[\'language\'].\'/\'.$ext_info[\'id\'].\'.php\';
			else
				include $ext_info[\'path\'].\'/lang/English/pun_bbcode.php\';

			$forum_page[\'item_count\'] = 0;
?>
				<fieldset class="frm-group group<?php echo ++$forum_page[\'group_count\'] ?>">
					<div class="sf-set set<?php echo ++$forum_page[\'item_count\'] ?>">
						<div class="sf-box checkbox">
							<span class="fld-input"><input type="checkbox" id="fld<?php echo ++$forum_page[\'fld_count\'] ?>" name="form[pun_bbcode_enabled]" value="1"<?php if ($user[\'pun_bbcode_enabled\'] == \'1\') echo \' checked="checked"\' ?> /></span>
							<label for="fld<?php echo $forum_page[\'fld_count\'] ?>"><span><?php echo $lang_pun_bbcode[\'Pun BBCode Bar\'] ?></span> <?php echo $lang_pun_bbcode[\'Notice BBCode Bar\'] ?></label>
						</div>
					</div>
					<div class="sf-set set<?php echo ++$forum_page[\'item_count\'] ?>">
						<div class="sf-box checkbox">
							<span class="fld-input"><input type="checkbox" id="fld<?php echo ++$forum_page[\'fld_count\'] ?>" name="form[pun_bbcode_use_buttons]" value="1"<?php if ($user[\'pun_bbcode_use_buttons\'] == \'1\') echo \' checked="checked"\' ?> /></span>
							<label for="fld<?php echo $forum_page[\'fld_count\'] ?>"><?php echo $lang_pun_bbcode[\'BBCode Graphical buttons\'] ?></label>
						</div>
					</div>
				</fieldset>
<?php

array_pop($GLOBALS[\'ext_info_stack\']);
$ext_info = empty($GLOBALS[\'ext_info_stack\']) ? array() : $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];
',
    1 => '$GLOBALS[\'ext_info_stack\'][] = array(
\'id\'				=> \'pun_pm\',
\'path\'			=> FORUM_ROOT.\'extensions/pun_pm\',
\'url\'			=> $GLOBALS[\'base_url\'].\'/extensions/pun_pm\',
\'dependencies\'	=> array (
)
);
$ext_info = $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];

// Per-user option \'quote beginning of message\'
if ($forum_config[\'p_message_bbcode\'] == \'1\')
{
	if (!isset($lang_pun_pm))
	{
		if (file_exists($ext_info[\'path\'].\'/lang/\'.$forum_user[\'language\'].\'/\'.$ext_info[\'id\'].\'.php\'))
			include $ext_info[\'path\'].\'/lang/\'.$forum_user[\'language\'].\'/\'.$ext_info[\'id\'].\'.php\';
		else
			include $ext_info[\'path\'].\'/lang/English/\'.$ext_info[\'id\'].\'.php\';
	}

	$forum_page[\'item_count\'] = 0;

?>
			<fieldset class="frm-group group<?php echo ++$forum_page[\'group_count\'] ?>">
				<legend class="group-legend"><strong><?php echo $lang_pun_pm[\'PM settings\'] ?></strong></legend>
				<fieldset class="mf-set set<?php echo ++$forum_page[\'item_count\'] ?>">
					<legend><span><?php echo $lang_pun_pm[\'Private messages\'] ?></span></legend>
					<div class="mf-box">
						<div class="mf-item">
							<span class="fld-input"><input type="checkbox" id="fld<?php echo ++$forum_page[\'fld_count\'] ?>" name="form[pun_pm_long_subject]" value="1"<?php if ($user[\'pun_pm_long_subject\'] == \'1\') echo \' checked="checked"\' ?> /></span>
							<label for="fld<?php echo $forum_page[\'fld_count\'] ?>"><?php echo $lang_pun_pm[\'Begin message quote\'] ?></label>
						</div>
					</div>
				</fieldset>
<?php ($hook = get_hook(\'pun_pm_pf_change_details_settings_pre_pm_settings_fieldset_end\')) ? eval($hook) : null; ?>
			</fieldset>
<?php
}
else
	echo "\\t\\t\\t".\'<input type="hidden" name="form[pun_pm_long_subject]" value="\'.$user[\'pun_pm_long_subject\'].\'" />\'."\\n";

array_pop($GLOBALS[\'ext_info_stack\']);
$ext_info = empty($GLOBALS[\'ext_info_stack\']) ? array() : $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];
',
    2 => '$GLOBALS[\'ext_info_stack\'][] = array(
\'id\'				=> \'fancy_simtopics\',
\'path\'			=> FORUM_ROOT.\'extensions/fancy_simtopics\',
\'url\'			=> $GLOBALS[\'base_url\'].\'/extensions/fancy_simtopics\',
\'dependencies\'	=> array (
)
);
$ext_info = $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];

if (!isset($lang_fancy_simtopics)) {
				if (file_exists($ext_info[\'path\'].\'/lang/\'.$forum_user[\'language\'].\'/\'.$ext_info[\'id\'].\'.php\')) {
					require $ext_info[\'path\'].\'/lang/\'.$forum_user[\'language\'].\'/\'.$ext_info[\'id\'].\'.php\';
				} else {
					require $ext_info[\'path\'].\'/lang/English/\'.$ext_info[\'id\'].\'.php\';
				}
			}

			$forum_page[\'item_count\'] = 0;
?>
			<fieldset class="frm-group group<?php echo ++$forum_page[\'group_count\'] ?>">
				<div class="sf-set set<?php echo ++$forum_page[\'item_count\'] ?>">
					<div class="sf-box checkbox">
						<span class="fld-input"><input type="checkbox" id="fld<?php echo ++$forum_page[\'fld_count\'] ?>" name="form[fancy_simtopics_enable]" value="1"<?php if ($user[\'fancy_simtopics_enable\'] == \'1\') echo \' checked="checked"\' ?> /></span>
						<label for="fld<?php echo $forum_page[\'fld_count\'] ?>"><span><?php echo $lang_fancy_simtopics[\'Enable For User Name\'] ?></span><?php echo $lang_fancy_simtopics[\'Enable For User Help\'] ?></label>
					</div>
				</div>
			</fieldset>
<?php

array_pop($GLOBALS[\'ext_info_stack\']);
$ext_info = empty($GLOBALS[\'ext_info_stack\']) ? array() : $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];
',
  ),
  'pun_pm_fn_send_form_pre_textarea_output' => 
  array (
    0 => '$GLOBALS[\'ext_info_stack\'][] = array(
\'id\'				=> \'pun_bbcode\',
\'path\'			=> FORUM_ROOT.\'extensions/pun_bbcode\',
\'url\'			=> $GLOBALS[\'base_url\'].\'/extensions/pun_bbcode\',
\'dependencies\'	=> array (
)
);
$ext_info = $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];

if ($forum_user[\'pun_bbcode_enabled\'])
			{
				define(\'PUN_BBCODE_BAR_INCLUDE\', 1);
				include $ext_info[\'path\'].\'/bar.php\';
				$pun_bbcode_bar = new Pun_bbcode;
				$pun_bbcode_bar->render();
			}

array_pop($GLOBALS[\'ext_info_stack\']);
$ext_info = empty($GLOBALS[\'ext_info_stack\']) ? array() : $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];
',
  ),
  'pf_change_details_settings_validation' => 
  array (
    0 => '$GLOBALS[\'ext_info_stack\'][] = array(
\'id\'				=> \'pun_bbcode\',
\'path\'			=> FORUM_ROOT.\'extensions/pun_bbcode\',
\'url\'			=> $GLOBALS[\'base_url\'].\'/extensions/pun_bbcode\',
\'dependencies\'	=> array (
)
);
$ext_info = $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];

$form[\'pun_bbcode_enabled\'] = (!isset($_POST[\'form\'][\'pun_bbcode_enabled\']) || $_POST[\'form\'][\'pun_bbcode_enabled\'] != \'1\') ? \'0\' : \'1\';
			$form[\'pun_bbcode_use_buttons\'] = (!isset($_POST[\'form\'][\'pun_bbcode_use_buttons\']) || $_POST[\'form\'][\'pun_bbcode_use_buttons\'] != \'1\') ? \'0\' : \'1\';

array_pop($GLOBALS[\'ext_info_stack\']);
$ext_info = empty($GLOBALS[\'ext_info_stack\']) ? array() : $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];
',
    1 => '$GLOBALS[\'ext_info_stack\'][] = array(
\'id\'				=> \'pun_pm\',
\'path\'			=> FORUM_ROOT.\'extensions/pun_pm\',
\'url\'			=> $GLOBALS[\'base_url\'].\'/extensions/pun_pm\',
\'dependencies\'	=> array (
)
);
$ext_info = $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];

// Validate option \'quote beginning of message\'
			if (!isset($_POST[\'form\'][\'pun_pm_long_subject\']) || $_POST[\'form\'][\'pun_pm_long_subject\'] != \'1\')
				$form[\'pun_pm_long_subject\'] = \'0\';
			else
				$form[\'pun_pm_long_subject\'] = \'1\';

array_pop($GLOBALS[\'ext_info_stack\']);
$ext_info = empty($GLOBALS[\'ext_info_stack\']) ? array() : $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];
',
    2 => '$GLOBALS[\'ext_info_stack\'][] = array(
\'id\'				=> \'fancy_simtopics\',
\'path\'			=> FORUM_ROOT.\'extensions/fancy_simtopics\',
\'url\'			=> $GLOBALS[\'base_url\'].\'/extensions/fancy_simtopics\',
\'dependencies\'	=> array (
)
);
$ext_info = $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];

if (!isset($_POST[\'form\'][\'fancy_simtopics_enable\']) || $_POST[\'form\'][\'fancy_simtopics_enable\'] != \'1\') {
				$form[\'fancy_simtopics_enable\'] = \'0\';
			} else {
				$form[\'fancy_simtopics_enable\'] = \'1\';
			}

array_pop($GLOBALS[\'ext_info_stack\']);
$ext_info = empty($GLOBALS[\'ext_info_stack\']) ? array() : $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];
',
  ),
  'ed_pre_message_box' => 
  array (
    0 => '$GLOBALS[\'ext_info_stack\'][] = array(
\'id\'				=> \'pun_bbcode\',
\'path\'			=> FORUM_ROOT.\'extensions/pun_bbcode\',
\'url\'			=> $GLOBALS[\'base_url\'].\'/extensions/pun_bbcode\',
\'dependencies\'	=> array (
)
);
$ext_info = $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];

if ($forum_user[\'pun_bbcode_enabled\'])
			{
				define(\'PUN_BBCODE_BAR_INCLUDE\', 1);
				include $ext_info[\'path\'].\'/bar.php\';
				$pun_bbcode_bar = new Pun_bbcode;
				$pun_bbcode_bar->render();
			}

array_pop($GLOBALS[\'ext_info_stack\']);
$ext_info = empty($GLOBALS[\'ext_info_stack\']) ? array() : $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];
',
  ),
  'po_pre_post_contents' => 
  array (
    0 => '$GLOBALS[\'ext_info_stack\'][] = array(
\'id\'				=> \'pun_bbcode\',
\'path\'			=> FORUM_ROOT.\'extensions/pun_bbcode\',
\'url\'			=> $GLOBALS[\'base_url\'].\'/extensions/pun_bbcode\',
\'dependencies\'	=> array (
)
);
$ext_info = $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];

if ($forum_user[\'pun_bbcode_enabled\'])
			{
				define(\'PUN_BBCODE_BAR_INCLUDE\', 1);
				include $ext_info[\'path\'].\'/bar.php\';
				$pun_bbcode_bar = new Pun_bbcode;
				$pun_bbcode_bar->render();
			}

array_pop($GLOBALS[\'ext_info_stack\']);
$ext_info = empty($GLOBALS[\'ext_info_stack\']) ? array() : $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];
',
    1 => '$GLOBALS[\'ext_info_stack\'][] = array(
\'id\'				=> \'fancy_stop_spam\',
\'path\'			=> FORUM_ROOT.\'extensions/fancy_stop_spam\',
\'url\'			=> $GLOBALS[\'base_url\'].\'/extensions/fancy_stop_spam\',
\'dependencies\'	=> array (
)
);
$ext_info = $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];

if ($forum_config[\'o_fancy_stop_spam_post_form_honeypot\'] == \'1\'):
			?>
				<div class="sf-set set hidden">
					<div class="sf-box text">
						<label for="fld<?php echo ++$forum_page[\'fld_count\'] ?>"><span><?php echo $lang_fancy_stop_spam[\'Honey field\'] ?></span>
						<small><?php echo $lang_fancy_stop_spam[\'Honey field help\'] ?></small></label><br/>
						<span class="fld-input"><input type="text" id="fld<?php echo $forum_page[\'fld_count\'] ?>" name="email_confirm_xxx_<?php echo $fancy_stop_spam_post_key_id; ?>" size="35" autocomplete="off" /></span>
					</div>
				</div>
			<?php
			endif;

array_pop($GLOBALS[\'ext_info_stack\']);
$ext_info = empty($GLOBALS[\'ext_info_stack\']) ? array() : $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];
',
  ),
  'vt_quickpost_pre_message_box' => 
  array (
    0 => '$GLOBALS[\'ext_info_stack\'][] = array(
\'id\'				=> \'pun_bbcode\',
\'path\'			=> FORUM_ROOT.\'extensions/pun_bbcode\',
\'url\'			=> $GLOBALS[\'base_url\'].\'/extensions/pun_bbcode\',
\'dependencies\'	=> array (
)
);
$ext_info = $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];

if ($forum_user[\'pun_bbcode_enabled\'])
			{
				define(\'PUN_BBCODE_BAR_INCLUDE\', 1);
				include $ext_info[\'path\'].\'/bar.php\';
				$pun_bbcode_bar = new Pun_bbcode;
				$pun_bbcode_bar->render();
			}

array_pop($GLOBALS[\'ext_info_stack\']);
$ext_info = empty($GLOBALS[\'ext_info_stack\']) ? array() : $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];
',
  ),
  'vt_row_pre_post_ident_merge' => 
  array (
    0 => '$GLOBALS[\'ext_info_stack\'][] = array(
\'id\'				=> \'pun_colored_usergroups\',
\'path\'			=> FORUM_ROOT.\'extensions/pun_colored_usergroups\',
\'url\'			=> $GLOBALS[\'base_url\'].\'/extensions/pun_colored_usergroups\',
\'dependencies\'	=> array (
)
);
$ext_info = $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];

if ($cur_post[\'poster_id\'] > 1)
				$forum_page[\'post_ident\'][\'byline\'] = \'<span class="post-byline">\'.sprintf((($cur_post[\'id\'] == $cur_topic[\'first_post_id\']) ? $lang_topic[\'Topic byline\'] : $lang_topic[\'Reply byline\']), (($forum_user[\'g_view_users\'] == \'1\') ? \'<em class="group_color_\'.$cur_post[\'g_id\'].\'"><a title="\'.sprintf($lang_topic[\'Go to profile\'], forum_htmlencode($cur_post[\'username\'])).\'" href="\'.forum_link($forum_url[\'user\'], $cur_post[\'poster_id\']).\'">\'.forum_htmlencode($cur_post[\'username\']).\'</a></em>\' : \'<strong>\'.forum_htmlencode($cur_post[\'username\']).\'</strong>\')).\'</span>\';
			else
				$forum_page[\'post_ident\'][\'byline\'] = \'<span class="post-byline">\'.sprintf((($cur_post[\'id\'] == $cur_topic[\'first_post_id\']) ? $lang_topic[\'Topic byline\'] : $lang_topic[\'Reply byline\']), \'<strong>\'.forum_htmlencode($cur_post[\'username\']).\'</strong>\').\'</span>\';

array_pop($GLOBALS[\'ext_info_stack\']);
$ext_info = empty($GLOBALS[\'ext_info_stack\']) ? array() : $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];
',
  ),
  'ul_results_row_pre_data_output' => 
  array (
    0 => '$GLOBALS[\'ext_info_stack\'][] = array(
\'id\'				=> \'pun_colored_usergroups\',
\'path\'			=> FORUM_ROOT.\'extensions/pun_colored_usergroups\',
\'url\'			=> $GLOBALS[\'base_url\'].\'/extensions/pun_colored_usergroups\',
\'dependencies\'	=> array (
)
);
$ext_info = $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];

$forum_page[\'table_row\'][\'username\'] = \'<td class="tc\'.count($forum_page[\'table_row\']).\'"><span class="group_color_\'.$user_data[\'g_id\'].\'"><a href="\'.forum_link($forum_url[\'user\'], $user_data[\'id\']).\'">\'.forum_htmlencode($user_data[\'username\']).\'</a></span></td>\';

array_pop($GLOBALS[\'ext_info_stack\']);
$ext_info = empty($GLOBALS[\'ext_info_stack\']) ? array() : $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];
',
  ),
  'pf_start' => 
  array (
    0 => '$GLOBALS[\'ext_info_stack\'][] = array(
\'id\'				=> \'pun_colored_usergroups\',
\'path\'			=> FORUM_ROOT.\'extensions/pun_colored_usergroups\',
\'url\'			=> $GLOBALS[\'base_url\'].\'/extensions/pun_colored_usergroups\',
\'dependencies\'	=> array (
)
);
$ext_info = $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];

if (!file_exists(FORUM_CACHE_DIR.\'cache_pun_coloured_usergroups.php\'))
			{
				if (!defined(\'CACHE_PUN_COLOURED_USERGROUPS_LOADED\')) {
					require $ext_info[\'path\'].\'/main.php\';
				}
				cache_pun_coloured_usergroups();
			}

array_pop($GLOBALS[\'ext_info_stack\']);
$ext_info = empty($GLOBALS[\'ext_info_stack\']) ? array() : $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];
',
  ),
  'in_start' => 
  array (
    0 => '$GLOBALS[\'ext_info_stack\'][] = array(
\'id\'				=> \'pun_colored_usergroups\',
\'path\'			=> FORUM_ROOT.\'extensions/pun_colored_usergroups\',
\'url\'			=> $GLOBALS[\'base_url\'].\'/extensions/pun_colored_usergroups\',
\'dependencies\'	=> array (
)
);
$ext_info = $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];

if (!file_exists(FORUM_CACHE_DIR.\'cache_pun_coloured_usergroups.php\'))
			{
				if (!defined(\'CACHE_PUN_COLOURED_USERGROUPS_LOADED\')) {
					require $ext_info[\'path\'].\'/main.php\';
				}
				cache_pun_coloured_usergroups();
			}

array_pop($GLOBALS[\'ext_info_stack\']);
$ext_info = empty($GLOBALS[\'ext_info_stack\']) ? array() : $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];
',
  ),
  'in_users_online_pre_online_info_output' => 
  array (
    0 => '$GLOBALS[\'ext_info_stack\'][] = array(
\'id\'				=> \'pun_colored_usergroups\',
\'path\'			=> FORUM_ROOT.\'extensions/pun_colored_usergroups\',
\'url\'			=> $GLOBALS[\'base_url\'].\'/extensions/pun_colored_usergroups\',
\'dependencies\'	=> array (
)
);
$ext_info = $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];

$users = array();
			$result = $forum_db->query_build($query) or error(__FILE__, __LINE__);

			while ($forum_user_online = $forum_db->fetch_assoc($result))
			{
				if ($forum_user_online[\'user_id\'] > 1)
				{
					$users[] = ($forum_user[\'g_view_users\'] == \'1\') ? \'<span class="group_color_\'.$forum_user_online[\'group_id\'].\'"><a href="\'.forum_link($forum_url[\'user\'], $forum_user_online[\'user_id\']).\'">\'.forum_htmlencode($forum_user_online[\'ident\']).\'</a></span>\' : forum_htmlencode($forum_user_online[\'ident\']);
				};
			};

array_pop($GLOBALS[\'ext_info_stack\']);
$ext_info = empty($GLOBALS[\'ext_info_stack\']) ? array() : $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];
',
  ),
  'agr_add_edit_group_pre_basic_details_fieldset_end' => 
  array (
    0 => '$GLOBALS[\'ext_info_stack\'][] = array(
\'id\'				=> \'pun_colored_usergroups\',
\'path\'			=> FORUM_ROOT.\'extensions/pun_colored_usergroups\',
\'url\'			=> $GLOBALS[\'base_url\'].\'/extensions/pun_colored_usergroups\',
\'dependencies\'	=> array (
)
);
$ext_info = $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];

if (file_exists($ext_info[\'path\'].\'/lang/\'.$forum_user[\'language\'].\'/pun_colored_usergroups.php\'))
					include $ext_info[\'path\'].\'/lang/\'.$forum_user[\'language\'].\'/pun_colored_usergroups.php\';
			else
					include $ext_info[\'path\'].\'/lang/English/pun_colored_usergroups.php\';
			?>
				<div class="sf-set set<?php echo ++$forum_page[\'item_count\'] ?>">
					<div class="sf-box text required">
						<label for="fld<?php echo ++$forum_page[\'fld_count\'] ?>"><span><?php echo $lang_pun_colored_usergroups[\'link\'] ?></span></label><br />
						<span class="fld-input"><input type="text" id="fld<?php echo $forum_page[\'fld_count\'] ?>" name="link_color" size="20" maxlength="20" value="<?php echo forum_htmlencode($group[\'link_color\']) ?>" /></span>
					</div>
					<div class="sf-box text required">
						<label for="fld<?php echo ++$forum_page[\'fld_count\'] ?>"><span><?php echo $lang_pun_colored_usergroups[\'hover\'] ?></span></label><br />
						<span class="fld-input"><input type="text" id="fld<?php echo $forum_page[\'fld_count\'] ?>" name="hover_color" size="20" maxlength="20" value="<?php echo forum_htmlencode($group[\'hover_color\']) ?>" /></span>
					</div>
				</div>
			<?php

array_pop($GLOBALS[\'ext_info_stack\']);
$ext_info = empty($GLOBALS[\'ext_info_stack\']) ? array() : $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];
',
  ),
  'in_users_online_qr_get_online_info' => 
  array (
    0 => '$GLOBALS[\'ext_info_stack\'][] = array(
\'id\'				=> \'pun_colored_usergroups\',
\'path\'			=> FORUM_ROOT.\'extensions/pun_colored_usergroups\',
\'url\'			=> $GLOBALS[\'base_url\'].\'/extensions/pun_colored_usergroups\',
\'dependencies\'	=> array (
)
);
$ext_info = $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];

$query[\'SELECT\'] .= \', u.group_id\';
			$query[\'JOINS\'][] = array(
				\'LEFT JOIN\'	=> \'users AS u\',
				\'ON\'		=> \'u.id=o.user_id\'
			);

array_pop($GLOBALS[\'ext_info_stack\']);
$ext_info = empty($GLOBALS[\'ext_info_stack\']) ? array() : $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];
',
  ),
  'pf_change_details_about_output_start' => 
  array (
    0 => '$GLOBALS[\'ext_info_stack\'][] = array(
\'id\'				=> \'pun_colored_usergroups\',
\'path\'			=> FORUM_ROOT.\'extensions/pun_colored_usergroups\',
\'url\'			=> $GLOBALS[\'base_url\'].\'/extensions/pun_colored_usergroups\',
\'dependencies\'	=> array (
)
);
$ext_info = $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];

$forum_page[\'user_ident\'][\'username\'] = \'<li class="username\'.(($user[\'realname\'] ==\'\') ? \' fn nickname\' :  \' nickname\').\'"><strong class="group_color_\'.$user[\'g_id\'].\'">\'.forum_htmlencode($user[\'username\']).\'</strong></li>\';

array_pop($GLOBALS[\'ext_info_stack\']);
$ext_info = empty($GLOBALS[\'ext_info_stack\']) ? array() : $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];
',
  ),
  'agr_add_edit_pre_redirect' => 
  array (
    0 => '$GLOBALS[\'ext_info_stack\'][] = array(
\'id\'				=> \'pun_colored_usergroups\',
\'path\'			=> FORUM_ROOT.\'extensions/pun_colored_usergroups\',
\'url\'			=> $GLOBALS[\'base_url\'].\'/extensions/pun_colored_usergroups\',
\'dependencies\'	=> array (
)
);
$ext_info = $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];

if (!defined(\'CACHE_PUN_COLOURED_USERGROUPS_LOADED\')) {
				require $ext_info[\'path\'].\'/main.php\';
			}
			cache_pun_coloured_usergroups();

array_pop($GLOBALS[\'ext_info_stack\']);
$ext_info = empty($GLOBALS[\'ext_info_stack\']) ? array() : $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];
',
    1 => '$GLOBALS[\'ext_info_stack\'][] = array(
\'id\'				=> \'pun_tags\',
\'path\'			=> FORUM_ROOT.\'extensions/pun_tags\',
\'url\'			=> $GLOBALS[\'base_url\'].\'/extensions/pun_tags\',
\'dependencies\'	=> array (
)
);
$ext_info = $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];

require_once $ext_info[\'path\'].\'/functions.php\';
			pun_tags_generate_forum_perms_cache();

array_pop($GLOBALS[\'ext_info_stack\']);
$ext_info = empty($GLOBALS[\'ext_info_stack\']) ? array() : $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];
',
  ),
  'co_common' => 
  array (
    0 => '$GLOBALS[\'ext_info_stack\'][] = array(
\'id\'				=> \'pun_forum_news\',
\'path\'			=> FORUM_ROOT.\'extensions/pun_forum_news\',
\'url\'			=> $GLOBALS[\'base_url\'].\'/extensions/pun_forum_news\',
\'dependencies\'	=> array (
)
);
$ext_info = $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];

if (file_exists($ext_info[\'path\'].\'/lang/\'.$forum_user[\'language\'].\'/\'.$ext_info[\'id\'].\'.php\'))
				require $ext_info[\'path\'].\'/lang/\'.$forum_user[\'language\'].\'/\'.$ext_info[\'id\'].\'.php\';
			else
				require $ext_info[\'path\'].\'/lang/English/\'.$ext_info[\'id\'].\'.php\';

array_pop($GLOBALS[\'ext_info_stack\']);
$ext_info = empty($GLOBALS[\'ext_info_stack\']) ? array() : $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];
',
    1 => '$GLOBALS[\'ext_info_stack\'][] = array(
\'id\'				=> \'pun_repository\',
\'path\'			=> FORUM_ROOT.\'extensions/pun_repository\',
\'url\'			=> $GLOBALS[\'base_url\'].\'/extensions/pun_repository\',
\'dependencies\'	=> array (
)
);
$ext_info = $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];

$pun_extensions_used = array_merge(isset($pun_extensions_used) ? $pun_extensions_used : array(), array($ext_info[\'id\']));

array_pop($GLOBALS[\'ext_info_stack\']);
$ext_info = empty($GLOBALS[\'ext_info_stack\']) ? array() : $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];
',
    2 => '$GLOBALS[\'ext_info_stack\'][] = array(
\'id\'				=> \'pun_tags\',
\'path\'			=> FORUM_ROOT.\'extensions/pun_tags\',
\'url\'			=> $GLOBALS[\'base_url\'].\'/extensions/pun_tags\',
\'dependencies\'	=> array (
)
);
$ext_info = $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];

if (file_exists($ext_info[\'path\'].\'/lang/\'.$forum_user[\'language\'].\'/\'.$ext_info[\'id\'].\'.php\'))
				require $ext_info[\'path\'].\'/lang/\'.$forum_user[\'language\'].\'/\'.$ext_info[\'id\'].\'.php\';
			else
				require $ext_info[\'path\'].\'/lang/English/\'.$ext_info[\'id\'].\'.php\';

			define(\'PUN_TAGS_CACHE_UPDATE\', 12);
			require_once $ext_info[\'path\'].\'/functions.php\';

			if (file_exists(FORUM_CACHE_DIR.\'cache_pun_tags.php\'))
				include FORUM_CACHE_DIR.\'cache_pun_tags.php\';
			// Regenerate cache
			if ((!defined(\'PUN_TAGS_LOADED\') || $pun_tags[\'cached\'] < (time() - 3600 * PUN_TAGS_CACHE_UPDATE)))
			{
				pun_tags_generate_cache();
				require FORUM_CACHE_DIR.\'cache_pun_tags.php\';
			}

			if (file_exists(FORUM_CACHE_DIR.\'cache_pun_tags_groups_perms.php\'))
				include FORUM_CACHE_DIR.\'cache_pun_tags_groups_perms.php\';
			// Regenerate cache if the it is more than $pun_cache_period hours old
			if ((!defined(\'PUN_TAGS_GROUPS_PERMS\') || $pun_tags_groups_perms[\'cached\'] < (time() - 3600 * PUN_TAGS_CACHE_UPDATE)))
			{
				pun_tags_generate_forum_perms_cache();
				require FORUM_CACHE_DIR.\'cache_pun_tags_groups_perms.php\';
			}

array_pop($GLOBALS[\'ext_info_stack\']);
$ext_info = empty($GLOBALS[\'ext_info_stack\']) ? array() : $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];
',
    3 => '$GLOBALS[\'ext_info_stack\'][] = array(
\'id\'				=> \'fancy_stop_spam\',
\'path\'			=> FORUM_ROOT.\'extensions/fancy_stop_spam\',
\'url\'			=> $GLOBALS[\'base_url\'].\'/extensions/fancy_stop_spam\',
\'dependencies\'	=> array (
)
);
$ext_info = $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];

include $ext_info[\'path\'].\'/fancy_stop_spam.inc.php\';

			// Load LANG
			if (!isset($lang_fancy_stop_spam)) {
				if ($forum_user[\'language\'] != \'English\' &&
				file_exists($ext_info[\'path\'].\'/lang/\'.$forum_user[\'language\'].\'/\'.$ext_info[\'id\'].\'.php\')) {
					include $ext_info[\'path\'].\'/lang/\'.$forum_user[\'language\'].\'/\'.$ext_info[\'id\'].\'.php\';
				} else {
					include $ext_info[\'path\'].\'/lang/English/\'.$ext_info[\'id\'].\'.php\';
				}
			}

array_pop($GLOBALS[\'ext_info_stack\']);
$ext_info = empty($GLOBALS[\'ext_info_stack\']) ? array() : $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];
',
  ),
  'agr_add_edit_group_user_permissions_fieldset_end' => 
  array (
    0 => '$GLOBALS[\'ext_info_stack\'][] = array(
\'id\'				=> \'pun_forum_news\',
\'path\'			=> FORUM_ROOT.\'extensions/pun_forum_news\',
\'url\'			=> $GLOBALS[\'base_url\'].\'/extensions/pun_forum_news\',
\'dependencies\'	=> array (
)
);
$ext_info = $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];

?>
			<fieldset class="mf-set set<?php echo ++$forum_page[\'item_count\'] ?>">
				<legend><span><?php echo $lang_pun_forum_news[\'Permission legend\'] ?></span></legend>
					<div class="mf-box">
						<div class="mf-item">
							<span class="fld-input"><input type="checkbox" id="fld<?php echo $forum_page[\'fld_count\'] ?>" name="add_forum_news" value="1" <?php if ($group[\'g_add_forum_news\'] == 1) echo \' checked="checked"\' ?>  /></span>
							<label for="fld<?php echo $forum_page[\'fld_count\'] ?>"><?php echo $lang_pun_forum_news[\'Permission text\'] ?></label>
						</div>
					</div>
			</fieldset>
			<?php

array_pop($GLOBALS[\'ext_info_stack\']);
$ext_info = empty($GLOBALS[\'ext_info_stack\']) ? array() : $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];
',
  ),
  'po_pre_add_post' => 
  array (
    0 => '$GLOBALS[\'ext_info_stack\'][] = array(
\'id\'				=> \'pun_forum_news\',
\'path\'			=> FORUM_ROOT.\'extensions/pun_forum_news\',
\'url\'			=> $GLOBALS[\'base_url\'].\'/extensions/pun_forum_news\',
\'dependencies\'	=> array (
)
);
$ext_info = $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];

if ($forum_user[\'group_id\'] == FORUM_ADMIN || $forum_user[\'g_add_forum_news\'])
				$post_info[\'forum_news\'] = $pun_forum_news;

array_pop($GLOBALS[\'ext_info_stack\']);
$ext_info = empty($GLOBALS[\'ext_info_stack\']) ? array() : $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];
',
  ),
  'po_pre_add_topic' => 
  array (
    0 => '$GLOBALS[\'ext_info_stack\'][] = array(
\'id\'				=> \'pun_forum_news\',
\'path\'			=> FORUM_ROOT.\'extensions/pun_forum_news\',
\'url\'			=> $GLOBALS[\'base_url\'].\'/extensions/pun_forum_news\',
\'dependencies\'	=> array (
)
);
$ext_info = $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];

if ($forum_user[\'group_id\'] == FORUM_ADMIN || $forum_user[\'g_add_forum_news\'])
				$post_info[\'forum_news\'] = $pun_forum_news;

array_pop($GLOBALS[\'ext_info_stack\']);
$ext_info = empty($GLOBALS[\'ext_info_stack\']) ? array() : $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];
',
  ),
  'fn_add_topic_qr_add_topic_post' => 
  array (
    0 => '$GLOBALS[\'ext_info_stack\'][] = array(
\'id\'				=> \'pun_forum_news\',
\'path\'			=> FORUM_ROOT.\'extensions/pun_forum_news\',
\'url\'			=> $GLOBALS[\'base_url\'].\'/extensions/pun_forum_news\',
\'dependencies\'	=> array (
)
);
$ext_info = $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];

global $forum_user;
			if ($forum_user[\'group_id\'] == FORUM_ADMIN || $forum_user[\'g_add_forum_news\'])
			{
				$query[\'INSERT\'] .= \', forum_news\';
				$query[\'VALUES\'] .= \', \'.$post_info[\'forum_news\'];
			}

array_pop($GLOBALS[\'ext_info_stack\']);
$ext_info = empty($GLOBALS[\'ext_info_stack\']) ? array() : $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];
',
  ),
  'fn_add_post_qr_add_post' => 
  array (
    0 => '$GLOBALS[\'ext_info_stack\'][] = array(
\'id\'				=> \'pun_forum_news\',
\'path\'			=> FORUM_ROOT.\'extensions/pun_forum_news\',
\'url\'			=> $GLOBALS[\'base_url\'].\'/extensions/pun_forum_news\',
\'dependencies\'	=> array (
)
);
$ext_info = $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];

global $forum_user;
			if ($forum_user[\'group_id\'] == FORUM_ADMIN || $forum_user[\'g_add_forum_news\'])
			{
				$query[\'INSERT\'] .= \', forum_news\';
				$query[\'VALUES\'] .= \', \'.$post_info[\'forum_news\'];
			}

array_pop($GLOBALS[\'ext_info_stack\']);
$ext_info = empty($GLOBALS[\'ext_info_stack\']) ? array() : $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];
',
  ),
  'fn_add_topic_end' => 
  array (
    0 => '$GLOBALS[\'ext_info_stack\'][] = array(
\'id\'				=> \'pun_forum_news\',
\'path\'			=> FORUM_ROOT.\'extensions/pun_forum_news\',
\'url\'			=> $GLOBALS[\'base_url\'].\'/extensions/pun_forum_news\',
\'dependencies\'	=> array (
)
);
$ext_info = $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];

if (($forum_user[\'group_id\'] == FORUM_ADMIN || $forum_user[\'g_add_forum_news\']) && $post_info[\'forum_news\'])
			{
				$pun_forum_news_query = array(
					\'INSERT\'	=>	\'post_id, poster, poster_id, message, hide_smilies, posted, forum_id\',
					\'INTO\'		=>	\'pun_forum_news\',
					\'VALUES\'	=>	$new_pid.\', \\\'\'.$forum_db->escape($post_info[\'poster\']).\'\\\', \'.$post_info[\'poster_id\'].\', \\\'\'.$forum_db->escape($post_info[\'message\']).\'\\\', \'.$post_info[\'hide_smilies\'].\', \'.$post_info[\'posted\'].\', \'.$post_info[\'forum_id\']
				);
				$forum_db->query_build($pun_forum_news_query) or error(__FILE__, __LINE__);
			}

array_pop($GLOBALS[\'ext_info_stack\']);
$ext_info = empty($GLOBALS[\'ext_info_stack\']) ? array() : $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];
',
    1 => '$GLOBALS[\'ext_info_stack\'][] = array(
\'id\'				=> \'pun_tags\',
\'path\'			=> FORUM_ROOT.\'extensions/pun_tags\',
\'url\'			=> $GLOBALS[\'base_url\'].\'/extensions/pun_tags\',
\'dependencies\'	=> array (
)
);
$ext_info = $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];

global $new_tags, $pun_tags, $forum_user;

			// Add tags to DB
			if (!empty($new_tags) && $forum_user[\'g_pun_tags_allow\'])
			{
				$search_arr = isset($pun_tags[\'index\']) ? $pun_tags[\'index\'] : array();
				foreach ($new_tags as $pun_tag)
				{
					$tag_id = array_search($pun_tag, $search_arr);
					if ($tag_id !== FALSE)
						pun_tags_add_existing_tag($tag_id, $new_tid);
					else
						pun_tags_add_new($pun_tag, $new_tid);
				}
				pun_tags_generate_cache();
			}

array_pop($GLOBALS[\'ext_info_stack\']);
$ext_info = empty($GLOBALS[\'ext_info_stack\']) ? array() : $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];
',
    2 => '$GLOBALS[\'ext_info_stack\'][] = array(
\'id\'				=> \'fancy_alerts\',
\'path\'			=> FORUM_ROOT.\'extensions/fancy_alerts\',
\'url\'			=> $GLOBALS[\'base_url\'].\'/extensions/fancy_alerts\',
\'dependencies\'	=> array (
)
);
$ext_info = $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];

$fancy_alerts = new Fancy_alerts;

				// CREATE TOPIC ALERTS
				$fancy_alerts->add_new_topic_alerts($post_info[\'poster_id\'], $new_tid, $post_info[\'posted\']);

				// CREATE POST ALERTS
				$fancy_alerts->add_quote_alerts($new_tid, $new_pid, $post_info[\'message\']);

array_pop($GLOBALS[\'ext_info_stack\']);
$ext_info = empty($GLOBALS[\'ext_info_stack\']) ? array() : $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];
',
    3 => '$GLOBALS[\'ext_info_stack\'][] = array(
\'id\'				=> \'fancy_stop_spam\',
\'path\'			=> FORUM_ROOT.\'extensions/fancy_stop_spam\',
\'url\'			=> $GLOBALS[\'base_url\'].\'/extensions/fancy_stop_spam\',
\'dependencies\'	=> array (
)
);
$ext_info = $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];

global $forum_user;

			if ($forum_config[\'o_fancy_stop_spam_check_identical_posts\'] == \'1\') {
				if (!$forum_user[\'is_admmod\'] && utf8_strlen($post_info[\'message\']) > Fancy_stop_spam::IDENTICAL_POST_MIN_LENGTH &&
					$forum_user[\'num_posts\'] < Fancy_stop_spam::IDENTICAL_USER_MAX_POSTS_FOR_CHECK) {
					$fancy_stop_spam = Fancy_stop_spam::singleton();
					$fancy_stop_spam->identical_message_add($post_info[\'poster_id\'], $new_pid, sha1($post_info[\'message\']), $post_info[\'posted\']);
				}
			}

array_pop($GLOBALS[\'ext_info_stack\']);
$ext_info = empty($GLOBALS[\'ext_info_stack\']) ? array() : $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];
',
  ),
  'fn_add_post_end' => 
  array (
    0 => '$GLOBALS[\'ext_info_stack\'][] = array(
\'id\'				=> \'pun_forum_news\',
\'path\'			=> FORUM_ROOT.\'extensions/pun_forum_news\',
\'url\'			=> $GLOBALS[\'base_url\'].\'/extensions/pun_forum_news\',
\'dependencies\'	=> array (
)
);
$ext_info = $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];

if (($forum_user[\'group_id\'] == FORUM_ADMIN || $forum_user[\'g_add_forum_news\']) && $post_info[\'forum_news\'])
			{
				$pun_forum_news_query = array(
					\'INSERT\'	=>	\'post_id, poster, poster_id, message, hide_smilies, posted, forum_id\',
					\'INTO\'		=>	\'pun_forum_news\',
					\'VALUES\'	=>	$new_pid.\', \\\'\'.$forum_db->escape($post_info[\'poster\']).\'\\\', \'.$post_info[\'poster_id\'].\', \\\'\'.$forum_db->escape($post_info[\'message\']).\'\\\', \'.$post_info[\'hide_smilies\'].\', \'.$post_info[\'posted\'].\', \'.$post_info[\'forum_id\']
				);
				$forum_db->query_build($pun_forum_news_query) or error(__FILE__, __LINE__);
			}

array_pop($GLOBALS[\'ext_info_stack\']);
$ext_info = empty($GLOBALS[\'ext_info_stack\']) ? array() : $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];
',
    1 => '$GLOBALS[\'ext_info_stack\'][] = array(
\'id\'				=> \'fancy_alerts\',
\'path\'			=> FORUM_ROOT.\'extensions/fancy_alerts\',
\'url\'			=> $GLOBALS[\'base_url\'].\'/extensions/fancy_alerts\',
\'dependencies\'	=> array (
)
);
$ext_info = $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];

$fancy_alerts = new Fancy_alerts;

				$fancy_alerts->update_topic_alerts($post_info[\'topic_id\'], $new_pid, $post_info[\'posted\'], $post_info[\'poster_id\']);
				$fancy_alerts->add_quote_alerts($post_info[\'topic_id\'], $new_pid, $post_info[\'message\']);

array_pop($GLOBALS[\'ext_info_stack\']);
$ext_info = empty($GLOBALS[\'ext_info_stack\']) ? array() : $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];
',
    2 => '$GLOBALS[\'ext_info_stack\'][] = array(
\'id\'				=> \'fancy_stop_spam\',
\'path\'			=> FORUM_ROOT.\'extensions/fancy_stop_spam\',
\'url\'			=> $GLOBALS[\'base_url\'].\'/extensions/fancy_stop_spam\',
\'dependencies\'	=> array (
)
);
$ext_info = $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];

global $forum_user;

			if ($forum_config[\'o_fancy_stop_spam_check_identical_posts\'] == \'1\') {
				if (!$forum_user[\'is_admmod\'] && utf8_strlen($post_info[\'message\']) > Fancy_stop_spam::IDENTICAL_POST_MIN_LENGTH &&
					$forum_user[\'num_posts\'] < Fancy_stop_spam::IDENTICAL_USER_MAX_POSTS_FOR_CHECK) {
					$fancy_stop_spam = Fancy_stop_spam::singleton();
					$fancy_stop_spam->identical_message_add($post_info[\'poster_id\'], $new_pid, sha1($post_info[\'message\']), $post_info[\'posted\']);
				}
			}

array_pop($GLOBALS[\'ext_info_stack\']);
$ext_info = empty($GLOBALS[\'ext_info_stack\']) ? array() : $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];
',
  ),
  'ed_qr_update_post' => 
  array (
    0 => '$GLOBALS[\'ext_info_stack\'][] = array(
\'id\'				=> \'pun_forum_news\',
\'path\'			=> FORUM_ROOT.\'extensions/pun_forum_news\',
\'url\'			=> $GLOBALS[\'base_url\'].\'/extensions/pun_forum_news\',
\'dependencies\'	=> array (
)
);
$ext_info = $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];

if (($forum_user[\'group_id\'] == FORUM_ADMIN || $forum_user[\'g_add_forum_news\']) && $pun_forum_news != $cur_post[\'forum_news\'])
				$query[\'SET\'] .= \', forum_news = \'.$pun_forum_news;

array_pop($GLOBALS[\'ext_info_stack\']);
$ext_info = empty($GLOBALS[\'ext_info_stack\']) ? array() : $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];
',
  ),
  'vt_quickpost_pre_fieldset_end' => 
  array (
    0 => '$GLOBALS[\'ext_info_stack\'][] = array(
\'id\'				=> \'pun_forum_news\',
\'path\'			=> FORUM_ROOT.\'extensions/pun_forum_news\',
\'url\'			=> $GLOBALS[\'base_url\'].\'/extensions/pun_forum_news\',
\'dependencies\'	=> array (
)
);
$ext_info = $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];

if ($forum_user[\'group_id\'] == FORUM_ADMIN || $forum_user[\'g_add_forum_news\']): ?>
				<fieldset class="mf-set set2">
					<div class="mf-box checkbox">
						<div class="mf-item"><span class="fld-input"><input type="checkbox" value="1" name="pun_forum_news" id="fld3"></span> <label for="fld3"><?php echo $lang_pun_forum_news[\'Post mark\']; ?></label></div>
					</div>
				</fieldset>
			<?php
			endif;

array_pop($GLOBALS[\'ext_info_stack\']);
$ext_info = empty($GLOBALS[\'ext_info_stack\']) ? array() : $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];
',
    1 => '$GLOBALS[\'ext_info_stack\'][] = array(
\'id\'				=> \'fancy_stop_spam\',
\'path\'			=> FORUM_ROOT.\'extensions/fancy_stop_spam\',
\'url\'			=> $GLOBALS[\'base_url\'].\'/extensions/fancy_stop_spam\',
\'dependencies\'	=> array (
)
);
$ext_info = $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];

if ($forum_config[\'o_fancy_stop_spam_post_form_honeypot\'] == \'1\'):
			?>
				<div class="sf-set set hidden">
					<div class="sf-box text">
						<label><span><?php echo $lang_fancy_stop_spam[\'Honey field\'] ?></span>
						<small><?php echo $lang_fancy_stop_spam[\'Honey field help\'] ?></small></label><br/>
						<span class="fld-input"><input type="text" name="email_confirm_xxx_<?php echo $fancy_stop_spam_post_key_id; ?>" size="35" autocomplete="off" /></span>
					</div>
				</div>
			<?php
			endif;

array_pop($GLOBALS[\'ext_info_stack\']);
$ext_info = empty($GLOBALS[\'ext_info_stack\']) ? array() : $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];
',
  ),
  're_rewrite_rules' => 
  array (
    0 => '$GLOBALS[\'ext_info_stack\'][] = array(
\'id\'				=> \'pun_forum_news\',
\'path\'			=> FORUM_ROOT.\'extensions/pun_forum_news\',
\'url\'			=> $GLOBALS[\'base_url\'].\'/extensions/pun_forum_news\',
\'dependencies\'	=> array (
)
);
$ext_info = $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];

$forum_rewrite_rules[\'/^news(\\.php?|\\/)?(.html?|\\/)?$/i\'] = \'misc.php?action=news\';
			$forum_rewrite_rules[\'/^news(\\.php?|\\/)?[\\/_\\-?]?p(age)?[\\/_\\-=]?([0-9]+)?(.html?|\\/)?$/i\'] = \'misc.php?action=news&p=$3\';
			$forum_rewrite_rules[\'/^feed[\\/_-]?(rss|atom)[\\/_-]?news[\\/_-]?(\\.xml?|\\/)?$/i\'] = \'extern.php?action=news&type=$1\';

array_pop($GLOBALS[\'ext_info_stack\']);
$ext_info = empty($GLOBALS[\'ext_info_stack\']) ? array() : $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];
',
    1 => '$GLOBALS[\'ext_info_stack\'][] = array(
\'id\'				=> \'pun_pm\',
\'path\'			=> FORUM_ROOT.\'extensions/pun_pm\',
\'url\'			=> $GLOBALS[\'base_url\'].\'/extensions/pun_pm\',
\'dependencies\'	=> array (
)
);
$ext_info = $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];

$forum_rewrite_rules[\'/^pun_pm[\\/_-]?send(\\.html?|\\/)?$/i\'] = \'misc.php?action=pun_pm_send\';
			$forum_rewrite_rules[\'/^pun_pm[\\/_-]?compose[\\/_-]?([0-9]+)(\\.html?|\\/)?$/i\'] = \'misc.php?section=pun_pm&pmpage=compose&receiver_id=$1\';
			$forum_rewrite_rules[\'/^pun_pm(\\.html?|\\/)?$/i\'] = \'misc.php?section=pun_pm\';
			$forum_rewrite_rules[\'/^pun_pm[\\/_-]?([0-9a-z]+)(\\.html?|\\/)?$/i\'] = \'misc.php?section=pun_pm&pmpage=$1\';
			$forum_rewrite_rules[\'/^pun_pm[\\/_-]?([0-9a-z]+)[\\/_-]?(p|page\\/)([0-9]+)(\\.html?|\\/)?$/i\'] = \'misc.php?section=pun_pm&pmpage=$1&p=$3\';
			$forum_rewrite_rules[\'/^pun_pm[\\/_-]?([0-9a-z]+)[\\/_-]?([0-9]+)(\\.html?|\\/)?$/i\'] = \'misc.php?section=pun_pm&pmpage=$1&message_id=$2\';

			($hook = get_hook(\'pun_pm_after_rewrite_rules_set\')) ? eval($hook) : null;

array_pop($GLOBALS[\'ext_info_stack\']);
$ext_info = empty($GLOBALS[\'ext_info_stack\']) ? array() : $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];
',
    2 => '$GLOBALS[\'ext_info_stack\'][] = array(
\'id\'				=> \'pun_tags\',
\'path\'			=> FORUM_ROOT.\'extensions/pun_tags\',
\'url\'			=> $GLOBALS[\'base_url\'].\'/extensions/pun_tags\',
\'dependencies\'	=> array (
)
);
$ext_info = $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];

$forum_rewrite_rules[\'/^tag[\\/_-]?([0-9]+)(\\.html?|\\/)?$/i\'] = \'search.php?action=tag&tag_id=$1\';
			$forum_rewrite_rules[\'/^tag[\\/_-]?([0-9]+)[\\/_-]p(age)?[\\/_-]?([0-9]+)(\\.html?|\\/)?$/i\'] = \'search.php?action=tag&tag_id=$1&p=$3\';

array_pop($GLOBALS[\'ext_info_stack\']);
$ext_info = empty($GLOBALS[\'ext_info_stack\']) ? array() : $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];
',
  ),
  'co_modify_url_scheme' => 
  array (
    0 => '$GLOBALS[\'ext_info_stack\'][] = array(
\'id\'				=> \'pun_forum_news\',
\'path\'			=> FORUM_ROOT.\'extensions/pun_forum_news\',
\'url\'			=> $GLOBALS[\'base_url\'].\'/extensions/pun_forum_news\',
\'dependencies\'	=> array (
)
);
$ext_info = $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];

if ($forum_config[\'o_sef\'] == \'Default\')
			{
				$forum_url[\'pun_forum_news\'] = \'misc.php?action=news\';
				$forum_url[\'pun_forum_news_page\'] = \'p=$1\';
				$forum_url[\'pun_forum_news_rss\'] = \'extern.php?action=news&amp;type=rss\';
			}
			else if ($forum_config[\'o_sef\'] == \'File_based\' || $forum_config[\'o_sef\'] == \'File_based_(fancy)\')
			{
				$forum_url[\'pun_forum_news\'] = \'news.html\';
				$forum_url[\'pun_forum_news_page\'] = \'p$1\';
				$forum_url[\'pun_forum_news_rss\'] = \'feed-rss-news.xml\';
			}
			else if ($forum_config[\'o_sef\'] == \'Folder_based\' || $forum_config[\'o_sef\'] == \'Folder_based_(fancy)\')
			{
				$forum_url[\'pun_forum_news\'] = \'news/\';
				$forum_url[\'pun_forum_news_page\'] = \'page/$1/\';
				$forum_url[\'pun_forum_news_rss\'] = \'feed/rss/news/\';
			}

array_pop($GLOBALS[\'ext_info_stack\']);
$ext_info = empty($GLOBALS[\'ext_info_stack\']) ? array() : $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];
',
    1 => '$GLOBALS[\'ext_info_stack\'][] = array(
\'id\'				=> \'pun_pm\',
\'path\'			=> FORUM_ROOT.\'extensions/pun_pm\',
\'url\'			=> $GLOBALS[\'base_url\'].\'/extensions/pun_pm\',
\'dependencies\'	=> array (
)
);
$ext_info = $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];

if ($forum_config[\'o_sef\'] != \'Default\' && file_exists($ext_info[\'path\'].\'/url/\'.$forum_config[\'o_sef\'].\'.php\'))
				require $ext_info[\'path\'].\'/url/\'.$forum_config[\'o_sef\'].\'.php\';
			else
				require $ext_info[\'path\'].\'/url/Default.php\';

array_pop($GLOBALS[\'ext_info_stack\']);
$ext_info = empty($GLOBALS[\'ext_info_stack\']) ? array() : $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];
',
    2 => '$GLOBALS[\'ext_info_stack\'][] = array(
\'id\'				=> \'pun_tags\',
\'path\'			=> FORUM_ROOT.\'extensions/pun_tags\',
\'url\'			=> $GLOBALS[\'base_url\'].\'/extensions/pun_tags\',
\'dependencies\'	=> array (
)
);
$ext_info = $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];

if (file_exists($ext_info[\'path\'].\'/url/\'.$forum_config[\'o_sef\'].\'.php\'))
				require $ext_info[\'path\'].\'/url/\'.$forum_config[\'o_sef\'].\'.php\';
			else
				require $ext_info[\'path\'].\'/url/Default.php\';

array_pop($GLOBALS[\'ext_info_stack\']);
$ext_info = empty($GLOBALS[\'ext_info_stack\']) ? array() : $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];
',
    3 => '$GLOBALS[\'ext_info_stack\'][] = array(
\'id\'				=> \'fancy_alerts\',
\'path\'			=> FORUM_ROOT.\'extensions/fancy_alerts\',
\'url\'			=> $GLOBALS[\'base_url\'].\'/extensions/fancy_alerts\',
\'dependencies\'	=> array (
)
);
$ext_info = $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];

if (file_exists($ext_info[\'path\'].\'/url/\'.$forum_config[\'o_sef\'].\'.php\')) {
					require_once $ext_info[\'path\'].\'/url/\'.$forum_config[\'o_sef\'].\'.php\';
				} else {
					require_once $ext_info[\'path\'].\'/url/Default.php\';
				}

array_pop($GLOBALS[\'ext_info_stack\']);
$ext_info = empty($GLOBALS[\'ext_info_stack\']) ? array() : $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];
',
    4 => '$GLOBALS[\'ext_info_stack\'][] = array(
\'id\'				=> \'fancy_stop_spam\',
\'path\'			=> FORUM_ROOT.\'extensions/fancy_stop_spam\',
\'url\'			=> $GLOBALS[\'base_url\'].\'/extensions/fancy_stop_spam\',
\'dependencies\'	=> array (
)
);
$ext_info = $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];

include $ext_info[\'path\'].\'/url/Default.php\';

array_pop($GLOBALS[\'ext_info_stack\']);
$ext_info = empty($GLOBALS[\'ext_info_stack\']) ? array() : $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];
',
    5 => '$GLOBALS[\'ext_info_stack\'][] = array(
\'id\'				=> \'last_topic_title_on_forum_index\',
\'path\'			=> FORUM_ROOT.\'extensions/last_topic_title_on_forum_index\',
\'url\'			=> $GLOBALS[\'base_url\'].\'/extensions/last_topic_title_on_forum_index\',
\'dependencies\'	=> array (
)
);
$ext_info = $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];

if (file_exists($ext_info[\'path\'].\'/url/\'.$forum_config[\'o_sef\'].\'.php\')) {
				require $ext_info[\'path\'].\'/url/\'.$forum_config[\'o_sef\'].\'.php\';
			} else {
				require $ext_info[\'path\'].\'/url/Default.php\';
			}

array_pop($GLOBALS[\'ext_info_stack\']);
$ext_info = empty($GLOBALS[\'ext_info_stack\']) ? array() : $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];
',
  ),
  'fn_generate_navlinks_end' => 
  array (
    0 => '$GLOBALS[\'ext_info_stack\'][] = array(
\'id\'				=> \'pun_forum_news\',
\'path\'			=> FORUM_ROOT.\'extensions/pun_forum_news\',
\'url\'			=> $GLOBALS[\'base_url\'].\'/extensions/pun_forum_news\',
\'dependencies\'	=> array (
)
);
$ext_info = $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];

global $lang_pun_forum_news;

			$tmp_links = array();
			foreach ($links as $link_index => $link_content)
			{
				$tmp_links[$link_index] = $link_content;
				if ($link_index == \'index\')
					$tmp_links[\'pun_forum_news\'] = \'<li id="forumnews"\'.((FORUM_PAGE == \'news\') ? \' class="isactive"\' : \'\').\'><a href="\'.forum_link($forum_url[\'pun_forum_news\']).\'">\'.$lang_pun_forum_news[\'Forum news\'].\'</a></li>\';
			}
			$links = $tmp_links;

array_pop($GLOBALS[\'ext_info_stack\']);
$ext_info = empty($GLOBALS[\'ext_info_stack\']) ? array() : $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];
',
    1 => '$GLOBALS[\'ext_info_stack\'][] = array(
\'id\'				=> \'pun_pm\',
\'path\'			=> FORUM_ROOT.\'extensions/pun_pm\',
\'url\'			=> $GLOBALS[\'base_url\'].\'/extensions/pun_pm\',
\'dependencies\'	=> array (
)
);
$ext_info = $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];

// Link \'PM\' in the main nav menu
			if (isset($links[\'profile\']) && $forum_config[\'o_pun_pm_show_global_link\'])
			{
				global $lang_pun_pm;

				if (!isset($lang_pun_pm))
				{
					if (file_exists($ext_info[\'path\'].\'/lang/\'.$forum_user[\'language\'].\'/\'.$ext_info[\'id\'].\'.php\'))
						include $ext_info[\'path\'].\'/lang/\'.$forum_user[\'language\'].\'/\'.$ext_info[\'id\'].\'.php\';
					else
						include $ext_info[\'path\'].\'/lang/English/\'.$ext_info[\'id\'].\'.php\';
				}

				if (\'pun_pm\' == substr(FORUM_PAGE, 0, 6))
					$links[\'profile\'] = str_replace(\' class="isactive"\', \'\', $links[\'profile\']);

				($hook = get_hook(\'pun_pm_pre_main_navlinks_add\')) ? eval($hook) : null;

				$links[\'profile\'] .= "\\n\\t\\t".\'<li id="nav_pun_pm"\'.(\'pun_pm\' == substr(FORUM_PAGE, 0, 6) ? \' class="isactive"\' : \'\').\'><a href="\'.forum_link($forum_url[\'pun_pm\']).\'"><span>\'.$lang_pun_pm[\'Private messages\'].\'</span></a></li>\';

				($hook = get_hook(\'pun_pm_after_main_navlinks_add\')) ? eval($hook) : null;
			}

array_pop($GLOBALS[\'ext_info_stack\']);
$ext_info = empty($GLOBALS[\'ext_info_stack\']) ? array() : $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];
',
  ),
  'ex_new_action' => 
  array (
    0 => '$GLOBALS[\'ext_info_stack\'][] = array(
\'id\'				=> \'pun_forum_news\',
\'path\'			=> FORUM_ROOT.\'extensions/pun_forum_news\',
\'url\'			=> $GLOBALS[\'base_url\'].\'/extensions/pun_forum_news\',
\'dependencies\'	=> array (
)
);
$ext_info = $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];

if ($action == \'news\')
			{
				// Determine what type of feed to output
				$type = isset($_GET[\'type\']) && in_array($_GET[\'type\'], array(\'html\', \'rss\', \'atom\', \'xml\')) ? $_GET[\'type\'] : \'html\';

				$show = isset($_GET[\'show\']) ? intval($_GET[\'show\']) : 15;
				if ($show < 1 || $show > 50)
					$show = 15;

				$pun_forum_news_query = array(
					\'SELECT\'	=>	\'post_id\',
					\'FROM\'		=>	\'pun_forum_news AS news\',
					\'JOINS\'		=>	array(
						array(
							\'LEFT JOIN\'	=> \'forum_perms AS fp\',
							\'ON\'		=> \'(fp.forum_id = news.forum_id AND fp.group_id = \'.$forum_user[\'g_id\'].\')\'
						)
					),
					\'WHERE\'		=>	\'(fp.read_forum IS NULL OR fp.read_forum = 1)\',
					\'ORDER BY\'	=>	\'news.posted DESC\'
				);
				$pun_forum_news_result = $forum_db->query_build($pun_forum_news_query) or error(__FILE__, __LINE__);

				$no_news = FALSE;
				$post_news_id = array();
				while ($cur_news = $forum_db->fetch_assoc($pun_forum_news_result))
					$post_news_id[] = $cur_news[\'post_id\'];

				if (count($post_news_id) > 0)
				{
					$post_news_id = array_slice($post_news_id, 0, $show);
					$pun_forum_news_query = array(
						\'SELECT\'	=>	\'news.*, t.subject\',
						\'FROM\'		=>	\'pun_forum_news AS news\',
						\'JOINS\'		=> array(
							array(
								\'INNER JOIN\'	=> \'posts AS p\',
								\'ON\'			=> \'news.post_id = p.id\'
							),
							array(
								\'INNER JOIN\'	=> \'topics AS t\',
								\'ON\'			=> \'p.topic_id = t.id\'
							)
						),
						\'WHERE\'		=>	\'post_id IN (\'.implode(\',\', $post_news_id).\')\'
					);
					$query_result = $forum_db->query_build($pun_forum_news_query) or error(__FILE__, __LINE__);

					$posts_info = array();
					while ($cur_post = $forum_db->fetch_assoc($query_result))
					{
						$tmp_index = array_search($cur_post[\'post_id\'], $post_news_id);
						$posts_info[$tmp_index] = $cur_post;
					}
					ksort($posts_info);
					unset($post_news_id);

					if (!defined(\'FORUM_PARSER_LOADED\'))
						require FORUM_ROOT.\'include/parser.php\';

					// Setup the feed
					$feed = array(
						\'title\' 		=>	$forum_config[\'o_board_title\'].$lang_common[\'Title separator\'].$lang_pun_forum_news[\'Forum news\'],
						\'link\'			=>	forum_link($forum_url[\'pun_forum_news\']),
						\'description\'	=>	$lang_pun_forum_news[\'Forum news\'],
						\'items\'			=>	array(),
						\'type\'			=>	\'news\'
					);
					foreach ($posts_info as $post_num => $post_info)
					{
						if ($forum_config[\'o_censoring\'] == \'1\')
							$post_info[\'message\'] = censor_words($post_info[\'message\']);

						$post_info[\'message\'] = parse_message($post_info[\'message\'], $post_info[\'hide_smilies\']);

						$item = array(
							\'id\'			=>	$post_info[\'post_id\'],
							\'title\'			=>	$lang_common[\'RSS reply\'].$post_info[\'subject\'],
							\'link\'			=>	forum_link($forum_url[\'post\'], $post_info[\'post_id\']),
							\'description\'	=>	$post_info[\'message\'],
							\'author\'		=>	array(
								\'name\'	=> $post_info[\'poster\'],
							),
							\'pubdate\'		=>	$post_info[\'posted\']
						);

						$feed[\'items\'][] = $item;
					}

					$output_func = \'output_\'.$type;
					$output_func($feed);
				}
				else
					exit($lang_common[\'Bad request\']);

				exit;
			}

array_pop($GLOBALS[\'ext_info_stack\']);
$ext_info = empty($GLOBALS[\'ext_info_stack\']) ? array() : $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];
',
  ),
  'mr_post_actions_selected' => 
  array (
    0 => '$GLOBALS[\'ext_info_stack\'][] = array(
\'id\'				=> \'pun_move_posts\',
\'path\'			=> FORUM_ROOT.\'extensions/pun_move_posts\',
\'url\'			=> $GLOBALS[\'base_url\'].\'/extensions/pun_move_posts\',
\'dependencies\'	=> array (
)
);
$ext_info = $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];

require $ext_info[\'path\'].\'/move_posts.php\';

array_pop($GLOBALS[\'ext_info_stack\']);
$ext_info = empty($GLOBALS[\'ext_info_stack\']) ? array() : $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];
',
  ),
  'mr_post_actions_pre_mod_options' => 
  array (
    0 => '$GLOBALS[\'ext_info_stack\'][] = array(
\'id\'				=> \'pun_move_posts\',
\'path\'			=> FORUM_ROOT.\'extensions/pun_move_posts\',
\'url\'			=> $GLOBALS[\'base_url\'].\'/extensions/pun_move_posts\',
\'dependencies\'	=> array (
)
);
$ext_info = $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];

$forum_page[\'mod_options\'] = array_merge(array(\'<span class="submit first-item"><input type="submit" name="move_posts" value="\'.$lang_pun_move_posts[\'Move selected\'].\'" /></span>\'), $forum_page[\'mod_options\']);

array_pop($GLOBALS[\'ext_info_stack\']);
$ext_info = empty($GLOBALS[\'ext_info_stack\']) ? array() : $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];
',
  ),
  'pf_change_details_about_pre_header_load' => 
  array (
    0 => '$GLOBALS[\'ext_info_stack\'][] = array(
\'id\'				=> \'pun_pm\',
\'path\'			=> FORUM_ROOT.\'extensions/pun_pm\',
\'url\'			=> $GLOBALS[\'base_url\'].\'/extensions/pun_pm\',
\'dependencies\'	=> array (
)
);
$ext_info = $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];

// Link in the profile
			if (!$forum_user[\'is_guest\'] && $forum_user[\'id\'] != $user[\'id\'])
			{
				if (!isset($lang_pun_pm))
				{
					if (file_exists($ext_info[\'path\'].\'/lang/\'.$forum_user[\'language\'].\'/\'.$ext_info[\'id\'].\'.php\'))
						include $ext_info[\'path\'].\'/lang/\'.$forum_user[\'language\'].\'/\'.$ext_info[\'id\'].\'.php\';
					else
						include $ext_info[\'path\'].\'/lang/English/\'.$ext_info[\'id\'].\'.php\';
				}

				($hook = get_hook(\'pun_pm_pre_profile_user_contact_add\')) ? eval($hook) : null;

				$forum_page[\'user_contact\'][\'PM\'] = \'<li><span>\'.$lang_pun_pm[\'PM\'].\': <a href="\'.forum_link($forum_url[\'pun_pm_post_link\'], $id).\'">\'.$lang_pun_pm[\'Send PM\'].\'</a></span></li>\';

				($hook = get_hook(\'pun_pm_after_profile_user_contact_add\')) ? eval($hook) : null;
			}

array_pop($GLOBALS[\'ext_info_stack\']);
$ext_info = empty($GLOBALS[\'ext_info_stack\']) ? array() : $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];
',
    1 => '$GLOBALS[\'ext_info_stack\'][] = array(
\'id\'				=> \'fancy_alerts\',
\'path\'			=> FORUM_ROOT.\'extensions/fancy_alerts\',
\'url\'			=> $GLOBALS[\'base_url\'].\'/extensions/fancy_alerts\',
\'dependencies\'	=> array (
)
);
$ext_info = $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];

if ($forum_page[\'own_profile\'] || $forum_user[\'g_id\'] == FORUM_ADMIN) {
					if (!isset($lang_fancy_alerts)) {
						if (file_exists($ext_info[\'path\'].\'/lang/\'.$forum_user[\'language\'].\'/\'.$ext_info[\'id\'].\'.php\')) {
							require $ext_info[\'path\'].\'/lang/\'.$forum_user[\'language\'].\'/\'.$ext_info[\'id\'].\'.php\';
						} else {
							require $ext_info[\'path\'].\'/lang/English/\'.$ext_info[\'id\'].\'.php\';
						}
					}
					$forum_page[\'user_activity\'][\'search_fancy_alerts_topics\'] = \'<li\'.(empty($forum_page[\'user_activity\']) ? \' class="first-item"\' : \'\').\'><a href="\'.forum_link($forum_url[\'fancy_alerts_search_my_alerts_topics\'], $id).\'">\'.(($forum_page[\'own_profile\']) ? $lang_fancy_alerts[\'View your topics alerts\'] : sprintf($lang_fancy_alerts[\'View user topics alerts\'], forum_htmlencode($user[\'username\']))).\'</a></li>\';
				}

array_pop($GLOBALS[\'ext_info_stack\']);
$ext_info = empty($GLOBALS[\'ext_info_stack\']) ? array() : $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];
',
  ),
  'pf_view_details_pre_header_load' => 
  array (
    0 => '$GLOBALS[\'ext_info_stack\'][] = array(
\'id\'				=> \'pun_pm\',
\'path\'			=> FORUM_ROOT.\'extensions/pun_pm\',
\'url\'			=> $GLOBALS[\'base_url\'].\'/extensions/pun_pm\',
\'dependencies\'	=> array (
)
);
$ext_info = $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];

// Link in the profile
			if (!$forum_user[\'is_guest\'] && $forum_user[\'id\'] != $user[\'id\'])
			{
				if (!isset($lang_pun_pm))
				{
					if (file_exists($ext_info[\'path\'].\'/lang/\'.$forum_user[\'language\'].\'/\'.$ext_info[\'id\'].\'.php\'))
						include $ext_info[\'path\'].\'/lang/\'.$forum_user[\'language\'].\'/\'.$ext_info[\'id\'].\'.php\';
					else
						include $ext_info[\'path\'].\'/lang/English/\'.$ext_info[\'id\'].\'.php\';
				}

				($hook = get_hook(\'pun_pm_pre_profile_user_contact_add\')) ? eval($hook) : null;

				$forum_page[\'user_contact\'][\'PM\'] = \'<li><span>\'.$lang_pun_pm[\'PM\'].\': <a href="\'.forum_link($forum_url[\'pun_pm_post_link\'], $id).\'">\'.$lang_pun_pm[\'Send PM\'].\'</a></span></li>\';

				($hook = get_hook(\'pun_pm_after_profile_user_contact_add\')) ? eval($hook) : null;
			}

array_pop($GLOBALS[\'ext_info_stack\']);
$ext_info = empty($GLOBALS[\'ext_info_stack\']) ? array() : $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];
',
  ),
  'aop_features_validation' => 
  array (
    0 => '$GLOBALS[\'ext_info_stack\'][] = array(
\'id\'				=> \'pun_pm\',
\'path\'			=> FORUM_ROOT.\'extensions/pun_pm\',
\'url\'			=> $GLOBALS[\'base_url\'].\'/extensions/pun_pm\',
\'dependencies\'	=> array (
)
);
$ext_info = $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];

$form[\'pun_pm_inbox_size\'] = (!isset($form[\'pun_pm_inbox_size\']) || (int) $form[\'pun_pm_inbox_size\'] <= 0) ? \'0\' : (string)(int) $form[\'pun_pm_inbox_size\'];
			$form[\'pun_pm_outbox_size\'] = (!isset($form[\'pun_pm_outbox_size\']) || (int) $form[\'pun_pm_outbox_size\'] <= 0) ? \'0\' : (string)(int) $form[\'pun_pm_outbox_size\'];

			if (!isset($form[\'pun_pm_show_new_count\']) || $form[\'pun_pm_show_new_count\'] != \'1\')
				$form[\'pun_pm_show_new_count\'] = \'0\';

			if (!isset($form[\'pun_pm_show_global_link\']) || $form[\'pun_pm_show_global_link\'] != \'1\')
				$form[\'pun_pm_show_global_link\'] = \'0\';

			($hook = get_hook(\'pun_pm_aop_features_validation_end\')) ? eval($hook) : null;

array_pop($GLOBALS[\'ext_info_stack\']);
$ext_info = empty($GLOBALS[\'ext_info_stack\']) ? array() : $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];
',
    1 => '$GLOBALS[\'ext_info_stack\'][] = array(
\'id\'				=> \'pun_tags\',
\'path\'			=> FORUM_ROOT.\'extensions/pun_tags\',
\'url\'			=> $GLOBALS[\'base_url\'].\'/extensions/pun_tags\',
\'dependencies\'	=> array (
)
);
$ext_info = $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];

if (!isset($form[\'pun_tags_show\']) || $form[\'pun_tags_show\'] != \'1\')
				$form[\'pun_tags_show\'] = \'0\';
			if (isset($form[\'pun_tags_count_in_cloud\']) && !empty($form[\'pun_tags_count_in_cloud\']) && intval($form[\'pun_tags_count_in_cloud\']) > 0)
				$form[\'pun_tags_count_in_cloud\'] = intval($form[\'pun_tags_count_in_cloud\']);
			else
				$form[\'pun_tags_count_in_cloud\'] = 25;
			if (isset($form[\'pun_tags_separator\']) && !empty($form[\'pun_tags_separator\']))
				$form[\'pun_tags_separator\'] = $form[\'pun_tags_separator\'];
			else
				$form[\'pun_tags_separator\'] = \' \';

array_pop($GLOBALS[\'ext_info_stack\']);
$ext_info = empty($GLOBALS[\'ext_info_stack\']) ? array() : $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];
',
    2 => '$GLOBALS[\'ext_info_stack\'][] = array(
\'id\'				=> \'fancy_addthis\',
\'path\'			=> FORUM_ROOT.\'extensions/fancy_addthis\',
\'url\'			=> $GLOBALS[\'base_url\'].\'/extensions/fancy_addthis\',
\'dependencies\'	=> array (
)
);
$ext_info = $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];

$form[\'fancy_addthis_button_gplus\'] = (!isset($form[\'fancy_addthis_button_gplus\']) || (int) $form[\'fancy_addthis_button_gplus\'] <= 0) ? \'0\' : \'1\';
			$form[\'fancy_addthis_button_twitter\'] = (!isset($form[\'fancy_addthis_button_twitter\']) || (int) $form[\'fancy_addthis_button_twitter\'] <= 0) ? \'0\' : \'1\';
			$form[\'fancy_addthis_button_facebook\'] = (!isset($form[\'fancy_addthis_button_facebook\']) || (int) $form[\'fancy_addthis_button_facebook\'] <= 0) ? \'0\' : \'1\';

array_pop($GLOBALS[\'ext_info_stack\']);
$ext_info = empty($GLOBALS[\'ext_info_stack\']) ? array() : $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];
',
    3 => '$GLOBALS[\'ext_info_stack\'][] = array(
\'id\'				=> \'fancy_alerts\',
\'path\'			=> FORUM_ROOT.\'extensions/fancy_alerts\',
\'url\'			=> $GLOBALS[\'base_url\'].\'/extensions/fancy_alerts\',
\'dependencies\'	=> array (
)
);
$ext_info = $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];

$form[\'fancy_alerts_autoupdate_interval\'] = (!isset($form[\'fancy_alerts_autoupdate_interval\']) ||  intval($form[\'fancy_alerts_autoupdate_interval\'], 10) < 0) ? 0 : intval($form[\'fancy_alerts_autoupdate_interval\'], 10);

				if ($form[\'fancy_alerts_autoupdate_interval\'] > 0 && $form[\'fancy_alerts_autoupdate_interval\'] < 20) {
					$form[\'fancy_alerts_autoupdate_interval\'] = 20;
				}

array_pop($GLOBALS[\'ext_info_stack\']);
$ext_info = empty($GLOBALS[\'ext_info_stack\']) ? array() : $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];
',
    4 => '$GLOBALS[\'ext_info_stack\'][] = array(
\'id\'				=> \'pun_jquery\',
\'path\'			=> FORUM_ROOT.\'extensions/pun_jquery\',
\'url\'			=> $GLOBALS[\'base_url\'].\'/extensions/pun_jquery\',
\'dependencies\'	=> array (
)
);
$ext_info = $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];

if (isset($form[\'pun_jquery_include_method\']))
			{
				$form[\'pun_jquery_include_method\'] = intval($form[\'pun_jquery_include_method\'], 10);
				if (($form[\'pun_jquery_include_method\'] < PUN_JQUERY_INCLUDE_METHOD_LOCAL) || ($form[\'pun_jquery_include_method\'] > PUN_JQUERY_INCLUDE_METHOD_JQUERY_CDN))
				{
					$form[\'pun_jquery_include_method\'] = PUN_JQUERY_INCLUDE_METHOD_LOCAL;
				}
			}
			else
			{
				$form[\'pun_jquery_include_method\'] = PUN_JQUERY_INCLUDE_METHOD_LOCAL;
			}

array_pop($GLOBALS[\'ext_info_stack\']);
$ext_info = empty($GLOBALS[\'ext_info_stack\']) ? array() : $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];
',
    5 => '$GLOBALS[\'ext_info_stack\'][] = array(
\'id\'				=> \'fancy_js_cache\',
\'path\'			=> FORUM_ROOT.\'extensions/fancy_js_cache\',
\'url\'			=> $GLOBALS[\'base_url\'].\'/extensions/fancy_js_cache\',
\'dependencies\'	=> array (
)
);
$ext_info = $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];

$form[\'fancy_js_css_cache_enable\'] = (!isset($form[\'fancy_js_css_cache_enable\']) || (int) $form[\'fancy_js_css_cache_enable\'] <= 0) ? \'0\' : \'1\';
			$form[\'fancy_js_cache_css_cdn\'] = (isset($form[\'fancy_js_cache_css_cdn\'])) ? utf8_substr($form[\'fancy_js_cache_css_cdn\'], 0, 128) : \'\';

			if ($form[\'fancy_js_css_cache_enable\'] == \'0\') {
				fancy_js_cacher_clear_css_cache();
			}

array_pop($GLOBALS[\'ext_info_stack\']);
$ext_info = empty($GLOBALS[\'ext_info_stack\']) ? array() : $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];
',
    6 => '$GLOBALS[\'ext_info_stack\'][] = array(
\'id\'				=> \'fancy_simtopics\',
\'path\'			=> FORUM_ROOT.\'extensions/fancy_simtopics\',
\'url\'			=> $GLOBALS[\'base_url\'].\'/extensions/fancy_simtopics\',
\'dependencies\'	=> array (
)
);
$ext_info = $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];

$form[\'fancy_simtopics_num_topics\'] = intval($form[\'fancy_simtopics_num_topics\'], 10);
			$form[\'fancy_simtopics_time_topics\'] = intval($form[\'fancy_simtopics_time_topics\'], 10);
			$form[\'fancy_simtopics_one_forum\'] = (!isset($form[\'fancy_simtopics_one_forum\']) || intval($form[\'fancy_simtopics_one_forum\'], 10) <= 0) ? \'0\' : \'1\';
			$form[\'fancy_simtopics_show_for_guest\'] = (!isset($form[\'fancy_simtopics_show_for_guest\']) || intval($form[\'fancy_simtopics_show_for_guest\'], 10) <= 0) ? \'0\' : \'1\';

array_pop($GLOBALS[\'ext_info_stack\']);
$ext_info = empty($GLOBALS[\'ext_info_stack\']) ? array() : $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];
',
    7 => '$GLOBALS[\'ext_info_stack\'][] = array(
\'id\'				=> \'fancy_stop_spam\',
\'path\'			=> FORUM_ROOT.\'extensions/fancy_stop_spam\',
\'url\'			=> $GLOBALS[\'base_url\'].\'/extensions/fancy_stop_spam\',
\'dependencies\'	=> array (
)
);
$ext_info = $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];

$form[\'fancy_stop_spam_max_links\'] = (!isset($form[\'fancy_stop_spam_max_links\']) ||  !is_numeric($form[\'fancy_stop_spam_max_links\'])) ? \'-1\' : intval($form[\'fancy_stop_spam_max_links\'], 10);
			$form[\'fancy_stop_spam_max_guest_links\'] = (!isset($form[\'fancy_stop_spam_max_guest_links\']) ||  !is_numeric($form[\'fancy_stop_spam_max_guest_links\'])) ? \'-1\' : intval($form[\'fancy_stop_spam_max_guest_links\'], 10);

			// Save settings
			if (!isset($form[\'fancy_stop_spam_register_form_honeypot\']) || $form[\'fancy_stop_spam_register_form_honeypot\'] != \'1\') $form[\'fancy_stop_spam_register_form_honeypot\'] = \'0\';
			if (!isset($form[\'fancy_stop_spam_register_form_timeout\']) || $form[\'fancy_stop_spam_register_form_timeout\'] != \'1\') $form[\'fancy_stop_spam_register_form_timeout\'] = \'0\';
			if (!isset($form[\'fancy_stop_spam_register_form_timezone\']) || $form[\'fancy_stop_spam_register_form_timezone\'] != \'1\') $form[\'fancy_stop_spam_register_form_timezone\'] = \'0\';
			if (!isset($form[\'fancy_stop_spam_register_form_sfs_email\']) || $form[\'fancy_stop_spam_register_form_sfs_email\'] != \'1\') $form[\'fancy_stop_spam_register_form_sfs_email\'] = \'0\';
			if (!isset($form[\'fancy_stop_spam_register_form_sfs_ip\']) || $form[\'fancy_stop_spam_register_form_sfs_ip\'] != \'1\') $form[\'fancy_stop_spam_register_form_sfs_ip\'] = \'0\';

			if (!isset($form[\'fancy_stop_spam_post_form_honeypot\']) || $form[\'fancy_stop_spam_post_form_honeypot\'] != \'1\') $form[\'fancy_stop_spam_post_form_honeypot\'] = \'0\';
			if (!isset($form[\'fancy_stop_spam_check_identical_posts\']) || $form[\'fancy_stop_spam_check_identical_posts\'] != \'1\') $form[\'fancy_stop_spam_check_identical_posts\'] = \'0\';
			if (!isset($form[\'fancy_stop_spam_check_signature\']) || $form[\'fancy_stop_spam_check_signature\'] != \'1\') $form[\'fancy_stop_spam_check_signature\'] = \'0\';
			if (!isset($form[\'fancy_stop_spam_check_submit\']) || $form[\'fancy_stop_spam_check_submit\'] != \'1\') $form[\'fancy_stop_spam_check_submit\'] = \'0\';
			if (!isset($form[\'fancy_stop_spam_use_logs\']) || $form[\'fancy_stop_spam_use_logs\'] != \'1\') $form[\'fancy_stop_spam_use_logs\'] = \'0\';

			$form[\'fancy_stop_spam_sfs_api_key\'] = substr(forum_trim($form[\'fancy_stop_spam_sfs_api_key\']), 0, 64);

array_pop($GLOBALS[\'ext_info_stack\']);
$ext_info = empty($GLOBALS[\'ext_info_stack\']) ? array() : $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];
',
    8 => '$GLOBALS[\'ext_info_stack\'][] = array(
\'id\'				=> \'fancy_stat_counters\',
\'path\'			=> FORUM_ROOT.\'extensions/fancy_stat_counters\',
\'url\'			=> $GLOBALS[\'base_url\'].\'/extensions/fancy_stat_counters\',
\'dependencies\'	=> array (
)
);
$ext_info = $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];

// GA
			$form[\'fancy_stat_counter_enable_ga\'] = (!isset($form[\'fancy_stat_counter_enable_ga\']) || (int) $form[\'fancy_stat_counter_enable_ga\'] <= 0) ? \'0\' : \'1\';
			$form[\'fancy_stat_counter_id_ga\'] = (isset($form[\'fancy_stat_counter_id_ga\'])) ? utf8_substr(forum_trim($form[\'fancy_stat_counter_id_ga\']), 0, 20) : \'\';

			// YM
			$form[\'fancy_stat_counter_enable_ym\'] = (!isset($form[\'fancy_stat_counter_enable_ym\']) || (int) $form[\'fancy_stat_counter_enable_ym\'] <= 0) ? \'0\' : \'1\';
			$form[\'fancy_stat_counter_id_ym\'] = (isset($form[\'fancy_stat_counter_id_ym\'])) ? utf8_substr(forum_trim($form[\'fancy_stat_counter_id_ym\']), 0, 20) : \'\';

array_pop($GLOBALS[\'ext_info_stack\']);
$ext_info = empty($GLOBALS[\'ext_info_stack\']) ? array() : $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];
',
    9 => '$GLOBALS[\'ext_info_stack\'][] = array(
\'id\'				=> \'last_topic_title_on_forum_index\',
\'path\'			=> FORUM_ROOT.\'extensions/last_topic_title_on_forum_index\',
\'url\'			=> $GLOBALS[\'base_url\'].\'/extensions/last_topic_title_on_forum_index\',
\'dependencies\'	=> array (
)
);
$ext_info = $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];

$form[\'max_last_topic_title_length\'] = (intval($form[\'max_last_topic_title_length\']) > 0) ? intval($form[\'max_last_topic_title_length\'], 10) : 0;
			$form[\'last_topic_title_mode\'] = (intval($form[\'last_topic_title_mode\']) > 0) ? intval($form[\'last_topic_title_mode\'], 10) : 1;

array_pop($GLOBALS[\'ext_info_stack\']);
$ext_info = empty($GLOBALS[\'ext_info_stack\']) ? array() : $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];
',
  ),
  'fn_delete_user_end' => 
  array (
    0 => '$GLOBALS[\'ext_info_stack\'][] = array(
\'id\'				=> \'pun_pm\',
\'path\'			=> FORUM_ROOT.\'extensions/pun_pm\',
\'url\'			=> $GLOBALS[\'base_url\'].\'/extensions/pun_pm\',
\'dependencies\'	=> array (
)
);
$ext_info = $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];

$query = array(
				\'DELETE\'	=> \'pun_pm_messages\',
				\'WHERE\'		=> \'receiver_id = \'.$user_id.\' AND deleted_by_sender = 1\'
			);
			$result = $forum_db->query_build($query) or error(__FILE__, __LINE__);

			$query = array(
				\'UPDATE\'	=> \'pun_pm_messages\',
				\'SET\'		=> \'deleted_by_receiver = 1\',
				\'WHERE\'		=> \'receiver_id = \'.$user_id
			);
			$result = $forum_db->query_build($query) or error(__FILE__, __LINE__);

array_pop($GLOBALS[\'ext_info_stack\']);
$ext_info = empty($GLOBALS[\'ext_info_stack\']) ? array() : $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];
',
    1 => '$GLOBALS[\'ext_info_stack\'][] = array(
\'id\'				=> \'fancy_alerts\',
\'path\'			=> FORUM_ROOT.\'extensions/fancy_alerts\',
\'url\'			=> $GLOBALS[\'base_url\'].\'/extensions/fancy_alerts\',
\'dependencies\'	=> array (
)
);
$ext_info = $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];

$fancy_alerts = new Fancy_alerts;
				$fancy_alerts->on_del_user($user_id);

array_pop($GLOBALS[\'ext_info_stack\']);
$ext_info = empty($GLOBALS[\'ext_info_stack\']) ? array() : $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];
',
  ),
  'vt_row_pre_post_contacts_merge' => 
  array (
    0 => '$GLOBALS[\'ext_info_stack\'][] = array(
\'id\'				=> \'pun_pm\',
\'path\'			=> FORUM_ROOT.\'extensions/pun_pm\',
\'url\'			=> $GLOBALS[\'base_url\'].\'/extensions/pun_pm\',
\'dependencies\'	=> array (
)
);
$ext_info = $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];

global $lang_pun_pm;

			if (!isset($lang_pun_pm))
			{
				if (file_exists($ext_info[\'path\'].\'/lang/\'.$forum_user[\'language\'].\'/\'.$ext_info[\'id\'].\'.php\'))
					include $ext_info[\'path\'].\'/lang/\'.$forum_user[\'language\'].\'/\'.$ext_info[\'id\'].\'.php\';
				else
					include $ext_info[\'path\'].\'/lang/English/\'.$ext_info[\'id\'].\'.php\';
			}

			($hook = get_hook(\'pun_pm_pre_post_contacts_add\')) ? eval($hook) : null;

			// Links \'Send PM\' near posts
			if (!$forum_user[\'is_guest\'] && $cur_post[\'poster_id\'] > 1 && $forum_user[\'id\'] != $cur_post[\'poster_id\'])
				$forum_page[\'post_contacts\'][\'PM\'] = \'<span class="contact"><a title="\'.$lang_pun_pm[\'Send PM\'].\'" href="\'.forum_link($forum_url[\'pun_pm_post_link\'], $cur_post[\'poster_id\']).\'">\'.$lang_pun_pm[\'PM\'].\'</a></span>\';

			($hook = get_hook(\'pun_pm_after_post_contacts_add\')) ? eval($hook) : null;

array_pop($GLOBALS[\'ext_info_stack\']);
$ext_info = empty($GLOBALS[\'ext_info_stack\']) ? array() : $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];
',
  ),
  'aop_features_avatars_fieldset_end' => 
  array (
    0 => '$GLOBALS[\'ext_info_stack\'][] = array(
\'id\'				=> \'pun_pm\',
\'path\'			=> FORUM_ROOT.\'extensions/pun_pm\',
\'url\'			=> $GLOBALS[\'base_url\'].\'/extensions/pun_pm\',
\'dependencies\'	=> array (
)
);
$ext_info = $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];

// Admin options
if (!isset($lang_pun_pm))
{
	if (file_exists($ext_info[\'path\'].\'/lang/\'.$forum_user[\'language\'].\'/\'.$ext_info[\'id\'].\'.php\'))
		include $ext_info[\'path\'].\'/lang/\'.$forum_user[\'language\'].\'/\'.$ext_info[\'id\'].\'.php\';
	else
		include $ext_info[\'path\'].\'/lang/English/\'.$ext_info[\'id\'].\'.php\';
}

$forum_page[\'group_count\'] = $forum_page[\'item_count\'] = 0;

?>
			<div class="content-head">
				<h2 class="hn"><span><?php echo $lang_pun_pm[\'Features title\'] ?></span></h2>
			</div>
			<fieldset class="frm-group group<?php echo ++$forum_page[\'group_count\'] ?>">
				<legend class="group-legend"><span><?php echo $lang_pun_pm[\'PM settings\'] ?></span></legend>
				<div class="sf-set set<?php echo ++$forum_page[\'item_count\'] ?>">
					<div class="sf-box text">
						<label for="fld<?php echo ++$forum_page[\'fld_count\'] ?>"><span><?php echo $lang_pun_pm[\'Inbox limit\'] ?></span><small><?php echo $lang_pun_pm[\'Inbox limit info\'] ?></small></label><br />
						<span class="fld-input"><input type="text" id="fld<?php echo $forum_page[\'fld_count\'] ?>" name="form[pun_pm_inbox_size]" size="6" maxlength="6" value="<?php echo $forum_config[\'o_pun_pm_inbox_size\'] ?>" /></span>
					</div>
				</div>
				<div class="sf-set set<?php echo ++$forum_page[\'item_count\'] ?>">
					<div class="sf-box text">
						<label for="fld<?php echo ++$forum_page[\'fld_count\'] ?>"><span><?php echo $lang_pun_pm[\'Outbox limit\'] ?></span><small><?php echo $lang_pun_pm[\'Outbox limit info\'] ?></small></label><br />
						<span class="fld-input"><input type="text" id="fld<?php echo $forum_page[\'fld_count\'] ?>" name="form[pun_pm_outbox_size]" size="6" maxlength="6" value="<?php echo $forum_config[\'o_pun_pm_outbox_size\'] ?>" /></span>
					</div>
				</div>
				<fieldset class="mf-set set<?php echo ++$forum_page[\'item_count\'] ?>">
					<legend><span><?php echo $lang_pun_pm[\'Navigation links\'] ?></span></legend>
					<div class="mf-box">
						<div class="mf-item">
							<span class="fld-input"><input type="checkbox" id="fld<?php echo ++$forum_page[\'fld_count\'] ?>" name="form[pun_pm_show_new_count]" value="1"<?php if ($forum_config[\'o_pun_pm_show_new_count\'] == \'1\') echo \' checked="checked"\' ?> /></span>
							<label for="fld<?php echo $forum_page[\'fld_count\'] ?>"><?php echo $lang_pun_pm[\'Snow new count\'] ?></label>
						</div>
						<div class="mf-item">
							<span class="fld-input"><input type="checkbox" id="fld<?php echo ++$forum_page[\'fld_count\'] ?>" name="form[pun_pm_show_global_link]" value="1"<?php if ($forum_config[\'o_pun_pm_show_global_link\'] == \'1\') echo \' checked="checked"\' ?> /></span>
							<label for="fld<?php echo $forum_page[\'fld_count\'] ?>"><?php echo $lang_pun_pm[\'Show global link\'] ?></label>
						</div>
					</div>
				</fieldset>
<?php ($hook = get_hook(\'pun_pm_aop_features_pre_pm_settings_fieldset_end\')) ? eval($hook) : null; ?>
			</fieldset>
<?php

array_pop($GLOBALS[\'ext_info_stack\']);
$ext_info = empty($GLOBALS[\'ext_info_stack\']) ? array() : $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];
',
    1 => '$GLOBALS[\'ext_info_stack\'][] = array(
\'id\'				=> \'pun_tags\',
\'path\'			=> FORUM_ROOT.\'extensions/pun_tags\',
\'url\'			=> $GLOBALS[\'base_url\'].\'/extensions/pun_tags\',
\'dependencies\'	=> array (
)
);
$ext_info = $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];

?>
			<div class="content-head">
				<h2 class="hn">
					<span><?php echo $lang_pun_tags[\'Pun Tags\']; ?></span>
				</h2>
			</div>
			<fieldset class="frm-group group1">
				<legend class="group-legend">
					<span><?php echo $lang_pun_tags[\'Settings\']; ?></span>
				</legend>
				<div class="sf-set set<?php echo ++$forum_page[\'item_count\'] ?>">
					<div class="sf-box checkbox">
						<span class="fld-input">
							<input id="fld<?php echo ++$forum_page[\'fld_count\'] ?>" type="checkbox" <?php if ($forum_config[\'o_pun_tags_show\'] == \'1\') echo \' checked="checked"\' ?> value="1" name="form[pun_tags_show]"/>
						</span>
						<label for="fld<?php echo $forum_page[\'fld_count\'] ?>">
							<span><?php echo $lang_pun_tags[\'Show Pun Tags\']; ?></span>
							<?php echo $lang_pun_tags[\'Pun Tags notice\']; ?>
						</label>
					</div>
				</div>
				<div class="sf-set set<?php echo ++$forum_page[\'item_count\'] ?>">
					<div class="sf-box text">
						<span class="fld-input">
							<input id="fld<?php echo ++$forum_page[\'fld_count\'] ?>" type="text" value="<?php echo $forum_config[\'o_pun_tags_count_in_cloud\']; ?>" maxlength="6" size="6" name="form[pun_tags_count_in_cloud]"/>
						</span>
						<label for="fld<?php echo $forum_page[\'fld_count\'] ?>">
							<span><?php echo $lang_pun_tags[\'Tags count\']; ?></span>
							<small><?php echo $lang_pun_tags[\'Tags count info\']; ?></small>
						</label>
					</div>
				</div>
				<div class="sf-set set<?php echo ++$forum_page[\'item_count\'] ?>">
					<div class="sf-box text">
						<span class="fld-input">
							<input id="fld<?php echo ++$forum_page[\'fld_count\'] ?>" type="text" value="<?php echo $forum_config[\'o_pun_tags_separator\']; ?>" maxlength="10" size="6" name="form[pun_tags_separator]"/>
						</span>
						<label for="fld<?php echo $forum_page[\'fld_count\'] ?>">
							<span><?php echo $lang_pun_tags[\'Separator\']; ?></span>
							<small><?php echo $lang_pun_tags[\'Separator info\']; ?></small>
						</label>
					</div>
				</div>
			</fieldset>
			<?php

array_pop($GLOBALS[\'ext_info_stack\']);
$ext_info = empty($GLOBALS[\'ext_info_stack\']) ? array() : $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];
',
  ),
  'aex_section_manage_pre_header_load' => 
  array (
    0 => '$GLOBALS[\'ext_info_stack\'][] = array(
\'id\'				=> \'pun_repository\',
\'path\'			=> FORUM_ROOT.\'extensions/pun_repository\',
\'url\'			=> $GLOBALS[\'base_url\'].\'/extensions/pun_repository\',
\'dependencies\'	=> array (
)
);
$ext_info = $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];

if (file_exists($ext_info[\'path\'].\'/lang/\'.$forum_user[\'language\'].\'/pun_repository.php\'))
	include $ext_info[\'path\'].\'/lang/\'.$forum_user[\'language\'].\'/pun_repository.php\';
else
	include $ext_info[\'path\'].\'/lang/English/pun_repository.php\';

require_once $ext_info[\'path\'].\'/pun_repository.php\';

if (!defined(\'PUN_REPOSITORY_EXTENSIONS_LOADED\') && file_exists(FORUM_CACHE_DIR.\'cache_pun_repository.php\'))
	include FORUM_CACHE_DIR.\'cache_pun_repository.php\';

if (!defined(\'FORUM_EXT_VERSIONS_LOADED\') && file_exists(FORUM_CACHE_DIR.\'cache_ext_version_notifications.php\'))
	include FORUM_CACHE_DIR.\'cache_ext_version_notifications.php\';

// Regenerate cache only if automatic updates are enabled and if the cache is more than 12 hours old
if (!defined(\'PUN_REPOSITORY_EXTENSIONS_LOADED\') || !defined(\'FORUM_EXT_VERSIONS_LOADED\') || ($pun_repository_extensions_timestamp < $forum_ext_versions_update_cache))
{
	if (pun_repository_generate_cache($pun_repository_error))
		require FORUM_CACHE_DIR.\'cache_pun_repository.php\';
}

array_pop($GLOBALS[\'ext_info_stack\']);
$ext_info = empty($GLOBALS[\'ext_info_stack\']) ? array() : $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];
',
  ),
  'aex_section_manage_pre_ext_actions' => 
  array (
    0 => '$GLOBALS[\'ext_info_stack\'][] = array(
\'id\'				=> \'pun_repository\',
\'path\'			=> FORUM_ROOT.\'extensions/pun_repository\',
\'url\'			=> $GLOBALS[\'base_url\'].\'/extensions/pun_repository\',
\'dependencies\'	=> array (
)
);
$ext_info = $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];

if (defined(\'PUN_REPOSITORY_EXTENSIONS_LOADED\') && isset($pun_repository_extensions[$id]) && version_compare($ext[\'version\'], $pun_repository_extensions[$id][\'version\'], \'<\') && is_writable(FORUM_ROOT.\'extensions/\'.$id))
{
	// Check for unresolved dependencies
	if (isset($pun_repository_extensions[$id][\'dependencies\']))
		$pun_repository_extensions[$id][\'dependencies\'] = pun_repository_check_dependencies($inst_exts, $pun_repository_extensions[$id][\'dependencies\']);

	if (empty($pun_repository_extensions[$id][\'dependencies\'][\'unresolved\']))
		$forum_page[\'ext_actions\'][] = \'<span><a href="\'.$base_url.\'/admin/extensions.php?pun_repository_download_and_update=\'.$id.\'&amp;csrf_token=\'.generate_form_token(\'pun_repository_download_and_update_\'.$id).\'">\'.$lang_pun_repository[\'Download and update\'].\'</a></span>\';
}

array_pop($GLOBALS[\'ext_info_stack\']);
$ext_info = empty($GLOBALS[\'ext_info_stack\']) ? array() : $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];
',
    1 => '$GLOBALS[\'ext_info_stack\'][] = array(
\'id\'				=> \'fancy_addthis\',
\'path\'			=> FORUM_ROOT.\'extensions/fancy_addthis\',
\'url\'			=> $GLOBALS[\'base_url\'].\'/extensions/fancy_addthis\',
\'dependencies\'	=> array (
)
);
$ext_info = $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];

if (!isset($lang_fancy_addthis)) {
				if ($forum_user[\'language\'] != \'English\' && file_exists($ext_info[\'path\'].\'/lang/\'.$forum_user[\'language\'].\'/lang.php\')) {
					require $ext_info[\'path\'].\'/lang/\'.$forum_user[\'language\'].\'/lang.php\';
				} else {
					require $ext_info[\'path\'].\'/lang/English/lang.php\';
				}
			}

			if ($ext[\'id\'] == \'fancy_addthis\' && !isset($forum_page[\'ext_actions\'][\'fancy_addthis_settings\'])) {
				$forum_page[\'ext_actions\'][\'fancy_addthis_settings\'] = \'<span><a href="\'.forum_link($forum_url[\'admin_settings_features\']).\'#\'.$ext_info[\'id\'].\'_settings\'.\'">\'.$lang_fancy_addthis[\'Go to settings\'].\'</a></span>\';
			}

array_pop($GLOBALS[\'ext_info_stack\']);
$ext_info = empty($GLOBALS[\'ext_info_stack\']) ? array() : $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];
',
    2 => '$GLOBALS[\'ext_info_stack\'][] = array(
\'id\'				=> \'fancy_js_cache\',
\'path\'			=> FORUM_ROOT.\'extensions/fancy_js_cache\',
\'url\'			=> $GLOBALS[\'base_url\'].\'/extensions/fancy_js_cache\',
\'dependencies\'	=> array (
)
);
$ext_info = $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];

if (!isset($lang_fancy_js_cache)) {
				if (file_exists($ext_info[\'path\'].\'/lang/\'.$forum_user[\'language\'].\'/\'.$ext_info[\'id\'].\'.php\')) {
					require $ext_info[\'path\'].\'/lang/\'.$forum_user[\'language\'].\'/\'.$ext_info[\'id\'].\'.php\';
				} else {
					require $ext_info[\'path\'].\'/lang/English/\'.$ext_info[\'id\'].\'.php\';
				}
			}

			if ($ext[\'id\'] == \'fancy_js_cache\' && !isset($forum_page[\'ext_actions\'][\'fancy_js_cache_clear\'])) {
				$forum_page[\'ext_actions\'][\'fancy_js_cache_clear\'] = \'<span><a href="\'.forum_link(\'misc.php?action=fancy_js_cache_clear&amp;csrf_token=$1\', array(generate_form_token(\'fancy_js_cache_clear\'.$forum_user[\'id\']))).\'">\'.$lang_fancy_js_cache[\'Clear Cache\'].\'</a></span>\';
			}

			if ($ext[\'id\'] == \'fancy_js_cache\' && !isset($forum_page[\'ext_actions\'][\'fancy_js_cache_settings\'])) {
				$forum_page[\'ext_actions\'][\'fancy_js_cache_settings\'] = \'<span><a href="\'.forum_link($forum_url[\'admin_settings_features\']).\'#\'.$ext_info[\'id\'].\'_settings\'.\'">\'.$lang_fancy_js_cache[\'Go to settings\'].\'</a></span>\';
			}

array_pop($GLOBALS[\'ext_info_stack\']);
$ext_info = empty($GLOBALS[\'ext_info_stack\']) ? array() : $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];
',
    3 => '$GLOBALS[\'ext_info_stack\'][] = array(
\'id\'				=> \'fancy_alerts\',
\'path\'			=> FORUM_ROOT.\'extensions/fancy_alerts\',
\'url\'			=> $GLOBALS[\'base_url\'].\'/extensions/fancy_alerts\',
\'dependencies\'	=> array (
)
);
$ext_info = $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];

if (!isset($lang_fancy_alerts)) {
					if (file_exists($ext_info[\'path\'].\'/lang/\'.$forum_user[\'language\'].\'/\'.$ext_info[\'id\'].\'.php\')) {
						require $ext_info[\'path\'].\'/lang/\'.$forum_user[\'language\'].\'/\'.$ext_info[\'id\'].\'.php\';
					} else {
						require $ext_info[\'path\'].\'/lang/English/\'.$ext_info[\'id\'].\'.php\';
					}
				}

				if ($ext[\'id\'] == \'fancy_alerts\' && !isset($forum_page[\'ext_actions\'][\'fancy_alerts_settings\'])) {
					$forum_page[\'ext_actions\'][\'fancy_alerts_settings\'] = \'<span><a href="\'.forum_link($forum_url[\'admin_settings_features\']).\'#\'.$ext_info[\'id\'].\'_settings\'.\'">\'.$lang_fancy_alerts[\'Go to settings\'].\'</a></span>\';
				}

array_pop($GLOBALS[\'ext_info_stack\']);
$ext_info = empty($GLOBALS[\'ext_info_stack\']) ? array() : $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];
',
    4 => '$GLOBALS[\'ext_info_stack\'][] = array(
\'id\'				=> \'fancy_simtopics\',
\'path\'			=> FORUM_ROOT.\'extensions/fancy_simtopics\',
\'url\'			=> $GLOBALS[\'base_url\'].\'/extensions/fancy_simtopics\',
\'dependencies\'	=> array (
)
);
$ext_info = $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];

if (!isset($lang_fancy_simtopics)) {
				if (file_exists($ext_info[\'path\'].\'/lang/\'.$forum_user[\'language\'].\'/\'.$ext_info[\'id\'].\'.php\')) {
					require $ext_info[\'path\'].\'/lang/\'.$forum_user[\'language\'].\'/\'.$ext_info[\'id\'].\'.php\';
				} else {
					require $ext_info[\'path\'].\'/lang/English/\'.$ext_info[\'id\'].\'.php\';
				}
			}

			if ($ext[\'id\'] == \'fancy_simtopics\' && !isset($forum_page[\'ext_actions\'][\'fancy_simtopics_settings\'])) {
				$forum_page[\'ext_actions\'][\'fancy_simtopics_settings\'] = \'<span><a href="\'.forum_link($forum_url[\'admin_settings_features\']).\'#\'.$ext_info[\'id\'].\'_settings\'.\'">\'.$lang_fancy_simtopics[\'Go to settings\'].\'</a></span>\';
			}

array_pop($GLOBALS[\'ext_info_stack\']);
$ext_info = empty($GLOBALS[\'ext_info_stack\']) ? array() : $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];
',
    5 => '$GLOBALS[\'ext_info_stack\'][] = array(
\'id\'				=> \'fancy_stop_spam\',
\'path\'			=> FORUM_ROOT.\'extensions/fancy_stop_spam\',
\'url\'			=> $GLOBALS[\'base_url\'].\'/extensions/fancy_stop_spam\',
\'dependencies\'	=> array (
)
);
$ext_info = $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];

if ($ext[\'id\'] == \'fancy_stop_spam\' && !isset($forum_page[\'ext_actions\'][\'fancy_stop_spam_settings\'])) {
				$forum_page[\'ext_actions\'][\'fancy_stop_spam_settings\'] = \'
					<span>
						<a href="\'.forum_link($forum_url[\'admin_settings_features\']).\'#\'.$ext_info[\'id\'].\'_settings\'.\'">\'.
							$lang_fancy_stop_spam[\'Go to settings\'].\'
						</a>
					</span>\';
			}

array_pop($GLOBALS[\'ext_info_stack\']);
$ext_info = empty($GLOBALS[\'ext_info_stack\']) ? array() : $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];
',
    6 => '$GLOBALS[\'ext_info_stack\'][] = array(
\'id\'				=> \'fancy_stat_counters\',
\'path\'			=> FORUM_ROOT.\'extensions/fancy_stat_counters\',
\'url\'			=> $GLOBALS[\'base_url\'].\'/extensions/fancy_stat_counters\',
\'dependencies\'	=> array (
)
);
$ext_info = $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];

if (!isset($lang_fancy_stat_counters)) {
				if ($forum_user[\'language\'] != \'English\' && file_exists($ext_info[\'path\'].\'/lang/\'.$forum_user[\'language\'].\'/\'.$ext_info[\'id\'].\'.php\')) {
					include $ext_info[\'path\'].\'/lang/\'.$forum_user[\'language\'].\'/\'.$ext_info[\'id\'].\'.php\';
				} else {
					include $ext_info[\'path\'].\'/lang/English/\'.$ext_info[\'id\'].\'.php\';
				}
			}

			if ($ext[\'id\'] == \'fancy_stat_counters\' && !isset($forum_page[\'ext_actions\'][\'fancy_stat_counters_settings\'])) {
				$forum_page[\'ext_actions\'][\'fancy_stat_counters_settings\'] = \'<span><a href="\'.forum_link($forum_url[\'admin_settings_features\']).\'#\'.$ext_info[\'id\'].\'_settings\'.\'">\'.$lang_fancy_stat_counters[\'Settings\'].\'</a></span>\';
			}

array_pop($GLOBALS[\'ext_info_stack\']);
$ext_info = empty($GLOBALS[\'ext_info_stack\']) ? array() : $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];
',
    7 => '$GLOBALS[\'ext_info_stack\'][] = array(
\'id\'				=> \'last_topic_title_on_forum_index\',
\'path\'			=> FORUM_ROOT.\'extensions/last_topic_title_on_forum_index\',
\'url\'			=> $GLOBALS[\'base_url\'].\'/extensions/last_topic_title_on_forum_index\',
\'dependencies\'	=> array (
)
);
$ext_info = $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];

if (!isset($lang_last_topic_title_on_forum_index)) {
				if ($forum_user[\'language\'] != \'English\' && file_exists($ext_info[\'path\'].\'/lang/\'.$forum_user[\'language\'].\'/\'.$ext_info[\'id\'].\'.php\')) {
					require $ext_info[\'path\'].\'/lang/\'.$forum_user[\'language\'].\'/\'.$ext_info[\'id\'].\'.php\';
				} else {
					require $ext_info[\'path\'].\'/lang/English/\'.$ext_info[\'id\'].\'.php\';
				}
			}

			if ($ext[\'id\'] == \'last_topic_title_on_forum_index\' && !isset($forum_page[\'ext_actions\'][\'sync_forums\'])) {
				$forum_page[\'ext_actions\'][\'sync_forums\'] = \'<span><a href="\'.forum_link($forum_url[\'last_topic_title_sync\'], array(generate_form_token(\'sync_forum_last_title\'.$forum_user[\'id\']))).\'">\'.$lang_last_topic_title_on_forum_index[\'Sync all forums\'].\'</a></span>\';
			}

			if ($ext[\'id\'] == \'last_topic_title_on_forum_index\' && !isset($forum_page[\'ext_actions\'][\'last_topic_title_on_forum_index_settings\'])) {
				$forum_page[\'ext_actions\'][\'last_topic_title_on_forum_index_settings\'] = \'<span><a href="\'.forum_link($forum_url[\'admin_settings_features\']).\'#\'.$ext_info[\'id\'].\'_settings\'.\'">\'.$lang_last_topic_title_on_forum_index[\'Go to settings\'].\'</a></span>\';
			}

array_pop($GLOBALS[\'ext_info_stack\']);
$ext_info = empty($GLOBALS[\'ext_info_stack\']) ? array() : $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];
',
  ),
  'aex_new_action' => 
  array (
    0 => '$GLOBALS[\'ext_info_stack\'][] = array(
\'id\'				=> \'pun_repository\',
\'path\'			=> FORUM_ROOT.\'extensions/pun_repository\',
\'url\'			=> $GLOBALS[\'base_url\'].\'/extensions/pun_repository\',
\'dependencies\'	=> array (
)
);
$ext_info = $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];

// Clear pun_repository cache
if (isset($_GET[\'pun_repository_update\']))
{
	// Validate CSRF token
	if (!isset($_POST[\'csrf_token\']) && (!isset($_GET[\'csrf_token\']) || $_GET[\'csrf_token\'] !== generate_form_token(\'pun_repository_update\')))
		csrf_confirm_form();

	if (file_exists($ext_info[\'path\'].\'/lang/\'.$forum_user[\'language\'].\'/pun_repository.php\'))
		include $ext_info[\'path\'].\'/lang/\'.$forum_user[\'language\'].\'/pun_repository.php\';
	else
		include $ext_info[\'path\'].\'/lang/English/pun_repository.php\';

	@unlink(FORUM_CACHE_DIR.\'cache_pun_repository.php\');
	if (file_exists(FORUM_CACHE_DIR.\'cache_pun_repository.php\'))
		message($lang_pun_repository[\'Unable to remove cached file\'], \'\', $lang_pun_repository[\'PunBB Repository\']);

	redirect($base_url.\'/admin/extensions.php?section=manage\', $lang_pun_repository[\'Cache has been successfully cleared\']);
}

if (isset($_GET[\'pun_repository_download_and_install\']))
{
	$ext_id = preg_replace(\'/[^0-9a-z_]/\', \'\', $_GET[\'pun_repository_download_and_install\']);

	// Validate CSRF token
	if (!isset($_POST[\'csrf_token\']) && (!isset($_GET[\'csrf_token\']) || $_GET[\'csrf_token\'] !== generate_form_token(\'pun_repository_download_and_install_\'.$ext_id)))
		csrf_confirm_form();

	// TODO: Should we check again for unresolved dependencies here?

	if (file_exists($ext_info[\'path\'].\'/lang/\'.$forum_user[\'language\'].\'/pun_repository.php\'))
		include $ext_info[\'path\'].\'/lang/\'.$forum_user[\'language\'].\'/pun_repository.php\';
	else
		include $ext_info[\'path\'].\'/lang/English/pun_repository.php\';

	require_once $ext_info[\'path\'].\'/pun_repository.php\';

	($hook = get_hook(\'pun_repository_download_and_install_start\')) ? eval($hook) : null;

	// Download extension
	$pun_repository_error = pun_repository_download_extension($ext_id, $ext_data);

	if ($pun_repository_error == \'\')
	{
		if (empty($ext_data))
			redirect($base_url.\'/admin/extensions.php?section=manage\', $lang_pun_repository[\'Incorrect manifest.xml\']);

		// Validate manifest
		$errors = validate_manifest($ext_data, $ext_id);
		if (!empty($errors))
			redirect($base_url.\'/admin/extensions.php?section=manage\', $lang_pun_repository[\'Incorrect manifest.xml\']);

		// Everything is OK. Start installation.
		redirect($base_url.\'/admin/extensions.php?install=\'.urlencode($ext_id), $lang_pun_repository[\'Download successful\']);
	}

	($hook = get_hook(\'pun_repository_download_and_install_end\')) ? eval($hook) : null;
}

// Handling the download and update extension action
if (isset($_GET[\'pun_repository_download_and_update\']))
{
	$ext_id = preg_replace(\'/[^0-9a-z_]/\', \'\', $_GET[\'pun_repository_download_and_update\']);

	// Validate CSRF token
	if (!isset($_POST[\'csrf_token\']) && (!isset($_GET[\'csrf_token\']) || $_GET[\'csrf_token\'] !== generate_form_token(\'pun_repository_download_and_update_\'.$ext_id)))
		csrf_confirm_form();

	if (file_exists($ext_info[\'path\'].\'/lang/\'.$forum_user[\'language\'].\'/pun_repository.php\'))
		include $ext_info[\'path\'].\'/lang/\'.$forum_user[\'language\'].\'/pun_repository.php\';
	else
		include $ext_info[\'path\'].\'/lang/English/pun_repository.php\';

	require_once $ext_info[\'path\'].\'/pun_repository.php\';

	$pun_repository_error = \'\';

	($hook = get_hook(\'pun_repository_download_and_update_start\')) ? eval($hook) : null;

	pun_repository_rm_recursive(FORUM_ROOT.\'extensions/\'.$ext_id.\'.old\');

	// Check dependancies
	$query = array(
		\'SELECT\'	=> \'e.id\',
		\'FROM\'		=> \'extensions AS e\',
		\'WHERE\'		=> \'e.disabled=0 AND e.dependencies LIKE \\\'%|\'.$forum_db->escape($ext_id).\'|%\\\'\'
	);

	($hook = get_hook(\'aex_qr_get_disable_dependencies\')) ? eval($hook) : null;
	$result = $forum_db->query_build($query) or error(__FILE__, __LINE__);

	if ($forum_db->num_rows($result) != 0)
	{
		$dependency = $forum_db->fetch_assoc($result);
		$pun_repository_error = sprintf($lang_admin[\'Disable dependency\'], $dependency[\'id\']);
	}

	if ($pun_repository_error == \'\' && ($ext_id != $ext_info[\'id\']))
	{
		// Disable extension
		$query = array(
			\'UPDATE\'	=> \'extensions\',
			\'SET\'		=> \'disabled=1\',
			\'WHERE\'		=> \'id=\\\'\'.$forum_db->escape($ext_id).\'\\\'\'
		);

		($hook = get_hook(\'aex_qr_update_disabled_status\')) ? eval($hook) : null;
		$forum_db->query_build($query) or error(__FILE__, __LINE__);

		// Regenerate the hooks cache
		require_once FORUM_ROOT.\'include/cache.php\';
		generate_hooks_cache();
	}

	if ($pun_repository_error == \'\')
	{
		if ($ext_id == $ext_info[\'id\'])
		{
			// Hey! That\'s me!
			// All the necessary files should be included before renaming old directory
			// NOTE: Self-updating is to be tested more in real-life conditions
			if (!defined(\'PUN_REPOSITORY_TAR_EXTRACT_INCLUDED\'))
				require $ext_info[\'path\'].\'/pun_repository_tar_extract.php\';
		}

		$pun_repository_error = pun_repository_download_extension($ext_id, $ext_data, FORUM_ROOT.\'extensions/\'.$ext_id.\'.new\'); // Download the extension

		if ($pun_repository_error == \'\')
		{
			if (is_writable(FORUM_ROOT.\'extensions/\'.$ext_id))
				pun_repository_dir_copy(FORUM_ROOT.\'extensions/\'.$ext_id.\'.new/\'.$ext_id, FORUM_ROOT.\'extensions/\'.$ext_id);
			else
				$pun_repository_error = sprintf($lang_pun_repository[\'Copy fail\'], FORUM_ROOT.\'extensions/\'.$ext_id);
		}
	}

	if ($pun_repository_error == \'\')
	{
		// Do we have extension data at all? :-)
		if (empty($ext_data))
			$errors = array(true);

		// Validate manifest
		if (empty($errors))
			$errors = validate_manifest($ext_data, $ext_id);

		if (!empty($errors))
			$pun_repository_error = $lang_pun_repository[\'Incorrect manifest.xml\'];
	}

	if ($pun_repository_error == \'\')
	{
		($hook = get_hook(\'pun_repository_download_and_update_ok\')) ? eval($hook) : null;

		// Everything is OK. Start installation.
		pun_repository_rm_recursive(FORUM_ROOT.\'extensions/\'.$ext_id.\'.new\');
		redirect($base_url.\'/admin/extensions.php?install=\'.urlencode($ext_id), $lang_pun_repository[\'Download successful\']);
	}

	($hook = get_hook(\'pun_repository_download_and_update_error\')) ? eval($hook) : null;

	// Enable extension
	$query = array(
		\'UPDATE\'	=> \'extensions\',
		\'SET\'		=> \'disabled=0\',
		\'WHERE\'		=> \'id=\\\'\'.$forum_db->escape($ext_id).\'\\\'\'
	);

	($hook = get_hook(\'aex_qr_update_enabled_status\')) ? eval($hook) : null;
	$forum_db->query_build($query) or error(__FILE__, __LINE__);

	// Regenerate the hooks cache
	require_once FORUM_ROOT.\'include/cache.php\';
	generate_hooks_cache();

	($hook = get_hook(\'pun_repository_download_and_update_end\')) ? eval($hook) : null;
}

// Do we have some error?
if (!empty($pun_repository_error))
{
	// Setup breadcrumbs
	$forum_page[\'crumbs\'] = array(
		array($forum_config[\'o_board_title\'], forum_link($forum_url[\'index\'])),
		array($lang_admin_common[\'Forum administration\'], forum_link($forum_url[\'admin_index\'])),
		array($lang_admin_common[\'Extensions\'], forum_link($forum_url[\'admin_extensions_manage\'])),
		array($lang_admin_common[\'Manage extensions\'], forum_link($forum_url[\'admin_extensions_manage\'])),
		$lang_pun_repository[\'PunBB Repository\']
	);

	($hook = get_hook(\'pun_repository__pre_header_load\')) ? eval($hook) : null;

	define(\'FORUM_PAGE_SECTION\', \'extensions\');
	define(\'FORUM_PAGE\', \'admin-extensions-pun-repository\');
	require FORUM_ROOT.\'header.php\';

	// START SUBST - <!-- forum_main -->
	ob_start();

	($hook = get_hook(\'pun_repository_display_error_output_start\')) ? eval($hook) : null;

?>
	<div class="main-subhead">
		<h2 class="hn"><span><?php echo $lang_pun_repository[\'PunBB Repository\'] ?></span></h2>
	</div>
	<div class="main-content">
		<div class="ct-box warn-box">
			<p class="warn"><?php echo $pun_repository_error ?></p>
		</div>
	</div>
<?php

	($hook = get_hook(\'pun_repository_display_error_pre_ob_end\')) ? eval($hook) : null;

	$tpl_temp = trim(ob_get_contents());
	$tpl_main = str_replace(\'<!-- forum_main -->\', $tpl_temp, $tpl_main);
	ob_end_clean();
	// END SUBST - <!-- forum_main -->

	require FORUM_ROOT.\'footer.php\';
}

array_pop($GLOBALS[\'ext_info_stack\']);
$ext_info = empty($GLOBALS[\'ext_info_stack\']) ? array() : $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];
',
    1 => '$GLOBALS[\'ext_info_stack\'][] = array(
\'id\'				=> \'pun_tags\',
\'path\'			=> FORUM_ROOT.\'extensions/pun_tags\',
\'url\'			=> $GLOBALS[\'base_url\'].\'/extensions/pun_tags\',
\'dependencies\'	=> array (
)
);
$ext_info = $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];

if ($section == \'manage_tags\')
			{
				//Get some info about topics with tags
				$topic_info = array();
				if (!empty($pun_tags[\'topics\']))
				{
					$pun_tags_query = array(
						\'SELECT\'	=>	\'id, subject\',
						\'FROM\'		=>	\'topics\',
						\'WHERE\'		=>	\'id IN (\'.implode(\',\', array_keys($pun_tags[\'topics\'])).\')\'
					);
					$pun_tags_result = $forum_db->query_build($pun_tags_query) or error(__FILE__, __LINE__);
					while ($cur_topic = $forum_db->fetch_assoc($pun_tags_result))
						$topic_info[$cur_topic[\'id\']] = $cur_topic[\'subject\'];
				}

				if (file_exists($ext_info[\'path\'].\'/lang/\'.$forum_user[\'language\'].\'/\'.$ext_info[\'id\'].\'.php\'))
					require $ext_info[\'path\'].\'/lang/\'.$forum_user[\'language\'].\'/\'.$ext_info[\'id\'].\'.php\';
				else
					require $ext_info[\'path\'].\'/lang/English/\'.$ext_info[\'id\'].\'.php\';
				require $ext_info[\'path\'].\'/pun_tags_url.php\';

				if (isset($_POST[\'change_tags\']) && !empty($_POST[\'line_tags\']) && !empty($pun_tags[\'topics\']))
				{
					foreach ($_POST[\'line_tags\'] as $topic_id => $tag_line)
					{
						if (intval($topic_id) < 1)
							break;
						$cur_tags_new = pun_tags_parse_string(utf8_trim($tag_line));

						//All tags was removed?
						if (empty($cur_tags_new))
						{
							$pun_tags_query = array(
								\'DELETE\'	=>	\'topic_tags\',
								\'WHERE\'		=>	\'topic_id = \'.$topic_id
							);
							$forum_db->query_build($pun_tags_query) or error(__FILE__, __LINE__);
							continue;
						}

						//Collect old tags
						$cur_tags_old = array();
						if (!empty($pun_tags[\'topics\'][$topic_id]))
						{
							foreach ($pun_tags[\'topics\'][$topic_id] as $old_tag_id)
								$cur_tags_old[$old_tag_id] = $pun_tags[\'index\'][$old_tag_id];
						}
						//Nothing changed
						if (implode(\', \', $cur_tags_new) == implode(\', \', array_values($cur_tags_old)))
							continue;
						//This array contain indexes of processed new tags
						$processed_tags = array();
						//The array with tags for removal
						$remove_tags_id = array();
						foreach ($cur_tags_old as $tag_old_id => $tag_old)
						{
							$srch_index = array_search($tag_old, $cur_tags_new);
							//Tag was not changed
							if ($srch_index !== FALSE)
							{
								$processed_tags[] = $srch_index;
								continue;
							}

							//Was tag edited?
							$not_found_edited = TRUE;
							foreach ($cur_tags_new as $cur_tag_new)
							{
								if (strcasecmp($cur_tag_new, $tag_old) == 0)
								{
									$not_found_edited = FALSE;
									$edited_tag_id = $tag_old_id;
									$edited_tag = $cur_tag_new;
									break;
								}
							}

							//Tag removed?
							if ($not_found_edited)
							{
								$remove_tags_id[] = $tag_old_id;
								$processed_tags[] = $tag_old_id;
							}
							else
							{
								//Is this tag already persist in the tag list?
								$edited_tag_id_new = tag_cache_index($edited_tag);
								if ($edited_tag_id_new !== FALSE)
								{
									$pun_tags_query = array(
										\'UPDATE\'	=>	\'topic_tags\',
										\'SET\'		=>	\'tag_id = \'.$edited_tag_id_new,
										\'WHERE\'		=>	\'topic_id = \'.$topic_id.\' AND tag_id = \'.$edited_tag_id
									);
									$forum_db->query_build($pun_tags_query) or error(__FILE__, __LINE__);
								}
								else
									pun_tags_add_new($edited_tag, $topic_id);

								$remove_tags_id[] = $tag_old_id;
								$processed_tags[] = $tag_old_id;
							}
						}

						//Is there some new tags
						if (count($processed_tags) != count($cur_tags_new))
						{
							foreach ($cur_tags_new as $cur_new_tag_id => $cur_new_tag)
							{
								if (in_array($cur_new_tag_id, $processed_tags))
									continue;
								$tag_exist_index = tag_cache_index($cur_new_tag);
								if ($tag_exist_index === FALSE)
									pun_tags_add_new($cur_new_tag, $topic_id);
								else
									pun_tags_add_existing_tag($tag_exist_index, $topic_id);
							}
						}

						if (!empty($remove_tags_id))
						{
							$pun_tags_query = array(
								\'DELETE\'	=>	\'topic_tags\',
								\'WHERE\'		=>	\'topic_id = \'.$topic_id.\' AND tag_id IN (\'.implode(\',\', $remove_tags_id).\')\'
							);
							$forum_db->query_build($pun_tags_query) or error(__FILE__, __LINE__);
						}
					}
					pun_tags_remove_orphans();
					pun_tags_generate_cache();

					$forum_flash->add_info($lang_pun_tags[\'Redirect with changes\']);

					redirect(forum_link($pun_tags_url[\'Section pun_tags\']), $lang_pun_tags[\'Redirect with changes\']);
				}

				$forum_page[\'form_action\'] = forum_link($pun_tags_url[\'Section tags\']);
				$forum_page[\'item_count\'] = 1;

				$forum_page[\'table_header\'] = array();
				$forum_page[\'table_header\'][\'name\'] = \'<th class="tc1" scope="col">\'.$lang_pun_tags[\'Name topic\'].\'</th>\';
				$forum_page[\'table_header\'][\'tags\'] = \'<th class="tc2" scope="col">\'.$lang_pun_tags[\'Tags of topic\'].\'</th>\';

				// Setup breadcrumbs
				$forum_page[\'crumbs\'] = array(
					array($forum_config[\'o_board_title\'], forum_link($forum_url[\'index\'])),
					array($lang_admin_common[\'Forum administration\'], forum_link($forum_url[\'admin_index\'])),
					array($lang_admin_common[\'Management\'], forum_link($forum_url[\'admin_reports\'])),
					array($lang_pun_tags[\'Section tags\'], forum_link($pun_tags_url[\'Section tags\']))
				);

				define(\'FORUM_PAGE_SECTION\', \'management\');
				define(\'FORUM_PAGE\', \'admin-management-manage_tags\');
				require FORUM_ROOT.\'header.php\';

				ob_start();

				if (!empty($topic_info))
				{
					// Load the userlist.php language file
					if (file_exists(FORUM_ROOT.\'lang/\'.$forum_user[\'language\'].\'/userlist.php\'))
						require FORUM_ROOT.\'lang/\'.$forum_user[\'language\'].\'/userlist.php\';
					else
						require FORUM_ROOT.\'lang/English/userlist.php\';

					?>
					<div class="main-subhead">
						<h2 class="hn">
							<span><?php echo $lang_pun_tags[\'Section tags\']; ?></span>
						</h2>
					</div>
					<div class="main-content main-forum">
						<form class="frm-form" id="afocus" method="post" accept-charset="utf-8" action="<?php echo $forum_page[\'form_action\'] ?>">
							<div class="hidden">
								<input type="hidden" name="form_sent" value="1" />
								<input type="hidden" name="csrf_token" value="<?php echo generate_form_token($forum_page[\'form_action\']) ?>" />
							</div>
							<div class="ct-group">
								<table id="pun_tags_table" summary="<?php echo $lang_ul[\'Table summary\'] ?>">
									<thead>
										<tr><?php echo implode("\\n\\t\\t\\t\\t\\t\\t", $forum_page[\'table_header\'])."\\n" ?></tr>
									</thead>
									<tbody>
									<?php
										foreach ($topic_info as $topic_id => $topic_subject)
										{
											$tags_arr = $pun_tags[\'topics\'][$topic_id];
											$cur_tags_arr = array();
											foreach ($tags_arr as $tag_id)
												$cur_tags_arr[] = $pun_tags[\'index\'][$tag_id];

											?>
												<tr class="<?php echo ($forum_page[\'item_count\'] % 2 != 0) ? \'odd\' : \'even\' ?><?php echo ($forum_page[\'item_count\'] == 1) ? \' row1\' : \'\' ?>">
													<td class="tc0" scope="col"><a class="permalink" rel="bookmark" href="<?php echo forum_link($forum_url[\'topic\'], $topic_id) ?>"><?php echo forum_htmlencode($topic_subject) ?></a></td>
													<td class="tc1" scope="col"><input id="fld<?php echo $forum_page[\'item_count\']; ?>" type="text" value="<?php echo forum_htmlencode(implode(\', \', $cur_tags_arr)) ?>" name="line_tags[<?php echo $topic_id; ?>]"/></td>
												</tr>
											<?php
										}
									?>
									</tbody>
								</table>
							</div>
							<div class="frm-buttons">
								<span class="submit"><input type="submit" name="change_tags" value="<?php echo $lang_pun_tags[\'Submit changes\'] ?>" /></span>
							</div>
						</form>
					</div>
					<?php
				}
				else
				{
					?>
						<div class="main-subhead">
							<h2 class="hn">
								<span><?php echo $lang_pun_tags[\'Section tags\']; ?></span>
							</h2>
						</div>
						<div class="main-content main-forum">
							<div class="ct-box">
								<h3 class="hn"><span><?php echo $lang_pun_tags[\'No tags\']; ?></span></h3>
							</div>
						</div>

					<?php
				}

				$tpl_pun_tags = trim(ob_get_contents());
				$tpl_main = str_replace(\'<!-- forum_main -->\', $tpl_pun_tags, $tpl_main);
				ob_end_clean();

				require FORUM_ROOT.\'footer.php\';
			}

array_pop($GLOBALS[\'ext_info_stack\']);
$ext_info = empty($GLOBALS[\'ext_info_stack\']) ? array() : $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];
',
  ),
  'aex_section_manage_end' => 
  array (
    0 => '$GLOBALS[\'ext_info_stack\'][] = array(
\'id\'				=> \'pun_repository\',
\'path\'			=> FORUM_ROOT.\'extensions/pun_repository\',
\'url\'			=> $GLOBALS[\'base_url\'].\'/extensions/pun_repository\',
\'dependencies\'	=> array (
)
);
$ext_info = $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];

if (file_exists($ext_info[\'path\'].\'/lang/\'.$forum_user[\'language\'].\'/pun_repository.php\'))
	include $ext_info[\'path\'].\'/lang/\'.$forum_user[\'language\'].\'/pun_repository.php\';
else
	include $ext_info[\'path\'].\'/lang/English/pun_repository.php\';

require_once $ext_info[\'path\'].\'/pun_repository.php\';

($hook = get_hook(\'pun_repository_pre_display_ext_list\')) ? eval($hook) : null;

?>
	<div class="main-subhead">
		<h2 class="hn"><span><?php echo $lang_pun_repository[\'PunBB Repository\'] ?></span></h2>
	</div>
	<div class="main-content main-extensions">
		<p class="content-options options"><a href="<?php echo $base_url ?>/admin/extensions.php?pun_repository_update&amp;csrf_token=<?php echo generate_form_token(\'pun_repository_update\') ?>"><?php echo $lang_pun_repository[\'Clear cache\'] ?></a></p>
<?php

if (!defined(\'PUN_REPOSITORY_EXTENSIONS_LOADED\') && file_exists(FORUM_CACHE_DIR.\'cache_pun_repository.php\'))
	include FORUM_CACHE_DIR.\'cache_pun_repository.php\';

if (!defined(\'FORUM_EXT_VERSIONS_LOADED\') && file_exists(FORUM_CACHE_DIR.\'cache_ext_version_notifications.php\'))
	include FORUM_CACHE_DIR.\'cache_ext_version_notifications.php\';

// Regenerate cache only if automatic updates are enabled and if the cache is more than 12 hours old
if (!defined(\'PUN_REPOSITORY_EXTENSIONS_LOADED\') || !defined(\'FORUM_EXT_VERSIONS_LOADED\') || ($pun_repository_extensions_timestamp < $forum_ext_versions_update_cache))
{
	$pun_repository_error = \'\';

	if (pun_repository_generate_cache($pun_repository_error))
	{
		require FORUM_CACHE_DIR.\'cache_pun_repository.php\';
	}
	else
	{

		?>
		<div class="ct-box warn-box">
			<p class="warn"><?php echo $pun_repository_error ?></p>
		</div>
		<?php

		// Stop processing hook
		return;
	}
}

$pun_repository_parsed = array();
$pun_repository_skipped = array();

// Display information about extensions in repository
foreach ($pun_repository_extensions as $pun_repository_ext)
{
	// Skip installed extensions
	if (isset($inst_exts[$pun_repository_ext[\'id\']]))
	{
		$pun_repository_skipped[\'installed\'][] = $pun_repository_ext[\'id\'];
		continue;
	}

	// Skip uploaded extensions (including incorrect ones)
	if (is_dir(FORUM_ROOT.\'extensions/\'.$pun_repository_ext[\'id\']))
	{
		$pun_repository_skipped[\'has_dir\'][] = $pun_repository_ext[\'id\'];
		continue;
	}

	// Check for unresolved dependencies
	if (isset($pun_repository_ext[\'dependencies\']))
		$pun_repository_ext[\'dependencies\'] = pun_repository_check_dependencies($inst_exts, $pun_repository_ext[\'dependencies\']);

	if (empty($pun_repository_ext[\'dependencies\'][\'unresolved\']))
	{
		// \'Download and install\' link
		$pun_repository_ext[\'options\'] = array(\'<a href="\'.$base_url.\'/admin/extensions.php?pun_repository_download_and_install=\'.$pun_repository_ext[\'id\'].\'&amp;csrf_token=\'.generate_form_token(\'pun_repository_download_and_install_\'.$pun_repository_ext[\'id\']).\'">\'.$lang_pun_repository[\'Download and install\'].\'</a>\');
	}
	else
		$pun_repository_ext[\'options\'] = array();

	$pun_repository_parsed[] = $pun_repository_ext[\'id\'];

	// Direct links to archives
	$pun_repository_ext[\'download_links\'] = array();
	foreach (array(\'zip\', \'tgz\', \'7z\') as $pun_repository_archive_type)
		$pun_repository_ext[\'download_links\'][] = \'<a href="\'.PUN_REPOSITORY_URL.\'/\'.$pun_repository_ext[\'id\'].\'/\'.$pun_repository_ext[\'id\'].\'.\'.$pun_repository_archive_type.\'">\'.$pun_repository_archive_type.\'</a>\';

	($hook = get_hook(\'pun_repository_pre_display_ext_info\')) ? eval($hook) : null;

	// Let\'s ptint it all out
?>
		<div class="ct-box info-box extension available" id="<?php echo $pun_repository_ext[\'id\'] ?>">
			<h3 class="ct-legend hn"><span><?php echo forum_htmlencode($pun_repository_ext[\'title\']).\' \'.$pun_repository_ext[\'version\'] ?></span></h3>
			<p><?php echo forum_htmlencode($pun_repository_ext[\'description\']) ?></p>
<?php

	// List extension dependencies
	if (!empty($pun_repository_ext[\'dependencies\'][\'dependency\']))
		echo \'
			<p>\', $lang_pun_repository[\'Dependencies:\'], \' \', implode(\', \', $pun_repository_ext[\'dependencies\'][\'dependency\']), \'</p>\';

?>
			<p><?php echo $lang_pun_repository[\'Direct download links:\'], \' \', implode(\' \', $pun_repository_ext[\'download_links\']) ?></p>
<?php

	// List unresolved dependencies
	if (!empty($pun_repository_ext[\'dependencies\'][\'unresolved\']))
		echo \'
			<div class="ct-box warn-box">
				<p class="warn">\', $lang_pun_repository[\'Resolve dependencies:\'], \' \', implode(\', \', array_map(create_function(\'$dep\', \'return \\\'<a href="#\\\'.$dep.\\\'">\\\'.$dep.\\\'</a>\\\';\'), $pun_repository_ext[\'dependencies\'][\'unresolved\'])), \'</p>
			</div>\';

	// Actions
	if (!empty($pun_repository_ext[\'options\']))
		echo \'
			<p class="options">\', implode(\' \', $pun_repository_ext[\'options\']), \'</p>\';

?>
		</div>
<?php

}

?>
		<div class="ct-box warn-box">
			<p class="warn"><?php echo $lang_pun_repository[\'Files mode and owner\'] ?></p>
		</div>
<?php

if (empty($pun_repository_parsed) && (count($pun_repository_skipped[\'installed\']) > 0 || count($pun_repository_skipped[\'has_dir\']) > 0))
{
	($hook = get_hook(\'pun_repository_no_extensions\')) ? eval($hook) : null;

	?>
		<div class="ct-box info-box">
			<p class="warn"><?php echo $lang_pun_repository[\'All installed or downloaded\'] ?></p>
		</div>
	<?php

}

($hook = get_hook(\'pun_repository_after_ext_list\')) ? eval($hook) : null;

?>
	</div>
<?php

array_pop($GLOBALS[\'ext_info_stack\']);
$ext_info = empty($GLOBALS[\'ext_info_stack\']) ? array() : $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];
',
  ),
  'fn_set_default_user_qr_get_default_user' => 
  array (
    0 => '$GLOBALS[\'ext_info_stack\'][] = array(
\'id\'				=> \'pun_stop_bots\',
\'path\'			=> FORUM_ROOT.\'extensions/pun_stop_bots\',
\'url\'			=> $GLOBALS[\'base_url\'].\'/extensions/pun_stop_bots\',
\'dependencies\'	=> array (
)
);
$ext_info = $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];

$query[\'SELECT\'] .= \', o.ident\';

array_pop($GLOBALS[\'ext_info_stack\']);
$ext_info = empty($GLOBALS[\'ext_info_stack\']) ? array() : $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];
',
  ),
  'agr_del_group_pre_redirect' => 
  array (
    0 => '$GLOBALS[\'ext_info_stack\'][] = array(
\'id\'				=> \'pun_tags\',
\'path\'			=> FORUM_ROOT.\'extensions/pun_tags\',
\'url\'			=> $GLOBALS[\'base_url\'].\'/extensions/pun_tags\',
\'dependencies\'	=> array (
)
);
$ext_info = $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];

require_once $ext_info[\'path\'].\'/functions.php\';
			pun_tags_generate_forum_perms_cache();

array_pop($GLOBALS[\'ext_info_stack\']);
$ext_info = empty($GLOBALS[\'ext_info_stack\']) ? array() : $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];
',
  ),
  'afo_save_forum_pre_redirect' => 
  array (
    0 => '$GLOBALS[\'ext_info_stack\'][] = array(
\'id\'				=> \'pun_tags\',
\'path\'			=> FORUM_ROOT.\'extensions/pun_tags\',
\'url\'			=> $GLOBALS[\'base_url\'].\'/extensions/pun_tags\',
\'dependencies\'	=> array (
)
);
$ext_info = $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];

require_once $ext_info[\'path\'].\'/functions.php\';
			pun_tags_generate_forum_perms_cache();

array_pop($GLOBALS[\'ext_info_stack\']);
$ext_info = empty($GLOBALS[\'ext_info_stack\']) ? array() : $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];
',
  ),
  'afo_revert_perms_form_submitted' => 
  array (
    0 => '$GLOBALS[\'ext_info_stack\'][] = array(
\'id\'				=> \'pun_tags\',
\'path\'			=> FORUM_ROOT.\'extensions/pun_tags\',
\'url\'			=> $GLOBALS[\'base_url\'].\'/extensions/pun_tags\',
\'dependencies\'	=> array (
)
);
$ext_info = $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];

require_once $ext_info[\'path\'].\'/functions.php\';
			pun_tags_generate_forum_perms_cache();

array_pop($GLOBALS[\'ext_info_stack\']);
$ext_info = empty($GLOBALS[\'ext_info_stack\']) ? array() : $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];
',
  ),
  'ft_end' => 
  array (
    0 => '$GLOBALS[\'ext_info_stack\'][] = array(
\'id\'				=> \'pun_tags\',
\'path\'			=> FORUM_ROOT.\'extensions/pun_tags\',
\'url\'			=> $GLOBALS[\'base_url\'].\'/extensions/pun_tags\',
\'dependencies\'	=> array (
)
);
$ext_info = $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];

if ($forum_config[\'o_pun_tags_show\'] == 1)
			{
				if (!empty($ouput_results))
					$tpl_main = str_replace(\'<div id="brd-pun_tags"></div>\', \'<div id="brd-pun_tags"><ul>\'.implode($forum_config[\'o_pun_tags_separator\'], $ouput_results).\'</ul></div>\', $tpl_main);
				else
					$tpl_main = str_replace(\'<div id="brd-pun_tags"></div>\', \'\', $tpl_main);
			}

array_pop($GLOBALS[\'ext_info_stack\']);
$ext_info = empty($GLOBALS[\'ext_info_stack\']) ? array() : $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];
',
  ),
  'sf_fn_validate_actions_start' => 
  array (
    0 => '$GLOBALS[\'ext_info_stack\'][] = array(
\'id\'				=> \'pun_tags\',
\'path\'			=> FORUM_ROOT.\'extensions/pun_tags\',
\'url\'			=> $GLOBALS[\'base_url\'].\'/extensions/pun_tags\',
\'dependencies\'	=> array (
)
);
$ext_info = $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];

$valid_actions[] = \'tag\';

array_pop($GLOBALS[\'ext_info_stack\']);
$ext_info = empty($GLOBALS[\'ext_info_stack\']) ? array() : $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];
',
    1 => '$GLOBALS[\'ext_info_stack\'][] = array(
\'id\'				=> \'fancy_alerts\',
\'path\'			=> FORUM_ROOT.\'extensions/fancy_alerts\',
\'url\'			=> $GLOBALS[\'base_url\'].\'/extensions/fancy_alerts\',
\'dependencies\'	=> array (
)
);
$ext_info = $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];

$valid_actions[] = \'fancy_alerts_topics_show\';
				$valid_actions[] = \'fancy_alerts_quotes_show\';
				$valid_actions[] = \'show_fancy_alerts_my_topics\';

array_pop($GLOBALS[\'ext_info_stack\']);
$ext_info = empty($GLOBALS[\'ext_info_stack\']) ? array() : $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];
',
  ),
  'sf_fn_generate_action_search_query_end' => 
  array (
    0 => '$GLOBALS[\'ext_info_stack\'][] = array(
\'id\'				=> \'pun_tags\',
\'path\'			=> FORUM_ROOT.\'extensions/pun_tags\',
\'url\'			=> $GLOBALS[\'base_url\'].\'/extensions/pun_tags\',
\'dependencies\'	=> array (
)
);
$ext_info = $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];

if ($action == \'tag\')
			{
				$tag_id = isset($_GET[\'tag_id\']) ? intval($_GET[\'tag_id\']) : 0;
				if ($tag_id < 1)
					message($lang_common[\'Bad request\']);
				global $pun_tags;
				if (isset($pun_tags[\'topics\']))
				{
					foreach ($pun_tags[\'topics\'] as $topic_id => $tags)
						if (in_array($tag_id, $tags))
							$search_ids[] = $topic_id;
					if (empty($search_ids))
						message($lang_common[\'Bad request\']);
				}
				$query = array(
					\'SELECT\'	=> \'t.id AS tid, t.poster, t.subject, t.first_post_id, t.posted, t.last_post, t.last_post_id, t.last_poster, t.num_replies, t.closed, t.sticky, t.forum_id, f.forum_name\',
					\'FROM\'		=> \'topics AS t\',
					\'JOINS\'		=> array(
						array(
							\'INNER JOIN\'	=> \'forums AS f\',
							\'ON\'			=> \'f.id=t.forum_id\'
						),
						array(
							\'LEFT JOIN\'		=> \'forum_perms AS fp\',
							\'ON\'			=> \'(fp.forum_id=f.id AND fp.group_id=\'.$forum_user[\'g_id\'].\')\'
						)
					),
					\'WHERE\'		=> \'(fp.read_forum IS NULL OR fp.read_forum=1) AND t.id IN(\'.implode(\',\', $search_ids).\')\',
					\'ORDER BY\'	=> \'t.last_post DESC\'
				);
				// With "has posted" indication
				if (!$forum_user[\'is_guest\'] && $forum_config[\'o_show_dot\'] == \'1\')
				{
					$subquery = array(
						\'SELECT\'	=> \'COUNT(p.id)\',
						\'FROM\'		=> \'posts AS p\',
						\'WHERE\'		=> \'p.poster_id=\'.$forum_user[\'id\'].\' AND p.topic_id=t.id\'
					);

					$query[\'SELECT\'] .= \', (\'.$forum_db->query_build($subquery, true).\') AS has_posted\';
				}
			}

array_pop($GLOBALS[\'ext_info_stack\']);
$ext_info = empty($GLOBALS[\'ext_info_stack\']) ? array() : $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];
',
    1 => '$GLOBALS[\'ext_info_stack\'][] = array(
\'id\'				=> \'fancy_alerts\',
\'path\'			=> FORUM_ROOT.\'extensions/fancy_alerts\',
\'url\'			=> $GLOBALS[\'base_url\'].\'/extensions/fancy_alerts\',
\'dependencies\'	=> array (
)
);
$ext_info = $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];

// ALERTED TOPICS
				if ($action == \'fancy_alerts_topics_show\')	{
					if ($forum_user[\'is_guest\']) {
						message($lang_common[\'Bad request\']);
					}

					// Check we\'re allowed to see the subscriptions we\'re trying to look at
					if ($forum_user[\'g_id\'] != FORUM_ADMIN && $forum_user[\'id\'] != $value) {
						message($lang_common[\'Bad request\']);
					}

					$fancy_alerts_now = time();

					$query = array(
						\'SELECT\'	=> \'t.id AS tid, t.poster, t.subject, t.first_post_id, t.posted, t.last_post, t.last_post_id, t.last_poster, t.num_replies, t.closed, t.sticky, t.forum_id, f.forum_name\',
						\'FROM\'		=> \'topics AS t\',
						\'JOINS\'		=> array(
							array(
								\'INNER JOIN\'	=> \'fancy_alerts_topics AS fat\',
								\'ON\'			=> \'(t.id=fat.topic_id AND fat.user_id=\'.$value.\')\'
							),
							array(
								\'INNER JOIN\'	=> \'forums AS f\',
								\'ON\'			=> \'f.id=t.forum_id\'
							),
							array(
								\'LEFT JOIN\'		=> \'forum_perms AS fp\',
								\'ON\'			=> \'(fp.forum_id=f.id AND fp.group_id=\'.$forum_user[\'g_id\'].\')\'
							)
						),
						\'WHERE\'		=> \'(fp.read_forum IS NULL OR fp.read_forum=1) AND fat.last_post_time > fat.last_user_view AND fat.last_post_id!=0\',
						\'ORDER BY\'	=> \'t.last_post DESC\'
					);

					// With "has posted" indication
					if (!$forum_user[\'is_guest\'] && $forum_config[\'o_show_dot\'] == \'1\') {
						$query[\'SELECT\'] .= \', p.poster_id AS has_posted\';
						$query[\'JOINS\'][]	= array(
							\'LEFT JOIN\'		=> \'posts AS p\',
							\'ON\'			=> \'(p.poster_id=\'.$forum_user[\'id\'].\' AND p.topic_id=t.id)\'
						);

						// Must have same columns as in prev SELECT
						$query[\'GROUP BY\'] = \'t.id, t.poster, t.subject, t.first_post_id, t.posted, t.last_post, t.last_post_id, t.last_poster, t.num_replies, t.closed, t.sticky, t.forum_id, f.forum_name, p.poster_id\';
					}

					$url_type = $forum_url[\'fancy_alerts_topics_goto_alerts\'];
					$search_id = $value;
				}

				// ALERTED POSTS
				if ($action == \'fancy_alerts_quotes_show\')	{
					if ($forum_user[\'is_guest\']) {
						message($lang_common[\'Bad request\']);
					}

					// Check we\'re allowed to see the subscriptions we\'re trying to look at
					if ($forum_user[\'g_id\'] != FORUM_ADMIN && $forum_user[\'id\'] != $value) {
						message($lang_common[\'Bad request\']);
					}


					$query = array(
						\'SELECT\'	=> \'p.id AS pid, p.poster AS pposter, p.posted AS pposted, p.poster_id, p.message, p.hide_smilies, t.id AS tid, t.poster, t.subject, t.first_post_id, t.posted, t.last_post, t.last_post_id, t.last_poster, t.num_replies, t.forum_id, f.forum_name\',
						\'FROM\'		=> \'posts AS p\',
						\'JOINS\'		=> array(
							array(
								\'INNER JOIN\'	=> \'topics AS t\',
								\'ON\'			=> \'t.id=p.topic_id\'
							),
							array(
								\'INNER JOIN\'	=> \'fancy_alerts_posts AS fap\',
								\'ON\'			=> \'(t.id=fap.topic_id AND fap.user_id=\'.$value.\')\'
							),
							array(
								\'INNER JOIN\'	=> \'forums AS f\',
								\'ON\'			=> \'f.id=t.forum_id\'
							),
							array(
								\'LEFT JOIN\'		=> \'forum_perms AS fp\',
								\'ON\'			=> \'(fp.forum_id=f.id AND fp.group_id=\'.$forum_user[\'g_id\'].\')\'
							)
						),
						\'WHERE\'		=> \'(fp.read_forum IS NULL OR fp.read_forum=1) AND (p.id=fap.post_id)\',
						\'ORDER BY\'	=> \'pposted DESC\'
					);

					$show_as = \'posts\';
					$url_type = $forum_url[\'fancy_alerts_quotes_goto_alerts\'];
					$search_id = $value;
				}

				// MY ALERTS TOPICS
				if ($action == \'show_fancy_alerts_my_topics\') {
					if ($forum_user[\'is_guest\']) {
						message($lang_common[\'Bad request\']);
					}

					// Check we\'re allowed to see the subscriptions we\'re trying to look at
					if ($forum_user[\'g_id\'] != FORUM_ADMIN && $forum_user[\'id\'] != $value) {
						message($lang_common[\'Bad request\']);
					}

					$query = array(
						\'SELECT\'	=> \'t.id AS tid, t.poster, t.subject, t.first_post_id, t.posted, t.last_post, t.last_post_id, t.last_poster, t.num_replies, t.closed, t.sticky, t.forum_id, f.forum_name\',
						\'FROM\'		=> \'topics AS t\',
						\'JOINS\'		=> array(
							array(
								\'INNER JOIN\'	=> \'fancy_alerts_topics AS fat\',
								\'ON\'			=> \'(t.id=fat.topic_id AND fat.user_id=\'.$value.\')\'
							),
							array(
								\'INNER JOIN\'	=> \'forums AS f\',
								\'ON\'			=> \'f.id=t.forum_id\'
							),
							array(
								\'LEFT JOIN\'		=> \'forum_perms AS fp\',
								\'ON\'			=> \'(fp.forum_id=f.id AND fp.group_id=\'.$forum_user[\'g_id\'].\')\'
							)
						),
						\'WHERE\'		=> \'(fp.read_forum IS NULL OR fp.read_forum=1)\',
						\'ORDER BY\'	=> \'t.last_post DESC\'
					);

					if (!$forum_user[\'is_guest\'] && $forum_config[\'o_show_dot\'] == \'1\') {
						$query[\'SELECT\'] .= \', p.poster_id AS has_posted\';
						$query[\'JOINS\'][]	= array(
							\'LEFT JOIN\'		=> \'posts AS p\',
							\'ON\'			=> \'(p.poster_id=\'.$forum_user[\'id\'].\' AND p.topic_id=t.id)\'
						);

						// Must have same columns as in prev SELECT
						$query[\'GROUP BY\'] = \'t.id, t.poster, t.subject, t.first_post_id, t.posted, t.last_post, t.last_post_id, t.last_poster, t.num_replies, t.closed, t.sticky, t.forum_id, f.forum_name, p.poster_id\';
					}

					$url_type = $forum_url[\'fancy_alerts_search_my_alerts_topics\'];
					$search_id = $value;
				}

array_pop($GLOBALS[\'ext_info_stack\']);
$ext_info = empty($GLOBALS[\'ext_info_stack\']) ? array() : $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];
',
  ),
  'mr_confirm_split_posts_pre_confirm_checkbox' => 
  array (
    0 => '$GLOBALS[\'ext_info_stack\'][] = array(
\'id\'				=> \'pun_tags\',
\'path\'			=> FORUM_ROOT.\'extensions/pun_tags\',
\'url\'			=> $GLOBALS[\'base_url\'].\'/extensions/pun_tags\',
\'dependencies\'	=> array (
)
);
$ext_info = $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];

if ($fid)
			{
				$res_tags = array();
				if (isset($pun_tags[\'topics\'][$tid]))
				{

					foreach ($pun_tags[\'topics\'][$tid] as $tag_id)
						foreach ($pun_tags[\'index\'] as $tag)
							if ($tag[\'tag_id\'] == $tag_id)
								$res_tags[] = $tag[\'tag\'];
				}

				?>
				<div class="sf-box text">
						<label for="fld<?php echo ++$forum_page[\'fld_count\'] ?>"><span><?php echo $lang_pun_tags[\'Topic tags\']; ?></span><small><?php echo $lang_pun_tags[\'Enter tags\']; ?></small></label><br />
						<span class="fld-input"><input id="fld<?php echo $forum_page[\'fld_count\'] ?>" type="text" name="pun_tags" value="<?php if (!empty($res_tags)) echo implode(\', \', $res_tags); else echo \'\';  ?>" size="70" maxlength="100"/></span>
				</div>
			<?php

			}

array_pop($GLOBALS[\'ext_info_stack\']);
$ext_info = empty($GLOBALS[\'ext_info_stack\']) ? array() : $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];
',
  ),
  'se_post_results_fetched' => 
  array (
    0 => '$GLOBALS[\'ext_info_stack\'][] = array(
\'id\'				=> \'pun_tags\',
\'path\'			=> FORUM_ROOT.\'extensions/pun_tags\',
\'url\'			=> $GLOBALS[\'base_url\'].\'/extensions/pun_tags\',
\'dependencies\'	=> array (
)
);
$ext_info = $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];

if (!empty($search_set))
			{
				//Array with tags id
				$tags = array();
				//Array with processed topics
				$processed_topics = array();
				foreach ($search_set as $res)
				{
					if (!isset($pun_tags[\'topics\'][$res[\'tid\']]) || in_array($res[\'tid\'], $processed_topics))
						continue;

					$processed_topics[] = $res[\'tid\'];
					$tags = array_merge($tags, array_diff($pun_tags[\'topics\'][$res[\'tid\']], $tags));
				}
				//Array with tags and weights
				$tags_results = array();
				if (!empty($tags))
				{
					//Calculation of tags weight
					foreach ($pun_tags_groups_perms[$forum_user[\'group_id\']] as $forum_id)
					{
						if (!isset($pun_tags[\'forums\'][$forum_id]))
							continue;
						//Calcullate common keys in arrays
						$tmp = array_intersect($tags, array_keys($pun_tags[\'forums\'][$forum_id]));
						foreach ($tmp as $cur_tag)
						{
							if (!isset($tags_results[$cur_tag]))
								$tags_results[$cur_tag] = array(\'tag\' => $pun_tags[\'index\'][$cur_tag], \'weight\' => $pun_tags[\'forums\'][$forum_id][$cur_tag]);
							else
								$tags_results[$cur_tag][\'weight\'] += $pun_tags[\'forums\'][$forum_id][$cur_tag];
						}
					}
					unset($tmp);
				}
				unset($tags);
				if (!empty($tags_results))
				{
					$minfontsize = 100;
					$maxfontsize = 200;
					list($min_pop, $max_pop) = min_max_tags_weights($tags_results);
					if ($max_pop - $min_pop == 0)
						$step = $maxfontsize - $minfontsize;
					else
						$step = ($maxfontsize - $minfontsize) / ($max_pop - $min_pop);

					uasort($tags_results, \'compare_tags\');
					$tags_results = array_tags_slice($tags_results);
					$ouput_results = array();
					foreach ($tags_results as $tag_id => $tag_info)
						$ouput_results[] = pun_tags_get_link(round(($tag_info[\'weight\'] - $min_pop) * $step + $minfontsize), $tag_id, $tag_info[\'weight\'], $tag_info[\'tag\']);
					unset($minfontsize, $maxfontsize, $step, $tags_results, $min_pop, $max_pop);
				}
				unset($tags_results);
			}

array_pop($GLOBALS[\'ext_info_stack\']);
$ext_info = empty($GLOBALS[\'ext_info_stack\']) ? array() : $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];
',
  ),
  'mr_confirm_move_topics_pre_redirect' => 
  array (
    0 => '$GLOBALS[\'ext_info_stack\'][] = array(
\'id\'				=> \'pun_tags\',
\'path\'			=> FORUM_ROOT.\'extensions/pun_tags\',
\'url\'			=> $GLOBALS[\'base_url\'].\'/extensions/pun_tags\',
\'dependencies\'	=> array (
)
);
$ext_info = $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];

pun_tags_generate_cache();

array_pop($GLOBALS[\'ext_info_stack\']);
$ext_info = empty($GLOBALS[\'ext_info_stack\']) ? array() : $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];
',
  ),
  'mr_confirm_delete_topics_qr_delete_topics' => 
  array (
    0 => '$GLOBALS[\'ext_info_stack\'][] = array(
\'id\'				=> \'pun_tags\',
\'path\'			=> FORUM_ROOT.\'extensions/pun_tags\',
\'url\'			=> $GLOBALS[\'base_url\'].\'/extensions/pun_tags\',
\'dependencies\'	=> array (
)
);
$ext_info = $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];

$query_tags = array(
				\'DELETE\'	=>	\'topic_tags\',
				\'WHERE\'		=>	\'topic_id IN(\'.implode(\',\', $topics).\')\'
			);
			$forum_db->query_build($query_tags) or error(__FILE__, __LINE__);

array_pop($GLOBALS[\'ext_info_stack\']);
$ext_info = empty($GLOBALS[\'ext_info_stack\']) ? array() : $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];
',
  ),
  'afo_del_forum_pre_redirect' => 
  array (
    0 => '$GLOBALS[\'ext_info_stack\'][] = array(
\'id\'				=> \'pun_tags\',
\'path\'			=> FORUM_ROOT.\'extensions/pun_tags\',
\'url\'			=> $GLOBALS[\'base_url\'].\'/extensions/pun_tags\',
\'dependencies\'	=> array (
)
);
$ext_info = $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];

pun_tags_remove_orphans();
			pun_tags_generate_cache();
			require_once $ext_info[\'path\'].\'/functions.php\';
			pun_tags_generate_forum_perms_cache();

array_pop($GLOBALS[\'ext_info_stack\']);
$ext_info = empty($GLOBALS[\'ext_info_stack\']) ? array() : $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];
',
  ),
  'acg_del_cat_pre_redirect' => 
  array (
    0 => '$GLOBALS[\'ext_info_stack\'][] = array(
\'id\'				=> \'pun_tags\',
\'path\'			=> FORUM_ROOT.\'extensions/pun_tags\',
\'url\'			=> $GLOBALS[\'base_url\'].\'/extensions/pun_tags\',
\'dependencies\'	=> array (
)
);
$ext_info = $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];

pun_tags_remove_orphans();
			pun_tags_generate_cache();

array_pop($GLOBALS[\'ext_info_stack\']);
$ext_info = empty($GLOBALS[\'ext_info_stack\']) ? array() : $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];
',
  ),
  'ca_fn_prune_qr_prune_subscriptions' => 
  array (
    0 => '$GLOBALS[\'ext_info_stack\'][] = array(
\'id\'				=> \'pun_tags\',
\'path\'			=> FORUM_ROOT.\'extensions/pun_tags\',
\'url\'			=> $GLOBALS[\'base_url\'].\'/extensions/pun_tags\',
\'dependencies\'	=> array (
)
);
$ext_info = $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];

$query_tags = array(
				\'DELETE\'	=>	\'topic_tags\',
				\'WHERE\'		=>	\'topic_id IN(\'.$topic_ids.\')\'
			);
			$forum_db->query_build($query_tags) or error(__FILE__, __LINE__);

array_pop($GLOBALS[\'ext_info_stack\']);
$ext_info = empty($GLOBALS[\'ext_info_stack\']) ? array() : $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];
',
  ),
  'fn_delete_topic_end' => 
  array (
    0 => '$GLOBALS[\'ext_info_stack\'][] = array(
\'id\'				=> \'pun_tags\',
\'path\'			=> FORUM_ROOT.\'extensions/pun_tags\',
\'url\'			=> $GLOBALS[\'base_url\'].\'/extensions/pun_tags\',
\'dependencies\'	=> array (
)
);
$ext_info = $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];

// Remove topic tags
			pun_tags_remove_topic_tags($topic_id);
			pun_tags_remove_orphans();
			pun_tags_generate_cache();

array_pop($GLOBALS[\'ext_info_stack\']);
$ext_info = empty($GLOBALS[\'ext_info_stack\']) ? array() : $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];
',
    1 => '$GLOBALS[\'ext_info_stack\'][] = array(
\'id\'				=> \'fancy_alerts\',
\'path\'			=> FORUM_ROOT.\'extensions/fancy_alerts\',
\'url\'			=> $GLOBALS[\'base_url\'].\'/extensions/fancy_alerts\',
\'dependencies\'	=> array (
)
);
$ext_info = $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];

$fancy_alerts = new Fancy_alerts;
				$fancy_alerts->del_topic_alerts($topic_id);

array_pop($GLOBALS[\'ext_info_stack\']);
$ext_info = empty($GLOBALS[\'ext_info_stack\']) ? array() : $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];
',
  ),
  'ed_pre_post_edited' => 
  array (
    0 => '$GLOBALS[\'ext_info_stack\'][] = array(
\'id\'				=> \'pun_tags\',
\'path\'			=> FORUM_ROOT.\'extensions/pun_tags\',
\'url\'			=> $GLOBALS[\'base_url\'].\'/extensions/pun_tags\',
\'dependencies\'	=> array (
)
);
$ext_info = $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];

if ($can_edit_subject && $forum_user[\'g_pun_tags_allow\'])
			{
				//Parse the string
				if (isset($_POST[\'pun_tags\']))
					$new_tags = pun_tags_parse_string(utf8_trim($_POST[\'pun_tags\']));
				if (empty($new_tags))
				{
					if (isset($pun_tags[\'topics\'][$cur_post[\'tid\']]))
					{
						pun_tags_remove_topic_tags($cur_post[\'tid\']);
						$update_cache = TRUE;
					}
				}
				else
				{
					//Determine old tags
					$old_tags = array();
					if (!empty($pun_tags[\'topics\'][$cur_post[\'tid\']]))
					{
						foreach ($pun_tags[\'topics\'][$cur_post[\'tid\']] as $old_tagid)
							$old_tags[$old_tagid] = $pun_tags[\'index\'][$old_tagid];
					}

					//Tags for removing
					$remove_tags = array_diff($old_tags, $new_tags);
					if (!empty($remove_tags))
					{
						$pun_tags_query = array(
							\'DELETE\'	=>	\'topic_tags\',
							\'WHERE\'		=>	\'topic_id = \'.$cur_post[\'tid\'].\' AND tag_id IN (\'.implode(\',\', array_keys($remove_tags)).\')\'
						);
						$forum_db->query_build($pun_tags_query) or error(__FILE__, __LINE__);
						$update_cache = TRUE;
					}

					$search_arr = isset($pun_tags[\'index\']) ? $pun_tags[\'index\'] : array();
					foreach ($new_tags as $tag)
					{
						//Have we current tag?
						if (in_array($tag, $old_tags))
							continue;
						$tag_id = array_search($tag, $search_arr);
						if ($tag_id === FALSE)
							pun_tags_add_new($tag, $cur_post[\'tid\']);
						else
							pun_tags_add_existing_tag($tag_id, $cur_post[\'tid\']);
						$update_cache = TRUE;
					}
				}

				if (!empty($update_cache))
				{
					pun_tags_remove_orphans();
					pun_tags_generate_cache();
				}
			}

array_pop($GLOBALS[\'ext_info_stack\']);
$ext_info = empty($GLOBALS[\'ext_info_stack\']) ? array() : $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];
',
  ),
  'mr_confirm_split_posts_form_submitted' => 
  array (
    0 => '$GLOBALS[\'ext_info_stack\'][] = array(
\'id\'				=> \'pun_tags\',
\'path\'			=> FORUM_ROOT.\'extensions/pun_tags\',
\'url\'			=> $GLOBALS[\'base_url\'].\'/extensions/pun_tags\',
\'dependencies\'	=> array (
)
);
$ext_info = $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];

if (!empty($_POST[\'pun_tags\']) && $forum_user[\'g_pun_tags_allow\'])
				$new_tags = pun_tags_parse_string(utf8_trim($_POST[\'pun_tags\']));

array_pop($GLOBALS[\'ext_info_stack\']);
$ext_info = empty($GLOBALS[\'ext_info_stack\']) ? array() : $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];
',
  ),
  'hd_main_elements' => 
  array (
    0 => '$GLOBALS[\'ext_info_stack\'][] = array(
\'id\'				=> \'pun_tags\',
\'path\'			=> FORUM_ROOT.\'extensions/pun_tags\',
\'url\'			=> $GLOBALS[\'base_url\'].\'/extensions/pun_tags\',
\'dependencies\'	=> array (
)
);
$ext_info = $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];

//Output of search results
			if ($forum_config[\'o_pun_tags_show\'] == \'1\' && in_array(FORUM_PAGE, array(\'index\', \'viewforum\', \'viewtopic\', \'searchtopics\', \'searchposts\')))
			{
				$output_results = array();
				switch (FORUM_PAGE)
				{
					case \'index\':
						if (isset($pun_tags[\'forums\']))
						{
							foreach ($pun_tags[\'forums\'] as $forum_id => $tags_list)
							{
								//Can user read this forum?
								if (in_array($forum_id, $pun_tags_groups_perms[$forum_user[\'group_id\']]))
								{
									foreach ($tags_list as $tag_id => $tag_weight)
										if (!isset($output_results[$tag_id]))
											$output_results[$tag_id] = array(\'tag\' => $pun_tags[\'index\'][$tag_id], \'weight\' => $tag_weight);
										else
											$output_results[$tag_id][\'weight\'] += $tag_weight;
								}
							}
						}
						break;

					case \'viewforum\':
						if (isset($pun_tags[\'forums\'][$id]))
						{
							foreach ($pun_tags[\'forums\'][$id] as $tag_id => $tag_weight)
							{
								$output_results[$tag_id] = array(\'tag\' => $pun_tags[\'index\'][$tag_id], \'weight\' => $tag_weight);
								//Determine tag weight
								foreach ($pun_tags[\'forums\'] as $forum_id => $tags_list)
									if ($forum_id != $id && in_array($forum_id, $pun_tags_groups_perms[$forum_user[\'group_id\']]) && in_array($tag_id, array_keys($tags_list)))
										$output_results[$tag_id][\'weight\'] += $tags_list[$tag_id];
							}
						}
						break;

					case \'viewtopic\':
						if (isset($pun_tags[\'topics\'][$id]))
						{
							foreach ($pun_tags[\'topics\'][$id] as $tag_id)
							{
								$output_results[$tag_id] = array(\'tag\' => $pun_tags[\'index\'][$tag_id], \'weight\' => $pun_tags[\'forums\'][$cur_topic[\'forum_id\']][$tag_id]);
								//Determine tag weight
								foreach ($pun_tags[\'forums\'] as $forum_id => $tags_list)
									if ($forum_id != $cur_topic[\'forum_id\'] && in_array($forum_id, $pun_tags_groups_perms[$forum_user[\'group_id\']]) && in_array($tag_id, array_keys($tags_list)))
										$output_results[$tag_id][\'weight\'] += $tags_list[$tag_id];
							}
						}
						break;

					case \'searchtopics\':
					case \'searchposts\':
						//This string will be replaced after getting search results
						$main_elements[\'<!-- forum_crumbs_end -->\'] .= \'<div id="brd-pun_tags"></div>\';
						break;
				}

				if (!empty($output_results))
				{
					$minfontsize = 100;
					$maxfontsize = 200;
					list($min_pop, $max_pop) = min_max_tags_weights($output_results);
					if ($max_pop - $min_pop == 0)
						$step = $maxfontsize - $minfontsize;
					else
						$step = ($maxfontsize - $minfontsize) / ($max_pop - $min_pop);

					uasort($output_results, \'compare_tags\');
					$output_results = array_tags_slice($output_results);
					$results = array();
					foreach ($output_results as $tag_id => $tag_info)
					{
						$results[] = pun_tags_get_link(round(($tag_info[\'weight\'] - $min_pop) * $step + $minfontsize), $tag_id, $tag_info[\'weight\'], $tag_info[\'tag\']);
					}
					$main_elements[\'<!-- forum_crumbs_end -->\'] .= \'<div id="brd-pun_tags"><ul>\'.implode($forum_config[\'o_pun_tags_separator\'], $results).\'</ul></div>\';
					unset($minfontsize, $maxfontsize, $step, $results, $min_pop, $max_pop);
				}
				unset($output_results, $tags_weights);
			}

array_pop($GLOBALS[\'ext_info_stack\']);
$ext_info = empty($GLOBALS[\'ext_info_stack\']) ? array() : $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];
',
    1 => '$GLOBALS[\'ext_info_stack\'][] = array(
\'id\'				=> \'fancy_simtopics\',
\'path\'			=> FORUM_ROOT.\'extensions/fancy_simtopics\',
\'url\'			=> $GLOBALS[\'base_url\'].\'/extensions/fancy_simtopics\',
\'dependencies\'	=> array (
)
);
$ext_info = $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];

if (isset($fancy_simtopics_links)) {
				$main_elements[\'<!-- forum_crumbs_end -->\'] .= $fancy_simtopics_links;
			}

array_pop($GLOBALS[\'ext_info_stack\']);
$ext_info = empty($GLOBALS[\'ext_info_stack\']) ? array() : $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];
',
  ),
  'se_results_pre_header_load' => 
  array (
    0 => '$GLOBALS[\'ext_info_stack\'][] = array(
\'id\'				=> \'pun_tags\',
\'path\'			=> FORUM_ROOT.\'extensions/pun_tags\',
\'url\'			=> $GLOBALS[\'base_url\'].\'/extensions/pun_tags\',
\'dependencies\'	=> array (
)
);
$ext_info = $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];

if ($action == \'tag\')
			{
				// Regenerate paging links
				$tag_id = isset($_GET[\'tag_id\']) ? intval($_GET[\'tag_id\']) : 0;
				if ($tag_id >= 1)
					$forum_page[\'page_post\'][\'paging\'] = \'<p class="paging"><span class="pages">\'.$lang_common[\'Pages\'].\'</span> \'.paginate($forum_page[\'num_pages\'], $forum_page[\'page\'], $forum_url[\'search_tag\'], $lang_common[\'Paging separator\'], $tag_id).\'</p>\';
			}

array_pop($GLOBALS[\'ext_info_stack\']);
$ext_info = empty($GLOBALS[\'ext_info_stack\']) ? array() : $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];
',
  ),
  'vt_pre_header_load' => 
  array (
    0 => '$GLOBALS[\'ext_info_stack\'][] = array(
\'id\'				=> \'fancy_addthis\',
\'path\'			=> FORUM_ROOT.\'extensions/fancy_addthis\',
\'url\'			=> $GLOBALS[\'base_url\'].\'/extensions/fancy_addthis\',
\'dependencies\'	=> array (
)
);
$ext_info = $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];

if (!isset($lang_fancy_addthis)) {
				if ($forum_user[\'language\'] != \'English\' && file_exists($ext_info[\'path\'].\'/lang/\'.$forum_user[\'language\'].\'/lang.php\')) {
					require $ext_info[\'path\'].\'/lang/\'.$forum_user[\'language\'].\'/lang.php\';
				} else {
					require $ext_info[\'path\'].\'/lang/English/lang.php\';
				}
			}

			// CSS for disabled JS hide bar
			$forum_loader->add_css(\'#fancy_addthis_topic_toolbox, .fancy-addthis-post { display: none; }\',
				array(\'type\' => \'inline\', \'noscript\' => true));

			$forum_loader->add_css(\'
				#fancy_addthis_topic_toolbox { min-height: 30px; margin: .75em 0 0; height: 30px; overflow: hidden; }
				#fancy_addthis_topic_toolbox table { float: right; width: auto; }
				#fancy_addthis_topic_toolbox td { border: none; padding: .2em; height: 30px; vertical-align: bottom; }
				#fancy_addthis_topic_toolbox .addthis_button_tweet { cursor:pointer; min-width:50px; display:inline-block; }
				#fancy_addthis_topic_toolbox .addthis_button_facebook_like { width:46px; overflow:hidden; display:inline-block; }
				#fancy_addthis_topic_toolbox .addthis_button_google_plusone { min-width:25px; position:relative; display:inline-block; }
				#fancy_addthis_topic_toolbox td > a { height: 28px; }\',
				array(\'type\' => \'inline\'));

			$forum_loader->add_js(\'//s7.addthis.com/js/250/addthis_widget.js#domready=1\', array(\'weight\' => 250));

			$fancy_addthis_js_env = \'
				PUNBB.env.fancy_addthis = {
					show_onclick: "",
					pubid: ""
				};\';


			$forum_loader->add_js($fancy_addthis_js_env, array(\'type\' => \'inline\', \'weight\' => 251));
			$forum_loader->add_js(\'PUNBB.fancy_addthis=(function(){var a={ui_click:true,ui_delay:75,ui_508_compliant:false};return{init:function(){var c,d,b,e,f;if(document.getElementsByClassName){f=document.getElementsByClassName("fancy-addthis-link");}else{f=PUNBB.common.arrayOfMatched(function(g){return PUNBB.common.hasClass(g,"fancy-addthis-link");},document.getElementsByTagName("span"));}for(c=0,b=f.length;c<b;c+=1){d=f[c];e={url:d.getAttribute("data-share-url")};addthis.button(d,a,e);PUNBB.common.addClass(d,"js_link");}}};}());PUNBB.common.addDOMReadyEvent(PUNBB.fancy_addthis.init);\', array(\'type\' => \'inline\', \'weight\' => 252));

array_pop($GLOBALS[\'ext_info_stack\']);
$ext_info = empty($GLOBALS[\'ext_info_stack\']) ? array() : $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];
',
    1 => '$GLOBALS[\'ext_info_stack\'][] = array(
\'id\'				=> \'fancy_alerts\',
\'path\'			=> FORUM_ROOT.\'extensions/fancy_alerts\',
\'url\'			=> $GLOBALS[\'base_url\'].\'/extensions/fancy_alerts\',
\'dependencies\'	=> array (
)
);
$ext_info = $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];

if (!$forum_user[\'is_guest\']) {
					$fancy_alerts = new Fancy_alerts;

					if (!isset($lang_fancy_alerts)) {
						if ($forum_user[\'language\'] != \'English\' && file_exists($ext_info[\'path\'].\'/lang/\'.$forum_user[\'language\'].\'/\'.$ext_info[\'id\'].\'.php\')) {
							require $ext_info[\'path\'].\'/lang/\'.$forum_user[\'language\'].\'/\'.$ext_info[\'id\'].\'.php\';
						} else {
							require $ext_info[\'path\'].\'/lang/English/\'.$ext_info[\'id\'].\'.php\';
						}
					}

					$query = array(
						\'SELECT\'	=> \'p.id, p.posted\',
						\'FROM\'		=> \'posts AS p\',
						\'WHERE\'		=> \'p.topic_id=\'.$id,
						\'ORDER BY\'	=> \'p.id\',
						\'LIMIT\'		=> $forum_page[\'start_from\'].\',\'.$forum_user[\'disp_posts\']
					);

					$result = $forum_db->query_build($query) or error(__FILE__, __LINE__);
					$fancy_alerts_last_post = \'\';
					$fancy_alerts_showed_posts = array();

					while ($last_post = $forum_db->fetch_assoc($result)) {
						$fancy_alerts_last_post = $last_post;
						array_push($fancy_alerts_showed_posts, $last_post[\'id\']);
					}

					$fancy_alerts->on_viewtopic_update_topic_alerts($id, $forum_user[\'id\'], $fancy_alerts_last_post[\'id\'], $fancy_alerts_last_post[\'posted\']);

					$fancy_alerts->mark_quotes_as_readed($fancy_alerts_showed_posts, $forum_user[\'id\']);

					// SHOW ALERTS STATUS
					if ($cur_topic[\'is_fancy_alerts_topic\']) {
						$forum_page[\'main_head_options\'][\'fancy_alerts_topic_disable\'] = \'<span><a class="sub-option" href="\'.forum_link($forum_url[\'fancy_alerts_topics_turn_off\'], array($id, generate_form_token(\'fancy_alerts_topics_off\'.$id.$forum_user[\'id\']))).\'" title="\'.$lang_fancy_alerts[\'Alerts Topics On Title\'].\'"><em>\'.$lang_fancy_alerts[\'Alerts Topics On\'].\'</em></a></span>\';
					} else {
						$forum_page[\'main_head_options\'][\'fancy_alerts_topic_enable\'] = \'<span><a class="sub-option" href="\'.forum_link($forum_url[\'fancy_alerts_topics_turn_on\'], array($id, generate_form_token(\'fancy_alerts_topics_on\'.$id.$forum_user[\'id\']))).\'" title="\'.$lang_fancy_alerts[\'Alerts Topics Off Title\'].\'">\'.$lang_fancy_alerts[\'Alerts Topics Off\'].\'</a></span>\';
					}
				}

array_pop($GLOBALS[\'ext_info_stack\']);
$ext_info = empty($GLOBALS[\'ext_info_stack\']) ? array() : $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];
',
    2 => '$GLOBALS[\'ext_info_stack\'][] = array(
\'id\'				=> \'fancy_simtopics\',
\'path\'			=> FORUM_ROOT.\'extensions/fancy_simtopics\',
\'url\'			=> $GLOBALS[\'base_url\'].\'/extensions/fancy_simtopics\',
\'dependencies\'	=> array (
)
);
$ext_info = $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];

if ($cur_topic[\'fancy_simtopics_show\'] == \'1\') {
				if ((!$forum_user[\'is_guest\'] && $forum_user[\'fancy_simtopics_enable\']) || ($forum_user[\'is_guest\'] && intval($forum_config[\'o_fancy_simtopics_show_for_guest\']) === 1)) {
					$fancy_simtopics = new Fancy_simtopics;
					$fancy_simtopics_links = $fancy_simtopics->get_simtopics($cur_topic[\'subject\'], $cur_topic[\'forum_id\'], $id);
				}
			}

array_pop($GLOBALS[\'ext_info_stack\']);
$ext_info = empty($GLOBALS[\'ext_info_stack\']) ? array() : $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];
',
  ),
  'aop_features_gzip_fieldset_end' => 
  array (
    0 => '$GLOBALS[\'ext_info_stack\'][] = array(
\'id\'				=> \'fancy_addthis\',
\'path\'			=> FORUM_ROOT.\'extensions/fancy_addthis\',
\'url\'			=> $GLOBALS[\'base_url\'].\'/extensions/fancy_addthis\',
\'dependencies\'	=> array (
)
);
$ext_info = $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];

if (!isset($lang_fancy_addthis)) {
				if ($forum_user[\'language\'] != \'English\' && file_exists($ext_info[\'path\'].\'/lang/\'.$forum_user[\'language\'].\'/lang.php\')) {
					require $ext_info[\'path\'].\'/lang/\'.$forum_user[\'language\'].\'/lang.php\';
				} else {
					require $ext_info[\'path\'].\'/lang/English/lang.php\';
				}
			}

			$forum_page[\'group_count\'] = $forum_page[\'item_count\'] = 0;
?>
				<div class="content-head" id="<?php echo $ext_info[\'id\'].\'_settings\'; ?>">
					<h2 class="hn"><span><?php echo $lang_fancy_addthis[\'Name\'] ?></span></h2>
				</div>
				<fieldset class="frm-group group<?php echo ++$forum_page[\'group_count\'] ?>">
					<legend class="group-legend"><span><?php echo $lang_fancy_addthis[\'Name\'] ?></span></legend>

					<fieldset class="mf-set set<?php echo ++$forum_page[\'item_count\'] ?>">
						<legend><span><?php echo $lang_fancy_addthis[\'Enable buttons\'] ?></span></legend>
						<div class="mf-box">
							<div class="mf-item">
								<span class="fld-input">
									<input type="checkbox"
										id="fld<?php echo ++$forum_page[\'fld_count\'] ?>"
										name="form[fancy_addthis_button_gplus]" value="1"
										<?php if ($forum_config[\'o_fancy_addthis_button_gplus\'] == \'1\') echo \' checked="checked"\'; ?> />
								</span>
								<label for="fld<?php echo $forum_page[\'fld_count\'] ?>">
									<?php echo $lang_fancy_addthis[\'Enable G+ button label\'] ?>
								</label>
							</div>

							<div class="mf-item">
								<span class="fld-input">
									<input
										type="checkbox"
										id="fld<?php echo ++$forum_page[\'fld_count\'] ?>"
										name="form[fancy_addthis_button_twitter]" value="1"
										<?php if ($forum_config[\'o_fancy_addthis_button_twitter\'] == \'1\') echo \' checked="checked"\'; ?> />
								</span>
								<label for="fld<?php echo $forum_page[\'fld_count\'] ?>">
									<?php echo $lang_fancy_addthis[\'Enable Twitter button label\'] ?>
								</label>
							</div>

							<div class="mf-item">
								<span class="fld-input">
									<input
										type="checkbox"
										id="fld<?php echo ++$forum_page[\'fld_count\'] ?>"
										name="form[fancy_addthis_button_facebook]" value="1"
										<?php if ($forum_config[\'o_fancy_addthis_button_facebook\'] == \'1\') echo \' checked="checked"\'; ?> />
								</span>
								<label for="fld<?php echo $forum_page[\'fld_count\'] ?>">
									<?php echo $lang_fancy_addthis[\'Enable Facebook button label\'] ?>
								</label>
							</div>
						</div>
					</fieldset>

				</fieldset>
<?php

array_pop($GLOBALS[\'ext_info_stack\']);
$ext_info = empty($GLOBALS[\'ext_info_stack\']) ? array() : $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];
',
    1 => '$GLOBALS[\'ext_info_stack\'][] = array(
\'id\'				=> \'fancy_alerts\',
\'path\'			=> FORUM_ROOT.\'extensions/fancy_alerts\',
\'url\'			=> $GLOBALS[\'base_url\'].\'/extensions/fancy_alerts\',
\'dependencies\'	=> array (
)
);
$ext_info = $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];

if (!isset($lang_fancy_alerts)) {
					if (file_exists($ext_info[\'path\'].\'/lang/\'.$forum_user[\'language\'].\'/\'.$ext_info[\'id\'].\'.php\')) {
						require $ext_info[\'path\'].\'/lang/\'.$forum_user[\'language\'].\'/\'.$ext_info[\'id\'].\'.php\';
					} else {
						require $ext_info[\'path\'].\'/lang/English/\'.$ext_info[\'id\'].\'.php\';
					}
				}

				$forum_page[\'group_count\'] = $forum_page[\'item_count\'] = 0;

?>
				<div class="content-head" id="<?php echo $ext_info[\'id\'].\'_settings\'; ?>">
					<h2 class="hn"><span><?php echo $lang_fancy_alerts[\'Settings Name\'] ?></span></h2>
				</div>
				<fieldset class="frm-group group<?php echo ++$forum_page[\'group_count\'] ?>">
					<legend class="group-legend"><span><?php echo $lang_fancy_alerts[\'Settings Name\'] ?></span></legend>
					<div class="sf-set set<?php echo ++$forum_page[\'item_count\'] ?>">
						<div class="sf-box sf-short text">
							<label for="fld<?php echo ++$forum_page[\'fld_count\'] ?>">
								<span><?php echo $lang_fancy_alerts[\'Settings Autoupdate Name\'] ?></span>
								<small><?php echo $lang_fancy_alerts[\'Settings Autoupdate Help\'] ?></small>
							</label><br/>
							<span class="fld-input">
								<input type="text" id="fld<?php echo $forum_page[\'fld_count\'] ?>" name="form[fancy_alerts_autoupdate_interval]" size="3" maxlength="3" value="<?php echo intval($forum_config[\'o_fancy_alerts_autoupdate_interval\'], 10) ?>"/>
							</span>
						</div>
					</div>
				</fieldset>
<?php

array_pop($GLOBALS[\'ext_info_stack\']);
$ext_info = empty($GLOBALS[\'ext_info_stack\']) ? array() : $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];
',
    2 => '$GLOBALS[\'ext_info_stack\'][] = array(
\'id\'				=> \'pun_jquery\',
\'path\'			=> FORUM_ROOT.\'extensions/pun_jquery\',
\'url\'			=> $GLOBALS[\'base_url\'].\'/extensions/pun_jquery\',
\'dependencies\'	=> array (
)
);
$ext_info = $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];

if (!isset($lang_pun_jquery)) {
				if (file_exists($ext_info[\'path\'].\'/lang/\'.$forum_user[\'language\'].\'/lang.php\')) {
					require $ext_info[\'path\'].\'/lang/\'.$forum_user[\'language\'].\'/lang.php\';
				} else {
					require $ext_info[\'path\'].\'/lang/English/lang.php\';
				}
			}

			// Reset counter
			$forum_page[\'group_count\'] = $forum_page[\'item_count\'] = 0;
?>
			<div class="content-head">
				<h2 class="hn"><span><?php echo sprintf($lang_pun_jquery[\'Setup jquery\'], PUN_JQUERY_VERSION) ?></span></h2>
			</div>

			<fieldset class="frm-group group<?php echo ++$forum_page[\'group_count\'] ?>">
				<legend class="group-legend"><strong><?php echo sprintf($lang_pun_jquery[\'Setup jquery legend\'], PUN_JQUERY_VERSION) ?></strong></legend>
				<fieldset class="mf-set set<?php echo ++$forum_page[\'item_count\'] ?>">
					<legend><span><?php echo $lang_pun_jquery[\'Include method\'] ?></span></legend>
					<div class="mf-box">
						<div class="mf-item">
							<span class="fld-input"><input type="radio" id="fld<?php echo ++$forum_page[\'fld_count\'] ?>" name="form[pun_jquery_include_method]" value="<?php echo PUN_JQUERY_INCLUDE_METHOD_LOCAL; ?>"<?php if ($forum_config[\'o_pun_jquery_include_method\'] == PUN_JQUERY_INCLUDE_METHOD_LOCAL) echo \' checked="checked"\' ?> /></span>
							<label for="fld<?php echo $forum_page[\'fld_count\'] ?>"><?php echo $lang_pun_jquery[\'Include method local label\'] ?></label>
						</div>
						<div class="mf-item">
							<span class="fld-input"><input type="radio" id="fld<?php echo ++$forum_page[\'fld_count\'] ?>" name="form[pun_jquery_include_method]" value="<?php echo PUN_JQUERY_INCLUDE_METHOD_GOOGLE_CDN; ?>"<?php if ($forum_config[\'o_pun_jquery_include_method\'] == PUN_JQUERY_INCLUDE_METHOD_GOOGLE_CDN) echo \' checked="checked"\' ?> /></span>
							<label for="fld<?php echo $forum_page[\'fld_count\'] ?>"><?php echo $lang_pun_jquery[\'Include method google label\'] ?></label>
						</div>
						<div class="mf-item">
							<span class="fld-input"><input type="radio" id="fld<?php echo ++$forum_page[\'fld_count\'] ?>" name="form[pun_jquery_include_method]" value="<?php echo PUN_JQUERY_INCLUDE_METHOD_MICROSOFT_CDN; ?>"<?php if ($forum_config[\'o_pun_jquery_include_method\'] == PUN_JQUERY_INCLUDE_METHOD_MICROSOFT_CDN) echo \' checked="checked"\' ?> /></span>
							<label for="fld<?php echo $forum_page[\'fld_count\'] ?>"><?php echo $lang_pun_jquery[\'Include method microsoft label\'] ?></label>
						</div>
						<div class="mf-item">
							<span class="fld-input"><input type="radio" id="fld<?php echo ++$forum_page[\'fld_count\'] ?>" name="form[pun_jquery_include_method]" value="<?php echo PUN_JQUERY_INCLUDE_METHOD_JQUERY_CDN; ?>"<?php if ($forum_config[\'o_pun_jquery_include_method\'] == PUN_JQUERY_INCLUDE_METHOD_JQUERY_CDN) echo \' checked="checked"\' ?> /></span>
							<label for="fld<?php echo $forum_page[\'fld_count\'] ?>"><?php echo $lang_pun_jquery[\'Include method jquery label\'] ?></label>
						</div>
					</div>
				</fieldset>
			</fieldset>

<?php

array_pop($GLOBALS[\'ext_info_stack\']);
$ext_info = empty($GLOBALS[\'ext_info_stack\']) ? array() : $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];
',
    3 => '$GLOBALS[\'ext_info_stack\'][] = array(
\'id\'				=> \'fancy_js_cache\',
\'path\'			=> FORUM_ROOT.\'extensions/fancy_js_cache\',
\'url\'			=> $GLOBALS[\'base_url\'].\'/extensions/fancy_js_cache\',
\'dependencies\'	=> array (
)
);
$ext_info = $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];

// Load LANG
				if (!isset($lang_fancy_js_cache)) {
					if (file_exists($ext_info[\'path\'].\'/lang/\'.$forum_user[\'language\'].\'/\'.$ext_info[\'id\'].\'.php\')) {
						require $ext_info[\'path\'].\'/lang/\'.$forum_user[\'language\'].\'/\'.$ext_info[\'id\'].\'.php\';
					} else {
						require $ext_info[\'path\'].\'/lang/English/\'.$ext_info[\'id\'].\'.php\';
					}
				}

				$forum_page[\'group_count\'] = $forum_page[\'item_count\'] = 0;

?>
				<div class="content-head" id="<?php echo $ext_info[\'id\'].\'_settings\'; ?>">
					<h2 class="hn"><span><?php echo $lang_fancy_js_cache[\'Name\'] ?></span></h2>
				</div>
				<fieldset class="frm-group group<?php echo ++$forum_page[\'group_count\'] ?>">
					<legend class="group-legend"><span><?php echo $lang_fancy_js_cache[\'Name\'] ?></span></legend>



					<fieldset class="mf-set set<?php echo ++$forum_page[\'item_count\'] ?>">
						<legend><span><?php echo $lang_fancy_js_cache[\'Enable CSS\'] ?></span></legend>
						<div class="mf-box">
							<div class="mf-item">
								<span class="fld-input"><input type="checkbox" id="fld<?php echo ++$forum_page[\'fld_count\'] ?>" name="form[fancy_js_css_cache_enable]" value="1"<?php if ($forum_config[\'o_fancy_js_css_cache_enable\'] == \'1\') echo \' checked="checked"\'; ?> /></span>
								<label for="fld<?php echo $forum_page[\'fld_count\'] ?>"><?php echo $lang_fancy_js_cache[\'Enable CSS label\'] ?></label>
							</div>
						</div>
					</fieldset>


					<div class="sf-set set<?php echo ++$forum_page[\'item_count\'] ?>">
						<div class="sf-box text">
							<label for="fld<?php echo ++$forum_page[\'fld_count\'] ?>"><span><?php echo $lang_fancy_js_cache[\'Input CSS CDN\'] ?></span></label><br />
							<span class="fld-input"><input type="text" id="fld<?php echo $forum_page[\'fld_count\'] ?>" name="form[fancy_js_cache_css_cdn]" size="50" maxlength="128" value="<?php echo forum_htmlencode($forum_config[\'o_fancy_js_cache_css_cdn\']) ?>" /></span>
						</div>
					</div>

				</fieldset>
<?php

array_pop($GLOBALS[\'ext_info_stack\']);
$ext_info = empty($GLOBALS[\'ext_info_stack\']) ? array() : $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];
',
    4 => '$GLOBALS[\'ext_info_stack\'][] = array(
\'id\'				=> \'fancy_simtopics\',
\'path\'			=> FORUM_ROOT.\'extensions/fancy_simtopics\',
\'url\'			=> $GLOBALS[\'base_url\'].\'/extensions/fancy_simtopics\',
\'dependencies\'	=> array (
)
);
$ext_info = $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];

if (!isset($lang_fancy_simtopics)) {
					if (file_exists($ext_info[\'path\'].\'/lang/\'.$forum_user[\'language\'].\'/\'.$ext_info[\'id\'].\'.php\')) {
						require $ext_info[\'path\'].\'/lang/\'.$forum_user[\'language\'].\'/\'.$ext_info[\'id\'].\'.php\';
					} else {
						require $ext_info[\'path\'].\'/lang/English/\'.$ext_info[\'id\'].\'.php\';
					}
				}


				$forum_page[\'group_count\'] = $forum_page[\'item_count\'] = 0;

?>
				<div class="content-head" id="<?php echo $ext_info[\'id\'].\'_settings\'; ?>">
					<h2 class="hn"><span><?php echo $lang_fancy_simtopics[\'Settings Name\'] ?></span></h2>
				</div>
				<fieldset class="frm-group group<?php echo ++$forum_page[\'group_count\'] ?>">
					<legend class="group-legend"><span><?php echo $lang_fancy_simtopics[\'Settings Name\'] ?></span></legend>

					<div class="sf-set set<?php echo ++$forum_page[\'item_count\'] ?>">
						<div class="sf-box checkbox">
							<span class="fld-input"><input type="checkbox" id="fld<?php echo ++$forum_page[\'fld_count\'] ?>" name="form[fancy_simtopics_show_for_guest]" value="1"<?php if ($forum_config[\'o_fancy_simtopics_show_for_guest\'] == \'1\') echo \' checked="checked"\' ?> /></span>
							<label for="fld<?php echo $forum_page[\'fld_count\'] ?>"><?php echo $lang_fancy_simtopics[\'Settings Show for guest\'] ?></label>
						</div>
					</div>

					<div class="sf-set set<?php echo ++$forum_page[\'item_count\'] ?>">
						<div class="sf-box checkbox">
							<span class="fld-input"><input type="checkbox" id="fld<?php echo ++$forum_page[\'fld_count\'] ?>" name="form[fancy_simtopics_one_forum]" value="1"<?php if ($forum_config[\'o_fancy_simtopics_one_forum\'] == \'1\') echo \' checked="checked"\' ?> /></span>
							<label for="fld<?php echo $forum_page[\'fld_count\'] ?>"><?php echo $lang_fancy_simtopics[\'Settings One Forum\'] ?></label>
						</div>
					</div>

					<div class="sf-set set<?php echo ++$forum_page[\'item_count\'] ?>">
						<div class="sf-box sf-short text">
							<label for="fld<?php echo ++$forum_page[\'fld_count\'] ?>">
								<span><?php echo $lang_fancy_simtopics[\'Settings Num Name\'] ?></span>
								<small><?php echo $lang_fancy_simtopics[\'Settings Num Help\'] ?></small>
							</label><br/>
							<span class="fld-input">
								<input type="text" id="fld<?php echo $forum_page[\'fld_count\'] ?>" name="form[fancy_simtopics_num_topics]" size="3" maxlength="3" value="<?php echo intval($forum_config[\'o_fancy_simtopics_num_topics\'], 10) ?>"/>
							</span>
						</div>
					</div>

					<div class="sf-set set<?php echo ++$forum_page[\'item_count\'] ?>">
						<div class="sf-box sf-short text">
							<label for="fld<?php echo ++$forum_page[\'fld_count\'] ?>">
								<span><?php echo $lang_fancy_simtopics[\'Settings Time Name\'] ?></span>
								<small><?php echo $lang_fancy_simtopics[\'Settings Time Help\'] ?></small>
							</label><br/>
							<span class="fld-input">
								<input type="text" id="fld<?php echo $forum_page[\'fld_count\'] ?>" name="form[fancy_simtopics_time_topics]" size="3" maxlength="4" value="<?php echo intval($forum_config[\'o_fancy_simtopics_time_topics\'], 10) ?>"/>
							</span>
						</div>
					</div>


				</fieldset>
<?php

array_pop($GLOBALS[\'ext_info_stack\']);
$ext_info = empty($GLOBALS[\'ext_info_stack\']) ? array() : $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];
',
    5 => '$GLOBALS[\'ext_info_stack\'][] = array(
\'id\'				=> \'fancy_stop_spam\',
\'path\'			=> FORUM_ROOT.\'extensions/fancy_stop_spam\',
\'url\'			=> $GLOBALS[\'base_url\'].\'/extensions/fancy_stop_spam\',
\'dependencies\'	=> array (
)
);
$ext_info = $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];

$forum_page[\'group_count\'] = $forum_page[\'item_count\'] = 0;
		?>
				<div class="content-head" id="<?php echo $ext_info[\'id\'].\'_settings\'; ?>">
					<h2 class="hn"><span><?php echo $lang_fancy_stop_spam[\'Settings Name\'] ?></span></h2>
				</div>
				<fieldset class="frm-group group<?php echo ++$forum_page[\'group_count\'] ?>">
					<legend class="group-legend"><span><?php echo $lang_fancy_stop_spam[\'Name\'] ?></span></legend>

					<!-- REGISTER FORM -->
					<fieldset class="mf-set set<?php echo ++$forum_page[\'item_count\'] ?>">
						<legend><span><?php echo $lang_fancy_stop_spam[\'Register form\'] ?></span></legend>
						<div class="mf-box">
							<div class="mf-item">
								<span class="fld-input"><input type="checkbox" id="fld<?php echo ++$forum_page[\'fld_count\'] ?>" name="form[fancy_stop_spam_register_form_honeypot]" value="1"<?php if ($forum_config[\'o_fancy_stop_spam_register_form_honeypot\'] == \'1\') echo \' checked="checked"\'; ?> /></span>
								<label for="fld<?php echo $forum_page[\'fld_count\'] ?>"><?php echo $lang_fancy_stop_spam[\'Enable Honeypot\'] ?></label>
							</div>
							<div class="mf-item">
								<span class="fld-input"><input type="checkbox" id="fld<?php echo ++$forum_page[\'fld_count\'] ?>" name="form[fancy_stop_spam_register_form_timeout]" value="1"<?php if ($forum_config[\'o_fancy_stop_spam_register_form_timeout\'] == \'1\') echo \' checked="checked"\'; ?> /></span>
								<label for="fld<?php echo $forum_page[\'fld_count\'] ?>"><?php echo $lang_fancy_stop_spam[\'Enable Timeout\'] ?></label>
							</div>
							<div class="mf-item">
								<span class="fld-input"><input type="checkbox" id="fld<?php echo ++$forum_page[\'fld_count\'] ?>" name="form[fancy_stop_spam_register_form_timezone]" value="1"<?php if ($forum_config[\'o_fancy_stop_spam_register_form_timezone\'] == \'1\') echo \' checked="checked"\'; ?> /></span>
								<label for="fld<?php echo $forum_page[\'fld_count\'] ?>"><?php echo $lang_fancy_stop_spam[\'Enable Timezone\'] ?></label>
							</div>
							<div class="mf-item">
								<span class="fld-input"><input type="checkbox" id="fld<?php echo ++$forum_page[\'fld_count\'] ?>" name="form[fancy_stop_spam_register_form_sfs_email]" value="1"<?php if ($forum_config[\'o_fancy_stop_spam_register_form_sfs_email\'] == \'1\') echo \' checked="checked"\'; ?> /></span>
								<label for="fld<?php echo $forum_page[\'fld_count\'] ?>"><?php echo $lang_fancy_stop_spam[\'Enable SFS Email\'] ?></label>
							</div>
							<div class="mf-item">
								<span class="fld-input"><input type="checkbox" id="fld<?php echo ++$forum_page[\'fld_count\'] ?>" name="form[fancy_stop_spam_register_form_sfs_ip]" value="1"<?php if ($forum_config[\'o_fancy_stop_spam_register_form_sfs_ip\'] == \'1\') echo \' checked="checked"\'; ?> /></span>
								<label for="fld<?php echo $forum_page[\'fld_count\'] ?>"><?php echo $lang_fancy_stop_spam[\'Enable SFS IP\'] ?></label>
							</div>
						</div>
					</fieldset>

					<!-- POST FORM -->
					<fieldset class="mf-set set<?php echo ++$forum_page[\'item_count\'] ?>">
						<legend><span><?php echo $lang_fancy_stop_spam[\'Post form\'] ?></span></legend>
						<div class="mf-box">
							<div class="mf-item">
								<span class="fld-input"><input type="checkbox" id="fld<?php echo ++$forum_page[\'fld_count\'] ?>" name="form[fancy_stop_spam_post_form_honeypot]" value="1"<?php if ($forum_config[\'o_fancy_stop_spam_post_form_honeypot\'] == \'1\') echo \' checked="checked"\'; ?> /></span>
								<label for="fld<?php echo $forum_page[\'fld_count\'] ?>"><?php echo $lang_fancy_stop_spam[\'Enable Honeypot\'] ?></label>
							</div>
						</div>
					</fieldset>

					<!-- OTHER METHOD -->
					<fieldset class="mf-set set<?php echo ++$forum_page[\'item_count\'] ?>">
						<legend><span><?php echo $lang_fancy_stop_spam[\'Other Methods\'] ?></span></legend>
						<div class="mf-box">
							<div class="mf-item">
								<span class="fld-input"><input type="checkbox" id="fld<?php echo ++$forum_page[\'fld_count\'] ?>" name="form[fancy_stop_spam_check_identical_posts]" value="1"<?php if ($forum_config[\'o_fancy_stop_spam_check_identical_posts\'] == \'1\') echo \' checked="checked"\'; ?> /></span>
								<label for="fld<?php echo $forum_page[\'fld_count\'] ?>"><?php echo $lang_fancy_stop_spam[\'Enable Check Identical\'] ?></label>
							</div>

							<div class="mf-item">
								<span class="fld-input"><input type="checkbox" id="fld<?php echo ++$forum_page[\'fld_count\'] ?>" name="form[fancy_stop_spam_check_signature]" value="1"<?php if ($forum_config[\'o_fancy_stop_spam_check_signature\'] == \'1\') echo \' checked="checked"\'; ?> /></span>
								<label for="fld<?php echo $forum_page[\'fld_count\'] ?>"><?php echo $lang_fancy_stop_spam[\'Signature Check Method\'] ?></label>
							</div>

							<div class="mf-item">
								<span class="fld-input"><input type="checkbox" id="fld<?php echo ++$forum_page[\'fld_count\'] ?>" name="form[fancy_stop_spam_check_submit]" value="1"<?php if ($forum_config[\'o_fancy_stop_spam_check_submit\'] == \'1\') echo \' checked="checked"\'; ?> /></span>
								<label for="fld<?php echo $forum_page[\'fld_count\'] ?>"><?php echo $lang_fancy_stop_spam[\'Submit Check Method\'] ?></label>
							</div>

							<div class="mf-item">
								<span class="fld-input"><input type="checkbox" id="fld<?php echo ++$forum_page[\'fld_count\'] ?>" name="form[fancy_stop_spam_use_logs]" value="1"<?php if ($forum_config[\'o_fancy_stop_spam_use_logs\'] == \'1\') echo \' checked="checked"\'; ?> /></span>
								<label for="fld<?php echo $forum_page[\'fld_count\'] ?>"><?php echo $lang_fancy_stop_spam[\'Enable Logs\'] ?></label>
							</div>
						</div>
					</fieldset>

					<!-- FIRST POST METHOD -->
					<div class="sf-set set<?php echo ++$forum_page[\'item_count\'] ?>">
						<div class="sf-box sf-short text">
							<label for="fld<?php echo ++$forum_page[\'fld_count\'] ?>"><span><?php echo $lang_fancy_stop_spam[\'First Post Max Links\'] ?></span><small><?php echo $lang_fancy_stop_spam[\'First Post Max Links Help\'] ?></small></label><br />
							<span class="fld-input"><input type="text" id="fld<?php echo $forum_page[\'fld_count\'] ?>" name="form[fancy_stop_spam_max_links]" size="3" maxlength="3" value="<?php echo forum_htmlencode($forum_config[\'o_fancy_stop_spam_max_links\']) ?>" /></span>
						</div>
					</div>
					<div class="sf-set set<?php echo ++$forum_page[\'item_count\'] ?>">
						<div class="sf-box sf-short text">
							<label for="fld<?php echo ++$forum_page[\'fld_count\'] ?>"><span><?php echo $lang_fancy_stop_spam[\'First Post Guest Max Links\'] ?></span><small><?php echo $lang_fancy_stop_spam[\'First Post Guest Max Links Help\'] ?></small></label><br />
							<span class="fld-input"><input type="text" id="fld<?php echo $forum_page[\'fld_count\'] ?>" name="form[fancy_stop_spam_max_guest_links]" size="3" maxlength="3" value="<?php echo forum_htmlencode($forum_config[\'o_fancy_stop_spam_max_guest_links\']) ?>" /></span>
						</div>
					</div>

					<!-- SFS API KEY -->
					<div class="sf-set set<?php echo ++$forum_page[\'item_count\'] ?>">
						<div class="sf-box text">
							<label for="fld<?php echo ++$forum_page[\'fld_count\'] ?>"><span><?php echo $lang_fancy_stop_spam[\'SFS API Key\'] ?></span><small><?php echo $lang_fancy_stop_spam[\'SFS API Key Help\'] ?></small></label><br />
							<span class="fld-input"><input type="text" id="fld<?php echo $forum_page[\'fld_count\'] ?>" name="form[fancy_stop_spam_sfs_api_key]" size="35" maxlength="64" value="<?php echo forum_htmlencode($forum_config[\'o_fancy_stop_spam_sfs_api_key\']) ?>" /></span>
						</div>
					</div>
				</fieldset>
		<?php

array_pop($GLOBALS[\'ext_info_stack\']);
$ext_info = empty($GLOBALS[\'ext_info_stack\']) ? array() : $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];
',
    6 => '$GLOBALS[\'ext_info_stack\'][] = array(
\'id\'				=> \'fancy_stat_counters\',
\'path\'			=> FORUM_ROOT.\'extensions/fancy_stat_counters\',
\'url\'			=> $GLOBALS[\'base_url\'].\'/extensions/fancy_stat_counters\',
\'dependencies\'	=> array (
)
);
$ext_info = $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];

if (!isset($lang_fancy_stat_counters)) {
				if ($forum_user[\'language\'] != \'English\' && file_exists($ext_info[\'path\'].\'/lang/\'.$forum_user[\'language\'].\'/\'.$ext_info[\'id\'].\'.php\')) {
					include $ext_info[\'path\'].\'/lang/\'.$forum_user[\'language\'].\'/\'.$ext_info[\'id\'].\'.php\';
				} else {
					include $ext_info[\'path\'].\'/lang/English/\'.$ext_info[\'id\'].\'.php\';
				}
			}

			$forum_page[\'group_count\'] = $forum_page[\'item_count\'] = 0;
?>
			<!-- GA -->
			<div class="content-head" id="<?php echo $ext_info[\'id\'].\'_settings\'; ?>">
				<h2 class="hn"><span><?php echo $lang_fancy_stat_counters[\'Settings Name GA\'] ?></span></h2>
			</div>

			<fieldset class="frm-group group<?php echo ++$forum_page[\'group_count\'] ?>">
				<legend class="group-legend"><span><?php echo $lang_fancy_stat_counters[\'Settings Name GA\'] ?></span></legend>

				<div class="sf-set set<?php echo ++$forum_page[\'item_count\'] ?>">
					<div class="sf-box checkbox">
						<span class="fld-input"><input type="checkbox" id="fld<?php echo ++$forum_page[\'fld_count\'] ?>" name="form[fancy_stat_counter_enable_ga]" value="1"<?php if ($forum_config[\'o_fancy_stat_counter_enable_ga\'] == \'1\') echo \' checked="checked"\'; ?> /></span>
						<label for="fld<?php echo $forum_page[\'fld_count\'] ?>"><?php echo $lang_fancy_stat_counters[\'Enabled\'] ?></label>
					</div>
				</div>

				<div class="sf-set set<?php echo ++$forum_page[\'item_count\'] ?>">
					<div class="sf-box text">
						<label for="fld<?php echo ++$forum_page[\'fld_count\'] ?>">
							<span><?php echo $lang_fancy_stat_counters[\'GA ID Name\'] ?></span>
							<small><?php echo $lang_fancy_stat_counters[\'GA ID Help\'] ?></small>
						</label><br/>
						<span class="fld-input">
							<input type="text" id="fld<?php echo $forum_page[\'fld_count\'] ?>" name="form[fancy_stat_counter_id_ga]" size="20" maxlength="20" value="<?php echo forum_htmlencode($forum_config[\'o_fancy_stat_counter_id_ga\']) ?>"/>
						</span>
					</div>
				</div>
			</fieldset>

<?php
			$forum_page[\'group_count\'] = $forum_page[\'item_count\'] = 0;
?>
			<!-- YM -->

			<div class="content-head" id="<?php echo $ext_info[\'id\'].\'_settings\'; ?>">
				<h2 class="hn"><span><?php echo $lang_fancy_stat_counters[\'Settings Name YM\'] ?></span></h2>
			</div>

			<fieldset class="frm-group group<?php echo ++$forum_page[\'group_count\'] ?>">
				<legend class="group-legend"><span><?php echo $lang_fancy_stat_counters[\'Settings Name YM\'] ?></span></legend>

				<div class="sf-set set<?php echo ++$forum_page[\'item_count\'] ?>">
					<div class="sf-box checkbox">
						<span class="fld-input"><input type="checkbox" id="fld<?php echo ++$forum_page[\'fld_count\'] ?>" name="form[fancy_stat_counter_enable_ym]" value="1"<?php if ($forum_config[\'o_fancy_stat_counter_enable_ym\'] == \'1\') echo \' checked="checked"\'; ?> /></span>
						<label for="fld<?php echo $forum_page[\'fld_count\'] ?>"><?php echo $lang_fancy_stat_counters[\'Enabled\'] ?></label>
					</div>
				</div>

				<div class="sf-set set<?php echo ++$forum_page[\'item_count\'] ?>">
					<div class="sf-box text">
						<label for="fld<?php echo ++$forum_page[\'fld_count\'] ?>">
							<span><?php echo $lang_fancy_stat_counters[\'YM ID Name\'] ?></span>
							<small><?php echo $lang_fancy_stat_counters[\'YM ID Help\'] ?></small>
						</label><br/>
						<span class="fld-input">
							<input type="text" id="fld<?php echo $forum_page[\'fld_count\'] ?>" name="form[fancy_stat_counter_id_ym]" size="20" maxlength="20" value="<?php echo forum_htmlencode($forum_config[\'o_fancy_stat_counter_id_ym\']) ?>"/>
						</span>
					</div>
				</div>
			</fieldset>
<?php

array_pop($GLOBALS[\'ext_info_stack\']);
$ext_info = empty($GLOBALS[\'ext_info_stack\']) ? array() : $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];
',
    7 => '$GLOBALS[\'ext_info_stack\'][] = array(
\'id\'				=> \'last_topic_title_on_forum_index\',
\'path\'			=> FORUM_ROOT.\'extensions/last_topic_title_on_forum_index\',
\'url\'			=> $GLOBALS[\'base_url\'].\'/extensions/last_topic_title_on_forum_index\',
\'dependencies\'	=> array (
)
);
$ext_info = $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];

if (!isset($lang_last_topic_title_on_forum_index)) {
				if ($forum_user[\'language\'] != \'English\' && file_exists($ext_info[\'path\'].\'/lang/\'.$forum_user[\'language\'].\'/\'.$ext_info[\'id\'].\'.php\')) {
					require $ext_info[\'path\'].\'/lang/\'.$forum_user[\'language\'].\'/\'.$ext_info[\'id\'].\'.php\';
				} else {
					require $ext_info[\'path\'].\'/lang/English/\'.$ext_info[\'id\'].\'.php\';
				}
			}

			$forum_page[\'group_count\'] = $forum_page[\'item_count\'] = 0;
?>

			<div class="content-head" id="<?php echo $ext_info[\'id\'].\'_settings\'; ?>">
				<h2 class="hn"><span><?php echo $lang_last_topic_title_on_forum_index[\'Name\'] ?></span></h2>
			</div>
			<fieldset class="frm-group group<?php echo ++$forum_page[\'group_count\'] ?>">
				<legend class="group-legend"><span><?php echo $lang_last_topic_title_on_forum_index[\'Name\'] ?></span></legend>
				<div class="sf-set set<?php echo ++$forum_page[\'item_count\'] ?>">
					<div class="sf-box select">
						<label for="fld<?php echo ++$forum_page[\'fld_count\'] ?>">
							<span><?php echo $lang_last_topic_title_on_forum_index[\'Select Mode\'] ?></span>
						</label><br/>
						<span class="fld-input">
							<select id="fld<?php echo $forum_page[\'fld_count\'] ?>" name="form[last_topic_title_mode]">
							<?php
								$last_topic_title_modes = array(1, 2);
								foreach ($last_topic_title_modes as $ltt_mode) {
									if ($forum_config[\'o_last_topic_title_mode\'] == $ltt_mode) {
										echo "\\t\\t\\t\\t\\t\\t\\t\\t".\'<option value="\'.$ltt_mode.\'" selected="selected">\'.$lang_last_topic_title_on_forum_index["Mode_{$ltt_mode}"].\'</option>\'."\\n";
									} else {
										echo "\\t\\t\\t\\t\\t\\t\\t\\t".\'<option value="\'.$ltt_mode.\'">\'.$lang_last_topic_title_on_forum_index["Mode_{$ltt_mode}"].\'</option>\'."\\n";
									}
								}
							?>
							</select>
						</span>
					</div>
				</div>
				<div class="sf-set set<?php echo ++$forum_page[\'item_count\'] ?>">
					<div class="sf-box sf-short text">
						<label for="fld<?php echo ++$forum_page[\'fld_count\'] ?>"><span><?php echo $lang_last_topic_title_on_forum_index[\'Input\'] ?></span></label><br/>
						<span class="fld-input"><input type="text" id="fld<?php echo $forum_page[\'fld_count\'] ?>" name="form[max_last_topic_title_length]" size="3" maxlength="3" value="<?php echo $forum_config[\'o_max_last_topic_title_length\'] ?>" /></span>
					</div>
				</div>
			</fieldset>
<?php

array_pop($GLOBALS[\'ext_info_stack\']);
$ext_info = empty($GLOBALS[\'ext_info_stack\']) ? array() : $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];
',
  ),
  'es_essentials' => 
  array (
    0 => '$GLOBALS[\'ext_info_stack\'][] = array(
\'id\'				=> \'fancy_alerts\',
\'path\'			=> FORUM_ROOT.\'extensions/fancy_alerts\',
\'url\'			=> $GLOBALS[\'base_url\'].\'/extensions/fancy_alerts\',
\'dependencies\'	=> array (
)
);
$ext_info = $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];

include $ext_info[\'path\'].\'/functions.inc.php\';

array_pop($GLOBALS[\'ext_info_stack\']);
$ext_info = empty($GLOBALS[\'ext_info_stack\']) ? array() : $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];
',
    1 => '$GLOBALS[\'ext_info_stack\'][] = array(
\'id\'				=> \'pun_jquery\',
\'path\'			=> FORUM_ROOT.\'extensions/pun_jquery\',
\'url\'			=> $GLOBALS[\'base_url\'].\'/extensions/pun_jquery\',
\'dependencies\'	=> array (
)
);
$ext_info = $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];

define(\'PUN_JQUERY_INCLUDE_METHOD_LOCAL\', 0);
			define(\'PUN_JQUERY_INCLUDE_METHOD_GOOGLE_CDN\', 1);
			define(\'PUN_JQUERY_INCLUDE_METHOD_MICROSOFT_CDN\', 2);
			define(\'PUN_JQUERY_INCLUDE_METHOD_JQUERY_CDN\', 3);

			define(\'PUN_JQUERY_VERSION\', \'1.7.1\');

array_pop($GLOBALS[\'ext_info_stack\']);
$ext_info = empty($GLOBALS[\'ext_info_stack\']) ? array() : $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];
',
    2 => '$GLOBALS[\'ext_info_stack\'][] = array(
\'id\'				=> \'fancy_js_cache\',
\'path\'			=> FORUM_ROOT.\'extensions/fancy_js_cache\',
\'url\'			=> $GLOBALS[\'base_url\'].\'/extensions/fancy_js_cache\',
\'dependencies\'	=> array (
)
);
$ext_info = $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];

define(\'FANCY_JS_CACHE_DIR\',  $ext_info[\'path\'].\'/cache/\');

			function fancy_js_cacher_clear_css_cache() {
				$d = dir(FANCY_JS_CACHE_DIR);

				if ($d) {
					while (($entry = $d->read()) !== FALSE) {
						if (substr($entry, strlen($entry) - 4) == \'.css\') {
							@unlink(FANCY_JS_CACHE_DIR.$entry);
						}
					}
					$d->close();
				}
				unset($d);
			}

			function fancy_js_cacher_clear_cache() {
				global $forum_db, $forum_config;

				fancy_js_cacher_clear_css_cache();

				$new_index = intval($forum_config[\'o_fancy_js_cache_index\'], 10) + 2;

				$query = array(
					\'UPDATE\'	=> \'config\',
					\'SET\'		=> \'conf_value = \'.$new_index,
					\'WHERE\'		=> \'conf_name = \\\'o_fancy_js_cache_index\\\'\'
				);
				$forum_db->query_build($query) or error(__FILE__, __LINE__);

				if (!defined(\'FORUM_CACHE_FUNCTIONS_LOADED\')) {
					require FORUM_ROOT.\'include/cache.php\';
				}

				// update cache
				generate_config_cache();
			}

array_pop($GLOBALS[\'ext_info_stack\']);
$ext_info = empty($GLOBALS[\'ext_info_stack\']) ? array() : $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];
',
    3 => '$GLOBALS[\'ext_info_stack\'][] = array(
\'id\'				=> \'fancy_simtopics\',
\'path\'			=> FORUM_ROOT.\'extensions/fancy_simtopics\',
\'url\'			=> $GLOBALS[\'base_url\'].\'/extensions/fancy_simtopics\',
\'dependencies\'	=> array (
)
);
$ext_info = $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];

include $ext_info[\'path\'].\'/functions.inc.php\';

array_pop($GLOBALS[\'ext_info_stack\']);
$ext_info = empty($GLOBALS[\'ext_info_stack\']) ? array() : $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];
',
  ),
  'fn_delete_post_end' => 
  array (
    0 => '$GLOBALS[\'ext_info_stack\'][] = array(
\'id\'				=> \'fancy_alerts\',
\'path\'			=> FORUM_ROOT.\'extensions/fancy_alerts\',
\'url\'			=> $GLOBALS[\'base_url\'].\'/extensions/fancy_alerts\',
\'dependencies\'	=> array (
)
);
$ext_info = $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];

$fancy_alerts = new Fancy_alerts;
				$fancy_alerts->del_post_alerts($post_id);

array_pop($GLOBALS[\'ext_info_stack\']);
$ext_info = empty($GLOBALS[\'ext_info_stack\']) ? array() : $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];
',
  ),
  'fancy_merge_posts_pre_return' => 
  array (
    0 => '$GLOBALS[\'ext_info_stack\'][] = array(
\'id\'				=> \'fancy_alerts\',
\'path\'			=> FORUM_ROOT.\'extensions/fancy_alerts\',
\'url\'			=> $GLOBALS[\'base_url\'].\'/extensions/fancy_alerts\',
\'dependencies\'	=> array (
)
);
$ext_info = $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];

$fancy_alerts = new Fancy_alerts;
				$fancy_alerts->update_topic_alerts($post_info[\'topic_id\'], 0, $post_info[\'posted\'], $post_info[\'poster_id\']);

				// UPDATE POST ALERTS
				$fancy_alerts->update_quote_alerts($post_info[\'topic_id\'], $fancy_merge_posts_prev_post[\'post_id\'], $fancy_merge_posts_prev_post[\'message\']."\\n".$post_info[\'message\']);

array_pop($GLOBALS[\'ext_info_stack\']);
$ext_info = empty($GLOBALS[\'ext_info_stack\']) ? array() : $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];
',
  ),
  'fn_qr_update_topic2' => 
  array (
    0 => '$GLOBALS[\'ext_info_stack\'][] = array(
\'id\'				=> \'fancy_alerts\',
\'path\'			=> FORUM_ROOT.\'extensions/fancy_alerts\',
\'url\'			=> $GLOBALS[\'base_url\'].\'/extensions/fancy_alerts\',
\'dependencies\'	=> array (
)
);
$ext_info = $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];

if ($last_id == $post_id) {
					$fancy_alerts = new Fancy_alerts;
					$fancy_alerts->update_topic_alerts_on_delete_last_post($topic_id, $second_last_id, $second_posted);
				}

array_pop($GLOBALS[\'ext_info_stack\']);
$ext_info = empty($GLOBALS[\'ext_info_stack\']) ? array() : $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];
',
  ),
  'se_additional_quicksearch_variables' => 
  array (
    0 => '$GLOBALS[\'ext_info_stack\'][] = array(
\'id\'				=> \'fancy_alerts\',
\'path\'			=> FORUM_ROOT.\'extensions/fancy_alerts\',
\'url\'			=> $GLOBALS[\'base_url\'].\'/extensions/fancy_alerts\',
\'dependencies\'	=> array (
)
);
$ext_info = $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];

if ($action == \'fancy_alerts_topics_show\') {
				define(\'FORUM_PAGE_FANCY_ALERTS_TOPICS\', TRUE);

				$value = isset($_GET[\'user_id\']) ? intval($_GET[\'user_id\'], 10) : 0;
				if ($value < 2) {
					message($lang_common[\'Bad request\']);
				}
			}

			if ($action == \'fancy_alerts_quotes_show\') {
				define(\'FORUM_PAGE_FANCY_ALERTS_POSTS\', TRUE);

				$value = isset($_GET[\'user_id\']) ? intval($_GET[\'user_id\'], 10) : 0;
				if ($value < 2) {
					message($lang_common[\'Bad request\']);
				}
			}

			if ($action == \'show_fancy_alerts_my_topics\') {
				define(\'FORUM_PAGE_FANCY_ALERTS_MY_TOPICS\', TRUE);

				$value = isset($_GET[\'user_id\']) ? intval($_GET[\'user_id\'], 10) : 0;
				if ($value < 2) {
					message($lang_common[\'Bad request\']);
				}
			}

array_pop($GLOBALS[\'ext_info_stack\']);
$ext_info = empty($GLOBALS[\'ext_info_stack\']) ? array() : $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];
',
  ),
  'sf_fn_generate_search_crumbs_start' => 
  array (
    0 => '$GLOBALS[\'ext_info_stack\'][] = array(
\'id\'				=> \'fancy_alerts\',
\'path\'			=> FORUM_ROOT.\'extensions/fancy_alerts\',
\'url\'			=> $GLOBALS[\'base_url\'].\'/extensions/fancy_alerts\',
\'dependencies\'	=> array (
)
);
$ext_info = $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];

//
				if ($action == \'fancy_alerts_topics_show\') {
					if (!isset($lang_fancy_alerts)) {
						if (file_exists($ext_info[\'path\'].\'/lang/\'.$forum_user[\'language\'].\'/\'.$ext_info[\'id\'].\'.php\')) {
							require $ext_info[\'path\'].\'/lang/\'.$forum_user[\'language\'].\'/\'.$ext_info[\'id\'].\'.php\';
						} else {
							require $ext_info[\'path\'].\'/lang/English/\'.$ext_info[\'id\'].\'.php\';
						}
					}

					$forum_page[\'crumbs\'][] = $lang_fancy_alerts[\'Your Alerts Topics\'];
					$forum_page[\'items_info\'] = generate_items_info($lang_fancy_alerts[\'Your Alerts Topics\'], ($forum_page[\'start_from\'] + 1), $num_hits);
					$forum_page[\'main_foot_options\'][\'fancy_alerts_mark_topics_readed\'] = \'<span\'.(empty($forum_page[\'main_foot_options\']) ? \' class="first-item"\' : \'\').\'><a href="\'.forum_link($forum_url[\'fancy_alerts_topics_mark_read\'], generate_form_token(\'fancy_alerts_topics_mark_read\'.$forum_user[\'id\'])).\'">\'.$lang_fancy_alerts[\'Mark all topics as read\'].\'</a></span>\';

					return TRUE;
				}

				//
				if ($action == \'fancy_alerts_quotes_show\') {
					if (!isset($lang_fancy_alerts)) {
						if (file_exists($ext_info[\'path\'].\'/lang/\'.$forum_user[\'language\'].\'/\'.$ext_info[\'id\'].\'.php\')) {
							require $ext_info[\'path\'].\'/lang/\'.$forum_user[\'language\'].\'/\'.$ext_info[\'id\'].\'.php\';
						} else {
							require $ext_info[\'path\'].\'/lang/English/\'.$ext_info[\'id\'].\'.php\';
						}
					}

					$forum_page[\'crumbs\'][] = $lang_fancy_alerts[\'Your Alerts Quotes\'];
					$forum_page[\'items_info\'] = generate_items_info($lang_fancy_alerts[\'Your Alerts Quotes\'], ($forum_page[\'start_from\'] + 1), $num_hits);
					$forum_page[\'main_foot_options\'][\'fancy_alerts_mark_quotes_readed\'] = \'<span\'.(empty($forum_page[\'main_foot_options\']) ? \' class="first-item"\' : \'\').\'><a href="\'.forum_link($forum_url[\'fancy_alerts_quotes_mark_read\'], generate_form_token(\'fancy_alerts_quotes_mark_read\'.$forum_user[\'id\'])).\'">\'.$lang_fancy_alerts[\'Mark all quotes as read\'].\'</a></span>\';

					return TRUE;
				}

				//
				if ($action == \'show_fancy_alerts_my_topics\') {
					if (!isset($lang_fancy_alerts)) {
						if (file_exists($ext_info[\'path\'].\'/lang/\'.$forum_user[\'language\'].\'/\'.$ext_info[\'id\'].\'.php\')) {
							require $ext_info[\'path\'].\'/lang/\'.$forum_user[\'language\'].\'/\'.$ext_info[\'id\'].\'.php\';
						} else {
							require $ext_info[\'path\'].\'/lang/English/\'.$ext_info[\'id\'].\'.php\';
						}
					}

					$forum_page[\'crumbs\'][] = $lang_fancy_alerts[\'Search Alerts Topics\'];
					$forum_page[\'items_info\'] = generate_items_info($lang_fancy_alerts[\'Your Alerts Quotes\'], ($forum_page[\'start_from\'] + 1), $num_hits);

					return TRUE;
				}

array_pop($GLOBALS[\'ext_info_stack\']);
$ext_info = empty($GLOBALS[\'ext_info_stack\']) ? array() : $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];
',
  ),
  'vt_qr_get_post_page' => 
  array (
    0 => '$GLOBALS[\'ext_info_stack\'][] = array(
\'id\'				=> \'fancy_alerts\',
\'path\'			=> FORUM_ROOT.\'extensions/fancy_alerts\',
\'url\'			=> $GLOBALS[\'base_url\'].\'/extensions/fancy_alerts\',
\'dependencies\'	=> array (
)
);
$ext_info = $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];

if (!$forum_user[\'is_guest\']) {
					$fancy_alerts = new Fancy_alerts;
					$fancy_alerts->mark_quotes_as_readed(array($pid), $forum_user[\'id\']);
				}

array_pop($GLOBALS[\'ext_info_stack\']);
$ext_info = empty($GLOBALS[\'ext_info_stack\']) ? array() : $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];
',
  ),
  'rg_register_pre_login_redirect' => 
  array (
    0 => '$GLOBALS[\'ext_info_stack\'][] = array(
\'id\'				=> \'fancy_gravatar\',
\'path\'			=> FORUM_ROOT.\'extensions/fancy_gravatar\',
\'url\'			=> $GLOBALS[\'base_url\'].\'/extensions/fancy_gravatar\',
\'dependencies\'	=> array (
)
);
$ext_info = $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];

if ($forum_config[\'o_regs_verify\'] == \'0\') {
				include $ext_info[\'path\'].\'/fancy_gravatar.inc.php\';

				try {
					$fancy_gravatar = new Fancy_gravatar($new_uid, $email1);
					$fancy_gravatar->fetch_gravatar();
				} catch (Exception $exception) {}
			}

array_pop($GLOBALS[\'ext_info_stack\']);
$ext_info = empty($GLOBALS[\'ext_info_stack\']) ? array() : $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];
',
  ),
  'li_login_pre_redirect' => 
  array (
    0 => '$GLOBALS[\'ext_info_stack\'][] = array(
\'id\'				=> \'fancy_gravatar\',
\'path\'			=> FORUM_ROOT.\'extensions/fancy_gravatar\',
\'url\'			=> $GLOBALS[\'base_url\'].\'/extensions/fancy_gravatar\',
\'dependencies\'	=> array (
)
);
$ext_info = $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];

if ($group_id == FORUM_UNVERIFIED) {
				// Get user email
				$fancy_gravatar_query = array(
					\'SELECT\'	=> \'u.email\',
					\'FROM\'		=> \'users AS u\',
					\'WHERE\'		=> \'u.id=\'.$user_id
				);
				$fancy_gravatar_query_result = $forum_db->query_build($fancy_gravatar_query) or error(__FILE__, __LINE__);
				$fancy_gravatar_user_email = $forum_db->result($fancy_gravatar_query_result);

				if (!empty($fancy_gravatar_user_email)) {
					include $ext_info[\'path\'].\'/fancy_gravatar.inc.php\';

					try {
						$fancy_gravatar = new Fancy_gravatar($user_id, $fancy_gravatar_user_email);
						$fancy_gravatar->fetch_gravatar();
					} catch (Exception $exception) {}
				}
			}

array_pop($GLOBALS[\'ext_info_stack\']);
$ext_info = empty($GLOBALS[\'ext_info_stack\']) ? array() : $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];
',
  ),
  'ch_fn_generate_hooks_cache_start' => 
  array (
    0 => '$GLOBALS[\'ext_info_stack\'][] = array(
\'id\'				=> \'fancy_js_cache\',
\'path\'			=> FORUM_ROOT.\'extensions/fancy_js_cache\',
\'url\'			=> $GLOBALS[\'base_url\'].\'/extensions/fancy_js_cache\',
\'dependencies\'	=> array (
)
);
$ext_info = $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];

fancy_js_cacher_clear_cache();

array_pop($GLOBALS[\'ext_info_stack\']);
$ext_info = empty($GLOBALS[\'ext_info_stack\']) ? array() : $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];
',
  ),
  'afo_edit_forum_qr_get_forum_details' => 
  array (
    0 => '$GLOBALS[\'ext_info_stack\'][] = array(
\'id\'				=> \'fancy_simtopics\',
\'path\'			=> FORUM_ROOT.\'extensions/fancy_simtopics\',
\'url\'			=> $GLOBALS[\'base_url\'].\'/extensions/fancy_simtopics\',
\'dependencies\'	=> array (
)
);
$ext_info = $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];

$query[\'SELECT\'] .= \', f.fancy_simtopics_show, f.fancy_simtopics_search\';

array_pop($GLOBALS[\'ext_info_stack\']);
$ext_info = empty($GLOBALS[\'ext_info_stack\']) ? array() : $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];
',
  ),
  'afo_edit_forum_details_fieldset_end' => 
  array (
    0 => '$GLOBALS[\'ext_info_stack\'][] = array(
\'id\'				=> \'fancy_simtopics\',
\'path\'			=> FORUM_ROOT.\'extensions/fancy_simtopics\',
\'url\'			=> $GLOBALS[\'base_url\'].\'/extensions/fancy_simtopics\',
\'dependencies\'	=> array (
)
);
$ext_info = $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];

if (!isset($lang_fancy_simtopics)) {
					if (file_exists($ext_info[\'path\'].\'/lang/\'.$forum_user[\'language\'].\'/\'.$ext_info[\'id\'].\'.php\')) {
						require $ext_info[\'path\'].\'/lang/\'.$forum_user[\'language\'].\'/\'.$ext_info[\'id\'].\'.php\';
					} else {
						require $ext_info[\'path\'].\'/lang/English/\'.$ext_info[\'id\'].\'.php\';
					}
				}

				$fancy_simtopics_show_checkbox_value = (intval($cur_forum[\'fancy_simtopics_show\'], 10) === 1) ? \'value="1" checked="checked"\' : \'value="0"\';
				$fancy_simtopics_search_checkbox_value = (intval($cur_forum[\'fancy_simtopics_search\'], 10) === 1) ? \'value="1" checked="checked"\' : \'value="0"\';

				$forum_page[\'group_count\'] = $forum_page[\'item_count\'] = 0;
			?>
				<div class="content-head">
					<h3 class="hn"><span><?php echo $lang_fancy_simtopics[\'Edit forum settings head\']; ?></span></h3>
				</div>
				<fieldset class="frm-group group<?php echo ++$forum_page[\'group_count\'] ?>">
					<legend class="group-legend"><strong><?php echo $lang_fancy_simtopics[\'Edit forum settings legend\']; ?></strong></legend>
					<div class="sf-set set<?php echo ++$forum_page[\'item_count\'] ?>">
						<div class="sf-box checkbox">
							<label for="fld<?php echo ++$forum_page[\'fld_count\'] ?>"><span><?php echo $lang_fancy_simtopics[\'Forum Settings Show\'] ?></span></label><br />
							<span class="fld-input"><?php echo \'<input type="checkbox" id="fld\'.$forum_page[\'fld_count\'].\'" name="fancy_simtopics_show"\'.$fancy_simtopics_show_checkbox_value.\'/>\'; ?></span>
						</div>
					</div>

					<div class="sf-set set<?php echo ++$forum_page[\'item_count\'] ?>">
						<div class="sf-box checkbox">
							<label for="fld<?php echo ++$forum_page[\'fld_count\'] ?>"><span><?php echo $lang_fancy_simtopics[\'Forum Settings Search\'] ?></span></label><br />
							<span class="fld-input"><?php echo \'<input type="checkbox" id="fld\'.$forum_page[\'fld_count\'].\'" name="fancy_simtopics_search"\'.$fancy_simtopics_search_checkbox_value.\'/>\'; ?></span>
						</div>
					</div>
				</fieldset>
			<?php

array_pop($GLOBALS[\'ext_info_stack\']);
$ext_info = empty($GLOBALS[\'ext_info_stack\']) ? array() : $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];
',
  ),
  'afo_save_forum_form_submitted' => 
  array (
    0 => '$GLOBALS[\'ext_info_stack\'][] = array(
\'id\'				=> \'fancy_simtopics\',
\'path\'			=> FORUM_ROOT.\'extensions/fancy_simtopics\',
\'url\'			=> $GLOBALS[\'base_url\'].\'/extensions/fancy_simtopics\',
\'dependencies\'	=> array (
)
);
$ext_info = $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];

$fancy_simtopics_show = (isset($_POST[\'fancy_simtopics_show\']) ? 1 : 0);
			$fancy_simtopics_search = (isset($_POST[\'fancy_simtopics_search\']) ? 1 : 0);

array_pop($GLOBALS[\'ext_info_stack\']);
$ext_info = empty($GLOBALS[\'ext_info_stack\']) ? array() : $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];
',
  ),
  'afo_save_forum_qr_update_forum' => 
  array (
    0 => '$GLOBALS[\'ext_info_stack\'][] = array(
\'id\'				=> \'fancy_simtopics\',
\'path\'			=> FORUM_ROOT.\'extensions/fancy_simtopics\',
\'url\'			=> $GLOBALS[\'base_url\'].\'/extensions/fancy_simtopics\',
\'dependencies\'	=> array (
)
);
$ext_info = $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];

$query[\'SET\'] .= \', fancy_simtopics_show=\'.$fancy_simtopics_show;
			$query[\'SET\'] .= \', fancy_simtopics_search=\'.$fancy_simtopics_search;

array_pop($GLOBALS[\'ext_info_stack\']);
$ext_info = empty($GLOBALS[\'ext_info_stack\']) ? array() : $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];
',
  ),
  'pf_change_details_modify_main_menu' => 
  array (
    0 => '$GLOBALS[\'ext_info_stack\'][] = array(
\'id\'				=> \'fancy_stop_spam\',
\'path\'			=> FORUM_ROOT.\'extensions/fancy_stop_spam\',
\'url\'			=> $GLOBALS[\'base_url\'].\'/extensions/fancy_stop_spam\',
\'dependencies\'	=> array (
)
);
$ext_info = $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];

if ($forum_config[\'o_fancy_stop_spam_check_signature\'] == \'1\' && $forum_config[\'o_signatures\'] == \'1\') {
				if ($forum_user[\'num_posts\'] < Fancy_stop_spam::NUMBER_POSTS_FOR_SIGNATURE) {
					// HIDE SIGNATURE LINK
					if (isset($forum_page[\'main_menu\'][\'signature\'])) {
						$forum_page[\'main_menu\'][\'signature\'] = \'<li\'.(($section == \'signature\') ? \' class="active hidden"\' : \'\').\' style="display: none;"><a href="\'.forum_link($forum_url[\'profile_signature\'], $id).\'"><span>\'.$lang_profile[\'Section signature\'].\'</span></a></li>\';
					}
				}
			}

			// ADD Antispam section to user profile
			if ($forum_user[\'g_id\'] == FORUM_ADMIN) {
				if (isset($forum_page[\'main_menu\'][\'admin\'])) {
					array_insert($forum_page[\'main_menu\'],
						\'admin\',
						\'<li\'.(($section == \'fancy_stop_spam_profile_section\') ?
						\' class="active"\'
						: \'\').\'><a href="\'.forum_link($forum_url[\'fancy_stop_spam_profile_section\'], $id).\'">
						<span>\'.$lang_fancy_stop_spam[\'Section antispam\'].\'</span>
					</a></li>\', \'fancy_stop_spam_profile_section\');
				}
			}

array_pop($GLOBALS[\'ext_info_stack\']);
$ext_info = empty($GLOBALS[\'ext_info_stack\']) ? array() : $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];
',
  ),
  'pf_change_details_signature_validation' => 
  array (
    0 => '$GLOBALS[\'ext_info_stack\'][] = array(
\'id\'				=> \'fancy_stop_spam\',
\'path\'			=> FORUM_ROOT.\'extensions/fancy_stop_spam\',
\'url\'			=> $GLOBALS[\'base_url\'].\'/extensions/fancy_stop_spam\',
\'dependencies\'	=> array (
)
);
$ext_info = $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];

if ($forum_config[\'o_fancy_stop_spam_check_signature\'] == \'1\') {
				if ($forum_user[\'num_posts\'] < Fancy_stop_spam::NUMBER_POSTS_FOR_SIGNATURE) {
					$fancy_stop_spam = Fancy_stop_spam::singleton();
					$fancy_stop_spam->log(Fancy_stop_spam::LOG_SIGNATURE_HIDDEN, $forum_user[\'id\'], get_remote_address());
					$fancy_stop_spam->mark_user_as_spammer($forum_user[\'id\']);
				}
			}

array_pop($GLOBALS[\'ext_info_stack\']);
$ext_info = empty($GLOBALS[\'ext_info_stack\']) ? array() : $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];
',
  ),
  'pf_change_details_new_section' => 
  array (
    0 => '$GLOBALS[\'ext_info_stack\'][] = array(
\'id\'				=> \'fancy_stop_spam\',
\'path\'			=> FORUM_ROOT.\'extensions/fancy_stop_spam\',
\'url\'			=> $GLOBALS[\'base_url\'].\'/extensions/fancy_stop_spam\',
\'dependencies\'	=> array (
)
);
$ext_info = $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];

if ($section == \'fancy_stop_spam_profile_section\') {
				if ($forum_user[\'g_id\'] != FORUM_ADMIN) {
					message($lang_common[\'Bad request\']);
				}

				$forum_page[\'group_count\'] = $forum_page[\'item_count\'] = 0;

				// Setup breadcrumbs
				$forum_page[\'crumbs\'] = array(
					array($forum_config[\'o_board_title\'], forum_link($forum_url[\'index\'])),
					array(sprintf($lang_profile[\'Users profile\'], $user[\'username\']), forum_link($forum_url[\'user\'], $id)),
					$lang_fancy_stop_spam[\'Section antispam\'],
				);

				define(\'FORUM_PAGE\', \'profile-fancy_stop_spam_profile_section\');
				require FORUM_ROOT.\'header.php\';
				ob_start();
?>
				<div class="main-subhead">
					<h2 class="hn">
						<span><?php printf(($forum_user[\'id\'] == $id) ?
							$lang_fancy_stop_spam[\'Section antispam welcome\'] :
							$lang_fancy_stop_spam[\'Section antispam welcome user\'], forum_htmlencode($user[\'username\'])) ?>
						</span>
					</h2>
				</div>
				<div class="main-content main-frm">
					<div class="ct-group">
						<?php
							$fancy_stop_spam = Fancy_stop_spam::singleton();
							$fancy_stop_spam->print_user_status($user);
						?>
					</div>
					<?php
				        echo $fancy_stop_spam->print_logs($user[\'id\']);
					?>
				</div>
<?php
				$tpl_temp = forum_trim(ob_get_contents());
				$tpl_main = str_replace(\'<!-- forum_main -->\', $tpl_temp, $tpl_main);
				ob_end_clean();
				require FORUM_ROOT.\'footer.php\';
			}

array_pop($GLOBALS[\'ext_info_stack\']);
$ext_info = empty($GLOBALS[\'ext_info_stack\']) ? array() : $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];
',
  ),
  'rg_register_end_validation' => 
  array (
    0 => '$GLOBALS[\'ext_info_stack\'][] = array(
\'id\'				=> \'fancy_stop_spam\',
\'path\'			=> FORUM_ROOT.\'extensions/fancy_stop_spam\',
\'url\'			=> $GLOBALS[\'base_url\'].\'/extensions/fancy_stop_spam\',
\'dependencies\'	=> array (
)
);
$ext_info = $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];

if (empty($errors)) {
				if ($forum_config[\'o_fancy_stop_spam_register_form_sfs_email\'] == \'1\' || $forum_config[\'o_fancy_stop_spam_register_form_sfs_ip\'] == \'1\') {
			 		$fancy_stop_spam = Fancy_stop_spam::singleton();
    				$fancy_stop_spam->check_by_sfs($errors, array(\'email\' => $email1, \'ip\'	=> get_remote_address()));
				}
			}

array_pop($GLOBALS[\'ext_info_stack\']);
$ext_info = empty($GLOBALS[\'ext_info_stack\']) ? array() : $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];
',
    1 => '$GLOBALS[\'ext_info_stack\'][] = array(
\'id\'				=> \'pun_stop_bots\',
\'path\'			=> FORUM_ROOT.\'extensions/pun_stop_bots\',
\'url\'			=> $GLOBALS[\'base_url\'].\'/extensions/pun_stop_bots\',
\'dependencies\'	=> array (
)
);
$ext_info = $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];

if (empty($errors))
			{
				include $ext_info[\'path\'].\'/functions.php\';
				if (file_exists(FORUM_CACHE_DIR.\'cache_pun_stop_bots.php\'))
					include FORUM_CACHE_DIR.\'cache_pun_stop_bots.php\';

				if (!defined(\'PUN_STOP_BOTS_CACHE_LOADED\') || $pun_stop_bots_questions[\'cached\'] < (time() - 43200))
				{
					pun_stop_bots_generate_cache();
					require FORUM_CACHE_DIR.\'cache_pun_stop_bots.php\';
				}

				if (file_exists($ext_info[\'path\'].\'/lang/\'.$forum_user[\'language\'].\'/\'.$ext_info[\'id\'].\'.php\'))
					include $ext_info[\'path\'].\'/lang/\'.$forum_user[\'language\'].\'/\'.$ext_info[\'id\'].\'.php\';
				else
					include $ext_info[\'path\'].\'/lang/English/\'.$ext_info[\'id\'].\'.php\';

				$pun_stop_bots_true_answer = FALSE;
				if (isset($_POST[\'pun_stop_bots_submit\']))
				{
					$query = array(
						\'SELECT\'	=>	\'pun_stop_bots_question_id\',
						\'FROM\'		=>	\'online\',
						\'WHERE\'		=>	\'ident = \\\'\'.$forum_user[\'ident\'].\'\\\'\'
					);
					$result = $forum_db->query_build($query) or error(__FILE__, __LINE__);
					$row = $forum_db->fetch_assoc($result);

					if ($row)
						$question_id = $row[\'pun_stop_bots_question_id\'];
					else
						message($lang_common[\'Bad request\']);

					$answer = isset($_POST[\'pun_stop_bots_answer\']) ? forum_trim(strtolower($_POST[\'pun_stop_bots_answer\'])) : null;
					if (!empty($answer))
						$pun_stop_bots_true_answer = pun_stop_bots_compare_answers($answer, $question_id);
					else
						$pun_stop_bots_true_answer = FALSE;

					if (!$pun_stop_bots_true_answer)
					{
						$new_question_id = pun_stop_bots_generate_guest_question_id();
					}
					else
					{
						$query = array(
							\'UPDATE\'	=>	\'online\',
							\'SET\'		=>	\'pun_stop_bots_question_id = NULL\',
							\'WHERE\'		=>	\'ident = \\\'\'.$forum_user[\'ident\'].\'\\\'\'
						);
						$forum_db->query_build($query) or error(__FILE__, __LINE__);
					}
				}

				if (!$pun_stop_bots_true_answer)
				{
					if (!isset($new_question_id))
						$new_question_id = pun_stop_bots_generate_guest_question_id();

					$forum_page[\'crumbs\'] = array(
						array($forum_config[\'o_board_title\'], forum_link($forum_url[\'index\'])),
						$lang_pun_stop_bots[\'Stop bots question legend\']
					);

					$forum_page[\'form_handler\'] = $_SERVER[\'REQUEST_URI\'];
					$forum_page[\'question\'] = $pun_stop_bots_questions[\'questions\'][$new_question_id][\'question\'];
					$forum_page[\'hidden_fields\'] = $_POST;
					define(\'FORUM_PAGE\', \'PUN_STOP_BOTS_PAGE\');
					require FORUM_ROOT.\'header.php\';

					// START SUBST - <!-- forum_main -->
					ob_start();

					include $ext_info[\'path\'].\'/views/question_page.php\';

					$tpl_temp = forum_trim(ob_get_contents());
					$tpl_main = str_replace(\'<!-- forum_main -->\', $tpl_temp, $tpl_main);
					ob_end_clean();
					// END SUBST - <!-- forum_main -->

					require FORUM_ROOT.\'footer.php\';
				}
			}

array_pop($GLOBALS[\'ext_info_stack\']);
$ext_info = empty($GLOBALS[\'ext_info_stack\']) ? array() : $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];
',
  ),
  'po_req_info_fieldset_end' => 
  array (
    0 => '$GLOBALS[\'ext_info_stack\'][] = array(
\'id\'				=> \'fancy_stop_spam\',
\'path\'			=> FORUM_ROOT.\'extensions/fancy_stop_spam\',
\'url\'			=> $GLOBALS[\'base_url\'].\'/extensions/fancy_stop_spam\',
\'dependencies\'	=> array (
)
);
$ext_info = $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];

$lang_post[\'Submit reply\'] .= Fancy_stop_spam::SUBMIT_MARK;
			$lang_post[\'Submit topic\'] .= Fancy_stop_spam::SUBMIT_MARK;

array_pop($GLOBALS[\'ext_info_stack\']);
$ext_info = empty($GLOBALS[\'ext_info_stack\']) ? array() : $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];
',
  ),
  'vt_quickpost_fieldset_end' => 
  array (
    0 => '$GLOBALS[\'ext_info_stack\'][] = array(
\'id\'				=> \'fancy_stop_spam\',
\'path\'			=> FORUM_ROOT.\'extensions/fancy_stop_spam\',
\'url\'			=> $GLOBALS[\'base_url\'].\'/extensions/fancy_stop_spam\',
\'dependencies\'	=> array (
)
);
$ext_info = $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];

$lang_common[\'Submit\'] .= Fancy_stop_spam::SUBMIT_MARK;

array_pop($GLOBALS[\'ext_info_stack\']);
$ext_info = empty($GLOBALS[\'ext_info_stack\']) ? array() : $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];
',
  ),
  'vt_quickpost_pre_display' => 
  array (
    0 => '$GLOBALS[\'ext_info_stack\'][] = array(
\'id\'				=> \'fancy_stop_spam\',
\'path\'			=> FORUM_ROOT.\'extensions/fancy_stop_spam\',
\'url\'			=> $GLOBALS[\'base_url\'].\'/extensions/fancy_stop_spam\',
\'dependencies\'	=> array (
)
);
$ext_info = $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];

if ($forum_config[\'o_fancy_stop_spam_post_form_honeypot\'] == \'1\') {
				$fancy_stop_spam_post_key_id = uniqid();
				$forum_page[\'hidden_fields\'][\'form_honey_key_id\'] = \'<input type="hidden" name="form_honey_key_id" value="\'.$fancy_stop_spam_post_key_id.\'" />\';
			}

array_pop($GLOBALS[\'ext_info_stack\']);
$ext_info = empty($GLOBALS[\'ext_info_stack\']) ? array() : $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];
',
  ),
  'rg_register_form_submitted' => 
  array (
    0 => '$GLOBALS[\'ext_info_stack\'][] = array(
\'id\'				=> \'fancy_stop_spam\',
\'path\'			=> FORUM_ROOT.\'extensions/fancy_stop_spam\',
\'url\'			=> $GLOBALS[\'base_url\'].\'/extensions/fancy_stop_spam\',
\'dependencies\'	=> array (
)
);
$ext_info = $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];

// Check logs for repeated failed register attempts
			$fancy_stop_spam = Fancy_stop_spam::singleton();
			if (TRUE === $fancy_stop_spam->check_register_honeypot_repeated(get_remote_address())) {
				$fancy_stop_spam->log(Fancy_stop_spam::LOG_REGISTER_HONEYPOT_REPEATED, $forum_user[\'id\'], get_remote_address());
				message($lang_fancy_stop_spam[\'Register bot message\']);
			}

			// CHECK HONEY FIELDS
			if ($forum_config[\'o_fancy_stop_spam_register_form_honeypot\'] == \'1\') {
				if (!isset($_POST[\'form_honey_key_id\'])) {
					$fancy_stop_spam->log(Fancy_stop_spam::LOG_REGISTER_HONEYPOT_EMPTY, $forum_user[\'id\'], get_remote_address());
					message($lang_fancy_stop_spam[\'Register bot message\']);
				} else {
					$fancy_stop_spam_fullkey = \'email_confirm_xxx_\'.forum_htmlencode(forum_trim($_POST[\'form_honey_key_id\']));
					if (!empty($_POST[$fancy_stop_spam_fullkey])) {
						$fancy_stop_spam->log(Fancy_stop_spam::LOG_REGISTER_HONEYPOT, $forum_user[\'id\'], get_remote_address());
						message($lang_fancy_stop_spam[\'Register bot message\']);
					}
				}
			}

			// CHECK FORM FILL TIME
			if ($forum_config[\'o_fancy_stop_spam_register_form_timeout\'] == \'1\') {
				if (!isset($_POST[\'form_fancy_stop_spam_time\'])) {
					$fancy_stop_spam->log(Fancy_stop_spam::LOG_REGISTER_TIMEOUT, $forum_user[\'id\'], get_remote_address());
					message($lang_fancy_stop_spam[\'Register bot message\']);
				} else {
					$fancy_stop_spam_form_fill_time = time() - intval($_POST[\'form_fancy_stop_spam_time\'], 10);
					if ($fancy_stop_spam_form_fill_time < Fancy_stop_spam::FORM_FILL_MIN_TIME) {
						$fancy_stop_spam->log(Fancy_stop_spam::LOG_REGISTER_TIMEOUT, $forum_user[\'id\'], get_remote_address(), $fancy_stop_spam_form_fill_time);
						$errors[] = $lang_fancy_stop_spam[\'Register bot timeout message\'];
					}
				}
			}

			// CHECK TIMEZONE
			if ($forum_config[\'o_fancy_stop_spam_register_form_timezone\'] == \'1\') {
				if (isset($_POST[\'timezone\']) && $_POST[\'timezone\'] == \'-12\') {
					$fancy_stop_spam->log(Fancy_stop_spam::LOG_REGISTER_TIMEZONE, $forum_user[\'id\'], get_remote_address(), intval($_POST[\'timezone\'], 10));
					message($lang_fancy_stop_spam[\'Register bot timezone message\']);
				}
			}

			// CHECK SUBMIT VALUE
			if ($forum_config[\'o_fancy_stop_spam_check_submit\'] == \'1\') {
				if ($_POST[\'register\'] != $lang_profile[\'Register\'].Fancy_stop_spam::SUBMIT_MARK) {
					$fancy_stop_spam->log(Fancy_stop_spam::LOG_REGISTER_SUBMIT, $forum_user[\'id\'], get_remote_address());
					message($lang_fancy_stop_spam[\'Post bot message\']);
				}
			}

array_pop($GLOBALS[\'ext_info_stack\']);
$ext_info = empty($GLOBALS[\'ext_info_stack\']) ? array() : $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];
',
  ),
  'rg_register_group_end' => 
  array (
    0 => '$GLOBALS[\'ext_info_stack\'][] = array(
\'id\'				=> \'fancy_stop_spam\',
\'path\'			=> FORUM_ROOT.\'extensions/fancy_stop_spam\',
\'url\'			=> $GLOBALS[\'base_url\'].\'/extensions/fancy_stop_spam\',
\'dependencies\'	=> array (
)
);
$ext_info = $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];

$lang_profile[\'Register\'] .= Fancy_stop_spam::SUBMIT_MARK;

array_pop($GLOBALS[\'ext_info_stack\']);
$ext_info = empty($GLOBALS[\'ext_info_stack\']) ? array() : $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];
',
  ),
  'rg_register_pre_header_load' => 
  array (
    0 => '$GLOBALS[\'ext_info_stack\'][] = array(
\'id\'				=> \'fancy_stop_spam\',
\'path\'			=> FORUM_ROOT.\'extensions/fancy_stop_spam\',
\'url\'			=> $GLOBALS[\'base_url\'].\'/extensions/fancy_stop_spam\',
\'dependencies\'	=> array (
)
);
$ext_info = $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];

if ($forum_config[\'o_fancy_stop_spam_register_form_honeypot\'] == \'1\') {
				$fancy_stop_spam_post_key_id = uniqid();
			}

array_pop($GLOBALS[\'ext_info_stack\']);
$ext_info = empty($GLOBALS[\'ext_info_stack\']) ? array() : $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];
',
  ),
  'rg_register_pre_group' => 
  array (
    0 => '$GLOBALS[\'ext_info_stack\'][] = array(
\'id\'				=> \'fancy_stop_spam\',
\'path\'			=> FORUM_ROOT.\'extensions/fancy_stop_spam\',
\'url\'			=> $GLOBALS[\'base_url\'].\'/extensions/fancy_stop_spam\',
\'dependencies\'	=> array (
)
);
$ext_info = $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];

if ($forum_config[\'o_fancy_stop_spam_register_form_honeypot\'] == \'1\'):
			?>
				<div class="hidden">
					<input type="hidden" name="form_honey_key_id" value="<?php echo $fancy_stop_spam_post_key_id; ?>" />
					<input type="hidden" name="form_fancy_stop_spam_time" value="<?php echo time(); ?>" />
				</div>
			<?php
			endif;

array_pop($GLOBALS[\'ext_info_stack\']);
$ext_info = empty($GLOBALS[\'ext_info_stack\']) ? array() : $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];
',
  ),
  'rg_register_pre_password' => 
  array (
    0 => '$GLOBALS[\'ext_info_stack\'][] = array(
\'id\'				=> \'fancy_stop_spam\',
\'path\'			=> FORUM_ROOT.\'extensions/fancy_stop_spam\',
\'url\'			=> $GLOBALS[\'base_url\'].\'/extensions/fancy_stop_spam\',
\'dependencies\'	=> array (
)
);
$ext_info = $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];

if ($forum_config[\'o_fancy_stop_spam_register_form_honeypot\'] == \'1\'):
			?>
				<div class="sf-set set hidden">
					<div class="sf-box text">
						<label for="fld<?php echo ++$forum_page[\'fld_count\'] ?>"><span><?php echo $lang_fancy_stop_spam[\'Honey field\'] ?></span>
						<small><?php echo $lang_fancy_stop_spam[\'Honey field help\'] ?></small></label><br/>
						<span class="fld-input"><input type="text" id="fld<?php echo $forum_page[\'fld_count\'] ?>" name="email_confirm_xxx_<?php echo $fancy_stop_spam_post_key_id; ?>" size="35" autocomplete="off" /></span>
					</div>
				</div>
			<?php
			endif;

array_pop($GLOBALS[\'ext_info_stack\']);
$ext_info = empty($GLOBALS[\'ext_info_stack\']) ? array() : $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];
',
  ),
  'pf_change_pass_key_pre_new_password' => 
  array (
    0 => '$GLOBALS[\'ext_info_stack\'][] = array(
\'id\'				=> \'fancy_stop_spam\',
\'path\'			=> FORUM_ROOT.\'extensions/fancy_stop_spam\',
\'url\'			=> $GLOBALS[\'base_url\'].\'/extensions/fancy_stop_spam\',
\'dependencies\'	=> array (
)
);
$ext_info = $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];

if ($forum_config[\'o_fancy_stop_spam_register_form_honeypot\'] == \'1\'):
			?>
				<div class="sf-set set hidden">
					<div class="sf-box text">
						<label for="fld<?php echo ++$forum_page[\'fld_count\'] ?>"><span><?php echo $lang_fancy_stop_spam[\'Honey field\'] ?></span>
						<small><?php echo $lang_fancy_stop_spam[\'Honey field help\'] ?></small></label><br/>
						<span class="fld-input"><input type="text" id="fld<?php echo $forum_page[\'fld_count\'] ?>" name="email_confirm_xxx_<?php echo $fancy_stop_spam_post_key_id; ?>" size="35" autocomplete="off" /></span>
					</div>
				</div>
			<?php
			endif;

array_pop($GLOBALS[\'ext_info_stack\']);
$ext_info = empty($GLOBALS[\'ext_info_stack\']) ? array() : $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];
',
  ),
  'pf_change_pass_key_pre_header_load' => 
  array (
    0 => '$GLOBALS[\'ext_info_stack\'][] = array(
\'id\'				=> \'fancy_stop_spam\',
\'path\'			=> FORUM_ROOT.\'extensions/fancy_stop_spam\',
\'url\'			=> $GLOBALS[\'base_url\'].\'/extensions/fancy_stop_spam\',
\'dependencies\'	=> array (
)
);
$ext_info = $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];

if ($forum_config[\'o_fancy_stop_spam_register_form_honeypot\'] == \'1\') {
				$fancy_stop_spam_post_key_id = uniqid();
			}

array_pop($GLOBALS[\'ext_info_stack\']);
$ext_info = empty($GLOBALS[\'ext_info_stack\']) ? array() : $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];
',
  ),
  'pf_change_pass_key_pre_fieldset' => 
  array (
    0 => '$GLOBALS[\'ext_info_stack\'][] = array(
\'id\'				=> \'fancy_stop_spam\',
\'path\'			=> FORUM_ROOT.\'extensions/fancy_stop_spam\',
\'url\'			=> $GLOBALS[\'base_url\'].\'/extensions/fancy_stop_spam\',
\'dependencies\'	=> array (
)
);
$ext_info = $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];

if ($forum_config[\'o_fancy_stop_spam_register_form_honeypot\'] == \'1\'):
			?>
				<div class="hidden">
					<input type="hidden" name="form_honey_key_id" value="<?php echo $fancy_stop_spam_post_key_id; ?>" />
					<input type="hidden" name="form_fancy_stop_spam_time" value="<?php echo time(); ?>" />
				</div>
			<?php
			endif;

array_pop($GLOBALS[\'ext_info_stack\']);
$ext_info = empty($GLOBALS[\'ext_info_stack\']) ? array() : $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];
',
  ),
  'pf_change_pass_key_form_submitted' => 
  array (
    0 => '$GLOBALS[\'ext_info_stack\'][] = array(
\'id\'				=> \'fancy_stop_spam\',
\'path\'			=> FORUM_ROOT.\'extensions/fancy_stop_spam\',
\'url\'			=> $GLOBALS[\'base_url\'].\'/extensions/fancy_stop_spam\',
\'dependencies\'	=> array (
)
);
$ext_info = $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];

// CHECK SUBMIT VALUE
			if ($forum_config[\'o_fancy_stop_spam_check_submit\'] == \'1\') {
				if ($_POST[\'update\'] != $lang_common[\'Submit\'].Fancy_stop_spam::SUBMIT_MARK) {
					$fancy_stop_spam = Fancy_stop_spam::singleton();
					$fancy_stop_spam->log(Fancy_stop_spam::LOG_ACTIVATE_SUBMIT, $forum_user[\'id\'], get_remote_address());
					message($lang_fancy_stop_spam[\'Activate bot message\']);
				}
			}

			// CHECK HONEY FIELDS
			if ($forum_config[\'o_fancy_stop_spam_register_form_honeypot\'] == \'1\') {
				if (!isset($_POST[\'form_honey_key_id\'])) {
					$fancy_stop_spam = Fancy_stop_spam::singleton();
					$fancy_stop_spam->log(Fancy_stop_spam::LOG_ACTIVATE_HONEYPOT_EMPTY, $forum_user[\'id\'], get_remote_address());
					message($lang_fancy_stop_spam[\'Activate bot message\']);
				} else {
					$fancy_stop_spam_fullkey = \'email_confirm_xxx_\'.forum_htmlencode(forum_trim($_POST[\'form_honey_key_id\']));
					if (!empty($_POST[$fancy_stop_spam_fullkey])) {
						$fancy_stop_spam = Fancy_stop_spam::singleton();
						$fancy_stop_spam->log(Fancy_stop_spam::LOG_ACTIVATE_HONEYPOT, $forum_user[\'id\'], get_remote_address());
						message($lang_fancy_stop_spam[\'Activate bot message\']);
					}
				}
			}

array_pop($GLOBALS[\'ext_info_stack\']);
$ext_info = empty($GLOBALS[\'ext_info_stack\']) ? array() : $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];
',
  ),
  'pf_change_pass_key_fieldset_end' => 
  array (
    0 => '$GLOBALS[\'ext_info_stack\'][] = array(
\'id\'				=> \'fancy_stop_spam\',
\'path\'			=> FORUM_ROOT.\'extensions/fancy_stop_spam\',
\'url\'			=> $GLOBALS[\'base_url\'].\'/extensions/fancy_stop_spam\',
\'dependencies\'	=> array (
)
);
$ext_info = $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];

$lang_common[\'Submit\'] .= Fancy_stop_spam::SUBMIT_MARK;

array_pop($GLOBALS[\'ext_info_stack\']);
$ext_info = empty($GLOBALS[\'ext_info_stack\']) ? array() : $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];
',
  ),
  'ca_fn_generate_admin_menu_start' => 
  array (
    0 => '$GLOBALS[\'ext_info_stack\'][] = array(
\'id\'				=> \'fancy_stop_spam\',
\'path\'			=> FORUM_ROOT.\'extensions/fancy_stop_spam\',
\'url\'			=> $GLOBALS[\'base_url\'].\'/extensions/fancy_stop_spam\',
\'dependencies\'	=> array (
)
);
$ext_info = $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];

global $lang_fancy_stop_spam;

array_pop($GLOBALS[\'ext_info_stack\']);
$ext_info = empty($GLOBALS[\'ext_info_stack\']) ? array() : $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];
',
  ),
  'ca_fn_generate_admin_menu_new_link' => 
  array (
    0 => '$GLOBALS[\'ext_info_stack\'][] = array(
\'id\'				=> \'fancy_stop_spam\',
\'path\'			=> FORUM_ROOT.\'extensions/fancy_stop_spam\',
\'url\'			=> $GLOBALS[\'base_url\'].\'/extensions/fancy_stop_spam\',
\'dependencies\'	=> array (
)
);
$ext_info = $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];

if ($forum_user[\'g_id\'] == FORUM_ADMIN) {
				$fancy_stop_spam_menu_element = \'<li class="\'.((FORUM_PAGE_SECTION == \'fancy_stop_spam\') ? \'active\' : \'normal\').
						((empty($forum_page[\'admin_menu\'])) ? \' first-item\' : \'\').\'">
						<a href="\'.forum_link($forum_url[\'fancy_stop_spam_admin_section\']).\'">
							<span>\'.$lang_fancy_stop_spam["Admin section antispam"].\'</span>
						</a>
					</li>\';

				array_insert($forum_page[\'admin_menu\'], \'extensions_manage\', $fancy_stop_spam_menu_element, \'fancy_stop_spam\');
			}

array_pop($GLOBALS[\'ext_info_stack\']);
$ext_info = empty($GLOBALS[\'ext_info_stack\']) ? array() : $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];
',
  ),
  'pf_delete_user_pre_fieldset_end' => 
  array (
    0 => '$GLOBALS[\'ext_info_stack\'][] = array(
\'id\'				=> \'fancy_stop_spam\',
\'path\'			=> FORUM_ROOT.\'extensions/fancy_stop_spam\',
\'url\'			=> $GLOBALS[\'base_url\'].\'/extensions/fancy_stop_spam\',
\'dependencies\'	=> array (
)
);
$ext_info = $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];

if (!empty($forum_config[\'o_fancy_stop_spam_sfs_api_key\']) && $forum_config[\'o_regs_verify\'] == \'1\') {
			?>
				<div class="sf-set set<?php echo ++$forum_page[\'item_count\'] ?>">
					<div class="sf-box checkbox">
						<span class="fld-input"><input type="checkbox" id="fld<?php echo ++$forum_page[\'fld_count\'] ?>" name="fancy_stop_spam_report_to_sfs" value="1" /></span>
						<label for="fld<?php echo $forum_page[\'fld_count\'] ?>"><?php echo $lang_fancy_stop_spam[\'Report to sfs\'] ?></label>
					</div>
				</div>
			<?php
			}

array_pop($GLOBALS[\'ext_info_stack\']);
$ext_info = empty($GLOBALS[\'ext_info_stack\']) ? array() : $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];
',
  ),
  'pf_delete_user_pre_redirect' => 
  array (
    0 => '$GLOBALS[\'ext_info_stack\'][] = array(
\'id\'				=> \'fancy_stop_spam\',
\'path\'			=> FORUM_ROOT.\'extensions/fancy_stop_spam\',
\'url\'			=> $GLOBALS[\'base_url\'].\'/extensions/fancy_stop_spam\',
\'dependencies\'	=> array (
)
);
$ext_info = $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];

if (isset($_POST[\'fancy_stop_spam_report_to_sfs\']) && $forum_config[\'o_regs_verify\'] == \'1\') {
				if (!empty($forum_config[\'o_fancy_stop_spam_sfs_api_key\'])) {
					$fancy_stop_spam = Fancy_stop_spam::singleton();
					$fancy_stop_spam->send_spam_data_to_sfs($user[\'username\'], $user[\'email\'], $user[\'registration_ip\']);
				}
			}

array_pop($GLOBALS[\'ext_info_stack\']);
$ext_info = empty($GLOBALS[\'ext_info_stack\']) ? array() : $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];
',
  ),
  'ft_about_end' => 
  array (
    0 => '$GLOBALS[\'ext_info_stack\'][] = array(
\'id\'				=> \'fancy_stat_counters\',
\'path\'			=> FORUM_ROOT.\'extensions/fancy_stat_counters\',
\'url\'			=> $GLOBALS[\'base_url\'].\'/extensions/fancy_stat_counters\',
\'dependencies\'	=> array (
)
);
$ext_info = $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];

if (defined(\'FORUM_PAGE\') && (!in_array(FORUM_PAGE, array(\'redirect\')) && (substr(FORUM_PAGE, 0, 5) != \'admin\'))) {
				// GA
				if ($forum_config[\'o_fancy_stat_counter_enable_ga\'] == \'1\' && !empty($forum_config[\'o_fancy_stat_counter_id_ga\'])) {
					$fancy_stat_ga_code = \'var pageTracker = _gat._getTracker("\'.forum_htmlencode($forum_config[\'o_fancy_stat_counter_id_ga\']).\'");	pageTracker._trackPageview();\';
					$fancy_stat_ga_code_url = "\\"+(\'https:\' == document.location.protocol ? \'https://ssl\' : \'http://www\') + \'.google-analytics.com/ga.js\'+\\"";

					$forum_loader->add_js($fancy_stat_ga_code_url, array(\'type\' => \'url\', \'async\' => false, \'weight\' => 200));
					$forum_loader->add_js($fancy_stat_ga_code, array(\'type\' => \'inline\', \'weight\' => 201));
				}

				// YM
				if ($forum_config[\'o_fancy_stat_counter_enable_ym\'] == \'1\' && !empty($forum_config[\'o_fancy_stat_counter_id_ym\'])) {
?>
					<!-- Yandex.Metrika counter -->
					<div style="display:none;"><script type="text/javascript">
					(function(w, c) {
					    (w[c] = w[c] || []).push(function() {
					        try {
					            w.yaCounter<?php echo forum_htmlencode($forum_config[\'o_fancy_stat_counter_id_ym\']); ?> = new Ya.Metrika({id:<?php echo forum_htmlencode($forum_config[\'o_fancy_stat_counter_id_ym\']); ?>, trackLinks:true, accurateTrackBounce:true});
					        }
					        catch(e) { }
					    });
					})(window, \'yandex_metrika_callbacks\');
					</script></div>
					<script src="//mc.yandex.ru/metrika/watch.js" type="text/javascript" defer="defer"></script>
					<noscript><div><img src="//mc.yandex.ru/watch/<?php echo forum_htmlencode($forum_config[\'o_fancy_stat_counter_id_ym\']); ?>" style="position:absolute; left:-9999px;" alt="" /></div></noscript>
					<!-- /Yandex.Metrika counter -->
<?php
				}
			}

array_pop($GLOBALS[\'ext_info_stack\']);
$ext_info = empty($GLOBALS[\'ext_info_stack\']) ? array() : $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];
',
  ),
  'fn_sync_forum_qr_update_forum' => 
  array (
    0 => '$GLOBALS[\'ext_info_stack\'][] = array(
\'id\'				=> \'last_topic_title_on_forum_index\',
\'path\'			=> FORUM_ROOT.\'extensions/last_topic_title_on_forum_index\',
\'url\'			=> $GLOBALS[\'base_url\'].\'/extensions/last_topic_title_on_forum_index\',
\'dependencies\'	=> array (
)
);
$ext_info = $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];

$lt_query = array(
				\'SELECT\'	=> \'t.subject AS subject\',
				\'FROM\'		=> \'topics AS t\',
				\'WHERE\'		=> \'t.forum_id=\'.$forum_id.\' AND t.moved_to is NULL\',
				\'ORDER BY\'	=> \'t.last_post DESC\',
				\'LIMIT\'		=> \'1\'
			);

			$lt_result = $forum_db->query_build($lt_query) or error(__FILE__, __LINE__);
			$last_post_subject = $forum_db->fetch_assoc($lt_result);

			if (!is_null($last_post_subject) && $last_post_subject !== false) {
				$query[\'SET\'] .= \', last_post_subject=\\\'\'.$forum_db->escape($last_post_subject[\'subject\']).\'\\\'\';
			} else {
				$query[\'SET\'] .= \', last_post_subject=NULL\';
			}

array_pop($GLOBALS[\'ext_info_stack\']);
$ext_info = empty($GLOBALS[\'ext_info_stack\']) ? array() : $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];
',
  ),
  'in_qr_get_cats_and_forums' => 
  array (
    0 => '$GLOBALS[\'ext_info_stack\'][] = array(
\'id\'				=> \'last_topic_title_on_forum_index\',
\'path\'			=> FORUM_ROOT.\'extensions/last_topic_title_on_forum_index\',
\'url\'			=> $GLOBALS[\'base_url\'].\'/extensions/last_topic_title_on_forum_index\',
\'dependencies\'	=> array (
)
);
$ext_info = $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];

$query[\'SELECT\'] .=\', f.last_post_subject\';

array_pop($GLOBALS[\'ext_info_stack\']);
$ext_info = empty($GLOBALS[\'ext_info_stack\']) ? array() : $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];
',
  ),
  'in_normal_row_pre_display' => 
  array (
    0 => '$GLOBALS[\'ext_info_stack\'][] = array(
\'id\'				=> \'last_topic_title_on_forum_index\',
\'path\'			=> FORUM_ROOT.\'extensions/last_topic_title_on_forum_index\',
\'url\'			=> $GLOBALS[\'base_url\'].\'/extensions/last_topic_title_on_forum_index\',
\'dependencies\'	=> array (
)
);
$ext_info = $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];

$last_topic_title_max_len = isset($forum_config[\'o_max_last_topic_title_length\']) ? intval($forum_config[\'o_max_last_topic_title_length\'], 10) : 0;
			$last_topic_title_mode = isset($forum_config[\'o_last_topic_title_mode\']) ? intval($forum_config[\'o_last_topic_title_mode\'], 10) : 1;
			$last_topic_title = $cur_forum[\'last_post_subject\'];

			if ($cur_forum[\'last_post\'] != \'\') {
				if ($last_topic_title == \'\') {
					$forum_page[\'item_body\'][\'info\'][\'lastpost\'] = \'<li class="info-lastpost"><span class="label">\'.$lang_index[\'No lastpost info\'].\'</span></li>\';
				} else {
					if (($last_topic_title_max_len > 0) && (utf8_strlen($last_topic_title) > $last_topic_title_max_len)) {
						$last_topic_title = utf8_substr($last_topic_title, 0, $last_topic_title_max_len).\'…\';
					}

					if ($last_topic_title_mode === 1) {
						$forum_page[\'item_body\'][\'info\'][\'lastpost\'] = \'<li class="info-lastpost"><span class="label">\'.$lang_index[\'Last post\'].\'</span> <strong><a href="\'.forum_link($forum_url[\'post\'], $cur_forum[\'last_post_id\']).\'" title="\'.forum_htmlencode($cur_forum[\'last_post_subject\']).\'">\'.forum_htmlencode($last_topic_title).\'</a></strong> <cite>\'.format_time($cur_forum[\'last_post\']).\'&nbsp;&mdash; \'.forum_htmlencode($cur_forum[\'last_poster\']).\'</cite></li>\';
					} else {
						$forum_page[\'item_body\'][\'info\'][\'lastpost\'] = \'<li class="info-lastpost"><span class="label">\'.$lang_index[\'Last post\'].\'</span> <strong><a href="\'.forum_link($forum_url[\'post\'], $cur_forum[\'last_post_id\']).\'" title="\'.forum_htmlencode($cur_forum[\'last_post_subject\']).\'">\'.forum_htmlencode($last_topic_title).\'</a></strong> <cite>\'.format_time($cur_forum[\'last_post\']).\'</cite><cite>\'.sprintf($lang_index[\'Last poster\'], forum_htmlencode($cur_forum[\'last_poster\'])).\'</cite></li>\';
					}
				}
			}

array_pop($GLOBALS[\'ext_info_stack\']);
$ext_info = empty($GLOBALS[\'ext_info_stack\']) ? array() : $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];
',
  ),
  'aop_setup_personal_fieldset_end' => 
  array (
    0 => '$GLOBALS[\'ext_info_stack\'][] = array(
\'id\'				=> \'quadric_google_analytics\',
\'path\'			=> FORUM_ROOT.\'extensions/quadric_google_analytics\',
\'url\'			=> $GLOBALS[\'base_url\'].\'/extensions/quadric_google_analytics\',
\'dependencies\'	=> array (
)
);
$ext_info = $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];

if (file_exists($ext_info[\'path\'].\'/lang/\'.$forum_user[\'language\'].\'/\'.$ext_info[\'id\'].\'.php\'))
				include $ext_info[\'path\'].\'/lang/\'.$forum_user[\'language\'].\'/\'.$ext_info[\'id\'].\'.php\';
			else
				include $ext_info[\'path\'].\'/lang/English/quadric_google_analytics.php\';

			$forum_page[\'group_count\'] = $forum_page[\'item_count\'] = 0;
			?>
			<div class="content-head">
				<h2 class="hn"><span><?php echo $lang_quadric_google_analytics[\'Setup\'] ?></span></h2>
			</div>
			<fieldset class="frm-group group<?php echo ++$forum_page[\'group_count\'] ?>">
				<div class="sf-set set<?php echo ++$forum_page[\'item_count\'] ?>">
					<div class="sf-box text">
						<label for="fld<?php echo ++$forum_page[\'fld_count\'] ?>">
							<span><?php echo $lang_quadric_google_analytics[\'Tracker Code\'] ?></span>
							<small><?php echo $lang_quadric_google_analytics[\'Tracker Code help\'] ?></small>
						</label><br />
						<span class="fld-input"><input type="text" id="fld<?php echo $forum_page[\'fld_count\'] ?>" name="form[quadric_google_analytics_tracking_code]" size="50" maxlength="255" value="<?php echo forum_htmlencode($forum_config[\'o_quadric_google_analytics_tracking_code\']) ?>" /></span>
					</div>
				</div>
				
				<div class="sf-set set<?php echo ++$forum_page[\'item_count\'] ?>">
					<div class="sf-box select">
						<label for="fld<?php echo ++$forum_page[\'fld_count\'] ?>"><span><?php echo $lang_quadric_google_analytics[\'Tracker Mode\'] ?></span></label><br>
						<span class="fld-input"><select name="form[quadric_google_analytics_tracking_mode]" id="fld<?php echo $forum_page[\'fld_count\'] ?>">
							<option value="1"<?php echo $forum_config[\'o_quadric_google_analytics_tracking_mode\'] == 1 ? \' selected="selected"\' : null ?>><?php echo $lang_quadric_google_analytics[\'Tracker Mode 1\'] ?></option>
							<option value="2"<?php echo $forum_config[\'o_quadric_google_analytics_tracking_mode\'] == 2 ? \' selected="selected"\' : null ?>><?php echo $lang_quadric_google_analytics[\'Tracker Mode 2\'] ?></option>
							<option value="3"<?php echo $forum_config[\'o_quadric_google_analytics_tracking_mode\'] == 3 ? \' selected="selected"\' : null ?>><?php echo $lang_quadric_google_analytics[\'Tracker Mode 3\'] ?></option>
						</select></span>
					</div>
				</div>
			</fieldset>
			<?php

array_pop($GLOBALS[\'ext_info_stack\']);
$ext_info = empty($GLOBALS[\'ext_info_stack\']) ? array() : $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];
',
  ),
  'vt_row_pre_post_actions_merge' => 
  array (
    0 => '$GLOBALS[\'ext_info_stack\'][] = array(
\'id\'				=> \'fancy_addthis\',
\'path\'			=> FORUM_ROOT.\'extensions/fancy_addthis\',
\'url\'			=> $GLOBALS[\'base_url\'].\'/extensions/fancy_addthis\',
\'dependencies\'	=> array (
)
);
$ext_info = $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];

$forum_page[\'post_actions\'][\'fancy_addthis_code\'] = \'
				<span class="fancy-addthis-post\'.(empty($forum_page[\'post_actions\']) ? \' first-item\' : \'\').\'">
					<span class="fancy-addthis-link" data-share-url="\'.forum_link($forum_url[\'post\'], $cur_post[\'id\']).\'">\'.
						$lang_fancy_addthis[\'Share\'].\'
					</span>
				</span>\';

array_pop($GLOBALS[\'ext_info_stack\']);
$ext_info = empty($GLOBALS[\'ext_info_stack\']) ? array() : $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];
',
  ),
  'ld_fn_render_css_simple_start' => 
  array (
    0 => '$GLOBALS[\'ext_info_stack\'][] = array(
\'id\'				=> \'fancy_js_cache\',
\'path\'			=> FORUM_ROOT.\'extensions/fancy_js_cache\',
\'url\'			=> $GLOBALS[\'base_url\'].\'/extensions/fancy_js_cache\',
\'dependencies\'	=> array (
)
);
$ext_info = $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];

global $forum_config;

			if ($forum_config[\'o_fancy_js_css_cache_enable\'] == \'1\') {
				include_once $ext_info[\'path\'].\'/functions.inc.php\';

				$fancy_cache = new FANCY_JS_CACHE($ext_info);
				$fancy_cache->run_css($libs);
			}

array_pop($GLOBALS[\'ext_info_stack\']);
$ext_info = empty($GLOBALS[\'ext_info_stack\']) ? array() : $GLOBALS[\'ext_info_stack\'][count($GLOBALS[\'ext_info_stack\']) - 1];
',
  ),
);

?>