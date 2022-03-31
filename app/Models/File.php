<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class File extends Model
{
    use HasFactory;
    protected $table="blogs";
    protected $fillable = [
        'title', 'content','start_date','end_date','image','addedBy'
    ];
    public $timestamps=false;   //   لكن الافضل اسيبهم فى الداتابيز ونع الداتا يكون time stamp تلغي 2 columes created at updated at
}
