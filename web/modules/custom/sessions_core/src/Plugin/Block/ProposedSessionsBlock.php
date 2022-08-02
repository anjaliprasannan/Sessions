<?php

namespace Drupal\sessions_core\Plugin\Block;

use Drupal\Core\Block\BlockBase;
use Drupal\Core\Entity\EntityTypeManagerInterface;
use Drupal\Core\Plugin\ContainerFactoryPluginInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Count the number of proposed sessions and show it in a block.
 *
 * @Block(
 *   id = "proposed_sessions_count",
 *   admin_label = @Translation("Count of Proposed Sessions"),
 *   category = @Translation("Sessions core")
 * )
 */
class ProposedSessionsBlock extends BlockBase implements ContainerFactoryPluginInterface {

  /**
   * @var \Drupal\Core\Entity\EntityTypeManagerInterface
   */
  protected $entityManager;

  /**
   * {@inheritdoc}
   */
  public function build() {
    $query = $this->entityManager->getStorage('node')->getQuery();
    $results = $query->condition('type', 'session')
      ->condition('field_session_verdict', 'proposed')
      ->condition('status', 1)
      ->count()
      ->execute();

    $build = [];
    $build['content'] = [
      '#markup' => $this->t("There are a total of %count proposed sessions", [
        '%count' => $results,
        ]),
    ];
    return $build;
  }

  public static function create(ContainerInterface $container, array $configuration, $plugin_id, $plugin_definition) {
    return new static(
      $configuration,
      $plugin_id,
      $plugin_definition,
      $container->get('entity_type.manager')
    );
  }

  /**
   * @param array $configuration
   * @param string $plugin_id
   * @param mixed $plugin_definition
   * @param \Drupal\Core\Entity\EntityTypeManagerInterface $entity_manager
   */
  public function __construct(array $configuration, $plugin_id, $plugin_definition, EntityTypeManagerInterface $entity_manager) {
    parent::__construct($configuration, $plugin_id, $plugin_definition);
    $this->entityManager = $entity_manager;
  }

}
