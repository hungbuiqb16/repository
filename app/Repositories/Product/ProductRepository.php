<?php 
/**
 * Namespace App\Repositories\Product
 *
 * @category CategoryRepository
 * @package  App\Repositories\Product
 * @author   hungbui <hungbuiqb16@email.com>
 * @license  The MIT License (MIT) Copyright © NTA
 * @link     
 */

namespace App\Repositories\Product;

use App\Repositories\BaseRepository;
use App\Models\Product;

class ProductRepository extends BaseRepository implements ProductRepositoryInterface
{
    /**
     * Declare model
     *
     * @var \Illuminate\Database\Eloquent\Model
     */  
    protected $model;
    
    /**
     * Get model
     * 
     * @return void
     */
    public function __construct(Product $model)
    {
        parent::__construct($model);
    }

}


 ?>