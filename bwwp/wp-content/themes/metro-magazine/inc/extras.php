<?php
/**
 * Custom functions that act independently of the theme templates.
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package Metro_Magazine
 */

if ( ! function_exists( 'metro_magazine_posted_on' ) ) :
/**
 * Prints HTML with meta information for the current post-date/time and author.
 */
function metro_magazine_posted_on() {
	$time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';
	if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
		$time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time><time class="updated" datetime="%3$s">%4$s</time>';
	}

	$time_string = sprintf( $time_string,
		esc_attr( get_the_date( 'c' ) ),
		esc_html( get_the_date() ),
		esc_attr( get_the_modified_date( 'c' ) ),
		esc_html( get_the_modified_date() )
	);

    $byline = sprintf(
		esc_html_x( 'by %s', 'post author', 'metro-magazine' ),
		'<a class="url fn n" href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '">' . esc_html( get_the_author() ) . '</a>'
	);
	
	echo '<span class="byline" itemprop="author" itemscope itemtype="https://schema.org/Person"> ' . $byline . '</span><span class="posted-on"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">' . $time_string . '</a></span>'; // WPCS: XSS OK.
    if( is_single ()){
    	if ( is_single() && ! post_password_required() && ( comments_open() || get_comments_number() ) ) {
    		echo '<span class="comments-link">'; 
    		/* translators: %s: post title */
    		comments_popup_link( sprintf( wp_kses( __( 'Leave a Comment<span class="screen-reader-text">%s</span>', 'metro-magazine' ), array( 'span' => array( 'class' => array() ) ) ), get_the_title() ) );
    		echo '</span>';
    	}
    
    	// Hide category and tag text for pages.
    	if ( 'post' === get_post_type() ) {    
    		/* translators: used between list items, there is a space after the comma */
    		$categories_list = get_the_category_list( esc_html__( ', ', 'metro-magazine' ) );
    		if ( $categories_list && metro_magazine_categorized_blog() ) {
    			echo '<span class="category">' . $categories_list . '</span>';
    		}
    	}
    }
}
endif; 

if ( ! function_exists( 'metro_magazine_entry_footer' ) ) :
/**
 * Prints HTML with meta information for the categories, tags and comments.
 */
function metro_magazine_entry_footer() {
	// Hide category and tag text for pages.
	if ( 'post' === get_post_type() ) {                       
		/* translators: used between list items, there is a space after the comma */
		$tags_list = get_the_tag_list( '<li>','</li><li>' ,'</li>'  );
		if ( $tags_list ) {
			echo '<ul class = "tags">' . $tags_list . '</ul>';			
		}
	}

	edit_post_link(
		sprintf(
			/* translators: %s: Name of current post */
			esc_html__( 'Edit %s', 'metro-magazine' ),
			the_title( '<span class="screen-reader-text">"', '"</span>', false )
		),
		'<span class="edit-link">',
		'</span>'
	);
}
endif;

/**
 * Returns true if a blog has more than 1 category.
 *
 * @return bool
 */
function metro_magazine_categorized_blog() {
	if ( false === ( $all_the_cool_cats = get_transient( 'metro_magazine_categories' ) ) ) {
		// Create an array of all the categories that are attached to posts.
		$all_the_cool_cats = get_categories( array(
			'fields'     => 'ids',
			'hide_empty' => 1,
			// We only need to know if there is more than one category.
			'number'     => 2,
		) );

		// Count the number of categories that are attached to the posts.
		$all_the_cool_cats = count( $all_the_cool_cats );

		set_transient( 'metro_magazine_categories', $all_the_cool_cats );
	}

	if ( $all_the_cool_cats > 1 ) {
		// This blog has more than 1 category so metro_magazine_categorized_blog should return true.
		return true;
	} else {
		// This blog has only 1 category so metro_magazine_categorized_blog should return false.
		return false;
	}
}



/**
 * Callback function for metro_magazine List 
 * 
 * @link https://codex.wordpress.org/Function_Reference/wp_list_metro_magazines 
 */
function metro_magazine_comment($comment, $args, $depth) {
	if ( 'div' == $args['style'] ) {
		$tag = 'div';
		$add_below = 'comment';
	} else {
		$tag = 'li';
		$add_below = 'div-comment';
	}
?>
	<<?php echo $tag ?> <?php comment_class( empty( $args['has_children'] ) ? '' : 'parent' ) ?> id="comment-<?php comment_ID() ?>">
	<?php if ( 'div' != $args['style'] ) : ?>
	<div id="div-comment-<?php comment_ID() ?>" class="comment-body" itemscope itemtype="https://schema.org/UserComments">
	<?php endif; ?>
	
    <footer class="comment-meta">
    
        <div class="comment-author vcard">
    	<?php if ( $args['avatar_size'] != 0 ) echo get_avatar( $comment, $args['avatar_size'] ); ?>
    	<?php printf( __( '<b class="fn" itemprop="creator" itemscope itemtype="https://schema.org/Person">%s</b>', 'metro-magazine' ), get_comment_author_link() ); ?>
    	</div>
    	<?php if ( $comment->comment_approved == '0' ) : ?>
    		<em class="comment-awaiting-moderation"><?php _e( 'Your comment is awaiting moderation.', 'metro-magazine' ); ?></em>
    		<br />
    	<?php endif; ?>
    
    	<div class="comment-metadata commentmetadata">
            <a href="<?php echo htmlspecialchars( get_comment_link( $comment->comment_ID ) ); ?>">
                <time datetime="<?php comment_date(); ?>">
                    <?php comment_date(); ?>
                </time>
            </a>
            <?php edit_comment_link( __( '(Edit)', 'metro-magazine' ), '  ', '' ); ?>
    	</div>
    </footer>
    
    <div class="comment-content"><?php comment_text(); ?></div>

	<div class="reply">
	<?php comment_reply_link( array_merge( $args, array( 'add_below' => $add_below, 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>
	</div>
	<?php if ( 'div' != $args['style'] ) : ?>
	</div>
	<?php endif; ?>
<?php
}

if ( ! function_exists( 'metro_magazine_posted_on_date' ) ) :
/**
 * Prints HTML with meta information for the current post-date
 */
function metro_magazine_posted_on_date() {
	$time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';
	if( is_page_template( 'template-home' )){
        $date_type = 'd/m/Y';   
	}else{
        $date_type = '';	   
	}
    
	$time_string = sprintf( $time_string,
		esc_attr( get_the_date( 'c' ) ),
		esc_html( get_the_date( $date_type ) )
	);
    
    echo '<span class="posted-on"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">' . $time_string . '</a></span>'; // WPCS: XSS OK.

}
endif;

if( ! function_exists( 'metro_magazine_posted_by' ) ) :
/**
 * Post posted by
*/
function metro_magazine_posted_by(){
    echo '<span class="byline"><span class="author vcard"><i class="fa fa-user" aria-hidden="true"></i><a class="url fn n" href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '">' . esc_html( get_the_author() ) . '</a></span></span>';
}
endif;

if( ! function_exists( 'metro_magazine_comment_count' ) ) :
/**
 * Post Comment count
*/
function metro_magazine_comment_count(){
    if ( ! post_password_required() && ( comments_open() || get_comments_number() ) ) {
        echo '<span class="comment"><i class="fa fa-comment" aria-hidden="true"></i>';
		comments_popup_link( esc_html__( 'Leave a comment', 'metro-magazine' ), esc_html__( '1 Comment', 'metro-magazine' ), esc_html__( '% Comments', 'metro-magazine' ) );
		echo '</span>';
    }
}
endif;

if( ! function_exists( 'metro_magazine_meta' ) ) :
/**
 * Post Meta Data
*/
function metro_magazine_meta( $date = false, $author = false, $comment = false ){
    if( $date || $comment || $author ){
        echo '<div class="entry-meta">';
        if( $date ) metro_magazine_posted_on();
        if( $author ) metro_magazine_posted_by();
        if( $comment ) metro_magazine_comment_count();            
        echo '</div>';
    }
}
endif;

if( ! function_exists( 'metro_magazine_colored_category' ) ) :
/**
 * Colored category
*/
function metro_magazine_colored_category(){
    $output = '';
    // Hide category for pages.
	if ( 'post' === get_post_type() ) {		
		$categories_list = get_the_category();
		if ( $categories_list ) {
		  $output .= '<div class="category-holder">';
                foreach( $categories_list as $category ){
                $color_code = get_theme_mod( 'metro_magazine_category_color_' . $category->term_id );
                    if ( $color_code ) {
                       $output .= '<a class="category" href="' . esc_url( get_category_link( $category->term_id ) ) . '" style="background:' . esc_attr( $color_code ) . '" rel="category tag">'. esc_html( $category->cat_name ) .'</a>';
                    }else{
                       $output .= '<a class="category" href="' . esc_url( get_category_link( $category->term_id ) ) . '"  rel="category tag">' . esc_html( $category->cat_name ) . '</a>';
                    }
                }
            $output .= '</div>';
            echo $output;         
		}
	}

}
endif;

if( ! function_exists( 'metro_magazine_sidebar_layout' ) ) :
/**
 * Return sidebar layouts for pages
 */
function metro_magazine_sidebar_layout(){
    global $post;
    
    if( get_post_meta( $post->ID, 'metro_magazine_sidebar_layout', true ) ){
        return get_post_meta( $post->ID, 'metro_magazine_sidebar_layout', true );    
    }else{
        return 'right-sidebar';
    }
    
}
endif;

if( ! function_exists( 'metro_magazine_ads_cb' ) ) :
/**
 * Header Top
 * 
 * @since 1.0.1
*/
function metro_magazine_ads_cb(){
    $ed_header_ad = get_theme_mod( 'metro_magazine_ed_header_ad' ); //from customizer
    $ad_img       = get_theme_mod( 'metro_magazine_header_ad' ); //from customizer
    $ad_link      = get_theme_mod( 'metro_magazine_header_ad_link' ); //from customizer
    $ad_image     = wp_get_attachment_image_src( $ad_img, 'full' );
    $target       = get_theme_mod( 'metro_magazine_open_link_diff_tab', '1' ) ? 'target="_blank"' : '';
    if( $ed_header_ad && $ad_img ){ ?>
        <div class="advertise">
        	<?php if( $ad_link ) echo '<a href="' . esc_url( $ad_link ) . '" ' . $target . '>'; ?>
                <img src="<?php echo esc_url( $ad_image[0] ); ?>"  />
            <?php if( $ad_link ) echo '</a>'; ?>
        </div>
        <?php 
    } 
}
endif; 
add_action( 'metro_magazine_ads', 'metro_magazine_ads_cb' );
 
if( ! function_exists( 'metro_magazine_social_link_cb' ) ) :
/**
 * Header Top
 * 
 * @since 1.0.1
*/
function metro_magazine_social_link_cb(){
	
    $facebook    = get_theme_mod( 'metro_magazine_facebook' );
    $twitter     = get_theme_mod( 'metro_magazine_twitter' );
    $linkedin    = get_theme_mod( 'metro_magazine_linkedin' );
    $instagram   = get_theme_mod( 'metro_magazine_instagram' );
    $google_plus = get_theme_mod( 'metro_magazine_google' );
    $youtube     = get_theme_mod( 'metro_magazine_youtube' );    
    $pinterest   = get_theme_mod( 'metro_magazine_pinterest' );
    $ok          = get_theme_mod( 'metro_magazine_odnoklassniki' );
    $vk          = get_theme_mod( 'metro_magazine_vk' );
    $xing        = get_theme_mod( 'metro_magazine_xing' );
    $tiktok        = get_theme_mod( 'metro_magazine_tiktok' );
    
    if( $facebook || $twitter || $instagram || $google_plus || $pinterest || $youtube || $linkedin || $ok || $vk || $tiktok ){
    ?>
	<ul class="social-networks">
        <?php if( $facebook ){?>
            <li><a href="<?php echo esc_url( $facebook ) ?>" target="_blank" title="<?php esc_attr_e( 'Facebook', 'metro-magazine' ); ?>"><i class="fa fa-facebook"></i></a></li>
		<?php } if( $twitter ){?>
            <li><a href="<?php echo esc_url( $twitter ) ?>" target="_blank" title="<?php esc_attr_e( 'Twitter', 'metro-magazine'); ?>"><i class="fa fa-twitter"></i></a></li>
		<?php } if( $linkedin ){?>
            <li><a href="<?php echo esc_url( $linkedin ) ?>" target="_blank" title="<?php esc_attr_e( 'LinkedIn', 'metro-magazine' ); ?>"><i class="fa fa-linkedin"></i></a></li>
		<?php } if( $pinterest ){?>
            <li><a href="<?php echo esc_url( $pinterest ) ?>" target="_blank" title="<?php esc_attr_e( 'Pinterest', 'metro-magazine' ); ?>"><i class="fa fa-pinterest"></i></a></li>
        <?php } if( $instagram ){?>
            <li><a href="<?php echo esc_url( $instagram ) ?>" target="_blank" title="<?php esc_attr_e( 'Instagram', 'metro-magazine' ); ?>"><i class="fa fa-instagram"></i></a></li>
		<?php } if( $google_plus ){?>
            <li><a href="<?php echo esc_url( $google_plus ) ?>" target="_blank" title="<?php esc_attr_e( 'Google Plus', 'metro-magazine' ); ?>"><i class="fa fa-google-plus"></i></a></li>
		<?php } if( $youtube ){?>
            <li><a href="<?php echo esc_url( $youtube ) ?>" target="_blank" title="<?php esc_attr_e( 'Youtube', 'metro-magazine' ); ?>"><i class="fa fa-youtube"></i></a></li>
		<?php }  if( $ok ){?>
            <li><a href="<?php echo esc_url( $ok );?>" target="_blank" title="<?php esc_attr_e( 'OK', 'metro-magazine' ); ?>"><i class="fa fa-odnoklassniki"></i></a></li>
		<?php } if( $vk ){?>
            <li><a href="<?php echo esc_url( $vk );?>" target="_blank" title="<?php esc_attr_e( 'VK', 'metro-magazine' ); ?>"><i class="fa fa-vk"></i></a></li>
		<?php } if( $xing ){?>
            <li><a href="<?php echo esc_url( $xing );?>" target="_blank" title="<?php esc_attr_e( 'Xing', 'metro-magazine' ); ?>"><i class="fa fa-xing"></i></a></li>
		<?php } if( $tiktok ){?>
            <li><a href="<?php echo esc_url( $tiktok );?>" target="_blank" title="<?php esc_attr_e( 'Tiktok', 'metro-magazine' ); ?>"><i class="fab fa-tiktok"></i></a></li>
		<?php } ?>
	</ul>
    <?php
    } 
} 
endif; 
add_action( 'metro_magazine_social_link', 'metro_magazine_social_link_cb' );

add_filter( 'get_the_archive_title', 'metro_magazine_get_the_archive_title' );
if( ! function_exists( ' metro_magazine_get_the_archive_title' ) ) :
/**
 * Change Comment form default fields i.e. author, email & url.
 * https://blog.josemcastaneda.com/2016/08/08/copy-paste-hurting-theme/
*/
function  metro_magazine_get_the_archive_title( $title ){
    if ( is_category() ) {
        $title = single_cat_title( '', false );
    } elseif ( is_tag() ) {
        $title = single_tag_title( '', false );
    } elseif ( is_author() ) {
        $title = get_the_author() ;
    }	else {
    	$title = ( single_month_title(' ',false) ); 
    }
    return $title;
}
endif;

if( ! function_exists( 'metro_magazine_change_comment_form_default_fields' ) ) :
/**
 * Change Comment form default fields i.e. author, email & url.
 * https://blog.josemcastaneda.com/2016/08/08/copy-paste-hurting-theme/
*/
function metro_magazine_change_comment_form_default_fields( $fields ){    
    // get the current commenter if available
    $commenter = wp_get_current_commenter();
 
    // core functionality
    $req      = get_option( 'require_name_email' );
    $aria_req = ( $req ? " aria-required='true'" : '' );
    $required = ( $req ? " required" : '' );
    $author   = ( $req ? __( 'Name*', 'metro-magazine' ) : __( 'Name', 'metro-magazine' ) );
    $email    = ( $req ? __( 'Email*', 'metro-magazine' ) : __( 'Email', 'metro-magazine' ) );
 
    // Change just the author field
    $fields['author'] = '<p class="comment-form-author"><label class="screen-reader-text" for="author">' . esc_html__( 'Name', 'metro-magazine' ) . '<span class="required">*</span></label><input id="author" name="author" placeholder="' . esc_attr( $author ) . '" type="text" value="' . esc_attr( $commenter['comment_author'] ) . '" size="30"' . $aria_req . $required . ' /></p>';
    
    $fields['email'] = '<p class="comment-form-email"><label class="screen-reader-text" for="email">' . esc_html__( 'Email', 'metro-magazine' ) . '<span class="required">*</span></label><input id="email" name="email" placeholder="' . esc_attr( $email ) . '" type="text" value="' . esc_attr(  $commenter['comment_author_email'] ) . '" size="30"' . $aria_req . $required. ' /></p>';
    
    $fields['url'] = '<p class="comment-form-url"><label class="screen-reader-text" for="url">' . esc_html__( 'Website', 'metro-magazine' ) . '</label><input id="url" name="url" placeholder="' . esc_attr__( 'Website', 'metro-magazine' ) . '" type="text" value="' . esc_attr( $commenter['comment_author_url'] ) . '" size="30" /></p>'; 
    
    return $fields;    
}
endif;
add_filter( 'comment_form_default_fields', 'metro_magazine_change_comment_form_default_fields' );

if( ! function_exists( 'metro_magazine_change_comment_form_defaults' ) ) :
/**
 * Change Comment Form defaults
 * https://blog.josemcastaneda.com/2016/08/08/copy-paste-hurting-theme/
*/
function metro_magazine_change_comment_form_defaults( $defaults ){    
    $defaults['comment_field'] = '<p class="comment-form-comment"><label class="screen-reader-text" for="comment">' . esc_html__( 'Comment', 'metro-magazine' ) . '</label><textarea id="comment" name="comment" placeholder="' . esc_attr__( 'Comment', 'metro-magazine' ) . '" cols="45" rows="8" aria-required="true" required></textarea></p>';
    
    return $defaults;    
}
endif;
add_filter( 'comment_form_defaults', 'metro_magazine_change_comment_form_defaults' );

if( ! function_exists( 'metro_magazine_escape_text_tags' ) ) :
/**
 * Remove new line tags from string
 *
 * @param $text
 * @return string
 */
function metro_magazine_escape_text_tags( $text ) {
    return (string) str_replace( array( "\r", "\n" ), '', strip_tags( $text ) );
}
endif;

if( ! function_exists( 'metro_magazine_is_woocommerce_activated' ) ) :
/**
 * Query WooCommerce activation
 */
function metro_magazine_is_woocommerce_activated() {
	return class_exists( 'woocommerce' ) ? true : false;
}
endif;

if ( ! function_exists( 'wp_body_open' ) ) :
	/**
	 * Fire the wp_body_open action.
	 *
	 * Added for backwards compatibility to support pre 5.2.0 WordPress versions.
	 *
	 */
	function wp_body_open() {
		/**
		 * Triggered after the opening <body> tag.
		 *
		 */
		do_action( 'wp_body_open' );
	}
endif;

if( ! function_exists( 'metro_magazine_get_image_sizes' ) ) :
/**
 * Get information about available image sizes
 */
function metro_magazine_get_image_sizes( $size = '' ) {
 
    global $_wp_additional_image_sizes;
 
    $sizes = array();
    $get_intermediate_image_sizes = get_intermediate_image_sizes();
 
    // Create the full array with sizes and crop info
    foreach( $get_intermediate_image_sizes as $_size ) {
        if ( in_array( $_size, array( 'thumbnail', 'medium', 'medium_large', 'large' ) ) ) {
            $sizes[ $_size ]['width'] = get_option( $_size . '_size_w' );
            $sizes[ $_size ]['height'] = get_option( $_size . '_size_h' );
            $sizes[ $_size ]['crop'] = (bool) get_option( $_size . '_crop' );
        } elseif ( isset( $_wp_additional_image_sizes[ $_size ] ) ) {
            $sizes[ $_size ] = array( 
                'width' => $_wp_additional_image_sizes[ $_size ]['width'],
                'height' => $_wp_additional_image_sizes[ $_size ]['height'],
                'crop' =>  $_wp_additional_image_sizes[ $_size ]['crop']
            );
        }
    } 
    // Get only 1 size if found
    if ( $size ) {
        if( isset( $sizes[ $size ] ) ) {
            return $sizes[ $size ];
        } else {
            return false;
        }
    }
    return $sizes;
}
endif;

if ( ! function_exists( 'metro_magazine_get_fallback_svg' ) ) :    
/**
 * Get Fallback SVG
*/
function metro_magazine_get_fallback_svg( $post_thumbnail ) {
    if( ! $post_thumbnail ){
        return;
    }
    
    $image_size = metro_magazine_get_image_sizes( $post_thumbnail );
     
    if( $image_size ){ ?>
        <div class="svg-holder">
             <svg class="fallback-svg" viewBox="0 0 <?php echo esc_attr( $image_size['width'] ); ?> <?php echo esc_attr( $image_size['height'] ); ?>" preserveAspectRatio="none">
                    <rect width="<?php echo esc_attr( $image_size['width'] ); ?>" height="<?php echo esc_attr( $image_size['height'] ); ?>" style="fill:#dedbdb;"></rect>
            </svg>
        </div>
        <?php
    }
}
endif;

if( ! function_exists( 'metro_magazine_fonts_url' ) ) :
/**
 * Register custom fonts.
 */
function metro_magazine_fonts_url() {
    $fonts_url = '';

    /*
    * translators: If there are characters in your language that are not supported
    * by Ubuntu, translate this to 'off'. Do not translate into your own language.
    */
    $ubuntu = _x( 'on', 'Ubuntu font: on or off', 'metro-magazine' );
    
    /*
    * translators: If there are characters in your language that are not supported
    * by Playfair Display, translate this to 'off'. Do not translate into your own language.
    */
    $playfair_display = _x( 'on', 'Playfair Display font: on or off', 'metro-magazine' );

    if ( 'off' !== $ubuntu || 'off' !== $playfair_display ) {
        $font_families = array();

        if( 'off' !== $ubuntu ){
            $font_families[] = 'Ubuntu:300,400,400i,700';
        }

        if( 'off' !== $playfair_display ){
            $font_families[] = 'Playfair Display';
        }

        $query_args = array(
            'family'  => urlencode( implode( '|', $font_families ) ),
            'display' => urlencode( 'fallback' ),
        );

        $fonts_url = add_query_arg( $query_args, 'https://fonts.googleapis.com/css' );
    }

    return esc_url( $fonts_url );
}
endif;

if( ! function_exists( 'metro_magazine_load_preload_local_fonts') ) :
/**
 * Get the file preloads.
 *
 * @param string $url    The URL of the remote webfont.
 * @param string $format The font-format. If you need to support IE, change this to "woff".
 */
function metro_magazine_load_preload_local_fonts( $url, $format = 'woff2' ) {

    // Check if cached font files data preset present or not. Basically avoiding 'metro_magazine_WebFont_Loader' class rendering.
    $local_font_files = get_site_option( 'metro_magazine_local_font_files', false );

    if ( is_array( $local_font_files ) && ! empty( $local_font_files ) ) {
        $font_format = apply_filters( 'metro_magazine_local_google_fonts_format', $format );
        foreach ( $local_font_files as $key => $local_font ) {
            if ( $local_font ) {
                echo '<link rel="preload" href="' . esc_url( $local_font ) . '" as="font" type="font/' . esc_attr( $font_format ) . '" crossorigin>'; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
            }	
        }
        return;
    }

    // Now preload font data after processing it, as we didn't get stored data.
    $font = metro_magazine_webfont_loader_instance( $url );
    $font->set_font_format( $format );
    $font->preload_local_fonts();
}
endif;

if( ! function_exists( 'metro_magazine_flush_local_google_fonts' ) ){
    /**
     * Ajax Callback for flushing the local font
     */
    function metro_magazine_flush_local_google_fonts() {
        $WebFontLoader = new Metro_Magazine_WebFont_Loader();
        //deleting the fonts folder using ajax
        $WebFontLoader->delete_fonts_folder();
    die();
    }
}
add_action( 'wp_ajax_flush_local_google_fonts', 'metro_magazine_flush_local_google_fonts' );
add_action( 'wp_ajax_nopriv_flush_local_google_fonts', 'metro_magazine_flush_local_google_fonts' );