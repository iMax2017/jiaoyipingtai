<?php
namespace Home\Controller;
use Think\Controller;
class UserminController extends BaseController{
    public function index(){
        $this->display('register');
    }
    public function Landing(){
        if(session('?id'))
        $this->error("您已登录",U('/list'),1);
        $this->display('landing');
    }
    public function alterpwdhtml(){
        if(!session('?id'))
        $this->error("请先登录",U('/list'),1);
        $this->display('alterpwd');
    }
    public function register(){
        $flag = 1;
        $data['user'] = I('post.username');
        $data['password']  = I('post.password1');
        $data['password1'] = I('post.password2');
        $data['email'] = I('post.email');
        $data['password'] =$this->encryptPwd($data['password']);
        $data['password1'] =$this->encryptPwd($data['password1']);
        $data['verify'] = I('post.verify');
        if($data['email'] == "1191544503@qq.com"){//判断是不是注册管理员
            $data['administrator'] = 1;
        }else{
            $data['administrator'] = 0;
        }
        $userModel = D('Usermin');
        if($flag&&!$this->checkNumber($data['user'])){
            $data['error_code'] = 2002;
            $flag = false;
        }
        if($flag&&!$userModel->create($data)){
            $data['error'] = $userModel->getError();
            $data['error_code'] = 2010;
            $flag = false;
        }
        if($flag&&$userModel->isExistsUser($data['user'])){
            $data['error_code'] = 2008;
            $flag = false;
        }
        if($flag&&!$this->checkVerify($data['verify'])){
            $data['error_code'] = 2009;
            $flag = false;
        }
        if(!$flag){
            $this->assign('data',$data);
            $this->ajaxReturn($data);
        } else{
            $userModel->addUser($data);
            $_SESSION['id'] = $data['user'];
            $this->islogin = 1;
            $data['error_code'] = 1;
            $this->ajaxReturn($data);
        }
    }
    public function login(){
        $flag = true;
        $data['user'] = I('post.username');
        $data['password'] = I('post.password');
        $data['password'] =$this->encryptPwd($data['password']);
        $userModel = D('Usermin');
        if(!$userModel->isExistsUser($data['user'])){//判断用户名是否存在
            $flag= false;
            $data['error_code']= 1001;
            $this->ajaxReturn($data);
        }
        if($flag&&!$userModel->checkcorrect($data)){//若存在继续判断密码是否正确
            $flag = false;
            $data['error_code']= 1002;
            $this->ajaxReturn($data);
        }
        if($flag){
            $_SESSION['id'] = $data['user'];
            if($userModel->queryadministrator($data['user'])){//判断是不是管理员
                $_SESSION['admin'] = 1;
                //   $this->success('尊敬的管理员欢迎归来',U('/main'));
            }else{
                $_SESSION['admin'] = 0;
            }
            $this->islogin = 1;
            $data['error_code'] = 1;
            $data['session_id'] = $data['user'];
            $this->ajaxReturn($data);
        }else{
            $data['error_code']= 9999;
            $this->ajaxReturn($data);
        }
    }
    public function alterpwd(){//修改密码
        $data['user'] = $_SESSION['id'];
        $data['password'] = I('post.oldpass');
        $data['password'] = $this->encryptPwd($data['password']);
        $UserModel = D('Usermin');
        $flag = true;    
        if($UserModel->checkcorrect($data)){
            $data['password'] = I('post.newpass1');
            $data['password1'] = I('post.newpass2');
            if($data['password'] == $data['password1']){
                $data['password'] = $this->encryptPwd($data['password']);
                $UserModel->alterpwdByname($data);
                $data['error_code'] = 1;
            }
            else{
                $data['error_code'] = 1003;
            }
        }
        else{
            $data['error_code'] = 1002;   
        }
        $this->ajaxReturn($data);    
    }
    public function logout(){
        if(session('?id'))
        session('id',null);
        $_SESSION['admin'] = 0;
        $this->success('注销成功',U('/list'),0);
        
    }
    public function encryptPwd($password){
        $password = strrev($password);
        $password = sha1($password);
        for($i = 0;$i<15;$i++){
            $password = md5($password);
        }
        return $password;
    }
    public function checkNumber($number){
        $preg = '/[2][0][1][3,4,5,6,7][0,1,2][1,2,3,4,5,6,8,]\d\d[0,1,2,3,4]\d/';//学号正则
        if(!preg_match($preg,$number)){
            return false;
        }
        return true;
    }
}
?>