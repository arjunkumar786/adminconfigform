<?php

/**
 * @file
 * Contains \Drupal\customglobal\Form\MyAccountForm_tab2.
 */

namespace Drupal\customglobal\Form;

use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Url;

class MyAccountForm_tab2 extends FormBase {
	/**
	 * {@inheritdoc}
	 */
	public function getFormId()
	{
		return 'MyAccountForm_tab1';
	}

	/**
	 * {@inheritdoc}
	 */
	public function buildForm(array $form, FormStateInterface $form_state) {

		$form['#theme'] = 'myaccountform_tab2_template';
		$form['staff_name'] = array(
			'#type' => 'textfield',
			'#title' => t('Staff Name:'),
			'#required' => TRUE,
		);
		$form['staff_mail'] = array(
			'#type' => 'email',
			'#title' => t('Email ID:'),
			'#required' => TRUE,
		);
		$form['staffcontact'] = array(
			'#type' => 'tel',
			'#title' => t('Cell No:'),
			'#required' => TRUE,
		);
		$form['staffaddress'] = array(
			'#type' => 'textfield',
			'#title' => t('Staff Address:'),
		);

		$form['actions']['#type'] = 'actions';
		$form['actions']['submit'] = array(
			'#type' => 'submit',
			'#value' => $this->t('Add Staff'),
			'#button_type' => 'primary',
		);
		return $form;
	}


	/**
	 * {@inheritdoc}
	 */
	public function validateForm(array &$form, FormStateInterface $form_state) {
		if (strlen($form_state->getValue('staff_mail')) == '') {
			$form_state->setErrorByName('staff_mail', $this->t('Staff email can not be blank.'));
		}
	}


	/**
	 * {@inheritdoc}
	 */
	public function submitForm(array &$form, FormStateInterface $form_state) {
		
		$url = Url::fromUri('internal:' . '/doctors/myaccount');
		$staff_email = $form_state->getValue('staff_mail');
		$staff_name = $form_state->getValue('staff_name');


		//Print message after staff value update
		\Drupal::messenger()->addMessage($this->t('Staff has been updated successfully.'), 'status', TRUE);
		
		$form_state->setRedirectUrl($url);
		return;
	}
}
