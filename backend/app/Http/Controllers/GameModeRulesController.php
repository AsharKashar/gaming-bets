<?php


namespace App\Http\Controllers;


use App\Model\GameMode;
use App\Model\GameModeRules;
use Illuminate\Http\Request;

class GameModeRulesController extends Controller
{
    public function index(GameMode $gameMode)
    {
        return $this->successApiResponse($gameMode->rules()->with('locale')->get());
    }

    public function store(GameMode $gameMode, Request $request)
    {
        $this->validate(
            $request->all(),
            [
                'locale_id' => ['required', 'exists:locales,id'],
                'data' => ['required'],
            ]
        );
        $data = $request->all();
        $data['game_mode_id'] = $gameMode->id;

        return $this->successApiResponse(GameModeRules::create($data));
    }

    public function update($gameMode, $id, Request $request)
    {
        $this->validate(
            $request->all(),
            [
                'data' => 'array',
            ]
        );
        return $this->successApiResponse(GameModeRules::find($id)->update(['data' => $request->input('data')]));
    }

    public function destroy($gameMode, $id)
    {
        return $this->successApiResponse(GameModeRules::find($id)->delete());
    }
}
