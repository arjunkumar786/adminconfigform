<?php

namespace Drupal\customglobal;

use Drupal\Core\Session\AccountProxy;

class CustomService {
  private $currentUser;
  private $title = ['Mr.', 'Ms.'];

  /**
   * Part of the DependencyInjection magic happening here.
   */
  public function __construct(AccountProxy $currentUser) {
    $this->currentUser = $currentUser;
  }

  /**
   * Returns a a Drupal user as an owner.
   */
  public function whoIsYourOwner() {
    return $this->currentUser->getDisplayName();
  }

  /**
   * Returns a title.
   */
  public function getUserTitle() {
    return $this->title[array_rand($this->title)];
  }
}