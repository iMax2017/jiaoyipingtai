<?php
namespace Home\Model;
use Think\Model;
class StoreModel extends BaseModel{
    public function goodsToMysql($con){
       if($this->data($con)->add()){
            return true;
        }
        return false;
    }
    public function goodsFromBy1(){
        $sql = "SELECT * FROM store";
		$data = $this->query($sql);
		return $data;
    }
    public function goodsCountBy1(){
        $data=$this->where(1)->count();
        return $data;
    }
	public function goodsFromByname($name){
		$sql = "SELECT * FROM store WHERE username = '{$name}'";
		$data = $this->query($sql);
		return $data;
	}
    public function goodsDeleteByname($id,$name){
        $sql = "delete from store where username = '{$id}' and goodsname='{$name}'";
        $this->execute($sql);
    }
}
?>