<?php 
/**
 * Namespace App\Repositories
 *
 * @category RepositoryInterface
 * @package  App\Repositories
 * @author   hungbui <hungbuiqb16@email.com>
 * @license  The MIT License (MIT) Copyright © NTA
 * @link     
 */
namespace App\Repositories;

interface RepositoryInterface
{
    /**
     * Get all
     * 
     * @return mixed
     */
	public function getAll();

    /**
     * Create
     *
     * @param array   $data 
     * 
     * @return mixed
     */
	public function create(array $data);

    /**
     * Delete by Id
     *
     * @param int $id id_model
     * 
     * @return mixed
     */
    public function delete($id);

    /**
     * Get by Id
     *
     * @param int $id id_model
     * 
     * @return mixed
     */
    public function show($id);
}




 ?>