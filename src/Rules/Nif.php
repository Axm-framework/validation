<?php

declare(strict_types=1);

namespace Axm\Validation\Rules;

use function array_pop;
use function array_sum;
use function is_numeric;
use function is_string;
use function mb_substr;
use function preg_match;
use function str_split;

/*
* Class Nif

 * (c) Juan Cristobal <juancristobalgd1@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE file
 * that was distributed with this source code.
 * @author  Juan Cristobal <juancristobalgd1@gmail.com>
 * @package Axm\Validation\Rules
 */

final class Nif
{
    /**
     * {@inheritDoc}
     */
    public function validate($input): bool
    {
        if (!is_string($input)) {
            return false;
        }

        if (preg_match('/^(\d{8})([A-Z])$/', $input, $matches)) {
            return $this->validateDni((int) $matches[1], $matches[2]);
        }

        if (preg_match('/^([KLMXYZ])(\d{7})([A-Z])$/', $input, $matches)) {
            return $this->validateNie($matches[1], $matches[2], $matches[3]);
        }

        if (preg_match('/^([A-HJNP-SUVW])(\d{7})([0-9A-Z])$/', $input, $matches)) {
            return $this->validateCif($matches[2], $matches[3]);
        }

        return false;
    }



    private function validateDni(int $number, string $control): bool
    {
        return mb_substr('TRWAGMYFPDXBNJZSQVHLCKE', $number % 23, 1) === $control;
    }



    private function validateNie(string $prefix, string $number, string $control): bool
    {
        if ($prefix === 'Y') {
            return $this->validateDni((int) ('1' . $number), $control);
        }

        if ($prefix === 'Z') {
            return $this->validateDni((int) ('2' . $number), $control);
        }

        return $this->validateDni((int) $number, $control);
    }



    private function validateCif(string $number, string $control): bool
    {
        $code = 0;
        $position = 1;
        /** @var int $digit */
        foreach (str_split($number) as $digit) {
            $increaser = $digit;
            if ($position % 2 !== 0) {
                $increaser = array_sum(str_split((string) ($digit * 2)));
            }

            $code += $increaser;
            ++$position;
        }

        $digits = str_split((string) $code);
        $lastDigit = (int) array_pop($digits);
        $key = $lastDigit === 0 ? 0 : 10 - $lastDigit;

        if (is_numeric($control)) {
            return (int) $key === (int) $control;
        }

        return mb_substr('JABCDEFGHI', $key % 10, 1) === $control;
    }
}
