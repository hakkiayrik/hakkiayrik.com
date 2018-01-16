<?php

class userController extends controller
{
    public function indexAction()
    {
        $blog_model = $this->model('user'); // app/models/blog.php çağırır
        $this->render('user/user.php'); // app/views/blog/post.php çağırır
    }
    public function getAction($id)
    {
        $user_model = $this->model('user');
        $users = $user_model->fetch('SELECT * FROM ha_users WHERE id=?', [$id]);
        //var_dump($users);
        //$this->render('user/user.php'); // app/views/blog/post.php çağırır
    }
}