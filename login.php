<?php
/////確認是否已經登入過，若是則顯示使用者名稱
		session_start();
		if(@$_SESSION["login"] == "OK"){
			echo "<b>Hello, ".$_SESSION["name"]."</b>";
			echo " <a href='logout.php'><button class='btn btn-sm btn-primary'>Logout</button></a>";
		}
/////
		else if(@$_SESSION["login"] == "Fail"){		
			$_SESSION["login"] = "";
			if(@$_GET["embed"]=="true"){
					echo "<script>alert('Please login to excecute!')</script>";
					echo "<form action='auth.php' method='POST' > \n";
					echo "Username: <input type='text' name='name'></input><br>\n";
					echo "Password: <input type='password' name='passwd'></input><br>\n";
					echo "<input type='submit' value='Login'></input>\n";
					echo "</form>";
				
			}
			else{
					echo "<form action='auth.php' method='POST' > \n";
					echo "Username: <input type='text' name='name'></input><br>\n";
					echo "Password: <input type='password' name='passwd'></input><br>\n";
					echo "<input type='submit' value='Login'></input>\n";
					echo "</form>";
			}
		}
		else{
			if(@$_GET["embed"]=="true"){
					echo "<form action='auth.php' method='POST' > \n";
					echo "Username: <input type='text' name='name'></input><br>\n";
					echo "Password: <input type='password' name='passwd'></input><br>\n";
					echo "<input type='submit' value='Login'></input>\n";
					echo "</form>";
				
			}
			else{
					echo "<form action='auth.php' method='POST' > \n";
					echo "Username: <input type='text' name='name'></input><br>\n";
					echo "Password: <input type='password' name='passwd'></input><br>\n";
					echo "<input type='submit' value='Login'></input>\n";
					echo "</form>";
			}
		}
?>
