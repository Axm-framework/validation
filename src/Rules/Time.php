<?php

declare(strict_types=1);

namespace Axm\Validation\Rules;

use DateTime;

/*
* Class Time

 * (c) Juan Cristobal <juancristobalgd1@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE file
 * that was distributed with this source code.
 * @author  Juan Cristobal <juancristobalgd1@gmail.com>
 * @package Axm\Validation\Rules
 */

class Time
{
    private array $formats = [
        'Y-m-d H:i:s',
        'Y-m-d\TH:i:s.uP',
        'Y-m-d\TH:i:sP',
        'Y-m-d\TH:i:s',
        'Y-m-d',
        'D, d M Y H:i:s O',
        'D, d M Y H:i:s e',
        'D, d M Y H:i:s T',
        'D, d M Y H:i:s',
        'D, d M Y',
        'd M Y H:i:s O',
        'd M Y H:i:s e',
        'd M Y H:i:s T',
        'd M Y H:i:s',
        'd M Y',
        'Y/m/d H:i:s',
        'Y/m/d',
        'm/d/Y H:i:s',
        'm/d/Y',
    ];

    public function validate($input): bool
    {
        if (!is_string($input)) {
            return false;
        }

        foreach ($this->formats as $format) {
            $date = DateTime::createFromFormat($format, $input);
            if ($date && $date->format($format) === $input) {
                return true;
            }
        }

        return false;
    }
}
