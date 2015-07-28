<?php 

/**
 * Annonce class file Doc Comment
 *
 * @category Annonce
 * @package  Annonce
 * @author   Mouhoussoune Nair <naer.mouhoussoune@epitech.eu>
 * @license  http://www.gnu.org/copyleft/gpl.html GNU General Public License
 * @link     http://example.com/
 */

namespace freeads;

use Illuminate\Database\Eloquent\Model;

/**
 * Annonce class Doc Comment
 *
 * The class holding the root Annonce class definition
 *
 * @category Annonce
 * @package  Annonce
 * @author   Mouhoussoune Nair <naer.mouhoussoune@epitech.eu>
 * @license  http://www.gnu.org/copyleft/gpl.html GNU General Public License
 * @link     http://example.com/
 */

class Annonce extends Model
{
    protected $guarded = [];//

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'annonces';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['titre', 'description', 'prix', 'user_id', 'categorie', ];

}
