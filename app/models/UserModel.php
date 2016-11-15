<?php
class UserModel extends Model{
	public function add(){
		$data = array(
			"permission" => 1,
			"account" => '666687'
		);
		$row = $this->data($data)->create();
	}
	public function save(){
		$data = array(
			'permission' => 1
		);
		$row = $this->where("account='666666'")->data($data)->update();
	}
}