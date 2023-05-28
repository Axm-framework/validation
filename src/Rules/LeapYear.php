<?php

declare(strict_types=1);

namespace Axm\Validation\Rules;


use DateTimeInterface;

use function date;
use function is_numeric;
use function is_scalar;
use function sprintf;
use function strtotime;

/*
* Class LeapYear

 * (c) Juan Cristobal <juancristobalgd1@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE file
 * that was distributed with this source code.
 * @author  Juan Cristobal <juancristobalgd1@gmail.com>
 * @package Axm\Validation\Rules
 */

class LeapYear
{
    public function validate($input): bool
    {
        $year = null;

        if (is_numeric($input)) {
            $year = (int) $input;
        } elseif (is_scalar($input)) {
            $year = (int) date('Y', strtotime((string) $input));
        } elseif ($input instanceof DateTimeInterface) {
            $year = (int) $input->format('Y');
        }

        if ($year === null) {
            return false;
        }

        return (bool) date('L', strtotime(sprintf('%d-02-29', $year)));
    }
}
