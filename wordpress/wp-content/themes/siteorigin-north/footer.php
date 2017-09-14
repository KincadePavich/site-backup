<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package siteorigin-north
 * @license GPL 2.0 
 */

?>

		</div><!-- .container -->
	</div><!-- #content -->

	<?php do_action( 'siteorigin_north_footer_before' ); ?>

	<footer id="colophon" class="site-footer <?php if ( ! siteorigin_setting( 'footer_constrained' ) ) echo 'unconstrained-footer'; if ( is_active_sidebar( 'footer-sidebar' ) ) echo ' footer-active-sidebar'; ?>" role="contentinfo">
		
		<?php do_action( 'siteorigin_north_footer_top' ); ?>
		
		<?php if ( ! siteorigin_page_setting( 'hide_footer_widgets', false ) && ! in_array( siteorigin_page_setting( 'layout' ), array( 'stripped' ), true ) ) : ?>
			<div class="container">

				<?php
				if ( is_active_sidebar( 'footer-sidebar' ) ) {
					$siteorigin_north_sidebars = wp_get_sidebars_widgets();
					?>
					<div class="widgets widget-area widgets-<?php echo count( $siteorigin_north_sidebars['footer-sidebar'] ) ?>" role="complementary" aria-label="<?php esc_html_e( 'Footer Sidebar', 'siteorigin-north' ); ?>">
						<?php dynamic_sidebar( 'footer-sidebar' ); ?>
					</div>
					<?php
				}
				?>

			</div><!-- .container -->
		<?php endif; ?>

		<div class="site-info">
			<div class="container">
			<div id="TLS13"><a href="/wordpress/docs/tls13/">
				<h1>TLS 1.3 Now Available</h1>
				<h2>Test out the BETA today!</h2>
			</a></div>
			<div id="footerProducts">
				<div class="footerBox"><a href="/wordpress/products/wolfssl/">
					<h2>wolfSSL 3.12.0</h2>
					<p>Release 3.12.0 includes a vulnerability fix, TLS 1.3 support, Intel assembly improvements and SGX Linux support, DTLS multicast, Xilinx port, SHA3 (Keccak), and more! Click to read more.</p>
				<a/></div>
				<div class="footerBox"><a href="/wordpress/products/wolfcrypt/">
					<h2>wolfCrypt Crypto Engine</h2>
					<p>The wolfCrypt Crypto engine is a lightweight, embeddable, and easy-to-configure crypto library with a strong focus on portability, modularity, security, and feature set. Click to read more.</p>
				</a></div>
				<div id="rightFooterBox" class="footerBox"><a href="/wordpress/license/fips/">
					<h2>wolfCrypt FIPS Module</h2>
					<p>The Cryptographic Module Validation Program (CMVP) has issued FIPS 140-2 Certificate #2425 for the wolfCrypt Module developed by wolfSSL Inc.
Click to read more.</p>
				</a></div>

			<div id="footer"><div id="innerFooter">
			<div class="lowNav">
				<p class="footText">Product Information</p>
				<ul class="lowNavList">
					<a href="/wordpress/products/wolfssl/"><li>wolfSSL TLS Library</li></a>
					<a href="/wordpress/products/wolfcrypt/"><li>wolfCrypt Crypto Engine</li></a>
					<a href="/wordpress/products/wolfmqtt/"><li>wolfMQTT Client Library</li></a>
					<a href="/wordpress/products/wolfssh/"><li>wolfSSH SSH Library</li></a>
					<a href="/wordpress/license/"><li>License Information</li></a>
				</ul>
			</div>
			<div class="lowNav">
				<p class="footText">Documentation</p>
				<ul class="lowNavList">
					<a href="/wordpress/docs/wolfssl-manual/"><li>wolfSSL Manual</li></a>
					<a href="/wordpress/docs/wolfssl-manual/ch17/"><li>wolfSSL API Reference</li></a>
					<a href="/wordpress/docs/wolfssl-manual/ch2/"><li>Building wolfSSL</li></a>
					<a href="/wordpress/docs/wolfssl-manual/ch11/"><li>SSL Tutorial</li></a>
					<a href="/wordpress/docs/"><li>Additional Documentation</li></a>
				</ul>
			</div>
			<div id="lowCenter">
				<p class="footText" id="center">Copyright &#169 2017 wolfSSL Inc.<br>All rights reserved.</p>
				<div id="socialIcons">
					<a href="https://twitter.com/wolfssl" target="_blank"><img src="/wordpress/wp-content/uploads/2017/07/twitter.png" alt="Twitter"/></a>
					<a href="https://www.facebook.com/wolfssl" target="_blank"><img src="/wordpress/wp-content/uploads/2017/07/facebook.png" alt="Facebook"/></a>
					<a href="https://www.github.com/wolfssl" target="_blank"><img src="/wordpress/wp-content/uploads/2017/07/github.png" alt="Github"/></a>
					<a href="https://www.linkedin.com/company-beta/461500/" target="_blank"><img src="/wordpress/wp-content/uploads/2017/07/linkedin.png" alt="Linkedin"/></a>
					<a href="https://www.flickr.com/photos/54654493@N05/" target="_blank"><img src="/wordpress/wp-content/uploads/2017/07/flickr.png" alt="Flickr"/></a>
				</div>
                <div id="madeInUsa"><img src="/wordpress/wp-content/uploads/2017/07/madeInUsa.png" alt="Made in the USA"></div>
			</div>
			<div class="lowNav">
				<p class="footText">Help and Support</p>
				<ul class="lowNavList">
					<a href="https://www.wolfssl.com/forums/"><li>Support Forum</li></a>
					<a href="/wordpress/download/support-packages/"><li>Support Packages</li></a>
					<a href="/wordpress/docs/consulting/"><li>Consulting Services</li></a>
					<a href="/wordpress/docs/security-vulnerabilities/"><li>Vulnerability Info</li></a>
					<a href="/wordpress/contact/"><li>Contact Us</li></a>
				</ul>
			</div>
			<div class="lowNav" id="lastLowNav">
				<p class="footText">Reference</p>
				<ul class="lowNavList">
					<a href="/wordpress/docs/wolfssl-manual/appendix-b/"><li>Algorithm/Protocol Reference</li></a>
					<a href="/wordpress/docs/media/"><li>Presentations</li></a>
                    <a href="/wordpress/directory/"><li>Site Directory</li></a>
				</ul>
			</div>
		</div></div>
        <div class="push"></div>
			<div id="conferences">
            <a href="https://www.iottechexpo.com/northamerica/" target="_blank"><img id="conf3" class="conf" src="/wordpress/wp-content/uploads/2017/08/IoT-tech-expo.png"></a>
            <a href="http://www.sensorsmidwest.com/" target="_blank"><img id="conf2" class="conf" src="/wordpress/wp-content/uploads/2017/08/smw17.jpg" alt="Sensors Midwest 2017"></a>
			</div>
		</div><!-- .site-info -->

		<?php do_action( 'siteorigin_north_footer_bottom' ); ?>

	</footer><!-- #colophon -->
</div><!-- #page -->

<?php if ( siteorigin_setting( 'navigation_scroll_to_top' ) && siteorigin_page_setting( 'layout' ) !== 'stripped' ) : ?>
	<div id="scroll-to-top">
		<span class="screen-reader-text"><?php esc_html_e( 'Scroll to top', 'siteorigin-north' ); ?></span>
		<?php siteorigin_north_display_icon( 'up-arrow' ); ?>
	</div>
<?php endif; ?>

<?php wp_footer(); ?>
<!-- Highlight parent page link when on child page -->
<?php if (is_page()) {   //  displaying a child page ?>
    <script type="text/javascript">
        jQuery("li.current-page-ancestor").addClass('current-menu-item');
    </script>
<?php } ?>
</body>
</html>
