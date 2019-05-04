<?php

/**
 * Plugin Name: Library to be used for other Plugins
 * Description: If activated separately, it will load.
 */

// Maybe we have already pulled our library?
if ( class_exists( 'Plugin_Library' ) ) {
    return;
}

class Plugin_Library {

    public function load() {
        // This will be used as a check if we have already loaded the plugin.
        if ( defined( 'Plugin_Library_Loaded' ) ) { return; }
        define( 'Plugin_Library_Loaded', true );
      
        // Change site title.
        add_filter( 'bloginfo', array( $this, 'change_title' ), 10, 2 );
    }

    public function change_title( $title, $show ) {
        if ( 'name' === $show ) {
            return 'Changed through Library';
        }

        return $title;
    }
}

// Initialize the plugin if not already loaded.
add_action( 'init', function(){
    if ( ! defined( 'Plugin_Library_Loaded' ) ) {
        $plugin = new Plugin_Library();
        $plugin->load();
    }
});