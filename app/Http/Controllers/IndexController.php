<?php 

/**
 * IndexController class file Doc Comment
 *
 * @category IndexController
 * @package  IndexController
 * @author   Mouhoussoune Nair <naer.mouhoussoune@epitech.eu>
 * @license  http://www.gnu.org/copyleft/gpl.html GNU General Public License
 * @link     http://example.com/
 */

namespace freeads\Http\Controllers;

use freeads\Http\Requests;
use freeads\Http\Controllers\Controller;

use Illuminate\Http\Request;

/**
 * IndexController class Doc Comment
 *
 * The class holding the root IndexController class definition
 *
 * @category IndexController
 * @package  IndexController
 * @author   Mouhoussoune Nair <naer.mouhoussoune@epitech.eu>
 * @license  http://www.gnu.org/copyleft/gpl.html GNU General Public License
 * @link     http://example.com/
 */

class IndexController extends Controller
{

    /**
     * Affichage page index.
     *
     * @return Response
     */
    public function showIndex()
    {
        return view('index');
    }
}
