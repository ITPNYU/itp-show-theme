<?php
  function itpshow_setup() {
    // the custom-header is the skinny version of the postcard image used once
    // the projects have been announced.
    add_theme_support('custom-header');
  }

  function itpshow_customize($wp_customize) {
    $wp_customize->add_section('itpshow', array(
        'title'    => __('Show Information', 'itpshow'),
        'priority' => 0,
    ));

    // Settings

    $wp_customize->add_setting('show_announcement', array(
      'default'        => 'The Winter Show will be on December 18 & 19 from 5-9pm. More details to follow.',
      'type'           => 'option'
    ));

    $wp_customize->add_setting('show_time', array(
        'default'        => 'December 18 & 19 from 5-9pm',
        'type'           => 'option'
    ));

    $wp_customize->add_setting('show_postcard', array('type' => 'option'));

    // Controls for settings

    $wp_customize->add_control('itpshow_show_announcement', array(
      'label'         => __("Write a quick 1-2 sentencea announcement of the show for the postcard page."),
      'section'       => 'itpshow',
      'settings'      => 'show_announcement'
    ));

    $wp_customize->add_control('itpshow_show_time', array(
        'label'      => __('Fill out text of when the show is happening', 'itpshow'),
        'section'    => 'itpshow',
        'settings'   => 'show_time'
    ));

    $wp_customize->add_control(new WP_Customize_Upload_Control($wp_customize, 'postcard_image', array(
        'label'      => __( 'Postcard Image', 'itpshow' ),
        'section'    => 'itpshow',
        'settings'   => 'show_postcard',
    )));
  }
  add_action('customize_register', 'itpshow_customize');
  add_action('after_setup_theme', 'itpshow_setup');
?>