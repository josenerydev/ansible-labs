<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Request Debug</title>
    <!-- Bootstrap CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <div class="container mt-5">
        <h1 class="text-center mb-4">Request Debugging Information</h1>

        <div class="row">
            <!-- Client Information -->
            <div class="col-md-6">
                <h2>Client Information</h2>
                <div class="table-responsive">
                    <table class="table table-striped table-bordered">
                        <thead class="table-dark">
                            <tr>
                                <th>Attribute</th>
                                <th>Value</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>Client IP</td>
                                <td><?= htmlspecialchars($_SERVER['REMOTE_ADDR'] ?? 'Not Available') ?></td>
                            </tr>
                            <tr>
                                <td>Forwarded For</td>
                                <td><?= htmlspecialchars($_SERVER['HTTP_X_FORWARDED_FOR'] ?? 'Not Available') ?></td>
                            </tr>
                            <tr>
                                <td>Remote Port</td>
                                <td><?= htmlspecialchars($_SERVER['REMOTE_PORT'] ?? 'Not Available') ?></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Server Information -->
            <div class="col-md-6">
                <h2>Server Information</h2>
                <div class="table-responsive">
                    <table class="table table-striped table-bordered">
                        <thead class="table-dark">
                            <tr>
                                <th>Attribute</th>
                                <th>Value</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>Server IP</td>
                                <td><?= htmlspecialchars($_SERVER['SERVER_ADDR'] ?? 'Not Available') ?></td>
                            </tr>
                            <tr>
                                <td>Server Name</td>
                                <td><?= htmlspecialchars($_SERVER['SERVER_NAME'] ?? 'Not Available') ?></td>
                            </tr>
                            <tr>
                                <td>Server Port</td>
                                <td><?= htmlspecialchars($_SERVER['SERVER_PORT'] ?? 'Not Available') ?></td>
                            </tr>
                            <tr>
                                <td>Document Root</td>
                                <td><?= htmlspecialchars($_SERVER['DOCUMENT_ROOT'] ?? 'Not Available') ?></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <h2>Request Headers</h2>
        <div class="table-responsive">
            <table class="table table-striped table-bordered">
                <thead class="table-dark">
                    <tr>
                        <th>Header</th>
                        <th>Value</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach (getallheaders() as $key => $value): ?>
                        <tr>
                            <td><?= htmlspecialchars($key) ?></td>
                            <td><?= htmlspecialchars($value) ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>

        <h2>Server Variables</h2>
        <div class="table-responsive">
            <table class="table table-striped table-bordered">
                <thead class="table-dark">
                    <tr>
                        <th>Variable</th>
                        <th>Value</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($_SERVER as $key => $value): ?>
                        <tr>
                            <td><?= htmlspecialchars($key) ?></td>
                            <td>
                                <?php
                                if (is_array($value)) {
                                    echo '<pre>' . htmlspecialchars(print_r($value, true)) . '</pre>';
                                } else {
                                    echo htmlspecialchars($value);
                                }
                                ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>

    <!-- Bootstrap JS Bundle CDN -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
