 {{--  resources/views/emails/custom_notification.blade.php   --}}
 <!DOCTYPE html>
 <html>
 <head>
     <meta charset="UTF-8">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <style>
         body {
             font-family: Arial, sans-serif;
             background-color: #f4f4f4;
             margin: 0;
             padding: 0;
         }
         .container {
             width: 100%;
             padding: 20px;
             background-color: #ffffff;
             box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
             margin: 30px auto;
             max-width: 600px;
             border-radius: 8px;
         }
         .header {
             background-color: #4CAF50;
             padding: 10px;
             border-radius: 8px 8px 0 0;
             color: #ffffff;
             text-align: center;
         }
         .content {
             padding: 20px;
         }
         .button {
             display: inline-block;
             padding: 10px 20px;
             margin: 20px 0;
             background-color: #4CAF50;
             color: #ffffff;
             text-decoration: none;
             border-radius: 5px;
         }
         .footer {
             text-align: center;
             padding: 10px;
             font-size: 12px;
             color: #777777;
         }
         .footer a {
             color: #007bff;
             text-decoration: none;
         }

         table {
            width: 100%;
            border-collapse: collapse;
            background-color: #ffffff;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
            border-radius: 8px;
            overflow: hidden;
        }
        thead {
            background-color: #2d6cdf;
            color: white;
        }
        th, td {
            padding: 14px 20px;
            text-align: left;
        }
        tr:nth-child(even) {
            background-color: #f9fbfd;
        }
        tr:hover {
            background-color: #eef3ff;
        }
        th {
            font-weight: bold;
        }
     </style>
 </head>
 <body>
 <div class="container">
     <div class="header">
         <h1>{{ config('app.name') }}</h1>
     </div>
     <div class="content">
         <h2>Hello Admin !</h2>
         <p>{{ $contact->name }} Tried to reach you . Below given {{ $contact->name }}'s Information</p>
          <h2>Contact Messages</h2>

            <table>
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Message</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>{{ $contact->name }}</td>
                        <td>{{ $contact->email }}</td>
                        <td>{{ $contact->message }}</td>
                    </tr>
                </tbody>
            </table>
     </div>
     <div class="footer">
         <p>Thanks,<br>{{ config('app.name') }}</p>
         <p>If you did not expect this email, you can safely ignore it.</p>
     </div>
 </div>
 </body>
 </html>
