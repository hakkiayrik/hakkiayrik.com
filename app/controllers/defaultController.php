<?php

class defaultController extends controller
{
    /**
     * indexAction metodu, giriş aksiyonudur
     * eğer sorgu dizgesinde (/?url=sorgu/digesi) hiçbir şey
     * belirtilmemişse bu sınıf ve metod tetiklenir
     */
    public function indexAction()
    {
        // Sayfa başlığını belirliyoruz
        $data['title'] = 'Ana Sayfa';

        // Modelimizi değişkene aktarıyoruz
        $userModel = $this->model('user');

        // view'da kullanmak üzere posts değişkenine
        // post modelindeki bütün gönderileri aktarıyoruz
        $data['users'] = $userModel->getAll();

        // Görünüm dosyamızı yorumlatıyoruz
        return $this->render('index', $data);
    }

}
