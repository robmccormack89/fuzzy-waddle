<?php
/**
 * The template for displaying general archive pages
 *
 * @package DC_Brochure_Theme
 */

$templates = array( 'archive.twig', 'index.twig' );

$context = Timber::context();

$context['pagination'] = Timber::get_pagination();
$context['paged'] = $paged;

$context['title'] = 'Archive';
if ( is_day() ) {
	$context['title'] = 'Day: '.get_the_date( 'D M Y' );
} else if ( is_month() ) {
	$context['title'] = 'Month: '.get_the_date( 'M Y' );
} else if ( is_year() ) {
	$context['title'] = 'Year: '.get_the_date( 'Y' );
} else if ( is_tag() ) {
	$context['title'] = 'Tag: '.single_tag_title( '', false );
} else if ( is_category() ) {
	$context['title'] = 'Category: '.single_cat_title( '', false );
	array_unshift( $templates, 'archive-' . get_query_var( 'cat' ) . '.twig' );
} else if ( is_post_type_archive() ) {
	$context['title'] = post_type_archive_title( '', false );
	array_unshift( $templates, 'archive-' . get_post_type() . '.twig' );
} else if ( is_tax( 'service-type' ) ) {
	$context['title'] = single_term_title( '', false );
	array_unshift( $templates, 'archive-service-type.twig' );
	$context['archive_description'] = get_the_archive_description();
}

$context['posts'] = new Timber\PostQuery();

Timber::render( $templates, $context );