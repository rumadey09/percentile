<html>
<head>
	<title>Rank Table</title>
	<?php echo $this->Html->css('styles'); ?>
</head>
<body>
	<h1>Rank Data</h1>
	<table class="studentClass">
	<tr>
		<th>Id</th>
		<th>Name</th>
		<th>GPA</th>
		<th>Percentile</th>
	</tr>
	<?php	
	foreach($data as $rank) {
	?>
		<tr>
			<td><?php echo $rank['id'];?></td>
			<td><?php echo $rank['name'];?></td>
			<td><?php echo $rank['gpa'];?></td>
			<td><?php echo $rank['percentile'];?></td>
	    </tr>
	<?php
		}
	?>
	</table>
</body>	
</html>