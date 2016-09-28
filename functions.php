<?php

add_theme_support( 'title-tag' );

function rest_theme_scripts() {
	wp_enqueue_style( 'normalize', get_template_directory_uri() . '/assets/normalize.css', false, '3.0.3' );
	wp_enqueue_style( 'style', get_stylesheet_uri(), array( 'normalize' ) );

	$base_url  = esc_url_raw( home_url() );
	$base_path = rtrim( parse_url( $base_url, PHP_URL_PATH ), '/' );

	wp_enqueue_script( 'rest-theme-vue', get_template_directory_uri() . '/rest-theme/dist/build.js', array(), '1.0.0', true );
	wp_localize_script( 'rest-theme-vue', 'wp', array(
		'root'      => esc_url_raw( rest_url() ),
		'base_url'  => $base_url,
		'base_path' => $base_path ? $base_path . '/' : '/',
		'nonce'     => wp_create_nonce( 'wp_rest' ),
		'site_name' => get_bloginfo( 'name' ),
		'routes'    => rest_theme_routes(),
	) );
}

add_action( 'wp_enqueue_scripts', 'rest_theme_scripts' );

function rest_theme_routes() {
	$routes = array();

	$query = new WP_Query( array(
		'post_type'      => 'any',
		'post_status'    => 'publish',
		'posts_per_page' => -1,
	) );
	if ( $query->have_posts() ) {
		while ( $query->have_posts() ) {
			$query->the_post();
			$routes[] = array(
				'id'   => get_the_ID(),
				'type' => get_post_type(),
				'slug' => basename( get_permalink() ),
				'template' => get_page_template_slug( get_the_ID() ),
			);
		}
	}
	wp_reset_postdata();

	return $routes;
}

function attach_template_to_page( $page_name, $template_name ) {

    $page = get_page_by_title( $page_name, OBJECT, 'page' );
    $page_id = null == $page ? -1 : $page->ID;

    if( -1 != $page_id ) {
        update_post_meta( $page_id, '_wp_page_template', $template_name );
    }

    return $page_id;
}

attach_template_to_page( 'test', 'test' );
