<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BookAuthor extends Model
{
    protected $table = 'tblBookAuthor';
    public $timestamps = false;
    public $incrementing = false;
    protected $primaryKey = null;   // Eloquent មិនគាំទ្រ composite key
    protected $fillable = ['BookID','AuthorID','AuthorDate','Remark'];

    public function book()   { return $this->belongsTo(Book::class, 'BookID', 'BookID'); }
    public function author() { return $this->belongsTo(Author::class, 'AuthorID', 'AuthorID'); }
}
