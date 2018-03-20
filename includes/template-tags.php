<?php

/**
 * These functions are intended to be used within themes and plugins
 */

/**
 * Determine if post is unlinked
 *
 * @param  int $post_id
 * @since  1.0
 * @return bool
 */
function distributor_is_unlinked( $post_id = null ) {
	if ( null === $post_id ) {
		global $post;

		$post_id = $post->ID;
	}

	$unlinked = get_post_meta( $post_id, 'dt_unlinked' );

	return (bool) $unlinked;
}

/**
 * Get original post link as a string.
 *
 * @param  int  $post_id Leave null to use current post
 * @since  1.0
 * @return string|bool
 */
function distributor_get_original_post_link( $post_id = null ) {
	if ( null === $post_id ) {
		global $post;

		$post_id = $post->ID;
	}

	$original_blog_id = get_post_meta( $post_id, 'dt_original_blog_id', true );
	$original_post_id = get_post_meta( $post_id, 'dt_original_post_id', true );
	$original_site_name = get_post_meta( $post_id, 'dt_original_site_name', true );
	$original_post_url = get_post_meta( $post_id, 'dt_original_post_url', true );

	if ( ! empty( $original_blog_id ) && ! empty( $original_post_id ) ) {
		switch_to_blog( $original_blog_id );

		$link = get_permalink( $original_post_id );

		restore_current_blog();

		return $link;
	} elseif ( ! empty( $original_site_name ) && ! empty( $original_post_url ) ) {
		return $original_post_url;
	} else {
		return false;
	}
}

/**
 * See docblock for distributor_get_original_post_link
 *
 * @since 1.0
 */
function distributor_the_original_post_link( $post_id = null ) {
	echo distributor_get_original_post_link( $post_id );
}

/**
 * Get original site name
 *
 * @param  int  $post_id Leave null to use current post
 * @since  1.0
 * @return string|bool
 */
function distributor_get_original_site_name( $post_id = null ) {
	if ( null === $post_id ) {
		global $post;

		$post_id = $post->ID;
	}

	$original_blog_id = get_post_meta( $post_id, 'dt_original_blog_id', true );
	$original_site_name = get_post_meta( $post_id, 'dt_original_site_name', true );

	if ( ! empty( $original_blog_id ) ) {
		switch_to_blog( $original_blog_id );

		$text = get_bloginfo( 'name' );

		restore_current_blog();

		return $text;
	} elseif ( ! empty( $original_site_name ) ) {
		return $original_site_name;
	} else {
		return false;
	}
}

/**
 * See docblock for distributor_get_original_site_name
 *
 * @since 1.0
 */
function distributor_the_original_site_name( $post_id = null ) {
	echo distributor_get_original_site_name( $post_id );
}

/**
 * Get original site link
 *
 * @param  int  $post_id Leave null to use current post
 * @since  1.0
 * @return string|bool
 */
function distributor_get_original_site_link( $post_id = null ) {
	if ( null === $post_id ) {
		global $post;

		$post_id = $post->ID;
	}

	$original_blog_id = get_post_meta( $post_id, 'dt_original_blog_id', true );
	$original_site_url = get_post_meta( $post_id, 'dt_original_site_url', true );

	if ( ! empty( $original_blog_id ) ) {
		switch_to_blog( $original_blog_id );

		$link = home_url();

		restore_current_blog();

		return $link;
	} elseif ( ! empty( $original_site_url ) ) {
		return $original_site_url;
	} else {
		return false;
	}
}

/**
 * See docblock for distributor_get_original_site_link
 *
 * @since 1.0
 */
function distributor_the_original_site_link( $post_id = null ) {
	echo distributor_get_original_site_link( $post_id );
}