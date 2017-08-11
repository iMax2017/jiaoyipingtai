<?php
namespace Home\Controller;
use Think\Controller;
use Think\Verify;
class BaseController extends Controller{
    public function createVerify($id = 1){
        $config = array(
            'length'=>4,
            'useImage' => true,
        );
        $verify = new Verify($config);
        $verify->entry($id);
    }
    protected function checkVerify($code,$id = 1){
        $verify = new verify();
        return $verify->check($code,$id);
    }
   
}
?>