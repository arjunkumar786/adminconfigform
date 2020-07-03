<?php
/**
 * @file
 * Contains \Drupal\customglobal\Form\MyAccountForm_tab1.
 */
namespace Drupal\customglobal\Form;

use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Session\AccountInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Drupal\user\UserStorageInterface;


class MyAccountForm_tab1 extends FormBase {

   /**
   * @var AccountInterface $account
   */
  protected $account;
  protected $userStorage;

  /**
   * {@inheritdoc}
  */
  public static function create(ContainerInterface $container) {
    return new static(
      $container->get('current_user'),
      $container->get('entity_type.manager')->getStorage('user')
    );
  }

  /**
   * Class constructor.
   */
  public function __construct( AccountInterface $account, UserStorageInterface $user_storage) {
    $this->account = $account;
    $this->userStorage = $user_storage->load($this->account->id());
  }

  /**
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'MyAccountForm_tab';
  }

   /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    $form['#theme'] = 'myaccountform_tab1_template';
    $form['name'] = array(
      '#type' => 'textfield',
      '#title' => t('Name:'),
      '#required' => TRUE,
      '#default_value' => isset($this->userStorage->name->value)? $this->userStorage->name->value : '',
    );

    $form['container']['actions']['#type'] = 'actions';
    
    $form['container']['actions']['submit'] = array(
      '#type' => 'submit',
      '#value' => $this->t('Updated'),
      '#button_type' => 'primary',
    );
    $form['container']['actions']['back'] = array(
      '#type' => 'tag',
      '#markup' => '<a href="/doctors/myappointments" class="btn btn-success">Cancel</a>',
    );
    return $form;
  }

  /**
   * {@inheritdoc}
   */
  public function validateForm(array &$form, FormStateInterface $form_state) {

  }

  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {

    // $this->userStorage->set('field_username', $form_state->getValue('name'));
    // $this->userStorage->set('field_phone_number', $form_state->getValue('phonenumber'));
    
    // $this->userStorage->save();
    \Drupal::messenger()->addMessage($this->t('Profile updated successfully'), 'status', TRUE);
    return;
  }

}
