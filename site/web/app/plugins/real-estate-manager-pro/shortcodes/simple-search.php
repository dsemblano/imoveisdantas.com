<div class="ich-settings-main-wrap">
    <div class="rem-simple-search" style="max-width: <?php echo $width; ?>; margin:0 auto;border-color: <?php echo $border_color; ?> !important;">
        <form method="GET" action="<?php echo $results_page; ?>">
            <div class="input-group">
                <input name="simple_search" type="text" class="form-control input-lg" value="<?php echo (isset($_GET['simple_search'])) ? esc_attr( $_GET['simple_search'] ) : '' ; ?>" placeholder="<?php echo $placeholder; ?>" />
                <?php if ($search_in != '') { ?>
                    <input type="hidden" name="rem_search_in" value="<?php echo $search_in; ?>">
                <?php } ?>
                 <?php if ($cat != '') { ?>
                    <input type="hidden" name="rem_cat" value="<?php echo $cat; ?>">
                <?php } ?>
                <?php
                    $wpml_current_language = apply_filters( 'wpml_current_language', NULL );
                    if ($wpml_current_language) {
                        echo '<input type="hidden" name="lang" value="'.$wpml_current_language.'">';
                    }
                ?>
                <span class="input-group-btn">
                    <button class="btn btn-info btn-lg" type="submit" style="border-color: <?php echo $border_color; ?> !important;">
                        <?php echo $search_icon; ?>
                    </button>
                </span>
            </div>
        </form>
    </div>
</div>