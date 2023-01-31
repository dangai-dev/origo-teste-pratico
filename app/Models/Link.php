<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Link extends Model
{
    use HasFactory;
    
    /**
     * Table name
     * @var string
     */
    protected $table = 'links';
    
    protected $fillable = [
        'url', 
        'hash', 
        'shortened_link', 
        'expiration_days', 
        'enable'
    ];

    /**
     * Rules to validate incoming data
     * @return array<string>
     */
    public function rules()
    {
        return [
            'url' => 'required',
        ];
    }
    
    /**
     * Returning messages for each rule
     * @return array<string>
     */
    public function feedback()
    {
        return [
            'require' => 'o campo URL é necessário',
        ];
    }
}
