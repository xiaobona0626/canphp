<?php

/**
 * demo模型
 */

namespace app\main\model;

class EdailiModel extends \app\base\model\BaseModel {

	public function __construct()
	{
		parent::__construct();
	}

	/**
	 * 设置表
	 * @var string
	 */
	protected $table = 'company';

	/**
	 * 获取标题
	 * @return string
	 */
	public function getTitle(){
		return '默认首页';
	}

	/**
	 * 获取欢迎语句
	 * @return string
	 */
	public function getHello()
	{
		return 'Hello, 欢迎使用CPAPP';
	}

	public function test(){
		return '';
	}

}