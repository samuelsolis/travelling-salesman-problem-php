<?php

use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Error\SyntaxError;

require_once('CSVFile.class.php');
require_once('vendor/autoload.php');

/**
 * Class KnapsackForm
 */
class DeliveryManForm {

  protected int $towns_number;
  protected array $towns;

  protected ?CSVFile $storageController;

  /**
   * DeliveryManForm constructor.
   *
   * @param CSVFile|null $storageController
   */
  public function __construct(?CSVFile $storageController) {
    $this->storageController = $storageController;
    $this->towns = $this->storageController->load();

    // Avoid the table header.
    $count = count($this->towns);
    if ($count > 0) {
      $count--;
    }
    $this->towns_number = $count;
  }

  /**
   * Print the form in HTML.
   *
   * @throws LoaderError
   * @throws RuntimeError
   * @throws SyntaxError
   */
  public function render() {

    $loader = new \Twig\Loader\FilesystemLoader(__DIR__.'/templates');
    $twig = new \Twig\Environment($loader);

    print $twig->render('DeliveryManForm.twig', [
      'towns' => $this->towns,
      'number_of_towns' => $this->towns_number,
    ]);
  }

  /**
   * Submit method of the form.
   */
  public function submit() {

    if (isset($_POST['number_of_towns'])) {
      $this->towns_number = $_POST['number_of_towns'];
      $this->towns = [];

      for($i=0;$i <= $this->towns_number;$i++) {
        for($j=0;$j <= $this->towns_number;$j++) {
          if ($i == 0 & $j == 0) {
            $this->towns[$i][$j] = 'Town';
          }

          elseif ($i == 0) {
            $this->towns[$i][$j] = 'T' . $j;
          }

          elseif ($j == 0) {
            $this->towns[$i][$j] = 'T' . $i;
          }

          elseif (!empty($_POST[$i . $j .'town'])) {
            $this->towns[$i][$j] = $_POST[$i . $j .'town'];
          }

          else {
            $this->towns[$i][$j] = 0;
          }
        }
      }

      $this->storageController->save($this->towns);
    }
  }
}