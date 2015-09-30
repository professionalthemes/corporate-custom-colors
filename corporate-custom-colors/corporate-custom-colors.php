<?php
/**
 * This plugin is intended to be used as a custom colors add-on to the Corporate WordPress Theme.
 * It will be of no use if you have not purchased the self-hosted version of Corporate.
 *
 * @wordpress-plugin
 * Plugin Name: Corporate Custom Colors
 *  Plugin URI: https://creativemarket.com/professionalthemes/382762-Corporate-WordPress-Theme
 * Description: This plugin adds custom colors functionality into the Corporate WordPress Theme.
 *      Author: Professional Themes
 *  Author URI: https://creativemarket.com/professionalthemes
 *     Version: 1.0.0
 * Text Domain: corporate-custom-colors
 * Domain Path: /languages/
 *     License: GNU General Public License v2 or later
 * License URI: http://www.gnu.org/licenses/gpl-2.0.html
 *
 * @since   1.0.0
 * @package Corporate_Custom_Colors
 */

if ( ! defined( 'ABSPATH' ) ) {
	die;
}

if ( ! function_exists( 'corporate_custom_colors_customize_register' ) ) :
	// Customizer Registration
	function corporate_custom_colors_customize_register( $wp_customize ) {
		// Point users to Jetpack Custom CSS if they'd like more control over their colors
		$wp_customize->get_section( 'colors' )->description = __( 'If you would like even more fine-grained control over your colors, take advantage of the Jetpack <a href="http://jetpack.me/support/custom-css/">Custom CSS</a> module.', 'corporate-custom-colors' );
		// Ensure that core controls are shown above Corporate Custom Colors controls
		$wp_customize->get_control( 'background_color' )->priority = 1;
		$wp_customize->get_control( 'header_textcolor' )->priority = 2;

		/**
		 * Main Accent Color
		 */
		$wp_customize->add_setting(
			'corporate_main_accent_bg_color',
			array(
				'default'				=> '222222',
				'sanitize_callback'		=> 'sanitize_hex_color_no_hash',
				'sanitize_js_callback'	=> 'maybe_hash_hex_color',
			)
		);
		$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize,
			'corporate_main_accent_bg_color',
			array(
				'label'		=> __( 'Main Accent Background', 'corporate-custom-colors' ),
				'section'	=> 'colors',
				'priority'	=> 100,
			)
		) );
		$wp_customize->add_setting(
			'corporate_main_accent_txt_color',
			array(
				'default'				=> 'ffffff',
				'sanitize_callback'		=> 'sanitize_hex_color_no_hash',
				'sanitize_js_callback'	=> 'maybe_hash_hex_color',
			)
		);
		$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize,
			'corporate_main_accent_txt_color',
			array(
				'label'		=> __( 'Main Accent Text', 'corporate-custom-colors' ),
				'section'	=> 'colors',
				'priority'	=> 100,
			)
		) );

		/**
		 * Secondary Accent Color
		 */
		$wp_customize->add_setting(
			'corporate_secondary_accent_bg_color',
			array(
				'default'				=> '9091ad',
				'sanitize_callback'		=> 'sanitize_hex_color_no_hash',
				'sanitize_js_callback'	=> 'maybe_hash_hex_color',
			)
		);
		$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize,
			'corporate_secondary_accent_bg_color',
			array(
				'label'		=> __( 'Secondary Accent Background', 'corporate-custom-colors' ),
				'section'	=> 'colors',
				'priority'	=> 101,
			)
		) );
		$wp_customize->add_setting(
			'corporate_secondary_accent_txt_color',
			array(
				'default'				=> '222222',
				'sanitize_callback'		=> 'sanitize_hex_color_no_hash',
				'sanitize_js_callback'	=> 'maybe_hash_hex_color',
			)
		);
		$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize,
			'corporate_secondary_accent_txt_color',
			array(
				'label'		=> __( 'Secondary Accent Text', 'corporate-custom-colors' ),
				'section'	=> 'colors',
				'priority'	=> 101,
			)
		) );

		/**
		 * Links
		 */
		$wp_customize->add_setting(
			'corporate_links_color',
			array(
				'default'				=> '222222',
				'sanitize_callback'		=> 'sanitize_hex_color_no_hash',
				'sanitize_js_callback'	=> 'maybe_hash_hex_color',
			)
		);
		$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize,
			'corporate_links_color',
			array(
				'label'		=> __( 'Entry Content Links', 'corporate-custom-colors' ),
				'section'	=> 'colors',
				'priority'	=> 102,
			)
		) );

		/**
		 * Header Content
		 */
		$wp_customize->add_setting(
			'corporate_site_top_content_bg_color',
			array(
				'default'				=> '222222',
				'sanitize_callback'		=> 'sanitize_hex_color_no_hash',
				'sanitize_js_callback'	=> 'maybe_hash_hex_color',
			)
		);
		$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize,
			'corporate_site_top_content_bg_color',
			array(
				'label'		=> __( 'Header Content Background', 'corporate-custom-colors' ),
				'section'	=> 'colors',
				'priority'	=> 103,
			)
		) );
		$wp_customize->add_setting(
			'corporate_site_top_content_txt_color',
			array(
				'default'				=> 'ffffff',
				'sanitize_callback'		=> 'sanitize_hex_color_no_hash',
				'sanitize_js_callback'	=> 'maybe_hash_hex_color',
			)
		);
		$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize,
			'corporate_site_top_content_txt_color',
			array(
				'label'		=> __( 'Header Content Text', 'corporate-custom-colors' ),
				'section'	=> 'colors',
				'priority'	=> 103,
			)
		) );
	} // end function corporate_custom_colors_customize_register
endif;

if ( ! function_exists( 'corporate_customized_colors' ) ) :
	// Output custom colors
	function corporate_customized_colors() {
		// Retrieve custom colors settings and also provide their rgb equivalents
		$main_accent_bg       = get_theme_mod( 'corporate_main_accent_bg_color' );
		$main_accent_txt      = get_theme_mod( 'corporate_main_accent_txt_color' );
		$secondary_accent_bg  = get_theme_mod( 'corporate_secondary_accent_bg_color' );
		$secondary_accent_txt = get_theme_mod( 'corporate_secondary_accent_txt_color' );
		$links                = get_theme_mod( 'corporate_links_color' );
		$site_top_content_bg  = get_theme_mod( 'corporate_site_top_content_bg_color' );
		$site_top_content_txt = get_theme_mod( 'corporate_site_top_content_txt_color' );

		/**
		 * Main Accent
		 */
		if ( ! empty( $main_accent_bg ) && '222222' != $main_accent_bg ) : ?>
			<style type="text/css">
				code,
				kbd,
				pre,
				var,
				samp,
				tt,
				#infinite-handle span,
				.blog #content article .entry-meta .sticky-post,
				.archive #content article .entry-meta .sticky-post,
				.search #content article .entry-meta .sticky-post,
				#content .entry-content span.edit-link a,
				#tertiary,
				#featured-content article .edit-link a,
				#featured-content article a.call-to-action {
					background-color: #<?php echo sanitize_text_field( $main_accent_bg ); ?>;
				}
			</style><?php
		endif;
		if ( ! empty( $main_accent_txt ) && 'ffffff' != $main_accent_txt ) : ?>
			<style type="text/css">
				code,
				kbd,
				pre,
				var,
				samp,
				tt,
				#infinite-handle span,
				.blog #content article .entry-meta .sticky-post,
				.archive #content article .entry-meta .sticky-post,
				.search #content article .entry-meta .sticky-post,
				#content .entry-content span.edit-link a,
				#tertiary,
				#tertiary a,
				#tertiary .widget_recent_entries a:hover,
				#tertiary .widget_meta a:hover,
				#featured-content article .edit-link a,
				#featured-content article a.call-to-action,
				#tertiary .widget_archive li:hover,
				#tertiary .widget_categories li:hover,
				#tertiary .widget.widget_archive a,
				#tertiary .widget.widget_categories a,
				#tertiary .widget.widget_pages a,
				#tertiary .widget.widget_nav_menu a {
					color: #<?php echo sanitize_text_field( $main_accent_txt ); ?>;
				}
			</style><?php
		endif;

		/**
		 * Secondary Accent
		 */
		if ( ! empty( $secondary_accent_bg ) && '9091ad' != $secondary_accent_bg ) : ?>
			<style type="text/css">
				#page-header,
				#single-header {
					background-color: #<?php echo sanitize_text_field( $secondary_accent_bg ); ?>;
				}
			</style><?php
		endif;
		if ( ! empty( $secondary_accent_txt ) && '222222' != $secondary_accent_txt ) : ?>
			<style type="text/css">
				#page-header.no-hero,
				#page-header.no-hero a,
				#single-header.no-hero,
				#single-header.no-hero a {
					color: #<?php echo sanitize_text_field( $secondary_accent_txt ); ?>;
				}
			</style><?php
		endif;

		/**
		 * Entry Content Links
		 */
		if ( ! empty( $links ) && '222222' != $links ) : ?>
			<style type="text/css">
				.entry-content a {
					color: #<?php echo sanitize_text_field( $links ); ?>;
				}
			</style><?php
		endif;

		/**
		 * Header Content
		 */
		if ( ! empty( $site_top_content_bg ) && '222222' != $site_top_content_bg ) : ?>
			<style type="text/css">
				#site-top-content {
					background-color: #<?php echo sanitize_text_field( $site_top_content_bg ); ?>;
				}
			</style><?php
		endif;
		if ( ! empty( $site_top_content_txt ) && 'ffffff' != $site_top_content_txt ) : ?>
			<style type="text/css">
				#site-top-content,
				#site-top-content a {
					color: #<?php echo sanitize_text_field( $site_top_content_txt ); ?>;
				}
			</style><?php
		endif;
	}// end function corporate_customized_colors
endif;

// Only proceed if Corporate is in use.
$current_theme          = wp_get_theme();
$current_theme_name     = ! empty( $current_theme ) ? (string) $current_theme->Name : null;
$current_theme_template = ! empty( $current_theme ) ? (string) $current_theme->Template : null;
if ( 'Corporate' === $current_theme_name || 'corporate' === $current_theme_template ) :
	add_action( 'customize_register', 'corporate_custom_colors_customize_register', 11 );
	add_action( 'wp_head', 'corporate_customized_colors' );
endif;