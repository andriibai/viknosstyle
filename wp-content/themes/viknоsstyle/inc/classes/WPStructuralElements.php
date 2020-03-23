<?php
/**
 * Class WPStructuralElements
 */
abstract class WPStructuralElements
{
   protected $labelsArray;
   protected $dataArray;
   abstract protected function dataArray();
   abstract protected function registration();
}