<?php

namespace laract\Http\Controllers;

use Illuminate\Http\Request;
use laract\Player;

class PlayersController extends Controller
{

    public function index()
    {
        return Player::all();
    }

    public function show(Player $player)
    {
        return $player;
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => 'required|unique:players|max:255',
            /*'description' => 'required',
            'price' => 'integer',
            'availability' => 'boolean',*/
        ]);
        $player = Player::create($request->all());

        return response()->json($player, 201);
    }

    public function update(Request $request, Player $player)
    {
        $player->update($request->all());

        return response()->json($player, 200);
    }

    public function delete(Player $player)
    {
        $player->delete();

        return response()->json(null, 204);
    }

}