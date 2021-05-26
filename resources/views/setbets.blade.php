<meta charset="utf-8">
<link rel="stylesheet" type="text/css" href="{{ url('/css/style.css') }}" />
<div class="header">
    <h1>Bet-more</h1>
</div>
<div class="container">
    <div class="info-box">
        <?php if(isset($currency)) { ?>
            <div class="info-content"><h3>FUNDS:</h3></div>
            <h2>{{ $currency ?? null }}</h2>
        <?php } ?>

        <?php if(isset($betAmount)) { ?>
            <div class="info-content"><h3>BET:</h3></div>
            <h2>{{ $betAmount ?? null }}</h2>
        <?php } ?>
    </div>
    <div class="form-box">
        <form action="{{url('/make/bet')}}" method="post">
            @csrf
            <br>
            <input class="number-wrap" type="number" name="betAmount" value="0" min="0">
            <br>
            <br>
            <input class="button" type="submit" value="Make bet">
        </form>
    </div>
</div>

<div class="nav-bar">
    <a href="dice"> Dice </a>

    <a class="active" href="bets"> Bet </a>

    <a href="score"> Highscore </a>

    <div class="funds">
        <?php if(isset($currency)) { ?>
            <p>Current funds:</p>
            <p>{{ $currency ?? null }} € |</p>
        <?php } ?>
        <?php if(isset($betAmount)) { ?>
            <p>Bet amount:</p>
            <p>{{ $betAmount ?? null }} € </p>
        <?php } ?>
    </div>
</div>
