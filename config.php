<?php
/**
 * Файл конфигурации
 *
 * PHP version 5
 *
 * @package
 * @author   Eugene Kurbatov <ekur@i-loto.ru>
 */

return array(
    "database" => array(
        "adapter" => "pdo_mysql",
        "params"  => array(
            "host"     => "localhost",
            "username" => "root",
            "password" => "toor",
            "dbname"   => "paw_temp",
            "driver_options" => array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8")
        )
    ),
    "entityTemplate" => "templates/class.tpl",

    "fieldTemplate" => "templates/field.tpl"
);
