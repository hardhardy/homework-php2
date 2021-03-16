<h2>Корзина</h2>

<?php if (!empty($basket)): ?>
<table style="min-width: 500px;">
  <tr>
      <th style="text-align: left;">Наименование</th>
      <th style="text-align: left;">Описание</th>
      <th>Цена</th>
      <th></th>
  </tr>
    <?php foreach ($basket as $item): ?>
        <tr id="<?= $item['basket_id'] ?>">
            <td><h2><?= $item['name'] ?></h2></td>
            <td><p><?= $item['description'] ?></p></td>
            <td style="text-align: center;"><p><?= $item['price'] ?></p></td>
            <td><button data-id="<?= $item['basket_id'] ?>" class="delete">Удалить</button></td>
        </tr>
    <? endforeach; ?>
</table>
Общая стоимость: <span id="summ"><?=$summ?>
    <h2>Оформите заказ</h2>
    <form action="?action=order" method="post">
        <input placeholder="Ваше имя" type="text" name="name">
        <input placeholder="Телефон" type="text" name="phone">
        <input placeholder="Адрес доставки" type="text" name="adres">
        <button data-id="<?= $item['basket_id'] ?>" class="order">Оформить заказ</button>
    </form>
<?php else: ?>
    Корзина пуста
<?php endif; ?>

<script>
    let buttons = document.querySelectorAll('.delete');
    buttons.forEach((elem) => {
        elem.addEventListener('click', () => {
            let id = elem.getAttribute('data-id');
            (
                async () => {
                    const response = await fetch('/basket/delete', {
                        method: 'POST',
                        headers: {'Content-Type': 'application/json;charset=utf-8'},
                        body: JSON.stringify({
                            id: id
                        })
                    });
                    const answer = await response.json();
                    document.getElementById('count').innerText = answer.count;
                    document.getElementById(id).remove();
                }
            )();
        })
    });
</script>
