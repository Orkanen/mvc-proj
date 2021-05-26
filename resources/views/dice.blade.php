<link rel="stylesheet" type="text/css" href="{{ url('/css/style.css') }}" />
<div class="header">
    <h1>Bet-more</h1>
</div>
<div class="container">
  <div class="info-box">
      <?php if(isset($roundsPlayed)) { ?>
          <div class="info-content"><h3>Rounds Played:</h3></div>
          {{ $roundsPlayed ?? null }}
      <?php } ?>

      <?php if(isset($currentScore)) { ?>
          <div class="info-content"><h3>Current Score:</h3></div>
          <h2>{{ $currentScore ?? null }}</h2>
      <?php } ?>

      <?php if(isset($message)) { ?>
          <div class="info-content"><h3>You rolled:</h3></div>
          <div class="dice-utf8">
              <i class="<?php echo $message ?>"></i>
              <?php if(isset($message2)) { ?>
                  <i class="<?php echo $message2 ?>"></i>
              <?php } ?>
          </div>
      <?php } ?>

      <?php if(isset($roboRoll)) { ?>
          <div class="info-content"><h3>The robot rolled:</h3></div>
          <h2>{{ $roboRoll ?? null }}</h2>
      <?php } ?>

      <!--<p>{{ json_encode($previousRoll ?? null, TRUE) }}</p>-->
      <div class="info-content"><h3>Current Total:</h3></div>
      <h2 class="roll-info">{{ $previousRoll ?? null }}</h2>
  </div>
  <div class="form-box">
      <form class="dice-utf8" action="{{url('/dice/roll')}}" method="post">
          @csrf
          <input type="hidden" name="title" value=<?php echo $message ?>>
          <div class="inside-form">
              <input type="radio" name="amount" value="dice1" checked>
              <h3> Roll one die.</h3>
              <i class="dice-1"></i>
          </div>
          <div class="inside-form">
              <input type="radio" name="amount" value="dice2">
              <h3>Roll two dice.</h3>
              <i class="dice-1"></i> <i class="dice-2"></i>
          </div>
          <div class="inside-form">
              <input type="radio" name="amount" value="stop"> <h3> Hold </h3>
          </div>
          <input class="button" type="submit" value="Roll">
      </form>
  </div>
</div>
<?php $url = Request::url(); ?>
<div class="nav-bar">
<a class="active" href="<?php $url ?>/dice"> Dice </a>

<a href="<?php $url ?>/bets"> Bet </a>

<a href="<?php $url ?>/score"> Highscore </a>
<div class="funds">
    <?php if(isset($funds)) { ?>
        <p>Current funds:</p>
        <p>{{ $funds ?? null }} € |</p>
    <?php } ?>
    <?php if(isset($betAmount)) { ?>
        <p>Bet amount:</p>
        <p>{{ $betAmount ?? null }} € </p>
    <?php } ?>
</div>
</div>
