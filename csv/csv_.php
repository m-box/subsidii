<?php
ini_set('max_execution_time', 9000);
//Парраметры подключения к DB

include ('../config.php');
include ('../lib/db_functions.php');
$row = 1;
$r_data=0;
$r_user=0;
$s_data=0;
$s_user=0;
$handle = fopen("112016.csv", "r");
while (($data = fgetcsv($handle, 1000, ";")) !== FALSE) {
    $num = count($data);
   /* echo "<p> $num полей в строке $row: <br /></p>\n";*/
    $row++;
	echo "<table border=1>";


		echo "
		<tr>
			<td>Номер справи</td>
			<td>".$data[0]."coding?-(".mb_detect_encoding($data[0], "auto").")</td>
		</tr>
				<tr>
			<td>Дата розрахунку справи</td>
			<td>".$data[1]."coding?-(".mb_detect_encoding($data[1], "auto").")</td>
		</tr>
				<tr>
			<td>Категорія вулиці</td>
			<td>".$data[2]."coding?-(".mb_detect_encoding($data[2], "auto").")</td>
		</tr>
				<tr>
			<td>Код вулиці</td>
			<td>".$data[3]."coding?-(".mb_detect_encoding($data[3], "auto").")</td>
		</tr>
				<tr>
			<td>Назва вулиці</td>
			<td>".$data[4]."coding?-(".mb_detect_encoding($data[4], "auto").")</td>
		</tr>
				<tr>
			<td>Будинок</td>
			<td>".$data[5]."coding?-(".mb_detect_encoding($data[5], "auto").")</td>
		</tr>
				<tr>
			<td>Корпус</td>
			<td>".$data[6]."coding?-(".mb_detect_encoding($data[6], "auto").")</td>
		</tr>
				<tr>
			<td>Квартира</td>
			<td>".$data[7]."coding?-(".mb_detect_encoding($data[7], "auto").")</td>
		</tr>
				<tr>
			<td>Прізвище</td>
			<td>".$data[8]."coding?-(".mb_detect_encoding($data[8], "auto").")</td>
		</tr>
				<tr>
			<td>Ім'я</td>
			<td>".$data[9]."coding?-(".mb_detect_encoding($data[9], "auto").")</td>
		</tr>
				<tr>
			<td>По батькові</td>
			<td>".$data[10]."coding?-(".mb_detect_encoding($data[10], "auto").")</td>
		</tr>
				<tr>
			<td>Телефон</td>
			<td>".$data[11]."coding?-(".mb_detect_encoding($data[11], "auto").")</td>
		</tr>
				<tr>
			<td>Статус</td>
			<td>".$data[12]."coding?-(".mb_detect_encoding($data[12], "auto").")</td>
		</tr>
						<tr>
			<td>Сумма</td>
			<td>".$data[14]."coding?-(".mb_detect_encoding($data[14], "auto").")</td>
		</tr>
								<tr>
			<td>Дата початку</td>
			<td>".$data[15]."coding?-(".mb_detect_encoding($data[15], "auto").")</td>
		</tr>
								<tr>
			<td>Дата кінця</td>
			<td>".$data[16]."coding?-(".mb_detect_encoding($data[16], "auto").")</td>
		</tr>

</table>
		";

$shet="";
$b=0;
$k=0;
	for ($i=17; $i < ($num-2); $i++)  
		{	echo "<table border=1><tr>";
	
			$nazva=$data[$i]; $i++;			
			$shet=$data[$i]; $i++; 
			if ($nazva=='КП "Водоканал"') {$shet_vod=$shet;}
			$c=$data[$i] ; $i++; 
			echo "</tr>";
			echo "<tr><td colspan=2>";
			for ($z=1; $z<=$c; $z++)
			{
			
				$p1= $data[$i]; $i++;
				$p2= $data[$i]; $i++;
				$p3= $data[$i]; $i++;
				$p4= $data[$i]; $i++;
				$p5= $data[$i]; $i++;
				print_r("sobes_data:"." N_SPRAVY-".$data[0]." NAZVA_ORG-".$nazva." shet-".$shet." posluga-".$p1." odinica-".$p2." norm_vart-".$p3." subs-".$p4." plata-".$p5);
			if (db_rec("sobesdata","N_SPRAVY",mysql_real_escape_string($data[0]),"NAZVA_ORG",mysql_real_escape_string($nazva),"shet",mysql_real_escape_string($shet),"posluga",mysql_real_escape_string($p1),"odinica",mysql_real_escape_string($p2),"norm_vart",mysql_real_escape_string($p3),"subs",mysql_real_escape_string($p4),"plata",mysql_real_escape_string($p5))!=="ok")
				{$r_data++; echo "<br>Успешно записанные данные".$s_data."/".$r_data."потеряные данные<br>";}
				else
				{$s_data++; echo "<br>Успешно записанные данные".$s_data."/".$r_data."потеряные данные<br>";}

			}
		echo "</td></tr></table>";
$i--;			

		}
	
		
	
	echo "</table><br>";
	echo $data[$c] . "<br />\n";

	if (db_rec("sobes_fix","N_SPRAVY",mysql_real_escape_string($data[0]),"DATA_POZRAH",mysql_real_escape_string($data[1]),"TYP",mysql_real_escape_string($data[2]),"KVUL",mysql_real_escape_string($data[3]),"NVUL",mysql_real_escape_string($data[4]),"BUD",mysql_real_escape_string($data[5]),"KORP",mysql_real_escape_string($data[6]),"KVAR",mysql_real_escape_string($data[7]),"NAME",str_replace("i","і",mysql_real_escape_string($data[8])),"Fname",mysql_real_escape_string($data[9]),"Mname",mysql_real_escape_string($data[10]),"TEL",mysql_real_escape_string($data[11]),"status_dom",mysql_real_escape_string($data[12]),"PROCENT",mysql_real_escape_string($data[13]),"SUM_SYBS",mysql_real_escape_string($data[14]),"DATA_POCH",mysql_real_escape_string($data[15]),"DATA_KIN",mysql_real_escape_string($data[16]),"OS_RAH_ORG1",$shet_vod)!=="ok")
	{$r_user++;echo "<br>Успешно записано заявок".$s_user."/".$r_user."потеряные данные<br>";}
	else
	{$s_user++;echo "<br>Успешно записано заявок".$s_user."/".$r_user."потеряные данные<br>";}


}
echo "<br>Успешно записано заявок".$s_user."/".$r_user."потеряные данные<br>";
echo "<br>Успешно записанные данные".$s_data."/".$r_data."потеряные данные<br>";
fclose($handle);
?>