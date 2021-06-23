<?php

// This generates a starting time

$context = Timber\Timber::context();
$context['post'] = new Timber\Post();

Timber\Timber::render('single.twig', $context, 600);
