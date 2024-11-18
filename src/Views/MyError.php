<!DOCTYPE html>
<html lang="en">
<head>
	<title>Error</title>
</head>
<body>
<div class="error">
    <h1>Sorry, an error has occurred</h1>
    <div class="error-message">Message : <?= $exception->getMessage(); ?></div>
    <div class="error-stack">Stack Trace : <?= $exception->getTraceAsString(); ?></div>
</div>
</body>
</html>
