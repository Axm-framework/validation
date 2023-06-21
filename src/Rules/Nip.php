<?php

declare(strict_types=1);

namespace Axm\Validation\Rules;


use function array_map;
use function is_scalar;
use function preg_match;
use function str_split;

/*
* Class Nip

 * (c) Juan Cristobal <juancristobalgd1@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE file
 * that was distributed with this source code.
 * @author  Juan Cristobal <juancristobalgd1@gmail.com>
 * @package Axm\Validation\Rules
 */

final class Nip
{
    /**
     * Valida si el número de identificación personal (NIP) es válido.
     *
     * @param mixed $input El valor a validar.
     *
     * @return bool Devuelve true si el valor es un NIP válido; de lo contrario, devuelve false.
     */
    public function validate($input): bool
    {
        if (!is_scalar($input)) {
            return false;
        }

        $value = (string) $input;

        if (!preg_match('/^\d{10}$/', $value)) {
            return false;
        }

        $weights = [6, 5, 7, 2, 3, 4, 5, 6, 7];
        $digits = array_map('intval', str_split($value));

        $targetControlNumber = $digits[9];
        $calculateControlNumber = $this->calculateControlNumber($digits, $weights);

        return $targetControlNumber == $calculateControlNumber;
    }

    /**
     * Calcula el número de control para el NIP dado.
     *
     * @param array<int> $digits Los dígitos del NIP.
     * @param array<int> $weights Los pesos utilizados para calcular el número de control.
     *
     * @return int El número de control calculado.
     */
    private function calculateControlNumber(array $digits, array $weights): int
    {
        $controlNumber = 0;

        for ($i = 0; $i < 9; ++$i) {
            $controlNumber += $digits[$i] * $weights[$i];
        }

        return $controlNumber % 11;
    }
}
