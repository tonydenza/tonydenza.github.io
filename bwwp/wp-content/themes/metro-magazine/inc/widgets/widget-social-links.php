<?php
/**
 * Widget Social Links
 *
 * @package Metro_Magazine
 */

// register Metro_Magazine_Social_Links widget 
function metro_magazine_register_social_links_widget() {
    register_widget( 'Metro_magazine_Social_Links' );
}
add_action( 'widgets_init', 'metro_magazine_register_social_links_widget' );
 
 /**
 * Adds Metro_Magazine_Social_Links widget.
 */
class Metro_Magazine_Social_Links extends WP_Widget {

	/**
	 * Register widget with WordPress.
	 */
	function __construct() {
		parent::__construct(
			'metro_magazine_social_links', // Base ID
			esc_html__( 'RARA: Social Links', 'metro-magazine' ), // Name
			array( 'description' => esc_html__( 'A Social Links Widget', 'metro-magazine' ), ) // Args
		);
	}

	/**
	 * Front-end display of widget.
	 *
	 * @see WP_Widget::widget()
	 *
	 * @param array $args     Widget arguments.
	 * @param array $instance Saved values from database.
	 */
	public function widget( $args, $instance ) {
        
        $title       = ! empty( $instance['title'] ) ? sanitize_text_field( $instance['title'] ) : '';
        $facebook    = ! empty( $instance['facebook'] ) ? esc_url( $instance['facebook'] ) : '' ;
        $twitter     = ! empty( $instance['twitter'] ) ? esc_url( $instance['twitter'] ) : '' ;
        $pinterest   = ! empty( $instance['pinterest'] ) ? esc_url( $instance['pinterest'] ) : '' ;
        $linkedin    = ! empty( $instance['linkedin'] ) ? esc_url( $instance['linkedin'] ) : '' ;
        $instagram   = ! empty( $instance['instagram'] ) ? esc_url( $instance['instagram'] ) : '' ;
        $youtube     = ! empty( $instance['youtube'] ) ? esc_url( $instance['youtube'] ) : '' ;
        $google_plus = ! empty( $instance['google_plus'] ) ? esc_url( $instance['google_plus'] ) : '' ;
        $ok          = ! empty( $instance['ok'] ) ? esc_url( $instance['ok'] ) : '' ;
        $vk          = ! empty( $instance['vk'] ) ? esc_url( $instance['vk'] ) : '' ;
        $xing        = ! empty( $instance['xing'] ) ? esc_url( $instance['xing'] ) : '' ;
        $tiktok      = ! empty( $instance['tiktok'] ) ? esc_url( $instance['tiktok'] ) : '' ;
        
        if( $facebook || $instagram || $twitter || $pinterest || $linkedin || $youtube || $google_plus || $ok || $vk || $xing || $tiktok ){ 
        echo $args['before_widget'];
        
        if( $title ) echo $args['before_title'] . apply_filters( 'widget_title', $title, $instance, $this->id_base ) . $args['after_title'];
        ?>
            <ul class="social-networks">
				<?php if( $facebook ){ ?>
                <li><a href="<?php echo esc_url( $facebook ); ?>" title="<?php esc_attr_e( 'Facebook', 'metro-magazine' ); ?>" ><i class="fa fa-facebook"></i></a></li>
				<?php } if( $twitter ){ ?>
                <li><a href="<?php echo esc_url( $twitter ); ?>" title="<?php esc_attr_e( 'Twitter', 'metro-magazine' ); ?>" ><i class="fa fa-twitter"></i></a></li>
                <?php } if( $linkedin ){ ?>
                <li><a href="<?php echo esc_url( $linkedin ); ?>" title="<?php esc_attr_e( 'Linkedin', 'metro-magazine' ); ?>" ><i class="fa fa-linkedin"></i></a></li>
                <?php } if( $pinterest ){ ?>
                <li><a href="<?php echo esc_url( $pinterest ); ?>"  title="<?php esc_attr_e( 'Pinterest', 'metro-magazine' ); ?>" ><i class="fa fa-pinterest-p"></i></a></li>
                <?php } if( $instagram ){ ?>
                <li><a href="<?php echo esc_url( $instagram ); ?>" title="<?php esc_attr_e( 'Instagram', 'metro-magazine' ); ?>" ><i class="fa fa-instagram"></i></a></li>
                <?php } if( $google_plus ){ ?>
                <li><a href="<?php echo esc_url( $google_plus ); ?>" title="<?php esc_attr_e( 'GooglePlus', 'metro-magazine' ); ?>" ><i class="fa fa-google-plus"></i></a></li>
                <?php } if( $youtube ){ ?>
                <li><a href="<?php echo esc_url( $youtube ); ?>" title="<?php esc_attr_e( 'YouTube', 'metro-magazine' ); ?>" ><i class="fa fa-youtube"></i></a></li>
                <?php } if( $ok ){ ?>
                <li><a href="<?php echo esc_url( $ok ); ?>" target="_blank" title="<?php esc_attr_e( 'OK', 'metro-magazine' ); ?>"><span class="fa fa-odnoklassniki"></span></a></li>
                <?php } if( $vk ){ ?>
                <li><a href="<?php echo esc_url( $vk ); ?>" target="_blank" title="<?php esc_attr_e( 'VK', 'metro-magazine' ); ?>"><span class="fa fa-vk"></span></a></li>
                <?php } if( $xing ){ ?>
                <li><a href="<?php echo esc_url( $xing ); ?>" target="_blank" title="<?php esc_attr_e( 'Xing', 'metro-magazine' ); ?>"><span class="fa fa-xing"></span></a></li>
                <?php } if( $tiktok){ ?>
                <li><a href="<?php echo esc_url( $tiktok); ?>" target="_blank" title="<?php esc_attr_e( 'Tiktok', 'metro-magazine' ); ?>"><span class="fab fa-tiktok"></span></a></li>
                <?php } ?>
			</ul>
        <?php
        echo $args['after_widget'];
        }
	}

	/**
	 * Back-end widget form.
	 *
	 * @see WP_Widget::form()
	 *
	 * @param array $instance Previously saved values from database.
	 */
	public function form( $instance ) {
        
        $title       = ! empty( $instance['title'] ) ? sanitize_text_field( $instance['title'] ) : '';
        $facebook    = ! empty( $instance['facebook'] ) ? esc_url( $instance['facebook'] ) : '' ;
        $twitter     = ! empty( $instance['twitter'] ) ? esc_url( $instance['twitter'] ) : '' ;
        $pinterest   = ! empty( $instance['pinterest'] ) ? esc_url( $instance['pinterest'] ) : '' ;
        $linkedin    = ! empty( $instance['linkedin'] ) ? esc_url( $instance['linkedin'] ) : '' ;
        $instagram   = ! empty( $instance['instagram'] ) ? esc_url( $instance['instagram'] ) : '' ;
        $youtube     = ! empty( $instance['youtube'] ) ? esc_url( $instance['youtube'] ) : '' ;
        $google_plus = ! empty( $instance['google_plus'] ) ? esc_url( $instance['google_plus'] ) : '' ;
        $ok          = ! empty( $instance['ok'] ) ? esc_url( $instance['ok'] ) : '' ;
        $vk          = ! empty( $instance['vk'] ) ? esc_url( $instance['vk'] ) : '' ;
        $xing        = ! empty( $instance['xing'] ) ? esc_url( $instance['xing'] ) : '' ;
        $tiktok      = ! empty( $instance['tiktok'] ) ? esc_url( $instance['tiktok'] ) : '' ;
        
        ?>
		
        <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php esc_html_e( 'Title', 'metro-magazine' ); ?></label> 
            <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
		</p>
        
        <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'facebook' ) ); ?>"><?php esc_html_e( 'Facebook', 'metro-magazine' ); ?></label> 
            <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'facebook' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'facebook' ) ); ?>" type="text" value="<?php echo esc_attr( $facebook ); ?>" />
		</p>
        
        <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'instagram' ) ); ?>"><?php esc_html_e( 'Instagram', 'metro-magazine' ); ?></label> 
            <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'instagram' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'instagram' ) ); ?>" type="text" value="<?php echo esc_attr( $instagram ); ?>" />
		</p>
                
        <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'twitter' ) ); ?>"><?php esc_html_e( 'Twitter', 'metro-magazine' ); ?></label> 
            <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'twitter' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'twitter' ) ); ?>" type="text" value="<?php echo esc_attr( $twitter ); ?>" />
		</p>
        
        <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'pinterest' ) ); ?>"><?php esc_html_e( 'Pinterest', 'metro-magazine' ); ?></label> 
            <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'pinterest' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'pinterest' ) ); ?>" type="text" value="<?php echo esc_attr( $pinterest ); ?>" />
		</p>
        
        <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'linkedin' ) ); ?>"><?php esc_html_e( 'LinkedIn', 'metro-magazine' ); ?></label> 
            <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'linkedin' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'linkedin' ) ); ?>" type="text" value="<?php echo esc_url( $linkedin ); ?>" />
		</p>
        
        <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'google_plus' ) ); ?>"><?php esc_html_e( 'Google Plus', 'metro-magazine' ); ?></label> 
            <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'google_plus' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'google_plus' ) ); ?>" type="text" value="<?php echo esc_url( $google_plus ); ?>" />
        </p>

        <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'youtube' ) ); ?>"><?php esc_html_e( 'YouTube', 'metro-magazine' ); ?></label> 
            <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'youtube' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'youtube' ) ); ?>" type="text" value="<?php echo esc_url( $youtube ); ?>" />
		</p>
        
        <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'ok' ) ); ?>"><?php _e( 'OK', 'metro-magazine' ); ?></label> 
            <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'ok' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'ok' ) ); ?>" type="text" value="<?php echo esc_url( $ok ); ?>" />
		</p>
        
        <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'vk' ) ); ?>"><?php _e( 'VK', 'metro-magazine' ); ?></label> 
            <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'vk' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'vk' ) ); ?>" type="text" value="<?php echo esc_url( $vk ); ?>" />
		</p>
        
        <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'xing' ) ); ?>"><?php _e( 'Xing', 'metro-magazine' ); ?></label> 
            <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'xing' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'xing' ) ); ?>" type="text" value="<?php echo esc_url( $xing ); ?>" />
		</p>

        <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'tiktok' ) ); ?>"><?php _e( 'Tiktok', 'metro-magazine' ); ?></label> 
            <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'tiktok' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'tiktok' ) ); ?>" type="text" value="<?php echo esc_url( $tiktok ); ?>" />
		</p>
		<?php 
	}

	/**
	 * Sanitize widget form values as they are saved.
	 *
	 * @see WP_Widget::update()
	 *
	 * @param array $new_instance Values just sent to be saved.
	 * @param array $old_instance Previously saved values from database.
	 *
	 * @return array Updated safe values to be saved.
	 */
	public function update( $new_instance, $old_instance ) {
		
        $instance = array();
		
        $instance['title']     = ! empty( $new_instance['title'] ) ? sanitize_text_field( $new_instance['title'] ) :'';
        $instance['facebook']  = ! empty( $new_instance['facebook'] ) ? esc_url_raw( $new_instance['facebook'] ) : '';
        $instance['instagram'] = ! empty( $new_instance['instagram'] ) ? esc_url_raw( $new_instance['instagram'] ) : '';
        $instance['twitter']   = ! empty( $new_instance['twitter'] ) ? esc_url_raw( $new_instance['twitter'] ) : '';
        $instance['pinterest'] = ! empty( $new_instance['pinterest'] ) ? esc_url_raw( $new_instance['pinterest'] ) : '';
        $instance['linkedin']  = ! empty( $new_instance['linkedin'] ) ? esc_url_raw( $new_instance['linkedin'] ) : '';
        $instance['google_plus']   = ! empty( $new_instance['google_plus'] ) ? esc_url_raw( $new_instance['google_plus'] ) : '';
        $instance['youtube']   = ! empty( $new_instance['youtube'] ) ? esc_url_raw( $new_instance['youtube'] ) : '';
        $instance['ok']        = ! empty( $new_instance['ok'] ) ? esc_url_raw( $new_instance['ok'] ) : '' ;
        $instance['vk']        = ! empty( $new_instance['vk'] ) ? esc_url_raw( $new_instance['vk'] ) : '' ;
        $instance['xing']      = ! empty( $new_instance['xing'] ) ? esc_url_raw( $new_instance['xing'] ) : '' ;
        $instance['tiktok']      = ! empty( $new_instance['tiktok'] ) ? esc_url_raw( $new_instance['tiktok'] ) : '' ;
		
        return $instance;
                
	}

} // class Metro_Magazine_Social_Links 