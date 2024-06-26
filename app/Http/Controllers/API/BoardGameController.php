<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreBoardGameRequest;
use App\Http\Requests\UpdateBoardGameRequest;
use App\Models\BoardGame;
use Illuminate\Http\Request;

class BoardGameController extends Controller
{
    /**
     * Display a listing of the board games.
     */
    public function index()
    {
        $board_games = BoardGame::all();
        return response()->json($board_games, 200);
    }

    /**
     * Store a newly created board game in storage.
     */
    public function store(StoreBoardGameRequest $request)
    {
        $board_game = new BoardGame();
        $board_game->fill($request->all());
        $board_game->save();
        return response()->json($board_game, 201);
    }

    /**
     * Display the specified board game.
     */
    public function show(string $id)
    {
        $board_game = BoardGame::find($id);
        if(is_null($board_game)){
            return response()->json(["message" => "Board game not found with id: $id"], 404);
        }
        return $board_game;
    }

    /**
     * Update the specified board game in storage.
     */
    public function update(UpdateBoardGameRequest $request, string $id)
    {
        $board_game = BoardGame::find($id);
        if(is_null($board_game)){
            return response()->json(["message" => "Board game not found with id: $id"], 404);
        }
        $board_game->fill($request->all());
        $board_game->save();
        return $board_game;
    }

    /**
     * Remove the specified board game from storage.
     */
    public function destroy(string $id)
    {
        $board_game = BoardGame::find($id);
        if(is_null($board_game)){
            return response()->json(["message" => "Board game not found with id: $id"], 404);
        }
        $board_game->delete();
        return response()->noContent();
    }
}
