<?php
class users extends base
{
    protected $tblName = "users";
    protected $idField = "id_user";
    public function login($name, $password)
    {
        $name = $this->container["database"]->escape($name);
        $ret = $this->container["database"]->queryAndFetch("select * from $this->tblName where username = '$name' and active = 1");
        if(empty($ret))
            return false;
        else
        {
            $usr = $ret[0];
            if($usr["password"] == crypt($password, $usr["password"]))
            {
                unset($usr["password"]);
                $this->container["user"] = $usr;
                $this->container["persistent"]["user_logged"] = $usr["id_user"];
                return true;
            }
            return false;
        }
    }
    public function logout()
    {
        $this->container["user"] = false;
        $this->container["persistent"]["user_logged"] = false;
    }
    public function register($name, $passwd, $passwd2)
    {
        $error = false;
        if($passwd != $passwd2)
            return "Passwords don´t match!";
        $count = (int) $this->count();
        if($count === 0)
        {
            $active = "1";
        }
        else
        {
            $active = "0";
        }
        $name = $this->container["database"]->escape($name);
        $res = $this->container["database"]->query("insert into $this->tblName set username = '$name', password='".crypt($passwd)."', active = $active");
        if($res === TRUE)
            return $error;
        return "Username already exists!";
    }
    public function toggleActive($id_user)
    {
        $id_user = (int) $id_user;
        return $this->container["database"]->query("update $this->tblName set active = ABS(active-1) where $this->idField = $id_user");
    }


}
