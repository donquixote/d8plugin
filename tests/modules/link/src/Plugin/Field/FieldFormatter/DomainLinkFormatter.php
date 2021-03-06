<?php


namespace Drupal\d8plugin_test_link\Plugin\Field\FieldFormatter;

use Drupal\d8plugin\Plugin\ConfigurablePluginTrait;
use Drupal\d8plugin_field\Formatter\Context\ViewModeFieldDisplayFormContextInterface;
use Drupal\d8plugin_field\FieldInfo\ViewModeFieldDisplayInterface;
use Drupal\d8plugin_field\Formatter\ConfigurableFormatterInterface;


/**
 * Plugin implementation of the 'link_domain' formatter.
 *
 * @FieldFormatter(
 *   id = "d8plugin_link_domain",
 *   label = @Translation("Link domain (d8plugin)"),
 *   field_types = {
 *     "link_field"
 *   }
 * )
 */
class DomainLinkFormatter extends LinkFormatter implements ConfigurableFormatterInterface {
  use ConfigurablePluginTrait;

  /**
   * {@inheritdoc}
   */
  public function settingsForm(ViewModeFieldDisplayFormContextInterface $context) {
    $element['strip_www'] = array(
      '#title' => t('Strip www. from domain'),
      '#type' => 'checkbox',
      '#default_value' => $context->getFormatterSetting('strip_www'),
    );
    return $element;
  }

  /**
   * @param ViewModeFieldDisplayInterface $context
   *
   * @return null|string
   */
  public function settingsSummary(ViewModeFieldDisplayInterface $context) {
    if ($context->getFormatterSetting('strip_www')) {
      return t('Strip www. from domain');
    }
    else {
      return t('Leave www. in domain');
    }
  }

  /**
   * Returns default configuration for this plugin.
   *
   * @return array
   *   An associative array with the default configuration.
   */
  public function defaultConfiguration() {
    return array(
      'strip_www' => FALSE,
    );
  }
}
