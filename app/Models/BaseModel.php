<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\PrintLog;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Support\Facades\Crypt;

class BaseModel extends Model
{
    // helper
    use PrintLog;

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
        'deleted_at' => 'datetime',
    ];

    protected $hidden = ['deleted_at', 'deleted_by'];

    /**
     * **************************************************
     *    A C C E S S O R   A N D   M U T A T O R
     * **************************************************
     */

    // protected function id(): Attribute
    // {
    //     return Attribute::make(
    //         get: fn (string $value) => Crypt::encrypt($value),
    //         // set: fn (string $value) => Crypt::decrypt($value),
    //     );
    // }

    /**
     * **************************************************
     *    S C O P E
     * **************************************************
     */

    public function scopeById($q, $id = '')
    {
        return $q->where('id', $id);
    }

    public function scopeByIdEncrypt($id = '')
    {
        return $this->scopeById(!empty($id) ? Crypt::decrypt($id) : '');
    }

    public function scopeByIds($q, $id = [])
    {
        return $q->whereIn('id', $id);
    }

    public function scopeByIdsEncrypt($q, $ids = [])
    {
        if(count($ids) > 0){
            $decp = [];
            foreach ($ids as $v ) {
                $decp[] = Crypt::decrypt($v);
            }
            return $this->scopeByIds($decp);
        }
        return $this->scopeByIds($ids);
    }
}
