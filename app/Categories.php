<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Categories extends Model
{
	protected $table = 'beletag_categories';
  protected $fillable = ['name', 'date_add', 'site_id'];
}
