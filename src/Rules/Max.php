<?php

declare(strict_types=1);

namespace Axm\Validation\Rules;


/*
* Class Max

 * (c) Juan Cristobal <juancristobalgd1@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE file
 * that was distributed with this source code.
 * @author  Juan Cristobal <juancristobalgd1@gmail.com>
 * @package Axm\Validation\Rules
 */

class Max
{
  public function validate($value, array $parameters): bool
  {

    $isValid = false;

    foreach ($parameters as $parameter) {
      // var_dump($value, $parameter);
      if (is_numeric($value)) {
        $isValid = $this->validateNumeric($value, $parameter);
      } elseif (is_string($value)) {
        $isValid = $this->validateString($value, $parameter);
      } elseif (is_file($value)) {
        $isValid = $this->validateFile($value, $parameter);
      }

      if ($isValid) {
        return true;
      }
    }

    return false;
  }

  private function validateNumeric($value, $parameter): bool
  {
   
    return $value <= (int) $parameter;
  }

  private function validateString($value, $parameter): bool
  {
    // dd( (int) $parameter >= mb_strlen($value));
    return (int) $parameter >= mb_strlen($value);
  }

  private function validateFile($value, $parameter): bool
  {
    $size = filesize($value);
    $maxSize = $parameter;

    if ($size <= (int) $maxSize) {
      return true;
    }

    return false;
  }
}
