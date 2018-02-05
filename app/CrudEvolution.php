<?php

namespace App;

use Jenssegers\Mongodb\Eloquent\Model as Eloquent;

class CrudEvolution extends Eloquent
{
	    protected $collection = 'crudevolutions';

		protected $guarded = ['id'];

}
