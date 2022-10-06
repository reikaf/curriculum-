<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Claim extends Model
{
    use HasFactory;
    use SoftDeletes;

    /**
    * @var array
    */
    protected $fillable = ['billingName','billingName_kana', 'address','phoneNumber','department','name','name_kana','about_id']; // 追記

    public function about() {
        return $this->belongsTo(About::class);
    }

    /**
     * @var array
     */
    protected $dates = ['updated_at']; // 追記
}
