<?php

namespace Drupal\customglobal\Controller;

use Drupal\Core\Controller\ControllerBase;
use Drupal\customglobal\CustomService;
use Symfony\Component\DependencyInjection\ContainerInterface;

class MyAccountForm_tab3 extends ControllerBase {

  /**
   * The theme handler.
   *
   * @var \Drupal\customglobal\CustomService;
   */
  protected $customvar;
 
  /**
   * Constructs the BlockListController.
   *
   * @param \Drupal\customglobal\CustomService $custom.
   * 
   */
  public function __construct(CustomService $custom) {
    $this->customvar = $custom;
  }

  /**
   * {@inheritdoc}
   */
  public static function create(ContainerInterface $container) {
    return new static(
      $container->get('customglobal.customservice')
    );
  }

  public function staffsales() {
    $build = [
      '#markup' => '<p>'.$this->customvar->getUserTitle().' '.$this->customvar->whoIsYourOwner().'</p>',
    ];

    return $build;
  }
}