<?php
/**
 * Template Name: Blank (No Header) Template
 *
 * @package Starter_Theme
 */

$context = Timber::context();
$post = Timber::query_post();
$context['post'] = $post;
Timber::render(  'blank-template.twig' , $context );