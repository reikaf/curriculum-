<?php
declare(strict_types=1);
namespace App\Http\Controllers\Api;

use App\Http\Requests\ClaimRequest;
use App\Models\Claim;
use App\Models\About;
use App\Http\Controllers\Controller;
class ClaimController extends Controller
{
    /**
    * @var Claim
    * @var About
    */
    private Claim $claim;
    private About $about;

    /**
    * constructor function
    * @param Claim $claim
    * @param About $about
    */
    public function __construct(Claim $claim, About $about)
    {
        $this->claim = $claim;
        $this->about = $about;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request\ClaimRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function store(ClaimRequest $request,int $id)
    {
        $about = $this->about->findOrFail($id);
        $about->claim()->create($request->validated());;
        return ['message' => 'Complete'];
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return $this->claim->findOrFail($id);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request\ClaimRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ClaimRequest $request, $id)
    {
        $data = $this->claim->findOrFail($id);
        $data->update($request->validated());
        return ['message' => 'Complete'];
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->claim->findOrFail($id)->delete();
        return ['message' => 'Complete'];
    }
}
