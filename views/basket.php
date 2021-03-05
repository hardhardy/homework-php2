<h2>Корзина</h2>

<?php if (!empty($basket)): ?>
    <?php foreach ($basket as $item): ?>
        <div>
            <h2><?= $item['name'] ?></h2>
            <p>Описание: <?= $item['description'] ?></p>
            <p>Цена:<?= $item['price'] ?></p>

            <button>Удалить</button>
        </div>
    <? endforeach; ?>
<?php else: ?>
    Корзина пуста
<?php endif; ?>