<?php
class servers extends base
{
    protected $tblName = "servers";
    protected $idField = "id_server";
    public function login($name, $password)
    {
        $name = $this->container["database"]->escape($name);
        $ret = $this->container["database"]->queryAndFetch("select * from $this->tblName where name = '$name' and active = 1");
        if(empty($ret))
            return false;
        else
        {
            $srv = $ret[0];
            if($srv["password"] == crypt($password, $srv["password"]))
            {
                return $srv["id_server"];
            }
            return false;
        }
    }
    public function register($name, $passwd, $passwd2)
    {
        $error = false;
        if($passwd != $passwd2)
            return "Passwords don´t match!";
        $count = (int) $this->count();
        $name = $this->container["database"]->escape($name);
        $res = $this->container["database"]->query("insert into $this->tblName set name = '$name', password='".crypt($passwd)."', active = 0");
        if($res === TRUE)
            return $error;
        return "servername already exists!";
    }
    public function toggleActive($id_server)
    {
        $id_server = (int) $id_server;
        return $this->container["database"]->query("update $this->tblName set active = ABS(active-1) where $this->idField = $id_server");
    }


}
