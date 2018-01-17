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
            return $this->update('ha_users', [':status' => $statu], [':id' => $id], 'OR');
        } else {
            Tools::log('model-user-setStatus: Hatalı veri gönderimi');
            exit;
        }
    }
}