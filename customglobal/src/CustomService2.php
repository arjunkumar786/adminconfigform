<?php

namespace Drupal\customglobal;

use Drupal\customglobal\CustomService;

class CustomService2 {
  private $custom;

  /**
   * Part of the DependencyInjection magic happening here.
   */
  public function __construct(CustomService $custom) {
    $this->custom = $custom;
  }

  /**
   * Returns a a Drupal user as an owner.
   */
  public function getDruplerTitle() {
    return $this->custom->getUserTitle();
  }

}