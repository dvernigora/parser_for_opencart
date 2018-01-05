<?php
$host = 'localhost';
$userName = 'root';
$password = '';
$DBName = 'my_db';

try {
    $dbh = new PDO("mysql:host=".$host.";dbname=".$DBName.";charset=utf8", $userName, $password);

    $pdo = $dbh->prepare('
    UPDATE my_table
    SET remainder = :remainder
	WHERE vendor_code = :vendor_code');

} catch (PDOException $e) {
    echo 'Подключение базе данных не удалось: ' . $e->getMessage();
}

$object = json_decode($_POST['stringfy_json'], true); 

foreach ($object as $key => $value){
	if (trim(mb_strtolower($key)) == 'артикул') {
		for($i = 0, $size = count($object[$key]); $i < $size; $i++) {
			$params = [':remainder' => $object['Остаток'][$i], ':vendor_code' => $object[$key][$i]];
			$pdo->execute($params);
		}
	}
}

echo 'Товары успешно обновлены!';

