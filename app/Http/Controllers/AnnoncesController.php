<?php 

/**
 * AnnoncesController class file Doc Comment
 *
 * @category AnnoncesController
 * @package  AnnoncesController
 * @author   Mouhoussoune Nair <naer.mouhoussoune@epitech.eu>
 * @license  http://www.gnu.org/copyleft/gpl.html GNU General Public License
 * @link     http://example.com/
 */

namespace freeads\Http\Controllers;

use freeads\Http\Requests;
use freeads\Http\Controllers\Controller;
use freeads\User;
use freeads\Annonce;
use Auth;
use Input;
use View;
use redirect;
use Hash;
use Validator;
use Mail;
use Flash;
use DB;
use Session;

use Illuminate\Http\Request;

/**
 * AnnoncesController class Doc Comment
 *
 * The class holding the root AnnoncesController class definition
 *
 * @category AnnoncesController
 * @package  AnnoncesController
 * @author   Mouhoussoune Nair <naer.mouhoussoune@epitech.eu>
 * @license  http://www.gnu.org/copyleft/gpl.html GNU General Public License
 * @link     http://example.com/
 */

class AnnoncesController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $annonce = DB::table('annonces')
         ->Join('photos', 'photos.annonce_id', '=', 'annonces.id')
         ->Join('users', 'users.id', '=', 'annonces.user_id')
         ->where('annonces.activate', 1)
         ->select('annonces.*', 'photos.nom', 'users.username')
         ->groupBy('annonces.id')
         ->orderBy('annonces.created_at', 'desc')
         ->get();

        return view('accueil')->with('annonce', $annonce);//
    }

    /**
     * Display a search annonce
     * 
     * @return Response
     */
    public function recherche()
    {
        $input = Input::all();

        $annonce = DB::table('annonces')
         ->Join('photos', 'photos.annonce_id', '=', 'annonces.id')
         ->Join('users', 'users.id', '=', 'annonces.user_id')
         ->where(
                function ($query) {
                    $input = Input::all();
                    $query->where('annonces.activate', '=', 1)
                        ->where('annonces.titre', 'LIKE', '%'.$input['recherche'].'%');
                }
         )
          ->orWhere(
                function ($query) {
                    $input = Input::all();
                    $query->where('annonces.activate', '=', 1)
                        ->where('annonces.categorie', 'LIKE', $input['recherche']);
              }
          )
         ->select('annonces.*', 'photos.nom', 'users.username')
         ->groupBy('annonces.id')
         ->orderBy('annonces.created_at', 'desc')
         ->get();

         return view('resultat')->with('annonce', $annonce);
    }

    /**
     * Show the form for creating a new resource.
     * @param  array $request requete de ouf.
     * @return Response
     */
    public function create(Request $request)
    {
        if (Auth::check()) {
            $rules = [
                'titre' => 'required|min:4|alpha_dash',
                'description' => 'required',
                'prix' => 'required|integer',
            ];

            $validator = $this->validate($request, $rules);

            $input = Input::all();
            
            if ($input['image'][0] != null) {
                $input['user_id'] = Auth::user()->id;
                Annonce::create($input);
                $annonce_id = DB::getPdo()->lastInsertId();
                
                foreach ($input['image'] as $value) {
                    DB::table('photos')->insertGetId(
                        array(
                        'user_id' => $input['user_id'],
                        'annonce_id' => $annonce_id,
                        'nom' => $value->getClientOriginalName()
                        )
                    );
                    
                    $value->move(__DIR__.'../../../../storage/'.Auth::user()->id.'/'.$annonce_id, $value->getClientOriginalName());
                }
                return redirect('accueil')->with('message', 'Votre annonce a bien été publier.');
            } else {
                return redirect('/add')->with('message', 'Veuillez selectionner une image minimum pour illustrer votre annonce.');
            }
        }
    }

    /**
     * Display a search annonce
     * @param  int $id de lannonce
     * @return Response
     */
    public function delete($id)
    {
        if (Auth::check()) {
            DB::table('annonces')
                ->where(
                    array(
                    'id' => $id,
                    'user_id' => Auth::User()->id,
                    'activate' => 1)
                )
                ->update(array('activate' => 0));

            return redirect('accueil')->with('message', 'Votre annonce a bien été supprimer.');
        }
    }

    /**
     * Display the specified resource.
     * @param  int $id id de lannonce
     * @return Response 
     */
    public function show($id)
    {
        $annonce_infos = DB::table('annonces')
         ->Join('users', 'users.id', '=', 'annonces.user_id')
         ->where(
             array(
             'annonces.activate' => 1,
             'annonces.id' => $id)
         )
         ->select('annonces.*', 'users.username')
         ->get();

        $annonce_photo = DB::table('photos')
         ->Join('users', 'users.id', '=', 'photos.user_id')
         ->Join('annonces', 'annonces.id', '=', 'photos.annonce_id')
         ->where(
             array(
             'annonces.activate' => 1,
             'annonces.id' => $id)
         )
         ->select('photos.nom')
         ->get();
        
        return view('annonce')->with(
            array(
                                    'annonce_infos' => $annonce_infos,
                                    'annonce_photo' => $annonce_photo)
        );
    }
}
