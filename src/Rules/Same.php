<?php

declare(strict_types=1);

namespace Axm\Validation\Rules;

/*
* Class Alpha

 * (c) Juan Cristobal <juancristobalgd1@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE file
 * that was distributed with this source code.
 * @author  Juan Cristobal <juancristobalgd1@gmail.com>
 * @package Axm\Validation\Rules
 */

class Same
{

    public function validate($value, $parameters): bool
    {

        $left  = $value;
        $rigth = $parameters;

        return $left == $rigth;
    }
}
