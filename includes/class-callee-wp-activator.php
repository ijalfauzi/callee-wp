<?php

/**
 * Fired during plugin activation
 *
 * @link       https://ijalfauzi.com
 * @since      1.0.0
 *
 * @package    Callee_WP
 * @subpackage Callee_WP/includes
 */

/**
 * Fired during plugin activation.
 *
 * This class defines all code necessary to run during the plugin's activation.
 *
 * @since      1.0.0
 * @package    Callee_WP
 * @subpackage Callee_WP/includes
 * @author     Ijal Fauzi <hello@ijalfauzi.com>
 */
class Callee_WP_Activator {

	/**
	 * Short Description. (use period)
	 *
	 * Long Description.
	 *
	 * @since    1.0.0
	 */
	public static function activate() {
		global $wpdb;

        //create table appoinment/request demo
	    $wpdb->query("CREATE TABLE IF NOT EXISTS callee_appointment (
	    id int(11) unsigned NOT NULL AUTO_INCREMENT,
	    name varchar(255) NOT NULL,
	    no_wa varchar(20) NOT NULL,
	    email varchar(255) NOT NULL,
	    perusahaan varchar(255) NOT NULL,
	    tanggal date NOT NULL,
	    waktu varchar(255) NOT NULL,
	    created_at datetime NOT NULL,
        PRIMARY KEY (`id`))"); 
        
        //create table download cp
        $wpdb->query("CREATE TABLE IF NOT EXISTS callee_cp (
        id int(11) unsigned NOT NULL AUTO_INCREMENT,
        name varchar(255) NOT NULL,
        no_wa varchar(20) NOT NULL,
        email varchar(255) NOT NULL,
        perusahaan varchar(255) NOT NULL,
        created_at datetime NOT NULL,
        PRIMARY KEY (`id`))"); 

        //create table kontak
        $wpdb->query("CREATE TABLE IF NOT EXISTS callee_kontak (
        id int(11) unsigned NOT NULL AUTO_INCREMENT,
        name varchar(255) NOT NULL,
        no_wa varchar(20) NOT NULL,
        email varchar(255) NOT NULL,
        perusahaan varchar(255) NOT NULL,
        domisili varchar(255) NOT NULL,
        kebutuhan TINYTEXT NOT NULL,
        created_at datetime NOT NULL,
        PRIMARY KEY (`id`))");

        //create table preview modul
	    $wpdb->query("CREATE TABLE IF NOT EXISTS callee_modul (
        id int(11) unsigned NOT NULL AUTO_INCREMENT,
        name varchar(255) NOT NULL,
        no_wa varchar(20) NOT NULL,
        email varchar(255) NOT NULL,
        perusahaan varchar(255) NOT NULL,
        lokasi varchar(255) NOT NULL,
        created_at datetime NOT NULL,
        PRIMARY KEY (`id`))"); 
	}

}
