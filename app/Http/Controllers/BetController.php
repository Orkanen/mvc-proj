<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Bets;
use Illuminate\Support\Facades\Validator;

class BetController extends Controller
{
    public function index() {
        $currency = Bets::all('currency')->first();

        return view('bets', [
            'currency' => $currency,
        ]);
    }

    public function setCurrency() {
        $currency = Bets::updateOrCreate([
            'currency' => 100,
            'betAmount' => 0,
        ]);
        $currency->save();
    }

    public function updateBetAmount(Request $request) {
        $funds = Bets::all('currency')->first();
        $id = Bets::all('id')->first();

        if ($request->betAmount < $funds->currency) {
            $updateBet = Bets::find($id->id);
            $updateBet->betAmount = $request->betAmount;
            $updateBet->save();
            $message = $request->betAmount . " Bet amount updated";
        } else {
            $message = $request->betAmount . " Insufficent Funds";
        }
        /*
        return view('setbets', [
            'betAmount' => $message,
            'currency' => $funds,
        ]);
        */
        return redirect()->to('/bets');
    }

    public function updateBet() {
        $id = Bets::all('id')->first();
        $updateBet = Bets::find($id->id);
        $betAmount = $updateBet->betAmount;
        $currency = $updateBet->currency;

        return view('setbets', [
            'currency' => $currency,
            'betAmount' => $betAmount,
        ]);
    }
}
