<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class About extends Model
{
    use HasFactory;
    use SoftDeletes;

    /**
    * @var array
    */
    protected $fillable = ['companyName','companyName_kana','address','phoneNumber','name','name_kana']; // 追記

    public function claim() {
        return $this->hasOne
        (Claim::class);
    }

    /**
     * @var array
     */
    protected $dates = ['created_at', 'updated_at', 'deleted_at']; // 追記
}
