<?php
/**
 * Metro Magazine Metabox
 * 
 * @package Metro_Magazine
 */

add_action( 'add_meta_boxes', 'metro_magazine_add_sidebar_layout_box' );

function metro_magazine_add_sidebar_layout_box(){
    add_meta_box( 
        'metro_magazine_sidebar_layout',
        __( 'Sidebar Layout', 'metro-magazine' ),
        'metro_magazine_sidebar_layout_callback', 
        'page',
        'normal',
        'high'
    );
}


$metro_magazine_sidebar_layout = array(
    'right-sidebar' => array(
        'value'=> 'right-sidebar',
        'label'=> __( 'Right Sidebar(default)', 'metro-magazine'),
        'thumbnail'=> get_template_directory_uri() . '/images/right-sidebar.png'         
    ),
    'no-sidebar' => array(
        'value' => 'no-sidebar',
        'label' => __('No Sidebar','metro-magazine'),
        'thumbnail'=> get_template_directory_uri() . '/images/no-sidebar.png'
    )
);

function metro_magazine_sidebar_layout_callback(){
    global $post, $metro_magazine_sidebar_layout;
    wp_nonce_field( basename( __FILE__ ), 'metro_magazine_nonce' ); ?>    
    <table class="form-table">
        <tr>
            <td colspan="4"><em class="f13"><?php esc_html_e( 'Choose Sidebar Template', 'metro-magazine' ); ?></em></td>
        </tr>
        <tr>
            <td>
            <?php  
                foreach( $metro_magazine_sidebar_layout as $field ){  
                    $layout = get_post_meta( $post->ID, 'metro_magazine_sidebar_layout', true ); ?>

                <div class="radio-image-wrapper" style="float:left; margin-right:30px;">
                    <label class="description">
                        <span><img src="<?php echo esc_url( $field['thumbnail'] ); ?>" alt="<?php echo esc_attr( $field['label'] ); ?>" /></span><br/>
                        <input type="radio" name="metro_magazine_sidebar_layout" value="<?php echo esc_attr( $field['value'] ); ?>" <?php checked( $field['value'], $layout ); if( empty( $layout ) && $field['value']=='right-sidebar'){ checked( $field['value'], 'right-sidebar' ); }?>/>&nbsp;<?php echo esc_html( $field['label'] ); ?>
                    </label>
                </div>
                <?php } // end foreach 
                ?>
                <div class="clear"></div>
            </td>
        </tr>
    </table>
    <?php 
}

/**
 * save the custom metabox data
 * @hooked to save_post hook
 */
function metro_magazine_save_sidebar_layout( $post_id ){
    global $metro_magazine_sidebar_layout;

    // Verify the nonce before proceeding.
    if( !isset( $_POST[ 'metro_magazine_nonce' ] ) || !wp_verify_nonce( $_POST[ 'metro_magazine_nonce' ], basename( __FILE__ ) ) )
        return;
    
    // Stop WP from clearing custom fields on autosave
    if( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE )  
        return;

    if( 'page' == $_POST['post_type']){  
        if( ! current_user_can( 'edit_page', $post_id ) ) return $post_id;  
    }elseif( ! current_user_can( 'edit_post', $post_id ) ){  
        return $post_id;  
    }

    $layout = isset( $_POST['metro_magazine_sidebar_layout'] ) ? sanitize_key( $_POST['metro_magazine_sidebar_layout'] ) : 'right-sidebar';

    if( array_key_exists( $layout, $metro_magazine_sidebar_layout ) ){
        update_post_meta( $post_id, 'metro_magazine_sidebar_layout', $layout );
    }else{
        delete_post_meta( $post_id, 'metro_magazine_sidebar_layout' );
    }  
}
add_action('save_post' , 'metro_magazine_save_sidebar_layout');