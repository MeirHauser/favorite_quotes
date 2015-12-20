<head>
	<style type="text/css">
 		table{
 			border-collapse: collapse;
 			margin-bottom: 10px;
 		}
 		td{
 			border: 3px solid black;
 			padding: 10px;
 		}
 		h2{
 			display: inline-block;
 		}	
 		#logout{
 			margin-left: 900px;
 		}
 		#add_item{
 			margin-left: 500px;
 		}
 		#favorites{
 			display: inline-block;
 			vertical-align: top;
 			width: 200px;
 			height: 175px;
 			border: 2px solid black;
 			padding: 5px;
 			margin-left: 300px;
 			overflow: scroll;
 		}
 		#quotes{
 			display: inline-block;
 			width: 200px;
 			height: 400px;
 			border: 2px solid black;
 			padding: 5px;
 			overflow: scroll;
 		}
 		.quotes{
 			border: 2px solid black;
 			margin-top: 15px;
 			padding: 5px;
 		}
	</style>
</head>
<body>
	<div id = 'header'>
		<h2>Hello <?php echo $this->session->userdata('alias'); ?>!</h2>
		<a href = '/logout' id = 'logout'>Logout</a>
	</div>
	<div id = 'quotes'>
		<h3>Quotable Quotes:</h3>
		<?php foreach ($other_quotes as $quote) { ?>
			<div class = 'quotes'>
				<p><?php echo $quote['quoted_by']; ?> : <?php echo $quote['quote']; ?></p>
				<p>Posted by: <?php echo $quote['posted_by']; ?></p>
				<a href="/add_to_favorites/<?php echo $quote['quote_id']; ?>"><button>Add To My List</button></a>
			</div>
		<?php } ?>
	</div>
	<div id = 'favorites'>
		<h3>Your Favorites:</h3>
		<?php foreach ($favorites as $quote) { ?>
			<div class = 'quotes'>
				<p><?php echo $quote['quoted_by']; ?> : <?php echo $quote['quote']; ?></p>
				<p>Posted by: <?php echo $quote['posted_by']; ?></p>
				<a href="/remove/<?php echo $quote['id']; ?>"><button>Remove From My List</button></a>
			</div>
		<?php } ?>
	</div>
	<h3>Contribute A Quote:</h3>
		<?php if(isset($error)){
		echo $error;
	} ?>
	<form action = 'add_quote' method = 'post'>
		Quoted By: <input type = 'text' name = 'quoted_by'>
		Quote: <textarea name = 'quote' cols = 30 rows = 10></textarea>
		<input type = 'submit' value = 'submit'>
	</form>
</body>