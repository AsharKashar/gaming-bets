<?php

namespace App\Http\Controllers;

use App\Model\BoxMatchRule;
use Illuminate\Http\Request;

class BoxMatchRuleController extends Controller
{
    //
    /**
     * @OA\Post(
     *     path="/api/box-match-rules/get-game-rule",
     *     tags={"Box-Match-Rules"},
     * @OA\Parameter(
     *     name="game_id",
     *     in="query",
     *     description="Game ID for which box match rules are needed, 1 for fortnite, 2 for Call of duty etc",
     *     required=true,
     * ),
     *     @OA\Response(response="200", description="Get box match rules for a game")
     * )
     */
    public function getRules(request $request)
    {
        $this->validate(
            $request->all(),
            [
                'game_id' => ['required', 'numeric'],
            ]
        );
        $rules = BoxMatchRule::getGameRule($request->game_id);
        foreach($rules as $key => $rule)
        {
            $rules[$key]['rule'] = json_decode($rule->rule, true);
        }
        return response()->json(['Rules' => $rules]);
    }


    public function create(request $request)
    {
        $this->validate(
            $request->all(),
            [
                'game_id' => ['required', 'numeric'],
                'rules' => ['required'],
            ]
        );

        foreach ($request->rules as $rule) {
            $data = new BoxMatchRule();
            $data->game_id = $request->game_id;
            $data->rule = $rule;
            $data->save();
        }
        return response()->json(
            [
                'success' => true,
                'message' => 'Rules added',
            ]
        );
    }


    public function update(request $request, $id)
    {
        $this->validate(
            $request->all(),
            [
                'game_id' => ['required', 'numeric'],
                'rule' => ['required'],
            ]
        );
        $data = BoxMatchRule::find($id);
        if (!$data) {
            return response()->json(['error' => 'Rule does not exist.'], 400);
        }
        $data->game_id = $request->game_id;
        $data->rule = $request->rule;
        $data->save();

        return response()->json(
            [
                'success' => true,
                'message' => 'Rule updated',
            ]
        );
    }


    public function delete($id)
    {
        $data = BoxMatchRule::find($id);
        if (!$data) {
            return response()->json(['error' => 'Rule does not exist.'], 400);
        }
        $data->delete();
        return response()->json(
            [
                'success' => true,
                'message' => 'Rule deleted',
            ]
        );
    }
}
