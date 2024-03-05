<?php


namespace App\Admin\Controllers;


use App\Http\Controllers\Controller;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Layout\Content;
use App\Model\GlobalOptions;
use Illuminate\Http\Request;


/**
 * Class TournamentOptionsController
 * @package App\Admin\Controllers
 */
class GlobalOptionsController extends Controller
{
    public function index()
    {
        $content = new Content();

        return $content->header('Global Options')
            ->view('admin/form.app', ['components' => ['global-options'], 'data' => GlobalOptions::all()]);
    }

    public function show() {
        return $this->successApiResponse(GlobalOptions::all());
    }

    public function store(Request $request)
    {
        return $this->successApiResponse(GlobalOptions::create([
            'type' => $request->input('type'),
            'group' => $request->input('group'),
            'fields' => $request->input('fields') ?? [],
        ]));
    }

    public function update($id, Request $request)
    {
        return $this->successApiResponse(GlobalOptions::find($id)->update([
            'fields' => $request->input('fields') ?? [],
        ]));
    }

    public function destroy($id)
    {
        return $this->successApiResponse(GlobalOptions::find($id)->delete());
    }
}
