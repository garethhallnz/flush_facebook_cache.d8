<?php

namespace Drupal\facebook_flush_cache\Kernel;

use Drupal\KernelTests\KernelTestBase;
use Drupal\simpletest\UserCreationTrait;
use Drupal\simpletest\WebTestBase;


/**
 * Class MenuTaskTest.
 *
 * @group facebook_flush_cache
 */
class MenuTaskTest extends WebTestBase {

//  use UserCreationTrait;

  /**
   * {@inheritdoc}
   */
  public static $modules = [
    'facebook_flush_cache',
  ];

  /**
   * {@inheritdoc}
   */
  public function setUp() {
    parent::setUp();

    // Create and log in an administrative user.
    $this->adminUser = $this->drupalCreateUser([
      'flush facebook cache',
    ]);
    $this->drupalLogin($this->adminUser);
  }

  /**
   * Tests that an Email Log entity is created on Sendgrid event.
   */
  public function testFoo() {

    $this->assertTrue(false);
//    $this->createUser([], 'test');
//
//    $event = new SendgridEvent([
//      'fintech_email_key' => 'test',
//      'email' => 'test@example.com',
//      'event' => 'processed',
//      'timestamp' => 123,
//    ]);
//
//    \Drupal::service('event_dispatcher')->dispatch(SendgridEvent::SENDGRID_EVENT_RECEIVED, $event);
//    $log = EckEntity::load(1);

//    $this->assertEquals(123, $log->get('created')->value);
  }

}
