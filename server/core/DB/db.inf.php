<?php

interface db_func{
	
	/**
	 * @return:成功返回数组，失败时返回false
	 */
	public function select($sql);
	/**
	 * @return:运行Sql语句，不返回结果集
	 */
	public function exec($sql);
	/*
	 * 返回数据库操作句柄
	 */
	public function getHandler();
	
}

?>