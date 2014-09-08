<?php


namespace Drupal\d8plugin_filter\FilterPlugin;


use Drupal\d8plugin\Plugin\ConfigurablePluginInterface;

interface ConfigurableFilterInterface extends FilterInterface, ConfigurablePluginInterface {

  /**
   * Generates a filter's settings form.
   *
   * @param array $form
   *   A minimally prepopulated form array.
   * @param array $form_state
   *   The state of the (entire) configuration form.
   *
   * @return array
   *   The $form array with additional form elements for the settings of this
   *   filter. The submitted form values should match $this->settings.
   *
   * @see callback_filter_settings()
   */
  public function settingsForm(array $form, array &$form_state);

} 
