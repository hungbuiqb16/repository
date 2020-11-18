<?php 
/**
 * Namespace App\Repositories
 *
 * @category BaseRepository
 * @package  App\Repositories
 * @author   hungbui <hungbuiqb16@email.com>
 * @license  The MIT License (MIT) Copyright © NTA
 * @link     
 */

namespace App\Repositories;
use Illuminate\Database\Eloquent\Model;
use Yajra\Datatables\Datatables;

abstract class BaseRepository implements RepositoryInterface
{
    /**
     * Declare model
     *
     * @var \Illuminate\Database\Eloquent\Model
     */
    protected $model;

    /**
     * BaseRepository constructor init. 
     */
    public function __construct(Model $model)
    {
        $this->model = $model;
    }

    /**
     * Get all
     * Process datatables ajax request.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function getAll()
    {
    	//return $this->model->all();
        $query = $this->model->all();
        return Datatables::of($query)
        ->addColumn('action', function($data) {
            $buttons = '<button class="btn btn-info" type="button" data-toggle="modal"  data-target="#modal-edit"><i class="fas fa-edit"></i></button>
                <button class="btn btn-danger" type="button" id="'.$data->id.'" name="'.$data->id.'" onclick="deleteRecord(this.id,this)" data-token="'.csrf_token().'"><i class="fas fa-trash-alt"></i></button>';
            return $buttons; 
        })
        ->addColumn('image', function($data) {
            $url = asset('storage/uploads/'.$data->image);
            return '<img src="'.$url.'" class="img-fluid">';})
        ->editColumn('created_at', function($data) {
            return $data->created_at->format('m/d/Y H:i:s');
        })
        ->rawColumns(['image','action'])
        ->make(true);
    }

    /**
     * Create
     * 
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function create(array $data)
    {
    	return $this->model->create($data);
    }

    /**
     * Delete by Id
     *
     * @param int $id id_model
     * 
     * @return mixed
     */
    public function delete($id)
    {
        $query = $this->model->where('id',$id)->delete();
        //return Datatables::of($query)->make(true);
        return $query;
    }

    /**
     * Get by Id
     *
     * @param int $id id_model
     * 
     * @return mixed
     */
    public function show($id)
    {
        $query = $this->model->where('id',$id);
        return Datatables::of($query)->make(true);
    }   
}


 ?>