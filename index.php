<?php
/**
 * The main template file
 *
 * @package DC_Brochure_Theme
 */

$context = Timber::context();

$context['pagination'] = Timber::get_pagination();
$context['paged'] = $paged;
$context['posts'] = new Timber\PostQuery();
$post = new Timber\Post();
$context['title'] = get_the_title( $post->ID );


$templates = array( 'index.twig' );
Timber::render( $templates, $context );