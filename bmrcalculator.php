<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get form data
    $name = htmlspecialchars($_POST['name']);
    $ic_number = htmlspecialchars($_POST['ic_number']);
    $gender = $_POST['gender'];
    $birth_year = (int)$_POST['birth_year'];
    $height = (float)$_POST['height'];
    $weight = (float)$_POST['weight'];

    // Calculate age
    $current_year = date("Y");
    $age = $current_year - $birth_year;

    // BMR Calculation 
    if ($gender == 'male') {
        // BMR formula for men
        $bmr = (10 * $weight) + (6.25 * $height) - (5 * $age) + 5;
    } else {
        // BMR formula for women
        $bmr = (10 * $weight) + (6.25 * $height) - (5 * $age) - 161;
    }

    // Alternative suggestions based on BMR range and age
    $suggestion = "";

    if ($age >= 18 && $age <= 29) {
        if ($gender == 'male') {
            if ($bmr >= 1800 && $bmr <= 2400) {
                $suggestion = "Great job! Your BMR is in the optimal range for males aged 18-29 (1,800-2,400 kcal/day). To maintain your health, focus on combining strength training with cardiovascular exercises for overall fitness.";
            } else {
                $suggestion = "Your BMR is outside the typical range for males aged 18-29. Consider incorporating more physical activity into your daily routine and re-evaluating your diet to meet your energy needs.";
            }
        } elseif ($gender == 'female') {
            if ($bmr >= 1400 && $bmr <= 2000) {
                $suggestion = "You're doing well! Your BMR is in the recommended range for females aged 18-29 (1,400-2,000 kcal/day). To stay healthy, focus on a balanced diet rich in proteins and healthy fats.";
            } else {
                $suggestion = "Your BMR is outside the recommended range for females aged 18-29. You might want to work with a nutritionist to find a meal plan that meets your body's energy requirements.";
            }
        }
    } elseif ($age >= 30 && $age <= 59) {
        if ($gender == 'male') {
            if ($bmr >= 1600 && $bmr <= 2200) {
                $suggestion = "Your BMR is within the normal range for males aged 30-59. Maintain a healthy lifestyle by incorporating lean proteins, whole grains, and regular physical activity.";
            } else {
                $suggestion = "Your BMR falls outside the normal range. Consider adding more nutrient-dense foods to your diet and staying active to improve your metabolism.";
            }
        } elseif ($gender == 'female') {
            if ($bmr >= 1200 && $bmr <= 1800) {
                $suggestion = "You're on track! Your BMR is within the normal range for females aged 30-59. Keep your body energized with regular meals and avoid skipping breakfast.";
            } else {
                $suggestion = "Your BMR falls outside the normal range. It may be time to revisit your eating habits and increase your daily physical activity to boost your metabolism.";
            }
        }
    } elseif ($age >= 60) {
        if ($gender == 'male') {
            if ($bmr >= 1400 && $bmr <= 2000) {
                $suggestion = "Your BMR is within the normal range for males aged 60+. Keep focusing on maintaining muscle mass with strength exercises, and make sure to eat nutrient-rich foods.";
            } else {
                $suggestion = "Your BMR is outside the normal range for your age. It’s important to focus on a nutrient-rich diet and incorporate gentle exercise, like walking or swimming, to support your metabolism.";
            }
        } elseif ($gender == 'female') {
            if ($bmr >= 1200 && $bmr <= 1600) {
                $suggestion = "Your BMR is within the normal range for females aged 60+. Keep your energy up with small, frequent meals throughout the day, focusing on whole foods and lean proteins.";
            } else {
                $suggestion = "Your BMR is outside the normal range for your age. Focus on a balanced diet and engage in light physical activities, like yoga or walking, to support your well-being.";
            }
        }
    }


    // Output result
    echo "
    <html lang='en'>
    <head>
        <meta charset='UTF-8'>
        <meta name='viewport' content='width=device-width, initial-scale=1.0'>
        <title>BMR Result</title>
        
        <style>
            body {
                font-family: Arial, sans-serif;
                background: linear-gradient(to right, #67b26f, #4ca2cd);
                color: #333;
                padding: 0;
                margin: 0;
                height: 100vh;
                display: flex;
                justify-content: center;
                align-items: center;
            }
            .container {
                display: flex;
                justify-content: space-between;
                max-width: 1000px;
                width: 100%;
                padding: 20px;
                box-sizing: border-box;
            }
            .result-container {
                background-color: #fff;
                padding: 30px;
                border-radius: 15px;
                box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
                max-width: 450px;
                text-align: center;
                flex: 1;
                margin-right: 20px;
            }
            h2 {
                color: #4ca2cd;
            }
            p {
                font-size: 1.2em;
                margin: 10px 0;
            }
            .suggestion {
                background-color: #f4f4f4;
                padding: 10px;
                border-left: 4px solid #4ca2cd;
                margin-top: 20px;
            }
            a {
                text-decoration: none;
                color: #67b26f;
                font-weight: bold;
            }
            .image-container {
                flex: 1;
                text-align: center;
            }
            .image-container img {
                width: 100%;
                max-width: 400px;
                border-radius: 15px;
            }
        </style>
    </head>
    <body>
        <div class='container'>
            <div class='result-container'>
                <h2>Result for $name</h2>
                <p><strong>IC Number:</strong> $ic_number</p>
                <p><strong>Gender:</strong> " . ucfirst($gender) . "</p>
                <p><strong>Age:</strong> $age years</p>
                <p><strong>Height:</strong> $height cm</p>
                <p><strong>Weight:</strong> $weight kg</p>
                <p><strong>BMR:</strong> " . number_format($bmr, 2) . " calories/day</p>
                <div class='suggestion'>
                    <p><strong>Suggestion:</strong> $suggestion</p>
                </div>
                <p><a href='index.html'>Calculate again</a></p>
            </div>
            <div class='image-container'>
                <img src='bmr.jpeg' alt='BMR Infographic'>
            </div>
        </div>
    </body>
    </html>";
}
?>
