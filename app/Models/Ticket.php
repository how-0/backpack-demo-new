<?php

namespace App\Models;

use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    use CrudTrait;
    protected $fillable = ['created_by', 'name', 'gender', 'inquiry', 'status'];

    public function creator(){
        return $this->belongsTo(User::class, 'name', 'id');
    }
}
