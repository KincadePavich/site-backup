<?php
session_start();

//error_reporting(E_ALL);
error_reporting(0);

include_once('var.php');
include_once('util.php');

if (isset($_SERVER['HTTP_REFERER'])) {
	$referer = $_SERVER['HTTP_REFERER'];
}

/* connect to MySQL database */
$mysqli = new mysqli($hostName, $userName, $password);
$mysqli->select_db('wolfssldownload');

/* this is our first page, so regenerate our session id and generate a new nonce */
session_regenerate_id();

do {
	// store nonce in $_SESSION['nonce'], timestamp in $_SESSION['timestamp']
	generateNonce("page1a", session_id(), $sha256key);
	$ret = verifyNonce($_SESSION['nonce'], $_SESSION['timestamp'], $mysqli);
} while ($ret != 0);

/* show errors or reset session variables */
if ( isset($_SESSION['error_codes']) ) {
	$error_codes = $_SESSION['error_codes'];
} else {
	$error_codes = null;
	unset($_SESSION['filename']);
	unset($_SESSION['name']);
	unset($_SESSION['company']);
	unset($_SESSION['title']);
	unset($_SESSION['email']);
	unset($_SESSION['phone']);
	unset($_SESSION['comments']);
	unset($_SESSION['error_codes']);
}

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">

<head>
	<title>wolfSSL - Product Downloads</title>

	<meta http-equiv="cache-control" content="max-age=0" />
	<meta http-equiv="cache-control" content="no-cache" />
	<meta http-equiv="expires" content="0" />
	<meta http-equiv="expires" content="Tue, 01 Jan 1980 1:00:00 GMT" />
	<meta http-equiv="pragma" content="no-cache" />

    <meta name="description" content="Download the open source wolfSSL embedded SSL library and the wolfSSL JNI Java wrapper, dual licensed under the GPL and commercial licensing." />
	<meta name="keywords" content="embedded ssl, ssl library, tls library, embedded tls, open source ssl, encryption libraries, openssl brdrernatives, security api, ssl, api, Linux ssl, mysql ssl, cryptography library, FIPS, aes cryptography, C++ ssl, crypto source code, crypto library, ssl, gpl ssl, portable security, tls 1.2, ssl inspection " />
	<meta name="robots" content="follow,index" />
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

	<!-- iWeb CSS Styles -->
	<link rel="stylesheet" type="text/css" media="screen,print" href="./css/Template.css" />
	<!--[if lt IE 8]><link rel='stylesheet' type='text/css' media='screen,print' href='./css/TemplateIE.css'/><![endif]-->
	<!--[if gte IE 8]><link rel='stylesheet' type='text/css' media='screen,print' href='./css/IE8.css'/><![endif]-->

	<!-- Blueprint CSS Framework -->
    <link rel="stylesheet" href="https://www.wolfssl.com/css/blueprint/screen.css" type="text/css" media="screen, projection" />
    <link rel="stylesheet" href="https://www.wolfssl.com/css/blueprint/print.css" type="text/css" media="print" />
    <!--[if IE]><link rel="stylesheet" href="https://www.wolfssl.com/css/blueprint/ie.css" type="text/css" media="screen, projection" /><![endif]-->
    <link rel="stylesheet" href="https://www.wolfssl.com/css/blueprint/plugins/fancy-type/screen.css" type="text/css" media="screen, projection" />

	<!-- CSS Styles -->
	<link rel="stylesheet" href="./css/forms2.css" type="text/css" />

	<!-- Google Analytics tracking code -->
    <script>
        (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
            (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
            m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
        })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

        ga('create', 'UA-64826966-1', 'auto');
        ga('send', 'pageview');
    </script>

    <!-- facebook conversion code -->
    <script type="text/javascript">
    var fb_param = {};
    fb_param.pixel_id = '6007024342164';
    fb_param.value = '0.00';
    (function(){
      var fpw = document.createElement('script');
      fpw.async = true;
      fpw.src = '//connect.facebook.net/en_US/fp.js';
      var ref = document.getElementsByTagName('script')[0];
      ref.parentNode.insertBefore(fpw, ref);
    })();
    </script>
    <noscript><img height="1" width="1" alt="" style="display:none" src="https://www.facebook.com/offsite_event.php?id=6007024342164&amp;value=0" /></noscript>
    <script type="text/javascript" src="http://davidjbradshaw.com/iframe-resizer/js/iframeResizer.contentWindow.min.js"></script> 
</head>

<body>

<div class="container">

<center>
<div id="formarea" align="center">
	<?php if(isset($error_codes)) {echo '<div class="error">Please fix the errors below</div>';} ?>
	<form name="submit_form" method="POST" enctype="multipart/form-data" action="<?php echo $page2; ?>">
	<fieldset>
		<!--<span>* Please fix the problems in red, below </span><br/>-->
		<span class="header_section">Step 1: INFORMATION</span><br/>
		<p><label for="name">Name:</label><input class="text <?php if(sizeof($error_codes > 0)) {if(in_array(4, (array)$error_codes)) {echo 'error';}} ?>" type="text" id="name" name="name" size="40" value="<?php if(isset($_SESSION['name'])) {echo $_SESSION['name'];} ?>"/><span class="form_hint">(Letters allowed)</span></p>
		<p><label for="company">Company:</label><input class="text <?php if(sizeof($error_codes > 0)) {if(in_array(5, (array)$error_codes)) {echo 'error';}} ?>" type="text" id="company" name="company" size="40" value="<?php if(isset($_SESSION['company'])) {echo $_SESSION['company'];} ?>"/><span class="form_hint">(Letters and Numbers allowed)</span></p>
		<p><label for="title">Position:</label><input class="text <?php if(sizeof($error_codes > 0)) {if(in_array(6, (array)$error_codes)) {echo 'error';}} ?>" type="text" id="title" name="title" size="40" value="<?php if(isset($_SESSION['title'])) {echo $_SESSION['title'];} ?>"/><span class="form_hint">(Letters and Numbers allowed)</span></p>
		<p><label for="email">Email:</label><input class="text <?php if(sizeof($error_codes > 0)) {if(in_array(7, (array)$error_codes)) {echo 'error';}} ?>" type="text" id="email" name="email" size="40" value="<?php if(isset($_SESSION['email'])) {echo $_SESSION['email'];} ?>"/><span class="form_hint">(Ex: name@company.com)</span></p>
		<p><label for="phone">Phone:</label><input class="text <?php if(sizeof($error_codes > 0)) {if(in_array(8, (array)$error_codes)) {echo 'error';}} ?>" type="text" id="phone" name="phone" size="40" value="<?php if(isset($_SESSION['phone'])) {echo $_SESSION['phone'];} ?>"/><span class="form_hint">(Ex: +X XXX-XXX-XXXX)</span></p>
		<p><label for="comments">Comments:</label><textarea class=" <?php if(sizeof($error_codes > 0)) {if(in_array(9, (array)$error_codes)) {echo 'error';}} ?>" id="comments" name="comments" style="height:100px;"><?php if(isset($_SESSION['comments'])) {echo $_SESSION['comments'];} ?></textarea></p>
		<span class="form_hint" style="margin-left:75px;">Allowed characters include: letters, numbers, and [.,;:&"?!'()-]</span><br/>
		<?php
		if(sizeof($error_codes) > 0) {if(in_array(9, (array)$error_codes)) {
		echo '<span id="com_alert">* You entered illegal characters in your comment. Please make adjustments.</span><br/>';
		}} ?>
		<br/>
		<p><label for="evalsupport"></label><input type="checkbox" name="evalsupport" value="1" <?php if(isset($_SESSION['evalsupport'])) {echo 'checked';} ?> />&nbsp;&nbsp;Do you need <b>evaluation support</b> or assistance from wolfSSL?</p><br/>

		<hr size="1px"/>
		<br>
		<span class="header_section">Step 2: SELECT DOWNLOAD</span>
		<?php
		if(sizeof($error_codes > 0)) {if(in_array(2, (array)$error_codes)) {
		echo '<br/><span class="error" id="file_alert">* You need to select a file to download.</span><br/><br/>';
		}} ?>
		<p class="textbody">
            [Please select your desired download]
        </p><br>
        <p class="textbody">
            This form allows you to download the most recent stable open source (GPLv2) versions of both wolfSSL and wolfSSL JNI. If your project cannot tolerate the terms of the GPLv2, please contact us to learn more about our commercial license.<br/><br/>
            For users looking to download the wolfCrypt embedded crypto engine, this is included in the wolfSSL package below.
		</p><br/>
		<?php

		/* get product counts from database, grouped by product from current month */
		$product_query = "SELECT * FROM PRODUCTS INNER JOIN PSTATUS ON PRODUCTS.activeform = PSTATUS.id WHERE PRODUCTS.activeform = '2' ORDER BY PRODUCTS.name ASC";
		$product_result = $mysqli->query($product_query);

		while ($row2 = $product_result->fetch_array())
		{
		?>

        <input type="radio" name="filename" value="<?php echo $row2['filename']; ?>" style="margin-left:2em; margin-right:5px;" <?php if(isset($_SESSION['filename']) && (strcmp($row2['filename'], $_SESSION['filename']) == 0)) echo 'checked'; ?> /><span class="product"><?php echo basename($row2['filename']); ?></span>&nbsp;<p class="textbody">(<?php echo $row2['hashtype']; ?>: <?php echo $row2['hash']; ?>)</p><br>
		<p class="textproduct">
		<?php echo $row2['notes']; ?><br/><br/>
		<span class="date">Release Date: <?php echo date("m/d/Y", strtotime($row2['releasedate'])); ?></span><br/><br/>
		</p>

		<?php
		}
		$product_result->close();

		$mysqli->close();

		?>

		<hr size="1px"/>
		<br/>
<span class="header_section">Step 3: LICENSE AGREEMENT</span><br/>
		<?php
		if(sizeof($error_codes > 0)) {if(in_array(3, (array)$error_codes)) {
		echo '<br/><span class="error" id="file_alert">* You must read and agree to the terms of the GPLv2.</span><br/><br/>'; }}
		?>
		<p class="textbody">
		The wolfSSL source code is subject to the U.S. Export Administration Regulations and other U.S. law, and may not be exported or re-exported to certain countries (currently Afghanistan, Cuba, Iran, Iraq, Libya, North Korea, Sudan and Syria) or to persons or entities prohibited from receiving U.S. exports (including Denied Parties, entities on the Bureau of Export Administration Entity List, and Specially Designated Nationals).
		</p><br/>
		<center><textarea readonly="readonly">
GNU GENERAL PUBLIC LICENSE
Version 2, June 1991

============================================================

Copyright (C) 1989, 1991 Free Software Foundation, Inc.
59 Temple Place, Suite 330, Boston, MA  02111-1307  USA

Everyone is permitted to copy and distribute verbatim copies of this license document, but changing it is not allowed.

=========================================================

Preamble

The licenses for most software are designed to take away your freedom to share and change it.  By contrast, the GNU General Public License is intended to guarantee your freedom to share and change free software--to make sure the software is free for all its users.  This General Public License applies to most of the Free Software Foundation's software and to any other program whose authors commit to using it.  (Some other Free Software Foundation software is covered by the GNU Library General Public License instead.)  You can apply it to
your programs, too.

When we speak of free software, we are referring to freedom, not price.  Our General Public Licenses are designed to make sure that you have the freedom to distribute copies of free software (and charge for this service if you wish), that you receive source code or can get it if you want it, that you can change the software or use pieces of it in new free programs; and that you know you can do these things.

To protect your rights, we need to make restrictions that forbid anyone to deny you these rights or to ask you to surrender the rights. These restrictions translate to certain responsibilities for you if you distribute copies of the software, or if you modify it.

For example, if you distribute copies of such a program, whether gratis or for a fee, you must give the recipients all the rights that you have.  You must make sure that they, too, receive or can get the source code.  And you must show them these terms so they know their rights.

We protect your rights with two steps: (1) copyright the software, and (2) offer you this license which gives you legal permission to copy, distribute and/or modify the software.

Also, for each author's protection and ours, we want to make certain that everyone understands that there is no warranty for this free software.  If the software is modified by someone else and passed on, we want its recipients to know that what they have is not the original, so that any problems introduced by others will not reflect on the original authors' reputations.

Finally, any free program is threatened constantly by software patents.  We wish to avoid the danger that redistributors of a free program will individually obtain patent licenses, in effect making the program proprietary.  To prevent this, we have made it clear that any patent must be licensed for everyone's free use or not licensed at all.

The precise terms and conditions for copying, distribution and modification follow.

GNU GENERAL PUBLIC LICENSE

TERMS AND CONDITIONS FOR COPYING, DISTRIBUTION AND MODIFICATION

  0. This License applies to any program or other work which contains a notice placed by the copyright holder saying it may be distributed under the terms of this General Public License.  The "Program", below, refers to any such program or work, and a "work based on the Program" means either the Program or any derivative work under copyright law: that is to say, a work containing the Program or a portion of it, either verbatim or with modifications and/or translated into another language.  (Hereinafter, translation is included without limitation in the term "modification".)  Each licensee is addressed as "you".

Activities other than copying, distribution and modification are not covered by this License; they are outside its scope.  The act of running the Program is not restricted, and the output from the Program is covered only if its contents constitute a work based on the Program (independent of having been made by running the Program).

Whether that is true depends on what the Program does.

  1. You may copy and distribute verbatim copies of the Program's source code as you receive it, in any medium, provided that you conspicuously and appropriately publish on each copy an appropriate copyright notice and disclaimer of warranty; keep intact all the notices that refer to this License and to the absence of any warranty; and give any other recipients of the Program a copy of this License along with the Program.

You may charge a fee for the physical act of transferring a copy, and you may at your option offer warranty protection in exchange for a fee.

  2. You may modify your copy or copies of the Program or any portion of it, thus forming a work based on the Program, and copy and distribute such modifications or work under the terms of Section 1 above, provided that you also meet all of these conditions:

    a) You must cause the modified files to carry prominent notices stating that you changed the files and the date of any change.

    b) You must cause any work that you distribute or publish, that in whole or in part contains or is derived from the Program or any part thereof, to be licensed as a whole at no charge to all third parties under the terms of this License.

    c) If the modified program normally reads commands interactively when run, you must cause it, when started running for such interactive use in the most ordinary way, to print or display an announcement including an appropriate copyright notice and a notice that there is no warranty (or else, saying that you provide a warranty) and that users may redistribute the program under these conditions, and telling the user how to view a copy of this License.  (Exception: if the Program itself is interactive but does not normally print such an announcement, your work based on the Program is not required to print an announcement.)

These requirements apply to the modified work as a whole.  If identifiable sections of that work are not derived from the Program, and can be reasonably considered independent and separate works in themselves, then this License, and its terms, do not apply to those sections when you distribute them as separate works.  But when you distribute the same sections as part of a whole which is a work based on the Program, the distribution of the whole must be on the terms of this License, whose permissions for other licensees extend to the entire whole, and thus to each and every part regardless of who wrote it.

Thus, it is not the intent of this section to claim rights or contest your rights to work written entirely by you; rather, the intent is to exercise the right to control the distribution of derivative or collective works based on the Program.

In addition, mere aggregation of another work not based on the Program with the Program (or with a work based on the Program) on a volume of a storage or distribution medium does not bring the other work under the scope of this License.

  3. You may copy and distribute the Program (or a work based on it, under Section 2) in object code or executable form under the terms of Sections 1 and 2 above provided that you also do one of the following:

    a) Accompany it with the complete corresponding machine-readable source code, which must be distributed under the terms of Sections 1 and 2 above on a medium customarily used for software interchange; or,

    b) Accompany it with a written offer, valid for at least three years, to give any third party, for a charge no more than your cost of physically performing source distribution, a complete machine-readable copy of the corresponding source code, to be distributed under the terms of Sections 1 and 2 above on a medium customarily used for software interchange; or,

    c) Accompany it with the information you received as to the offer to distribute corresponding source code.  (This alternative is allowed only for noncommercial distribution and only if you received the program in object code or executable form with such an offer, in accord with Subsection b above.)

The source code for a work means the preferred form of the work for making modifications to it.  For an executable work, complete source code means all the source code for all modules it contains, plus any associated interface definition files, plus the scripts used to control compilation and installation of the executable.  However, as a special exception, the source code distributed need not include anything that is normally distributed (in either source or binary form) with the major components (compiler, kernel, and so on) of the operating system on which the executable runs, unless that component itself accompanies the executable.

If distribution of executable or object code is made by offering access to copy from a designated place, then offering equivalent access to copy the source code from the same place counts as distribution of the source code, even though third parties are not compelled to copy the source along with the object code.

  4. You may not copy, modify, sublicense, or distribute the Program except as expressly provided under this License.  Any attempt otherwise to copy, modify, sublicense or distribute the Program is void, and will automatically terminate your rights under this License. However, parties who have received copies, or rights, from you under this License will not have their licenses terminated so long as such parties remain in full compliance.

  5. You are not required to accept this License, since you have not signed it.  However, nothing else grants you permission to modify or distribute the Program or its derivative works.  These actions are prohibited by law if you do not accept this License.  Therefore, by modifying or distributing the Program (or any work based on the Program), you indicate your acceptance of this License to do so, and all its terms and conditions for copying, distributing or modifying
the Program or works based on it.

  6. Each time you redistribute the Program (or any work based on the Program), the recipient automatically receives a license from the original licensor to copy, distribute or modify the Program subject to these terms and conditions.  You may not impose any further restrictions on the recipients' exercise of the rights granted herein. You are not responsible for enforcing compliance by third parties to this License.

  7. If, as a consequence of a court judgment or allegation of patent infringement or for any other reason (not limited to patent issues), conditions are imposed on you (whether by court order, agreement or otherwise) that contradict the conditions of this License, they do not excuse you from the conditions of this License.  If you cannot distribute so as to satisfy simultaneously your obligations under this License and any other pertinent obligations, then as a consequence you may not distribute the Program at all.  For example, if a patent license would not permit royalty-free redistribution of the Program by all those who receive copies directly or indirectly through you, then the only way you could satisfy both it and this License would be to refrain entirely from distribution of the Program.

If any portion of this section is held invalid or unenforceable under any particular circumstance, the balance of the section is intended to apply and the section as a whole is intended to apply in other circumstances.

It is not the purpose of this section to induce you to infringe any patents or other property right claims or to contest validity of any such claims; this section has the sole purpose of protecting the integrity of the free software distribution system, which is implemented by public license practices.  Many people have made generous contributions to the wide range of software distributed through that system in reliance on consistent application of that system; it is up to the author/donor to decide if he or she is willing to distribute software through any other system and a licensee cannot impose that choice.

This section is intended to make thoroughly clear what is believed to be a consequence of the rest of this License.

  8. If the distribution and/or use of the Program is restricted in certain countries either by patents or by copyrighted interfaces, the original copyright holder who places the Program under this License may add an explicit geographical distribution limitation excluding those countries, so that distribution is permitted only in or among countries not thus excluded.  In such case, this License incorporates the limitation as if written in the body of this License.

  9. The Free Software Foundation may publish revised and/or new versions of the General Public License from time to time.  Such new versions will be similar in spirit to the present version, but may differ in detail to address new problems or concerns.

Each version is given a distinguishing version number.  If the Program specifies a version number of this License which applies to it and "any later version", you have the option of following the terms and conditions either of that version or of any later version published by the Free Software Foundation.  If the Program does not specify a version number of this License, you may choose any version ever published by the Free Software Foundation.

  10. If you wish to incorporate parts of the Program into other free programs whose distribution conditions are different, write to the author to ask for permission.  For software which is copyrighted by the Free Software Foundation, write to the Free Software Foundation; we sometimes make exceptions for this.  Our decision will be guided by the two goals of preserving the free status of all derivatives of our free software and of promoting the sharing and reuse of software generally.

NO WARRANTY

  11. BECAUSE THE PROGRAM IS LICENSED FREE OF CHARGE, THERE IS NO WARRANTY FOR THE PROGRAM, TO THE EXTENT PERMITTED BY APPLICABLE LAW.  EXCEPT WHEN OTHERWISE STATED IN WRITING THE COPYRIGHT HOLDERS AND/OR OTHER PARTIES PROVIDE THE PROGRAM "AS IS" WITHOUT WARRANTY OF ANY KIND, EITHER EXPRESSED OR IMPLIED, INCLUDING, BUT NOT LIMITED TO, THE IMPLIED WARRANTIES OF MERCHANTABILITY AND FITNESS FOR A PARTICULAR PURPOSE.  THE ENTIRE RISK AS TO THE QUALITY AND PERFORMANCE OF THE PROGRAM IS WITH YOU.  SHOULD THE PROGRAM PROVE DEFECTIVE, YOU ASSUME THE COST OF ALL NECESSARY SERVICING, REPAIR OR CORRECTION.

  12. IN NO EVENT UNLESS REQUIRED BY APPLICABLE LAW OR AGREED TO IN WRITING WILL ANY COPYRIGHT HOLDER, OR ANY OTHER PARTY WHO MAY MODIFY AND/OR REDISTRIBUTE THE PROGRAM AS PERMITTED ABOVE, BE LIABLE TO YOU FOR DAMAGES, INCLUDING ANY GENERAL, SPECIAL, INCIDENTAL OR CONSEQUENTIAL DAMAGES ARISING OUT OF THE USE OR INABILITY TO USE THE PROGRAM (INCLUDING BUT NOT LIMITED TO LOSS OF DATA OR DATA BEING RENDERED INACCURATE OR LOSSES SUSTAINED BY YOU OR THIRD PARTIES OR A FAILURE OF THE PROGRAM TO OPERATE WITH ANY OTHER PROGRAMS), EVEN IF SUCH HOLDER OR OTHER PARTY HAS BEEN ADVISED OF THE POSSIBILITY OF SUCH DAMAGES.

END OF TERMS AND CONDITIONS

		</textarea></center><br/>
		<input type="checkbox" name="agree" value="1" /><font style="font-size:.8em; font-weight:bold;">&nbsp;&nbsp;I have read and agree to the GNU license agreement. <font color="#A61F11">(required)</font></font><br /><br/>
		<input type="hidden" name="fid" value="1"/><br/>
		<center><input class="submit" type="submit" name="submit" value="DOWNLOAD"/></center><br/>

	</fieldset>
	</form>
</div>
</center>
</div> <!-- End container -->
</body>
</html>
