<?php
/**
 * @var array $data List key => value of specific setting.
 * @var Es_Settings_Container $es_settings.
 * @var string $name Name of setting.
 * @var string $label Field name.
 */
$i = 0; ?>

<div class="es-settings-field"><label><span class="es-settings-label"><?php echo $label; ?>:</span>
    <?php foreach ( $data as $value => $label ) : $i++; ?>
        <input class="radio" type="radio" id="es-for-<?php echo $name . $i; ?>" <?php checked( $value, $es_native_options->{$name} ); ?> name="es_native_options[<?php echo $name; ?>]" value="<?php echo $value; ?>">
        <label for="es-for-<?php echo $name . $i; ?>"><?php echo $label; ?></label><span class="es-space"></span>
        <?php endforeach; ?>
</label></div>
