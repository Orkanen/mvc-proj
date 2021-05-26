<?php if(isset($message)) { ?>
  <p>The message is:</p>

  <p>{{ $message }}</p>
<?php } ?>

<?php if(isset($rounds)) { ?>
    <p>Highscore:</p>
    <p>{{ $rounds->score ?? null }}</p>
    <p>{{ $rounds->rounds ?? null }}</p>
<?php } ?>
<?php
$url = Request::url();
?>
<a href="dice"> Dice | </a>

<a href="pizzas"> ORM Pizza | </a>

<a href="pizzas/create"> Create Pizza | </a>

<a href="score"> Highscore </a>
