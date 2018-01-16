<?php

class post extends model
{
    public function getAll()
    {
       return $this->fetchAll("SELECT * FROM ha_posts");
    }
    public function addNewPost($post)
    {
        $data['user_id'] = intval($post['user_id']);
        $data['title'] = $post['title'];
        $data['content'] = $post['content'];
        $data['tag_ids'] = $post['tag_ids'];
        $catIds = "";
        for ($i = 0; $i <= count($post['cat_ids'])-1; $i++){
            if( $i == count($post['cat_ids'])-1 ){
                $catIds.= $post['cat_ids'][$i];
            }
            else {
                $catIds.= $post['cat_ids'][$i].',';
            }

        }
        $data['cat_ids'] = $catIds;
        try{
            $return = $this->query('INSERT INTO ha_posts SET 
                                          user_id = :user_id, 
                                          title = :title, 
                                          content = :content, 
                                          status = 1,
                                          like_count = 0,
                                          dislike_count = 0,
                                          tag_ids = :tag_ids,
                                          cat_ids = :cat_ids;', $data );
            if( $return ){
                return true;
            } else {
                Tools::log('model-post-addNewPost=> Post kaydedilemedi');
                return false;
            }
        } catch (Exception $e){
            Tools::log('model-post-addNewPost=> '.$e->getMessage());
            exit;
        }


    }
    public function getTagByName($value)
    {
        return $this->fetch('SELECT * FROM ha_tags WHERE name = ?', array($value));
    }
    public function getTagById($id)
    {
        return $this->fetch('SELECT * FROM ha_tags WHERE id = ?', array($id));
    }
    public function addNewTag($value){
        $this->query('INSERT INTO ha_tags SET name = ?;', array($value));
        return $this->fetch('SELECT id FROM ha_tags WHERE name = ?', array($value));
    }
    public function convertIdToName($data)
    {
        /* etiket idlerini ve kategori idlerini etiket ve kategori isimlerine çeviriyoruz */
        $count = 0;
        foreach ( $data as $post ){
            $tagNames = "";
            $catNames = "";
            $tagIds = explode(',', $post['tag_ids']);
            $catIds = explode(',', $post['cat_ids']);

            for ( $i = 0; $i <= count($tagIds)-1; $i++ ){
                if ( $i == count($tagIds)-1 ){
                    $tag = $this->getTagById($tagIds[$i]);
                    $tagNames.= $tag['name'];
                } else {
                    $tag = $this->getTagById($tagIds[$i]);
                    $tagNames.= $tag['name'] . ',';
                }
            }
            $data[$count]['tag_ids'] = $tagNames;

            for ( $i = 0; $i <= count($catIds)-1; $i++ ){
                if ( $i == count($catIds)-1 ){
                    $cat = $this->getTagById($catIds[$i]);
                    $catNames.= $cat['name'];
                } else {
                    $cat = $this->getTagById($catIds[$i]);
                    $catNames.= $cat['name'] . ',';
                }
            }
            $data[$count]['cat_ids'] = $catNames;
        $count ++;
        }

        return $data;
    }
    public function setStatus($id,$statu)
    {
        if( filter_var($statu, FILTER_VALIDATE_INT) === 0 || filter_var($statu, FILTER_VALIDATE_INT) ){
            $query = "UPDATE ha_posts SET status=? WHERE id=?";
            return $this->query($query,[$statu,$id]);
        } else {
            Tools::log('model-post-setStatus: Hatalı veri gönderimi');
            exit;
        }
    }

}