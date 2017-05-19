<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    protected $fillable = [
        'name','description', 'state'
    ];

    protected $guarded = [
        'id', 'user_id',
    ];

    public function user(){
        return $this->belongsTo('App\User');
    }
}
