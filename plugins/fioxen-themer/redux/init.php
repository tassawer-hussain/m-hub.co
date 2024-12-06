<?php
function fioxen_themer_redux_register_import_extension_loader($ReduxFramework){
	$path = dirname( __FILE__ ) . '/extensions/';
		$folders = scandir( $path, 1 );
		foreach( $folders as $folder ){
			if ( $folder === '.' or $folder === '..' or ! is_dir( $path . $folder ) ) {
				continue;
			}
			$extension_class = 'ReduxFramework_Extension_' . $folder;
			if( ! class_exists( $extension_class ) ) {
				  // In case you wanted override your override, hah.
				  $class_file = $path . $folder . '/extension_' . $folder . '.php';
				  $class_file = apply_filters( 'redux/extension/' . $ReduxFramework->args['opt_name'] . '/' . $folder, $class_file );
				  if ( $class_file ) {
						require_once( $class_file );
				  }
			}
			if( ! isset( $ReduxFramework->extensions[ $folder ] ) ) {
				$ReduxFramework->extensions[ $folder ] = new $extension_class( $ReduxFramework );
			}
		}
}
// Modify {$redux_opt_name} to match your opt_name
add_action("redux/extensions/fioxen_theme_options/before", 'fioxen_themer_redux_register_import_extension_loader', 0);
