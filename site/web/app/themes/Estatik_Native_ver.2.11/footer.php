<?php global $es_native_options; ?>
<?php if ( is_active_sidebar( 'bottom-color-sidebar' ) ):?><div class="color-bottom-sidebar"><div class="color-bottom-sidebar__container"><?php dynamic_sidebar( 'bottom-color-sidebar' ); ?></div></div><?php endif;?>
<?php if ( is_active_sidebar( 'bottom-sidebar' ) ):?><div class="bottom-sidebar"><?php dynamic_sidebar( 'bottom-sidebar' ); ?></div><?php endif;?>
</main>
<footer>
    <div class="footer">
		<?php if ( ! empty( $es_native_options->instagram_link ) || ! empty( $es_native_options->facebook_link ) || ! empty( $es_native_options->google_plus_link ) || ! empty( $es_native_options->linkedin_link )
		           || ! empty( $es_native_options->twitter_link) || ! empty( $es_native_options->youtube_link) || ! empty( $es_native_options->pinterest_link ) ): ?>
            <div class="footer__socials">
				<?php if ( ! empty( $es_native_options->youtube_link ) ): ?>
                    <a href="<?php echo $es_native_options->youtube_link; ?>" target="_blank">
                        <i class="fa fa-youtube" aria-hidden="true"></i>
                    </a>
				<?php endif; ?>
				<?php if ( ! empty( $es_native_options->facebook_link ) ): ?>
                    <a href="<?php echo $es_native_options->facebook_link; ?>" target="_blank">
                        <i class="fa fa-facebook" aria-hidden="true"></i>
                    </a>
				<?php endif; ?>
				<?php if ( ! empty( $es_native_options->pinterest_link ) ): ?>
                    <a href="<?php echo $es_native_options->pinterest_link; ?>" target="_blank">
                        <i class="fa fa-pinterest" aria-hidden="true"></i>
                    </a>
				<?php endif; ?>
                <?php if ( ! empty( $es_native_options->instagram_link ) ): ?>
                    <a href="<?php echo $es_native_options->instagram_link; ?>" target="_blank">
                        <i class="fa fa-instagram" aria-hidden="true"></i>
                    </a>
                <?php endif; ?>
				<?php if ( ! empty( $es_native_options->google_plus_link ) ): ?>
                    <a href="<?php echo $es_native_options->google_plus_link; ?>" target="_blank">
                        <i class="fa fa-google-plus"></i>
                    </a>
				<?php endif; ?>
				<?php if ( ! empty( $es_native_options->linkedin_link ) ): ?>
                    <a href="<?php echo $es_native_options->linkedin_link; ?>" target="_blank">
                        <i class="fa fa-linkedin" aria-hidden="true"></i>
                    </a>
				<?php endif; ?>
				<?php if ( ! empty( $es_native_options->twitter_link ) ): ?>
                    <a href="<?php echo $es_native_options->twitter_link; ?>" target="_blank">
                        <i class="fa fa-tumblr" aria-hidden="true"></i>
                    </a>
				<?php endif; ?>
            </div>
		<?php endif; ?>
        <div class="footer__copyright">
			<?php echo stripslashes($es_native_options->copyright); ?>
        </div>
    </div>
</footer>
<?php wp_footer();?>
</body>
</html>
