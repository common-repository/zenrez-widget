<?php // Zenrez - settings

defined( 'ABSPATH' ) or die;

function zenrez_display_settings_page() {
    // check if user is allowed access
     if ( ! current_user_can( 'manage_options' ) ) return;
     ?>
     <div class="wrap">
         <h1><?php echo esc_html( get_admin_page_title() ); ?></h1>
         <form id="ajax-form" action="options.php" method="post">
             <?php
             // output security fields
             settings_fields( 'zenrez_options' );
             
             // output setting sections
             do_settings_sections( 'zenrez' );
             
             // submit button
             submit_button();
             ?>
         </form>
         <p id="ajax-response"></p>
     </div>
     <?php
 }


 