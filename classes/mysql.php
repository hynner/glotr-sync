<?php
class mysql extends baseDB
{
    function __construct($host,$user, $passwd, $db = NULL)
    {
        $this->conn = mysql_connect($host, $user, $passwd);
        if($db !== NULL)
            mysql_select_db($db,$this->conn);
    }
    public function query($query)
    {
        return mysql_query($query, $this->conn);
    }
    public function fetch($res, $mode = self::ASSOC)
    {
        if($mode === self::NUMERIC)
            return mysql_fetch_array($res, MYSQL_NUM);
        elseif($mode === self::ASSOC)
            return mysql_fetch_array($res, MYSQL_ASSOC);
        return false;

    }
    public function queryAndFetch($query, $mode = self::ASSOC)
    {
        $res = $this->query($query);
        $ret = array();
	if($res !== FALSE)
	{
		while($r = $this->fetch($res, $mode))
		{
		    $ret[] = $r;
		}
	}
        return $ret;
    }
    public function escape($arg)
    {
        return mysql_real_escape_string($arg);
    }
}
