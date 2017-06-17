<?php

namespace Drupal\facebook_flush_cache\Kernel;

use Drupal\KernelTests\KernelTestBase;

/**
 * @group facebook_flush_cache
 */
class FacebookFlushInstall extends KernelTestBase {

  /**
   * {@inheritdoc}
   */
  public static $modules = ['facebook_flush_cache'];

  /**
   * Tests that an Email Log entity is created on Sendgrid event.
   */
  public function testFoo() {

    $module = \Drupal::moduleHandler()->moduleExists('facebook_flush_cache');

    $this->assertTrue($module);
  }

}




