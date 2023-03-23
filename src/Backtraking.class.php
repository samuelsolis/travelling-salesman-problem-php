<?php
require_once('CSVFile.class.php');
require_once('vendor/autoload.php');

/**
 * Class Backtraking
 */
class Backtraking {

  protected array $graph;
  protected int $size;

  private CSVFile $storageController;

    /**
   * Backtraking constructor.
   *
   * @param CSVFile $storageController
   *   The database.
   */
  public function __construct(CSVFile $storageController){
    $this->storageController = $storageController;
    $graph = $this->storageController->load();

    // Remove headers.
    unset($graph[0]);
    $graph = array_values($graph);
    $size = count($graph);

    for ($i=0;$i<$size;$i++) {
      unset($graph[$i][0]);
      $graph[$i] = array_values($graph[$i]);
    }

    // Reset keys after unsets.
    $this->graph = $graph;
    $this->size = count($graph);
  }

  /**
   *
   * The travelling salesman problem solution using backtraking strategy.
   *
   * @param $v
   *   Noded visited.
   * @param $currPos
   *   Current position.
   * @param $count
   *   Total nodes visited.
   * @param $distance
   *   Total distance saved.
   * @param $minimal
   *   Minimal distance in the route.
   */
  function tsp(&$v, $currPos, $count, $distance, &$minimal) {

    // If last node is reached and it has a link
    // to the starting node i.e the source then
    // keep the minimum value out of the total cost
    // of traversal and "ans"
    // Finally return to check for more possible values
    if ($count == $this->size && $this->graph[$currPos][0]) {
      $minimal = min($minimal, $distance + $this->graph[$currPos][0]);
      return;
    }

    // BACKTRACKING STEP
    // Loop to traverse the adjacency list
    // of currPos node and increasing the count
    // by 1 and cost by graph[currPos][i] value
    for ($i = 0; $i < $this->size; $i++) {
      if (!@$v[$i] &&   $this->graph[$currPos][$i]) {

        // Mark as visited
        $v[$i] = true;
        $this->tsp($v, $i, $count + 1, $distance + $this->graph[$currPos][$i], $minimal);

        // Mark ith node as unvisited
        $v[$i] = false;
      }
    }
  }

}
