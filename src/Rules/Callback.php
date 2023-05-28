<?php

declare(strict_types=1);

namespace Respect\Validation\Rules;

/*
* Class Callback

 * (c) Juan Cristobal <juancristobalgd1@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE file
 * that was distributed with this source code.
 * @author  Juan Cristobal <juancristobalgd1@gmail.com>
 * @package Axm\Validation\Rules
 */

final class Callback
{

    /**
     * {@inheritDoc}
     */
    function validate($input): bool
    {
        return is_callable($input);
    }
}
