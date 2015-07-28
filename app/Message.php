<?php 

/**
 * Message class file Doc Comment
 *
 * @category Message
 * @package  Message
 * @author   Mouhoussoune Nair <naer.mouhoussoune@epitech.eu>
 * @license  http://www.gnu.org/copyleft/gpl.html GNU General Public License
 * @link     http://example.com/
 */

namespace freeads;

use Illuminate\Database\Eloquent\Model;

/**
 * Message class Doc Comment
 *
 * The class holding the root Message class definition
 *
 * @category Message
 * @package  Message
 * @author   Mouhoussoune Nair <naer.mouhoussoune@epitech.eu>
 * @license  http://www.gnu.org/copyleft/gpl.html GNU General Public License
 * @link     http://example.com/
 */

class Message extends Model
{

    protected $guarded = [];//

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'messages';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['object', 'content', 'user_id_sender', 'user_id_receiver', ];//
}
