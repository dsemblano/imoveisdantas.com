<?php

/**
 * @file content-post-archive.php
 * Archive single template.
 */
$thumbnail = get_the_post_thumbnail(); ?>
<a class="content-block__title" href="<?php echo esc_url( get_permalink() ); ?>" rel="bookmark">
    <div class="content-block__image"
		<?php if ( empty( $thumbnail ) ): ?>
            style="background-image: url(<?php echo ES_NATIVE_URL . 'assets/images/no-image.png'; ?>);"
		<?php endif; ?>>
		<?php if ( $thumbnail ): ?>
			<?php the_post_thumbnail( 'native-archive' ); ?>
		<?php endif; ?>
    </div>
	<?php the_title( '<span>', '</span>' ); ?>
</a>
<div class="article-block__header">
		<span class="article-block__tags">
			 <?php the_tags( '', ', ' ); ?>
		 </span>
</div>
<div class="content-block__content">
	<?php the_excerpt(); ?>
</div>
<div class="article-block__footer">
    <p class="article-block__posted">
        <i class="glyphicon-bookmark"></i>
        <span><?php _e( 'Posted in', 'es-native' ); ?> <?php the_category(', ');?></span>
    </p>
    <p class="article-block__date">
        <i class="fa fa-clock-o" aria-hidden="true"></i>
		<?php echo get_the_date( 'l M d g:i a' ); ?>
    </p>
    <p class="article-block__reply">
        <i class="glyphicon-comment"></i>
        <span><?php comments_number(); ?></span>
    </p>
    <div class="button__wrap"><a class="native__button" href="<?php the_permalink();?>"><?php _e( 'Continue reading', 'es-native' );?></a></div>
</div>
