<?php
namespace App\Controllers;

use App\Models\Post;

class MainController extends BaseController 
{

    public function index()
    {
		$posts = Post::findAll();
        $this->render('main/index', ['posts' => $posts]);
    }


    public function addPost()
    {
        $error = Post::validate($_POST);
        if ($error) {
            $this->addMessage(false, $error)->home();
        }

        $_POST['date'] = time();
        $result = Post::table()->create()->set($_POST)->save();
        $this->addMessage($result, 'add')->home();
    }

}