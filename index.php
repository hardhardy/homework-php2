<?php

class Furniture
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

  function view_furniture()
  {
    echo "<p>Артикул: $this->article</p><h1>$this->title</h1><p>Размеры: $this->width" . "x" ."$this->height" . "x" ."$this->depth<br /></p><p>Цвет: $this->color</p>";
  }
}

class Table extends Furniture {

}
class Сhair extends Furniture {
  public $color;
  function __construct($article, $title, $width, $height, $depth, $color, $trim) {
      parent::__construct($article, $title, $width, $height, $depth, $color);
    $this->trim = $trim;
  }
  function view_trim()
  {
    echo "<p>Артикул: $this->article</p><h1>$this->title</h1><p>Размеры: $this->width" . "x" ."$this->height" . "x" ."$this->depth<br /></p><p>Цвет: $this->color</p><p>Обивка: $this->trim</p>";
  }
}


$table1 = new Table(0000001, "Писменный стол", 60, 120, 60, "Белый");
$table2 = new Table(0000002, "Журнальный стол", 60, 60, 60, "Коричневый");
$сhair1 = new Сhair(0000003, "Кухонный табурет", 100, 43, 48, "тон №1 белый", "ткань, тон №56");

class A {
  public function foo() {
    static $x = 0;
    echo ++$x;
  }
}
$a1 = new A();
$a2 = new A();
$a3 = new A();

class B {
  public function foo2() {
    static $x = 0;
    echo ++$x;
  }
}
class C extends B {
}
$b1 = new B();
$c1 = new C();

?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
</head>
<body>
<?= $table1->view_furniture(); ?>
<hr>
<?= $table2->view_furniture(); ?>
<hr>
<?= $сhair1->view_trim(); ?>
<hr>
<?=
$a1->foo();
$a2->foo();
$a1->foo();
$a2->foo();
?> - потому что $x статична и в данном случае не имеет значения каким экземпляром класса вызывается -
<?php
$a3 = new A();
$a3->foo();
$a3->foo();
$a3->foo();
$a3->foo();
?>
<br>
<?=
$b1->foo2();
$c1->foo2();
$b1->foo2();
$c1->foo2();
?> - потому что $x статична, указывает на родительский класс и у наследников
</body>
</html>