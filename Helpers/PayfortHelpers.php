<?php

namespace MElaraby\Payfort\Helpers;

use Illuminate\Support\Str;

class PayfortHelpers
{
    /**
     * @param string|int|null $token
     * @return string
     */
    public static function generateTokenName(string|int|null $token = null): string
    {
        $randomString = time() . '_' . Str::random();

        if (is_null($token)) {
            return sprintf('_%s', $randomString);
        }

        return sprintf('%s_%s', $token, $randomString);
    }

    /**
     * @param string $string
     * @return string
     */
    public static function asHTML(string $string): string
    {
        return <<<HTML
                $string
                HTML;
    }
}
