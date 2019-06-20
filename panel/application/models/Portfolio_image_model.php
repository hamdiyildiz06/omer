<?php


class Portfolio_image_model extends HY_Model
{

    public function __construct()
    {
        parent::__construct();
        $this->tableName = "portfolio_images";
    }

}
