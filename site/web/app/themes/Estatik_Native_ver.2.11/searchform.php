<div class="post-search-form">
	<form class="post-search-form__form"  role="search" method="get" id="searchform" action="<?php echo esc_url( home_url( '/' ) ); ?>">
        <div class="post-search-form__input-wrap"><input class="post-search-form__input" type="text" placeholder="<?php _e('Enter key word', 'es-native') ?>" value="<?php echo get_search_query(); ?>" name="s"></div>
		<button class="post-search-form__button" type="submit"><?php _e( 'Search', 'es-native' );?></button>
	</form>
</div>
