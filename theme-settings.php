<?php
/**
 * Implements hook_form_FORM_ID_alter().
 *
 * @param $form
 *   The form.
 * @param $form_state
 *   The form state.
 */
function custom_zurb_form_system_theme_settings_alter(&$form, &$form_state) {
  if (!isset($form['custom_zurb'])) {
    $form['custom_zurb'] = array(
      '#type' => 'vertical_tabs',
      '#weight' => -10,
    );

    /*
     * General Settings.
     */
    $form['custom_zurb']['general'] = array(
      '#type' => 'fieldset',
      '#title' => t('General Settings'),
    );

    $form['custom_zurb']['general']['theme_settings'] = $form['theme_settings'];
    unset($form['theme_settings']);

    $form['custom_zurb']['general']['logo'] = $form['logo'];
    unset($form['logo']);

    $form['custom_zurb']['general']['favicon'] = $form['favicon'];
    unset($form['favicon']);

    /*
     * Foundation Top Bar.
     */
    $form['custom_zurb']['topbar'] = array(
      '#type' => 'fieldset',
      '#title' => t('Foundation Top Bar'),
      '#description' => t('The Foundation Top Bar gives you a great way to display a complex navigation bar on small or large screens.'),
    );

    $form['custom_zurb']['topbar']['custom_zurb_top_bar_enable'] = array(
      '#type' => 'select',
      '#title' => t('Enable'),
      '#description' => t('If enabled, the site name and main menu will appear in a bar along the top of the page.'),
      '#options' => array(
        0 => t('Never'),
        1 => t('Always'),
        2 => t('Mobile only'),
      ),
      '#default_value' => theme_get_setting('custom_zurb_top_bar_enable'),
    );

    // Group the rest of the settings in a container to be able to quickly hide
    // them if the Top Bar isn't being used.
    $form['custom_zurb']['topbar']['container'] = array(
      '#type' => 'container',
      '#states' => array(
        'visible' => array(
          'select[name="custom_zurb_top_bar_enable"]' => array('!value' => '0'),
        ),
      ),
    );

    $form['custom_zurb']['topbar']['container']['custom_zurb_top_bar_grid'] = array(
      '#type' => 'checkbox',
      '#title' => t('Contain to grid'),
      '#description' => t('Check this for your top bar to be set to your grid width.'),
      '#default_value' => theme_get_setting('custom_zurb_top_bar_grid'),
    );

    $form['custom_zurb']['topbar']['container']['custom_zurb_top_bar_sticky'] = array(
      '#type' => 'checkbox',
      '#title' => t('Sticky'),
      '#description' => t('Check this for your top bar to stick to the top of the screen when the user scrolls down. If you\'re using the Admin Menu module and have it set to \'Keep menu at top of page\', you\'ll need to check this option to maintain compatibility.'),
      '#default_value' => theme_get_setting('custom_zurb_top_bar_sticky'),
    );

    $form['custom_zurb']['topbar']['container']['custom_zurb_top_bar_scrolltop'] = array(
      '#type' => 'checkbox',
      '#title' => t('Scroll to top on click'),
      '#description' => t('Jump to top when sticky nav menu toggle is clicked.'),
      '#default_value' => theme_get_setting('custom_zurb_top_bar_scrolltop'),
      '#states' => array(
        'visible' => array(
          'input[name="custom_zurb_top_bar_sticky"]' => array('checked' => TRUE),
        ),
      ),
    );

    $form['custom_zurb']['topbar']['container']['custom_zurb_top_bar_is_hover'] = array(
      '#type' => 'checkbox',
      '#title' => t('Hover to expand menu'),
      '#description' => t('Set this to false to require the user to click to expand the dropdown menu.'),
      '#default_value' => theme_get_setting('custom_zurb_top_bar_is_hover'),
    );

    // Menu settings.
    $form['custom_zurb']['topbar']['container']['menu'] = array(
      '#type' => 'fieldset',
      '#title' => t('Dropdown Menu'),
      '#collapsible' => TRUE,
      '#collapsed' => TRUE,
    );

    $form['custom_zurb']['topbar']['container']['menu']['custom_zurb_top_bar_menu_text'] = array(
      '#type' => 'textfield',
      '#title' => t('Menu text'),
      '#description' => t('Specify text to go beside the mobile menu icon or leave blank for none.'),
      '#default_value' => theme_get_setting('custom_zurb_top_bar_menu_text'),
    );

    $form['custom_zurb']['topbar']['container']['menu']['custom_zurb_top_bar_custom_back_text'] = array(
      '#type' => 'checkbox',
      '#title' => t('Enable custom back text'),
      '#description' => t('This is the text that appears to navigate back one level in the dropdown menu. Set this to false and it will pull the top level link name as the back text.'),
      '#default_value' => theme_get_setting('custom_zurb_top_bar_custom_back_text'),
    );

    $form['custom_zurb']['topbar']['container']['menu']['custom_zurb_top_bar_back_text'] = array(
      '#type' => 'textfield',
      '#title' => t('Custom back text'),
      '#description' => t('Define what you want your custom back text to be.'),
      '#default_value' => theme_get_setting('custom_zurb_top_bar_back_text'),
      '#states' => array(
        'visible' => array(
          'input[name="custom_zurb_top_bar_custom_back_text"]' => array('checked' => TRUE),
        ),
      ),
    );

    /*
     * Tooltips.
     */
    $form['custom_zurb']['tooltips'] = array(
      '#type' => 'fieldset',
      '#title' => t('Tooltips'),
      '#collapsible' => TRUE,
    );

    $form['custom_zurb']['tooltips']['custom_zurb_tooltip_enable'] = array(
      '#type' => 'checkbox',
      '#title' => t('Display form element descriptions in a tooltip'),
      '#default_value' => theme_get_setting('custom_zurb_tooltip_enable'),
    );

    $form['custom_zurb']['tooltips']['custom_zurb_tooltip_position'] = array(
      '#type' => 'select',
      '#title' => t('Tooltip position'),
      '#options' => array(
        'tip-top' => t('Top'),
        'tip-bottom' => t('Bottom'),
        'tip-right' => t('Right'),
        'tip-left' => t('Left'),
      ),
      '#default_value' => theme_get_setting('custom_zurb_tooltip_position'),
      '#states' => array(
        'visible' => array(
          'input[name="custom_zurb_tooltip_enable"]' => array('checked' => TRUE),
        ),
      ),
    );

    $form['custom_zurb']['tooltips']['custom_zurb_tooltip_mode'] = array(
      '#type' => 'select',
      '#title' => t('Display mode'),
      '#description' => t('You can either display the tooltip on the form element itself or on a "More information?" link below the element.'),
      '#options' => array(
        'element' => t('On the form element'),
        'text' => t('Below element on "More information?" text'),
      ),
      '#default_value' => theme_get_setting('custom_zurb_tooltip_mode'),
      '#states' => array(
        'visible' => array(
          'input[name="custom_zurb_tooltip_enable"]' => array('checked' => TRUE),
        ),
      ),
    );

    $form['custom_zurb']['tooltips']['custom_zurb_tooltip_text'] = array(
      '#type' => 'textfield',
      '#title' => t('More information text'),
      '#description' => t('Customize the tooltip trigger text.'),
      '#default_value' => theme_get_setting('custom_zurb_tooltip_text'),
      '#states' => array(
        'visible' => array(
          'input[name="custom_zurb_tooltip_enable"]' => array('checked' => TRUE),
          'select[name="custom_zurb_tooltip_mode"]' => array('value' => 'text'),
        ),
      ),
    );

    $form['custom_zurb']['tooltips']['custom_zurb_tooltip_touch'] = array(
      '#type' => 'checkbox',
      '#title' => t('Disable for touch devices'),
      '#description' => t('If you don\'t want tooltips to interfere with a touch event, you can disable them for those devices.'),
      '#default_value' => theme_get_setting('custom_zurb_tooltip_touch'),
      '#states' => array(
        'visible' => array(
          'input[name="custom_zurb_tooltip_enable"]' => array('checked' => TRUE),
        ),
      ),
    );

    /*
     * Styles and Scripts.
     */
    $form['custom_zurb']['styles_scripts'] = array(
      '#type' => 'fieldset',
      '#title' => t('Styles and Scripts'),
      '#collapsible' => TRUE,
    );

    $form['custom_zurb']['styles_scripts']['custom_zurb_disable_core_css'] = array(
      '#type' => 'checkbox',
      '#title' => t('Disable Drupal Core CSS'),
      '#description' => t('Removes all CSS files provided by Drupal Core. <strong>Warning:</strong> This can break things, use with caution.'),
      '#default_value' => theme_get_setting('custom_zurb_disable_core_css'),
    );

    /*
     * Misc Settings.
     */
    $form['custom_zurb']['misc'] = array(
      '#type' => 'fieldset',
      '#title' => t('Misc Settings'),
      '#collapsible' => TRUE,
    );

    $form['custom_zurb']['misc']['custom_zurb_html_tags'] = array(
      '#type' => 'checkbox',
      '#title' => t('Prune HTML Tags'),
      '#default_value' => theme_get_setting('custom_zurb_html_tags'),
      '#description' => t('Prunes your <code>style</code>, <code>link</code>, and <code>script</code> tags as <a href="!link" target="_blank"> suggested by Nathan Smith</a>.', array('!link' => 'http://sonspring.com/journal/html5-in-drupal-7#_pruning')),
    );

    $form['custom_zurb']['misc']['custom_zurb_messages_modal'] = array(
      '#type' => 'checkbox',
      '#title' => t('Display status messages in a modal'),
      '#description' => t('Check this to display Drupal status messages in a Zurb Foundation reveal modal.'),
      '#default_value' => theme_get_setting('custom_zurb_messages_modal'),
    );

    $form['custom_zurb']['misc']['custom_zurb_pager_center'] = array(
      '#type' => 'checkbox',
      '#title' => t('Center pagers on screen'),
      '#description' => t('Uncheck this option to align pagers to the left. For more information on Foundation Pagers, please refer to the <a href="!link" target="_blank">documentation</a>.', array('!link' => 'http://foundation.zurb.com/docs/components/pagination.html')),
      '#default_value' => theme_get_setting('custom_zurb_pager_center'),
    );
  }
}
