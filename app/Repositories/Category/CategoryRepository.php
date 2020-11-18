<?php 
/**
 * Namespace App\Repositories\Category
 *
 * @category CategoryRepository
 * @package  App\Repositories\Category
 * @author   hungbui <hungbuiqb16@email.com>
 * @license  The MIT License (MIT) Copyright © NTA
 * @link     
 */

namespace App\Repositories\Category;

use App\Repositories\BaseRepository;
use App\Models\Category;

class CategoryRepository extends BaseRepository implements CategoryRepositoryInterface
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
    public function __construct(Category $model)
    {
    	parent::__construct($model);
    }
    /**
     * Get all category
     * 
     * @return void
     */
    public function getCategory()
    {
    	return $this->model->whereNull('parent_id')->with('childrenRecursive')->get();
    }

}


 ?>