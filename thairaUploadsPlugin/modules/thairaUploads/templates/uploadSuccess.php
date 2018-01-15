<html>
<body>
<script type="text/javascript">
window.parent.uploadersManager<?php echo $uid ?>
		.getUploader(<?php echo $index ?>).onUploadFinish(<?php echo $json ?>);
</script>
</body>
</html>