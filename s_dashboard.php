<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rewards Page</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .rewards-section {
            padding: 20px 0;
        }

        .rewards-header {
            text-align: center;
            margin-bottom: 30px;
        }

        .reward-card {
            border: 1px solid #ddd;
            border-radius: 5px;
            padding: 20px;
            margin-bottom: 20px;
            text-align: center;
        }

        .reward-card img {
            max-width: 100%;
            height: auto;
            border-radius: 5px;
        }

        .reward-card h5 {
            margin-top: 15px;
            margin-bottom: 10px;
        }

        .reward-card p {
            margin-bottom: 15px;
        }

        .reward-card .btn {
            background-color: #f0ad4e;
            border-color: #f0ad4e;
        }

        .reward-card .btn:hover {
            background-color: #f0ad4e;
            border-color: #f0ad4e;
        }

        .head {
            background-color: #000;
        }
    </style>
</head>

<body>
    <div class="head">
        <?php require 'header_main.php' ?><br>
    </div>
    <main class="container rewards-section">
        <div class="rewards-header">
            <h2>Top Rewards</h2>
            <p>Earn points and redeem exciting rewards!</p>
        </div>
        <div class="row">
            <div class="col-md-4">
                <div class="reward-card">
                    <img src="https://via.placeholder.com/150" alt="Reward 1">
                    <h5>Reward Title 1</h5>
                    <p>Short description of the reward.</p>
                    <button class="btn btn-primary">Redeem Now</button>
                </div>
            </div>
            <div class="col-md-4">
                <div class="reward-card">
                    <img src="https://via.placeholder.com/150" alt="Reward 2">
                    <h5>Reward Title 2</h5>
                    <p>Short description of the reward.</p>
                    <button class="btn btn-primary">Redeem Now</button>
                </div>
            </div>
            <div class="col-md-4">
                <div class="reward-card">
                    <img src="https://via.placeholder.com/150" alt="Reward 3">
                    <h5>Reward Title 3</h5>
                    <p>Short description of the reward.</p>
                    <button class="btn btn-primary">Redeem Now</button>
                </div>
            </div>
        </div>
    </main>
    <?php include "footer.php" ?>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>