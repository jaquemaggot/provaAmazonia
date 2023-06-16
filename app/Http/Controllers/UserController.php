<?php

namespace App\Http\Controllers;

use DateTime;
use Exception;
use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    private $_ViaCepController;
    public function __construct() {
        $this->_ViaCepController = new ViaCepController;
    }

    public function GetAll(){
        $users = User::all();
        return $users;
    }

    public function GetbyId($id){
        try{
            $this->ValidateId($id);
            $user = User::find($id);
            return $user;
        }catch(Exception $ex){
            return response()->json(['message' => $ex->getMessage()], 400);
        }
    }

    public function Insert(Request $request){
        try{
            $user = new User;

            $zip_code = $this->ValidateZipCode($request->zip_code);
            $this->ValidateDateFormat($request->birthdate);
            $this->ValidateAge($request->birthdate);
            $this->ValidateCPFFormat($request->cpf);
            $this->ValidateCpf($request->cpf);
            
            $user->name = $request->name;
            $user->email = $request->email;
            $user->cpf = $request->cpf;
            $user->birthdate = $request->birthdate;
            $user->zip_code = $request->zip_code;
            $user->address = $zip_code->logradouro;
            $user->neighborhood = $zip_code->bairro;
            $user->number = $request->number;
            $user->city = $zip_code->localidade;
            $user->state = $zip_code->uf;

            $user->save();

            return $user;
        }catch(Exception $ex){
            return response()->json(['message' => $ex->getMessage()], 400);
        }
    }

    public function Update($id,Request $request){
        try{

            $this->ValidateId($id);

            $user = User::find($id);

            $zip_code = $this->ValidateZipCode($request->zip_code);
            $this->ValidateDateFormat($request->birthdate);
            $this->ValidateAge($request->birthdate);
            

            $user->name = $request->name;
            $user->email = $request->email;
            $user->birthdate= $request->birthdate;
            $user->zip_code = $request->zip_code;
            $user->address = $zip_code->logradouro;
            $user->neighborhood = $zip_code->bairro;
            $user->number = $request->number;
            $user->city = $zip_code->localidade;
            $user->state = $zip_code->uf;

            $user->save();

            return $user;
        }catch(Exception $ex){
            return response()->json(['message' => $ex->getMessage()], 400);
        }
    }

    public function Delete($id){
        try{
            $this->ValidateId($id);
            $user = User::find($id);
            $user->delete();
        }catch(Exception $ex){
            return response()->json(['message' => $ex->getMessage()], 400);
        }
    }

    private function ValidateZipCode($zip_code_user){
        $zip_code = $this->_ViaCepController->GetZipCode($zip_code_user);

        if($zip_code->uf != 'AM'){
          throw new Exception('Usuário precisa ser do estado do Amazonas');
        }
        return $zip_code;
    }

    private function ValidateAge($birtdate_user){

        $birtdate = new DateTime($birtdate_user);
        
        $dateNow = new DateTime();

        $diffYear = $dateNow->diff($birtdate)->y;

        if ($diffYear < 18) {
           throw new Exception('Usuário é menor de 18 anos');
        }
    }

    private function ValidateDateFormat($birtdate){

        $dateTime = DateTime::createFromFormat('Y-m-d', $birtdate);

        if (!$dateTime || $dateTime->format('Y-m-d') != $birtdate) {
            throw new Exception('A data não está no formato correto.');
        }
    }

    private function ValidateCpf($cpf){
        $user = User::where('cpf', $cpf)->first();
        if($user !== null){
            throw new Exception('Cpf já existe na base de dados');
        } 
    }

    private function ValidateId($id){
        $user = User::find($id);
        if($user == null){
            throw new Exception('Id não encontrado na base de dados');
        }
    }


    private function ValidateCPFFormat($cpf) {
 
        $cpf = preg_replace( '/[^0-9]/is', '', $cpf );
         
        if (strlen($cpf) != 11) {
            throw new Exception('Cpf está no formato inválido');
        }

        if (preg_match('/(\d)\1{10}/', $cpf)) {
            throw new Exception('Cpf está no formato inválido');
        }

        for ($t = 9; $t < 11; $t++) {
            for ($d = 0, $c = 0; $c < $t; $c++) {
                $d += $cpf[$c] * (($t + 1) - $c);
            }
            $d = ((10 * $d) % 11) % 10;
            if ($cpf[$c] != $d) {
                throw new Exception('Cpf está no formato inválido');
            }
        }
    }
}
