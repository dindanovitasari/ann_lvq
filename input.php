<!DOCTYPE HTML>
<head>
	<title>Learning Vector Quantization</title>
</head>
<style>
table { 
border-collapse: collapse; 
border-spacing: 0; } 
</style>
<body style="font-family:verdana;font-size:75%">
<center><h1><b>Pengenalan Huruf Kanji Menggunakan Algoritma LVQ</b></h1></center>
<center>

<?php
$huruf=array(
			array(0,1,1,0,0,1,1,1,1,1,0,1,1,1,1,1,1,1,0,0,1,1,1,1,1,1),
			array(0,0,1,0,1,1,1,1,1,1,0,1,1,1,1,1,1,0,1,1,1,1,1,1,1,2),
			array(0,0,1,0,0,0,0,1,0,0,0,1,1,1,0,0,1,1,1,1,1,1,0,1,1,1),
			array(0,0,1,0,0,1,1,1,1,1,0,1,1,1,0,1,1,1,1,1,1,0,1,0,1,2),
			array(0,0,1,1,0,1,1,1,1,1,0,1,1,0,1,0,1,1,0,1,1,1,0,1,1,1),
			array(0,0,1,0,0,1,1,1,1,1,0,1,1,1,1,1,1,1,1,0,1,1,1,1,1,2),
			array(0,0,1,0,0,1,1,1,1,1,0,1,1,1,1,1,1,1,1,1,1,1,1,1,0,1),
			array(0,0,1,0,0,0,0,1,0,0,0,1,1,1,0,1,1,1,1,1,1,1,0,1,1,2),
			array(0,0,1,0,0,1,1,1,1,1,0,1,1,1,0,1,1,1,1,1,1,0,1,0,1,1),
			array(0,0,1,0,0,1,1,1,1,1,0,1,1,0,1,1,1,1,0,1,1,1,0,1,1,2),
			array(0,1,1,0,0,1,1,1,1,1,0,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1),
			array(0,1,1,0,0,1,1,1,1,1,0,1,1,1,1,1,1,0,0,1,0,1,1,1,1,2),
			array(0,1,1,0,0,0,1,1,0,0,0,1,1,1,0,0,1,1,1,1,1,1,0,1,1,1),
			array(0,0,1,0,0,1,1,1,1,1,0,1,1,1,0,1,1,1,1,1,1,0,1,0,1,2),
			array(0,0,1,0,0,1,1,1,1,1,0,1,1,0,1,0,1,1,0,1,1,1,0,1,1,1),
			array(0,0,1,1,0,0,1,1,1,1,0,1,1,1,1,0,1,1,1,1,1,1,1,1,1,2),
			array(0,0,1,1,0,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1),
			array(0,0,1,0,0,0,1,1,0,0,0,1,1,0,0,1,1,1,1,0,1,1,0,1,1,2),
			array(0,1,1,0,0,1,1,1,1,0,0,1,1,1,0,1,1,1,1,1,1,1,1,0,0,1),
			array(0,1,1,0,0,1,1,1,1,1,0,1,1,0,1,1,1,1,1,1,1,1,1,1,1,2),
			
);

$bobot= array(
			array(0,1,1,0,0,1,1,1,1,1,0,1,1,1,1,1,1,1,1,1,1,1,1,1,1,'1-Hidari'),
			array(0,1,1,0,0,1,1,1,1,1,1,1,1,1,1,1,1,0,0,1,0,1,1,1,1,'2-Migi'),
			//array(0,0,1,0,0,0,1,1,0,0,0,1,1,1,0,1,1,1,1,1,1,1,0,1,1,'3-Hito'),
			//array(0,0,1,0,0,1,1,1,1,1,0,1,1,1,0,1,1,1,1,1,1,0,1,0,1,'4-Moku'),
			//array(0,0,1,1,0,1,1,1,1,1,1,1,1,0,1,1,1,1,1,1,1,1,1,1,1,'5-Ryoku'),
		
);

$baris=1;
$baris1=1;
$sum=array(0,0,0,0,0,0,0,0);

?>
<table border="1" >
    <h2><b>Data Training</b></h2>
    <tr BGCOLOR="gray" >
    	<td>No</td><!-- looping untuk isi header tabel-->
        <?php for($z=0;$z<25;$z++){?>
        <td width="20">X<?php echo $z+1?></td>
        <?php }?>
		<td>Target</td>
    </tr>
   <!-- looping untuk isi kolom pertama-->
    	<?php for($z=0;$z<20;$z++){?>
         <tr>
         	<td><?php echo $baris++?></td>
			<!-- looping untuk baris input vektor-->
        	<?php for($y=0;$y<26;$y++){?>			
			<td><?php echo $huruf[$z][$y]?></td>
		
		<?php } 
		}?>
        </tr>
</table>

<table border="1" >
    <h2><b>Bobot0</b></h2>
    <tr BGCOLOR="gray">
    	<td>No</td>
        <?php for($z=0;$z<25;$z++){?>
        <td width="20">W<?php echo $z+1?></td>
        <?php }?>
		<td>Target</td>
    </tr>
   
    	<?php for($z=0;$z<2;$z++){?>
         <tr>
         	<td><?php echo $baris1++?></td>
        	<?php for($y=0;$y<26;$y++){?>			
			<td><?php echo $bobot[$z][$y]?></td>
		
		<?php } 
		}?>
        </tr>
</table>


<br><br><h2><b>Masukkan JUMLAH EPOCH, LEARNING RATE dan konstanta BETA</b></h2>
<form method="post" action="lvq.php">
<input name="iterasi" type="text" value="" size="50" placeholder="epoch"/><br>
<input name="alpha" type="text" value="" size="50" placeholder="learning rate"/><br>
<input name="beta" type="text" value="" size="50" placeholder="beta value"/><br>
<input type="submit" name="sbmt" value="Proses"/>
</form>