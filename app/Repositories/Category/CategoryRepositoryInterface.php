<?php 
/**
 * Namespace App\Repositories\Category
 *
 * @category CategoryRepositoryInterface
 * @package  App\Repositories\Category
 * @author   hungbui <hungbuiqb16@email.com>
 * @license  The MIT License (MIT) Copyright © NTA
 * @link     
 */

namespace App\Repositories\Category;

use App\Repositories\RepositoryInterface;

interface CategoryRepositoryInterface extends RepositoryInterface
{
    /**
     * Get Category
     * 
     * @return void
     */
    public function getCategory();
    
}



 ?>