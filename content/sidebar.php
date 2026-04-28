<h4 style="font-weight: bold; color: #ed1c24; border-bottom: 2px solid #ed1c24; padding-bottom: 5px; margin-top: 5px;">
	JUST IN
</h4>

<div class="just-in-feed">
	<ul class="list-unstyled" style="font-size: 13px;">
		<?php
		$sql = "SELECT * FROM just_in ORDER BY created_at DESC LIMIT 5";
		$result = mysqli_query($connection, $sql);
		while ($row = mysqli_fetch_assoc($result)) {
		?>
			<li style="margin-bottom: 15px; border-bottom: 1px solid #f1f1f1; padding-bottom: 5px;">
				<small class="text-danger" style="font-weight: bold;"><?php echo date('h:i A', strtotime($row["created_at"])); 
				//Date example output for h:i A: 02:30 PM (h = hour, i = minute, A = AM/PM ?></small><br>
				<a href="#" style="color: #333; text-decoration: none;"><?php echo $row["title"]; ?></a>
			</li>
		<?php } ?>
	</ul>
</div>