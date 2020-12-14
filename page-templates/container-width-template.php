<?php
/**
 * Template Name: Container Width Template
 *
 * @package Starter_Theme
 */

$context = Timber::context();
$post = Timber::query_post();
$context['post'] = $post;
Timber::render(  'container-width-template.twig' , $context );