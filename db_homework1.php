<?php
  $biblio = new PDO('mysql:host=localhost; dbname=global', 'root', '');
  $sql = 'SELECT * FROM books ';
  $sql1 = '';
  if (isset($_POST['isbn']) && !$_POST['isbn']=='') {
      $sql1= ' isbn LIKE "%'.$_POST['isbn'].'%"';
  }
  if (isset($_POST['nameBook']) && !$_POST['nameBook']=='') {
      if ($sql1 !== '') {
          $sql1 = $sql1.' AND ';
      }
      $sql1 = $sql1.' name LIKE "%'.$_POST['nameBook'].'%"';
  }
  if (isset($_POST['authorBook']) && !$_POST['authorBook']=='') {
      if ($sql1 !== '') {
          $sql1 = $sql1.' AND ';
      }
      $sql1 = $sql1.' author LIKE "%'.$_POST['authorBook'].'%"';
  }
  if ($sql1 !== '') {
      $sql = $sql.' WHERE';
  }
  $sql = $sql.$sql1;
  $result = $biblio->query($sql);
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
   <input type = 'text' name = 'isbn' value = '<?= $_POST['isbn'] ?>' placeholder = "ISBN">
   <input type = 'text' name = 'nameBook' value = '<?= $_POST['nameBook'] ?>' placeholder = "Название книги">
   <input type = 'text' name = 'authorBook'value = '<?= $_POST['authorBook'] ?>' placeholder = "Автор книги">
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
