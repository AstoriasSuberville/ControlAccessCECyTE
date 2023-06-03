<?php

class Session
{
    private const FLASH_INDENTIFIER = 'private_flash';
    private const USER_INDETIFIER = 'private_user_id';

    public static function exists(): bool
    {
        return isset($_SESSION[self::USER_INDETIFIER]);
    }

    public static function start($store, $callback = null, $messages = [])
    {
        $_SESSION[self::USER_INDETIFIER] = $store;
        if (!empty($messages)) {
            self::withMessage($messages);
        }
        self::verify_method($callback);
    }

    public static function destroy($callback = null)
    {
        unset($_SESSION[self::USER_INDETIFIER]);
        self::verify_method($callback);
    }

    public static function in($key): bool
    {
        $flashMessages = isset($_SESSION[self::FLASH_INDENTIFIER]) ? $_SESSION[self::FLASH_INDENTIFIER] : array();
        return array_key_exists($key, $flashMessages);
    }

    public static function withMessage($data, $callback = null)
    {
        $_SESSION[self::FLASH_INDENTIFIER] = $data;
        self::verify_method($callback);
    }

    public static function get($key)
    {
        if (isset($_SESSION[self::FLASH_INDENTIFIER][$key])) {
            $value = $_SESSION[self::FLASH_INDENTIFIER][$key];
            unset($_SESSION[self::FLASH_INDENTIFIER][$key]);
            return $value;
        }
        return null;
    }

    private static function verify_method($callback)
    {
        if (!is_null($callback)) {
            $callback();
        }
    }
}
