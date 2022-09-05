<?php

namespace App\Repositories;

use Illuminate\Support\Facades\File;

abstract class BaseRepository implements RepositoryInterface
{
    /**
     * register model
     */
    protected $model;

    /**
     * model initialization
     */
    public function __construct()
    {
        $this->setModel();
    }

    /**
     * get the corresponding model
     * @return mixed
     */
    abstract public function getModel();

    /**
     * Set model
     */
    public function setModel()
    {
        $this->model = app()->make(
            $this->getModel()
        );
    }

    /**
     * @return mixed
     */
    public function getAll()
    {
        return $this->model->all();
    }

    /**
     * @param $id
     * @return mixed
     */
    public function find($id)
    {
        $result = $this->model->find($id);

        return $result;
    }

    /**
     * @param $attributes
     * @return mixed
     */
    public function create($attributes = [])
    {
        return $this->model->create($attributes);
    }

    /**
     * @param $id
     * @param $attributes
     * @return false|mixed
     */
    public function update($id, $attributes = [])
    {
        $result = $this->find($id);
        if ($result) {
            $result->update($attributes);
            return $result;
        }

        return false;
    }

    /**
     * @param $id
     * @return bool
     */
    public function delete($id)
    {
        $result = $this->find($id);
        if ($result) {
            $result->delete();
            return true;
        }

        return false;
    }

    /**
     * @param $file
     * @param $source
     * @return mixed
     */
    public function upload($file, $source)
    {
        $image_name = md5(rand(1000,10000));
        $ext = strtolower($file->getClientOriginalExtension());
        $image_full_name = $image_name.'.'.$ext;
        $uploade_path = $source;
        $image_url = $uploade_path.$image_full_name;
        $file->move($uploade_path,$image_full_name);
        return $image_url;
    }

    /**
     * @param $key
     * @return mixed|void
     */
    public function obj_search($key)
    {
        $result = $this->model->where('name', 'like', "%$key%")->take(5)->get();
        return $result;
    }

}
