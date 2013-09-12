<?php

/**
 * @file
 * Contains \Drupal\views_vertical_tabs\Plugin\views\style\VerticalTabs.
 */

namespace Drupal\views_vertical_tabs\Plugin\views\style;

use Drupal\Core\Annotation\Translation;
use Drupal\views\Annotation\ViewsStyle;
use Drupal\views\Plugin\views\style\StylePluginBase;


/**
 * Style plugin to render each item in an ordered or unordered list.
 *
 * @ingroup views_style_plugins
 *
 * @ViewsStyle(
 *   id = "vertical_tabs",
 *   title = @Translation("Vertical Tabs"),
 *   help = @Translation("Displays rows as Vertical tabs."),
 *   theme = "views_view_vertical_tabs",
 *   display_types = {"normal"}
 * )
 */
class VerticalTabs extends StylePluginBase {

  /**
   * Does the style plugin allows to use style plugins.
   *
   * @var bool
   */
  protected $usesRowPlugin = TRUE;

  /**
   * Does the style plugin support custom css class for the rows.
   *
   * @var bool
   */
  protected $usesRowClass = TRUE;

  /**
   * Does the style plugin support grouping of rows.
   *
   * @var bool
   */
  protected $usesGrouping = FALSE;

  /**
   * Does the style plugin for itself support to add fields to it's output.
   *
   * This option only makes sense on style plugins without row plugins, like
   * for example table.
   *
   * @var bool
   */
  protected $usesFields = TRUE;

  /**
   * {@inheritdoc}
   */
  protected function defineOptions() {
    $options = parent::defineOptions();

    $options['title'] = array('default' => '');
    $options['description'] = array('default' => '');
    $options['summary'] = array('default' => '');

    return $options;
  }

  /**
   * {@inheritdoc}
   */
  public function buildOptionsForm(&$form, &$form_state) {
    parent::buildOptionsForm($form, $form_state);
    $options = array('' => t('- None -'));
    $field_labels = $this->displayHandler->getFieldLabels(TRUE);
    $options += $field_labels;

    $form['title'] = array(
      '#type' => 'select',
      '#title' => t('Tab Title'),
      '#options' => $options,
      '#default_value' => $this->options['title'],
      '#description' => t('Choose the title of each tab.'),
      '#weight' => -49,
    );

    $form['summary'] = array(
      '#type' => 'select',
      '#title' => t('Tab Summary'),
      '#options' => $options,
      '#default_value' => $this->options['summary'],
      '#description' => t('Optional tab summary.'),
      '#weight' => -48,
    );

    $form['description'] = array(
      '#type' => 'select',
      '#title' => t('Fieldset Description'),
      '#options' => $options,
      '#default_value' => $this->options['description'],
      '#description' => t('Optional tab description.'),
      '#weight' => -47,
    );
  }

}
