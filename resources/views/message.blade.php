<link rel="stylesheet" type="text/css" href="{{ url('/css/style.css') }}" />
<div class="header">
    <h1>Bet-more</h1>
</div>
<div class="container">
    <div class="info-box">
        <?php if(isset($message)) { ?>
          <p>The message is:</p>

          <p>{{ $message }}</p>
        <?php } ?>

        <?php if(isset($rounds)) { ?>
            <div class="info-content"><h3>Highscore:</h3></div>
            <h2>{{ $rounds->score ?? null }}</h2>
            <div class="info-content"><h3>{{ $rounds->rounds ?? null }}</h3></div>
        <?php } ?>
    </div>
</div>
    <?php $url = Request::url(); ?>
<div class="nav-bar">
    <a href="dice"> Dice </a>

    <a href="bets"> Bet </a>

    <a class="active" href="score"> Highscore </a>
</div>
