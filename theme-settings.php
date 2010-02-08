<?
// $Id: theme-settings.php,v 1.1.2.4 2009/12/02 00:47:46 sociotech Exp $

/**
 * Theme setting defaults
 */
function yaml_theme_default_theme_settings() {
  $defaults = array(
    'user_notverified_display'              => 1,
    'breadcrumb_display'                    => 1,
    'search_snippet'                        => 1,
    'search_info_type'                      => 1,
    'search_info_user'                      => 1,
    'search_info_date'                      => 1,
    'search_info_comment'                   => 1,
    'search_info_upload'                    => 1,
    'rebuild_registry'                      => 0,
    'fix_css_limit'                         => 0,
    'block_config_link'                     => 1,
    'theme_yaml_layout'                     => '3col_123',
    'theme_yaml_show_header'                => 1,
    'page_width'                            => 'page100',
    'theme_font'                            => 'none',
    'theme_font_size'                       => 'font-size-13',
    'theme_color'                           => '',
    'page_bottom'                           => 'Based on the drupal <a href="http://drupal-yaml-theme.com" targe="_blanc">yaml_theme</a> and the yaml-CSS-framework',
  );

  // Add site-wide theme settings
  $defaults = array_merge($defaults, theme_get_settings());

  return $defaults;
}

/**
* Implementation of THEMEHOOK_settings() function.
*
* @param $saved_settings
*   array An array of saved settings for this theme.
* @return
*   array A form array.
*/
function phptemplate_settings($saved_settings) {
  global $base_url;

  // Get theme name from url (admin/.../theme_name)
  $theme_name = arg(count(arg()) - 1);

  // Combine default theme settings from .info file & theme-settings.php
  $theme_data = list_themes();   // get data for all themes
  $info_theme_settings = ($theme_name) ? $theme_data[$theme_name]->info['settings'] : array();
#  $defaults = array_merge(yaml_theme_default_theme_settings(), $info_theme_settings);
  $defaults = yaml_theme_default_theme_settings();

  // Combine default and saved theme settings
  $settings = array_merge($defaults, $saved_settings);
  // Create theme settings form widgets using Forms API

  // TNT Fieldset
  $form['tnt_container'] = array(
    '#type' => 'fieldset',
    '#title' => t('YAML theme settings'),
    '#description' => t('Use these settings to enhance the appearance and functionality of your YAML theme.'),
    '#collapsible' => TRUE,
    '#collapsed' => FALSE,
  );

  // General Settings
  $form['tnt_container']['general_settings'] = array(
    '#type' => 'fieldset',
    '#title' => t('General settings'),
    '#collapsible' => TRUE,
    '#collapsed' => TRUE,
    '#weight' => 1,
  );
  $form['tnt_container']['general_settings']['theme_yaml_show_header'] = array(
    '#type' => 'checkbox',
    '#title' => t('Show header'),
    '#default_value' => $settings['theme_yaml_show_header'],
    '#weight' => 1,
  );

  $form['tnt_container']['extra_fields'] = array(
    '#type' => 'fieldset',
    '#title' => t('Extra Fields'),
    '#collapsible' => TRUE,
    '#collapsed' => TRUE,
    '#weight' => 0,
  );

  $form['tnt_container']['extra_fields']['page_bottom'] = array(
    '#type' => 'textfield',
    '#title' => t('Page Bottom Text'),
    '#description' => t('This text is show in the bottom page are. Leave blanc to remove'),
    '#collapsible' => TRUE,
    '#collapsed' => TRUE,
    '#weight' => -1,
    '#maxlength' => 600,
    '#default_value' => $settings['page_bottom']
  );


  // Theme fonts
  $form['tnt_container']['general_settings']['theme_font_config'] = array(
    '#type' => 'fieldset',
    '#title' => t('Typography'),
    '#collapsible' => TRUE,
    '#collapsed' => TRUE,
  );
  // Font family settings
  $form['tnt_container']['general_settings']['theme_font_config']['theme_font_config_font'] = array(
    '#type'        => 'fieldset',
    '#title'       => t('Font family'),
    '#collapsible' => TRUE,
    '#collapsed'   => TRUE,
   );
  $form['tnt_container']['general_settings']['theme_font_config']['theme_font_config_font']['theme_font'] = array(
    '#type'          => 'radios',
    '#title'         => t('Select a new font family'),
    '#default_value' => $settings['theme_font'],
    '#options'       => array(
      'none' => t('Theme default'),
      'font-family-sans-serif-sm' => '<span class="font-family-sans-serif-sm">' . t('Sans serif - smaller (Helvetica Neue, Arial, Helvetica, sans-serif)') . '</span>',
      'font-family-sans-serif-lg' => '<span class="font-family-sans-serif-lg">' . t('Sans serif - larger (Verdana, Geneva, Arial, Helvetica, sans-serif)') . '</span>',
      'font-family-serif-sm' => '<span class="font-family-serif-sm">' . t('Serif - smaller (Garamond, Perpetua, Nimbus Roman No9 L, Times New Roman, serif)') . '</span>',
      'font-family-serif-lg' => '<span class="font-family-serif-lg">' . t('Serif - larger (Baskerville, Georgia, Palatino, Palatino Linotype, Book Antiqua, URW Palladio L, serif)') . '</span>',
      'font-family-myriad' => '<span class="font-family-myriad">' . t('Myriad (Myriad Pro, Myriad, Trebuchet MS, Arial, Helvetica, sans-serif)') . '</span>',
      'font-family-lucida' => '<span class="font-family-lucida">' . t('Lucida (Lucida Sans, Lucida Grande, Lucida Sans Unicode, Verdana, Geneva, sans-serif)') . '</span>',
    ),
  );
  // Font size settings
  $form['tnt_container']['general_settings']['theme_font_config']['theme_font_config_size'] = array(
    '#type'        => 'fieldset',
    '#title'       => t('Font size'),
    '#collapsible' => TRUE,
    '#collapsed'   => TRUE,
  );
  $form['tnt_container']['general_settings']['theme_font_config']['theme_font_config_size']['theme_font_size'] = array(
    '#type'          => 'radios',
    '#title'         => t('Change the base font size'),
    '#description'   => t('Adjusts all text in proportion to your base font size.'),
    '#default_value' => $settings['theme_font_size'],
    '#options'       => array(
      'font-size-10' => t('10px'),
      'font-size-11' => t('11px'),
      'font-size-12' => t('12px'),
      'font-size-13' => t('13px'),
      'font-size-14' => t('14px'),
      'font-size-15' => t('15px'),
      'font-size-16' => t('16px'),
      'font-size-17' => t('17px'),
      'font-size-18' => t('18px'),
    ),
  );
  $form['tnt_container']['general_settings']['theme_font_config']['theme_font_config_size']['theme_font_size']['#options'][$defaults['theme_font_size']] .= t(' - Theme Default');

  $form['tnt_container']['general_settings']['theme_yaml_config'] = array(
    '#type' => 'fieldset',
    '#title' => t('Layout'),
    '#collapsible' => TRUE,
    '#collapsed' => TRUE,
  );

  $yaml_layouts = array();
  $yaml_layouts['3col_123'] = '3col_123';
  $yaml_layouts['2col_left_13'] = '2col_left_13';
  $yaml_layouts['2col_right_31'] = '2col_right_31';

  $form['tnt_container']['general_settings']['theme_yaml_config']['theme_yaml_layout'] = array(
    '#type'          => 'radios',
    '#title'         => t('Select a layout for your theme'),
    '#default_value' => $settings['theme_yaml_layout'],
    '#options'       => $yaml_layouts,
  );
  // Page width
  $form['tnt_container']['general_settings']['theme_yaml_config']['page_size'] = array(
    '#type' => 'fieldset',
    '#title' => t('Page size'),
    '#collapsible' => TRUE,
    '#collapsed' => true,
  );

  $form['tnt_container']['general_settings']['theme_yaml_config']['page_size']['page_width'] = array(
    '#type'          => 'select',
    '#title'         => t('Predefined sizes'),
    '#default_value' => $settings['page_width'],
    '#options'       => array(
      'page100' => t('100%'),
      'page95' => t('95%'),
      'page90' => t('90%'),
      'page85' => t('85%'),
      'page80' => t('80%'),
      'page75' => t('75%'),
      'page70' => t('70%'),
      'page65' => t('65%'),
      'page60' => t('60%'),
      'page55' => t('55%'),
    ),
  );
  $form['tnt_container']['general_settings']['theme_yaml_config']['page_size']['page_width_exact'] = array(
    '#type'          => 'textfield',
    '#title'         => t('or set a exact width on your own here(done forget px, %, em)'),
    '#description'   => t('If you leave this blanc, the value of the predefined sizes will be used'),
    '#default_value' => $settings['page_width_exact'],
  );

  // Return theme settings form
  return $form;
}
