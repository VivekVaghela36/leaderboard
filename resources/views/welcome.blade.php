<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Leaderboard</title>

    <!-- Fonts -->
    <link href="https://fonts.bunny.net/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">

    <!-- Styles -->
    <style>
        body {
            font-family: 'Nunito', sans-serif;
            background-color: #f8fafc;
            /* Light background */
            color: #334155;
            /* Dark text color */
            margin: 0;
            padding: 20px;
        }

        h1 {
            text-align: center;
            color: #1e40af;
            /* Blue color for heading */
            margin-bottom: 20px;
        }

        .form-container {
            background-color: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            max-width: 600px;
            margin: 0 auto;
        }

        form {
            display: flex;
            flex-direction: column;
            gap: 15px;
            /* Space between elements */
        }

        input[type="text"],
        select {
            padding: 10px;
            border: 1px solid #d1d5db;
            /* Gray border */
            border-radius: 4px;
            font-size: 16px;
        }

        button {
            background-color: #1e40af;
            /* Blue button */
            color: white;
            padding: 10px;
            border: none;
            border-radius: 4px;
            font-size: 16px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        button:hover {
            background-color: #1e3a8a;
            /* Darker blue on hover */
        }

        table {
            width: 100%;
            margin-top: 20px;
            border-collapse: collapse;
        }

        th,
        td {
            padding: 12px;
            text-align: left;
            border-bottom: 1px solid #e5e7eb;
            /* Light gray line */
        }

        th {
            background-color: #f3f4f6;
            /* Light gray background for header */
            color: #1f2937;
            /* Darker text for header */
        }

        tr:hover {
            background-color: #e5e7eb;
            /* Light gray background on row hover */
        }

        .btn-primary {
            background-color: #10b981;
            /* Green button */
            color: white;
            text-decoration: none;
            padding: 10px;
            border-radius: 4px;
            text-align: center;
            display: inline-block;
            transition: background-color 0.3s;
        }

        .btn-primary:hover {
            background-color: #059669;
            /* Darker green on hover */
        }
    </style>
</head>

<body>
    <div>
        <h1>Leaderboard</h1>
        <div class="form-container">
            <form method="GET" action="{{ route('leaderboard.index') }}">
                <input type="text" name="user_id" placeholder="Search by User ID" value="{{ request('user_id') }}">
                <select name="filter">
                    <option value="">Select Filter</option>
                    <option value="day" {{ request('filter') == 'day' ? 'selected' : '' }}>Today</option>
                    <option value="month" {{ request('filter') == 'month' ? 'selected' : '' }}>This Month</option>
                    <option value="year" {{ request('filter') == 'year' ? 'selected' : '' }}>This Year</option>
                </select>
                <button type="submit">Apply</button>
                <a href="{{ route('leaderboard.recalculate') }}" class="btn-primary">Re-calculate</a>
            </form>
        </div>

        <table>
            <thead>
                <tr>
                    <th>Rank</th>
                    <th>User ID</th>
                    <th>Full Name</th>
                    <th>Total Points</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($leaderboard as $entry)
                    <tr>
                        <td>{{ $entry->rank }}</td>
                        <td>{{ $entry->user_id }}</td>
                        <td>{{ $entry->user->full_name }}</td>
                        <td>{{ $entry->total_points }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</body>

</html>
