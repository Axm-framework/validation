<?php

declare(strict_types=1);

namespace Axm\Validation\Rules;

use const FILTER_VALIDATE_URL;

/*
* Class Url

 * (c) Juan Cristobal <juancristobalgd1@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE file
 * that was distributed with this source code.
 * @author  Juan Cristobal <juancristobalgd1@gmail.com>
 * @package Axm\Validation\Rules
 */

class Url
{
    private array $allowedSchemes = ['http', 'https', 'ftp'];

    public function validate($input): bool
    {
        $urlParts = parse_url($input);

        if (!isset($urlParts['scheme']) || !in_array($urlParts['scheme'], $this->allowedSchemes)) {
            return false;
        }

        return filter_var($input, FILTER_VALIDATE_URL) !== false;
    }
}
