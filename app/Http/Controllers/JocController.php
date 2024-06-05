<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class JocController extends Controller
{
    protected $choices = ['rock', 'paper', 'scissors'];
    protected $rules = [
        'rock' => ['scissors'],
        'paper' => ['rock'],
        'scissors' => ['paper'],
    ];

    public function play(Request $request)
    {
        // Validar la entrada
        $request->validate([
            'choice' => 'required|in:rock,paper,scissors'
        ]);

        // Obtener la elección del usuario
        $userChoice = strtolower($request->input('choice'));

        // Generar la elección de la computadora
        $computerChoice = $this->choices[array_rand($this->choices)];
        $result = $this->determineResult($userChoice, $computerChoice);

        // Construir la respuesta
        return response()->json([
            'user_choice' => $userChoice,
            'computer_choice' => $computerChoice,
            'result' => $result
        ]);
    }

    protected function determineResult($userChoice, $computerChoice)
    {
        if ($userChoice === $computerChoice) {
            return 'draw';
        }

        if (in_array($computerChoice, $this->rules[$userChoice])) {
            return 'win';
        }
        return 'lose';
    }
}