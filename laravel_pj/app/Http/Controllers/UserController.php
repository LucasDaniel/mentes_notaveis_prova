<?php

namespace App\Http\Controllers;

use App\Models\Adress;
use App\Models\Cities;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $user = User::all();
            $json = $this->successCollection($user);
        } catch (Exception $e) {
            $json = $this->error($e);
        }

        return json_encode($json);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        try {
            
            //Verify if city Exists, if not, send exception
            if (!Cities::verifyCityExists($request->get('city_id'))) {
                $this->exception("City not found");
            }

            $adress_id = null;
            
            //Verify the validate of request
            $this->doValidade($request);

            //Create the new user
            $user = new User();
            $user->name = $request->get('name');
            $user->email = $request->get('email');
            $user->password = Hash::make($request->get('password'));

            //Get the adress in database or create if not exists
            $adress_id = $this->createOrGetAdress($request->get('city_id'),
                                                    $request->get('neighborhood'),
                                                    $request->get('adress_name'),
                                                    $request->get('number'),
                                                    $request->get('complement'));
            
            //Get the adress_id and save user
            $user->adress_id = $adress_id;
            $user->save();

            $json = $this->successModel($user);

        } catch (Exception $e) {
            $json = $this->error($e);
        }

        return json_encode($json);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        try {
            //Get the user by id
            $user = User::find($id);

            //Get adress by user adress_id
            $adress = Adress::find($user->adress_id);

            //Save Adress and User in array to send
            $json = [
                'user' => $user->getAttributes(),
                'adress' => $adress->getAttributes()
            ];

            $json = $this->successArray($json);
        } catch (Exception $e) {
            $json = $this->error($e);
        }

        return json_encode($json);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {

        try {
            
            //Verify if city Exists, if not, send exception
            if (!Cities::verifyCityExists($request->get('city_id'))) {
                $this->exception("City not found");
            }

            //Verify if user Exists, if not, send exception
            $user = User::find($id);
            if (!$user) {
                $this->exception("User not exists");
            }

            //Verify the validate of request
            $this->doValidadeUpdate($request);

            //Save the new values of users or get the old values
            $user->name = $request->get('name') ?? $user->name;
            $user->email = $request->get('email') ?? $user->email;
            $user->password = Hash::make($request->get('password')) ?? $user->password;

            //Get the adress in database or create if not exists
            $user->adress_id = $this->createOrGetAdress($request->get('city_id'),
                                                        $request->get('neighborhood'),
                                                        $request->get('adress_name'),
                                                        $request->get('number'),
                                                        $request->get('complement'));

            //Update user
            $user->update();

            $json = $this->successModel($user);

        } catch (Exception $e) {
            $json = $this->error($e);
        }

        return json_encode($json);
    
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {

            //Get the user, if not exists, send exception
            $user = User::find($id);
            if (!$user) {
                $this->exception("User not exists");
            }

            //Get the name to feedback
            $name = $user->name;

            //Delete user
            $user->delete();

            $json = $this->createJson('User '.$name.' deleted!',200);

        } catch (Exception $e) {
            $json = $this->error($e);
        }
        return json_encode($json);
    }

    /**
     * Create the new Adress or Create a new Adress
     * @param int, string, string, string, string
     * @return int  
     */
    private function createOrGetAdress(int $city_id, string $neighborhood, string $adress_name, string $number, $complement = '') {
        $adress  = Adress::getAdressByValues($city_id, $neighborhood, $adress_name, $number, $complement);
        if ($adress) {
            return $adress->id;
        } else {                                                    
            return Adress::createNewAdress($city_id, $neighborhood, $adress_name, $number, $complement);
        }
    }

    /**
     * Do validate of request when new user is create
     * @param Request
     */
    private function doValidade(Request $request): void {
        $request->validate([
            'name' => 'required|max:255',
            'email' => 'required|email|unique:users|max:255',
            'password' => 'required|min:8|max:12',
            'neighborhood' => 'required|max:255',
            'adress_name' => 'required|max:255',
            'number' => 'required|max:10'
        ]);
    }

    /**
     * Do validate of request when user is updated
     * @param Request
     */
    private function doValidadeUpdate(Request $request): void  {
        $request->validate([
            'name' => 'max:255',
            'email' => 'email|max:255',
            'password' => 'min:8|max:12',
            'neighborhood' => 'max:255',
            'adress_name' => 'max:255',
            'number' => 'max:10'
        ]);
    }
}
