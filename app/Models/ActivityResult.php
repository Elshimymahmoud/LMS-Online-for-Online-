<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ActivityResult extends Model
{
    //
    protected $table = 'activity_results';

    protected $fillable = ['group_activity_id', 'user_id', 'group_id', 'answers', 'file', 'result', 'plagiarism_degree'];

    public function activity(){
        return $this->belongsTo(GroupActivity::class,'group_activity_id','id');
    }

    public function user(){
        return $this->belongsTo('App\Models\Auth\User');
    }

    public function group(){
        return $this->belongsTo(CourseGroup::class,'group_id','id');
    }

}
