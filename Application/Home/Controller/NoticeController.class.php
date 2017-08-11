<?php
namespace Home\Controller;
use Think\Controller;

class NoticeController extends BaseController{
    public function addNoticehtml(){
        $this->display('addNotice');
    }
    public function addNotice(){
        $data['username'] = $_SESSION['id'];
        $data['noticetext'] = I('post.notice'); 
        $NoticeModel = D('Notice');
        if(!$NoticeModel->queryNoticecount()){
               if($NoticeModel->addNotice($data)){
                   $this->success("发布成功",U('/admin'));
               }else{
                   $this->error("发布失败",U('/admin'));
               }
        }else{
            $NoticeModel->alterNotice($data);
            $this->success("发布成功",U('/admin'));
        }
    }
}