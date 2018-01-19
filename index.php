<?php
include "config.php";
$sql= "SELECT * FROM tasks";
$add = $dbh->query($sql);
$row = 1;
?>
<html>
<head>
	<meta charset="UTF-8">
	<title>Document</title>
</head>
	<body>
		<table border="1" width="700px">
			<tr>
			<td>id</td>
			<td>Описание</td>
			<td>Статус</td>
			<td>Дата создания</td></tr>

			<tr>
			<?php while($data = $add->fetch()){ ?>
				<td><?=$data['id'];?></td>
    			<td><?=$data['description'];?></td>
    			<td><?php if ($data['is_done'] == 0){echo "не сделано";}else{ echo "СДЕЛАНО";} ?></td>
    			<td><?=$data['date_added'];?></td>
    			<td>	    			
    				<form>
					    <input type="checkbox" id="welldone" name="done" value="done">
					</td>
    		<tr></tr>
    		<?php } ?>
			</tr>
</table>
					<button type="submit">Отметить выделенные как "сделано"</button>
					</form>

<form  method="post" action ="" enctype="multipart/form-data">
	<input type="text" name="descript" placeholder="Введите описание">
	<input type="submit" value="Отправить" >
</form>

<form  method="post" action ="" enctype="multipart/form-data">
	<input type="text" name="delete" placeholder="Введите id дела">
	<input type="submit" value="Удалить" >
</form>

<?php
$sqladd="INSERT INTO `tasks` (`id`, `description`, `is_done`, `date_added`) VALUES (NULL, :descript, '1', CURRENT_TIMESTAMP);";
$sqldelete="DELETE FROM `tasks` WHERE `tasks`.`id` =:delete";


if (isset($_POST['delete'])){
	$delete=$_POST['delete'];

$dbh->prepare($sqldelete);
$stb->bindParam(':delete', $delete);
$stb->exec();
}


if (isset($_POST['descript'])){
	$descript=$_POST['descript'];

$newadd=$dbh->prepare($sqladd);
$newsadd->bindValue(':descript', $descript);
$newadd->execute();

    if ($sqladd = 'true'){
        echo '<script type="text/javascript">alert("Запись добавлена в список дел!");</script>';

    }else{
         echo '<script type="text/javascript">alert("Запись НЕ добавлена в список дел! Попробуйте еще");</script>';
    }

}

?>
	</body>
</html>