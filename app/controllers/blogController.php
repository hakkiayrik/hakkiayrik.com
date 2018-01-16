<?php

class blogController extends controller
{
    public function indexAction()
    {
        $blog_model = $this->model('blog'); // app/models/blog.php çağırır
        $this->render('blog/blog.php'); // app/views/blog/post.php çağırır
    }
}