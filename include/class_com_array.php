<?php
class cArray
{
	private $arr;
	
	function add($key, $value)
	{
		if(!is_string($key)) return 1;
		if(isset($this->$arr[$key])) return 1;
		$this->$arr[$key] = $value;
		return 0;
	}
	
	function set($key, $value)
	{
		if(!is_string($key)) return 1;
		if(!isset($this->$arr[$key])) return 1;
		$this->$arr[$key] = $value;
		return 0;
	}
	
	function del($key)
	{
		if(!is_string($key)) return 1;
		if(!isset($this->$arr[$key])) return 1;
		unset($this->$arr[$key]);
		return 0;
	}
	
	function clear()
	{
		$count = 0;
		foreach ($this->$arr as $i => $value) {
			unset($this->$arr[$i]);
			$count ++;
		}
		return count;
	}
	
	function cat($src)
	{
		if(!is_array($src)) return 1;
		$this->$arr = array_merge($this->$arr, $src);
		return $this->$arr;
	}
	
	function get()
	{
		return $this->$arr;
	}
	
	function getKeys()
	{
		$keys = "";
		foreach ($this->$arr as $i => $value) {
			$keys[]=$i;
		}
		return $keys;
	}
}
?>