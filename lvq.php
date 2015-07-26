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
			array(0,1,1,0,0,1,1,1,1,1,0,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1),
			array(0,1,1,0,0,1,1,1,1,1,1,1,1,1,1,1,1,0,0,1,0,1,1,1,1,2),
			//array(0,0,1,0,0,0,1,1,0,0,0,1,1,1,0,1,1,1,1,1,1,1,0,1,1,3),
			//array(0,0,1,0,0,1,1,1,1,1,0,1,1,1,0,1,1,1,1,1,1,0,1,0,1,4),
			//array(0,0,1,1,0,1,1,1,1,1,1,1,1,0,1,1,1,1,1,1,1,1,1,1,1,5),
		
);

$baris=1;
$baris1=1;
$sum=array(0,0,0,0,0,0,0,0);
if(isset($_POST['sbmt'])){
		$iterasi=$_POST['iterasi'];
		$alpha=$_POST['alpha'];
		$beta=$_POST['beta'];

//penghitungan LVQ
//looping epoch
for($i=0;$i<$iterasi;$i++){
	//looping perdata
	for($a=0;$a<20;$a++){
		$sum=array(0,0,0,0,0,0,0,0);
		$baris1=1;
		for($x=0;$x<2;$x++){//baris bobot
			for($y=0;$y<25;$y++){// kolom huruf & bobot
				$pangkat[$x][$y]=($huruf[$a][$y]-$bobot[$x][$y])*($huruf[$a][$y]-$bobot[$x][$y]);
				}
			for($y=0;$y<25;$y++){
				$sum[$x]=$sum[$x]+$pangkat[$x][$y];	
			}
			//hitung euclidian distance
			$sqrt[$x]=sqrt($sum[$x]);//nilai d (jarak)
		}
		//cari jarak minimal
		$minimal=min($sqrt[0],$sqrt[1]);
		
		for($x=0;$x<2;$x++){
			//jika jarak bukan minimal
			if($sqrt[$x]!=$minimal){
				for($y=0;$y<25;$y++){
				//bobot tetap
					$bobot[$x][$y]=$bobot[$x][$y];
				}
			}
			//jika jarak = minimal
			else if($minimal=$sqrt[$x]){
					for($y=0;$y<25;$y++){// kolom huruf & bobot
						//jika target=kelas
						if ($bobot[$x][25]==$huruf[$a][25]){
							$updatebobot[$x][$y]=$bobot[$x][$y]+($alpha*($huruf[$a][$y]-$bobot[$x][$y]));
							$bobot[$x][$y]=$updatebobot[$x][$y];}
							//jika target tidak sama dengan kelas
						else $updatebobot[$x][$y]=$bobot[$x][$y]-($alpha*($huruf[$a][$y]-$bobot[$x][$y]));
							$bobot[$x][$y]=$updatebobot[$x][$y];	
						}
					}
			}			
		$e=$i+1;
echo "</br><h2><b>Epoch ke $e</b></h2>";?>
		<table border="1">
		<h2><b>Euclidian Distance | data ke <?php echo $a+1?> </b></h2>
		
			 <tr BGCOLOR="gray"><?php for($z=0;$z<2;$z++){?>
			 <td> d<?php echo  $z+1;?></td><?php } ?>
			 </tr>
			 <tr><?php for($z=0;$z<2;$z++){?>
			 <td><?php echo number_format ($sqrt[$z],4)?></td><?php } ?>
			 </tr>
			 
		  </table>
				
		
		<table border="1">
		<h2><b>Bobot | data ke <?php echo $a+1?></b></h2>
		<tr BGCOLOR="gray">
			<td>No</td>
			<?php for($z=0;$z<25;$z++){?>
			<td width="60">W<?php echo $z+1?></td>
			<?php }?>
		</tr>
	   
			<?php for($z=0;$z<2;$z++){?>
			 <tr>
				<td><?php echo $baris1++?></td>
				<?php for($y=0;$y<25;$y++){?>			
				<td><?php echo number_format ($bobot[$z][$y],4)?></td>
			
			<?php } 
			}?>
			</tr>
		</table>
		<?php
		echo "<br>";
		echo "<br>";
		echo "<br>";

			
	}//end looping per data
	//update alpha
			$alpha=$alpha*exp(-$beta*($i+1));
			echo "Alpha baru: $alpha";
echo "<br>=========================================================================================================================================================================================================================================================================================================";

}//end epoch
//echo "<br>=========================================================================================================================================================================================================================================================================================================";
}//end isset


//hasil pengenalan
$sum1=0;
$sum2=0;
for($a=0;$a<20;$a++){
		$data[0]="Hidari-2 | T:(1)";
		$data[1]="Migi-1 | T:(2)";
		$data[2]="Hito-1 | T:(1)";
		$data[3]="Moku-1 | T:(2)";
		$data[4]="Ryoku-1 | T:(1)";
		$data[5]="Hidari-3 | T:(2)";
		$data[6]="Migi-3 | T:(1)";
		$data[7]="Hito-2 | T:(2)";
		$data[8]="Moku-2 | T:(1)";
		$data[9]="Ryoku-2 | T:(2)";
		$data[10]="Hidari-4 | T:(1)";
		$data[11]="Migi-4 | T:(2)";
		$data[12]="Hito-4 | T:(1)";
		$data[13]="Moku-3 | T:(2)";
		$data[14]="Ryoku-3 | T:(1)";
		$data[15]="Hidari-5 | T:(2)";
		$data[16]="Migi-5 | T:(1)";
		$data[17]="Hito-5 | T:(2)";
		$data[18]="Moku-5 | T:(1)";
		$data[19]="Ryoku-4 | T:(2)";
		$sum=array(0,0,0,0,0,0,0,0);
		$baris1=1;
		for($x=0;$x<2;$x++){//baris bobot
			for($y=0;$y<25;$y++){// kolom huruf & bobot
				$pangkat[$x][$y]=($huruf[$a][$y]-$bobot[$x][$y])*($huruf[$a][$y]-$bobot[$x][$y]);
					}
			for($y=0;$y<25;$y++){
				$sum[$x]=$sum[$x]+$pangkat[$x][$y];
			}
			$sqrt[$x]=sqrt($sum[$x]);//nilai d (jarak)
		}
		$minimal=min($sqrt[0],$sqrt[1]);
		echo "<br>";
		for($y=0;$y<2;$y++){
			if($minimal==$sqrt[$y]){		
					$cluster=$y;
				}
		}
		
		$cluster=$cluster+1;
		echo "Data $data[$a] masuk dalam Kelas $cluster</br>";
		if ($cluster=="1"){
		$sum1++;
		} 
		else {
		$sum2++;
		}
		}
		
echo "Cluster 1 sebanyak: $sum1 <br />"; 
echo "Cluster 2 sebanyak: $sum2";

?>

    
    
</center>
</body>
</html>