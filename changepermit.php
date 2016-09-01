<?php
		require 'connect.php';

		if(isset($_GET['id']))
		{
			$idforpermitchange = $_GET['id'];
			$statusafterpermitchange = $_GET['status'];
			echo $idforpermitchange;
			echo $statusafterpermitchange;

			if($statusafterpermitchange == 'true'){
				echo "inside true";
				$sql1 = "UPDATE `userdetails` SET `status`='Y' WHERE `Id` = '$idforpermitchange'";
			}
			else{
				echo "inside false";
				$sql1 = "UPDATE `userdetails` SET `status`='N' WHERE `Id` = '$idforpermitchange'";
			}

			mysqli_query($db,$sql1);
			
		}

?>					