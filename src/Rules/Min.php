<?php

declare(strict_types=1);

namespace Axm\Validation\Rules;

use DateTime;

/*
* Class Min

 * (c) Juan Cristobal <juancristobalgd1@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE file
 * that was distributed with this source code.
 * @author  Juan Cristobal <juancristobalgd1@gmail.com>
 * @package Axm\Validation\Rules
 */

class Min
{
    public function validate($value, array $parameters): bool
    {

        $isValid = false;

        foreach ($parameters as $parameter) {

            if (is_numeric($value)) {
                $isValid = $this->validateNumeric($value, $parameter);
            } elseif (is_string($value)) {
                $isValid = $this->validateString($value, $parameter);
            } elseif (is_file($value)) {
                $isValid = $this->validateFileSize($value, $parameter);
            }

            if ($isValid) {
                return true;
            }
        }

        return false;
    }

    private function validateNumeric($value, $parameter): bool
    {
        return $value >= floatval($parameter);
    }

    private function validateString($value, $parameter): bool
    {
        return  mb_strlen($value) >= floatval($parameter);
    }

    private function validateFileSize($value, $parameter): bool
    {
        $size    = filesize($value);
        $maxSize = $parameter;

        if ($size >= floatval($maxSize)) {
            return true;
        }

        return false;
    }
}
