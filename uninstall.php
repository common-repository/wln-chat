<?php
//if uninstall not called from WordPress exit.
if ( !defined( 'WP_UNINSTALL_PLUGIN' ) ) 
    exit();

// Deleta as opções
delete_option( 'wln_settings_page' );
delete_option( 'wln_register_plugin_settings' );
delete_option( 'wln-plugin-settings-group-fields' );
delete_option( 'phone_option' );

delete_site_option( 'wln_settings_page' );
delete_site_option( 'wln_register_plugin_settings' );
delete_site_option( 'wln-plugin-settings-group-fields' );
delete_site_option( 'phone_option' );