<?php 

/**
 * MessagesController class file Doc Comment
 *
 * @category MessagesController
 * @package  MessagesController
 * @author   Mouhoussoune Nair <naer.mouhoussoune@epitech.eu>
 * @license  http://www.gnu.org/copyleft/gpl.html GNU General Public License
 * @link     http://example.com/
 */

namespace freeads\Http\Controllers;

use freeads\Http\Requests;
use freeads\Http\Controllers\Controller;
use freeads\User;
use freeads\Annonce;
use freeads\Message;
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
 * MessagesController class Doc Comment
 *
 * The class holding the root MessagesController class definition
 *
 * @category MessagesController
 * @package  MessagesController
 * @author   Mouhoussoune Nair <naer.mouhoussoune@epitech.eu>
 * @license  http://www.gnu.org/copyleft/gpl.html GNU General Public License
 * @link     http://example.com/
 */

class MessagesController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $msg = DB::table('messages')
         ->Join('users', 'users.id', '=', 'messages.user_id_sender')
         ->where(
             array(
             'messages.activate_receiver' => 1,
             'messages.user_id_receiver' => Auth::user()->id)
         )
         ->select('messages.*', 'users.username')
         ->orderBy('messages.created_at', 'desc')
         ->get();

        return view('msgrecu')->with('msg', $msg);
    }

    /**
     * Display a listing of the resource la deuxieme.
     *
     * @return Response
     */
    public function indexe()
    {
        $msg = DB::table('messages')
         ->Join('users', 'users.id', '=', 'messages.user_id_receiver')
         ->where(
             array(
             'messages.activate_sender' => 1,
             'messages.user_id_sender' => Auth::user()->id)
         )
         ->select('messages.*', 'users.username')
         ->orderBy('messages.created_at', 'desc')
         ->get();

        return view('msgenvoye')->with('msg', $msg);//
    }

    /**
     * Show the form for creating a new resource.
     * @param  int $id du message.
     * @return Response
     */
    public function create($id)
    {
        if (Auth::check()) {
            $input = Input::all();

            $input['user_id_sender'] = Auth::user()->id;
            $input['user_id_receiver'] = $id;
            
            Message::create($input);

            return redirect('accueil')->with('message', 'Votre message a bien été envoyer.');
        }
    }
}
