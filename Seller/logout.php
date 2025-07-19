<?php
session_start();
session_unset();
session_destroy();

header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Expires: 0");
header("Pragma: no-cache");

echo "<script>
  window.location.href = '../seller/index.php';
</script>";
exit;
?>
