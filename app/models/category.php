<?php

class category extends model
{
    public function getAll()
    {
        return $this->fetchAll("SELECT * FROM ha_categories");
    }
    public function getCatById($id)
    {
        return $this->fetch('SELECT * FROM ha_categories WHERE id = ?', array($id));
    }
}