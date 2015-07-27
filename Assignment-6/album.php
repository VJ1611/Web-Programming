<?php
//session_start();
$cookieN="login";
$cookieV="yep";


$artistFErr = $artistLErr = $birthErr = $albumErr = $bandErr = $releaseErr = $labelErr = $genreErr = "";
$tableString="";
$success="";



function artCheck(){

		global $artistFErr, $artistLErr, $birthErr;
		$toggle=true;
		if(empty($_POST['fName'])){
			$artistFErr=" required";
			$toggle=false;
		}
		if(empty($_POST['lName'])){
			$artistLErr=" required";
			$toggle=false;
		}
		
		return $toggle;
}

function albCheck(){

		global $albumErr , $artistLErr , $releaseErr  , $genreErr;
		$toggle=true;
		if(empty($_POST['album'])){
			$albumErr=" required";
			$toggle=false;
		}
		if(empty($_POST['artist'])){
			$artistLErr=" required";
			$toggle=false;
		}
		if(empty($_POST['genre'])){
			$genreErr=" required";
			$toggle=false;
		}
		if(empty($_POST['release'])){
			$releaseErr=" required";
			$toggle=false;
		}elseif(!ctype_digit($_POST['release'])){
			$releaseErr=" must be a number";
			$toggle=false;
		}
		
		return $toggle;
}



if(!empty($_POST['newArt'])||!empty($_POST['newAlbum'])){
	if(!empty($_POST['newArt'])){
		if(artCheck()){
			$con=mysqli_connect("localhost","vjavvaji1","vjavvaji1","vjavvaji1");

			if (mysqli_connect_errno()) {
				$success="Failed to connect to MySQL: " . mysqli_connect_error();
			}

			$fn = mysqli_real_escape_string($con, $_POST['fName']);
			$ln = mysqli_real_escape_string($con, $_POST['lName']);
			if(empty($_POST['band'])){
			$bandn='Solo Artist';
			}else{
			$bandn = mysqli_real_escape_string($con, $_POST['band']);
			}
			
			$query="Select ArtistID FROM artist WHERE FirstName='$fn' AND LastName='$ln'";
			
			$result=mysqli_query($con,$query);
			if(mysqli_num_rows($result)){
				$success="Artist already in the system";		
			}else{
				$query="INSERT INTO artist(FirstName,LastName,Band) VALUES(\"$fn\",\"$ln\",\"$bandn\")";
				mysqli_query($con,$query);
				$success="$fn $ln successfully added";
			}
		}
	}
	if(!empty($_POST['newAlbum'])){
		if(albCheck()){
			$con=mysqli_connect("localhost","vjavvaji1","vjavvaji1","vjavvaji1");

			if (mysqli_connect_errno()) {
				$success="Failed to connect to MySQL: " . mysqli_connect_error();
			}

			$an = mysqli_real_escape_string($con, $_POST['album']);
			$artn = mysqli_real_escape_string($con, $_POST['artist']);
			$y = mysqli_real_escape_string($con, $_POST['release']);
			$gn = mysqli_real_escape_string($con, $_POST['genre']);
			
			
			$queryAlb="Select AlbumName FROM album WHERE AlbumName LIKE '%$an%'";
			$queryArt="Select ArtistID FROM artist WHERE LastName LIKE '%$artn%'";
			$result=mysqli_query($con,$queryAlb);
			$result2=mysqli_query($con,$queryArt);
			$row=mysqli_fetch_array($result);
			if(mysqli_num_rows($result)){
				$success="$an is already in the system";		
			}elseif(!mysqli_num_rows($result2)){
				$success="Artist Name is not in the artist database, please enter them first";
			}else{
				$query="INSERT INTO album(AlbumName, ArtistName, Year, Genre) VALUES(\"$an\",\"$artn\",$y,\"$gn\")";
				mysqli_query($con,$query);
				$success="$an successfully added";
			}
		}
	}	
}

elseif(!empty($_POST['search'])){
	
	if(!empty($_POST['search_field'])){
		if($_POST['searchlist']=="BandName"){
			$searchname=$_POST['search_field'];
			
			$connect=mysqli_connect("localhost","vjavvaji1","vjavvaji1","vjavvaji1");
			if(mysqli_connect_errno()){
				$success="Failed to connect to database: ".mysqli_connect_error();
			}
			$query="SELECT * FROM artist WHERE Band='$searchname'";
			$result=mysqli_query($connect,$query);
			
			$tableString="<tr><th>First Name</th><th>Last Name</th><th>Band</th></tr>";

			while($row=mysqli_fetch_array($result)){
				
				$tableString.="<tr><td>".trim($row['FirstName'])."</td>";
				$tableString.="<td>".$row['LastName']."</td>";
				$tableString.="<td>".$row['Band']."</td>";
				

			}
			mysqli_close($connect);
		}elseif($_POST['searchlist']=="LastName"){
		
			$searchname=$_POST['search_field'];
			
			$connect=mysqli_connect("localhost","vjavvaji1","vjavvaji1","vjavvaji1");
			if(mysqli_connect_errno()){
				$success="Failed to connect to database: ".mysqli_connect_error();
			}
			$query="SELECT * FROM artist WHERE LastName='$searchname' ";
			$result=mysqli_query($connect,$query);
			
			$tableString="<tr><th>First Name</th><th>Last Name</th><th>Band</th></tr>";

			while($row=mysqli_fetch_array($result)){
				
				$tableString.="<tr><td>".trim($row['FirstName'])."</td>";
				$tableString.="<td>".$row['LastName']."</td>";
				$tableString.="<td>".$row['Band']."</td>";
				
			}
			mysqli_close($connect);
			
		}else{
			$searchtype=$_POST['searchlist'];
			$searchname=$_POST['search_field'];
		
			
			$connect=mysqli_connect("localhost","vjavvaji1","vjavvaji1","vjavvaji1");
			if(mysqli_connect_errno()){
				$success="Failed to connect to database: ".mysqli_connect_error();
			}
			$query="SELECT * FROM album WHERE $searchtype='$searchname'";
			$result=mysqli_query($connect,$query);
			$tableString="<tr><th>Album Name</th><th>Artist</th><th>Year Released</th><th>Musical Genre</th></tr>";

			while($row=mysqli_fetch_array($result)){
				$artband=trim($row['ArtistName']);
				$queryArt="Select FirstName, LastName FROM artist WHERE LastName LIKE '%$artband%'";
				$resultA=mysqli_query($connect,$queryArt);
				if(mysqli_num_rows($resultA)==1){
					$rowA=mysqli_fetch_array($resultA);
					$artband=$rowA[0]." ".$rowA[1];
				}
				$tableString.="<tr><td>".$row['AlbumName']."</td>";
				$tableString.="<td>".$artband."</td>";
				
				$tableString.="<td>".$row['Year']."</td>";
				$tableString.="<td>".$row['Genre']."</td></tr>";

			}
			mysqli_close($connect);
		}
	}else{
	  $success="please enter a search term to use the search function";
	}
}

?>
<html>
<head>
<link rel="stylesheet" type="text/css" href="album.css">
</head>
<body>
<div id="content">
<span><h1>Welcome to the Album Database</h1></span>
<div id="artadd">
<h2> Add Artist </h2>
<form name="addArtist" action="album.php" method="post">
	<label>First Name:&nbsp;&nbsp; </label><input type="text" name="fName"></input>*<?php echo $artistFErr ?></br>
	<label>Last Name:&nbsp;&nbsp; </label><input type="text" name="lName"></input>*<?php echo $artistLErr ?></br>
	<label>Band Name: &nbsp;</label><input type="text" name="band"></input></br>
	<input type="submit" name="newArt" value="Add Artist"></input>
	</br>
</form>
</div>   
<div id="albadd">
<h2> Add Album </h2>
<form name="addAlbum" action="album.php" method="post">
	<label>Album Name: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label><input type="text" name="album"></input>*<?php echo $albumErr ?></br>
	<label>Artist Last Name: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label><input type="text" name="artist"></input>*<?php echo $artistLErr ?></br>
	<label>Released Year: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label><input type="text" name="release"></input>*<?php echo $releaseErr ?></br>
	<label>Genre:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp </label><input type="text" name="genre"></input>*<?php echo $genreErr ?></br>
	<input type="submit" name="newAlbum" value="Add Album" ></input>
	</br>

</form>
</div>
<div style="clear: both"></div>

<form name="search" action="album.php" method="post">
<h2>Search Selection:</h2> <br/>
<select name="searchlist">
  <option value="BandName">By Band Name</option>
  <option value="AlbumName">By Album Name</option>
  <option value="Year">By Year</option>
   <option value="Genre">By Genre</option>
   <option value="LastName">Artists By Last Name</option>
 
</select>

<input type="text" name="search_field"></input>

	<div id="searchbuttons">
		<input type="submit" name="search" value="Show Selected"></input>
		
	</div>
	
<h3> <?php echo $success ?>	</h3>
</form>



<table>
<?php echo $tableString ?>
</table>

</div>
</body>
</html>