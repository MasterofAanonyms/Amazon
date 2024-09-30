<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Disable Button and Anchor Example</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .disabled-link {
            pointer-events: none;
            opacity: 0.65;
            cursor: not-allowed;
        }
    </style>
</head>
<body>
    <div class="container mt-5">
        <!-- Button Example -->
        <button id="myButton" class="btn btn-lg btn-primary me-3" onclick="disableButton()">Click Me (Button)</button>

        <!-- Anchor Example -->
        <a href="#" id="myAnchor"  onclick="disableAnchor()">Click Me (Anchor)</a>
    </div>

    <script>
        // Function to disable the button
        function disableButton() {
            var button = document.getElementById("myButton");
            button.disabled = true; // Disable the button
            button.classList.add("btn-lg", "btn-primary"); // Ensure button keeps Bootstrap styles
            
        }

        // Function to disable the anchor tag
        function disableAnchor() {
            var anchor = document.getElementById("myAnchor");
            anchor.classList.add("disabled-link"); // Add the disabled-link class for styling
        }
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
