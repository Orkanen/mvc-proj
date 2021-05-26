{{ $currency->currency }}

<?php if(isset($currency)) { ?>
    <p>FUNDS:</p>
    {{ $currency ?? null }}
<?php } ?>


<?php if(isset($betAmount)) { ?>
    <p>Message:</p>
    {{ $betAmount ?? null }}
<?php } ?>
