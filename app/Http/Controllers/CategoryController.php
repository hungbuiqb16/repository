<?php
/**
 * Namespace App\Http\Controllers
 *
 * @category CategoryController
 * @package  App\Http\Controllers
 * @author   hungbui <hungbuiqb16@email.com>
 * @license  The MIT License (MIT) Copyright © NTA
 * @link     
 */
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\Category\CategoryRepositoryInterface;
use App\Http\Requests\CategoryRequest;

class CategoryController extends Controller
{
    /**
     * CategoryConcategoryRepositorytroller
     * 
     * @var categoryRepository|\App\Repositories\Repository
     */
	private $categoryRepository;

    /**
     * CategoryRepository Init
     * 
     * @param $categoryRepo 
     */
	public function __construct(CategoryRepositoryInterface $categoryRepository)
	{
       $this->categoryRepository = $categoryRepository;
	}

    /**
     * Display all categories
     * 
     * @return void
     */
    public function index()
    {
    	$categories = $this->categoryRepository->getAll();
    	return view('admin.categories.list', compact('categories'));
    }

    /**
     * Display form to create category
     * 
     * @return void
     */
    public function create()
    {
    	$categories = $this->categoryRepository->getCategory();
    	return view('admin.categories.add', compact('categories'));
    }
    /**
     * Create store function to save category
     * 
     * @param Request $request 
     * 
     * @return Response
     */
    public function store(CategoryRequest $request)
    {  
        $data = $request->all();
        $categories = $this->categoryRepository->create($data);
        return redirect()->route('category.list');
    }
}
