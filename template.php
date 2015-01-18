<?php

/**
 * Implements template_preprocess_html().
 *
 */
function custom_zurb_preprocess_html(&$variables) {
  // Add conditional CSS for IE. To use uncomment below and add IE css file
  //drupal_add_css(path_to_theme() . '/css/ie.css', array('weight' => CSS_THEME, 'browsers' => array('!IE' => FALSE), 'preprocess' => FALSE));

  // Need legacy support for IE downgrade to Foundation 2 or use JS file below
  // drupal_add_js('http://ie7-js.googlecode.com/svn/version/2.1(beta4)/IE7.js', 'external');
  //
  
  if (!empty($variables['head_title'])) {
    $site_name = strip_tags(variable_get('site_name'));
    $variables['head_title_array']['name'] = $site_name;
    $variables['head_title'] = implode(' | ', $variables['head_title_array']);
  }
}

/**
 * Implements template_preprocess_page
 *
 */
function custom_zurb_preprocess_page(&$variables) {
  // Alter group menu for top bar. Its a bit hacky would be better to place a
  // block region in the top bar, but the zurb top bar is fickle...
  global $user;
  global $base_url;
  /* $variables['top_bar_profile_nav'] = ''; */
  /* if ($block = module_invoke('profile_feature', 'block_view', 'profile_nav')) { */
  /*   $variables['top_bar_profile_nav'] = ' */
  /*   <ul id="profile-nav-wrapper" class="secondary link-list right"> */
  /*     <li class="last expanded has-dropdown not-click" title=""> */
  /*       <a href="' . $base_url . '/user" title="">My Account</a> */
  /*       <ul class="dropdown"> */
  /*         <li class="first last leaf" title="">' . render($block) . '</li> */
  /*       </ul> */
  /*     </li> */
  /*   </ul>'; */
  /* } */

  /* $variables['title_suffix'] = message_feature_flag_links(); */

  $title = '';
  // Rebuild linked_site_name without using l function as it kills html.
  $variables['linked_site_name'] = '';
  if (!empty($variables['site_name'])) {
    $site_name = strip_tags($variables['site_name']);
    $title = $site_name . ' ' . t('Home');
    $variables['linked_site_name'] = "<a href='{$base_url}' rel='home' title='{$title}'>{$variables['site_name']}</a>";
  }

  $variables['favicon_img'] = '';
  if ($favicon = theme_get_setting('favicon')) {
    $variables['favicon_img'] = theme('image', array(
      'path'  => $favicon,
      'alt'   => $site_name . ' ' . t('favicon'),
      'title' => $title,
      'attributes' => array(
        'class' => array('favicon'),
      ),
    ));
  }

  $variables['linked_favicon']  = '';
  if (!empty($variables['favicon_img'])) {
    $variables['linked_favicon'] = l($variables['favicon_img'], '<front>', array(
      'attributes' => array(
        'rel'   => 'home',
        'title' => $title,
      ),
      'html' => TRUE,
    ));
  }

  // Remove user picture on profile page.
  /* if (arg(0) == "user" || arg(0) == "users") { */
  /*   unset ($variables['page']['content']['system_main']['user_picture']); */
  /* } */
}

/**
 * Implements theme_links() targeting the main menu specifically.
 * Formats links for Top Bar http://foundation.zurb.com/docs/components/top-bar.html
 */
function custom_zurb_links__topbar_groups($variables) {
  // We need to fetch the links ourselves because we need the entire tree.
  $links = $variables['links'];
  $output = _zurb_foundation_links($links);
  $variables['attributes']['class'][] = 'right';

  return '<ul' . drupal_attributes($variables['attributes']) . '>' . $output . '</ul>';
}

/**
 * Implements template_links
 */
function custom_zurb_node_view_alter(&$build){  
  if ($build['#view_mode'] === 'teaser'){
    unset($build['links']);
  }
  // Remove "Read more" link
  unset($build['links']['node']['#links']['node-readmore']);
  // Remove "1 comment" link
  unset($build['links']['comment']['#links']['comment-comments']);
  // Remove "Add new comment" link
  unset($build['links']['comment']['#links']['comment-add']);
}

/**
 * Implements template_preprocess_node
 */
function custom_zurb_preprocess_node(&$variables) {
  $variables['submitted_date'] = format_date($variables['node']->created, 'custom','d M Y');
}

function custom_zurb_preprocess_comment(&$variables) {
  $date = format_date($variables['comment']->created, 'medium');
  $variables['submitted'] = t('!username !datetime', array('!username' => $variables['author'], '!datetime' => $date));
  unset($variables['content']['links']['comment']['#links']['comment-reply']);
}

/**
 * Implements hook_preprocess_block()
 */
//function custom_zurb_preprocess_block(&$variables) {
//  // Add wrapping div with global class to all block content sections.
//  $variables['content_attributes_array']['class'][] = 'block-content';
//
//  // Convenience variable for classes based on block ID
//  $block_id = $variables['block']->module . '-' . $variables['block']->delta;
//
//  // Add classes based on a specific block
//  switch ($block_id) {
//    // System Navigation block
//    case 'system-navigation':
//      // Custom class for entire block
//      $variables['classes_array'][] = 'system-nav';
//      // Custom class for block title
//      $variables['title_attributes_array']['class'][] = 'system-nav-title';
//      // Wrapping div with custom class for block content
//      $variables['content_attributes_array']['class'] = 'system-nav-content';
//      break;
//
//    // User Login block
//    case 'user-login':
//      // Hide title
//      $variables['title_attributes_array']['class'][] = 'element-invisible';
//      break;
//
//    // Example of adding Foundation classes
//    case 'block-foo': // Target the block ID
//      // Set grid column or mobile classes or anything else you want.
//      $variables['classes_array'][] = 'six columns';
//      break;
//  }
//
//  // Add template suggestions for blocks from specific modules.
//  switch($variables['elements']['#block']->module) {
//    case 'menu':
//      $variables['theme_hook_suggestions'][] = 'block__nav';
//    break;
//  }
//}

//function custom_zurb_preprocess_views_view(&$variables) {
//}

/**
 * Implements template_preprocess_panels_pane().
 *
 */
//function custom_zurb_preprocess_panels_pane(&$variables) {
//}

/**
 * Implements template_preprocess_views_views_fields().
 *
 */
//function custom_zurb_preprocess_views_view_fields(&$variables) {
//}

/**
 * Implements theme_form_element_label()
 * Use foundation tooltips
 */
//function custom_zurb_form_element_label($variables) {
//  if (!empty($variables['element']['#title'])) {
//    $variables['element']['#title'] = '<span class="secondary label">' . $variables['element']['#title'] . '</span>';
//  }
//  if (!empty($variables['element']['#description'])) {
//    $variables['element']['#description'] = ' <span data-tooltip="top" class="has-tip tip-top" data-width="250" title="' . $variables['element']['#description'] . '">' . t('More information?') . '</span>';
//  }
//  return theme_form_element_label($variables);
//}

/**
 * Implements hook_preprocess_button().
 */
//function custom_zurb_preprocess_button(&$variables) {
//  $variables['element']['#attributes']['class'][] = 'button';
//  if (isset($variables['element']['#parents'][0]) && $variables['element']['#parents'][0] == 'submit') {
//    $variables['element']['#attributes']['class'][] = 'secondary';
//  }
//}

/**
 * Implements hook_form_alter()
 * Example of using foundation sexy buttons
 */
function custom_zurb_form_alter(&$form, &$form_state, $form_id) {
  if ($form_id == 'search_block_form') { 
    $form['search_block_form']['#attributes']['placeholder'] = t('Search...'); 
  }  
}
  
/**
 * Implements hook_form_comment_form_alter()
 */
function custom_zurb_form_comment_form_alter(&$form, &$form_state) {
  global $user;
  $label = t('new label');
  if (isset($form['author']['_author'])) {
    $language = $form['comment_body']['und']['#language'];
    /* $form['author']['_author']['#markup'] = profile_feature_load_user_picture($user); */
    $form['author']['_author']['#title'] = '';
    $form['comment_body'][$language][0]['value']['#attributes']['placeholder'] = 'Add your comment';

    // Why don't these work??
    //$form['author']['_author']['#attributes']['class'][] = 'user-picture';
    //unset($form['comment_body'][$language][0]['#title']);
    //unset($form['comment_body'][$language]['#title']);
  }
}

/**
 * Implements template_preprocess_panels_pane().
 */
// function zurb_foundation_preprocess_panels_pane(&$variables) {
// }

/**
 * Implements template_preprocess_views_views_fields().
 */
/* Delete me to enable
function THEMENAME_preprocess_views_view_fields(&$variables) {
 if ($variables['view']->name == 'nodequeue_1') {

   // Check if we have both an image and a summary
   if (isset($variables['fields']['field_image'])) {

     // If a combined field has been created, unset it and just show image
     if (isset($variables['fields']['nothing'])) {
       unset($variables['fields']['nothing']);
     }

   } elseif (isset($variables['fields']['title'])) {
     unset ($variables['fields']['title']);
   }

   // Always unset the separate summary if set
   if (isset($variables['fields']['field_summary'])) {
     unset($variables['fields']['field_summary']);
   }
 }
}

// */

/**
 * Implements hook_css_alter().
 */
//function custom_zurb_css_alter(&$css) {
//  // Always remove base theme CSS.
//  $theme_path = drupal_get_path('theme', 'zurb_foundation');
//
//  foreach($css as $path => $values) {
//    if(strpos($path, $theme_path) === 0) {
//      unset($css[$path]);
//    }
//  }
//}

/**
 * Implements hook_js_alter().
 */
//function custom_zurb_js_alter(&$js) {
//  // Always remove base theme JS.
//  $theme_path = drupal_get_path('theme', 'zurb_foundation');
//
//  foreach($js as $path => $values) {
//    if(strpos($path, $theme_path) === 0) {
//      unset($js[$path]);
//    }
//  }
//}

/**
 * Implements theme_field__field_type().
 *
 * Override taxonomy specific changes from the zurb theme, we dont need them.
 */
function custom_zurb_field__taxonomy_term_reference($variables) {
  $output = '';

  // Render the label, if it's not hidden.
  if (!$variables['label_hidden']) {
    //$output .= '<h2 class="field-label">' . $variables['label'] . ': </h2>';
    $output .= '<div ' . $variables['title_attributes'] . '>' . $variables['label'] . ':&nbsp;</div>';
  }

  // Render the items.
  //$output .= ($variables['element']['#label_display'] == 'inline') ? '<ul class="links inline">' : '<ul class="links">';
  //foreach ($variables['items'] as $delta => $item) {
    //$output .= '<li class="taxonomy-term-reference-' . $delta . '"' . $variables['item_attributes'][$delta] . '>' . drupal_render($item) . '</li>';
  //}
  //$output .= '</ul>';

  // Edit module requires some extra wrappers to work.
  if (module_exists('edit')) {
    $output .= '<div class="field-items"' . $variables['content_attributes'] . '>';
    foreach ($variables['items'] as $delta => $item) {
      $classes = 'field-item ' . ($delta % 2 ? 'odd' : 'even');
      $output .= '<div class="' . $classes . '"' . $variables['item_attributes'][$delta] . '>' . drupal_render($item) . '</div>';
    }
    $output .= '</div>';
  }
  else {
    foreach ($variables['items'] as $item) {
      $output .= drupal_render($item);
    }
  }

  // Render the top-level DIV.
  //$output = '<div class="' . $variables['classes'] . (!in_array('clearfix', $variables['classes_array']) ? ' clearfix' : '') . '">' . $output . '</div>';
  $output = '<div class="' . $variables['classes'] . '"' . $variables['attributes'] . '>' . $output . '</div>';

  return $output;
}

