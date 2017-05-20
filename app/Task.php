<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    protected $fillable = [
        'user_id', 'name','description', 'state'
    ];

    protected $guarded = [
        'id',
    ];

    public function user(){
        return $this->belongsTo('App\User');
    }
}
