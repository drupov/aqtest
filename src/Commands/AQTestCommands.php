<?php

namespace Drupal\aqtest\Commands;

use Drupal\advancedqueue\Entity\Queue;
use Drupal\advancedqueue\Job;
use Drush\Commands\DrushCommands;

class AQTestCommands extends DrushCommands {

  /**
   * Drush command to queue multiple items at once.
   *
   * Each item is being queued twice, so only one of each should be created.
   *
   * @command queue-items
   * @aliases qi
   *
   * @option num-items
   *   The number of items to create.
   *
   * @usage queue-items
   *   Imports the default number (100 items) into the default advancedqueue.
   * @usage queue-items --num-items=10
   *   Imports 10 items into the default advancedqueue.
   *
   * @throws \Exception
   */
  public function queueItems($options = ['num-items' => self::OPT]) {
    $num_items = $options['num-items'] ?? 100;

    $items = [];
    for ($i = 1; $i <= $num_items; $i++) {
      $item = [
        'id' => $i,
        'name' => $this->generateRandomString(),
      ];

      $items[] = $item;
    }

    foreach ($items as $item) {
      $job = Job::create('aqtest', $item);
      $queue = Queue::load('default');
      $queue->enqueueJob($job);
      // Import the item again, should not be possible.
      $queue->enqueueJob($job);
    }
  }

  /**
   * Drush command to queue one item.
   *
   * Calling this command a second time should not create the item again.
   *
   * @command queue-one-item
   * @aliases qoi
   *
   * @usage queue-one-item
   *   Queues one static item.
   *
   * @throws \Exception
   */
  public function queueOneItem() {
    $job = Job::create('aqtest', [
      'id' => 1,
      'name' => 'John',
    ]);
    $queue = Queue::load('default');
    $queue->enqueueJob($job);
  }

  /**
   * Generate a random string.
   *
   * @return string
   */
  private function generateRandomString() {
    $characters = 'abcdefghijklmnopqrstuvwxyz';
    $random_string = '';
    for ($i = 0; $i < 10; $i++) {
      $random_string .= $characters[rand(0, strlen($characters) - 1)];
    }

    return ucfirst($random_string);
  }

}
