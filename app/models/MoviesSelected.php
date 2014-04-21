<?php

class Usermovie extends Eloquent
{

	public function('usermovie')
	{
	return $this->belongsTo('User', 'user_id');
	}
}