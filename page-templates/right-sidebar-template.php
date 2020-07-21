<?php
/**
 * Template Name: Right Sidebar Template
 *
 * @package DC_Brochure_Theme
 */

$context = Timber::context();
$post = Timber::query_post();
$context['post'] = $post;
Timber::render(  'right-sidebar-template.twig' , $context );