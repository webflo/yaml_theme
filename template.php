<?
// dont remove once!
require_once('theme-settings.php');
/**
 * Global preprocessing
 */
function yaml_theme_preprocess(&$vars, $hook) {
  $yaml_layout = theme_get_setting('theme_yaml_layout');
  // Set the page layout to the current yaml layout
  // so actually (if existent) the page template from
  // templates/pages/page-$yaml_layout.tpl.php
  // will be used.
  // Currently we only use one page.tpl.php for all of them
  // but this could change in the future or in a subtheme,
  // maybe for a very special layout.
  $vars['template_files'][] = "page-$yaml_layout";

  // This is out little helper for using only one page.tpl.php.
  // We use it to determine the column count and hide the third column
  // if needed. Of course we could CSS for that, but why heat the client
  // browser even more?
  $override_layout = module_invoke_all('yaml_theme_layout',$yaml_layout, _yaml_theme_layouts());
  if(is_array($override_layout) && count($override_layout) > 0) {
    // only use the first
    $yaml_layout = $override_layout[0];
  };

  preg_match('/^(\d)col_.*/',$yaml_layout, $match);
  $vars['theme_cols'] = $match['1'];

  $vars['yaml_layout'] = $yaml_layout;
  $vars['ie_css'] = ' <!--[if lte IE 5]>
  <style type="text/css" media="all">@import "yaml/core/iehacks.css";</style>
  <![endif]-->';
}

/**
 * Page preprocessing
 */
function yaml_theme_preprocess_page(&$vars) {
  // extra fields
  $vars['page_bottom_text']  =  theme_get_setting('page_bottom');

  $vars['page_width_exact']  =  theme_get_setting('page_width_exact');
  $vars['theme_show_local_tasks']  =  theme_get_setting('theme_show_local_tasks');

  // If page_width_exact is empty, we use the fixed page_with to set the page width, otherwise..
  if($vars['page_width_exact'] == "") {
    $vars['page_width'] = theme_get_setting('page_width');
  }
  else { // use the customer one. Could be px, % or em
   	$vars['page_width_exact']  =  ' style="width:'.$vars['page_width_exact'].'"';
  }

  $vars['theme_show_header'] = theme_get_setting('theme_yaml_show_header');

  // sometimes its useful to make styles specific to the current operation ( edit, view)
  $vars['current_op'] = _yaml_theme_get_current_op();

  // Now we add the basemod for the current layout
  $theme = drupal_get_path('theme','yaml_theme');
  $custom_yaml = "yaml_drupal";
  $yaml_layout = $vars['yaml_layout'];

  // Little hack to prepend a hash key to the elements (as we can pass keys to array_unshift).
  $tmp["$theme/yaml.css"] = true;
  $tmp["$theme/$custom_yaml/screen/basemod_$yaml_layout.css"] = true;
  foreach($vars['css']['all']['theme'] as $path => $bool) {
    $tmp[$path] = $bool;
  }
  $vars['css']['all']['theme'] = $tmp;

  // We need to provide the array, as we actually did not change the cached internal
  // css array. Rerender all css includes and change the variable, which will later
  // print it into the page.tpl
  $vars['styles'] = drupal_get_css($vars['css']);

  $vars['tabs_primary'] = theme('yaml_tabs_primary',menu_primary_local_tasks());
  $vars['tabs_secondary'] = theme('yaml_tabs_secondary',menu_secondary_local_tasks());
}

/**
 * Node preprocessing
 */
function yaml_theme_preprocess_node(&$vars,$hook) {
  $variables['template_files'][] = 'node-'. $vars['nid'];
  $variables['template_files'][] = 'node-'. $vars['type'];
  $variables['template_files'][] = 'node-'. $vars['type'].'-'.$vars['nid'];

  $function = 'yaml_theme_preprocess_node'.'_'.$vars['type'];
  if (function_exists($function)) {
    $function($vars, $hook);
  }
}

function yaml_theme_theme() {
  return array(
    'yaml_tabs_primary' => array(
      'arguments' => array('tasks' => '')
    ),
    'yaml_tabs_secondary' => array(
      'arguments' => array('tasks' => '')
    )
  );
}

/**
 * Comment preprocessing
 */
function yaml_theme_preprocess_comment(&$vars) {
  global $user;
  static $comment_odd = TRUE;// Comment is odd or even

  // Build array of handy comment classes
  $comment_classes = array();
  $comment_classes[] = $comment_odd ? 'odd' : 'even';
  $comment_odd = !$comment_odd;
  $comment_classes[] = ($vars['comment']->status == COMMENT_NOT_PUBLISHED) ? 'comment-unpublished' : '';  // Comment is unpublished
  $comment_classes[] = ($vars['comment']->new) ? 'comment-new' : '';                                      // Comment is new
  $comment_classes[] = ($vars['comment']->uid == 0) ? 'comment-by-anon' : '';                             // Comment is by anonymous user
  $comment_classes[] = ($user->uid && $vars['comment']->uid == $user->uid) ? 'comment-mine' : '';         // Comment is by current user
  $node = node_load($vars['comment']->nid);                                                               // Comment is by node author
  $vars['author_comment'] = ($vars['comment']->uid == $node->uid) ? TRUE : FALSE;
  $comment_classes[] = ($vars['author_comment']) ? 'comment-by-author' : '';
  $comment_classes = array_filter($comment_classes);                                                      // Remove empty elements
  $vars['comment_classes'] = implode(' ', $comment_classes);                                              // Create class list separated by spaces

  // Date & author
  $submitted_by = t('by ') .'<span class="comment-name">'.  theme('username', $vars['comment']) .'</span>';
  $submitted_by .= t(' - ') .'<span class="comment-date">'.  format_date($vars['comment']->timestamp, 'small') .'</span>';     // Format date as small, medium, or large
  $vars['submitted'] = $submitted_by;
}

/**
 * Views preprocessing
 * Add view type class (e.g., node, teaser, list, table)
 */
function yaml_theme_preprocess_views_view(&$vars) {
  $vars['css_name'] = $vars['css_name'] .' view-style-'. views_css_safe(strtolower($vars['view']->type));
}

function _yaml_theme_get_current_op() {
  $mode = "view";
  if ((arg(0) == 'node' && arg(2) == 'edit')) {
    $mode = "edit-node";
  }
  else if ((arg(0) == 'node' && arg(2) == 'revisions' && arg(3) == 'view')) {
  	 $mode = "compare-revisions";
  }
  else if( arg(0) == 'user' && arg(2) == 'edit' ){
    $mode = "edit-user";
  }
  else if (arg(0) == 'node' && arg(1) == 'add' && arg(2) != "") {
    $mode = "add-mode";
  }

  return $mode;
}

function yaml_theme_yaml_tabs_primary($tasks) {
  if($tasks != "") {
    return "<ul class=\"tabs primary\">\n". $tasks ."</ul>\n";
  }
  //else
  return '';
}

function yaml_theme_yaml_tabs_secondary($tasks) {
  if($tasks != "") {
    return "<ul class=\"tabs secondary\">\n". $tasks ."</ul>\n";
  }
  //else
  return '';
}