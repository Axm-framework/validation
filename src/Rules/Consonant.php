<?php

declare(strict_types=1);

namespace Axm\Validation\Rules;

use function preg_match;

/*
* Class Consonant

 * (c) Juan Cristobal <juancristobalgd1@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE file
 * that was distributed with this source code.
 * @author  Juan Cristobal <juancristobalgd1@gmail.com>
 * @package Axm\Validation\Rules
 */

class Consonant
{

  /**
   * Comprueba si una cadena contiene sólo consonantes y espacios en blanco.
   *
   * @param string $input Cadena a validar
   * @return bool true si la cadena es válida, de lo contrario false.
   */
  private function validate(string $input): bool
  {
    $consonantsRegex = '/^[b-df-hj-np-tv-z]+$/i';
    $whitespaceRegex = '/^\s*$/';
    return preg_match($consonantsRegex, $input) || preg_match($whitespaceRegex, $input);
  }
}
