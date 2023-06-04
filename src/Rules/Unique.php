<?php

declare(strict_types=1);

namespace Axm\Validation\Rules;

use Axm\Exception\AxmException;

/*
* Class EmailValidator

 * (c) Juan Cristobal <juancristobalgd1@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE file
 * that was distributed with this source code.
 * @author  Juan Cristobal <juancristobalgd1@gmail.com>
 * @package Axm\Validation\Rules
 */

class Unique
{

    public function validate($value, $parameters): bool
    {
        dd(
            $value,
            $parameters
        );

        if (count($input) < 3) {
            throw new AxmException('Missing required arguments');
        }

        $modelClass = 'App\\Models\\' . ucfirst($input[0]);
        if (!is_subclass_of($modelClass, 'App\\Models\\Model')) {
            throw new AxmException('Invalid model class');
        }

        $fieldName = $input[1];
        if (!is_string($fieldName) || empty(trim($fieldName))) {
            throw new AxmException('Invalid field name');
        }

        $value = $input[2];
        if (!is_string($value) || empty(trim($value))) {
            throw new AxmException('Invalid field value');
        }

        // $record = $modelClass::select()
        //     ->where("$fieldName = ?", [$value])
        //     ->first();
        $record = $modelClass::_select("$fieldName = '$value' ");
        return (!$record) ? true : false;
    }
}
