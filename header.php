<!DOCTYPE html>
<html <?php language_attributes(); ?>>
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
		<?php wp_head(); ?>
  </head>
  <body <?php body_class(); ?>>
  <?php wp_body_open(); ?>
    <header>
      <nav>
        <ul>
          <li><a href="#vision">about me</a></li>
          <li><a href="#projects">my projects</a></li>
          <li><a href="#contacts">contact</a></li>
        </ul>
      </nav>
    </header>