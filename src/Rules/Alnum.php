<?php

declare(strict_types=1);

namespace Axm\Validation\Rules;

use function ctype_alnum;

/*
* Class Alnum

 * (c) Juan Cristobal <juancristobalgd1@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE file
 * that was distributed with this source code.
 * @author  Juan Cristobal <juancristobalgd1@gmail.com>
 * @package Axm\Validation\Rules
 */

class Alnum
{
  /**
   * Validates whether the input is alphanumeric or not.
   *
   * Alphanumeric is a combination of alphabetic (a-z and A-Z) and numeric (0-9)
   * characters.
   *
   */
  function validate($input): bool
  {
    return ctype_alnum($input);
  }
}
