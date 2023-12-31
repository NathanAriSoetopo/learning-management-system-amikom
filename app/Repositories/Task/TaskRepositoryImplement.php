<?php

namespace App\Repositories\Task;

use LaravelEasyRepository\Implementations\Eloquent;
use App\Models\Task;
use App\Models\User;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class TaskRepositoryImplement extends Eloquent implements TaskRepository{

    /**
    * Model class to be used in this repository for the common methods inside Eloquent
    * Don't remove or change $this->model variable name
    * @property Model|mixed $model;
    */
    protected $model;

    public function __construct(Task $model)
    {
        $this->model = $model;
    }

    public function getAll($request = null){
        return $this->model->getClass($request['class_id'] ?? null)->with('has_class', 'material')->get();
    }

    public function show($id){
        return $this->model->with('assets', 'users')->find($id);
    }

    public function getIndividualStudent($id){
        return $this->model->with(['users' => function($user){
            $user->where('id', Auth::user()->id);
        }])->find($id);
    }

    public function getAllTaskStudent(){
        return $this->model->whereHas('users', function($user){
            $user->where('id', Auth::user()->id);
        })->get();
    }

    public function store($request)
    {
        DB::beginTransaction();

        try{
            $create = $this->model->create($request);

            $users = User::select('id')->whereHas('userHasClass', function($class) use ($request){
                $class->where('id', $request['class_id']);
            })->pluck('id')->toArray();
    
            $create->users()->attach($users, ['master_class_material_id' => $create->master_class_material_id]);
    
            DB::commit();

            return $create;
        }catch(Exception $e){
            DB::rollBack();
            return $e->getMessage();
        }
    }

    public function update($id, $data)
    {
        $get = $this->model->find($id);

        $get->update($data);
    }

    public function delete($id)
    {
        $data = $this->model->find($id);

        $data->delete();

        return $data->delete() ? ['status' => 'success', 'msg' => $data->name . ' Berhasil Dihapus'] : ['status' => 'error', 'msg' => $data->name . ' Gagal Dihapus'];
    }

    public function submit($id, $request)
    {
        $data = $this->model->find($id);

        $data->users()->updateExistingPivot(Auth::user()->id, $request, false);

        return $data ?? false;
    }
}
