<pre>
<?php
require_once '../../config.php';
header('Content-Type: text/html; charset=utf-8');

$importer = new InstancesImporter();

$result = $importer->import('D:\xampp\htdocs\htdocs\bridge\example\instance.xlsx', False, InstancesImporter::ON_DUPLICATE_IGNORE);
print_r($result);
?>
</pre>