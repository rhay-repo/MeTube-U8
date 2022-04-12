<!DOCTYPE html>
<html>
<style>
h1 {text-align: center;}
</style>
<body>
<h1>9X9 Multiplication Table</h1>
<table align="center" border='1' width="100%">
<?php
$size = 9;

for($i = 1; $i <= 9; $i++)
{	
    echo "<tr>";
	
	for($j = 1; $j <= $size; $j++)
	{
		$multiplication_table = ($i * $j);
        if ($j > $i) {echo "<td></td>";}
        else {
            echo "<td>" . $j . "X" . $i . "=" . $multiplication_table . "</td>";
        } 
	}	
	echo "<tr/>";
}
?>
</table>
</body>
</html>