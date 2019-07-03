<?php

class Football_team_model extends HY_Model
{

    public function __construct()
    {
        parent::__construct();
        $this->tableName = "football_team";
    }

}
