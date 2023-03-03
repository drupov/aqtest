# Advancedqueue test module

Module to test unique items are being created in advancedqueue in Drupal.

Make sure you have patched advancedqueue with https://www.drupal.org/node/2918866.

## Usage

Run `drush queue-items` or `drush queue-items --num-items=10` to queue a large number ot items at once.

Run `drush queue-one-item` subsequently, to try to queue the same item.

Note: in order to clean up the `default`-queue you can run

`drush ev '\Drupal\advancedqueue\Entity\Queue::load("default")->getBackend()->deleteQueue();'`
