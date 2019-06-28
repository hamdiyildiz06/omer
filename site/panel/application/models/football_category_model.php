<?php

class football_category_model extends HY_Model
{

    public function __construct()
    {
        parent::__construct();
        $this->tableName = "football_categories";
    }

}
