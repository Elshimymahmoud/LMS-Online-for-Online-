<?php

namespace App\Models;


use Illuminate\Support\Facades\File;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CertificateTemplates extends Model
{
    use SoftDeletes;

    protected $table = 'certificate_templates';
    protected $fillable = ['title', 'title_ar', 'content','type','bg_image', 'qr_width', 'qr_height', 'status'];


    public function types()
    {
        return $this->belongsTo(Type::class, 'type', 'id');
    }

}
