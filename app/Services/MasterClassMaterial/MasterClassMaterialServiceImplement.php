<?php

namespace App\Services\MasterClassMaterial;

use App\Repositories\Class\ClassRepository;
use LaravelEasyRepository\Service;
use App\Repositories\MasterClassMaterial\MasterClassMaterialRepository;

class MasterClassMaterialServiceImplement extends Service implements MasterClassMaterialService
{

  /**
   * don't change $this->mainRepository variable name
   * because used in extends service class
   */
  protected $mainRepository;
  protected $classRepository;

  public function __construct(MasterClassMaterialRepository $mainRepository, ClassRepository $classRepository)
  {
    $this->mainRepository = $mainRepository;
    $this->classRepository = $classRepository;
  }

  public function list($id)
  {
    $class = $this->classRepository->show($id);

    return $this->mainRepository->list($class->masterClass->id);
  }

  public function create($data)
  {
    $request = $data->except(['_token']);
    $data =  array();
    parse_str($request['form'], $data);
    $data['master_class_id'] = $request['master_class_id'];

    return $this->mainRepository->create($data);
  }

  public function show($request)
  {
    return $this->mainRepository->show($request->all());
  }

  public function update($id, $data)
  {
    $request = array();
    parse_str($data['form'], $request);

    return $this->mainRepository->update($id, $request);
  }

  public function delete($id)
  {
    return $this->mainRepository->delete($id);
  }
}
