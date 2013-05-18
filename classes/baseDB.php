<?php
abstract class baseDB
{
    protected $conn;
    const ASSOC = "ASSOC";
    const NUMERIC = "NUMERIC";
    abstract function __construct($host, $user, $passwd, $db = NULL);
    abstract public function query($query);
    abstract public function fetch($res, $mode = self::ASSOC);
    abstract public function queryAndFetch($query, $mode = self::ASSOC);
}

