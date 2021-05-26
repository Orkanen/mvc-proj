<?php if(isset($currency)) { ?>
    <p>FUNDS:</p>
    {{ $currency ?? null }}
<?php } ?>

<?php if(isset($betAmount)) { ?>
    <p>BET:</p>
    {{ $betAmount ?? null }}
<?php } ?>

<form action="{{url('/make/bet')}}" method="post">
    @csrf
    <input type="number" name="betAmount">
    <input type="submit" value="Make bet">
</form>

</br>

<a href="dice"> Dice | </a>

<a href="bets"> Bet | </a>

<a href="score"> Highscore </a>
