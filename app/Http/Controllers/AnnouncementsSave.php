<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\Announcements;



class AnnouncementsSave extends Controller
{

    public function store(Request $request)
    {
      $id_user = Auth::id();
      $post = $request->all();

      $countAnnouncementsUser = DB::table('announcements')
                                        ->where('id_owners', $id_user)
                                        ->get();

      if (count($countAnnouncementsUser) == 3)
      { return $message = 'Вы не можете добавить более трех обьявлений!';}


        $id_cars = DB::table('cars')->select('cars.id')
                                  ->where([
                                        ['id_marka', $post['marks']],
                                        ['id_model', $post['models']]
                                  ])->get();

        $id_addresses = DB::table('addresses')->select('addresses.id')
                                            ->where([
                                                ['id_region', $post['regions']],
                                                ['id_city', $post['cities']]
                                            ])->get();

        $id_attribute = DB::table('attributes')->insertGetId([
                                        'volume'        => $post['volume'],
                                        'mileage'       => $post['mileage'],
                                        'count_owners'  => $post['quantityOwners'],
                                        'price'         => $post['price'],
                                        'description'   => $post['description']
                                      ]);



        $idNewAnnouncement = DB::table('announcements')->insertGetId([
          'id_owners'       => $id_user,
          'id_cars'         => $id_cars[0]->id,
          'id_attributes'   => $id_attribute,
          'id_addresses'    => $id_addresses[0]->id,
          'created_at'      => date('yy-m-d h:i:s')
      ]);
        $this->uploadFile($request, $id_user, $idNewAnnouncement);


        return $message = 'Обьявление добавлено!';
    }


    public function last($table)
    {
        $order = DB::table($table)->latest()->first();
        return $order;
    }

    public function uploadFile($request, $id_user, $idNewAnnouncement)
    {

       $request->validate([
           'photos' => 'required',
           'photos.*' => 'mimes:jpeg,png,jpg'
        ]);
        $files = $request->file('photos');

        //dd();
        foreach ($files as $value) {
            $fileName = time() . $value->getClientOriginalName();
            $path = 'file/' . $id_user;
            $action = $path . "/" . $fileName;
            $photoNew = DB::table('photos')->insert([
                'action'            => $action,
                'id_announsements'  => $idNewAnnouncement
            ]);

            //echo $fileName;
            $value->move(public_path('file/' . $id_user), $fileName);
            //$value->store('file/' . $id_user);

        }
    }


}
