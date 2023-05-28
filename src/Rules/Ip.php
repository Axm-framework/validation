<?php

declare(strict_types=1);

namespace Axm\Validation\Rules;

/*
* Class Ip

 * (c) Juan Cristobal <juancristobalgd1@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE file
 * that was distributed with this source code.
 * @author  Juan Cristobal <juancristobalgd1@gmail.com>
 * @package Axm\Validation\Rules
 */

class Ip
{
    public function validate(string $input, string $type = 'both'): bool
    {
        if (!is_string($input)) {
            return false;
        }

        $flags = 0;
        if ($type === 'ipv4') {
            $flags = FILTER_FLAG_IPV4;
        } elseif ($type === 'ipv6') {
            $flags = FILTER_FLAG_IPV6;
        }

        return filter_var($input, FILTER_VALIDATE_IP, ['flags' => $flags]) !== false;
    }
}
