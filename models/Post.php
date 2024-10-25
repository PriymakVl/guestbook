<?php
namespace App\Models;

class Post extends Model
{

	public static function getTable()
	{
		return 'posts';
	}

	public static function add($data) 
	{
		$data['date'] = time();
		return self::table()->create()->set($data)->save();
	}

	public static function validate($data)
	{
		$v = new \Valitron\Validator($data);
        $v->rule('required', ['author', 'text'])->message('empty_{field}');
        $v->labels(['author' => 'author', 'text' => 'text']);
        $result = $v->validate();
		if ($result) return false;
		foreach ($v->errors() as $field => $errors) {
			return $errors[0];
		}
	}

}