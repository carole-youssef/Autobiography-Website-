#!/usr/bin/perl -wT
use CGI ':standard';
use CGI::Carp qw(warningsToBrowser fatalsToBrowser);
print "Content-type: text/html\n\n";
use File::Basename;

my $q = CGI->new;

# Retrieve inputs
my $first_name  = $q->param('first_name');
my $last_name   = $q->param('last_name');
my $street      = $q->param('street');
my $city        = $q->param('city');
my $postal_code = $q->param('postal_code');
my $province    = $q->param('province');
my $phone       = $q->param('phone');
my $email       = $q->param('email');
my $photo       = $q->upload('photo');

# Validation flags and errors
my %errors;
$errors{'phone'}       = "Error: Phone number must be 10 digits." unless $phone =~ /^\d{10}$/;
$errors{'postal_code'} = "Error: Postal code must be in the format L0L 0L0." unless $postal_code =~ /^[A-Z]\d[A-Z] \d[A-Z]\d$/;
$errors{'email'}       = "Error: Email address is invalid." unless $email =~ /^[\w\.\-]+@[a-zA-Z\d\-]+\.[a-zA-Z]{2,}$/;

# HTML
print qq(
    <html>
    <head>
        <title>Registration</title>
        <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #ffe6f0;
            color: #333;
            padding: 20px;
        }
        .container {
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
            background-color: #fff;
            border: 1px solid #ffb3c6;
            border-radius: 10px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
        }
        h1 {
            color: #d6336c;
            text-align: center;
        }
        .error-message {
            color: white;
            display: inline-block; 
            background-color: red;
            padding: 5px; border-radius: 3px;
            font-weight: bold;
            margin-bottom: 10px;
        }
        .info {
            font-size: 18px;
            line-height: 1.5;
            color: #d6336c;
        }
        .return-link {
            display: block;
            text-align: center;
            margin-top: 20px;
            font-size: 20px;
            color: #2B657D;
        }
        
         .return-link:hover {
			color: hotpink;
        }
    </style>
</head>
<body>
    <div class="container">
);


if (%errors) {
	print "<h1>Please check your Errors!</h1>";
} else {
	print "<h1>Thank you for Registering!</h1>";
}


    print "<div class='info'><strong>Full Name:</strong> $first_name $last_name</div>";
    print "<div class='info'><strong>Street Address:</strong> $street</div>";
    print "<div class='info'><strong>City:</strong> $city</div>";
    
    if ($errors{'postal_code'}) {
		
		print "<div class='info' style='color:red;'><strong>Postal Code:</strong> $postal_code</div>";
		print "<p class='error-message'>$errors{'postal_code'}</p><br>";
	} else {
		print "<div class='info'><strong>Postal Code:</strong> $postal_code</div>";
	}
	
	print "<div class='info'><strong>Province:</strong> $province</div>";

    if ($errors{'phone'}) {
		print "<div class='info' style='color:red;'><strong>Phone Number:</strong> $phone</div>";
		print "<p class='error-message'>$errors{'phone'}</p><br>";
	} else {
		print "<div class='info'><strong>Phone Number:</strong> $phone</div>";
	}
	
    if ($errors{'email'}) {
		print "<div class='info' style='color:red;'><strong>Email Address:</strong> $email</div>";
		print "<p class='error-message'>$errors{'email'}</p><br>";
	} else {
		print "<div class='info'><strong>Email Address:</strong> $email</div>";
	}

	my $upload_dir = "/class-years/y2022/cyoussef/public_html/uploads";
	
	my $photo_name = basename($q->param('photo'));
	my $upload_path = "$upload_dir/$photo_name"; 

	open(my $out, ">", $upload_path) or die "Error!";
	binmode $out;
	while (my $bytes = <$photo>) {
		print $out $bytes;
	}
	close $out;

	print "<div class='info'><strong>Photo:</strong><br>";
	print "<img src='/~cyoussef/uploads/$photo_name' alt='Photo' style='max-width: 400px;'></div>";

	print "<a class='return-link' href='/~cyoussef/lab07b.html'>Return to Form</a>";
	



print qq(
    </div>
</body>
</html>
);

