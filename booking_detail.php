<?php
require __DIR__.'/lib/bootstrap.php';
if(($_SERVER['REQUEST_METHOD'] ?? 'GET')!=='GET'){http_response_code(405);exit('Method not allowed');}
$ref=is_string($_GET['ref'] ?? null) ? $_GET['ref'] : '';
$index=booking_index_by_ref($ref);
$booking=$index===null ? null : $_SESSION['bookings'][$index];
$item=$booking===null ? null : booking_workshop($booking,$workshops);
if($booking===null) http_response_code(404);
$flash=$_SESSION['flash'] ?? '';unset($_SESSION['flash']);
?>
<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width,initial-scale=1">
        <title>
            Booking Details
        </title>
        <link rel="stylesheet" href="assets/style.css">
    </head>
    <body class="___PHPCHUNK1___">
        <main class="wrap">
            <header>
                <h1>
                    Booking Details
                </h1>
                <nav>
                    <a href="index.php">
                        Catalog
                    </a>
                    <a href="dashboard.php">
                        My bookings
                    </a>
                </nav>
            </header>
            <?php if($flash): ?>
            <p class="notice">
                <?= e($flash) ?>
            </p>
            <?php endif; ?>
            <?php if(!$booking): ?>
            <div class="panel">
                <h2>
                    Booking not found
                </h2>
                <p>
                    The reference is missing, unknown or no longer belongs to this session.
                </p>
                <a class="btn secondary-btn" href="dashboard.php">
                    Back to My Bookings
                </a>
            </div>
            <?php else: ?>
            <div class="panel">
                <dl class="details">
                    <dt>
                        Booking Reference
                    </dt>
                    <dd>
                        <span class="ref-tag">
                            <?= e($booking['ref']) ?>
                        </span>
                    </dd>
                    <dt>
                        Attendee
                    </dt>
                    <dd>
                        <?= e($booking['full_name']) ?>
                    </dd>
                    <dt>
                        Email
                    </dt>
                    <dd>
                        <?= e($booking['email']) ?>
                    </dd>
                    <dt>
                        Workshop
                    </dt>
                    <dd>
                        <?= e($item['title'] ?? $booking['workshop']) ?>
                    </dd>
                    <dt>
                        Quantity
                    </dt>
                    <dd>
                        <?= e($booking['quantity']) ?>
                        tickets
                    </dd>
                    <dt>
                        Unit Fee
                    </dt>
                    <dd>
                        <?= $item===null?'Unavailable':number_format($item['fee']).' VND' ?>
                    </dd>
                    <dt>
                        Total Amount
                    </dt>
                    <dd>
                        <strong>
                            <?= number_format($booking['amount']) ?>
                            VND
                        </strong>
                    </dd>
                </dl>
                <div class="actions detail-actions">
                    <a class="btn edit-btn" href="booking_edit.php?ref=___PHPCHUNK14___">
                        Edit This Booking
                    </a>
                    <a class="btn secondary-btn" href="dashboard.php">
                        Back to My Bookings
                    </a>
                </div>
            </div>
            <p class="muted">
                Booking information is read from the current PHP session.
            </p>
            <?php endif; ?>
        </main>
    </body>
</html>
