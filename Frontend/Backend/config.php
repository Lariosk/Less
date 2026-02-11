<?php

// Cargar configuración
$config = require_once __DIR__ . '/config/app.php';

// Acceder a valores
$appName = $config['app_name'];
$dbHost = $config['database']['host'];
$jwtSecret = $config['jwt']['secret'];

// O crear una clase helper
class Config {
    private static $config;
    
    public static function get($key, $default = null) {
        if (!self::$config) {
            self::$config = require __DIR__ . '/config/app.php';
        }
        
        $keys = explode('.', $key);
        $value = self::$config;
        
        foreach ($keys as $k) {
            if (!isset($value[$k])) {
                return $default;
            }
            $value = $value[$k];
        }
        
        return $value;
    }
}

// Usar así:
$dbHost = Config::get('database.host');
$jwtSecret = Config::get('jwt.secret');