<?php

class model
{
    /**
     * Veritabanını nesnesini tutar
     * @var void
     */
    public $db;

    /**
     * Veritabanı nesnesini oluşturur
     */
    public function __construct()
    {
        $this->db = new PDO(DB_DSN, DB_USR, DB_PWD);
    }

    /**
     * Tek satırlık veri döndüren sorgu çalıştırır
     * @param string $query SQL sorgusu
     * @param array $params varsa parametreler
     * @return array
     */
    public function fetch($query, array $params = [])
    {
        $sth = $this->db->prepare($query);
        $sth->execute($params);
        return $sth->fetch();
    }

    /**
     * Birden fazla satır döndüren sorgu çalıştırır
     * @param string $query SQL sorgusu
     * @param array $params varsa parametreler
     * @return array
     */
    public function fetchAll($query, array $params = [])
    {
        $sth = $this->db->prepare($query);
        $sth->execute($params);
        return $sth->fetchAll();
    }

    /**
     * Sorgu çalıştırır
     * @param string $query SQL sorgusu
     * @param array $params varsa parametreler
     * @return array
     */
    public function query($query, array $params = [])
    {
        $sth = $this->db->prepare($query);
        return $sth->execute($params);
    }

    /**
     * Gelen parametreler doğrultusunda yeni kayıt oluşturu
     * @param array $table string
     */
    public function insert($table, array $params)
    {
        /* Gelen $params dizisinin key değerlerini alıyoruz */
        $arrayKeys = array_keys($params);
        $renameKeys = array();
        /* Key değerleri sorgu içinde tablo alan adı olarak kullanacağımız için ':' karakterinden temizliyoruz*/
        foreach ($arrayKeys as $key){
            $renameKeys[] = str_replace(':', '', $key);
        }
        /* Burada sorgu içinde kullanabileğimiz şekilde string değeri oluşturuyoruz */
        $queryParams = "";
        for($i=0; $i < count($arrayKeys); $i++){
            if($i == count($arrayKeys)-1){
                $queryParams.= $renameKeys[$i] . "=" . $arrayKeys[$i];
            } else {
                $queryParams.= $renameKeys[$i] . "=" . $arrayKeys[$i] . ", ";
            }
        }

        $query = "INSERT INTO " . $table . " SET " . $queryParams;

        return $this->query($query, $params);
    }

    /**
     * Gelen parametreler doğrultusunda yeni kayıt oluşturu
     * $table string @param array @where array $where_type string
     */
    public function update($table, array $params, array $where, $where_type)
    {
        /* Gelen $params dizisinin key değerlerini alıyoruz */
        $arrayKeys = array_keys($params);
        $whereKeys = array_keys($where);
        $renameKeys = array();
        $rename_whereKeys = array();
        /* Key değerleri sorgu içinde tablo alan adı olarak kullanacağımız için ':' karakterinden temizliyoruz*/
        foreach ($arrayKeys as $key){
            $renameKeys[] = str_replace(':', '', $key);
        }

        /* Burada sorgu içinde kullanabileğimiz şekilde string değeri oluşturuyoruz */
        $queryParams = "";
        for($i=0; $i < count($arrayKeys); $i++){
            if($i == count($arrayKeys)-1){
                $queryParams.= $renameKeys[$i] . "=" . $arrayKeys[$i];
            } else {
                $queryParams.= $renameKeys[$i] . "=" . $arrayKeys[$i] . ", ";
            }
        }

        foreach ($whereKeys as $key){
            $rename_whereKeys[] = str_replace(':', '', $key);
        }

        $whereParams = "";
        for($i=0; $i < count($whereKeys); $i++){
            if($i == count($whereKeys)-1){
                $whereParams.= $rename_whereKeys[$i] . "=" . $whereKeys[$i];
            } else {
                $whereParams.= $rename_whereKeys[$i] . "=" . $whereKeys[$i] . " " . $where_type . " ";
            }
        }

        $query = "UPDATE " . $table . " SET " . $queryParams . " WHERE " . $whereParams ;
        foreach ($where as $key => $value){
            $params[$key] = $value;
        }

        return $this->query($query, $params);
    }

    /**
     * Gelen parametreler doğrultusunda yeni kayıt oluşturu
     * $table string @where array $where_type string
     */
    public function delete($table, array $where, $where_type)
    {
        $arrayKeys = array_keys($where);
        /* Key değerleri sorgu içinde tablo alan adı olarak kullanacağımız için ':' karakterinden temizliyoruz*/
        foreach ($arrayKeys as $key){
            $renameKeys[] = str_replace(':', '', $key);
        }

        $queryParams = "";
        for($i=0; $i < count($arrayKeys); $i++){
            if($i == count($arrayKeys)-1){
                $queryParams.= $renameKeys[$i] . "=" . $arrayKeys[$i];
            } else {
                $queryParams.= $renameKeys[$i] . "=" . $arrayKeys[$i] . " " . $where_type . " ";
            }
        }

        $query = "DELETE FROM " . $table . " WHERE " . $queryParams;

        return $this->query($query, $where);
    }
}