<?php if (count($tabella_vendite) > 0): ?>

    <div class="tabella_vendite">
      <?php foreach ($tabella_vendite as $tabella_vendite): ?>
        <p><?php echo$tabella_vendite; ?></p>
      <?php endforeach ?>
    </div>
<?php endif ?>
