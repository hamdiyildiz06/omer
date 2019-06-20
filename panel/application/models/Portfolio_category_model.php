<?php

class Portfolio_category_model extends HY_Model
{

    public function __construct()
    {
        parent::__construct();
        $this->tableName = "portfolio_categories";
    }

}
