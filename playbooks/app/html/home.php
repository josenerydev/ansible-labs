<?php
include 'includes/header.php';
include 'includes/server_info.php';
?>

<h1 class="text-center">Request Debugging Information</h1>

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

<?php include 'includes/footer.php'; ?>
