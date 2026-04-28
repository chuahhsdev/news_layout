<?php include_once("mysql.php"); //Import MySQL ?> 
<div class="row">
    <div class="col-sm-12">
        <h1 style="border-bottom: 2px solid #333; padding-bottom: 10px; margin-bottom: 20px;">
            <img src="image/logo.jpg" alt="Main Logo" style="height:50px;">
        </h1>
    </div>
    
    <?php
	$sql = "SELECT * FROM news WHERE is_main_story = 'Y' LIMIT 1";
	$result = mysqli_query($connection, $sql);
	$row = mysqli_fetch_assoc($result);
	?>

	<div class="col-md-8">
		<div class="thumbnail" style="border:none; padding:0;">
			<div style="width:100%; height:350px; background:#ccc; border-radius:4px;">
				<img src="image/<?php echo $row["image"]; ?>" alt="Main Story" style="width:100%; height:350px; object-fit:cover; border-radius:4px;">
			</div>
			<div class="caption" style="padding-left:0;">
				<h2 style="margin-top:15px;">
					<a href="#" style="color:#222; text-decoration:none; font-weight:bold;">
						<?php echo $row["title"]; ?>
					</a>
				</h2>
				<p><?php echo $row["summary"]; ?></p>
				<p>
					<span style="color:#b00;"><strong><?php echo $row["category"]; ?></strong></span>
					<small class="text-muted">| <?php echo date("F j, Y, g:i a", strtotime($row["created_at"])); ?></small>
				</p>
			</div>
		</div>
	</div>

    <div class="col-md-4" style="border-left: 1px solid #eee;">
		<h4 style="margin-top:0;color: #ed1c24;"><strong>TOP STORIES</strong></h4>
		<ul class="list-unstyled">
			<?php
			$sql = "SELECT * FROM news WHERE is_main_story = 0 AND category != 'STARBIZ' LIMIT 3";
			$result = mysqli_query($connection, $sql);
			while ($row = mysqli_fetch_assoc($result)) {
			?>
				<li style="margin-bottom: 15px; border-top: 1px solid #f4f4f4; padding-top: 10px; ?>">
					<a href="#" style="font-weight:bold; color:#333;"><?php echo $row["title"]; ?></a>
					<br><small class="text-muted"><?php echo $row["category"]; ?> | <?php echo date("F j, Y, g:i a", strtotime($row["created_at"])); ?></small>
				</li>
			<?php 
				
			} ?>
		</ul>
	</div>
</div>
<div class="row">
    <div class="col-sm-12">
        <h4 style="background:#f1f1f1; padding:10px;"><strong>STARBIZ</strong></h4>
    </div>
    <?php
    $sql = "SELECT * FROM news WHERE category = 'STARBIZ' LIMIT 3";
    $result = mysqli_query($connection, $sql);
    while ($row = mysqli_fetch_assoc($result)) {
    ?>
        <div class="col-sm-4">
            <div style="height:120px; background:#ddd; margin-bottom:10px;">
                <img src="image/<?php echo $row["image"]; ?>" alt="<?php echo $row["title"]; ?>" style="width:100%; height:120px;">
            </div>
            <h5><a href="#"><?php echo $row["title"]; ?></a></h5>
        </div>
    <?php } ?>
</div>

<br><br>