<?php

class blog extends model
{
    public function getAll()
    {
        return $this->fetchAll('SELECT * FROM post ORDER BY created DESC');
    }
}