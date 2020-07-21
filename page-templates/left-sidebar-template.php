<?php
/**
 * Template Name: Left Sidebar Template
 *
 * @package DC_Brochure_Theme
 */

$context = Timber::context();
$post = Timber::query_post();
$context['post'] = $post;
Timber::render(  'left-sidebar-template.twig' , $context );