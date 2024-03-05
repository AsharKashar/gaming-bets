<?php


namespace App\Http\Controllers;


use App\Model\Locale;
use App\Model\TournamentOptions;
use Illuminate\Http\Request;

class TournamentOptionsController extends Controller
{

    public function getTournamentOptionsByType(Request $request){
        return $this->successApiResponse(TournamentOptions::where('type', $request->input('type'))->with('locale')->get());
    }

    public function store(Request $request)
    {
        $this->validate(
            $request->all(),
            [
                'locale_id' => ['exists:locales,id'],
                'type' => ['required'],
                'data' => ['required'],
                'tournament_id' => ['required', 'exists:tournaments,id'],
            ]
        );
        $data = $request->all();
        if (!isset($data['locale_id'])) {
            $data['locale_id'] = Locale::firstWhere('code', 'en')->id;
        }

        return $this->successApiResponse(TournamentOptions::create($data));
    }

    public function update($id, Request $request)
    {
        $this->validate(
            $request->all(),
            [
                'data' => ['array'],
            ]
        );
        return $this->successApiResponse(TournamentOptions::find($id)->update(['data' => $request->input('data')]));
    }

    public function destroy($id)
    {
        return $this->successApiResponse(TournamentOptions::find($id)->delete());
    }
}
