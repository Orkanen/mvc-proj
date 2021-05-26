<?php if(isset($roundsPlayed)) { ?>
    <p>Rounds Played:</p>
    {{ $roundsPlayed ?? null }}
<?php } ?>

<?php if(isset($currentScore)) { ?>
    <p>Current Score:</p>
    {{ $currentScore ?? null }}
<?php } ?>


<?php if(isset($message)) { ?>
    <p>You rolled:</p>
    {{ $message ?? null }}
<?php } ?>

<?php if(isset($roboRoll)) { ?>
    <p>The robot rolled:</p>
    {{ $roboRoll ?? null }}
<?php } ?>

<!--<p>{{ json_encode($previousRoll ?? null, TRUE) }}</p>-->
<p>Current Total:</p>
{{ $previousRoll ?? null }}


<form action="{{url('/dice/roll')}}" method="post">
    @csrf
    <input type="hidden" name="title" value=<?php echo $message ?>>
    <input type="radio" name="amount" value="dice1" checked> Roll 1 dice<br>
    <input type="radio" name="amount" value="dice2"> Roll 2 dice <br>
    <input type="radio" name="amount" value="stop"> Hold <br>
    <input type="submit" value="Roll">
</form>

<?php if(isset($funds)) { ?>
    <p>Current funds:</p>
    {{ $funds ?? null }}
<?php } ?>

<?php if(isset($betAmount)) { ?>
    <p>Bet amount:</p>
    {{ $betAmount ?? null }}
<?php } ?>

</br>
<?php $url = Request::url(); ?>
<a href="<?php $url ?>/dice"> Dice | </a>

<a href="<?php $url ?>/bets"> Bet | </a>

<a href="<?php $url ?>/score"> Highscore </a>
