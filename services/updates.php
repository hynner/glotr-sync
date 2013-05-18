<?php
class updates extends base
{
    protected $tblName = "updates";
    protected $idField = "id_update";

    public function getUpdatesForServer($last_id, $id_server, $limit)
    {
	    $last_id = $this->container["database"]->escape($last_id);
	    $id_server = $this->container["database"]->escape($id_server);
	    $limit = $this->container["database"]->escape($limit);
	    return $this->container["database"]
		    ->queryAndFetch("select * from $this->tblName where $this->idField > $last_id and (id_server IS NULL OR id_server != $id_server) limit $limit");
    }
}
