<?php

/**
 * Class File.
 */
class CSVFile {

  protected $filename;

  /**
   * File constructor. Open the file connection.
   */
  public function __construct($filename) {
    $this->filename = $filename;
  }

  /**
   * @return array
   *   T
   */
  public function load() {
    $handle = @fopen($this->filename, "r");
    $map = [];

    if ($handle) {
      while (($line = fgetcsv($handle, 0, ";")) != FALSE) {
        $map[] = $line;
      }
      fclose($handle);
    }

    return $map;
  }

  /*
   * Write the information in the file.
   */
  public function save($map) {
    $handle = fopen($this->filename, "w");
    foreach ($map as $line) {
      fputcsv($handle, $line, ';');
    }
    fclose($handle);
  }
}