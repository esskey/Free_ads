<?php 

/**
 * UsersController class file Doc Comment
 *
 * @category UsersController
 * @package  UsersController
 * @author   Mouhoussoune Nair <naer.mouhoussoune@epitech.eu>
 * @license  http://www.gnu.org/copyleft/gpl.html GNU General Public License
 * @link     http://example.com/
 */

namespace freeads\Http\Controllers;

use freeads\Http\Requests;
use freeads\Http\Controllers\Controller;
use freeads\Utilisateur;
use Auth;
use Input;
use View;
use redirect;
use Hash;
use Validator;
use Mail;
use Flash;
use DB;

use Illuminate\Http\Request;

/**
 * UsersController class Doc Comment
 *
 * The class holding the root UsersController class definition
 *
 * @category UsersController
 * @package  UsersController
 * @author   Mouhoussoune Nair <naer.mouhoussoune@epitech.eu>
 * @license  http://www.gnu.org/copyleft/gpl.html GNU General Public License
 * @link     http://example.com/
 */

class UsersController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     * @param  array $request la requete
     * @return Response
     */
    public function create(Request $request)
    {
        $rules = [
            'username' => 'required|min:4|alpha_dash|unique:users',
            'lastname' => 'required|min:2|alpha',
            'firstname' => 'required|min:2|alpha',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
            'birthdate' => 'required|date'
        ];


        $validator = $this->validate($request, $rules);

        $input = Input::all();
        /*$confirmation_code = str_random(20);*/

        /*$input['confirmation_code'] = $confirmation_code;*/
        
        $input['password'] = Hash::make($input['password']);
        
        Utilisateur::create($input);

        /*Mail::send('email.verify', $confirmation_code, function($message) {
            $message->to($input['email'], $input['username'])
                ->subject('Verification adresse');
        });

        Flash::message('Merci de vous etre inscrit.');*/

        return redirect('login')->with('message', 'Vous avez bien été inscrit, Veuillez vous connecter.');
    }

    /**
     * Etape connexion.
     * @param  array $request la requete
     * @return Response
     */
    public function login(Request $request)
    {
        $rules = [
            'username' => 'required|min:4',
            'password' => 'required'
        ];

        $validator = $this->validate($request, $rules);

        $userdata = array(
            'username' => Input::get('username'),
            'password' => Input::get('password'),
            'activate' => 1
        );

        if (Auth::attempt($userdata, true)) {
            return redirect('accueil');
        } else {
            return redirect('/')->with('message', 'Identifiant incorrecte.');
        }
    }

    /**
     * Se deconnecter.
     *
     * @return Response
     */
    public function logout()
    {
        if (Auth::check()) {
            Auth::logout();
            return redirect('/')->with('message', 'Vous n\'êtes plus connecter');
        }
    }
    
    /**
     * Show the form for editing the specified resource.
     * @param  int $id id de lutilisateur
     * @return Response
     */
    public function edit($id)
    {
        if (Auth::check()) {
            DB::table('Users')
                ->where(
                    array(
                    'id' => $id,
                    'activate' => 1)
                )
                ->update(array('activate' => 0));

            DB::table('annonces')
                ->where(
                    array(
                    'user_id' => $id,
                    'activate' => 1)
                )
                ->update(array('activate' => 0));

            return redirect('Users/logout');
        }
    }

    /**
     * Etape modification.
     * @param  array $request la requete
     * @return Response
     */
    public function modification(Request $request)
    {
        if (Auth::check()) {
            
            $rules = [
                'lastname' => 'required|min:2|alpha',
                'firstname' => 'required|min:2|alpha',
                'email' => 'required|email',
            ];

            $validator = $this->validate($request, $rules);
            
            $input = Input::all();

            if (!empty($input['lastname']) && !empty($input['firstname']) && !empty($input['email'])) {
                DB::table('users')
                    ->where('id', Auth::User()->id)
                    ->update(
                        array(
                        'lastname' => $input['lastname'],
                        'firstname' => $input['firstname'],
                        'email' => $input['email'])
                    );

                return redirect('mon_compte')->with('message', 'Les modifications ont bien été prise en compte');
            } else {
                return redirect('mon_compte')->with('message', 'Aucune modifications n\'a été faite');
            }
        }
    }
}
