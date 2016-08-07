<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Vote extends Model
{
    //

	protected $fillable = [
		'title',
		'image',
		'publish_at',
		'due_date',
		'created_by',
		'updated_by',
	];

	/**
	 * Get the history for the vote.
	 */
	public function histories()
	{
		return $this->hasMany('App\VoteHistory');
	}
}
