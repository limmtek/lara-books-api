<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Book
 * @package App
 *
 * @property int $id
 * @property string $name
 * @property int $year_of_writing
 * @property int $number_of_pages
 * @property string $created_at
 * @property string $updated_at
 */
class Book extends Model
{
    use SoftDeletes;
}
