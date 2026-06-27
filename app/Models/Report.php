<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    protected $fillable = ['user_id', 'category', 'title', 'description', 'status', 'date_incident', 'contact',];

    public function user()
    {
        return $this->belongsTo(User::class); //репорт принадлежит юзеру
    }
    public function category()
    {

        return $this->belongsTo(Category::class); //у заявки одна категория
    }
}
