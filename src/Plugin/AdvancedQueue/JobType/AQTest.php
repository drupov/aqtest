<?php

namespace Drupal\aqtest\Plugin\AdvancedQueue\JobType;

use Drupal\advancedqueue\Job;
use Drupal\advancedqueue\Plugin\AdvancedQueue\JobType\JobTypeBase;

/**
 * @AdvancedQueueJobType(
 *   id = "aqtest",
 *   label = @Translation("AQTest"),
 * )
 */
class AQTest extends JobTypeBase {

  /**
   * @inheritDoc
   */
  public function process(Job $job) {
    // We will not process anything.
    return;
  }

}
