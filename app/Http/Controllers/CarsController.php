<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cars;
use App\Models\Marka;
use App\Models\CarModel;
use Illuminate\Support\Facades\DB;

class CarsController extends Controller
{   protected $request;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    public function index()
    {
      /*ini_set('max_execution_time', 900);
        $path = base_path() . '/public/json/cars4.json';
        $json[] = json_decode(file_get_contents($path),true);
        $i = 1;

        foreach ($json[0] as $key => $value) {
          echo "<h2>" . $key . "__" . count($value) . "</h2>";
          var_dump($value);
          $i++;
          if(count($value) == 0)
          {

            //$flights = Marka::where('nameMarka', $key)->delete();

            /*$marka = new Marka;
            $marka->nameMarka = $key;
            $marka->save();*/
        /*  }
        }
        echo $i;
        /*foreach ($json[0] as $key => $value) {
          if(count($value) != 0)
          {
            foreach ($value as $key => $models) {
              $model = new CarModel;
              $model->nameModel = $models;
              $model->save();
            }
          }
        }*/
        //dd($json[0]);
        /*foreach ($json[0] as $key => $value) {
          foreach ($value as $model) {
            $modelCar = DB::table('model')->select('model.id')->where('model.nameModel', $model)->get();
              $idMarka = $this->getIdMarka($key);
              $idModel = $this->getIdModel($model);

              $car = new Cars;
              $car->id_marka = $idMarka[0];
              $car->id_model = $idModel[0];
              $car->save();
                echo $i . " marka => " . $idMarka[0] . " => " . $key . " model=> " . $idModel[0] . " => " . $model . "<br>";
                $i++;

            }
          }*/
          $address = DB::table('cars')
                    ->join('marka', 'cars.id_marka', '=', 'marka.id')
                    ->join('model', 'cars.id_model', '=', 'model.id')
                    ->select('cars.*', 'marka.nameMarka', 'model.nameModel')
                    ->where('nameMarka', 'bmw')
                    ->get();
                    //dd($address);
          echo $address[0]->nameMarka;
          foreach ($address as $value) {
            echo '___' . $value->nameModel . '</br>';
          }

  }

  public function getBlockData()
  {
    $regions = $this->getAllRegions();
    $marks = $this->getAllMarks();
    $data = $this->getAnnouncements();

      return view('myview', [
          'marks'         => $marks,
          'regions'       => $regions,
          'announcements' => $data
      ]);

  }

  public function getIdMarka($marka)
  {
    $id = DB::table('marka')
              ->select('marka.id')
              ->where('marka.nameMarka', $marka)
              ->get();
    foreach ($id as $value) {
      $arr[] = $value->id;
    }
    return $arr;
  }

  public function getIdModel($model)
  {
    $id = DB::table('model')
              ->select('model.id')
              ->where('model.nameModel', $model)
              ->get();
    foreach ($id as $value) {
      $arr[] = $value->id;
    }
    return $arr;
  }

  public function getAllMarks()
  {
    $marks = DB::table('marka')
              ->select('marka.nameMarka', 'marka.id')
              ->get();
    return $marks;
  }

  public function getModelsById()
  {
    $id = $_GET['id'];
    $model = DB::table('cars')
              ->join('model', 'cars.id_model', '=', 'model.id')
              ->select('model.id', 'model.nameModel')
              ->where('id_marka', $id)
              ->get();
      echo "<option></option>";
      foreach ($model as $item) {
          echo "<option value='". $item->id ."'>" . $item->nameModel ."</option>";
      }
    return $model;
  }

  public function getAllRegions()
  {
    $regions = DB::table('regions')
                ->select('regions.id', 'regions.nameRegion')
                ->get();
    return $regions;
  }

  public function getCityById()
  {
    $id = $_GET['id'];
    $city = DB::table('addresses')
              ->join('cities', 'addresses.id_city', '=', 'cities.id')
              ->select('cities.id', 'cities.nameCity')
              ->where('id_region', $id)
              ->get();
        echo "<option></option>";
      foreach ($city as $item) {
          echo "<option value='". $item->id ."'>" . $item->nameCity ."</option>";
    }
    //return $city;
  }

  public function getAnnouncements()
  {
      $announcements = DB::table('announcements')
          ->select('announcements.id','marka.nameMarka', 'model.nameModel', 'regions.nameRegion', 'cities.nameCity', 'attributes.volume', 'attributes.mileage', 'attributes.count_owners', 'attributes.price', 'attributes.description')
          //->join('announcements', 'photos.id_announsements', '=', 'announcements.id')
          ->join('cars', 'announcements.id_cars', '=', 'cars.id')
          ->join('marka', 'cars.id_marka', '=', 'marka.id')
          ->join('model', 'cars.id_model', '=', 'model.id')
          ->join('addresses', 'announcements.id_addresses', '=', 'addresses.id')
          ->join('regions', 'addresses.id_region', '=', 'regions.id')
          ->join('cities', 'addresses.id_city', '=', 'cities.id')
          ->join('attributes', 'announcements.id_attributes', '=', 'attributes.id')
          ->orderBy('announcements.created_at', 'desc');
          //->paginate(2);
          //->get();

      $announcements = $this->filters($announcements);


      $announcements = $announcements->paginate(10);
      foreach ($announcements as $value)
      {
          $photos = DB::table('photos')->select('action')->where('id_announsements', '=', $value->id)->get();
          $value->action = $photos;
      }
      return $announcements;
  }

  public function fetch(Request $request)
  {
      if($request->ajax())
      {
          $regions = $this->getAllRegions();
          $marks = $this->getAllMarks();
          $announcements = $this->getAnnouncements();
          return view('myview', compact('announcements', 'regions', 'marks'))->render();

      }
  }

  public function filters($query)
  {
      /*Фильтрация по области*/
      if($this->request->filled('filtersRegions')){
          $regions = $this->request->get('filtersRegions');
          $query->where('addresses.id_region', '=', $regions);
      }
      /*Фильтрация по городу*/
      if($this->request->filled('filtersCities')){
          $city = $this->request->get('filtersCities');
          $query->where('addresses.id_city', '=', $city);
      }
      /*Фильтрация по марке*/
      if($this->request->filled('filtersMarks')){
          echo $marka = $this->request->get('filtersMarks');
          $query->where('cars.id_marka', '=', $marka);
      }
      /*Фильтрация по модели*/
      if($this->request->filled('filtersModels')){
          echo $model = $this->request->get('filtersModels');
          $query->where('cars.id_marka', '=', $model);
      }
      /*Фильтрация по объему*/
      if($this->request->filled('volume1')){
          $volume1 = $this->request->get('volume1');
          $query->where('attributes.mileage', '>', $volume1);
      }
      if ($this->request->filled('volume2')){
          $volume2 = $this->request->get('volume2');
          $query->where('attributes.volume', '<', $volume2);
      }

      /*Фильтрация по цене*/
      if($this->request->filled('price1')){
          $price1 = $this->request->get('price1');
          $query->where('attributes.price', '>=', $price1);
      }
      if ($this->request->filled('price2')){
          $price2 = $this->request->get('price2');
          $query->where('attributes.price', '<=', $price2);
      }
      /*Фильтрация по количеству владельцев*/
      if($this->request->filled('quantityOwners1')){
          $owners1 = $this->request->get('quantityOwners1');
          $query->where('attributes.count_owners', '>', $owners1);
      }
      if ($this->request->filled('quantityOwners2')){
          $owners2 = $this->request->get('quantityOwners2');
          $query->where('attributes.count_owners', '<', $owners2);
      }
      /*Фильтрация по пробегу*/
      if($this->request->filled('mileage1')){
          $mileage1 = $this->request->get('mileage1');
          $query->where('attributes.mileage', '>', $mileage1);
      }
      if ($this->request->filled('mileage2')){
          $mileage2 = $this->request->get('mileage2');
          $query->where('attributes.mileage', '<', $mileage2);
      }


      return $query;
  }


}
