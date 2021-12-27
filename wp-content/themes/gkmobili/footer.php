
<?php if(premmerce_option('footer-before')) :?>
	<div class="page__before-footer">
		<div class="page__container">
			<?php echo do_shortcode(premmerce_option('footer-before')); ?>
		</div>
	</div>
<?php endif; ?>

</div><!-- .page__content -->

</div><!-- .page__wrapper -->

<!-- Footer -->
<footer class="page__fgroup">
	<div class="prefooter">
		<div class="prefooter_inner">
			<div class="foot_infocols">
				<div class="foot_info_img">
					<img src="/wp-content/uploads/2021/11/icon_question.svg" alt="question">
				</div>
				<div class="foot_info_text">
					<?php _e("A question? Write to us at<br>","footer_translations"); ?><b>info@hthemeboutique.gr</b>
				</div>
			</div>
			<div class="foot_infocols">
				<div class="foot_info_img">
					<img src="/wp-content/uploads/2021/10/icon_payment.svg" alt="secure payments">
				</div>
				<div class="foot_info_text">
				<?php _e("Secure credit card<br>Payments","footer_translations"); ?>
				</div>
			</div>
			<div class="foot_infocols">
				<div class="foot_info_img">
					<img src="/wp-content/uploads/2021/10/icon_delivery.svg" alt="free shipping">
				</div>
				<div class="foot_info_text">
					<?php _e("Free Shipping in Greece<br>for Οrders over 59€","footer_translations"); ?>
				</div>
			</div>
			<div class="foot_infocols">
				<div class="foot_info_img">
					<img src="/wp-content/uploads/2021/10/icon_phone.svg" alt="phone orders">	
				</div>
				<div class="foot_info_text">
					<?php _e("Phone Orders:<br>210-4171136","footer_translations"); ?>
				</div>
			</div>
			
		</div>
	</div>
	<?php echo do_shortcode('[footer-site-logo]'); ?>

	<?php if (is_front_page() && get_theme_mod('homepage-seo-text') && apply_filters('premmerce-homepage-footer-seo-text', true)) :?>
			<div class="page__container">
				<div class="page__seo-text">
					<div class="typo typo--seo">
						<?php echo wp_kses_post(prepend_attachment(premmerce_option('homepage-seo-text'))); ?>
					</div>
				</div>
			</div>
	<?php endif;?>

    <?php do_action('premmerce_before_footer_1'); ?>

    <?php if(premmerce_option('footer_1')) :?>
    <div class="page__footer">
        <div class="page__container">
            <div class="footer">
                <?php $footer_columns = premmerce_option('footer_columns'); ?>
                <div class="footer__row footer__row--columns-<?php echo esc_attr($footer_columns); ?>">
                    <?php for ($i = 1; $i <= $footer_columns; $i++): ?>
                        <?php if (is_active_sidebar('footer_'. $i)): ?>
                            <div class="footer__col">
                                <?php dynamic_sidebar('footer_'. $i); ?>
                            </div>
                        <?php endif; ?>
                    <?php endfor; ?>
                </div>
            </div>
        </div>
    </div>
    <?php endif; ?>

	<?php do_action('premmerce_before_footer_2'); ?>

	<?php if(premmerce_option('footer_2')) :?>
	<div class="page__basement">
		<div class="page__container">
			<div class="basement">
				<div class="basement_inner">
					<div class="basement_one">
						<?php echo do_shortcode(premmerce_option('footer-copyright')); ?>
					</div>
					<div class="basement_two ht_logo"  id="ht_logo">
					
					<div class="copyright_cnt">
							<a title="Κατασκευή Ιστοσελίδων Hellenic Technologies" href="https://hellenictechnologies.com" style="display: flex;align-items: center;text-decoration:none;"><span style="color:#616161;margin-right:10px;"><?php _e("Κατασκευή & Συντήρηση Ιστοσελιδών","signature"); ?></span><img src="//assets.hellenictechnologies.com/img/logo_full_normal.svg" alt="Κατασκευή και Προώθηση Ιστοσελίδων Hellenic Technologies" width="100px" height="45.83"></a>
						</div>
					
					</div>
				</div>
			</div>
		</div>
	</div>
	<?php endif; ?>

</footer>

</div><!-- /.page__*-layout -->
</div><!-- /.page__body -->

<!-- Mobile slide frame -->
<div class="page__mobile" data-page-pushy-mobile>
    <?php get_template_part('parts/mobile-menu/mobile', 'frame'); ?>
</div>

<!-- Site background overlay when mobile menu is open -->
<div class="page__overlay hidden" data-page-pushy-overlay></div>

<?php wp_footer() ?>
</body>
</html>
