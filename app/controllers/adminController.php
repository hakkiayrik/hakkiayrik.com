<?php

class adminController extends controller
{

    public function __construct()
    {
        // Oturumu başlatalım
        session_start();
    }

    public function indexAction()
    {
        // Admin giriş yapmış mı kontrol ediyoruz
        $this->checkLogin();

        // View'da kullanabilmek için $title değişkeni oluşturuyoruz
        $data['title'] = 'Blog Yönetimi';

        // views/admin/index.php sayfasını yorumluyoruz
        return $this->render('admin/index', $data);
    }

    public function loginAction()
    {
        // Eğer GET isteği ile sayfaya geldiyse kullanıcı
        if ($_SERVER['REQUEST_METHOD'] === 'GET') {

            $data['title'] = 'Giriş';

            // views/admin/login.php görünümünü yorumluyoruz
            return $this->render('admin/login', $data);

            // Eğer POST isteğiyle yani giriş formunun yönlendirmesi sonucu
            // kullanıcı sayfaya geldiyse:
        } elseif ($_SERVER['REQUEST_METHOD'] === 'POST') {

            // Kullanıcı adı ve şifre doğruysa
            if ($_POST['username'] === 'admin' && $_POST['password'] === 'admin') {

                $_SESSION['loggedIn'] = true;

                // Yönlendir
                return $this->redirect($this->url('admin/index'));

                // Kullanıcı adı ve şifre doğru değilse
            } else {
                $data['title'] = 'Giriş';
                $data['message'] = 'Kullanıcı adı ya da şifre hatalı';
                return $this->render('admin/login', $data);
            }

        }
    }

    private function checkLogin()
    {
        if (!isset($_SESSION['loggedIn'])) {
            return $this->redirect($this->url('admin/login'));
        }
    }

    public function logoutAction()
    {
        // Oturumu kaldır/sil/yok et!
        session_destroy();
        return $this->redirect($this->url('default/index'));
    }

    public function dashboardAction()
    {
        $this->checkLogin();

        $data['title'] = 'Dashboard';
        $data['content_file'] = 'dashboard.php';

        return $this->render('admin/index', $data);
    }

    public function userAction()
    {
        $this->checkLogin();

        $userModel = $this->model('user');

        $data['title'] = 'Kullanıcılar';
        $data['content_file'] = 'users.php';
        $data['users'] = $userModel->getAll();

        return $this->render('admin/index', $data);
    }

    public function updateuserAction($id,$statu){
        $this->checkLogin();
        $id = intval($id);
        $statu = intval($statu);

        if (!is_numeric($id) || !is_numeric($statu)) {
            Tools::log('controller-adminController-updateuserAction: Hatalı veri gönderimi');
            exit();
        }
        $userModel = $this->model('user');
        $return = $userModel->setStatus($id,$statu);

        if ($return){
            $data['title'] = 'Kullanıcılar';
            $data['content_file'] = 'users.php';
            $data['users'] = $userModel->getAll();

            return $this->render('admin/index', $data);
        } else {
            exit;
        }
    }

    public function errorlogAction(){
        $this->checkLogin();

        $data['title'] = 'Error Log';
        $data['content_file'] = 'errorlog.php';

        return $this->render('admin/index', $data);
    }

    public function postsAction(){
        $this->checkLogin();

        $postModel = $this->model('post');

        $data['title'] = 'Yazılarım';
        $data['content_file'] = 'posts.php';
        $posts = $postModel->getAll();
        $data['posts'] = $postModel->convertIdToName($posts);

        return $this->render('admin/index', $data);
    }

    public function newpostAction()
    {
        $this->checkLogin();

        $userModel = $this->model('user');
        $categoryModel = $this->model('category');

        $data['title'] = 'Yeni Yazı';
        $data['content_file'] = 'newpost.php';
        $data['categories'] = $categoryModel->getAll();

        return $this->render('admin/index', $data);
    }

    public function newpostformAction(){
        $this->checkLogin();

        $post = $_POST['data'];

        if( !isset($post['save_btn']) ){
            Tools::log('adminController-newpostformAction=> Hatalı form aktarımı');
            exit;
        }
        if(
            (!isset($post['title']) || $post['title'] == '') &&
            (!isset($post['content']) || $post['content'] == '') &&
            (!isset($post['user_id']) || $post['user_id'] == '') &&
            (!isset($post['cat_ids']) || $post['cat_ids'] == '')
          )
        {
            Tools::log('adminController-newpostformAction=> Hatalı form değeri gönderimi');
            exit;
        }
        if(!filter_var($post['user_id'],FILTER_VALIDATE_INT)){
            Tools::log('adminController-newpostformAction=> Hatalı kullanıcı id si');
            exit;
        }
        $post['title'] = trim(strip_tags($post['title']));

        $postModel = $this->model('post');
        $post['tag_values'] = explode(',', $post['tag_values']);
        $post['tag_ids'] = "";
        $count = 0;
        foreach ( $post['tag_values'] as $tag ){
            if( $postModel->getTagByName($tag) ){
                $tag = $postModel->getTagByName($tag);
                if($count == count($post['tag_values'])-1)
                    $post['tag_ids'].= $tag['id'];
                else
                    $post['tag_ids'].= $tag['id'].',';

            } else {
                $tag = $postModel->addNewTag($tag);
                if($count == count($post['tag_values'])-1)
                    $post['tag_ids'].= $tag['id'];
                else
                    $post['tag_ids'].= $tag['id'].',';
            }
            $count++;
        }


        $postModel->addNewPost($post);

        $data['title'] = 'Yazılar';
        $data['content_file'] = 'posts.php';
        $posts = $postModel->getAll();
        $data['posts'] = $postModel->convertIdToName($posts);

        return $this->render('admin/index',$data);

    }

    public function updatepostAction($id,$statu){
        $this->checkLogin();
        $id = intval($id);
        $statu = intval($statu);

        if (!is_numeric($id) || !is_numeric($statu)) {
            Tools::log('controller-adminController-updateuserAction: Hatalı veri gönderimi');
            exit();
        }
        $postModel = $this->model('post');
        $return = $postModel->setStatus($id,$statu);

        if ($return){
            $data['title'] = 'Yazılar';
            $data['content_file'] = 'posts.php';
            $posts = $postModel->getAll();
            $data['posts'] = $postModel->convertIdToName($posts);

            return $this->render('admin/index', $data);
        } else {
            exit;
        }
    }
}