<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class VoteHistory extends Model
{
    //

	protected $table = 'vote_history';

	protected $fillable = [
		'vote_id',
		'fingerprint',
		'answer',
		'user_id',
	];

	/**
 * Get the vote that owns the history.
 */
	public function vote()
	{
		return $this->belongsTo('App\Vote');
	}
}
