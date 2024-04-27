<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Offer Panel</title>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        /* Custom CSS */
        body {
            background-color: #f8f9fa;
            font-family: Arial, sans-serif;
        }

        .jumbotron {
            background-color: #343a40;
            color: #fff;
            padding: 80px 30px;
            margin-bottom: 0;
        }

        .card {
            transition: transform 0.3s ease;
            cursor: pointer;
        }

        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .selected {
            border-color: blue !important; /* Change to any color you prefer */
        }

        #preferredBranch {
            border-radius: 20px;
        }
    </style>
</head>
<body>

<div class="jumbotron text-center">
    <h1 class="display-4">Welcome to EclipsElite</h1>
    <p class="lead">Choose Your Preferred Branch And Session</p>
</div>

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <form action="{{ route('check.availability') }}" method="POST" id="sessionForm">
                @csrf
                <div class="form-group">
                    <label for="preferredBranch">Preferred Branch:</label>
                    <input type="text" class="form-control" id="preferredBranch" name="branch">
                </div>
                <input type="hidden" name="session" id="selectedSession">
            </form>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6 mb-4">
            <div class="card shadow-sm" id="morningSession" onclick="selectSession('morningSession')">
                <img src="{{ asset('/staticimages/morning.jpg') }}" class="card-img-top" alt="Morning Session Image">
                <div class="card-body">
                    <h5 class="card-title">Morning Session</h5>
                    <p class="card-text">Time: 7 am - 10 am</p>
                    <p class="card-text">Days: Every day except Saturday</p>
                </div>
            </div>
        </div>

        <div class="col-md-6 mb-4">
            <div class="card shadow-sm" id="eveningSession" onclick="selectSession('eveningSession')">
                <img src="{{ asset('/staticimages/evening.jpg') }}" class="card-img-top" alt="Evening Session Image">
                <div class="card-body">
                    <h5 class="card-title">Evening Session</h5>
                    <p class="card-text">Time: 7 pm - 10 pm</p>
                    <p class="card-text">Days: Every day</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Display availability message -->
    <div id="availabilityMessage"></div>
</div>

<!-- Bootstrap JS and jQuery (for Bootstrap functionality) -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

<script>
    function selectSession(sessionId) {
        var session = sessionId === 'morningSession' ? 'morning_session' : 'evening_session';

       
        $('.card').removeClass('selected');
      
        $('#' + sessionId).addClass('selected');

      
        $('#selectedSession').val(session);

        
        $('#sessionForm').submit();
    }
</script>

</body>
</html>
