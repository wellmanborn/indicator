<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Letter extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['company_name', 'letter_type', 'action_date', 'attached_file', 'description',
        'letter_number', 'created_by', 'updated_by'];
    /**
     * @var mixed
     */
}
