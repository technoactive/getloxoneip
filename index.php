<!DOCTYPE html>
<html>
<head>
    <title>Miniserver IP Address Lookup</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }

        h1 {
            text-align: center;
        }

        .form-container {
            margin-top: 20px;
            text-align: center;
        }

        .form-container label {
            font-weight: bold;
        }

        .form-container input[type="text"] {
            padding: 5px;
            width: 200px;
        }

        .form-container button {
            padding: 5px 10px;
            background-color: #4CAF50;
            color: white;
            border: none;
            cursor: pointer;
        }

        #result-container {
            margin-top: 20px;
			text-align: center;
        }

        #ip-address-label {
            font-weight: bold;
            margin-bottom: 5px;
        }

        #ip-address {
            margin-top: 0;
        }
    </style>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>
    <h1>Loxone Miniserver IP Address Lookup</h1>
    <div class="form-container">
        <label for="serial-number-input">Enter Serial Number:</label>
        <input type="text" id="serial-number-input" />
        <button id="lookup-button">Lookup IP Address</button>
    </div>
    <div id="result-container">
        <p id="ip-address-label"><strong>Miniserver IP Address:</strong></p>
        <p id="ip-address"></p>
    </div>

     <script>
        $(document).ready(function() {
            $('#lookup-button').click(function() {
                var serialNumber = $('#serial-number-input').val();
                var url = "https://dns.loxonecloud.com/?getip&snr=" + serialNumber + "&json=true";

                $.ajax({
                    url: url,
                    type: "GET",
                    success: function(response) {
                        var ipAddress = response.IP;
                        if (response.IP) {
                            ipAddress = response.IP;
                        } else if (response.IPHTTPS) {
                            ipAddress = response.IPHTTPS;
                        } else {
                            // Handle the case when neither IP nor IPHTTPS is present in the response
                            console.log("Invalid response format.");
                            return;
                        }
                        $('#ip-address').text(ipAddress).css({
						    'font-weight': 'bold',
							'color': 'green'
						});
                        $('#result-container').show();
                    },
                    error: function(xhr, status, error) {
                        console.log("An error occurred while retrieving the IP address:");
                        console.log(error);
					},
                    complete: function(xhr, status) {
                        console.log("Request completed.");
                        // Additional logic or actions you want to perform
                    }
                });
            });
        });
    </script>
</body>
</html>
