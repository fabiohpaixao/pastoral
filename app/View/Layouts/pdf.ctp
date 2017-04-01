<?php
	header("Content-type: application/pdf charset=utf-8");
	//header('Content-Disposition: attachment; filename="downloaded.pdf"');
	echo $this->fetch('content');
?>