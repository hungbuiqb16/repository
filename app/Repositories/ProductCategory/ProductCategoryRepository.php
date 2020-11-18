<?php 
/**
 * Namespace App\Repositories\ProductCategory
 *
 * @category ProductCategoryRepository
 * @package  App\Repositories\ProductCategory
 * @author   hungbui <hungbuiqb16@email.com>
 * @license  The MIT License (MIT) Copyright © NTA
 * @link     
 */

namespace App\Repositories\ProductCategory;
use App\Repositories\BaseRepository;
use App\Models\ProductCategory;

class ProductCategoryRepository extends BaseRepository implements ProductCategoryRepositoryInterface
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
    public function __construct(ProductCategory $model)
    {
    	parent::__construct($model);
    }
}


 ?>