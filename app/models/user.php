<?php

class user extends model
{
    public function getAll()
    {
        return $this->fetchAll('SELECT * FROM ha_users');
    }

    public function setStatus($id,$statu)
    {
        if( filter_var($statu, FILTER_VALIDATE_INT) === 0 || filter_var($statu, FILTER_VALIDATE_INT) ){
            $query = "UPDATE ha_users SET status=? WHERE id=?";
            return $this->query($query,[$statu,$id]);
        } else {
            Tools::log('model-user-setStatus: Hatalı veri gönderimi');
            exit;
        }
    }
}