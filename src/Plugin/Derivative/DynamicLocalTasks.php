<?php

namespace Drupal\facebook_flush_cache\Plugin\Derivative;

use Drupal\Component\Plugin\Derivative\DeriverBase;
use Drupal\facebook_flush_cache\FacebookFlushCacheService;

/**
 * Default controller for the simple_currency_converter module.
 */
class DynamicLocalTasks extends DeriverBase {

  /**
   * {@inheritdoc}
   */
  public function getDerivativeDefinitions($base_plugin_definition) {

    $this->derivatives['facebook_flush_cache.task_id'] = $base_plugin_definition;

    $this->derivatives['facebook_flush_cache.task_id']['title'] = "Clear facebook cache";

    $this->derivatives['facebook_flush_cache.task_id']['route_name'] = 'facebook_flush_cache.flush';

    return $this->derivatives;
  }

}
