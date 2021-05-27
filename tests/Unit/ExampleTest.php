<?php

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;

use App\Models\Dice;
use App\Models\DiceHand;
use App\Models\DiceGraphic;
use App\Models\Game;
use App\Models\Rounds;

class ExampleTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function test_example()
    {
      	$dice = new Dice();
      	$dice->roll();
        $this->assertGreaterThan(0, $dice->getLastRoll());
    }

    public function test_example2()
    {
      	$dice = new Dice();
        $res = $dice->getFaces();
        $dice->setFaces(3);
        $res2 = $dice->getFaces();
        $this->assertLessThan($res, $res2);
    }

    public function test_DiceGraphic()
    {
        $dice = new Dice();
        $diceG = new DiceGraphic();
        $dice->roll();
        $res = $diceG->graphic();
        $this->assertIsString($res);
    }

    public function test_DiceHand_Construct()
    {
        $diceH = new DiceHand();
        $res = $diceH->dices;
        $this->assertIsArray($res);
    }

    public function test_DiceHand_CreateDice()
    {
        $diceH = new DiceHand();
        $diceH->createDice();
        $res = $diceH->dices;
        $this->assertEquals(2, count($res));
        $diceH->createDice(4);
        $res2 = $diceH->dices;
        $this->assertEquals(5, count($res2));
    }

    public function test_DiceHand_Roll()
    {
        $diceH = new DiceHand();
        $firstRoll = $diceH->getRollSum();
        $this->assertEquals(0, $firstRoll);
        $diceH->roll();
        $getLastRoll = $diceH->getLastRoll();
        $this->assertIsString($getLastRoll);
        $getRollSum = $diceH->getRollSum();
        $getSum = $diceH->getSum();
        $this->assertEquals($getRollSum, $getSum);
        $print = $diceH->printRoll();
        $this->assertIsArray($print);
    }

    public function test_Game()
    {
        $game = new Game();
        $noRoll = $game->roboSum();
        $this->assertEquals(0, $noRoll);
        $game->roboRoll();
        $firstRoll = $game->roboSum();
        $this->assertGreaterThan($noRoll, $firstRoll);
        $human = 21;
        $game->curRoll($human);
        $secondRoll = $game->roboSum();
        $this->assertGreaterThan($human, $secondRoll);
        $this->assertEquals(0, $game->rolledGame());
        $game->addRound();
        $this->assertEquals(1, $game->rolledGame());
        $final = $game->score(1, 2);
        $final2 = "Human Score: 1/ Computer Score: 2";
        $this->assertEquals($final, $final2);
        $this->assertEquals(2, $game->roboScore());
        $this->assertEquals(1, $game->humanScore());
    }
}
