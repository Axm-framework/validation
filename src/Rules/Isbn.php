<?php

declare(strict_types=1);

namespace Axm\Validation\Rules;

use function implode;
use function is_scalar;
use function preg_match;
use function sprintf;


/*
* Class Isbn

 * (c) Juan Cristobal <juancristobalgd1@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE file
 * that was distributed with this source code.
 * @author  Juan Cristobal <juancristobalgd1@gmail.com>
 * @package Axm\Validation\Rules
 */

class Isbn
{
    private const PATTERN = '/^(?:ISBN(?:-1[03])?:? )?(?=[0-9X]{10}$|(?=(?:[0-9]+[- ]){3})[- 0-9X]{13}$|97[89][0-9]{10}$|(?=(?:[0-9]+[- ]){4})[- 0-9]{17}$)(?:97[89][- ]?)?[0-9]{1,5}[- ]?[0-9]+[- ]?[0-9]+[- ]?[0-9X]$/';

    public function validate($input): bool
    {
        if (!is_scalar($input)) {
            return false;
        }

        return $this->isValidIsbn((string) $input);
    }

    private function isValidIsbn(string $input): bool
    {
        return preg_match(self::PATTERN, $input) > 0;
    }
}
