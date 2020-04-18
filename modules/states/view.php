<? 
					do {
						echo '<div class="wrap">
								<a class = "tov" href = "/'.$myrow1['links'].'">'.$myrow1[name].'</a>
							  </div>';
					} while ($myrow1 = mysqli_fetch_array($result1));
					echo '<div id = "clear"></div>';
?>
