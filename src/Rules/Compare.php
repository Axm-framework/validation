<?php

declare(strict_types=1);

namespace Axm\Validation\Rules;

use Axm\Validation\Validator;

/*
* Class Compare

 * (c) Juan Cristobal <juancristobalgd1@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE file
 * that was distributed with this source code.
 * @author  Juan Cristobal <juancristobalgd1@gmail.com>
 * @package Axm\Validation\Rules
 */

class Compare extends Validator
{

    public function validate($value, $parameters): bool
    {
        $left     = floatval($value);
        $right    = floatval($parameters['value']);
        $operator = $parameters['operator'];

        if (!in_array($operator, ['>', '<', '>=', '<=', '==', '===', '!=', '!=='])) {
            throw new \InvalidArgumentException('Invalid operator');
        }

        switch ($operator) {
            case '>':
                return $left > $right;
            case '<':
                return $left < $right;
            case '>=':
                return $left >= $right;
            case '<=':
                return $left <= $right;
            case '==':
                return $left == $right;
            case '===':
                return $left === $right;
            case '!=':
                return $left != $right;
            case '!==':
                return $left !== $right;
        }
    }
}
