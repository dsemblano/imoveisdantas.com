<?php if ( es_subscription_is_enabled() ) : ?>
	<div class="es-subscription-table-wrapper">
		<?php if ( $items = es_get_subscriptions() ) : ?>
			<form action="" method="POST">
				<div class="es-subscription-table-container">
					<table class="es-subscription-table" border="0">
						<?php if ( $rows = Es_Subscription_Table::get_header_rows_data() ) : ?>
							<thead>
							<tr>
								<?php foreach ( $rows as $id => $label ) : ?>
									<th class="es-subscription-header-row es-header-row-<?php echo $id; ?>"><?php echo $label; ?></th>
								<?php endforeach; ?>
							</tr>
							</thead>
						<?php endif; ?>

						<tbody>
						<?php foreach ( $items as $item ) : ?>
							<tr>
								<?php foreach ( $rows as $id => $label ) : ?>
									<td class="es-subscription-body-row es-row-<?php echo $id; ?>">
										<?php do_action( 'es_subscription_render_table_row_value', $item, $id, $label ); ?>
									</td>
								<?php endforeach; ?>
							</tr>

							<?php if ( $item->post_excerpt ) : ?>
								<tr class="es-description-row hide">
									<td></td>
									<td colspan="<?php echo count($rows) -1; ?>"><?php echo $item->post_excerpt; ?></td>
								</tr>
							<?php endif; ?>

						<?php endforeach; ?>
						</tbody>
					</table>
				</div>

				<?php wp_nonce_field( 'es_subscription_checkout', 'es_subscription_checkout' ); ?>

				<div class="es-table-foot">
					<span class="es-table-total" style="display: inline;"><?php _e( 'Total', 'es-native'); ?>: <span class="es-table-total-value"></span></span>
					<input type="submit" class="theme-btn js-btn-submit" value="<?php _e( 'Proceed', 'es-native'); ?>">
				</div>

			</form>
		<?php endif; ?>
	</div>
<?php endif;
