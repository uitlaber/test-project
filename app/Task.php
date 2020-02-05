<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
  protected $dates = ['deadline_time'];

  public function status(){
      return $this->belongsTo(TaskStatus::class);
  }

  public function user(){
      return $this->belongsTo(User::class);
  }

  public function developer(){
      return $this->belongsTo(User::class, 'developer_id');
  }

  public function scopeFilter($query, $params){

    if(isset($params['name']) && !is_null($params['name'])){
        $query->where('name','like', "%{$params['name']}%");
    }

    if(isset($params['user']) && count($params['user'])){
        $query->whereIn('user_id', $params['user']);
    }

    if(isset($params['developer']) && count($params['developer'])){
        $query->whereIn('developer_id', $params['developer']);
    }

    if(isset($params['status']) && count($params['status'])){
        $query->whereIn('status_id', $params['status']);
    }

    if(isset($params['deadline_time']) && !is_null($params['deadline_time']['from']) && !is_null($params['deadline_time']['to'])){
        $from = date($params['deadline_time']['from']);
        $to = date($params['deadline_time']['to']);
        $query->whereBetween('deadline_time', [$from, $to]);
    }

    return $query->get();

  }
}
