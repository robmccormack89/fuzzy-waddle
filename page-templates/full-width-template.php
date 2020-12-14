<?php
/**
 * Template Name: Full Width Template
 *
 * @package Starter_Theme
 */

$context = Timber::context();
$post = Timber::query_post();
$context['post'] = $post;
Timber::render(  'full-width-template.twig' , $context );