<?php if ( $list = Es_Archive_Sorting::get_sorting_dropdown_values() ):
    $sort = isset( $sort ) ? $sort : null;
    $shortcode_identifier = ! empty( $shortcode_identifier ) ? $shortcode_identifier : '';
    $shortcode_identifier_temp = $shortcode_identifier ? '-' . $shortcode_identifier : '';
    $current_value = sanitize_key( filter_input( INPUT_GET, 'view_sort' . $shortcode_identifier_temp ) );
    $current_value = $current_value ? $current_value : $sort;

    $name = ! $shortcode_identifier ? 'view_sort' : 'view_sort-' . $shortcode_identifier; ?>

	<ul class="listing__sort-list">
		<?php foreach ( $list as $key => $value ) : ?>
			<li <?php echo $key == $current_value ? 'class="active"' : ''; ?>>
				<a href="<?php echo add_query_arg( $name, $key,
					es_get_current_url() ); ?>"><?php echo $value; ?></a>
			</li>
		<?php endforeach; ?>
	</ul>
<?php endif;
