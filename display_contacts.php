<!-- display_contacts.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Entries</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Poppins', sans-serif;
        }

        body {
            background: #081b29;
            color: #ededed;
            line-height: 1.6;
        }

        .container {
            max-width: 1200px;
            margin: 40px auto;
            padding: 0 20px;
        }

        .heading {
            font-size: 32px;
            text-align: center;
            margin-bottom: 40px;
            position: relative;
        }

        .heading span {
            color: #0ef;
        }

        .contact-table {
            width: 100%;
            border-collapse: collapse;
            background: #112e42;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 0 20px rgba(0, 238, 255, 0.1);
        }

        th, td {
            padding: 15px;
            text-align: left;
            border-bottom: 1px solid #0ef;
        }

        th {
            background: #00abf0;
            font-weight: 600;
            text-transform: uppercase;
            font-size: 14px;
        }

        td {
            font-size: 14px;
        }

        tr {
            transition: all 0.3s ease;
        }

        tr:hover {
            background: #143852;
            transform: translateY(-2px);
        }

        .no-entries {
            text-align: center;
            padding: 20px;
            font-size: 18px;
            color: #0ef;
        }

        /* Scroll animation (adapted from your original) */
        .animate.scroll {
            position: absolute;
            bottom: -2px;
            left: 0;
            width: 100%;
            height: 2px;
            background: #0ef;
            animation: animate 1s linear infinite;
            opacity: 0;
        }

        @keyframes animate {
            0% { transform: scaleX(0); transform-origin: left; }
            50% { transform: scaleX(1); transform-origin: left; }
            50.1% { transform: scaleX(1); transform-origin: right; }
            100% { transform: scaleX(0); transform-origin: right; }
        }

        /* Responsive design */
        @media (max-width: 768px) {
            .contact-table {
                display: block;
                overflow-x: auto;
            }
            th, td {
                min-width: 200px;
            }
            .heading {
                font-size: 24px;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <h2 class="heading">Contact <span>Entries</span><span class="animate scroll" style="--i:1;"></span></h2>

        <?php
        // Include database connection
        require_once 'db-connection.php';

        try {
            // Fetch all contacts
            $sql = "SELECT * FROM contacts ORDER BY created_at DESC";
            $stmt = $pdo->prepare($sql);
            $stmt->execute();
            $contacts = $stmt->fetchAll(PDO::FETCH_ASSOC);

            if ($contacts) {
                ?>
                <table class="contact-table">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Full Name</th>
                            <th>Email</th>
                            <th>Mobile</th>
                            <th>Subject</th>
                            <th>Message</th>
                            <th>Date Submitted</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($contacts as $contact): ?>
                            <tr>
                                <td><?php echo htmlspecialchars($contact['id']); ?></td>
                                <td><?php echo htmlspecialchars($contact['full_name']); ?></td>
                                <td><?php echo htmlspecialchars($contact['email']); ?></td>
                                <td><?php echo htmlspecialchars($contact['mobile_number']); ?></td>
                                <td><?php echo htmlspecialchars($contact['subject']); ?></td>
                                <td><?php echo htmlspecialchars($contact['message']); ?></td>
                                <td><?php echo htmlspecialchars($contact['created_at']); ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
                <?php
            } else {
                echo "<p class='no-entries'>No contact submissions found.</p>";
            }

        } catch (PDOException $e) {
            echo "<p class='no-entries'>Error: " . $e->getMessage() . "</p>";
        }
        ?>
    </div>
</body>
</html>