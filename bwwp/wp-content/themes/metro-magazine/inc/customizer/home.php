<?php
/**
 * Home Page Options
 *
 * @package Metro_Magazine
 */
 
function metro_magazine_customize_register_home( $wp_customize ) {
    
    global $metro_magazine_options_posts;
    global $metro_magazine_option_categories;
    
	/** Home Page Settings */
    $wp_customize->add_panel( 
        'metro_magazine_home_page_settings',
         array(
            'priority' => 20,
            'capability' => 'edit_theme_options',
            'title' => __( 'Home Page Settings', 'metro-magazine' ),
            'description' => __( 'Customize Home Page Settings', 'metro-magazine' ),
        ) 
    );
	/** Home Page Settings Ends */

    /** Featured Post Section */
    $wp_customize->add_section(
        'metro_magazine_featured_post_settings',
        array(
            'title' => __( 'Featured Post Section', 'metro-magazine' ),
            'priority' => 10,
            'panel' => 'metro_magazine_home_page_settings',
        )
    );   
    
    /** Enable/Disable Featured Post Section in Home Page */
    $wp_customize->add_setting(
        'metro_magazine_ed_featured_post_section_home',
        array(
            'default' => '',
            'sanitize_callback' => 'metro_magazine_sanitize_checkbox',
        )
    );
    
    $wp_customize->add_control(
        'metro_magazine_ed_featured_post_section_home',
        array(
            'label' => __( 'Enable Featured Post Section in Home Page', 'metro-magazine' ),
            'section' => 'metro_magazine_featured_post_settings',
            'type' => 'checkbox',
        )
    );
    
    /** Enable/Disable Featured Post Section in Archive Page */
    $wp_customize->add_setting(
        'metro_magazine_ed_featured_post_section_archive',
        array(
            'default' => '',
            'sanitize_callback' => 'metro_magazine_sanitize_checkbox',
        )
    );
    
    $wp_customize->add_control(
        'metro_magazine_ed_featured_post_section_archive',
        array(
            'label' => __( 'Enable Featured Post Section in Archive Page', 'metro-magazine' ),
            'section' => 'metro_magazine_featured_post_settings',
            'type' => 'checkbox',
        )
    );
    
    /** Featured Post One */
    $wp_customize->add_setting(
        'metro_magazine_featured_post_one',
        array(
            'default' => '',
            'sanitize_callback' => 'metro_magazine_sanitize_select',
        )
    );
    
    $wp_customize->add_control(
        'metro_magazine_featured_post_one',
        array(
            'label' => __( 'Select Post One', 'metro-magazine' ),
            'section' => 'metro_magazine_featured_post_settings',
            'type' => 'select',
            'choices' => $metro_magazine_options_posts,
        )
    );
    
    /** Featured Post Two */
    $wp_customize->add_setting(
        'metro_magazine_featured_post_two',
        array(
            'default' => '',
            'sanitize_callback' => 'metro_magazine_sanitize_select',
        )
    );
    
    $wp_customize->add_control(
        'metro_magazine_featured_post_two',
        array(
            'label' => __( 'Select Post Two', 'metro-magazine' ),
            'section' => 'metro_magazine_featured_post_settings',
            'type' => 'select',
            'choices' => $metro_magazine_options_posts,
        )
    );
    
    /** Featured Post Three */
    $wp_customize->add_setting(
        'metro_magazine_featured_post_three',
        array(
            'default' => '',
            'sanitize_callback' => 'metro_magazine_sanitize_select',
        )
    );
    
    $wp_customize->add_control(
        'metro_magazine_featured_post_three',
        array(
            'label' => __( 'Select Post Three', 'metro-magazine' ),
            'section' => 'metro_magazine_featured_post_settings',
            'type' => 'select',
            'choices' => $metro_magazine_options_posts,
        )
    );
    
    /** Featured Post Four */
    $wp_customize->add_setting(
        'metro_magazine_featured_post_four',
        array(
            'default' => '',
            'sanitize_callback' => 'metro_magazine_sanitize_select',
        )
    );
    
    $wp_customize->add_control(
        'metro_magazine_featured_post_four',
        array(
            'label' => __( 'Select Post Four', 'metro-magazine' ),
            'section' => 'metro_magazine_featured_post_settings',
            'type' => 'select',
            'choices' => $metro_magazine_options_posts,
        )
    );
    
    /** Featured Post Five */
    $wp_customize->add_setting(
        'metro_magazine_featured_post_five',
        array(
            'default' => '',
            'sanitize_callback' => 'metro_magazine_sanitize_select',
        )
    );
    
    $wp_customize->add_control(
        'metro_magazine_featured_post_five',
        array(
            'label' => __( 'Select Post Five', 'metro-magazine' ),
            'section' => 'metro_magazine_featured_post_settings',
            'type' => 'select',
            'choices' => $metro_magazine_options_posts,
        )
    );

    /** Featured Post Six */
    $wp_customize->add_setting(
        'metro_magazine_featured_post_six',
        array(
            'default' => '',
            'sanitize_callback' => 'metro_magazine_sanitize_select',
        )
    );
    
    $wp_customize->add_control(
        'metro_magazine_featured_post_six',
        array(
            'label' => __( 'Select Post Six', 'metro-magazine' ),
            'section' => 'metro_magazine_featured_post_settings',
            'type' => 'select',
            'choices' => $metro_magazine_options_posts,
        )
    );

    /** Top News Section */
    $wp_customize->add_section(
        'metro_magazine_top_news_settings',
        array(
            'title' => __( 'Top News Section', 'metro-magazine' ),
            'priority' => 20,
            'panel' => 'metro_magazine_home_page_settings',
        )
    ); 
    
    /** Enable/Disable Top News Section */
    $wp_customize->add_setting(
        'metro_magazine_ed_top_news_section',
        array(
            'default' => '',
            'sanitize_callback' => 'metro_magazine_sanitize_checkbox',
        )
    );
    
    $wp_customize->add_control(
        'metro_magazine_ed_top_news_section',
        array(
            'label' => __( 'Enable Top News Section', 'metro-magazine' ),
            'section' => 'metro_magazine_top_news_settings',
            'type' => 'checkbox',
        )
    );
    
    /** Top News Label */
    $wp_customize->add_setting(
        'metro_magazine_top_news_label',
        array(
            'default' => __( 'Top News', 'metro-magazine' ),
            'sanitize_callback' => 'sanitize_text_field',
        )
    );
    
    $wp_customize->add_control(
        'metro_magazine_top_news_label',
        array(
            'label' => __( 'Top News Label', 'metro-magazine' ),
            'section' => 'metro_magazine_top_news_settings',
            'type' => 'text',
        )
    );
    
    /** Top News One */
    $wp_customize->add_setting(
        'metro_magazine_top_news_one',
        array(
            'default' => '',
            'sanitize_callback' => 'metro_magazine_sanitize_select',
        )
    );
    
    $wp_customize->add_control(
        'metro_magazine_top_news_one',
        array(
            'label' => __( 'Select Post One', 'metro-magazine' ),
            'section' => 'metro_magazine_top_news_settings',
            'type' => 'select',
            'choices' => $metro_magazine_options_posts,
        )
    );
    
    /** Top News Two */
    $wp_customize->add_setting(
        'metro_magazine_top_news_two',
        array(
            'default' => '',
            'sanitize_callback' => 'metro_magazine_sanitize_select',
        )
    );
    
    $wp_customize->add_control(
        'metro_magazine_top_news_two',
        array(
            'label' => __( 'Select Post Two', 'metro-magazine' ),
            'section' => 'metro_magazine_top_news_settings',
            'type' => 'select',
            'choices' => $metro_magazine_options_posts,
        )
    );
    
    /** Top News Three */
    $wp_customize->add_setting(
        'metro_magazine_top_news_three',
        array(
            'default' => '',
            'sanitize_callback' => 'metro_magazine_sanitize_select',
        )
    );
    
    $wp_customize->add_control(
        'metro_magazine_top_news_three',
        array(
            'label' => __( 'Select Post Three', 'metro-magazine' ),
            'section' => 'metro_magazine_top_news_settings',
            'type' => 'select',
            'choices' => $metro_magazine_options_posts,
        )
    );
    
    /** Top News Four */
    $wp_customize->add_setting(
        'metro_magazine_top_news_four',
        array(
            'default' => '',
            'sanitize_callback' => 'metro_magazine_sanitize_select',
        )
    );
    
    $wp_customize->add_control(
        'metro_magazine_top_news_four',
        array(
            'label' => __( 'Select Post Four', 'metro-magazine' ),
            'section' => 'metro_magazine_top_news_settings',
            'type' => 'select',
            'choices' => $metro_magazine_options_posts,
        )
    );
        
    /** Top News Five */
    $wp_customize->add_setting(
        'metro_magazine_top_news_five',
        array(
            'default' => '',
            'sanitize_callback' => 'metro_magazine_sanitize_select',
        )
    );
    
    $wp_customize->add_control(
        'metro_magazine_top_news_five',
        array(
            'label' => __( 'Select Post Five', 'metro-magazine' ),
            'section' => 'metro_magazine_top_news_settings',
            'type' => 'select',
            'choices' => $metro_magazine_options_posts,
        )
    );
    
    /** Top News Four */
    $wp_customize->add_setting(
        'metro_magazine_top_news_six',
        array(
            'default' => '',
            'sanitize_callback' => 'metro_magazine_sanitize_select',
        )
    );
    
    $wp_customize->add_control(
        'metro_magazine_top_news_six',
        array(
            'label' => __( 'Select Post six', 'metro-magazine' ),
            'section' => 'metro_magazine_top_news_settings',
            'type' => 'select',
            'choices' => $metro_magazine_options_posts,
        )
    );

    /** Category Section */
    $wp_customize->add_section(
        'metro_magazine_category_settings',
        array(
            'title' => __( 'Category Section', 'metro-magazine' ),
            'priority' => 30,
            'panel' => 'metro_magazine_home_page_settings',
        )
    );
    
    /** Select Category One */
    $wp_customize->add_setting(
        'metro_magazine_category_one',
        array(
            'default'           => '',
            'sanitize_callback' => 'metro_magazine_sanitize_select',
        )
    );
    
    $wp_customize->add_control(
        'metro_magazine_category_one',
        array(
            'label'   => __( 'Select Category One', 'metro-magazine' ),
            'section' => 'metro_magazine_category_settings',
            'type'    => 'select',
            'choices' => $metro_magazine_option_categories,
        )
    );
    
    /** Select Category Two */
    $wp_customize->add_setting(
        'metro_magazine_category_two',
        array(
            'default'           => '',
            'sanitize_callback' => 'metro_magazine_sanitize_select',
        )
    );
    
    $wp_customize->add_control(
        'metro_magazine_category_two',
        array(
            'label'   => __( 'Select Category Two', 'metro-magazine' ),
            'section' => 'metro_magazine_category_settings',
            'type'    => 'select',
            'choices' => $metro_magazine_option_categories,
        )
    );
    
    /** Select Category Three */
    $wp_customize->add_setting(
        'metro_magazine_category_three',
        array(
            'default'           => '',
            'sanitize_callback' => 'metro_magazine_sanitize_select',
        )
    );
    
    $wp_customize->add_control(
        'metro_magazine_category_three',
        array(
            'label'   => __( 'Select Category Three', 'metro-magazine' ),
            'section' => 'metro_magazine_category_settings',
            'type'    => 'select',
            'choices' => $metro_magazine_option_categories,
        )
    );
    
    /** Select Category Four */
    $wp_customize->add_setting(
        'metro_magazine_category_four',
        array(
            'default'           => '',
            'sanitize_callback' => 'metro_magazine_sanitize_select',
        )
    );
    
    $wp_customize->add_control(
        'metro_magazine_category_four',
        array(
            'label'   => __( 'Select Category Four', 'metro-magazine' ),
            'section' => 'metro_magazine_category_settings',
            'type'    => 'select',
            'choices' => $metro_magazine_option_categories,
        )
    );
    
    /** Select Category Five */
    $wp_customize->add_setting(
        'metro_magazine_category_five',
        array(
            'default'           => '',
            'sanitize_callback' => 'metro_magazine_sanitize_select',
        )
    );
    
    $wp_customize->add_control(
        'metro_magazine_category_five',
        array(
            'label'   => __( 'Select Category Five', 'metro-magazine' ),
            'section' => 'metro_magazine_category_settings',
			'description' => __( 'If this category five has not been selected then latest posts will be displayed', 'metro-magazine' ),
            'type'    => 'select',
            'choices' => $metro_magazine_option_categories,
        )
    );

    $wp_customize->add_setting(
        'metro_magazine_read_more',
        array(
            'default'           => 'View Detail',
            'sanitize_callback' => 'sanitize_text_field',
        )
    );
    
    $wp_customize->add_control(
        'metro_magazine_read_more',
        array(
            'label'   => __( 'Read More Label', 'metro-magazine' ),
            'section' => 'metro_magazine_category_settings',
            'type'    => 'text',
        )
    );
}
add_action( 'customize_register', 'metro_magazine_customize_register_home' );