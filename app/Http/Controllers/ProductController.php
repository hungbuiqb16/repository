<?php
/**
 * Namespace App\Http\Controllers
 *
 * @category ProductController
 * @package  App\Http\Controllers
 * @author   hungbui <hungbuiqb16@email.com>
 * @license  The MIT License (MIT) Copyright © NTA
 * @link     
 */

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Repositories\Product\ProductRepositoryInterface;
use App\Repositories\ProductImage\ProductImageRepositoryInterface;
use App\Repositories\ProductCategory\ProductCategoryRepositoryInterface;
use App\Repositories\Category\CategoryRepositoryInterface;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\Products\AddProductRequest;

class ProductController extends Controller
{
    /**
     * CategoryRepository Init
     * 
     * @param $categoryRepo 
     */
    private $productRepository;
    private $productImageRepository;
    private $productCategoryRepository;
    private $categoryRepositoryInterface;

    public function __construct(
        ProductRepositoryInterface $productRepository, 
        ProductImageRepositoryInterface $productImageRepository, 
        ProductCategoryRepositoryInterface $productCategoryRepository,
        CategoryRepositoryInterface $categoryRepositoryInterface)
    {
        $this->productRepository = $productRepository;
        $this->productImageRepository = $productImageRepository;
        $this->productCategoryRepository = $productCategoryRepository;
        $this->categoryRepositoryInterface = $categoryRepositoryInterface;
    }

    /**
     * Displays datatables front end view
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
    	
        //$products = $this->productRepository->getAll();
        return view('admin.products.list');    	
    }

    /**
     * Process datatables ajax request.
     *
     * @return \Illuminate\Http\JsonResponse
     */   
    public function anyData() 
    {
        return $this->productRepository->getAll();
    }

    public function create()
    {
        $datas = $this->categoryRepositoryInterface->getAll();
        $categories = json_decode($datas->content(), true);
        return view('admin.products.add')->with('categories', $categories['data']);   
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AddProductRequest $request)
    {
        $data = $request->only('name', 'price', 'desc', 'type', 'type1', 'type2');
        $mainImage = $request->input('main-image-base64');
        if ($mainImage) {
            $data['image'] = $this->saveImageBase64($mainImage,'uploads');
        }
        $productId = $this->productRepository->create($data)->id;
        //store product_category
        $productCategory['product_id'] = $productId;
        $categories = $request->category_id;
        foreach ($categories as $category) {
            $categoryId[] = $category;
            
        }
        $productCategory['category_id'] = json_encode($categoryId,JSON_FORCE_OBJECT);
        $this->productCategoryRepository->create($productCategory);
        //store product_images
        $productImages['product_id'] = $productId;
        if ($request->input('other-image')) {
            $images = $request->input('other-image');
            foreach ($images as $image) {
                $imageEncode[] = $this->saveImageBase64($image,'uploads/sub-img');          
            }
            $productImages['image'] = json_encode($imageEncode,JSON_FORCE_OBJECT);
            $this->productImageRepository->create($productImages);
        }
       return redirect()->route('product.list');
       
       // $data = $request->all();
       // dd($data);
        
    }

    public function getById($id)
    {
        return $this->productRepository->show($id);
    }

    public function destroy($id)
    {
        $result =  $this->productRepository->delete($id);
        return 'done';

    }

    public function saveImageBase64($param, $folder)
    {
        list($extension, $content) = explode(';', $param);
        $tmpExtension = explode('/', $extension);
        preg_match('/.([0-9]+) /', microtime(), $m);
        $fileName = sprintf('img%s%s.%s', date('YmdHis'), $m[1], $tmpExtension[1]);
        $content = explode(',', $content)[1];
        $storage = Storage::disk('public');

        $checkDirectory = $storage->exists($folder);

        if (!$checkDirectory) {
            $storage->makeDirectory($folder);
        }
        $storage->put($folder . '/' . $fileName, base64_decode($content), 'public');

        return $fileName;        
    }

}
