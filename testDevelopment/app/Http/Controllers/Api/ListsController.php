<?php
declare(strict_types=1);
namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Models\About;
use App\Models\Claim;
use App\Http\Controllers\Controller;
class ListsController extends Controller
{
    /**
    * constructor function
    * @param About $about
    * @param Claim $claim
    */
    public function __construct(About $about, Claim $claim)
    {
        $this->about = $about;
        $this->claim = $claim;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        $abouts = $this->about->orderby('updated_at', 'desc')->paginate(5);
        $claims = $this->claim->orderby('updated_at', 'desc')->paginate(5);
        return ['message' => 'OK'];
    }
}
