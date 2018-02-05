<?php

namespace App;

use Jenssegers\Mongodb\Eloquent\Model as Eloquent;

class Crud extends Eloquent 
{
	protected $collection = 'cruds';

    protected $fillable = [
            'name',
            'industry',
            'years'

    ];
}
