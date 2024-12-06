<?php
/**
 	* Include the TGM_Plugin_Activation class.
*/
add_action( 'tgmpa_register', 'fioxen_register_required_plugins' );

function fioxen_register_required_plugins() {
	$plugins = array(
		array(
			'name'                     => esc_html__('Fioxen Themer', 'fioxen'),
	    	'slug'                    	=> 'fioxen-themer',
	    	'required'                	=> true,
	    	'source'				   		=> 'http://gaviasthemes.com/plugins/fioxen-themer.zip'
		),
		array(
			'name'                     => esc_html__('Slider Revolution', 'fioxen'),
	    	'slug'                    	=> 'revslider',
	    	'required'                	=> true,
	    	'source'				   		=> 'http://gaviasthemes.com/plugins/revslider.zip'
		),
		array(
			'name'                     => esc_html__('Elementor Page Builder', 'fioxen'),
		   'slug'                     => 'elementor',
		   'required'                 => true,
		),
		array(
			'name'                     => esc_html__('WP Job Manager', 'fioxen'),
		   'slug'                     => 'wp-job-manager',
		   'required'                 => true,
		),
		array(
			'name'                     => esc_html__('Redux Framework', 'fioxen'),
		   'slug'                     => 'redux-framework',
		   'required'                 => true,
		),
		array(
			'name'                     => esc_html__('Meta Box', 'fioxen'),
		   'slug'                     => 'meta-box',
		   'required'                 => true,
		),
		array(
			'name'                     => esc_html__('Contact Form 7', 'fioxen'),
		   'slug'                     => 'contact-form-7',
		   'required'                 => true,
		),
		array(
			'name'                     => esc_html__('MailChimp', 'fioxen'),
		   'slug'                     => 'mailchimp-for-wp',
		   'required'                 => true,
		),
		array(
			'name'                     => esc_html__('Events Calendar', 'fioxen'), 
		   'slug'                     => 'the-events-calendar', 
		   'required'                 => true, 
		),
		array(
			'name'                     => esc_html__('Woocommerce', 'fioxen'), 
		   'slug'                     => 'woocommerce',
		   'required'                 => false,
		),
	);
	$config = array(
		'default_path' => '', // Default absolute path to pre-packaged plugins.
		'menu' => 'tgmpa-install-plugins', // Menu slug.
		'has_notices' => true, // Show admin notices or not.
		'dismissable' => true, // If false, a user cannot dismiss the nag message.
		'dismiss_msg' => '', // If 'dismissable' is false, this message will be output at top of nag.
		'is_automatic' => false, // Automatically activate plugins after installation or not.
		'message' => '', // Message to output right before the plugins table.
		'strings' => array(
		'page_title' => esc_html__( 'Install Required Plugins', 'fioxen' ),
		'menu_title' => esc_html__( 'Install Plugins', 'fioxen' ),
		'installing' => esc_html__( 'Installing Plugin: %s', 'fioxen' ), // %s = plugin name.
		'oops' => esc_html__( 'Something went wrong with the plugin API.', 'fioxen' ),
		'notice_can_install_required' => _n_noop( 'This theme requires the following plugin: %1$s.', 'This theme requires the following plugins: %1$s.', 'fioxen' ), // %1$s = plugin name(s).
		'notice_can_install_recommended' => _n_noop( 'This theme recommends the following plugin: %1$s.', 'This theme recommends the following plugins: %1$s.' , 'fioxen' ), // %1$s = plugin name(s).
		'notice_cannot_install' => _n_noop( 'Sorry, but you do not have the correct permissions to install the %s plugin. Contact the administrator of this site for help on getting the plugin installed.', 'Sorry, but you do not have the correct permissions to install the %s plugins. Contact the administrator of this site for help on getting the plugins installed.', 'fioxen' ), // %1$s = plugin name(s).
		'notice_can_activate_required' => _n_noop( 'The following required plugin is currently inactive: %1$s.', 'The following required plugins are currently inactive: %1$s.' , 'fioxen'), // %1$s = plugin name(s).
		'notice_can_activate_recommended' => _n_noop( 'The following recommended plugin is currently inactive: %1$s.', 'The following recommended plugins are currently inactive: %1$s.' , 'fioxen'), // %1$s = plugin name(s).
		'notice_cannot_activate' => _n_noop( 'Sorry, but you do not have the correct permissions to activate the %s plugin. Contact the administrator of this site for help on getting the plugin activated.', 'Sorry, but you do not have the correct permissions to activate the %s plugins. Contact the administrator of this site for help on getting the plugins activated.', 'fioxen' ), // %1$s = plugin name(s).
		'notice_ask_to_update' => _n_noop( 'The following plugin needs to be updated to its latest version to ensure maximum compatibility with this theme: %1$s.', 'The following plugins need to be updated to their latest version to ensure maximum compatibility with this theme: %1$s.' , 'fioxen'), // %1$s = plugin name(s).
		'notice_cannot_update' => _n_noop( 'Sorry, but you do not have the correct permissions to update the %s plugin. Contact the administrator of this site for help on getting the plugin updated.', 'Sorry, but you do not have the correct permissions to update the %s plugins. Contact the administrator of this site for help on getting the plugins updated.' , 'fioxen'), // %1$s = plugin name(s).
		'install_link' => _n_noop( 'Begin installing plugin', 'Begin installing plugins' , 'fioxen'),
		'activate_link' => _n_noop( 'Begin activating plugin', 'Begin activating plugins', 'fioxen' ),
		'return' => esc_html__( 'Return to Required Plugins Installer', 'fioxen' ),
		'plugin_activated' => esc_html__( 'Plugin activated successfully.', 'fioxen' ),
		'complete' => esc_html__( 'All plugins installed and activated successfully. %s', 'fioxen' ), // %s = dashboard link.
		'nag_type' => 'updated' // Determines admin notice type - can only be 'updated', 'update-nag' or 'error'.
		)
	);
   tgmpa( $plugins, $config );
}