<?php

/**
 * @file content-archive.php
 * Archive single property template.
 *
 * @var Es_Property $es_property
 * @var Es_Settings_Container $es_settings
 */

global $es_settings;
$es_property = es_get_property( get_the_ID() ); ?>
<li id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<div class="listing__property-inner">
		<div class="listing__property-thumbnail">
			<div class="listing__thumbnail">
                <div class="listing__btn-wrap">
					<?php if ( ! empty( $es_property->latitude ) && ! empty( $es_settings->google_api_key ) ) : ?>
                        <a href="#" class="btn-black es-map-view-link"
                           data-longitude="<?php echo $es_property->longitude; ?>"
                           data-latitude="<?php echo $es_property->latitude; ?>"><?php _e( 'View on map',
								'es-native' ); ?>
                        </a>
					<?php endif; ?>
                    <a href="<?php the_permalink(); ?>"
                       class="theme-btn"><?php _e( 'Details',
							'es-native' ); ?>
                    </a>
                </div>
				<div class="listing__img-wrapper list-img" >
					<?php if ( ! empty( $es_property->gallery ) ) : $images = $es_property->gallery; ?>
                    <?php $image_src =  wp_get_attachment_image_url( $images[0], 'es-image-size-archive' );?>
                        <div class="listing__image" style="background-image: url('<?php echo esc_attr( $image_src );?>')"><div class="listing__image-background"></div></div>
					<?php else: ?>
                        <div class="listing__image" style="background-image: url(<?php echo ES_NATIVE_URL . 'assets/images/no-home.jpg';?>)">
	                        <div class="listing__image-background"></div>
                        </div>
					<?php endif; ?>
				</div>
                <div class="listing__icon-wrapper listing__icon--thumbnail">
                    <span class="listing__icon-bottom-icon">
                        <i class="listing__icon-photo"></i><?php echo count( $es_property->gallery ) . __( ' photos', 'es-native' ); ?></span>
                    <span class="listing__icon-bottom-icon">
                        <i class="listing__icon-squirefit" aria-hidden="true"></i> <?php es_the_formatted_area(); ?>
                    </span>
	                <?php es_the_formatted_bedrooms( '<span class="listing__icon-bottom-icon"><i class="listing__icon-bed" aria-hidden="true"></i> ',
		                '</span>', true ); ?>
	                <?php es_the_formatted_bathrooms( '<span class="listing__icon-bottom-icon"><i class="listing__icon-bath" aria-hidden="true"></i> ',
		                '</span>', true ); ?>
                </div>
			</div>
		</div>

		<div class="listing__property-info-wrap">
		<div class="listing__property-info">
			<?php if ( $es_settings->show_labels ) : ?>
                <ul class="listing__property-label-wrap listing__property-label-wrap--list">
					<?php foreach ( $es_property->get_labels_list() as $label ) :
						$value = $es_property->{$label->slug}; ?>
						<?php if ( ! empty( $value ) ) : ?>
						<li class="listing__property-label listing__property-label-<?php echo $label->slug; ?>"
						    style="background-color:<?php echo es_get_the_label_color( $label->term_id ); ?>"><?php _e( $label->name,
								'es-native' ); ?></li>
					<?php endif; ?>
					<?php endforeach; ?>
                </ul>
			<?php endif; ?>
			<h2>
				<a href="<?php the_permalink(); ?>"><?php es_the_title(); ?></a>
				<?php es_the_formatted_price(); ?>
			</h2>
            <div class="listing__content-block">
				<?php the_excerpt();?>
            </div>
            <div class="listing__icon-wrapper listing__icon--property-info">
                    <span class="listing__icon-bottom-icon">
                        <i class="listing__icon-photo"></i><?php echo count( $es_property->gallery ) . __( ' photos', 'es-native' ); ?></span>
                <span class="listing__icon-bottom-icon">
                        <i class="listing__icon-squirefit" aria-hidden="true"></i> <?php es_the_formatted_area(); ?>
                    </span>
				<?php es_the_formatted_bedrooms( '<span class="listing__icon-bottom-icon"><i class="listing__icon-bed" aria-hidden="true"></i> ',
					'</span>', true ); ?>
				<?php es_the_formatted_bathrooms( '<span class="listing__icon-bottom-icon"><i class="listing__icon-bath" aria-hidden="true"></i> ',
					'</span>', true ); ?>
            </div>
			<?php if ( $es_settings->show_labels ) : ?>
                <ul class="listing__property-label-wrap listing__property-label-wrap--grid">
					<?php
					foreach ( $es_property->get_labels_list() as $label ) :
						$value = $es_property->{$label->slug}; ?>
						<?php if ( ! empty( $value ) ) : ?>
                        <li class="listing__property-label listing__property-label-<?php echo $label->slug; ?>"
                            style="background-color:<?php echo es_get_the_label_color( $label->term_id ); ?>"><?php _e( $label->name,
								'es-native' ); ?></li>
					<?php endif; ?>
						<?php
					endforeach; ?>
                </ul>
			<?php endif; ?>
		</div>
		</div>

	</div>
</li>
