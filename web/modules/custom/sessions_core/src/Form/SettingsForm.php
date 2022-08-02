<?php

namespace Drupal\sessions_core\Form;

use Drupal\Core\Form\ConfigFormBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * Class SettingsForm. Configure Sessions core settings for this site.
 */
class SettingsForm extends ConfigFormBase {

  /**
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'sessions_core_settings';
  }

  /**
   * {@inheritdoc}
   */
  protected function getEditableConfigNames() {
    return ['sessions_core.settings'];
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    $form['start_date'] = [
      '#type' => 'date',
      '#title' => 'Start Date',
      '#default_value' => $this->config('sessions_core.settings')->get('start_date'),
    ];
    $form['end_date'] = [
      '#type' => 'date',
      '#title' => 'End Date',
      '#default_value' => $this->config('sessions_core.settings')->get('end_date'),
    ];
    $form['sessions_limit'] = [
      '#type' => 'textfield',
      '#title' => 'Number of Sessions',
      '#default_value' => $this->config('sessions_core.settings')->get('sessions_limit'),
      '#size' => 5,
    ];
    return parent::buildForm($form, $form_state);
  }

  /**
   * {@inheritdoc}
   */
  public function validateForm(array &$form, FormStateInterface $form_state) {
    $start_date = strtotime($form_state->getValue('start_date'));
    $end_date = strtotime($form_state->getValue('end_date'));
    if ($start_date >= $end_date) {
      $form_state->setErrorByName('start_date', $this->t('Start date should be before the end date.'));
    }

    if (!$form_state->getValue('sessions_limit')) {
      $form_state->setErrorByName('sessions_limit', $this->t('Please enter valid number of sessions'));
    }
    parent::validateForm($form, $form_state);
  }

  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
    $this->config('sessions_core.settings')
      ->set('start_date', $form_state->getValue('start_date'))
      ->set('end_date', $form_state->getValue('end_date'))
      ->set('sessions_limit', $form_state->getValue('sessions_limit'))
      ->save();
    parent::submitForm($form, $form_state);
  }

}
