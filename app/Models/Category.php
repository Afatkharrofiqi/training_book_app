<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class Category extends Model
{
    use HasFactory;
    protected $table = 'category';
    protected $guarded = ['id'];

    public function getNamaKategoriAttribute(){
        return $this->name;
    }

    public function getCreatedAtWithFormatAttribute(){
        return Carbon::parse($this->created_at)->format('d M Y');
    }

    public function getUpdatedAtWithFormatAttribute(){
        return Carbon::parse($this->updated_at)->format('d M Y');
    }

    public function scopeGetAllCategoryWithPagination(){
        return $this->select(DB::raw('name as kategori, slug as dash, id, created_at, updated_at, name'))
                                        ->orderBy('created_at', 'desc')
                                        ->paginate(10)
                                        ->onEachSide(1);
    }
}
