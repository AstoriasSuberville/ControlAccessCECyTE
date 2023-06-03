<?php
class Hash
{
    private const COST = 16;

    public static function make($pass): string
    {
        return password_hash($pass, PASSWORD_BCRYPT, ['cost' => self::COST]);
    }

    public static function verify($pass, $hash): bool
    {
        return password_verify($pass, $hash);
    }
}
