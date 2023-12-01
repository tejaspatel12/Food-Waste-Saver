<!DOCTYPE html>
<html>
<head>
    <style>
        #codeDisplay {
            background-color: black;
            color: white;
            padding: 10px;
            height: 300px;
            overflow: scroll;
        }
    </style>
</head>
<body>
    <h1>Code Viewer</h1>
    <label for="fileSelect">Select a file:</label>
    <select id="fileSelect">
        <option value="" disabled selected>Select a file</option>
        <option value="file1">File 1</option>
        <option value="file2">File 2</option>
        <!-- Add more options as needed -->
    </select>
    <div id="codeDisplay">
        <!-- Code will be displayed here -->
    </div>
    <script>
        document.getElementById("fileSelect").addEventListener("change", function () {
            const selectedFile = this.value;
            if (selectedFile) {
                // Load code for the selected file, you can fetch it via AJAX or use pre-loaded data
                let code = getCodeAt(selectedFile);
                
                // Display the code in the codeDisplay element
                document.getElementById("codeDisplay").textContent = code;
            } else {
                // Clear the codeDisplay if no file is selected
                document.getElementById("codeDisplay").textContent = "";
            }
        });
        
        // Function to get code for the selected file (replace this with your data source)
        function getCodeAt(fileName) {
            // You can use an object or API call to retrieve the code for each file
            const codeMap = {
                "file1": "Code for File 1...",
                "file2": "Code for File 2..."
                // Add more entries as needed
            };
        
            return codeMap[fileName] || "Code not found";
        }

    </script>
</body>
</html>
