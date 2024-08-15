<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Form</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: linear-gradient(50deg, #6e8efb, #a777e3);
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }
        .form-container {
            background: rgba(255, 255, 255, 0.8);
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            max-width: 400px;
            width: 100%;
            box-sizing: border-box;
        }
        .form-container h2 {
            text-align: center;
            margin-bottom: 20px;
        }
        .form-group {
            margin-bottom: 15px;
        }
        .form-group label {
            display: block;
            margin-bottom: 5px;
        }
        .form-group input,
        .form-group textarea,
        .form-group select {
            width: calc(100% - 20px);
            padding: 10px;
            margin-left: 0px;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-sizing: border-box;
        }
        .form-group textarea {
            resize: vertical;
        }
        .time-input {
            display: flex;
            justify-content: space-between;
            flex-wrap: wrap;
        }
        .time-input select {
            width: calc(48% - 10px);
            padding: 10px 5px;
            border: 1px solid #ccc;
            border-radius: 5px;
            margin-bottom: 10px;
            box-sizing: border-box;
        }
        .form-group button {
            width: 100%;
            padding: 10px;
            border: none;
            border-radius: 5px;
            background: #a777e3;
            color: white;
            font-size: 16px;
            transition: background-color 0.3s;
        }
        .form-group button:hover {
            background: #6e8efb;
        }

        @media (max-width: 768px) {
            .form-container {
                padding: 15px;
            }
            .time-input select {
                width: calc(100% - 20px);
            }
        }
    </style>
</head>
<body>
    <div class="form-container">
        <h2>Contact Us</h2>
        <form action="process_form.php" method="post">
            <div class="form-group">
                <label for="name">Name:</label>
                <input type="text" id="name" name="name" required>
            </div>
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" required>
            </div>
            <div class="form-group">
                <label for="message">Your Message:</label>
                <textarea id="message" name="message" rows="4" required></textarea>
            </div>
            <div class="form-group">
                <label for="time">Preferred Time:</label>
                <div class="time-input">
                    <select id="hours" name="hours" required>
                        <option value="" disabled selected>HH</option>
                        <?php for ($i = 1; $i <= 12; $i++): ?>
                            <option value="<?= $i; ?>"><?= str_pad($i, 2, '0', STR_PAD_LEFT); ?></option>
                        <?php endfor; ?>
                    </select>
                    <select id="minutes" name="minutes" required>
                        <option value="" disabled selected>MM</option>
                        <?php for ($i = 0; $i < 60; $i++): ?>
                            <option value="<?= $i; ?>"><?= str_pad($i, 2, '0', STR_PAD_LEFT); ?></option>
                        <?php endfor; ?>
                    </select>
                    <select id="period" name="period" required>
                        <option value="" disabled selected>AM/PM</option>
                        <option value="AM">AM</option>
                        <option value="PM">PM</option>
                    </select>
                    <select id="timezone" name="timezone" required>
                        <option value="" disabled selected>Timezone</option>
                        <option value="UTC">UTC</option>
                        <option value="PKT">PKT</option>
                    </select>
                </div>
            </div>
            <div class="form-group">
                <label for="date">Preferred Date:</label>
                <input type="date" id="date" name="date" required>
            </div>
            <div class="form-group">
                <button type="submit">Submit</button>
            </div>
        </form>
    </div>
</body>
</html>
