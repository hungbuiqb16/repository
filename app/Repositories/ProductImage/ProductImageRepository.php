<?php 
/**
 * Namespace App\Repositories\ProductImage
 *
 * @category ProductImageRepository
 * @package  App\Repositories\ProductImage
 * @author   hungbui <hungbuiqb16@email.com>
 * @license  The MIT License (MIT) Copyright © NTA
 * @link     
 */

namespace App\Repositories\ProductImage;
use App\Repositories\BaseRepository;
use App\Models\ProductImage;

class ProductImageRepository extends BaseRepository implements ProductImageRepositoryInterface
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
    public function __construct(ProductImage $model)
    {
    	parent::__construct($model);
    }
}


 ?>