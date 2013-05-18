<?php
function plain($str)
{
    return $str;
}
function makeArgs($where)
{
    $split = explode("/", $where);
    $args = "pg=$split[0]";
    if(count($split) > 1)
    {
        for($i = 1; $i < count($split); $i++)
        {
            $args .= "&args[".($i-1)."]=".$split[$i];
        }
    }
    return $args;
}
function redirect($where)
{
    ob_clean();
    header("Location: ".makeUrl($where));
    exit();
}

function makeUrl($where, $abs = false)
{
	$ret = "";
	if($abs)
		$ret .= "http://".$_SERVER["HTTP_HOST"];
	$ret .= $_SERVER["PHP_SELF"];
	if($where != "")
		$ret .= "?".makeArgs($where);
	return $ret;
}
