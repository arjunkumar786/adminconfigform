<?php

namespace Drupal\apikey\Form;

// Classes referenced in this class:
use Drupal\Core\Form\FormStateInterface;

// This is the form we are extending.
use Drupal\system\Form\SiteInformationForm;

/**
 * Configure site information settings for this site.
 */
class SiteApiKey extends SiteInformationForm {

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    // Retrieve the system.site configuration.
    $site_config = $this->config('system.site');
    // Get the original form from the class we are extending.
    $form = parent::buildForm($form, $form_state);

    // Add a textarea to the site information section of the form for our
    // description.
    $form['site_information']['siteapikey'] = [
      '#type' => 'textfield',
      '#title' => t('Site API Key'),
      // The default value is the new value we added to our configuration
      // in step 1.
      '#default_value' => $site_config->get('siteapikey') ? $site_config->get('siteapikey') : 'No API Key yet',
      '#description' => $this->t('The Site API Key.'),
    ];

    // Update form action test.
    $form['actions']['submit']['#value'] = t('Update Configuration');
    return $form;
  }

  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
    // Check condition for default value.
    if (($form_state->getValue('siteapikey') != 'No API Key yet') &&
    !empty($form_state->getValue('siteapikey'))) {
      // system.site.description configuration.
      $this->config('system.site')
      // The siteapikey is retrieved from the submitted form values
      // and saved to the 'description' element of the system.site config.
        ->set('siteapikey', $form_state->getValue('siteapikey'))
      // Make sure to save the configuration.
        ->save();

      \Drupal::messenger()->addMessage($this->t('Site API Key has been saved with %value', [
        '%value' => $form_state->getValue('siteapikey'),
      ]), 'status', TRUE);

      // Pass the remaining values off to the original form that we have
      // extended, so that they are also saved.
      parent::submitForm($form, $form_state);
    }
  }

}
