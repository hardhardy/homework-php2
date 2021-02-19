<?php

class Table
{
  public $article;
  public $title;
  public $width;
  public $height;
  public $depth;
  public $color;

  function __construct($article, $title, $width, $height, $depth, $color)
  {
    $this->article = $article;
    $this->title = $title;
    $this->width = $width;
    $this->height = $height;
    $this->depth = $depth;
    $this->color = $color;
  }

  function view()
  {
    echo "<p>Артикул: $this->article</p><h1>$this->title</h1><p>Ширина: $this->width<br />Высота: $this->height<br />Глубина: $this->depth<br /></p><p>Цвет: $this->color</p>";
  }
}

$table1 = new Table(0000001, "Писменный стол", 60, 120, 60, "Белый");

?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
</head>
<body>

<?= $table1->view(); ?>

</body>
</html>