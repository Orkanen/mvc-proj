<?php
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

use App\Models\Dice;
use App\Models\DiceHand;
use App\Models\DiceGraphic;
use App\Models\Game;
use App\Models\Rounds;
use App\Models\Bets;

class DiceController extends Controller
{
    /**
     * Display a message.
     *
     * @param  string  $message
     * @return \Illuminate\View\View
     */
    public function index()
    {
        //session()->forget('key', 'die', 'dice', 'diceHand');
        if ($this->notEnoughFunds()) {
            return redirect()->to('/bets');
        } else {
            $die = new Dice();
            $dice = new DiceGraphic();
            $diceHand = new DiceHand(1);
            $game = new Game();
            $id = Bets::all('id')->first();
            $updateBet = Bets::find($id->id);
            $betAmount = $updateBet->betAmount;
            $funds = $updateBet->currency;

            session(['die' => serialize($die),
                'dice' => serialize($dice),
                'diceHand' => serialize($diceHand),
                'game' => serialize($game)
            ]);
            return view('dice', [
                'message' => $message ?? "0",
                'funds' => $funds ?? "0",
                'betAmount' => $betAmount ?? null,
            ]);
        }
    }

    public function postIndex(Request $request)
    {
      if ($this->notEnoughFunds()) {
          return redirect()->to('/bets');
      } else {
          $die = unserialize(session()->pull('die'));
          $dice = unserialize(session()->pull('dice'));
          $diceHand = unserialize(session()->pull('diceHand'));
          $game = unserialize(session()->pull('game'));
          $id = Bets::all('id')->first();
          $updateBet = Bets::find($id->id);
          $betAmount = $updateBet->betAmount;
          $funds = $updateBet->currency;
          //$previousRoll = $diceHand->getSum();
          if ($request->amount == "stop") {
              $game->curRoll($diceHand->getRollSum());
              $robotRolled = $game->roboSum();
              if ($robotRolled < 22 && $robotRolled > $diceHand->getRollSum()) {
                  $previousRoll = "You Lose";
                  $this->removeCurrency($betAmount);
                  $game->score(0, 1);
              } else {
                  $previousRoll = "You Win";
                  $this->addCurrency($betAmount);
                  $game->score(1, 0);
              }
              $game->addRound();
              $diceHand->setRollSum();
          } else {
              if ($request->amount == "dice1") {
                  $diceHand->createDice();
                  $diceHand->roll();
                  $validated = $diceHand->printRoll()[0];
              } else {
                  $diceHand->createDice(1);
                  $diceHand->roll();
                  $validated = $diceHand->printRoll()[0];
                  $validated2 = $diceHand->printRoll()[1];
              }
              $previousRoll = $diceHand->getRollSum();

              if ($previousRoll > 21) {
                  $previousRoll = "You Lose";
                  $this->removeCurrency($betAmount);
                  $game->score(0, 1);
                  $diceHand->setRollSum();
                  $game->addRound();
              } elseif ($previousRoll == 21) {
                  $previousRoll = "You Win";
                  $this->addCurrency($betAmount);
                  $game->score(1, 0);
                  $diceHand->setRollSum();
                  $game->addRound();
              }
          }
          $currentScore = $game->score(0, 0);
          $gamePlayed = $game->rolledGame();

          session()->put('die', serialize($die));
          session()->put('dice', serialize($dice));
          session()->put('diceHand', serialize($diceHand));
          session()->put('game', serialize($game));
          session()->save();
          $fullScore = ($game->humanScore() - $game->roboScore());

          $roundsDb = Rounds::find(1);
          if ($roundsDb == null) {
              $roundsDb = Rounds::where('id', 1)->updateOrCreate([
                  'rounds' => $currentScore,
                  'score' => $fullScore,
              ]);
          } else if ($roundsDb->score <= $fullScore) {
              $roundsDb->rounds = $currentScore;
              $roundsDb->score = $fullScore;
          }
          $roundsDb->save();

          return view('dice', [
              'message' => $validated ?? null,
              'message2' => $validated2 ?? null,
              'previousRoll' => $previousRoll ?? null,
              'roboRoll' => $robotRolled ?? null,
              'gamePlayed' => $gamePlayed ?? null,
              'currentScore' => $currentScore ?? null,
              'funds' => $funds ?? null,
              'betAmount' => $betAmount ?? null,
          ]);
        }
    }

    public function highScore() {

        $rounds = Rounds::find(1);

        return view('message', [
            'rounds' => $rounds,
        ]);
    }

    public function notEnoughFunds() {
        $id = Bets::all('id')->first();
        $updateBet = Bets::find($id->id);
        $betAmount = $updateBet->betAmount;
        $funds = $updateBet->currency;
        return ($funds < $betAmount);
    }

    public function removeCurrency($bet) {
        $id = Bets::all('id')->first();
        $updateBet = Bets::find($id->id);
        $newAmount = $updateBet->currency - $bet;
        $updateBet->currency = $newAmount;
        $updateBet->save();
    }

    public function addCurrency($bet) {
        $id = Bets::all('id')->first();
        $updateBet = Bets::find($id->id);
        $newAmount = $updateBet->currency + $bet;
        $updateBet->currency = $newAmount;
        $updateBet->save();
    }
}
