<?php
declare(strict_types=1);
namespace App\Http\Controllers\Api;

use App\Http\Requests\AboutRequest;
use App\Models\About;
use App\Http\Controllers\Controller;
class AboutController extends Controller
{
    private About $about;

    public function __construct(About $about)
    {
        $this->about = $about;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request\AboutRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AboutRequest $request)
    {
        $validated = $request->validate([
            'companyName' => ['required', 'string', 'max:255'],
            'companyName_kana' => ['required', 'string', 'max:255'],
            'address' => ['required', 'string', 'max:255'],
            'phoneNumber' => ['required', 'string', 'max:255'],
            'name' => ['required', 'string', 'max:255'],
            'name_kana' => ['required', 'string', 'max:255'],
        ]);
        $this->about->fill($validated)->save();
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
        $about = $this->about->findOrFail($id);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request\AboutRequest $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(AboutRequest $request, $id)
    {
        $validated = $request->validate([
            'companyName' => ['required', 'string', 'max:255'],
            'companyName_kana' => ['required', 'string', 'max:255'],
            'address' => ['required', 'string', 'max:255'],
            'phoneNumber' => ['required', 'string', 'max:255'],
            'name' => ['required', 'string', 'max:255'],
            'name_kana' => ['required', 'string', 'max:255'],
        ]);
        $this->about->findOrFail($id)->update($validated);
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
        $this->about->findOrFail($id)->delete();
        return ['message' => 'Complete'];
    }
}
