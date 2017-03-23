<?php
  $biblio = new PDO('mysql:host=localhost; dbname=global; charset=utf8', '*******', '******');
  $biblio->query('SET NAMES utf8');
  $sql = "SELECT * FROM books WHERE isbn LIKE :isbn AND name LIKE :nameBook AND author LIKE :authorBook";
  $isbn = '';
  $nameBook = '';
  $authorBook = '';
  if (isset($_POST['isbn']) && !$_POST['isbn']=='') {
      $isbn = $_POST['isbn'];
  }
  if (isset($_POST['nameBook']) && !$_POST['nameBook']=='') {
      $nameBook = $_POST['nameBook'];
  }
  if (isset($_POST['authorBook']) && !$_POST['authorBook']=='') {
      $authorBook = $_POST['authorBook'];
  }
      $stm = $biblio->prepare($sql);
      $isbn1 = "%$isbn%";
      $namebook1 = "%$nameBook%";
      $authorBook1 = "%$authorBook%";
      $stm->execute(array ('isbn' => $isbn1, 'nameBook' => $namebook1, 'authorBook' => $authorBook1));
      $result = $stm->fetchAll();
?>
<!Doctype html>
<html>
<head>
  <link href="table.css" rel="stylesheet">
  <meta charset="utf-8">
  <title>Библиотека</title>
</head>
<h1> Библиотека успешного человека </h1>
<form method = 'POST'>
   <input type = 'text' name = 'isbn' value = "<?= $isbn ?>" placeholder = "ISBN">
   <input type = 'text' name = 'nameBook' value = "<?= $nameBook ?>" placeholder = "Название книги">
   <input type = 'text' name = 'authorBook' value = "<?= $authorBook ?>" placeholder = "Автор книги">
   <button type = 'submit'>Выбрать</button>
</form>
<br>
<table>
<tr>
  <th>Название</th>
  <th>Автор</th>
  <th>Год выпуска</th>
  <th>Жанр</th>
  <th>ISBN</th>
</tr>
<?php
   foreach ($result as $items) {
?>
<tr>
  <td><?= $items['name']?></td>
  <td><?= $items['author']?></td>
  <td><?= $items['year']?></td>
  <td><?= $items['genre']?></td>
  <td><?= $items['isbn']?></td>
</tr>
<?php } ?>
</table>
</html>
