<?php
class Hash
{
    public static function make($pass): string
    {
        return password_hash($pass, PASSWORD_BCRYPT);
    }

    public static function verify($pass, $hash): bool
    {
        return password_verify($pass, $hash);
    }
}
