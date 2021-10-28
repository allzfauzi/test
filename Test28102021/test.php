<?php
/**
 * Created by PhpStorm.
 * User: egie ramdan
 * Date: 31/01/2018
 * Time: 10.05
 */

namespace App\Http\Controllers\Bridging;

use App\Http\Controllers\ApiController;
use App\Transaksi\AntrianPasienDiperiksa;
use App\Transaksi\BPJSRujukan;
use App\Transaksi\PasienDaftar;
use App\Transaksi\PelayananPasienPetugas;
use App\Transaksi\BPJSKlaimTxt;
use App\Transaksi\BPJSGagalKlaimTxt;
use App\Transaksi\PemakaianAsuransi;
use App\Transaksi\StrukPelayanan;
use App\Transaksi\TempBilling;
use Illuminate\Http\Request;
use App\Traits\PelayananPasienTrait;
use App\Transaksi\AntrianPasienRegistrasi;
use App\Master\Pasien;
use App\Master\Alamat;
use App\Master\RunningNumber;
use Webpatser\Uuid\Uuid;
use DB;
use App\Traits\Valet;
use Carbon\Carbon;

class test extends ApiController
{

    use Valet, PelayananPasienTrait;

    public function __construct() {
        parent::__construct($skip_authentication=false);
    }

    public function PostDataLogin(Request $request) {
        $password=$request['user']['password'];
        // $password = j $password 
        $username = $request['user']['username'];
        $email=$request['user']['username'];
        $phone =$request['user']['phone'];
        $address = $request['user']['address'];
        $city = $request['user']['city'];
        $country = $request['user']['country'];
        $name =$request['user']['name'];
        $postcode = $request['user']['postcode'];


        $dataLogin= DB::select(DB::raw("select * from user_m where username =$username  and password=$password"));
        if(empty($dataLogin))
        {   $id =0;
            $dataLoginTerakhir= DB::select(DB::raw("select max(id) from user_m "));
            foreach($dataLoginTerakhir as $itm)
            {
                if($itm->id == '' && $itm->id == null  )
                {
                    $id =  1;
                }else
                { 
                    $id = $itm->id + 1;
                }
            }
            $dataLogin= DB::insert(DB::raw("INSERT INTO User_M
            (id, username, email, password, phone, address, city, country, name, postcode)
                            VALUES        ($id,  $username , $email, $password, $phone , $address,
                            $city, $country, $name, $postcode)"));
            $hasil  = array(
                    'username' => $username,
                    'token' => 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzUxMiJ9.eyJzdWIiOiJhZG1pbi5yZWdpc3RyYXNpIn0.z1sCAtuc6ODM-HKzftAXqvqUPlFs7bm4wd-qTY-EvnBN1uHSk-OHhlHEpgs2vznkiem7u579VFGC2kxAhxD3NA',
                    'email' => $item->$email,
            );            
            $result = array(
                'user' => $hasil,
            );
        }  
        else{
            $message = array(
                'message' => 'Data Tidak Mmiliki Akses',
                'code' => '201',
            );
            $result = array(
                
                'metadata' => $message,
            );
        }  
       
        return $this->respond($result);
    }


    public function getSigin(Request $request) {
        $password=$request['password'];
        // $password = j $password 
        $username = $request['username'];



        $dataLogin= DB::select(DB::raw("select * from user_m where username ='$username'  and password='$password'"));
        if(!empty($dataLogin))
        {
            $hasil =[];
            foreach ($dataLogin as $item){
                   $hasil =array(
                    'password' => $item->password,
                    'email' => $item->email,
                   );
                           }
            $result = array(
                'user' => $hasil,
            );
        }
          
             
        else{
            $message = array(
                'message' => 'Data Tidak Mmiliki Akses',
                'code' => '201',
            );
            $result = array(
                
                'metadata' => $message,
            );
        }  
       
        return $this->respond($result);
    }




    public function getAllUser(Request $request) {

        $dataLogin= DB::select(DB::raw("select * from user_m"));
        if(!empty($dataLogin))
        {
            $hasil =[];
            foreach($dataLogin as $item){
                   $hasil =array(
                    'username' => $item->password,
                    'email' => $item->password,
                    'password' => $item->password,
                    'phone' => $item->password,
                    'address' => $item->password,
                    'city' => $item->password,
                    'country' => $item->password,
                    'name' => $item->password,
                    'postcode' => $item->password,
                   );
                }              
            $result = array(
                'user' => $hasil,
            );
        }
          
             
        else{
            $message = array(
                'message' => 'Data Tidak Mmiliki Akses',
                'code' => '201',
            );
            $result = array(
                
                'metadata' => $message,
            );
        }  
       
        return $this->respond($result);
    }



    public function shopping(Request $request) {

        $name=$request['name'];
        $date = $request['date'];
            $dataLoginTerakhir= DB::select(DB::raw("select max(id) as id from shopping_t "));
            foreach($dataLoginTerakhir as $itm)
            {
                if($itm->id == '' && $itm->id == null  )
                {
                    $id =  1;
                }else
                { 
                    $id = $itm->id + 1;
                }
            }
           
            
            $dataLogin= DB::insert(DB::raw("INSERT INTO shopping_t
            (id,  nama, tglInput)
            VALUES        ($id,  '$name', $date)"));
            $hasil  = array(
                    'createdate' => $date,
                    'id' => $id,
                    'name' => $name,
            );            
            $result = array(
                'user' => $hasil,
            );
        
       
        return $this->respond($result);
    }

    public function Getshopping(Request $request) {

            $dataLoginTerakhir= DB::select(DB::raw("select * from shopping_t "));
          if(!empty($dataLoginTerakhir))
          {
            foreach($dataLoginTerakhir as $item)
            {
                // return( $item->tglInput);
                // die;
                $hasil  = array(
                    'createdate' => $item->tglInput,
                    'id' => $item->id,
                    'name' => $item->nama,
            ); 
            }
                      
            $result = array(
                'data' => $hasil,
            );
          }else{
            $result = array(
                'data' => "Kosong",
            );
          }
           
        
       
        return $this->respond($result);
    }


    public function GetshoppingById(Request $request) {

        $id=$request['id'];
        $dataLoginTerakhir= DB::select(DB::raw("select * from shopping_t where id= $id "));
          if(!empty($dataLoginTerakhir))
          {
            foreach($dataLoginTerakhir as $item)
            {
                $hasil  = array(
                    'createdate' => $item->tglInput,
                    'id' => $item->id,
                    'name' => $item->nama,
            ); 
            }
                      
            $result = array(
                'data' => $hasil,
            );
          }else{
            $result = array(
                'data' => "Kosong",
            );
          }
           
        
       
        return $this->respond($result);
    }


}
