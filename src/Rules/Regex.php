<?php

declare(strict_types=1);

namespace Axm\Validation\Rules;

use function is_scalar;
use function preg_match;

/*
 * Class Regex.
 *
 * (c) Alexandre Gomes Gaigalas <alexandre@gaigalas.net>
 *
 * For the full copyright and license information, please view the LICENSE file
 * that was distributed with this source code.
 */

class Regex
{
    private string $regex;

    public function validate($input, string $regex): bool
    {
        if (!is_scalar($input)) {
            return false;
        }

        $this->regex = $regex;

        return preg_match($this->regex, (string) $input) > 0;
    }
}
