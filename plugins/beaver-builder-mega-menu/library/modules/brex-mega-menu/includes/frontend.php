<nav>
    <div class="brex-mega-menu-desktop">
        <?php
            $module->renderMenuFrontend();
        ?>
    </div>
    <div class="brex-mobile-menu-icon">
        <a>
            <?php
            echo sprintf(
                '<i class="%s"></i>',
                $settings->mobile_menu_icon
            );
            ?>
        </a>
    </div>
</nav>



<?php

add_action( 'wp_footer', function() use ($id, $settings, $module) {
    ?>
    <div class="fl-node-<?php echo $id;?> brex-mobile-menu-container-node">
        <div class="brex-mobile-menu-container brex-mobile-menu-<?php echo $settings->mobile_menu_slide_in_side;?>">
            <?php

            if ( $settings->mobile_menu_slide_enable_close_icon === 'enabled' ){
                echo sprintf(
                    "<div class=\"close-icon\"><i class=\"%s\"></i></div>",
                    $settings->mobile_menu_close_icon
                );
            }

            if ( $settings->mobile_menu_id === 'mobile_menu_mega_menu' ){
                $module->renderMenuFrontend();
            }
            else {
                wp_nav_menu( 
                    array(
                        'menu'       => $settings->mobile_menu_id,
                        'menu_class' => 'brex-mobile-menu-inner',
                        'echo'       => true,
                        'container'  => false
                    )
                );
            }
            ?>
        </div>
    </div>
    <?php
});
