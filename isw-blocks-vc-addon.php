<?php
/*
Plugin Name: iSoftware Blocks VC Addon
Plugin URI: http://www.isoftware.gr/wordpress/plugins/isw-blocks
Description: Adds iSoftware Blocks to Visual Composer Elements.
Version: 0.2.0
Author: Shawn Beelman Graphic Design
Author URI: http://sbgraphicdesign.com
*/
 
include_once( ABSPATH . 'wp-admin/includes/plugin.php' ); // Require plugin.php to use is_plugin_active() below
if ( is_plugin_active( 'isw-blocks/isw-blocks.php' ) && is_plugin_active( 'js_composer/js_composer.php' ) ) {

	add_action( 'vc_before_init', 'isw_blocks_integrateWithVC' );
	function isw_blocks_integrateWithVC() {
		
		$iswb = get_posts( 'post_type="block"&numberposts=-1' );
		
		$blocks = array();
		if ( $iswb ) {
			foreach ( $iswb as $block ) {
				$blocks[ $block->post_title ] = $block->ID;
			}
		} else {
			$blocks[ __( 'No blocks found', 'js_composer' ) ] = 0;
		}
	
		vc_map( 
		    array(
				'base' => 'isw-block',
				'name' => __( 'Block', 'js_composer' ),
				//'icon' => 'icon-wpb-isw-block',
				'category' => __( 'Content', 'js_composer' ),
				'description' => __( 'Place Block', 'js_composer' ),
				'params' => array(
					array(
						'type' => 'dropdown',
						'heading' => __( 'Select block', 'js_composer' ),
						'param_name' => 'id',
						'value' => $blocks,
						'description' => __( 'Choose previously created block from the drop down list.', 'js_composer' )
					),
/*
					array(
						'type' => 'checkbox',
						'heading' => __( 'Display Block Title', 'js_composer' ),
						'param_name' => 'display_title',
						'value' => 0,
						'description' => __( 'Whether to display the block\'s title above its content.', 'js_composer' )
					)
*/
				)
			)
		);
	}
}
