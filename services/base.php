<?php
abstract class base
{
    protected $container;
    protected $tblName;
    protected $idField;
    function __construct(&$container)
    {
        $this->container = &$container;
        if($this->container["config"]["tablePrefix"])
            $this->tblName = $this->container["config"]["tablePrefix"].$this->tblName;
    }
    public function get($id)
    {
        $id = $this->container["database"]->escape($id);
        if($id)
        {
            $ret = $this->container["database"]->queryAndFetch("select * from $this->tblName where $this->idField = $id");
            return $ret[0];
        }
        return false;
    }
    public function count()
    {
        $ret = $this->container["database"]->queryAndFetch("select count(*) from $this->tblName", baseDB::NUMERIC);
        return $ret[0][0];
    }
    public function getAll($mode = baseDB::ASSOC)
    {
        return $this->container["database"]->queryAndFetch("select * from $this->tblName", $mode);
    }
    public function delete($id)
    {
        $id = (int) $id;
        return $this->container["database"]->query("delete from $this->tblName where $this->idField = $id");
    }
    public function insert($data)
    {
	    if(empty($data)) return false;
	    $sql = "insert into $this->tblName set ";
	    $cols = array();
	    foreach($data as $key => $value)
	    {
		    $delim = "'";
		    $col =  $this->container["database"]->escape($key)." = ";
		    if(is_int($value))
		    {
			    $delim = "";
		    }
		    elseif($value === NULL)
		    {
			    $delim = "";
			    $value = "NULL";
		    }
		    $col .= $delim.$this->container["database"]->escape($value).$delim;
		    $cols[] = $col;
	    }
	    $sql .= implode(",", $cols);
	    return $this->container["database"]->query($sql);
    }
}
