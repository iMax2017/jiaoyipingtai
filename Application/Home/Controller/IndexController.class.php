<?php
namespace Home\Controller;
use Think\Controller;
class IndexController extends Controller {
    public function index(){//正常账号界面
        if(session('?id')){
            $this->islogin = 1;
            $this->id = $_SESSION['id'];
        }else{
            $this->islogin = 2;
        }
        $noticeModel = D('Notice');
        $notice = $noticeModel->queryNotice();
        $this->assign(notice,$notice['noticetext']);
        $this->display('index');
    }
    public function admin(){//管理员界面\
    if($_SESSION['admin'] == 0){
       $this->display('index');
    }else{
        $this->display('admin');
    }
    }
}